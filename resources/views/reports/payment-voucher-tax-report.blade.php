<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-wi  dth, initial-scale=1.0">
    <title>Payment Voucher</title>
    <style>
        *{
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
    </style>
</head>
<body>
<div style="width: 90%; height: auto; margin: 0px auto;">
    <div style="width: 100%; padding-top: 40px; padding-bottom: 50px">
        <div style="display: flex; justify-content: space-between; margin-bottom: 3rem" class="text_font_family">
            <div style="font-weight: bold">ORIGINAL</div>
            <div>Treasury</div>
        </div>
        <div class="label_font_family">
            <h2 style="text-align: center; margin-top: -30px; font-size: 1.5rem!important;">HQ, ABUJA</h2>
            <h2 class="bind-data"
                style="text-align: center; margin-top: -15px; margin-bottom: 0;font-size: 1.2rem!important;">{{$data->admin_segment->name ?? " "}}</h2>
            <h2 style="text-align: center; margin-top: 0; margin-bottom: 0;font-size: 1.5rem!important;">Capital Expdtr. Pymt Voucher</h2>
        </div>
        <table style="margin-top: 30px; width: 100%">
            <tr>
                <td>
                    <div style="font-size: 17px">
                        <label class="label_font_family">Deptal No: </label>
                        <input class="bind-data text_font_family" type="text" value="{{$data->deptal_id}}"
                               style="text-align: center; font-weight: bold"/>
                    </div>
                </td>
                <td>
                </td>
                <td>
                    <div style="text-align: right; font-size: 17px">
                        <label class="label_font_family">Checked and passed for payment at : </label>
                        <input type="text" class="bind-data text_font_family"
                               value="{{\Illuminate\Support\Carbon::parse($data->value_date)->toDateString()}}"
                               style="text-align: center; font-weight: bold"/>
                    </div>
                </td>
            </tr>
        </table>
        <table style="margin-top: 30px; width: 100%">
            <tr>
                <td>
                    <table>
                        <tr>
                            <td style="width: 300px; text-align: center">
                                <table class="width-100-per table-bordered" style="margin-left: -3px">
                                    <tr>
                                        <td class="text-center table-bordered" style="width: 15px;"><label class="label_font_family">Detail
                                                Type</label></td>
                                        <td class="text-center table-bordered"><label
                                                class="label_font_family">Voucher Number</label>
                                        </td>
                                    </tr>
                                    <tr style="font-weight: bold">
                                        <td class="table-bordered" style="padding: 10px 0"><label
                                                class="label_font_family">VOI</label></td>
                                        <td class="table-bordered text_font_family bind-data"
                                            style="width: 20px">{{$data->id}}</td>
                                        {{--                                        <td class="table-bordered text_font_family" style="width: 20px">E</td>--}}
                                        {{--                                        <td class="table-bordered text_font_family" style="width: 20px">X</td>--}}
                                        {{--                                        <td class="table-bordered text_font_family" style="width: 20px">1</td>--}}
                                        {{--                                        <td class="table-bordered text_font_family" style="width: 20px">0</td>--}}
                                        {{--                                        <td class="table-bordered text_font_family" style="width: 20px">0</td>--}}
                                        {{--                                        <td class="table-bordered text_font_family" style="width: 20px">0</td>--}}
                                        {{--                                        <td class="table-bordered text_font_family" style="width: 20px">5</td>--}}
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="text-align: center">
                    <table style="width: 100%; margin-top: 15px" class="table-bordered">
                        <tr>
                            <td style="width: 120px; text-align: center;" class="table-bordered">
                                <label class="label_font_family">Station</label>
                            </td>
                            <td style="width: 300px; text-align: center" class="table-bordered bind-data">
                                <div style="font-weight: bold;">
                                    <label
                                        class="text_font_family">{{$data->default_setting->account_head->name ?? " "}}</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 120px; padding: 10px 0; text-align: center;" class="table-bordered">
                                <label class="label_font_family">Admin</label>
                            </td>
                            <td style="width: 300px; text-align: center" class="table-bordered bind-data">
                                <div style="padding: 10px 0; font-weight: bold;">
                                    <label class="text_font_family">{{$data->admin_segment->name ?? " "}}</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 120px; text-align: center;" class="table-bordered">
                                <label class="label_font_family">Economic</label>
                            </td>
                            <td style="width: 300px; text-align: center" class="table-bordered bind-data">
                                <div style=" font-weight: bold; text-align: left">
                                    <label class="text_font_family">{{$data->economic_segment->name ?? " "}}</label>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>

                <td>
                    <table style="width: 100%; margin-top: -20px;" class="table-bordered">
                        <tr>
                            <td style="text-align: center; width: 60%" class="table-bordered bind-data" colspan="12">
                                <label class="label_font_family">Administrative Segment</label>
                            </td>
                            <td style="text-align: center; width: 40%" class="table-bordered bind-data" colspan="8">
                                <label class="label_font_family">Economic Segment</label>
                            </td>
                        </tr>
                        <tr style="font-weight: bold" class="text_font_family">
                            @foreach(str_split(str_replace('-','',$data->admin_segment->combined_code)) as $var)
                                <td class="table-bordered width-10px bind-data"
                                    style="text-align: center; padding: 10px 0">{{$var}}</td>
                            @endforeach

                            <td class="table-bordered width-10px" style="text-align: center; padding: 10px 0"></td>
                            <td class="table-bordered width-10px" style="text-align: center; padding: 10px 0"></td>
                            <td class="table-bordered width-10px" style="text-align: center; padding: 10px 0"></td>
                            <td class="table-bordered width-10px" style="text-align: center; padding: 10px 0"></td>

                            @foreach(str_split(str_replace('-','',$data->economic_segment->combined_code)) as $var)
                                <td class="table-bordered width-10px"
                                    style="text-align: center; padding: 10px 0">{{$var}}</td>
                            @endforeach
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table style="margin-top:-7px; width: 100%">
            <tr>
                <td>
                    <table style="width: 89.5%" class="table-bordered">
                        <tr>
                            <td class="table-bordered bind-data" style="text-align: center; width: 15%" colspan="{{strlen(str_replace('-','',$data->functional_segment->combined_code)) + 3}}">
                                <label class="label_font_family">Functional Segment</label>
                            </td>
                            <td class="table-bordered bind-data" style="text-align: center; width: 15%" colspan="{{strlen(str_replace('-','',$data->program_segment->combined_code)) + 1}}">
                                <label class="label_font_family">Programme Segment</label>
                            </td>
                            <td class="table-bordered bind-data" style="text-align: center; width: 15%" colspan="{{strlen(str_replace('-','',$data->fund_segment->combined_code)) + 4}}">
                                <label class="label_font_family">Fund Segment</label>
                            </td>
                            <td class="table-bordered bind-data" style="text-align: center; width: 25%" colspan="{{strlen(str_replace('-','',$data->geo_code_segment->combined_code)) + 4}}">
                                <label class="label_font_family">Geo Code Segment</label>
                            </td>
                        </tr>
                        <tr style="font-weight: bold" class="text_font_family">
                            @foreach(str_split(str_replace('-','',$data->functional_segment->combined_code)) as $var)
                                <td class="table-bordered width-10px bind-data"
                                    style="text-align: center; padding: 10px 0;">{{$var}}
                                </td>
                            @endforeach
                            <td class="table-bordered width-10px" style="text-align: center; padding: 10px 0;"></td>
                            <td class="table-bordered width-10px" style="text-align: center; padding: 10px 0;"></td>
                            <td class="table-bordered width-10px" style="text-align: center; padding: 10px 0;"></td>
                            @foreach(str_split(str_replace('-','',$data->program_segment->combined_code)) as $var)
                                <td class="table-bordered width-10px bind-data"
                                    style="text-align: center; padding: 10px 0;">{{$var}}
                                </td>
                            @endforeach
                            <td class="table-bordered width-10px"
                                style="text-align: center; padding: 10px 0;"></td>
                            @foreach(str_split(str_replace('-','',$data->fund_segment->combined_code)) as $var)
                                <td class="table-bordered width-10px bind-data"
                                    style="text-align: center; padding: 10px 0;">{{$var}}
                                </td>
                            @endforeach
                            <td class="table-bordered width-10px" style="text-align: center; padding: 10px 0;"></td>
                            <td class="table-bordered width-10px" style="text-align: center; padding: 10px 0;"></td>
                            <td class="table-bordered width-10px" style="text-align: center; padding: 10px 0;"></td>
                            <td class="table-bordered width-10px" style="text-align: center; padding: 10px 0;"></td>
                            @foreach(str_split(str_replace('-','',$data->geo_code_segment->combined_code)) as $var)
                                <td class="table-bordered width-10px bind-data" style="text-align: center; padding: 10px 0;">{{$var}}</td>
                            @endforeach
                            <td class="table-bordered width-10px" style="text-align: center; padding: 10px 0;"></td>
                            <td class="table-bordered width-10px" style="text-align: center; padding: 10px 0;"></td>
                            <td class="table-bordered width-10px" style="text-align: center; padding: 10px 0;"></td>
                            <td class="table-bordered width-10px" style="text-align: center; padding: 10px 0;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td style="width: 500px; text-align: center">
                                <table class="width-100-per table-bordered" style="margin-left: -3px; margin-top: -8px">
                                    <tr>
                                        <td class="text-center table-bordered bind-data" colspan="{{strlen(str_replace('-','',\Illuminate\Support\Carbon::parse($data->value_date)->toDateString()))}}"><label>Date</label></td>
                                        <td class="text-center table-bordered bind-data" colspan="2"><label>Amount (Naira)</label>
                                        </td>
                                    </tr>
                                    <tr style="font-weight: bold" class="text_font_family">
                                        @foreach(str_split(str_replace('-','',\Illuminate\Support\Carbon::parse($data->value_date)->toDateString())) as $var)
                                            <td class="table-bordered bind-data" style="text-align: center; padding: 10px 0;">{{$var}}</td>
                                        @endforeach
                                        <td class="table-bordered bind-data" style="text-align: center; padding: 10px 0;">{{$data->total_tax->tax ?? ' ' ?? ' '}}</td>
                                        <td class="table-bordered">00</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table style="width: 100%; margin-top: 10px">
            <tr>
                <td style="width: 10%">Payee</td>
                <td><input type="text" style="width: 95%; font-weight: bold" class="bind-data"
                           value="{{strtoupper($data->final_payees_text)}}"></td>
            </tr>
            <tr>
                <td style="width: 10%">Address</td>
                <td style="width: 80%"><input type="text" style="width: 95%; font-weight: bold" class="bind-data" value="{{$data->address}}"></td>
            </tr>
        </table>
        <table style="width: 100%; margin-top: 40px;" class="table-bordered">
            <thead>
            <tr class="label_font_family">
                <td class="table-bordered" style="text-align: center;width: 10%; padding: 10px 0">Date</td>
                <td class="table-bordered" style="text-align: center;width: 10%; padding: 10px 0">Name</td>
                <td class="table-bordered" style="text-align: center;width: 60%; padding: 10px 0">Detail Description of
                    Service Work
                </td>
                <td class="table-bordered" style="text-align: center;width: 10%; padding: 10px 0">Rate</td>
                <th class="table-bordered" style="text-align: center;width: 15%; padding: 10px 0">N</th>
                <th class="table-bordered" style="text-align: center; width: 5%; padding: 10px 0">K</th>
            </tr>
            </thead>
            <tbody>
            <?php  $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);?>
            @foreach($data->payee_vouchers as $payee)
                <tr style="font-weight: bold" class="text_font_family">
                    <td class="table-bordered bind-data" style="text-align: center;vertical-align: baseline;padding: 10px">{{\Illuminate\Support\Carbon::parse($payee->created_at)->toDateString()}}</td>
                    <td class="table-bordered bind-data" style="text-align: left;vertical-align: baseline; padding: 10px">{{isset($payee->company_id) ? $payee->admin_company->name : $payee->employee->first_name .' '.$payee->employee->last_name}}</td>
                    <td class="table-bordered bind-data" style="text-align: center;vertical-align: baseline; padding: 10px">
                        {{$payee->details}}
                    </td>
                    <td class="table-bordered bind-data" style="text-align: center;vertical-align: baseline; padding: 10px">
                        1
                    </td>
                    <td class="table-bordered bind-data" style="text-align: center;vertical-align: baseline; padding: 10px">
                        {{$payee->total_tax}}
                    </td>
                    <td class="table-bordered bind-data" style="text-align: center;vertical-align: baseline; padding: 10px">00
                    </td>
                </tr>
            @endforeach
            <tr class="text_font_family">
                <td class="table-bordered" style="text-align: center;vertical-align: baseline; padding: 15px 10px"></td>
                <td class="table-bordered" style="text-align: center;vertical-align: baseline; padding: 15px 10px"></td>
                <td class="table-bordered bind-data"
                    style="text-align: left;vertical-align: baseline; padding: 15px 10px">
                    Checked and &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Insert Amount
                    in words <br>
                    passed for : <span style="font-weight: bold">{{isset($data->total_tax) ? ucfirst($f->format($data->total_tax->tax)) . ' Naira Only.': ' '}}</span>
                </td>
                <td class="table-bordered" style="text-align: center;">Total</td>
                <td class="table-bordered bind-data" style="text-align: center; font-weight: bold">{{$data->total_tax->tax}}</td>
                <td class="table-bordered bind-data" style="text-align: center; font-weight: bold">00</td>
            </tr>
            </tbody>
        </table>
        <table style="border-collapse: collapse">
            <tr>
                <td style="width: 50%; border: 1px solid #000; border-top: 0">
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
                                <div style="display: flex; flex-flow: row">
                                    <div style="display: flex; flex-flow: row; width: 70%">
                                        <div style="width: 30%" class="label_font_family">Station</div>
                                        <div class="border-bottom-only text-center bind-data text_font_family text-bold" style="width: 70%">{{strtoupper($data->default_setting->account_head->name)  ?? " "}}
                                        </div>
                                    </div>
                                    <div style="display: flex; flex-flow: row; width: 30%">
                                        <div style="width: 20%" class="label_font_family">
                                            Date
                                        </div>
                                        <div class="border-bottom-only text-center bind-data text_font_family text-bold"
                                             style="width: 80%">

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
                            <td class="bind-data text-bold text_font_family" style="padding: 5px; width: 80%;">{{$data->aie->aie_number}}</td>
                        </tr>
                    </table>
                </td>
                <td style="width: 50%; padding: 15px">
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
                                                                                           style="margin-left:10px; font-size: 16px">{{isset($data->total_tax) ? ucfirst($f->format($data->total_tax->tax)) . ' Naira Only.': ' '}}</span></span>
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
                                <span class="text-bold bind-data" style="margin-left: 10px; font-size: 18px">{{$data->checking_officer->first_name}}</span>
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
    </div>
</div>
</body>
</html>


