<?php


namespace Modules\Finance\Repositories;


use App\Constants\AppConstant;
use App\Http\Controllers\Auth\LoginController;
use App\Services\UtilityService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\AdminSegment;
use Modules\Finance\Models\Currency;
use Modules\Finance\Models\IfrNote;
use Modules\Finance\Models\JournalVoucher;
use Modules\Finance\Models\JvTrailBalanceReport;
use Modules\Finance\Models\NotesTrailBalanceReport;
use Modules\Treasury\Models\Cashbook;
use Modules\Treasury\Models\CashbookMonthlyBalance;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ReportRepository extends EloquentBaseRepository
{

    public $model = JournalVoucher::class;

    public static function toAlphabet($num)
    {

        $numeric = $num % 26;
        $letter = chr(65 + $numeric);
        $num2 = intval($num / 26);
        if ($num2 > 0) {
            return self::toAlphabet($num2 - 1) . $letter;
        } else {
            return $letter;
        }

    }

    public function getTrialBalanceReport($params)
    {

        $segments = AdminSegment::with('children');
        $economicChilds = AdminSegment::where('parent_id', 2)->get()->pluck('id');

        if (isset($params['inputs']['parent_id'])) {
            $segments->where('parent_id', $params['inputs']['parent_id']);
        } else {
            $segments->whereIn('id', $economicChilds);
        }

        $segments = $segments->get()->toArray();
        $childIds = [];

        foreach ($segments as &$segment) {
            $segment['child_ids'] = [];
            $segment['balance'] = 0;
            $segment['debit'] = 0;
            $segment['credit'] = 0;
            $segment['child_ids'] = $this->getChildIds($segment);
            $childIds = array_merge($childIds, $segment['child_ids']);
            unset($segment['children']);
        }

        $jvS = AdminSegment::join('journal_voucher_details as jd', 'admin_segments.id', '=', 'jd.economic_segment_id')
            ->join('journal_vouchers as jv', 'jv.id', '=', 'jd.journal_voucher_id')
            ->selectRaw('name, jd.economic_segment_id, sum(lv_line_value) sum, line_value_type')
            ->whereIn('admin_segments.id', $childIds)
            ->where('jv.status', AppConstant::JV_STATUS_POSTED)
            ->whereNull('jd.deleted_At')
            ->whereNull('jv.deleted_At')
            ->groupby(DB::raw('name,jd.economic_segment_id, line_value_type'));

        if (isset($params['inputs']['from_date']) && isset($params['inputs']['to_date'])) {
            $fromDate = $params['inputs']['from_date'] . ' 00:00:00';
            $toDate = $params['inputs']['to_date'] . ' 23:59:59';
            $jvS->where('jd.created_at', '>=', $fromDate)
                ->where('jd.created_at', '<=', $toDate);
        }

        $jvS = $jvS->get()->toArray();

        foreach ($jvS as $jv) {
            foreach ($segments as &$segment) {
                if (array_search($jv['economic_segment_id'], $segment['child_ids']) !== false) {

                    $segment['balance'] += $jv['sum'];
                    if ($jv['line_value_type'] == 'CREDIT') {
                        $segment['credit'] += $jv['sum'];
                    } else {
                        $segment['debit'] += $jv['sum'];
                    }
                    break;
                }
            }
        }

        return ['items' => $segments];

//        $economicSegmentChildIds = AdminSegment::where('parent_id', 2)->get()->pluck('id');
//
//        $journals = JvTrailBalanceReport::with(['economic_segment', 'parent']);
//
//        if (!isset($params['inputs']['parent_id'])) {
//            $journals->whereIn('economic_segment_id', $economicSegmentChildIds);
//        }
//
//        if (isset($params['inputs']['parent_id'])) {
//            $journals->where('parent_id', $params['inputs']['parent_id']);
//        }
//
//        if (isset($params['inputs']['from_date']) && isset($params['inputs']['to_date'])) {
//            $fromDate = $params['inputs']['from_date'] . ' 00:00:00';
//            $toDate = $params['inputs']['to_date'] . ' 23:59:59';
//            $journals->where('created_at', '>=', $fromDate)
//                ->where('created_at', '<=', $toDate);
//        }
//        $params['inputs']['orderby'] = 'created_at';
//        return parent::getAll($params, $journals);
    }

    private function getChildIds(&$data)
    {
        $childIds = [];
        $childIds[] = $data['id'];

        foreach ($data['children'] as &$child) {
            $child['child_ids'] = $this->getChildIds($child);
            $child['month1'] = 0;
            $child['month2'] = 0;
            $child['month3'] = 0;
            $child['month4'] = 0;
            $child['month5'] = 0;
            $child['month6'] = 0;
            $child['month7'] = 0;
            $child['month8'] = 0;
            $child['month9'] = 0;
            $child['month10'] = 0;
            $child['month11'] = 0;
            $child['month12'] = 0;
            $childIds = array_merge($childIds, $child['child_ids']);
        }

        return $childIds;
    }

    public function getJvLedgerReport($params)
    {
        $query = JournalVoucher
            ::join('journal_voucher_details as jd', 'journal_vouchers.id', '=', 'jd.journal_voucher_id')
            ->join('admin_segments as as', 'jd.admin_segment_id', '=', 'as.id')
            ->join('admin_segments as asd', 'jd.economic_segment_id', '=', 'asd.id')
            ->select('journal_vouchers.*', 'jd.*', 'as.combined_code', 'asd.name');

        if(isset($params['inputs']['from_date']) && isset($params['inputs']['to_date'])){

            $from = Carbon::parse($params['inputs']['from_date']);
            $to = Carbon::parse($params['inputs']['to_date']);

            $to = $to->addDays(1);
            $query->whereBetween('jd.created_at',[$from,$to]);
        }

        if (isset($params['inputs']['programme_segment_id'])) {
            $query->where('jd.programme_segment_id', $params['inputs']['programme_segment_id']);
        }

        if (isset($params['inputs']['economic_segment_id'])) {
            $query->where('jd.economic_segment_id', $params['inputs']['economic_segment_id']);
        }
        $jvreport = parent::getAll($params, $query);

        $creditSum = 0;
        $debitSum = 0;
        $openingBalance = 0.00;

        foreach ($jvreport['items'] as $item){
            if ($item['line_value_type'] === 'CREDIT') {
                $creditSum   += $item['lv_line_value'];
            } else {
                $debitSum -= $item['lv_line_value'];
            }
        }
        $endBalance = $creditSum + $debitSum;

            $jvreport['openingBalance'] = $openingBalance;
            $jvreport['totalDebits'] = $debitSum;
            $jvreport['totalCredits'] = $creditSum;
            $jvreport['endBalance'] = $endBalance;


        return $jvreport;
    }

    public function addNotes($data)
    {


        if (!isset($data['data']['type'])) {
            $data['data']['type'] = 'Trail_balance';
        }
        //todo report type get from obj

        $jvTbReport = JvTrailBalanceReport::where('economic_segment_id', $data['data']['economic_segment_id'])
            ->orWhere('parent_id', $data['data']['economic_segment_id'])
            ->whereNull('deleted_at')
            ->get();


        $checkForJv = JvTrailBalanceReport::where('parent_id', $data['data']['economic_segment_id'])
            ->whereNull('deleted_at')
            ->get();

        if ($checkForJv->isEmpty()) {
            throw new AppException('child doesnt exist , cannot create notes');
        }

        $d = [];

        $note = NotesTrailBalanceReport::whereNotNull('note_id')
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->first();
        if (is_null($note)) {
            $noteId = 'N1';
        } else {
            $num = explode('N', $note->note_id)[1] + 1;
            $noteId = 'N' . $num;
        }

        foreach ($jvTbReport as $item) {
            $parent = false;
            if ($item->economic_segment_id == $data['data']['economic_segment_id']) {
                $parent = true;
            }


            //todo change from fe type
            $d[] = [
                'note_id' => $parent ? $noteId : null,
                'type' => $data['data']['type'],
                'jv_tb_report_id' => $item->id,
                'is_parent' => $parent,
                'created_at' => Carbon::now()->toDateTimeString()
            ];
        }
        DB::beginTransaction();
        try {

            $jv = JvTrailBalanceReport::rightjoin('notes_trail_balance_report as n', 'jv_trail_balance_report.id', '=', 'n.jv_tb_report_id')
                ->where('economic_segment_id', $data['data']['economic_segment_id'])
                ->where('type', $data['data']['type'])
                ->where('is_parent', 1)
                ->whereNull('n.deleted_at')
                ->whereNull('jv_trail_balance_report.deleted_at')
                ->first();

            if (!is_null($jv)) {
                throw new AppException('already created');
            }

            if (count($d) > 0) {
                NotesTrailBalanceReport::insert($d);
            }
            $jv = JvTrailBalanceReport::rightjoin('notes_trail_balance_report as n', 'jv_trail_balance_report.id', '=', 'n.jv_tb_report_id')->where('economic_segment_id', $data['data']['economic_segment_id'])->where('type', $data['data']['type'])->first();

            JvTrailBalanceReport::where('economic_segment_id', $data['data']['economic_segment_id'])->update(['note_id' => $jv->id]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        $jv = JvTrailBalanceReport::rightjoin('notes_trail_balance_report as n', 'jv_trail_balance_report.id', '=', 'n.jv_tb_report_id')->where('economic_segment_id', $data['data']['economic_segment_id'])->first();

        return $jv;
    }

    public function getNotesTrialBalanceReport($params)
    {
        $jv = JvTrailBalanceReport::with([
            'economic_segment',
            'parent'
        ])
            ->join('notes_trail_balance_report as n', 'jv_trail_balance_report.id', '=', 'n.jv_tb_report_id');

        if (isset($params['inputs']['type'])) {
            $jv->where('type', $params['inputs']['type']);
        }

        if (!isset($params['inputs']['parent_id'])) {
            $jv->where('n.is_parent', 1);
        }

        if (isset($params['inputs']['parent_id'])) {
            $jv->where('jv_trail_balance_report.parent_id', $params['inputs']['parent_id'])
                ->where('n.is_parent', 0);
        }

        $params['inputs']['orderby'] = 'n.created_at';
        return parent::getAll($params, $jv);

    }

    public function getSiblingReport($params)
    {
        $query = JournalVoucher
            ::join('journal_voucher_details as jd', 'journal_vouchers.id', '=', 'jd.journal_voucher_id')
            ->join('admin_segments', 'jd.economic_segment_id', '=', 'admin_segments.id')
            ->where('status', AppConstant::JV_STATUS_POSTED)
            ->whereNull('jd.deleted_at');

        if(isset($params['inputs']['from_date']) && isset($params['inputs']['to_date'])){

            $from = Carbon::parse($params['inputs']['from_date']);
            $to = Carbon::parse($params['inputs']['to_date']);

            $to = $to->addDays(1);
            $query->whereBetween('jd.created_at',[$from,$to]);
        }

        $q = clone $query;
        if (isset($params['inputs']['economic_segment_id'])) {
            $query->where('jd.economic_segment_id', $params['inputs']['economic_segment_id']);
        }

        if (isset($params['inputs']['journal_voucher_id']) && isset($params['inputs']['jv_detail_id'])) {
            $q->where('journal_voucher_id', $params['inputs']['journal_voucher_id'])
                ->where('jd.id', '!=', $params['inputs']['jv_detail_id']);
            $jvreport = parent::getAll($params, $q);


            $openingBalance = 0.00;
            $creditSum = 0;
            $debitSum = 0;

            foreach ($jvreport['items'] as $item){
                if ($item['line_value_type'] === 'CREDIT') {
                    $creditSum   += $item['lv_line_value'];
                } else {
                    $debitSum -= $item['lv_line_value'];
                }
            }
            $endBalance = $creditSum + $debitSum;

            $jvreport['openingBalance'] = $openingBalance;
            $jvreport['totalDebits'] = $debitSum;
            $jvreport['totalCredits'] = $creditSum;
            $jvreport['endBalance'] = $endBalance;


            return $jvreport;
        }

        $jvreport = parent::getAll($params, $query);

        $openingBalance = 0.00;
        $creditSum = 0;
        $debitSum = 0;

        foreach ($jvreport['items'] as $item){
            if ($item['line_value_type'] === 'CREDIT') {
                $creditSum   += $item['lv_line_value'];
            } else {
                $debitSum -= $item['lv_line_value'];
            }
        }
        $endBalance = $creditSum + $debitSum;

        $jvreport['openingBalance'] = $openingBalance;
        $jvreport['totalDebits'] = $debitSum;
        $jvreport['totalCredits'] = $creditSum;
        $jvreport['endBalance'] = $endBalance;


        return $jvreport;

    }

    public function getMonthlyActivity($params)
    {


        $jvS = AdminSegment::join('journal_voucher_details as jd', 'admin_segments.id', '=', 'jd.economic_segment_id')
            ->join('journal_vouchers as jv', 'jv.id', '=', 'jd.journal_voucher_id')
            ->selectRaw('name,jd.economic_segment_id, month(jd.created_at) as month, sum(lv_line_value) sum, line_value_type')
//            ->where('jv.status', AppConstant::JV_STATUS_POSTED)
            ->whereNull('jd.deleted_at')
            ->groupby(DB::raw('name,jd.economic_segment_id, month(jd.created_at), line_value_type'))
            ->get()
            ->toArray();

        $data = null;
        $d = [];

        foreach ($jvS as $item) {
            if (isset($d[$item['economic_segment_id']])) {
                if ($item['line_value_type'] === 'CREDIT') {
                    $d[$item['economic_segment_id']]['month' . $item['month']] += $item['sum'];
                } else {
                    $d[$item['economic_segment_id']]['month' . $item['month']] -= $item['sum'];
                }
            } else {
                $d[$item['economic_segment_id']] = [
                    'name' => $item['name'],
                    'economic_segment_id' => $item['economic_segment_id'],
                    'month1' => 0, 'month2' => 0, 'month3' => 0, 'month4' => 0,
                    'month5' => 0, 'month6' => 0, 'month7' => 0, 'month8' => 0,
                    'month9' => 0, 'month10' => 0, 'month11' => 0, 'month12' => 0, 'total' => 0,
                ];
                if ($item['line_value_type'] === 'CREDIT') {
                    $d[$item['economic_segment_id']]['month' . $item['month']] += $item['sum'];
                } else {
                    $d[$item['economic_segment_id']]['month' . $item['month']] -= $item['sum'];
                }
            }
        }

        $segments = AdminSegment::with('children');

        if (isset($params['inputs']['parent_id'])) {
            $segments->where('parent_id', $params['inputs']['parent_id']);
        } elseif (isset($params['inputs']['economic_segment_id'])) {
            $segments->where('id', $params['inputs']['economic_segment_id']);
        } else {
            $segments->where('parent_id', 2);
        }


        $segments = $segments->get()->toArray();


        foreach ($segments as &$segment) {
            $segment['child_ids'] = [];
            $childIds = $this->getChildIds($segment);
            $segment['child_ids'] = $childIds;
//            unset($segment['children']);

            for ($i = 1; $i < 13; $i++) {
                $segment['month' . $i] = 0;
                if ($i == 12) {
                    $segment['total'] = 0;
                }
            }
            foreach ($d as $key => $values) {

                if (array_search($key, $segment['child_ids']) !== false) {
                    $segment['month1'] += $values['month1'];
                    $segment['month2'] += $values['month2'];
                    $segment['month3'] += $values['month3'];
                    $segment['month4'] += $values['month4'];
                    $segment['month5'] += $values['month5'];
                    $segment['month6'] += $values['month6'];
                    $segment['month7'] += $values['month7'];
                    $segment['month8'] += $values['month8'];
                    $segment['month9'] += $values['month9'];
                    $segment['month10'] += $values['month10'];
                    $segment['month11'] += $values['month11'];
                    $segment['month12'] += $values['month12'];
                    $segment['total'] += $values['month1'] + $values['month2'] + $values['month3'] + $values['month4'] + $values['month5'] + $values['month6'] + $values['month7'] + $values['month8'] + $values['month9'] + $values['month10'] + $values['month11'] + $values['month12'];

                    unset($d[$key]);
                }
            }
        }

        return ['items' => $segments];
    }

    public function getFinancialPerformance($params)
    {
        $segments = AdminSegment::with('children');

        if (isset($params['inputs']['parent_id'])) {
            $segments->where('parent_id', $params['inputs']['parent_id']);
        } else {
            $segments->whereIn('id', [7, 8]);
        }

        $segments = $segments->get()->toArray();
        $childIds = [];

        foreach ($segments as &$segment) {
            $segment['child_ids'] = [];
            $segment['balance'] = 0;
            $segment['debit'] = 0;
            $segment['credit'] = 0;
            $segment['child_ids'] = $this->getChildIds($segment);
            $childIds = array_merge($childIds, $segment['child_ids']);
            unset($segment['children']);
        }

        $jvS = AdminSegment::join('journal_voucher_details as jd', 'admin_segments.id', '=', 'jd.economic_segment_id')
            ->join('journal_vouchers as jv', 'jv.id', '=', 'jd.journal_voucher_id')
            ->selectRaw('name, jd.economic_segment_id, sum(lv_line_value) sum, line_value_type')
            ->whereIn('admin_segments.id', $childIds)
            ->whereNull('jd.deleted_at')
            ->where('jv.status', AppConstant::JV_STATUS_POSTED)
            ->groupby(DB::raw('name,jd.economic_segment_id, line_value_type'))
            ->get()
            ->toArray();

        foreach ($jvS as $jv) {
            foreach ($segments as &$segment) {
                if (array_search($jv['economic_segment_id'], $segment['child_ids']) !== false) {
                    $segment['balance'] += $jv['sum'];
                    if ($jv['line_value_type'] == 'CREDIT') {
                        $segment['credit'] += $jv['sum'];
                    } else {
                        $segment['debit'] += $jv['sum'];
                    }
                    break;
                }
            }
        }

        return ['items' => $segments];
    }

    public function getStatementOfPosition($params)
    {
        $segments = AdminSegment::with('children');

        if (isset($params['inputs']['parent_id'])) {
            $segments->where('parent_id', $params['inputs']['parent_id']);
        } else {
            $segments->whereIn('id', [9, 10]);
        }

        $segments = $segments->get()->toArray();
        $childIds = [];

        foreach ($segments as &$segment) {
            $segment['child_ids'] = [];
            $segment['balance'] = 0;
            $segment['debit'] = 0;
            $segment['credit'] = 0;
            $segment['child_ids'] = $this->getChildIds($segment);
            $childIds = array_merge($childIds, $segment['child_ids']);
            unset($segment['children']);
        }

        $jvS = AdminSegment::join('journal_voucher_details as jd', 'admin_segments.id', '=', 'jd.economic_segment_id')
            ->join('journal_vouchers as jv', 'jv.id', '=', 'jd.journal_voucher_id')
            ->selectRaw('name, jd.economic_segment_id, sum(lv_line_value) sum, line_value_type')
            ->whereIn('admin_segments.id', $childIds)
            ->where('jv.status', AppConstant::JV_STATUS_POSTED)
            ->whereNull('jd.deleted_at')
            ->groupby(DB::raw('name,jd.economic_segment_id, line_value_type'))
            ->get()
            ->toArray();

        foreach ($jvS as $jv) {
            foreach ($segments as &$segment) {
                if (array_search($jv['economic_segment_id'], $segment['child_ids']) !== false) {
                    $segment['balance'] += $jv['sum'];
                    if ($jv['line_value_type'] == 'CREDIT') {
                        $segment['credit'] += $jv['sum'];
                    } else {
                        $segment['debit'] += $jv['sum'];
                    }
                    break;
                }
            }
        }

        return ['items' => $segments];
    }

    public function deleteNotes()
    {
        $notes = NotesTrailBalanceReport::truncate();
        return ['data' => 'success'];
    }

    public function downloadNotes($params)
    {

        if (!isset($params['inputs']['notes_data'])) {
            throw new AppException('Pass note ids to download report');
        } else {

            $spreadsheet = new Spreadsheet();
            $activeSheet = $spreadsheet->getActiveSheet();

            $header = [];
            $masterHeader = ['Note', 'Full Code', 'Title', 'Debit', 'Credit', 'Balance'];
            $data = [];

//            dd(json_decode($params['inputs']['notes_data'], true));
            foreach (json_decode($params['inputs']['notes_data'], true) as $idx => $ids) {

//              dd($ids);
                if ($idx !== 0) {
                    $data[] = ['', '', '', '', '', ''];
                }
                $data[] = $masterHeader;

                $jv = JvTrailBalanceReport::with([
                    'economic_segment',
                    'parent'
                ])
                    ->join('notes_trail_balance_report as n', 'jv_trail_balance_report.id', '=', 'n.jv_tb_report_id');

                if (isset($params['inputs']['type'])) {
                    $jv->where('type', $params['inputs']['type']);
                }

                $jv->where(function ($q) use ($ids) {
                    $q->where('jv_trail_balance_report.parent_id', $ids['economicSegmentId'])
                        ->orWhere('jv_trail_balance_report.economic_segment_id', $ids['economicSegmentId']);
                });

                $jv->where(function ($q) {
                    $q->where('n.is_parent', 0)
                        ->orWhere('n.is_parent', 1);
                });

                $jv->orderBy('jv_trail_balance_report.parent_id', 'asc');

                $jvs = $jv->get()->toArray();

                foreach ($jvs as $var) {


//                    if (array_search($var['economic_segment']['combined_code'], array_column($data, 'full_code'))) {
//                        continue;
//                    }

                    $temp = [
                        'note_id' => ($ids['economicSegmentId'] === $var['economic_segment_id']) ? $var['note_id'] : '',
                        'full_code' => $var['economic_segment']['combined_code'],
                        'title' => $var['economic_segment']['name'],
                        'debit' => $var['debit'],
                        'credit' => $var['credit'],
                        'balance' => $var['balance']
                    ];

                    $data[] = $temp;
                }

//                dd($data);
                /*foreach ($header as $index => $h) {
                    $cellVal = self::toAlphabet($index) . 1;
                    $activeSheet->setCellValue($cellVal, $h);
                    $activeSheet->getStyle($cellVal)->getFont()->setBold(true);
                }

                foreach ($data as $index1 => $jv) {
                    foreach (array_values($jv) as $index => $item) {
                        $cellVal = self::toAlphabet($index) . ($index1 + 2);

                        $activeSheet->setCellValue($cellVal, $item);
                    }

                }*/
            }

//            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $filePath = 'csv/notes_report' . \Carbon\Carbon::now()->format("Y-m-d_h:i:s") . '.xlsx';
            UtilityService::createSpoutFile($data, $header, $filePath);
//            $writer->save($filePath);
            return ['url' => url($filePath)];
        }
    }

    public function saveIfrNotes($data)
    {

        $note = IfrNote::orderBy('created_at', 'desc')->orderBy('id', 'desc')->first();
        if (is_null($note)) {
            $data['data']['note_id'] = 'N1';
        } else {
            $num = explode('N', $note->note_id)[1] + 1;
            $data['data']['note_id'] = 'N' . $num;
        }
        $ifrNote = IfrNote::create($data['data']);
        return $ifrNote;
    }

    public function getIfrNotes($params)
    {
        $ifrNotes = IfrNote::where('type', $params['inputs']['type'])->get();

        $applicationOfFunds = null;

        if ($params['inputs']['type'] == AppConstant::REPORT_APPLICATION_OF_FUND) {
            foreach ($ifrNotes as $key => $note) {

                $parentEconomic = AdminSegment::find($note->economic_segment_id);
                $data['inputs'] = [
                    'economic_segment_id' => $parentEconomic->parent_id
                ];
                $parentApplicationOfFunds = $this->applicationOfFund($data);
                $finalParent = null;
                foreach ($parentApplicationOfFunds as $applicationOfFund) {
                    if ($applicationOfFund['id'] == $note->economic_segment_id) {
                        $finalParent = $applicationOfFund;
                    }
                }

                $data['inputs'] = [
                    'economic_segment_id' => $note->economic_segment_id
                ];

                $applicationOfFunds[$key] = $finalParent;
                $applicationOfFunds[$key]['note_id'] = $note->note_id;
                $applicationOfFunds[$key]['children'] = $this->applicationOfFund($data);
            }
            return $applicationOfFunds;

        } elseif ($params['inputs']['type'] == AppConstant::REPORT_USES_OF_FUND) {

            foreach ($ifrNotes as $key => $note) {


                if ($note->uses_of_fund_type == 'SOURCES') {
                    if (isset($note->economic_segment_id)) {
                        $parentEconomic = AdminSegment::find($note->economic_segment_id);
                        $data['inputs'] = [
                            'economic_segment_id' => $parentEconomic->parent_id
                        ];
                    } elseif (isset($note->program_segment_id)) {
                        $parentEconomic = AdminSegment::find($note->program_segment_id);
                        $data['inputs'] = [
                            'program_segment_id' => $parentEconomic->parent_id
                        ];
                    }

                } elseif ($note->uses_of_fund_type == 'USES') {
                    $parentEconomic = AdminSegment::find($note->economic_segment_id);
                    $data['inputs'] = [
                        'economic_segment_id' => $parentEconomic->parent_id
                    ];
                }

                $parentApplicationOfFunds = $this->sourcesUserOfFund($data);

                $finalParent = null;


                if ($note->uses_of_fund_type == 'SOURCES') {
                    foreach ($parentApplicationOfFunds[0]['items'] as $applicationOfFund) {
                        if (isset($note->economic_segment_id)) {
                            if ($applicationOfFund['id'] == $note->economic_segment_id) {
                                $finalParent = $applicationOfFund;
                            }
                        } elseif (isset($note->program_segment_id)) {
                            if ($applicationOfFund['id'] == $note->program_segment_id) {
                                $finalParent = $applicationOfFund;
                            }
                        }

                    }

                } elseif ($note->uses_of_fund_type == 'USES') {
                    foreach ($parentApplicationOfFunds[1]['items'] as $applicationOfFund) {
                        if ($applicationOfFund['id'] == $note->economic_segment_id) {
                            $finalParent = $applicationOfFund;
                        }
                    }
                }


                if ($note->uses_of_fund_type == 'SOURCES') {
                    if (isset($note->economic_segment_id)) {
                        $data['inputs'] = [
                            'economic_segment_id' => $note->economic_segment_id
                        ];
                    } elseif (isset($note->program_segment_id)) {
                        $data['inputs'] = [
                            'program_segment_id' => $note->program_segment_id
                        ];
                    }

                } elseif ($note->uses_of_fund_type == 'USES') {
                    $data['inputs'] = [
                        'economic_segment_id' => $note->economic_segment_id
                    ];
                }


                $applicationOfFunds[$key] = $finalParent;
                $applicationOfFunds[$key]['note_id'] = $note->note_id;


                if ($note->uses_of_fund_type == 'SOURCES') {
                    if (isset($note->economic_segment_id)) {
                        $applicationOfFunds[$key]['children'] = $this->sourcesUserOfFund($data)[0]['items'];
                    } elseif (isset($note->program_segment_id)) {
                        $applicationOfFunds[$key]['children'] = $this->sourcesUserOfFund($data)[0]['items'];
                    }

                } elseif ($note->uses_of_fund_type == 'USES') {
                    $applicationOfFunds[$key]['children'] = $this->sourcesUserOfFund($data)[1]['items'];
                }
            }


            return $applicationOfFunds;
        }


    }

    public function applicationOfFund($params)
    {
        $reportType = !isset($params['inputs']['report_type']) ? 'SEMESTER' : !isset($params['inputs']['report_type']);
        $report = !isset($params['inputs']['report']) ? 2 : !isset($params['inputs']['report']);
        $economicSegmentId = !isset($params['inputs']['economic_segment_id']) ? 8 : $params['inputs']['economic_segment_id'];
        $adminSegmentId = !isset($params['inputs']['admin_segment_id']) ? 1 : $params['inputs']['admin_segment_id'];
        $fundSegmentId = !isset($params['inputs']['fund_segment_id']) ? 5 : $params['inputs']['fund_segment_id'];

        $economicParents = $this->getAllChildren($economicSegmentId);
        $adminSegmentChildIds = $this->getAllChildrenId($adminSegmentId);
        $fundSegmentChildIds = $this->getAllChildrenId($fundSegmentId);
        $months = [];
        $previousMonth = [];

        switch ($reportType) {
            case AppConstant::REPORT_TYPE_MONTHLY:
                $months = [$report];
                $previousMonth = ((int)$report - 1) === 0 ? [] : [((int)$report - 1)];
                break;
            case AppConstant::REPORT_TYPE_QUARTER:
                if ($report == 1) {
                    $months = [1, 2, 3];
                } else if ($report == 2) {
                    $months = [4, 5, 6];
                    $previousMonth = [1, 2, 3];
                } else if ($report == 3) {
                    $months = [7, 8, 9];
                    $previousMonth = [4, 5, 6];
                } else {
                    $months = [10, 11, 12];
                    $previousMonth = [7, 8, 9];
                }
                break;
            default:
                if ($report == 1) {
                    $months = [1, 2, 3, 4, 5, 6];
                } else {
                    $months = [7, 8, 9, 10, 11, 12];
                    $previousMonth = [1, 2, 3, 4, 5, 6];
                }
        }

        foreach ($economicParents as &$economicParent) {
            $this->parseEconomic($economicParent);
            $economicParent['actual'] = 0;
            $economicParent['budget'] = 0;
            $economicParent['variance'] = 0;
            $economicParent['cumulative_actual'] = 0;
            $economicParent['cumulative_budget'] = 0;
            $economicParent['cumulative_variance'] = 0;
            $economicParent['previous_actual'] = 0;
            $economicParent['previous_budget'] = 0;
            $economicParent['previous_variance'] = 0;

            if (count($months)) {
                $jvS = AdminSegment::join('journal_voucher_details as jd', 'admin_segments.id', '=', 'jd.economic_segment_id')
                    ->join('journal_vouchers as jv', 'jv.id', '=', 'jd.journal_voucher_id')
                    ->selectRaw('name, jd.economic_segment_id, sum(lv_line_value) sum, line_value_type')
                    ->whereIn('jd.admin_segment_id', $adminSegmentChildIds)
                    ->whereIn('jd.economic_segment_id', $economicParent['child_ids'])
                    ->whereIn('jd.fund_segment_id', $fundSegmentChildIds)
                    ->where('jv.status', AppConstant::JV_STATUS_POSTED)
                    ->groupby(DB::raw('name,jd.economic_segment_id,line_value_type'))
                    ->whereRaw('MONTH(jd.created_at) in (' . implode(',', $months) . ')')
                    ->get()
                    ->toArray();
                $creditAmount = 0;
                $debitAmount = 0;
                foreach ($jvS as $jv) {
                    if ($jv['line_value_type'] === 'DEBIT') {
                        $debitAmount = $jv['sum'];
                    } else if ($jv['line_value_type'] === 'CREDIT') {
                        $creditAmount = $jv['sum'];
                    }
                }

                $economicParent['actual'] = $debitAmount - $creditAmount;

                $budgets = AdminSegment::join('budget', 'budget.economic_segment_id', 'admin_segments.id')
                    ->join('budget_breakups', 'budget_breakups.budget_id', 'budget.id')
                    ->selectRaw('admin_segments.name, budget.economic_segment_id, sum(budget_breakups.main_budget) sum')
                    ->whereIn('budget.admin_segment_id', $adminSegmentChildIds)
                    ->whereIn('budget.economic_segment_id', $economicParent['child_ids'])
                    ->whereIn('budget.fund_segment_id', $fundSegmentChildIds)
                    ->whereNull('budget.program_segment_id')
                    ->groupby(DB::raw('admin_segments.id,budget.economic_segment_id'))
                    ->whereIn('budget_breakups.month', $previousMonth)
                    ->whereNull('budget_breakups.deleted_at')
                    ->get()
                    ->toArray();

                $budgetAmount = 0;
                foreach ($budgets as $budget) {
                    $budgetAmount += $budget['sum'];
                }

                $economicParent['budget'] = $budgetAmount;
                $economicParent['variance'] = $economicParent['budget'] - $economicParent['actual'];
            }

            if (count($previousMonth)) {
                $jvS = AdminSegment::join('journal_voucher_details as jd', 'admin_segments.id', '=', 'jd.economic_segment_id')
                    ->join('journal_vouchers as jv', 'jv.id', '=', 'jd.journal_voucher_id')
                    ->selectRaw('name, jd.economic_segment_id, sum(lv_line_value) sum, line_value_type')
                    ->whereIn('jd.admin_segment_id', $adminSegmentChildIds)
                    ->whereIn('jd.economic_segment_id', $economicParent['child_ids'])
                    ->whereIn('jd.fund_segment_id', $fundSegmentChildIds)
                    ->where('jv.status', AppConstant::JV_STATUS_POSTED)
                    ->groupby(DB::raw('name,jd.economic_segment_id,line_value_type'))
                    ->whereNull('jd.deleted_at')
                    ->whereRaw('MONTH(jd.created_at) in (' . implode(',', $previousMonth) . ')')
                    ->get()
                    ->toArray();
                $creditAmount = 0;
                $debitAmount = 0;
                foreach ($jvS as $jv) {
                    if ($jv['line_value_type'] === 'DEBIT') {
                        $debitAmount = $jv['sum'];
                    } else if ($jv['line_value_type'] === 'CREDIT') {
                        $creditAmount = $jv['sum'];
                    }
                }

                $economicParent['previous_actual'] = $debitAmount - $creditAmount;

                $budgets = AdminSegment::join('budget', 'budget.economic_segment_id', 'admin_segments.id')
                    ->join('budget_breakups', 'budget_breakups.budget_id', 'budget.id')
                    ->selectRaw('admin_segments.name, budget.economic_segment_id, sum(budget_breakups.main_budget) sum')
                    ->whereIn('budget.admin_segment_id', $adminSegmentChildIds)
                    ->whereIn('budget.economic_segment_id', $economicParent['child_ids'])
                    ->whereIn('budget.fund_segment_id', $fundSegmentChildIds)
                    ->whereNull('budget.program_segment_id')
                    ->groupby(DB::raw('admin_segments.id,budget.economic_segment_id'))
                    ->whereIn('budget_breakups.month', $previousMonth)
                    ->whereNull('budget_breakups.deleted_at')
                    ->get()
                    ->toArray();

                $budgetAmount = 0;
                foreach ($budgets as $budget) {
                    $budgetAmount += $budget['sum'];
                }
                $economicParent['cumulative_actual'] = $economicParent['actual'] + $economicParent['previous_actual'];
                $economicParent['cumulative_budget'] = $economicParent['budget'] + $economicParent['previous_budget'];
                $economicParent['cumulative_variance'] = $economicParent['variance'] + $economicParent['previous_variance'];

                $economicParent['previous_budget'] = $budgetAmount;
                $economicParent['previous_variance'] = $economicParent['budget'] - $economicParent['actual'];
            }


            unset($economicParent['child_ids']);
            unset($economicParent['children']);
        }

        return $economicParents;
    }

    public function getAllChildren($id)
    {
        return AdminSegment::where('parent_id', $id)->with('children')->get()->toArray();
    }

    public function getAllChildrenId($id)
    {
        $segments = AdminSegment::with('children');
        $economicChilds = AdminSegment::where('parent_id', $id)->get()->pluck('id');

        if (isset($params['inputs']['parent_id'])) {
            $segments->where('parent_id', $id);
        } else {
            $segments->whereIn('id', $economicChilds);
        }

        $segments = $segments->get()->toArray();
        $childIds = [];

        foreach ($segments as &$segment) {
            $segment['child_ids'] = [];
            $segment['child_ids'] = $this->getChildId2($segment);
            $childIds = array_merge($childIds, $segment['child_ids']);
            unset($segment['children']);
        }

        return $childIds;
    }

    private function getChildId2(&$data)
    {
        $childIds = [];
        $childIds[] = $data['id'];


        foreach ($data['children'] as &$child) {

            $child['child_ids'] = $this->getChildId2($child);
            $childIds = array_merge($childIds, $child['child_ids']);
        }

        return $childIds;
    }

    public function parseEconomic(&$economic)
    {
        $economic['child_ids'] = [];

        foreach ($economic['children'] as &$child) {
            $economic['child_ids'][] = $child['id'];
            if (count($child['children'])) {
                $childIds = $this->parseEconomic($child);
                $economic['child_ids'] = array_merge($economic['child_ids'], $childIds);
            }
        }

        return $economic['child_ids'];
    }

    public function sourcesUserOfFund($params)
    {
        // todo get user's local and international currency
        $localCurrency = Currency::find(1);
        $internationalCurrency = Currency::find(2);

        $reportType = !isset($params['inputs']['report_type']) ? 'SEMESTER' : !isset($params['inputs']['report_type']);
        $report = !isset($params['inputs']['report']) ? 2 : !isset($params['inputs']['report']);
        $adminSegmentId = !isset($params['inputs']['admin_segment_id']) ? 1 : $params['inputs']['admin_segment_id'];
//        $isProgram = filter_var(isset($params['inputs']['is_program']) ? isset($params['inputs']['is_program']) : false, FILTER_VALIDATE_BOOLEAN);

        $isProgram = isset($params['inputs']['program_segment_id']) ? true : false;


        $months = [];

//        dd($isProgram);
        switch ($reportType) {

            case AppConstant::REPORT_TYPE_QUARTER:
                if ($report == 1) {
                    $months = [1, 2, 3];
                } else if ($report == 2) {
                    $months = [4, 5, 6];
                } else if ($report == 3) {
                    $months = [7, 8, 9];
                } else {
                    $months = [10, 11, 12];
                }
                break;
            default:
                if ($report == 1) {
                    $months = [1, 2, 3, 4, 5, 6];
                } else {
                    $months = [7, 8, 9, 10, 11, 12];
                }
        }


        $params['inputs']['program_segment_id'] = isset($params['inputs']['program_segment_id']) ? $params['inputs']['program_segment_id'] : 4;
        $params['inputs']['economic_segment_id'] = isset($params['inputs']['economic_segment_id']) ? $params['inputs']['economic_segment_id'] : 2;

        if ($isProgram) {
            $economicParents = $this->getAllChildren($params['inputs']['program_segment_id']);
        } else {
            $economicParents = $this->getAllChildren($params['inputs']['economic_segment_id']);
        }

        $adminSegmentChildIds = $this->getAllChildrenId($adminSegmentId);

        $data = [
            [
                'section' => 'Sources', 'item' => 'Total Receipts', 'cumulative_local' => 0, 'cumulative_international' => 0,
                'actual_local' => 0, 'actual_international' => 0, 'future_local' => 0, 'future_international' => 0, 'items' => []
            ],
            [
                'section' => 'Uses', 'item' => 'Not Change is Cash', 'cumulative_local' => 0, 'cumulative_international' => 0,
                'actual_local' => 0, 'actual_international' => 0, 'future_local' => 0, 'future_international' => 0, 'items' => []
            ],
            [
                'section' => 'Opening Bank Balance', 'item' => 'Net Cash Available', 'cumulative_local' => 0, 'cumulative_international' => 0,
                'actual_local' => 0, 'actual_international' => 0, 'future_local' => 0, 'future_international' => 0, 'items' => []
            ],
            [
                'section' => 'Closing Bank Balance', 'item' => 'Total Closing Balance', 'cumulative_local' => 0, 'cumulative_international' => 0,
                'actual_local' => 0, 'actual_international' => 0, 'future_local' => 0, 'future_international' => 0, 'items' => []
            ]
        ];

        // todo add currency symbol
        foreach ($economicParents as &$economicParent) {
            $this->parseEconomic($economicParent);
            $economicParent['actual_local'] = 0;
            $economicParent['actual_international'] = 0;
            $economicParent['cumulative_local'] = 0;
            $economicParent['cumulative_international'] = 0;
            $economicParent['future_local'] = 0;
            $economicParent['future_international'] = 0;

            $budgetQuery = AdminSegment::join('budget', 'budget.economic_segment_id', 'admin_segments.id')
                ->join('budget_breakups', 'budget_breakups.budget_id', 'budget.id')
                ->join('currencies as c', 'budget.currency_id', 'c.id')
                ->whereIn('budget.admin_segment_id', $adminSegmentChildIds)
//                    ->whereNull('budget.program_segment_id')
                ->whereIn('budget.economic_segment_id', $economicParent['child_ids']);

            if ($isProgram) {
                $budgetQuery->whereNull('economic_segment_id')
                    ->selectRaw('admin_segments.name, budget.program_segment_id, c.plural_currency_name, c.currency_sign, sum(budget_breakups.main_budget*x_rate_local) sum,sum(budget_breakups.main_budget*x_rate_to_international) sum_international')
                    ->groupby(DB::raw('admin_segments.id, budget.program_segment_id, c.plural_currency_name, c.currency_sign'));
            } else {
                $budgetQuery->whereNull('program_segment_id')
                    ->selectRaw('admin_segments.name, budget.economic_segment_id, c.plural_currency_name, c.currency_sign, sum(budget_breakups.main_budget*x_rate_local) sum,sum(budget_breakups.main_budget*x_rate_to_international) sum_international')
                    ->groupby(DB::raw('admin_segments.id, budget.economic_segment_id, c.plural_currency_name, c.currency_sign'));
            }

            if (count($months)) {
                $budgets = (clone $budgetQuery)
                    ->whereIn('budget_breakups.month', $months)
                    ->get()->toArray();

                foreach ($budgets as $budget) {
                    $economicParent['actual_local'] += $budget['sum'];
                    $economicParent['actual_local'] = round($economicParent['actual_local'], 2);
                    $economicParent['actual_international'] += $budget['sum_international'];
                    $economicParent['actual_international'] = round($economicParent['actual_international'], 2);
                }
            }

            // Cumulative data
            $budgets = (clone $budgetQuery)->get()->toArray();

            foreach ($budgets as $budget) {
                $economicParent['cumulative_local'] += $budget['sum'];
                $economicParent['cumulative_local'] = round($economicParent['cumulative_local'], 2);

                $economicParent['cumulative_international'] += $budget['sum_international'];
                $economicParent['cumulative_international'] = round($economicParent['cumulative_international'], 2);
            }

            unset($economicParent['child_ids']);
            unset($economicParent['children']);
            $data[0]['actual_local'] += $economicParent['actual_local'];
            $data[0]['actual_international'] += $economicParent['actual_international'];
            $data[0]['cumulative_local'] += $economicParent['cumulative_local'];
            $data[0]['cumulative_international'] += $economicParent['cumulative_international'];
            $data[0]['future_local'] += $economicParent['future_local'];
            $data[0]['future_international'] += $economicParent['future_international'];
            $data[0]['items'][] = $economicParent;
        }

        // Calculating Uses
        $economicChildren = $this->getAllChildren(8);

        foreach ($economicChildren as &$economicParent) {
            $this->parseEconomic($economicParent);
            $economicParent['actual_local'] = 0;
            $economicParent['actual_international'] = 0;
            $economicParent['cumulative_local'] = 0;
            $economicParent['cumulative_international'] = 0;
            $economicParent['future_local'] = 0;
            $economicParent['future_international'] = 0;

            // todo remove currency join and add POSTED in jv
            $jvQuery = AdminSegment::join('journal_voucher_details as jd', 'admin_segments.id', '=', 'jd.economic_segment_id')
                ->join('journal_vouchers as jv', 'jv.id', '=', 'jd.journal_voucher_id')
                ->join('currencies as c', 'jd.currency', 'c.code_currency')
                ->selectRaw('name, c.currency_sign as international_sign, c.code_currency as international_code ,jd.economic_segment_id, sum(lv_line_value*x_rate_local) local_sum,jd.local_currency, sum(lv_line_value*bank_x_rate_to_usd) international_sum,line_value_type')
                ->whereIn('jd.admin_segment_id', $adminSegmentChildIds)
                ->whereIn('jd.economic_segment_id', $economicParent['child_ids'])
//                    ->where('jv.status', AppConstant::JV_STATUS_POSTED)
                ->whereNull('jd.deleted_at')
                ->groupby(DB::raw('name,jd.economic_segment_id,line_value_type ,c.currency_sign,c.code_currency,jd.local_currency'));

            if (count($months)) {
                $jvS = (clone $jvQuery)
                    ->whereRaw('MONTH(jd.created_at) in (' . implode(',', $months) . ')')
                    ->get()
                    ->toArray();

                foreach ($jvS as $jv) {
                    if ($jv['line_value_type'] === 'DEBIT') {
                        $economicParent['actual_local'] -= $jv['local_sum'];
                        $economicParent['actual_international'] -= $jv['international_sum'];
                    } else {
                        $economicParent['actual_local'] += $jv['local_sum'];
                        $economicParent['actual_international'] += $jv['international_sum'];
                    }

                    $economicParent['actual_local'] = round($economicParent['actual_local'], 2);
                    $economicParent['actual_international'] = round($economicParent['actual_international'], 2);
                }
            }

            $jvS = (clone $jvQuery)->get()->toArray();

            foreach ($jvS as $jv) {
                if ($jv['line_value_type'] === 'DEBIT') {
                    $economicParent['actual_local'] -= $jv['local_sum'];
                    $economicParent['actual_international'] -= $jv['international_sum'];
                } else {
                    $economicParent['actual_local'] += $jv['local_sum'];
                    $economicParent['actual_international'] += $jv['international_sum'];
                }

                $economicParent['actual_local'] = round($economicParent['actual_local'], 2);
                $economicParent['actual_international'] = round($economicParent['actual_international'], 2);
            }

            unset($economicParent['child_ids']);
            unset($economicParent['children']);
            $data[1]['actual_local'] += $economicParent['actual_local'];
            $data[1]['actual_international'] += $economicParent['actual_international'];
            $data[1]['cumulative_local'] += $economicParent['cumulative_local'];
            $data[1]['cumulative_international'] += $economicParent['cumulative_international'];
            $data[1]['future_local'] += $economicParent['future_local'];
            $data[1]['future_international'] += $economicParent['future_international'];
            $data[1]['items'][] = $economicParent;
        }


        // todo NOTE International currency is missing from CASHBOOK
        // Cashbook
        $cashBooks = Cashbook::get()->toArray();

        foreach ($cashBooks as &$cashBook) {
            $cashBook['name'] = $cashBook['cashbook_title'];
            $cashBook['actual_local'] = 0;
            $cashBook['actual_international'] = 0;
            $cashBook['cumulative_local'] = 0;
            $cashBook['cumulative_international'] = 0;
            $cashBook['future_local'] = 0;
            $cashBook['future_international'] = 0;

            if (count($months)) {
                $monthlyBalance = CashbookMonthlyBalance::where('month', $months[count($months) - 1])->first();
                if ($monthlyBalance) {
                    $monthlyBalance = $monthlyBalance->toArray();
                    $cashBook['actual_local'] = $monthlyBalance['balance'] * $cashBook['x_rate_local_currency'];
                    $cashBook['actual_international'] = $monthlyBalance['balance'];
                }
            }

            $monthlyBalance = CashbookMonthlyBalance::where('month', Carbon::now()->month)->first();
            if ($monthlyBalance) {
                $monthlyBalance = $monthlyBalance->toArray();
                $cashBook['cumulative_local'] = $monthlyBalance['balance'] * $cashBook['x_rate_local_currency'];
                $cashBook['cumulative_international'] = $monthlyBalance['balance'];
            }


            $data[2]['actual_local'] += $cashBook['actual_local'];
            $data[2]['actual_international'] += $cashBook['actual_international'];
            $data[2]['cumulative_local'] += $cashBook['cumulative_local'];
            $data[2]['cumulative_international'] += $cashBook['cumulative_international'];
            $data[2]['future_local'] += $cashBook['future_local'];
            $data[2]['future_international'] += $cashBook['future_international'];
            $data[2]['items'][] = $cashBook;


            $cashBook['actual_local'] = 0;
            $cashBook['actual_international'] = 0;
            $cashBook['cumulative_local'] = 0;
            $cashBook['cumulative_international'] = 0;
            $cashBook['future_local'] = 0;
            $cashBook['future_international'] = 0;

            if (count($months)) {
                $monthlyBalance = CashbookMonthlyBalance::where('month', $months[count($months) - 2])->first();
                if ($monthlyBalance) {
                    $monthlyBalance = $monthlyBalance->toArray();
                    $cashBook['actual_local'] = $monthlyBalance['balance'] * $cashBook['x_rate_local_currency'];
                    $cashBook['actual_international'] = $monthlyBalance['balance'];
                }
            }

            $monthlyBalance = CashbookMonthlyBalance::where('month', Carbon::now()->month - 1)->first();
            if ($monthlyBalance) {
                $monthlyBalance = $monthlyBalance->toArray();
                $cashBook['cumulative_local'] = $monthlyBalance['balance'] * $cashBook['x_rate_local_currency'];
                $cashBook['cumulative_international'] = $monthlyBalance['balance'];
            }


            $data[3]['actual_local'] += $cashBook['actual_local'];
            $data[3]['actual_international'] += $cashBook['actual_international'];
            $data[3]['cumulative_local'] += $cashBook['cumulative_local'];
            $data[3]['cumulative_international'] += $cashBook['cumulative_international'];
            $data[3]['future_local'] += $cashBook['future_local'];
            $data[3]['future_international'] += $cashBook['future_international'];
            $data[3]['items'][] = $cashBook;
        }


        return $data;
    }
}
