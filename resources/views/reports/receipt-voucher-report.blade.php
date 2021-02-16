<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt Voucher - Paying in Form</title>
    <style>
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
            <h2 style="text-align: center; margin-top: -30px;">(DSCHC)</h2>
            <h2 style="text-align: center; margin-top: -20px; margin-bottom: 0;">Delta State Contributory Health Commission</h2>
            <h2 style="text-align: center; margin-top: 0; margin-bottom: 0;">PAYING-IN-FORM</h2>
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
                            <td class="table-bordered width-10px" style="text-align: center;">{{$data->admin_segment->combined_code ?? " "}}</td>
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
                            <td class="table-bordered width-10px" style="text-align: center;">   {{$data->economic_segment->combined_code ?? " "}}</td>
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
                            <td class="table-bordered width-10px" style="text-align: center;"> {{$data->functional_segment->combined_code ?? " "}}</td>
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

                            <td class="table-bordered width-10px" style="text-align: center;">{{$data->program_segment->combined_code ?? " "}}</td>
                            <!-- <td class="table-bordered width-10px" style="text-align: center;">1</td>
                            <td class="table-bordered width-10px" style="text-align: center;">0</td>
                            <td class="table-bordered width-10px" style="text-align: center;">1</td>
                            <td class="table-bordered width-10px" style="text-align: center;">0</td>
                            <td class="table-bordered width-10px" style="text-align: center;">1</td>
                            <td class="table-bordered width-10px" style="text-align: center;">0</td>
                            <td class="table-bordered width-10px" style="text-align: center;">3</td> -->
                            <td class="table-bordered width-10px" style="text-align: center;"></td>

                            <td class="table-bordered width-10px" style="text-align: center;">{{$data->fund_segment->combined_code ?? " "}}</td>
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

                            <td class="table-bordered width-10px" style="text-align: center;">{{$data->geo_code_segment->combined_code ?? " "}}</td>
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
                                        <td class="table-bordered">  {{$data->value_date}}</td>
                                        <!-- <td class="table-bordered">1</td>
                                        <td class="table-bordered">2</td>
                                        <td class="table-bordered">0</td>
                                        <td class="table-bordered">1</td>
                                        <td class="table-bordered">9</td> -->
                                        <td class="table-bordered"> {{$data->total_amount->amount ?? " "}}</td>
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
                <td>To Sub-Accountant</td>
                <td>DSCHC</td>
            </tr>
            <tr>
                <td style="width: 10%">Please receive the sum of:</td>
                <?php  $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);?>
                <td style="width: 90%"><input type="text" style="width: 100%" value="{{ucfirst($f->format($data->total_amount->amount))}} Only"/></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="2"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="2"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="2"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td><input type="text" style="width: 100%"></td>
                <!-- <td>Being<input type="text" style="width: 95%; margin-left: 15px" value="Test Narration Text for RV (Received from: TREASURY SINGLE ACCOUNT (CBN), [CASHBOOK][+ 1 Other])"></td> -->
                <td>Being<input type="text" style="width: 95%; margin-left: 15px" value="{{$data->final_text}}"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="2"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="2"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="2"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="2"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="2"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="2"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="2"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="2"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="2"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="2"><input type="text" style="width: 100%"></td>
            </tr>
        </table>
        <table style="width: 100%; margin-top: 60px">
            <tr>
                <td style="width: 10%; font-weight: 600" colspan="3">{{$data->total_amount->amount}}</td>
            </tr>
            <tr>
                <td style="width: 10%; font-weight: 600"><input type="text" style="width: 100%"></td>
                <td style="width: 80%"></td>
                <td style="width: 10%; font-weight: 600"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 10%; font-weight: 600; text-align: center">Date</td>
                <td style="width: 80%"></td>
                <td style="width: 10%; font-weight: 600; text-align: center"><small>(Signature Mark of Payer)</small></td>
            </tr>
            <tr>
                <td style="width: 10%; font-weight: 600; text-align: center"></td>
                <td style="width: 70%; text-align: right">Witness to Mark:</td>
                <td style="width: 20%; font-weight: 600; text-align: center"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center">
                    <span>Person making this payment is to be given a receipt from a book of numbered Receipt and to sign Coounterfoil Book</span>
                </td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>