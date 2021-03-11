<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt Voucher - Paying in Form</title>
    <style>
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
            <h2 style="text-align: center; margin-top: -30px;">(DSCHC)</h2>
            <h2 style="text-align: center; margin-top: -20px; margin-bottom: 0;">{{$data->admin_segment->name ?? " "}}</h2>
            <h2 style="text-align: center; margin-top: 0; margin-bottom: 0;">PAYING-IN-FORM</h2>
        </div>
        <table style="margin-top: 30px; width: 100%">
            <tr>
                <td>
                    <div style="font-size: 18px">
                        <label>Deptal No: </label>
                        <input class="bind-data" type="text" value="{{$data->deptal_id}}"/>
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
                    <table style="width: 100%" class="table-bordered">
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
                            <td style="text-align: center; width: 50%" class="table-bordered bind-data"  colspan="{{strlen(str_replace('-','',$data->economic_segment->combined_code)) + 1}}">
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
                                        <!-- <td class="table-bordered">  {{\Illuminate\Support\Carbon::parse($data->value_date)->toDateString()}}</td> -->
                                        <!-- <td class="table-bordered">1</td>
                                        <td class="table-bordered">2</td>
                                        <td class="table-bordered">0</td>
                                        <td class="table-bordered">1</td>
                                        <td class="table-bordered">9</td> -->
                                        <td class="table-bordered bind-data"> {{$data->total_amount->amount ?? " "}}</td>
                                        <td class="table-bordered">00</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tasble>
        <table style=width: 100%>
            <tr>
                <td>To Sub-Accountant</td>
                <td><span style="margin-top: 10px; font-weight: 600">DSCHC</span></td>
            </tr>
        </table>
        <table style="width: 100%">
            <tr>
                <td style="width: 25%">Please receive the sum of:</td>
                <?php $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);?>
                <td style="width: 80%"><input class="bind-data" type="text" style="width: 100%" value="{{ucfirst($f->format($data->total_amount->amount))}} Only"/></td>
            </tr>
        </table>
        <table style="width: 100%; margin-top: 0px">
            <tr>
                <td style="width: 100%;" colspan="3"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="3"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="3"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width:20%"><input type="text" style="width: 100%"></td>
                <!-- <td>Being<input type="text" style="width: 95%; margin-left: 15px" value="Test Narration Text for RV (Received from: TREASURY SINGLE ACCOUNT (CBN), [CASHBOOK][+ 1 Other])"></td> -->
                <td style="width: 10%;" class="text-center">Being</td>
                <td style="width:70%"><input  class="bind-data" type="text" style="width: 100%" value=" {{$data->final_text}}"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="3"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="3"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="3"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="3"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="3"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="3"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="3"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="3"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="3"><input type="text" style="width: 100%"></td>
            </tr>
            <tr>
                <td style="width: 100%;" colspan="3"><input type="text" style="width: 100%"></td>
            </tr>
        </table>
        <table style="width: 100%; margin-top: 60px">
            <tr>
                <td class="bind-data" style="width: 10%; font-weight: 600" colspan="3">{{$data->total_amount->amount}}</td>
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
