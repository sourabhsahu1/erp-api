<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-wi  dth, initial-scale=1.0">
    <title>Payment Voucher - Tax Voucher</title>
    <style>
        .text-bold {
            font-weight: 600;
        }

        body{
            font-size: 15px;
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
            font-weight: bold;
        }
    </style>
</head>
<body>
<div style="width: 90%; height: auto; margin: 0px auto;">
    <div style="width: 100%; padding-top: 50px; padding-bottom: 50px">
        <div>
            <h2 style="text-align: center; margin-top: -30px;">DSCHC</h2>
            <h2 style="text-align: center; margin-top: -20px; margin-bottom: 0;">{{$data->admin_segment->name ?? " "}}</h2>
            <h2 style="text-align: center; margin-top: 0; margin-bottom: 0;">Payment Voucher</h2>
        </div>
        <table style="margin-top: 30px; width: 100%">
            <tr>
                <td>
                    <div style="font-size: 17px">
                        <label>Deptal No: </label>
                        <input type="text" class="bind-data" value="{{$data->deptal_id}}"/>
                    </div>
                </td>
                <td>
                </td>
                <td>
                    <div style="text-align: right; font-size: 17px">
                        <label>Checked and passed for payment at : </label>
                        <input type="text" class="bind-data" value="{{\Illuminate\Support\Carbon::parse($data->value_date)->toDateString()}}"/>
                    </div>
                </td>
            </tr>
        </table>
        <table style="margin-top: 30px; width: 100%">
            <tr>
                <td>
                    <table>
                        <tr>
                            <td style="width: 250px; text-align: center">
                                <table class="width-100-per table-bordered" style="margin-left: -3px">
                                    <tr>
                                        <td class="text-center table-bordered"><label>Detail Type</label></td>
                                        <td class="text-center table-bordered" colspan="8"><label>Voucher Number</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-bordered"><label>VOI</label></td>
                                        <td class="table-bordered bind-data">{{$data->id}}</td>
                                        <!-- <td class="table-bordered">E</td>
                                        <td class="table-bordered">X</td>
                                        <td class="table-bordered">1</td>
                                        <td class="table-bordered">0</td>
                                        <td class="table-bordered">0</td>
                                        <td class="table-bordered">0</td>
                                        <td class="table-bordered">5</td> -->
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
                                <label>Station</label>
                            </td>
                            <td style="width: 300px; text-align: center" class="table-bordered bind-data">
                                <div style="font-size: 18px;">
                                    <label>{{$data->default_setting->account_head->name ?? " "}}</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 120px; text-align: center;" class="table-bordered">
                                <label>Admin</label>
                            </td>
                            <td style="width: 300px; text-align: center" class="table-bordered bind-data">
                                <div style="font-size: 18px;">
                                    <label>{{$data->admin_segment->name ?? " "}}</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 120px; text-align: center;" class="table-bordered">
                                <label>Economic</label>
                            </td>
                            <td style="width: 300px; text-align: center" class="table-bordered bind-data">
                                <div style="font-size: 18px;">
                                    <label>{{$data->economic_segment->name ?? " "}}</label>
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
                            <td style="text-align: center; width: 50%" class="table-bordered bind-data" colspan="{{strlen(str_replace('-','',$data->admin_segment->combined_code)) + 4}}">
                                <label>Administrative Segment</label>
                            </td>
                            <td style="text-align: center; width: 50%" class="table-bordered bind-data" colspan="{{strlen(str_replace('-','',$data->economic_segment->combined_code)) + 1}}">
                                <label>Economic Segment</label>
                            </td>
                        </tr>
                        <tr>
                            @foreach(str_split(str_replace('-','',$data->admin_segment->combined_code)) as $var)
                                <td class="table-bordered width-10px bind-data" style="text-align: center;">{{$var}}</td>
                            @endforeach
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
                            <td class="table-bordered width-10px" style="text-align: center;"></td>

                            @foreach(str_split(str_replace('-','',$data->economic_segment->combined_code)) as $var)
                                <td class="table-bordered width-10px bind-data" style="text-align: center;">{{$var}}</td>
                            @endforeach
                            <td class="table-bordered width-10px bind-data" style="text-align: center;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table style="margin-top:-7px; width: 100%">
            <tr>
                <td>
                    <table style="width: 100%" class="table-bordered">
                        <tr>
                            <td class="table-bordered bind-data" style="text-align: center; width: 25%" colspan="{{strlen(str_replace('-','',$data->functional_segment->combined_code)) + 3}}">
                                <label>Functional Segment</label>
                            </td>
                            <td class="table-bordered bind-data" style="text-align: center; width: 25%" colspan="{{strlen(str_replace('-','',$data->program_segment->combined_code)) + 1}}">
                                <label>Programme Segment</label>
                            </td>
                            <td class="table-bordered bind-data" style="text-align: center; width: 25%" colspan="{{strlen(str_replace('-','',$data->fund_segment->combined_code)) + 4}}">
                                <label>Fund Segment</label>
                            </td>
                            <td class="table-bordered bind-data" style="text-align: center; width: 25%" colspan="{{strlen(str_replace('-','',$data->geo_code_segment->combined_code)) + 4}}">
                                <label>Geo Code Segment</label>
                            </td>
                        </tr>
                        <tr>
                            @foreach(str_split(str_replace('-','',$data->functional_segment->combined_code)) as $var)
                                <td class="table-bordered width-10px bind-data" style="text-align: center;">{{$var}}</td>
                            @endforeach
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
                            <td class="table-bordered width-10px" style="text-align: center;"></td>

                            @foreach(str_split(str_replace('-','',$data->program_segment->combined_code)) as $var)
                                <td class="table-bordered width-10px bind-data" style="text-align: center;">{{$var}}</td>
                            @endforeach
                            <td class="table-bordered width-10px" style="text-align: center;"></td>


                            @foreach(str_split(str_replace('-','',$data->fund_segment->combined_code)) as $var)
                                <td class="table-bordered width-10px bind-data" style="text-align: center;">{{$var}}</td>
                            @endforeach
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
                            <td class="table-bordered width-10px" style="text-align: center;"></td>

                            @foreach(str_split(str_replace('-','',$data->geo_code_segment->combined_code)) as $var)
                                <td class="table-bordered width-10px bind-data" style="text-align: center;">{{$var}}</td>
                            @endforeach
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
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
                                        <td class="text-center table-bordered" colspan="2"><label>Amount (Naira)</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        @foreach(str_split(str_replace('-','',\Illuminate\Support\Carbon::parse($data->value_date)->toDateString())) as $var)
                                        <td class="table-bordered bind-data">{{$var}}</td>
                                        @endforeach
                                        <td class="table-bordered bind-data">{{$data->total_tax->tax ?? ' '}}</td>
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
                <td><input type="text" class="bind-data" style="width: 95%" value="{{strtoupper($data->final_payees_text)}}"></td>
            </tr>
            <tr>
                <td style="width: 10%">Address</td>
                <td style="width: 80%"><input type="text" class="bind-data" style="width: 95%" value="{{$data->address}}"></td>
            </tr>
        </table>
        <table style="width: 100%; margin-top: 40px;" class="table-bordered">
            <thead>
            <tr>
                <th class="table-bordered" style="text-align: center;">Date</th>
                <th class="table-bordered" style="text-align: center;">Name</th>
                <th class="table-bordered" style="text-align: center;">Detail Description of Service Work</th>
                <th class="table-bordered" style="text-align: center;">Rate</th>
                <th class="table-bordered" style="text-align: center;">N</th>
                <th class="table-bordered" style="text-align: center;">K</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data->payee_vouchers as $payee)
            <tr>
                <td class="table-bordered bind-data" style="text-align: center;">{{\Illuminate\Support\Carbon::parse($payee->created_at)->toDateString()}}</td>
                <td class="table-bordered bind-data" style="text-align: center;">{{isset($payee->company_id) ? $payee->admin_company->name : $payee->employee->first_name .' '.$payee->employee->last_name}}</td>
                <td class="table-bordered bind-data" style="text-align: center;">{{$payee->details}}</td>
                <td class="table-bordered bind-data" style="text-align: center;">{{1}}</td>
                <td class="table-bordered bind-data" style="text-align: center;">{{$payee->total_tax}}</td>
                <td class="table-bordered" style="text-align: center;">00</td>
            </tr>
            @endforeach

            <tr>
                <td class="table-bordered" style="text-align: center;"></td>
                <?php  $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);?>
                <td class="table-bordered bind-data" style="text-align: center;">
                    Checked and Insert Amount in words
                    passed for : {{isset($data->total_tax->tax) ? ucfirst($f->format($data->total_tax->tax)) . 'Naira Only.': ' '}}
                </td>
                <td class="table-bordered" style="text-align: center;">Total</td>
                <td class="table-bordered bind-data" style="text-align: center;">{{$data->total_tax->tax ?? ' '}}</td>
                <td class="table-bordered" style="text-align: center;">00</td>
            </tr>
            </tbody>
        </table>
        <table>
            <tr>
                <td style="width: 50%">
                    <table style="width: 100%; margin-top: -5px; border: 1px solid #a0a0a0; padding: 20px">
                        <tr>
                            <td style="padding: 5px" colspan="2">Payable at :</td>
                            <td colspan="2" class="text-center border-bottom-only bind-data" style="padding: 5px">{{$data->default_setting->account_head->name ?? " "}}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px" colspan="2">Signature</td>
                            <td colspan="2" class="text-center border-bottom-only bind-data" style="padding: 5px"></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px" colspan="2">Name in Block letters</td>
                            <td colspan="2" class="text-center border-bottom-only bind-data" style="padding: 5px">
                            {{strtoupper($data->checking_officer->first_name)}}
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 5px" colspan="2"></td>
                            <td colspan="2" class="text-center" style="padding: 5px">
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 10%;">Station</td>
                            <td class="text-center border-bottom-only bind-data" style="width: 50%; font-size: 12px">{{strtoupper($data->default_setting->account_head->name)  ?? " "}}</td>
                            <td style="width: 10%;">Date</td>
                            <td class="text-center border-bottom-only" style="width: 30%; padding: 5px"></td>
                        </tr>

                        <tr>
                            <td style="padding: 5px" colspan="2"></td>
                            <td colspan="2" class="text-center" style="padding: 5px">
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">Checking Officer's Signature</td>
                            <td colspan="2" class="text-center border-bottom-only" style="padding: 5px"></td>
                        </tr>

                        <tr>
                            <td colspan="2">Name in Block letters</td>
                            <td colspan="2" class="text-center border-bottom-only bind-data" style="padding: 5px">{{strtoupper($data->checking_officer->first_name)}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2" class="text-center border-bottom-only" style="padding-bottom: 5px; font-size: 10px">GW/SW</td>
                        </tr>
                        <tr>
                            <td colspan="2">Authy AIE No. etc.</td>
                            <td class="bind-data" colspan="2" style="padding: 5px">{{$data->aie->aie_number}}</td>
                        </tr>
                    </table>
                </td>
                <td style="width: 50%">
                    <table style="width: 100%; margin-top: -2px;">
                        <tr>
                            <td style="text-align: center">Certificate</td>
                        </tr>
                        <tr>
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
                        <tr>
                            <td style="display: flex">
		                        <span style="margin-left: 10px">That the amount of : <span class="text-bold bind-data"
                                                                                           style="margin-left:10px; font-size: 13px">{{isset($data->total_tax) ? ucfirst($f->format($data->total_tax->tax)) . ' Naira Only.': ' '}}</span></span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span style="margin-left: 10px">may be paid under the Classification Quoted</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="border-bottom-only">
                                <span class="text-bold bind-data" style="margin-left: 10px;">{{$data->checking_officer->first_name}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center"><small>Name/Signature of Approving Officer</small></td>
                        </tr>
                        <tr>
                            <td>
                                <table style="width: 100%; margin-top: 20px">
                                    <tr>
                                        <td style="width: 10%"><span style="margin-left: 10px">Place</span></td>
                                        <td style="width: 50%;" class="border-bottom-only text-center bind-data">{{$data->default_setting->account_head->name ?? " "}}</td>
                                        <td style="width: 10%; text-align: right">Date</td>
                                        <td style="width: 30%;" class="border-bottom-only"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="width: 100%">
                                    <tr>
                                        <td style="width: 10%"><span style="margin-left: 10px">Designation</span></td>
                                        <td style="width: 80%;" class="border-bottom-only"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table style="width: 100%; margin-top: 20px; margin-bottom: 10px">
            <tr>
                <td>
                    <span style="margin-right: 10px">Received from the:</span><span style="font-weight: 600">DSCHC</span>
                </td>
                <td style="text-align: right">
                    the sum of
                </td>
                <td class="border-bottom-only" style="width: 50%">
                </td>
            </tr>
        </table>
        <table style="width: 100%">
            <tr>
                <td class="border-bottom-only" style="width: 50%">asdasd</td>
                <td style="width: 50%;">in the full settlement of the Amount.</td>
            </tr>
        </table>
        <table style="width: 100%; margin-top: 20px; margin-bottom: 20px">
            <tr>
                <td style="width: 75%"></td>
                <td class="border-bottom-only" style="width: 25%"></td>
            </tr>
            <tr>
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


