<?php


namespace Modules\Admin\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\Company;
use Modules\Inventory\Models\InvoiceDetail;


class CompanyRepository extends EloquentBaseRepository
{
    public $model = Company::class;


    public function getAll($params = [], $query = null)
    {
        $query = Company::query();
        if (isset($params["inputs"]["company_id"])) {
            $query->where('id',$params["inputs"]["company_id"]);
        }
        return parent::getAll($params, $query); // TODO: Change the autogenerated stub
    }

    public function delete($data)
    {
        $invoice = InvoiceDetail::where('company_id', $data['id'])->first();
        if (is_null($invoice)) {
            return parent::delete($data);
        } else {
            throw new AppException('Already in use');
        }
    }

}
