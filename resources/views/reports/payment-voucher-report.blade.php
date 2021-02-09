<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Voucher</title>
    <style>
        .shadow-1px {
            border: 1px solid #a0a0a0;
        }

        .text-bold {
            font-weight: 600;
        }
    </style>
</head>
<body>
<div style="width: 90%; height: auto; border: 1px solid #000; margin: 0px auto;">
    <div style="width: 100%; padding-top: 50px; padding-bottom: 50px">
        <div>
            <h2 style="text-align: center; margin-top: 0;">DSCHC</h2>
            <h2 style="text-align: center; margin-bottom: 0;">Delta State Contributory Health Commission</h2>
            <h2 style="text-align: center; margin-bottom: 0;">Payment Voucher</h2>
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
                            <td style="border: 1px solid #a0a0a0; width: 120px; text-align: center">
                                <div style="font-size: 18px;">
                                    <label>Detail Type</label>
                                </div>
                            </td>
                            <td style="border: 1px solid #a0a0a0; width: 300px; text-align: center">
                                <div style="font-size: 18px;">
                                    <label>Voucher Number</label>
                                </div>
                            </td>
                            <td style="width: 43%; text-align: center"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #a0a0a0; width: 120px; text-align: center">
                                <div style="font-size: 18px;">
                                    <label>VOI</label>
                                </div>
                            </td>
                            <td style="border: 1px solid #a0a0a0; width: 300px; text-align: center">
                                <table style="width: 100%">
                                    <tr>
                                        <td class="shadow-1px">{{$data->id}}</td>
                                        {{--                                        <td class="shadow-1px">E</td>--}}
                                        {{--                                        <td class="shadow-1px">X</td>--}}
                                        {{--                                        <td class="shadow-1px">1</td>--}}
                                        {{--                                        <td class="shadow-1px">0</td>--}}
                                        {{--                                        <td class="shadow-1px">0</td>--}}
                                        {{--                                        <td class="shadow-1px">0</td>--}}
                                        {{--                                        <td class="shadow-1px">5</td>--}}
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="border: 1px solid #a0a0a0; text-align: center">
                    <table style="width: 100%">
                        <tr>
                            <td style="border: 1px solid #a0a0a0; width: 120px; text-align: center;">
                                <label>Station</label>
                            </td>
                            <td style="border: 1px solid #a0a0a0; width: 300px; text-align: center">
                                <div style="font-size: 18px;">
                                    <label>{{$data->default_setting->account_head->name ?? " "}}</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #a0a0a0; width: 120px; text-align: center;">
                                <label>Admin</label>
                            </td>
                            <td style="border: 1px solid #a0a0a0; width: 300px; text-align: center">
                                <div style="font-size: 18px;">
                                    <label>{{$data->admin_segment->name ?? " "}}</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #a0a0a0; width: 120px; text-align: center;">
                                <label>Economic</label>
                            </td>
                            <td style="border: 1px solid #a0a0a0; width: 300px; text-align: center">
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
                    <table style="width: 100%">
                        <tr>
                            <td style="border: 1px solid #a0a0a0; text-align: center; width: 50%">
                                <label>Administrative Segment</label>
                            </td>
                            <td style="border: 1px solid #a0a0a0; text-align: center; width: 50%">
                                <label>Economic Segment</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="width: 100%">
                                    <tr>
                                        <td style="border: 1px solid #a0a0a0; text-align: center;">{{$data->economic_segment->name ?? " "}}</td>
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">5</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">2</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">1</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">0</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">0</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">2</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;"></td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;"></td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;"></td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;"></td>--}}
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table style="width: 100%">
                                    <tr>
                                        <td style="border: 1px solid #a0a0a0; text-align: center;">{{$data->economic_segment->name ?? " "}}</td>
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">1</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">0</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">1</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">0</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">1</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">0</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">3</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;"></td>--}}
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table style="margin-top: 50px; width: 100%">
            <tr>
                <td>
                    <table style="width: 100%">
                        <tr>
                            <td style="border: 1px solid #a0a0a0; text-align: center; width: 25%">
                                <label>Functional Segment</label>
                            </td>
                            <td style="border: 1px solid #a0a0a0; text-align: center; width: 25%">
                                <label>Programme Segment</label>
                            </td>
                            <td style="border: 1px solid #a0a0a0; text-align: center; width: 25%">
                                <label>Fund Segment</label>
                            </td>
                            <td style="border: 1px solid #a0a0a0; text-align: center; width: 25%">
                                <label>Geo Code Segment</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="width: 100%">
                                    <tr>
                                        <td style="border: 1px solid #a0a0a0; text-align: center;">{{$data->functional_segment->name ?? " "}}</td>
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">2</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">1</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">0</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">0</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">2</td>--}}
                                        <td style="border: 1px solid #a0a0a0; text-align: center;"></td>
                                        <td style="border: 1px solid #a0a0a0; text-align: center;"></td>
                                        <td style="border: 1px solid #a0a0a0; text-align: center;"></td>
                                        <td style="border: 1px solid #a0a0a0; text-align: center;"></td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table style="width: 100%">
                                    <tr>
                                        <td style="border: 1px solid #a0a0a0; text-align: center;">2</td>
                                        <td style="border: 1px solid #a0a0a0; text-align: center;">{{$data->program_segment->name ?? " "}}</td>
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">0</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">1</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">0</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">1</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">0</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">3</td>--}}
                                        <td style="border: 1px solid #a0a0a0; text-align: center;"></td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table style="width: 100%">
                                    <tr>
                                        <td style="border: 1px solid #a0a0a0; text-align: center;">0</td>
                                        <td style="border: 1px solid #a0a0a0; text-align: center;">{{$data->fund_segment->name ?? " "}}</td>
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">2</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">1</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">0</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">0</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">2</td>--}}
                                        <td style="border: 1px solid #a0a0a0; text-align: center;"></td>
                                        <td style="border: 1px solid #a0a0a0; text-align: center;"></td>
                                        <td style="border: 1px solid #a0a0a0; text-align: center;"></td>
                                        <td style="border: 1px solid #a0a0a0; text-align: center;"></td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table style="width: 100%">
                                    <tr>
                                        <td style="border: 1px solid #a0a0a0; text-align: center;">0</td>
                                        <td style="border: 1px solid #a0a0a0; text-align: center;">{{$data->geo_code_segment->name ?? " "}}</td>
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">2</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">1</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">0</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">0</td>--}}
                                        {{--                                        <td style="border: 1px solid #a0a0a0; text-align: center;">2</td>--}}
                                        <td style="border: 1px solid #a0a0a0; text-align: center;"></td>
                                        <td style="border: 1px solid #a0a0a0; text-align: center;"></td>
                                        <td style="border: 1px solid #a0a0a0; text-align: center;"></td>
                                        <td style="border: 1px solid #a0a0a0; text-align: center;"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table style="width: 100%; margin-top: 50px">
            <tr>
                <td style="width: 10%">Payee</td>
                <td><input type="text" style="width: 95%" value="{{$data->one_payee . $data->count_payee}}"></td>
            </tr>
            <tr>
                <td style="width: 10%">Address</td>
                <td style="width: 80%"><input type="text" style="width: 95%" value="{{$data->address}}"></td>
            </tr>
        </table>
        <table style="width: 100%; margin-top: 50px; border: 1px solid #a0a0a0">
            <thead>
            <tr>
                <th style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">Date</th>
                <th style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">Detail Description of Service Work</th>
                <th style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">Rate</th>
                <th style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">N</th>
                <th style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">K</th>
            </tr>
            </thead>
            <tbody>

            @foreach($data->payee_vouchers as $payee)

                <tr>
                    <td style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">{{$payee->created_at}}</td>
                    <td style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">{{$payee->detail}}</td>
                    <td style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">{{1}}</td>
                    <td style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">{{$payee->net_amount}}</td>
                    <td style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">00</td>
                </tr>
            @endforeach

            <tr>
                <td style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0"></td>
                <?php  $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);?>
                <td style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">
                    Checked and Insert Amount in words
                    passed for : {{ucfirst($f->format($data->total_amount->amount))}} Naira Only
                </td>
                <td style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">Total</td>
                <td style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">{{$data->total_amount->amount}}</td>
                <td style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">00</td>
            </tr>
            </tbody>
        </table>
        <table style="width: 100%">
            <tr>
                <td style="width: 50%">


            <table style="width: 100%; margin-top: 50px; border: 1px solid #a0a0a0">
                <tr>
                    <td>Payable at :</td>
                    <td class="shadow-1px">{{$data->default_setting->account_head->name ?? " "}}</td>
                </tr>
                <tr>
                    <td>Signature</td>
                    <td class="shadow-1px"></td>
                </tr>
                <tr>
                    <td>Name in Block letters</td>
                    <td class="shadow-1px">{{$data->checking_officer->first_name}}</td>
                </tr>
                <tr>
                    <td>Station</td>
                    <td class="shadow-1px">{{$data->default_setting->account_head->name  ?? " "}}</td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td class="shadow-1px"></td>
                </tr>
                <tr>
                    <td>Checking Officer's Signature</td>
                    <td class="shadow-1px"></td>
                </tr>
                <tr>
                    <td>Name in Block letters</td>
                    <td class="shadow-1px">{{$data->checking_officer->first_name}}</td>
                </tr>
                <tr>
                    <td>Authy AIE No. etc.</td>
                    <td class="shadow-1px">{{$data->aie->aie_number}}</td>
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
                                <p style="margin-left: 10px">I certify that the above amount is correct, and was incurred under
                                    the
                                    Authority Quoted, that the
                                    services that have been duly performed; that rate piece charged is according to regulations.
                                    Contact
                                    is fair and reasonable.</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="display: flex">
                        <span style="margin-left: 10px">That the amount of : <span class="text-bold"
                                                                                   style="margin-left:10px">{{ucfirst($f->format($data->total_amount->amount))}} Naira Only.</span></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span style="margin-left: 10px">may be paid under the Classification Quoted</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span class="text-bold" style="margin-left: 10px">{{$data->checking_officer->first_name}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="width: 100%">
                                    <tr>
                                        <td style="width: 25%"><span style="margin-left: 10px">Place</span></td>
                                        <td style="width: 25%" class="shadow-1px">{{$data->default_setting->account_head->name ?? " "}}</td>
                                        <td style="width: 25%; text-align: right">Date</td>
                                        <td style="width: 25%" class="shadow-1px"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="width: 100%">
                                    <tr>
                                        <td><span style="margin-left: 10px">Designation</span></td>
                                        <td class="shadow-1px" style="width: 50%"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>

        </table>

        <table style="width: 100%">
            <tr>
                <td>
                    Received from the:
                </td>
                <td>
                    DSCHC
                </td>
                <td>
                    the sum of
                </td>
                <td class="shadow-1px">
                    DSCHC
                </td>
            </tr>
        </table>
        <table style="width: 100%">
            <tr>
                <td>asdasd</td>
                <td>in the full settlement of the amount</td>
            </tr>
        </table>
        <table style="width: 100%">
            <tr>
                <td></td>
            </tr>
            <tr>
                <td style="text-align: right;">
                    <span style="margin-right: 10px">Signature</span>
                </td>
            </tr>
        </table>

        <table style="width: 100%">
            <tr>
                <td style="border: 1px solid #a0a0a0; width: 20%">N</td>
                <td style="border: 1px solid #a0a0a0; width: 16%"><span style="text-align: right">K</span></td>
                <td style="width: 16%;text-align: right">
                    <span style="margin-left: 10px;">Date</span>
                </td>
                <td class="shadow-1px" style="width: 16%"></td>
                <td style="width: 16%; text-align: right">Place</td>
                <td class="shadow-1px" style="width: 16%"></td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
