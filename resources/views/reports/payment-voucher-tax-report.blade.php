<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Voucher - Tax Voucher</title>
    <style>
        .text-bold {
            font-weight: 600;
        }

        input {
            border: none !important;
            box-shadow: 0 1px 0 0 #000;
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
    </style>
</head>
<body>
<div style="width: 90%; height: auto; margin: 0px auto;">
    <div style="width: 100%; padding-top: 50px; padding-bottom: 50px">
        <div>
            <h2 style="text-align: center; margin-top: -30px;">DSCHC</h2>
            <h2 style="text-align: center; margin-top: -20px; margin-bottom: 0;">Delta State Contributory Health Commission</h2>
            <h2 style="text-align: center; margin-top: 0; margin-bottom: 0;">Payment Voucher</h2>
        </div>
        <table style="margin-top: 30px; width: 100%">
            <tr>
                <td>
                    <div style="font-size: 18px">
                        <label>Deptal No: </label>
                        <input type="text" value="{{$data->deptal_id}}"/>
                    </div>
                </td>
                <td>
                </td>
                <td>
                    <div style="text-align: right; font-size: 18px">
                        <label>Checked and passed for payment at : </label>
                        <input type="text" value="{{$data->updated_at}}"/>
                    </div>
                </td>
            </tr>
        </table>
        <table style="margin-top: 30px; width: 100%">
            <tr>
                <td>
                    <table>
                        <tr>
                            <td style="width: 500px; text-align: center">
                                <table class="width-100-per table-bordered" style="margin-left: -3px">
                                    <tr>
                                        <td class="text-center table-bordered"><label>Detail Type</label></td>
                                        <td class="text-center table-bordered" colspan="8"><label>Voucher Number</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-bordered"><label>VOI</label></td>
                                        <td class="table-bordered">{{$data->id}}</td>
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
                    <table style="width: 100%" class="table-bordered">
                        <tr>
                            <td style="width: 120px; text-align: center;" class="table-bordered">
                                <label>Station</label>
                            </td>
                            <td style="width: 300px; text-align: center" class="table-bordered">
                                <div style="font-size: 18px;">
                                    <label>{{$data->default_setting->account_head->name ?? " "}}</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 120px; text-align: center;" class="table-bordered">
                                <label>Admin</label>
                            </td>
                            <td style="width: 300px; text-align: center" class="table-bordered">
                                <div style="font-size: 18px;">
                                    <label>{{$data->admin_segment->name ?? " "}}</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 120px; text-align: center;" class="table-bordered">
                                <label>Economic</label>
                            </td>
                            <td style="width: 300px; text-align: center" class="table-bordered">
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
                            <td style="text-align: center; width: 50%" class="table-bordered" colspan="11">
                                <label>Administrative Segment</label>
                            </td>
                            <td style="text-align: center; width: 50%" class="table-bordered" colspan="9">
                                <label>Economic Segment</label>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-bordered width-10px" style="text-align: center;">{{$data->admin_segment->name ?? " "}}</td>
                            <!-- <td class="table-bordered width-10px" style="text-align: center;">5</td>
                            <td class="table-bordered width-10px" style="text-align: center;">2</td>
                            <td class="table-bordered width-10px" style="text-align: center;">1</td>
                            <td class="table-bordered width-10px" style="text-align: center;">0</td>
                            <td class="table-bordered width-10px" style="text-align: center;">0</td>
                            <td class="table-bordered width-10px" style="text-align: center;">2</td> -->
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
                            <td class="table-bordered width-10px" style="text-align: center;">{{$data->economic_segment->name ?? " "}}</td>
                            <!-- <td class="table-bordered width-10px" style="text-align: center;">1</td>
                            <td class="table-bordered width-10px" style="text-align: center;">0</td>
                            <td class="table-bordered width-10px" style="text-align: center;">1</td>
                            <td class="table-bordered width-10px" style="text-align: center;">0</td>
                            <td class="table-bordered width-10px" style="text-align: center;">1</td>
                            <td class="table-bordered width-10px" style="text-align: center;">0</td>
                            <td class="table-bordered width-10px" style="text-align: center;">3</td> -->
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
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
                            <td class="table-bordered" style="text-align: center; width: 25%" colspan="11">
                                <label>Functional Segment</label>
                            </td>
                            <td class="table-bordered" style="text-align: center; width: 25%" colspan="9">
                                <label>Programme Segment</label>
                            </td>
                            <td class="table-bordered" style="text-align: center; width: 25%" colspan="11">
                                <label>Fund Segment</label>
                            </td>
                            <td class="table-bordered" style="text-align: center; width: 25%" colspan="11">
                                <label>Geo Code Segment</label>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-bordered width-10px" style="text-align: center;">{{$data->functional_segment->name ?? " "}}</td>
                            <!-- <td class="table-bordered width-10px" style="text-align: center;">5</td>
                            <td class="table-bordered width-10px" style="text-align: center;">2</td>
                            <td class="table-bordered width-10px" style="text-align: center;">1</td>
                            <td class="table-bordered width-10px" style="text-align: center;">0</td>
                            <td class="table-bordered width-10px" style="text-align: center;">0</td>
                            <td class="table-bordered width-10px" style="text-align: center;">2</td> -->
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
                            <td class="table-bordered width-10px" style="text-align: center;"></td>

                            <td class="table-bordered width-10px" style="text-align: center;">{{$data->program_segment->name ?? " "}}</td>
                            <!-- <td class="table-bordered width-10px" style="text-align: center;">1</td>
                            <td class="table-bordered width-10px" style="text-align: center;">0</td>
                            <td class="table-bordered width-10px" style="text-align: center;">1</td>
                            <td class="table-bordered width-10px" style="text-align: center;">0</td>
                            <td class="table-bordered width-10px" style="text-align: center;">1</td>
                            <td class="table-bordered width-10px" style="text-align: center;">0</td>
                            <td class="table-bordered width-10px" style="text-align: center;">3</td> -->
                            <td class="table-bordered width-10px" style="text-align: center;"></td>

                            <td class="table-bordered width-10px" style="text-align: center;">{{$data->fund_segment->name ?? " "}}</td>
                            <!-- <td class="table-bordered width-10px" style="text-align: center;">5</td>
                            <td class="table-bordered width-10px" style="text-align: center;">2</td>
                            <td class="table-bordered width-10px" style="text-align: center;">1</td>
                            <td class="table-bordered width-10px" style="text-align: center;">0</td>
                            <td class="table-bordered width-10px" style="text-align: center;">0</td>
                            <td class="table-bordered width-10px" style="text-align: center;">2</td> -->
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
                            <td class="table-bordered width-10px" style="text-align: center;"></td>
                            <td class="table-bordered width-10px" style="text-align: center;"></td>

                            <td class="table-bordered width-10px" style="text-align: center;">{{$data->geo_code_segment->name ?? " "}}</td>
                            <!-- <td class="table-bordered width-10px" style="text-align: center;">5</td>
                            <td class="table-bordered width-10px" style="text-align: center;">2</td>
                            <td class="table-bordered width-10px" style="text-align: center;">1</td>
                            <td class="table-bordered width-10px" style="text-align: center;">0</td>
                            <td class="table-bordered width-10px" style="text-align: center;">0</td>
                            <td class="table-bordered width-10px" style="text-align: center;">2</td>
                            <td class="table-bordered width-10px" style="text-align: center;"></td> -->
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
                                        <td class="text-center table-bordered" colspan="6"><label>Date</label></td>
                                        <td class="text-center table-bordered" colspan="2"><label>Amount (Naira)</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-bordered">{{$data->value_date}}</td>
                                        <!-- <td class="table-bordered">1</td>
                                        <td class="table-bordered">2</td>
                                        <td class="table-bordered">0</td>
                                        <td class="table-bordered">1</td>
                                        <td class="table-bordered">9</td> -->
                                        <td class="table-bordered">"{{$data->total_tax->tax ?? ' '}}"</td>
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
                <td><input type="text" style="width: 95%" value="{{$data->one_payee . $data->count_payee}}"></td>
            </tr>
            <tr>
                <td style="width: 10%">Address</td>
                <td style="width: 80%"><input type="text" style="width: 95%" value="{{$data->address}}"></td>
            </tr>
        </table>
        <table style="width: 100%; margin-top: 40px;" class="table-bordered">
            <thead>
            <tr>
                <th class="table-bordered" style="text-align: center;">Date</th>
                <th class="table-bordered" style="text-align: center;">Detail Description of Service Work</th>
                <th class="table-bordered" style="text-align: center;">Rate</th>
                <th class="table-bordered" style="text-align: center;">N</th>
                <th class="table-bordered" style="text-align: center;">K</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data->payee_vouchers as $payee)
            <tr>
                <td class="table-bordered" style="text-align: center;">{{$payee->created_at}}</td>
                <td class="table-bordered" style="text-align: center;">{{$payee->detail}}</td>
                <td class="table-bordered" style="text-align: center;">{{1}}</td>
                <td class="table-bordered" style="text-align: center;">{{$payee->net_amount}}</td>
                <td class="table-bordered" style="text-align: center;">00</td>
            </tr>
            @endforeach

            <tr>
                <td class="table-bordered" style="text-align: center;"></td>
                <?php  $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);?>
                <td class="table-bordered" style="text-align: center;">
                    Checked and Insert Amount in words
                    passed for : {{isset($data->total_amount) ? ucfirst($f->format($data->total_amount->amount)) . 'Naira Only.': ' '}}
                </td>
                <td class="table-bordered" style="text-align: center;">Total</td>
                <td class="table-bordered" style="text-align: center;">{{$data->total_amount->amount ?? ' '}}</td>
                <td class="table-bordered" style="text-align: center;">00</td>
            </tr>
            </tbody>
        </table>
        <table>
            <tr>
                <td style="width: 50%">
                    <table style="width: 100%; margin-top: 50px; border: 1px solid #a0a0a0; padding: 20px">
                        <tr>
                            <td style="padding: 5px" colspan="2">Payable at :</td>
                            <td colspan="2" class="text-center" style="box-shadow: 0 1px 0 0 #000; padding: 5px">{{$data->default_setting->account_head->name ?? " "}}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px" colspan="2">Signature</td>
                            <td colspan="2" class="text-center" style="box-shadow: 0 1px 0 0 #000; padding: 5px"></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px" colspan="2">Name in Block letters</td>
                            <td colspan="2" class="text-center" style="box-shadow: 0 1px 0 0 #000; padding: 5px">
                            {{$data->checking_officer->first_name}}  
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px">Station</td>
                            <td class="text-center" style="box-shadow: 0 1px 0 0 #000; padding: 5px">{{$data->default_setting->account_head->name  ?? " "}}</td>
                            <td style="padding: 5px">Date</td>
                            <td class="text-center" style="box-shadow: 0 1px 0 0 #000; width: 235px; padding: 5px"></td>
                        </tr>
                        <tr>
                            <td colspan="2">Checking Officer's Signature</td>
                            <td colspan="2" class="text-center" style="box-shadow: 0 1px 0 0 #000; padding: 5px"></td>
                        </tr>
                        <tr>
                            <td colspan="2">Name in Block letters</td>
                            <td colspan="2" class="text-center" style="box-shadow: 0 1px 0 0 #000; padding: 5px">
                            {{$data->checking_officer->first_name}}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Authy AIE No. etc.</td>
                            <td colspan="2" style="padding: 5px">{{$data->aie->aie_number}}</td>
                        </tr>
                    </table>
                </td>
                <td style="width: 50%">
                    <table style="width: 100%; margin-top: 50px;">
                        <tr>
                            <td style="text-align: center">Certificate</td>
                        </tr>
                        <tr>
                            <td>
                                <p style="margin-left: 10px">I certify that the above amount is correct, and was
                                    incurred under
                                    the
                                    Authority Quoted, that the
                                    services that have been duly performed; that rate piece charged is according to
                                    regulations.
                                    Contact
                                    is fair and reasonable.</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="display: flex">
		                        <span style="margin-left: 10px">That the amount of : <span class="text-bold"
                                                                                           style="margin-left:10px">{{isset($data->total_amount) ? ucfirst($f->format($data->total_amount->amount)) . 'Naira Only.': ' '}}</span></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span style="margin-left: 10px">may be paid under the Classification Quoted</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="box-shadow: 0 1px 0 0 #000">
                                <span class="text-bold" style="margin-left: 10px;">{{$data->checking_officer->first_name}}</span>
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
                                        <td style="width: 50%; box-shadow: 0 1px 0 0 #000">{{$data->default_setting->account_head->name ?? " "}}</td>
                                        <td style="width: 10%; text-align: right">Date</td>
                                        <td style="width: 30%; box-shadow: 0 1px 0 0 #000"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="width: 100%">
                                    <tr>
                                        <td style="width: 10%"><span style="margin-left: 10px">Designation</span></td>
                                        <td style="width: 80%; box-shadow: 0 1px 0 0 #000"></td>
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
                <td style="box-shadow: 0 1px 0 0 #000; width: 50%">
                </td>
            </tr>
        </table>
        <table style="width: 100%">
            <tr>
                <td style="box-shadow: 0 1px 0 0 #000; width: 50%">asdasd</td>
                <td style="width: 50%;">in the full settlement of the Amount.</td>
            </tr>
        </table>
        <table style="width: 100%; margin-top: 25px; margin-bottom: 20px">
            <tr>
                <td></td>
            </tr>
            <tr>
                <td style="text-align: right;">
                    <span style="margin-right: 10px">Signature</span>
                </td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
