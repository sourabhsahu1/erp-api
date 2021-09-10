<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-wi  dth, initial-scale=1.0">
    <title>Payment Voucher</title>
    <style>
        * {
            font-size: 12px !important;
        }

        .label_font_family {
            font-family: "Times New Roman", Times, serif;
            /*font-size: 9px !important;*/
        }

        .text_font_family {
            font-family: Arial, Helvetica, sans-serif;
            /*font-size: 9px !important;*/
        }

        .text-bold {
            font-weight: 600;
        }

        input {
            border: none !important;
            border-bottom: 1px solid #000 !important;
            /* box-shadow: 0 1px 0 0 #000; */
        }

        .border-bottom-only {
            border: none !important;
            border-bottom: 1px solid #000 !important;
        }

        .width-100-per {
            width: 100% !important;
        }

        .width-90-per {
            width: 90% !important;
        }

        .width-75-per {
            width: 75% !important;
        }

        .width-70-per {
            width: 70% !important;
        }

        .width-71-per {
            width: 71.2% !important;
        }

        .width-50-per {
            width: 50% !important;
        }

        .width-25-per {
            width: 25% !important;
        }

        .text-center {
            text-align: center !important;
        }

        .table-bordered {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .width-10px {
            width: 10px;
        }

        .bind-data {
            font-size: 17px;
        }

        .cell-size {
            width: 35px;
        }

        .description_table > tr > td {
            border-bottom: none;
            border-top: none;
        }

        .description_table > tr:last-child > td {
            border-bottom: 1px solid black;
        !important;
            border-top: 1px solid black;
        !important;
        }

        .description_table > tr:last-child > td:first-child {
            border-top: none;
            border-bottom: none;
        }

        .description_table > tr:last-child > td:nth-child(2) {
            border-top: none;
            border-bottom: none;
        }

        .tableBordered tr td, .tableBordered tr th {
            border: 1px solid #000000;
        }

        .text-center {
            text-align: center !important;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .vertical-align-baseline {
            vertical-align: baseline;
        }

        .vertical-align-middle {
            vertical-align: middle;
        }

        table {
            border-spacing: 5px;
            border-collapse: collapse;
        }

        .padding-0 {
            padding: 0;
        }

        .margin-0 {
            margin: 0;
        }

        .border-top-0 {
            border-top: none !important;
        }

        .border-bottom-0 {
            border-bottom: none !important;
        }

        .iTableBordered tr td {
            width: 35px;
            height: 40px;
            text-align: center;
        }

        .iTableBordered tr th {
            width: 35px;
            height: 30px;
        }

        .border-none {
            border: none !important;
        }
    </style>
</head>
<body>
<div style="width: 90%; height: auto; margin: 0px auto;">
    <div style="width: 100%; padding-top: 10px; padding-bottom: 10px">
        <table style="width: 100%;">
            <tr>
                <td style="text-align: left; font-weight: bold">ORIGINAL</td>
                <td style="text-align: right">Treasury F1</td>
            </tr>
        </table>
        <div class="label_font_family">
            <h2 style="text-align: center; margin-bottom: 8px; font-size: 1.5rem!important;">HQ, ABUJA</h2>
            <h2 class="bind-data"
                style="text-align: center; margin-bottom: 10px; margin-top: 0; font-size: 1.5rem!important;">{{$data->admin_segment->name ?? " "}}</h2>
            <h2 style="text-align: center; margin-bottom: 10px; margin-top: 0; font-size: 1.5rem!important;">Payment
                Voucher</h2>
        </div>


        <div class="width-90-per" style="margin: auto">
            <table style="margin-top: 30px; width: 100%">
                <tr>
                    <td>
                        <div style="font-size: 17px">
                            <label class="label_font_family">Deptal No: </label>
                            <input class="bind-data text_font_family" type="text" value="{{$data->deptalKey}}"
                                   style="text-align: center; font-weight: bold"/>
                        </div>
                    </td>
                    <td>
                    </td>
                    <td>
                        <div style="text-align: right; font-size: 17px">
                            <label class="label_font_family">Checked and passed for payment at : </label>
                            <input type="text" class="bind-data text_font_family"
                                   value="{{$data->default_setting->account_head->name ?? " "}}"
                                   style="text-align: center; font-weight: bold"/>
                        </div>
                    </td>
                </tr>
            </table>

            <table class="tableBordered iTableBordered width-100-per" style="margin-top: 10px">
                <tr>
                    <th colspan="3">Detail Type</th>
                    <th colspan="8">Voucher Number</th>
                    <th colspan="9" rowspan="2" class="border-none"></th>
                    <th colspan="13" rowspan="4" class="border-none">
                        <table class="table-bordered tableBordered width-100-per" style="margin-left: 3px">
                            <tr>
                                <td class="text-center">Station</td>
                                <th class="text-center">{{$data->default_setting->account_head->name ?? " "}}</th>
                            </tr>
                            <tr>
                                <td class="text-center" style="height: 30px">Admin</td>
                                <th class="text-left">{{$data->admin_segment->name ?? " "}}</th>
                            </tr>
                            <tr>
                                <td class="text-center">Economic</td>
                                <th class="text-left">{{$data->economic_segment->name ?? " "}}</th>
                            </tr>
                        </table>
                    </th>
                </tr>
                <tr>
                    <td colspan="3">VOI</td>
                    <td colspan="8">{{$data->id}}</td>
                </tr>
                <tr>
                    <th colspan="12">Administrative Segment</th>
                    <th colspan="8">Economic Segment</th>
                </tr>
                <tr>
                    @foreach($data->es_code as $var)
                        <td>{{$var}}</td>
                    @endforeach
                    @foreach($data->e_code as $var)
                        <td>{{$var}}</td>
                    @endforeach
                </tr>
                <tr>
                    <th colspan="{{count($data->f_code)}}">Functional Segment</th>
                    <th colspan="{{count($data->ps_code)}}">Programme Segment</th>
                    <th colspan="{{count($data->fs_code)}}">Fund Segment</th>
                    <th colspan="{{count($data->g_code)}}">Geo Code Segment</th>
                </tr>
                <tr>
                    @foreach($data->f_code as $var)
                        <td>{{$var}}</td>
                    @endforeach
                    @foreach($data->ps_code as $var)
                        <td>{{$var}}</td>
                    @endforeach

                    @foreach($data->fs_code as $var)
                        <td>{{$var}}</td>
                    @endforeach
                    @foreach($data->g_code as $var)
                        <td>{{$var}}</td>
                    @endforeach
                    {{--                    <td class="border-none"></td>--}}
                </tr>
                <tr>
                    <th colspan="8">Date</th>
                    <th colspan="11">Amount</th>
                </tr>
                <tr>
                    @foreach($data->date as $var)
                        <td>{{$var}}</td>
                    @endforeach
                    <td colspan="10">{{$data->total_amount_tax_sum}}</td>
                    <td class="table-bordered">{{$data->total_amount_tax_paisa}}</td>
                </tr>
            </table>
        </div>
        <table style="width: 100%; margin-top: 10px">
            <tr>
                <td style="width: 10%">Payee</td>
                <td><input type="text" style="width: 95%; font-weight: bold" class="bind-data"
                           value="{{strtoupper($data->final_payees_text)}}"></td>
            </tr>
            <tr>
                <td style="width: 10%">Address</td>
                <td style="width: 80%"><input type="text" style="width: 95%; font-weight: bold" class="bind-data"
                                              value="{{$data->address}}"></td>
            </tr>
        </table>
        <table style="width: 100%; margin-top: 40px;" class="table-bordered">
            <thead>
            <tr class="label_font_family">
                <td class="table-bordered" style="text-align: center;width: 10%; padding: 10px 0">Date</td>
                <td class="table-bordered" style="text-align: center;width: 60%; padding: 10px 0">Detail Description of
                    Service Work
                </td>
                <td class="table-bordered" style="text-align: center;width: 10%; padding: 10px 0">Rate</td>
                <th class="table-bordered" style="text-align: center;width: 15%; padding: 10px 0">N</th>
                <th class="table-bordered" style="text-align: center; width: 5%; padding: 10px 0">K</th>
            </tr>
            </thead>
            <tbody class="description_table">
            <?php  $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);?>
            @foreach($data->payee_vouchers as $payee)
                <tr style="font-weight: bold" class="text_font_family">
                    <td class="table-bordered bind-data"
                        style="text-align: center;vertical-align: baseline;padding: 10px">{{\Illuminate\Support\Carbon::parse($payee->created_at)->format('d/m/Y')}}</td>
                    <td class="table-bordered bind-data"
                        style="text-align: left;vertical-align: baseline; padding: 10px">
                        {{$payee->details}}
                    </td>
                    <td class="table-bordered bind-data"
                        style="text-align: center;vertical-align: baseline; padding: 10px">
                        1
                    </td>
                    <td class="table-bordered bind-data"
                        style="text-align: center;vertical-align: baseline; padding: 10px">
                        {{preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", explode('.', $payee->net_amount + $payee->total_tax)[0])}}
                    </td>
                    <td class="table-bordered bind-data"
                        style="text-align: center;vertical-align: baseline; padding: 10px">{{((explode('.', $payee->net_amount + $payee->total_tax)[1] ?? '00') * 10) === 0 ? '00' : (explode('.', $payee->net_amount+$payee->total_tax)[1] ?? '00') * 10}}
                    </td>

                </tr>
            @endforeach
            <tr style="font-weight: bold" class="text_font_family">
                <td class="table-bordered bind-data">&nbsp;</td>
                <td class="table-bordered bind-data">&nbsp;</td>
                <td class="table-bordered bind-data" style="text-align: center;vertical-align: baseline; padding: 10px">
                    <b>(less)</b></td>
                <td class="table-bordered bind-data">&nbsp;</td>
                <td class="table-bordered bind-data">&nbsp;</td>
            </tr>
            @if(count($data->all_tax) > 0)
                @foreach($data->all_tax as $key => $tax)
                    <tr style="font-weight: bold" class="text_font_family">
                        <td class="table-bordered bind-data"
                            style="text-align: center;vertical-align: baseline; padding: 10px">&nbsp;
                        </td>
                        <td class="table-bordered bind-data"
                            style="text-align: center;vertical-align: baseline; padding: 10px">&nbsp;
                        </td>
                        <td class="table-bordered bind-data"
                            style="text-align: center;vertical-align: baseline; padding: 10px">{{$key}}</td>
                        <td class="table-bordered bind-data"
                            style="text-align: center;vertical-align: baseline; padding: 10px">{{((explode('.', $tax)[0] ?? '00')) === 0 ? '00' : (explode('.', $tax)[0] ?? '00')}}</td>
                        <td class="table-bordered bind-data"
                            style="text-align: center;vertical-align: baseline; padding: 10px">{{((explode('.', $tax)[1] ?? '00') * 10) === 0 ? '00' : (explode('.', $tax)[1] ?? '00') * 10}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="table-bordered bind-data">&nbsp;</td>
                    <td class="table-bordered bind-data">&nbsp;</td>
                    <td class="table-bordered bind-data">&nbsp;</td>
                    <td class="table-bordered bind-data">&nbsp;</td>
                    <td class="table-bordered bind-data">&nbsp;</td>
                </tr>
                <tr>
                    <td class="table-bordered bind-data">&nbsp;</td>
                    <td class="table-bordered bind-data">&nbsp;</td>
                    <td class="table-bordered bind-data">&nbsp;</td>
                    <td class="table-bordered bind-data">&nbsp;</td>
                    <td class="table-bordered bind-data">&nbsp;</td>
                </tr>
            @endif
            <tr class="text_font_family">
                <td class="table-bordered" style="text-align: center;vertical-align: baseline; padding: 15px 10px"></td>
                <td class="table-bordered bind-data"
                    style="text-align: left;vertical-align: baseline; padding: 15px 10px">
                    Checked and &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Insert Amount
                    in words <br>
                    passed for : <span
                        style="font-weight: bold">{{isset($data->total_amount) ? ucfirst($f->format($data->total_amount->amount)) . ' Naira Only.': ' '}}</span>
                </td>
                <td class="table-bordered" style="text-align: center;">Total</td>
                <td class="table-bordered bind-data"
                    style="text-align: center; font-weight: bold">{{$data->amount}}</td>
                <td class="table-bordered bind-data"
                    style="text-align: center; font-weight: bold">{{$data->paisa}}</td>
            </tr>
            </tbody>
        </table>
        <table style="border-collapse: collapse">
            <tr>
                <td style="width: 50%; border: 1px solid #000; border-top: 0; vertical-align: baseline;">
                    <table style="width: 100%; padding: 0 10px">
                        <tr>
                            <td style="padding: 5px; width: 20%; vertical-align: bottom" class="label_font_family">
                                Payable at :
                            </td>
                            <td class="text-center border-bottom-only bind-data text-bold text_font_family"
                                style="padding: 5px; width: 80%">ABUJA
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px; width: 20%;vertical-align: bottom" class="label_font_family">
                                Signature
                            </td>
                            <td class="text-center border-bottom-only bind-data text-bold text_font_family"
                                style="padding: 5px; width: 80%"></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px;width: 20%;vertical-align: bottom" class="label_font_family ">Name
                                in Block letters
                            </td>
                            <td class="text-center border-bottom-only bind-data text-bold text_font_family"
                                style="padding: 5px;width: 80%">
                                {{strtoupper($data->checking_officer->first_name)}}
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 5px" colspan="2"></td>
                            <td colspan="2" class="text-center" style="padding: 5px">
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <div>
                                    <div style="width: 70%; float: left">
                                        <div style="width: 30%; float: left" class="label_font_family">Station</div>
                                        <div class="border-bottom-only text-center bind-data text_font_family text-bold"
                                             style="width: 70%; float: right">{{strtoupper($data->default_setting->account_head->name)  ?? " "}}
                                        </div>
                                    </div>
                                    <div style="width: 30%; float: right">
                                        <div style="width: 20%; float: left" class="label_font_family">
                                            Date
                                        </div>
                                        <div class="border-bottom-only text-center bind-data text_font_family text-bold"
                                             style="width: 80%; float: right">
                                            &nbsp;
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 5px;"></td>
                            <td class="text-center" style="padding: 5px; width: 80%">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%;vertical-align: bottom" class="label_font_family">Checking Officer's
                                Signature
                            </td>
                            <td class="text-center border-bottom-only text_font_family"
                                style="padding: 5px; width: 70%;"></td>
                        </tr>
                        <tr>
                            <td style="width: 20%;vertical-align: bottom" class="label_font_family">Name in Block
                                letters
                            </td>
                            <td class="text-center border-bottom-only bind-data text_font_family text-bold"
                                style="padding: 5px; width: 80%;">
                                {{strtoupper($data->checking_officer->first_name)}}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20%"></td>
                            <td class="text-center bind-data text_font_family"
                                style="padding: 5px; font-size: 14px; width: 80%;">GW/SW
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20%;vertical-align: center" class="label_font_family">Authy AIE No. etc.
                            </td>
                            <td class="bind-data text-bold text_font_family"
                                style="padding: 5px; width: 80%;">{{$data->aie->aie_number}}</td>
                        </tr>
                    </table>
                </td>
                <td style="width: 50%; padding: 5px 15px">
                    <table style="width: 100%;">
                        <tr>
                            <td style="text-align: center;" class="label_font_family">Certificate</td>
                        </tr>
                        <tr class="text_font_family">
                            <td>
                                <p style="margin-left: 10px">I certify that the above amount is correct, and was
                                    incurred under
                                    the
                                    Authority Quoted, that the
                                    services that have been duly performed; that rate/price charged is according to
                                    regulations.
                                    Contact
                                    is fair and reasonable.</p>
                            </td>
                        </tr>
                        <tr class="text_font_family">
                            <td style="display: flex">
		                        <span style="margin-left: 10px">That the amount of : <span class="text-bold bind-data"
                                                                                           style="margin-left:10px; font-size: 16px">{{isset($data->total_amount) ? ucfirst($f->format($data->total_amount->amount)) . ' Naira Only.': ' '}}</span></span>
                            </td>
                        </tr>
                        <tr>
                            <td style="height: 40px"></td>
                        </tr>
                        <tr class="text_font_family">
                            <td colspan="2">
                                <span style="margin-left: 10px">may be paid under the Classification Quoted,</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="height: 8px"></td>
                        </tr>
                        <tr class="text_font_family">
                            <td colspan="2" class="border-bottom-only">
                                <span class="text-bold bind-data"
                                      style="margin-left: 10px; font-size: 18px">{{$data->checking_officer->first_name}}</span>
                            </td>
                        </tr>
                        <tr class="text_font_family">
                            <td class="text-center"><span>Name/Signature of Officer Controlling Expenditure.</span></td>
                        </tr>
                        <tr class="text_font_family">
                            <td>
                                <table style="width: 100%; margin-top: 11px">
                                    <tr>
                                        <td style="width: 10%"><span style="margin-left: 10px">Place</span></td>
                                        <td style="width: 50%;"
                                            class="border-bottom-only text-center bind-data text-bold">{{$data->default_setting->account_head->name ?? " "}}
                                        </td>
                                        <td style="width: 10%; text-align: right">Date</td>
                                        <td style="width: 30%;"
                                            class="border-bottom-only text-center bind-data text-bold"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="text_font_family">
                            <td>
                                <table style="width: 100%">
                                    <tr>
                                        <td style="width: 10%"><span style="margin-left: 10px">Designation</span></td>
                                        <td style="width: 80%;"
                                            class="border-bottom-only text-center bind-data text-bold">MD/CEO
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table style="width: 100%; margin-top: 20px; margin-bottom: 10px">
            <tr class="text_font_family">
                <td>
                    <span style="margin-right: 10px">Received from the:</span><span
                        style="font-weight: 600">HQ, ABUJA</span>
                </td>
                <td style="text-align: right;">
                    the sum of
                </td>
                <td class="border-bottom-only" style="width: 50%;">
                </td>
            </tr>
        </table>
        <table style="width: 100%">
            <tr class="text_font_family">
                <td class="border-bottom-only" style="width: 50%"></td>
                <td style="width: 50%;">in the full settlement of the Amount.</td>
            </tr>
        </table>
        <table style="width: 100%; margin-top: 10px; margin-bottom: 20px">
            <tr>
                <td style="width: 75%"></td>
                <td class="border-bottom-only" style="width: 25%"></td>
            </tr>
            <tr class="text_font_family">
                <td style="width: 75%"></td>
                <td style="text-align: center; width: 25%">
                    <span style="margin-right: 10px">Signature</span>
                </td>
            </tr>
        </table>
        <table style="width: 100%">
            <tr class="text_font_family">
                <td class="table-bordered text-bold" style="width: 15%; padding: 10px 0">N</td>
                <td class="table-bordered text-bold" style="width: 15%; text-align: right; padding: 10px 0">K</td>
                <td style="width: 16%;text-align: right;vertical-align: bottom;">Date
                </td>
                <td style="width: 16%;" class="border-bottom-only"></td>
                <td style="width: 16%; vertical-align: bottom; text-align: right">Place</td>
                <td class="border-bottom-only" style="width: 16%;"></td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>

