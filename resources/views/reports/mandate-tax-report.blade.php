<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mandate Export - CBN Format</title>
    <style>
        .shadow-1px {
            border: 1px solid #a0a0a0;
        }

        .table-bordered {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <div style="width: 90%; height: auto; border: 1px solid #000; margin: 0 auto;">
        <div style="width: 100%; padding-top: 50px; padding-bottom: 50px">
            <div>
                <h2 style="text-align: center; margin-top: -30px;">Delta State Contributory Health Commission</h2>
                <h2 style="text-align: center; margin-top: 0;">DSCHC</h2>
            </div>
            <div style="margin-top: 5px;">
                <table style="width: 100%">
                    <tr>
                        <td>
                            <table style="width: 100%">
                                <tr>
                                    <td>
                                        <div style="font-size: 18px">
                                            <label>The Manager</label>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table style="width: 100%">
                                <tr>
                                    <td style="text-align: right; width: 80%">
                                        Ref No.
                                    </td>
                                    <td style="text-align: right">
                                        DSCH22009988J8899
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right; width: 80%">
                                        Acc No.
                                    </td>
                                    <td style="text-align: right">

                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right; width: 80%">
                                        Value Date
                                    </td>
                                    <td style="text-align: right">
                                    {{\Illuminate\Support\Carbon::parse($data->value_date)->toDateString()}}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <table style="width: 100%">
                <tr>
                    <td style="text-align: center" colspan="3">PAYMENT MANDATE</td>
                </tr>
                <tr>
                    <!-- <td>Please credit the account</td>
                    <td></td>
                    <td>of understand beneficieries and debit out Account No. 345678289 accordingly</td> -->
                    <td>
                    {{"Please credit the account " . $data->cashbook->bank_account_number . " of understand
                        beneficieries and debit out Account No. 345678289 accordingly"}}
                    </td>
                </tr>
            </table>
            <table style="width: 100%; margin-top: 10px" class="table-bordered">
                <thead>
                    <tr>
                        <th style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">S.No</th>
                        <th style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">BENEFICIERY</th>
                        <th style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">BANK</th>
                        <th style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">SORT CODE</th>
                        <th style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">ACCOUNT NUMBER</th>
                        <th style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">A/C TYPE</th>
                        <th style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">AMOUNT [N]</th>
                        <th style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">PURPOSE</th>
                    </tr>
                </thead>
                <tbody>
                <?php
            $count = 0;
            $totalSum = 0;
            ?>
                    @foreach($data->payment_vouchers as $pv)
                    @foreach($pv->payee_vouchers as $payee)
                    <?php
                    $count = $count + 1;
                    $totalSum = $totalSum + $payee->net_amount ?? 0;
                    ?>
                    <tr>
                        <td style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">{{$count}}</td>
                        <td style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">{{$payee->employee_id ?
                            $payee->employee->first_name : $payee->admin_company->name}}</td>
                        <td style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">{{$payee->admin_company?
                            $payee->admin_company->company_bank->bank_branch->hr_bank->name :
                            $payee->employee->employee_bank->branches->hr_bank->name}}</td>
                        <td style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">
                            {{$payee->admin_company->company_bank->bank_branch->sort_code ?? " "}}</td>
                        <td style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">
                            {{$payee->admin_company->company_bank->bank_account_number ?? " "}}</td>
                        <td style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">
                            {{$payee->admin_company->company_bank->type_of_bank_account ?? " "}}</td>
                        <td style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">{{$payee->net_amount ?? " "}}</td>
                        <td style="text-align: center; box-shadow: 0 0 0 1px #a0a0a0">{{$payee->details ?? " "}}</td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
            <table style="width: 50%; margin-top: 20px">
                <tr>
                    <td style="width: 50%">
                        GRAND TOTAL (IN FIGURES)
                    </td>
                    <td style="width: 50%" class="shadow-1px">
                    {{$totalSum}}
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%">
                        GRAND TOTAL (IN WORDS)
                    </td>
                    <?php  $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);?>
                    <td style="width: 50%">
                        {{ucfirst($f->format($totalSum))}} Naira Only
                    </td>
                </tr>
            </table>
            <table style="width: 100%; margin-top: 10px">
                <tr>
                    <td style="width: 40%">
                        <table style="width: 100%">
                            <tr>
                                <td colspan="4">
                                    <h4>AUTHORIZED BY:</h4>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    Signature
                                </td>
                                <td style="width: 25%; box-shadow: 0 1px 0 0 #000">{{$data->second_authorised->first_name}}</td>
                                <td style="width: 25%; text-align: right">
                                    Date
                                </td>
                                <td style="width: 25%; box-shadow: 0 1px 0 0 #000"> {{\Illuminate\Support\Carbon::parse($data->second_authorised_date)->toDateString()}}</td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <p style="margin-bottom: -25px">Name</p>
                                </td>
                                <td style="width: 25%; box-shadow: 0 1px 0 0 #000" colspan="2">{{$data->second_authorised->first_name}}</td>
                                <td rowspan="2">
                                    <table class="shadow-1px"
                                        style="width: 100%; text-align: center; padding: 40px; margin-top: 10px; margin-left: 15px">
                                        <tr>
                                            <td>
                                                <span style="margin-top: -10px">Thumb Print</span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="margin-bottom: -25px">GSM No.</p>
                                </td>
                                <td style="width: 25%; box-shadow: 0 1px 0 0 #000" colspan="2"></td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 20%">
                        <table style="width: 100%"></table>
                    </td>
                    <td style="width: 40%">
                        <table style="width: 100%">
                            <tr>
                                <td colspan="4">
                                    <h4>SUBMITTED FOR CONFORMATION BY:</h4>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    Signature
                                </td>
                                <td style="width: 25%; box-shadow: 0 1px 0 0 #000">{{$data->first_authorised->first_name}}</td>
                                <td style="width: 25%; text-align: right">
                                    Date
                                </td>
                                <td style="width: 25%; box-shadow: 0 1px 0 0 #000"> {{\Illuminate\Support\Carbon::parse($data->first_authorised_date)->toDateString()}}</td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <p style="margin-bottom: -25px">Name</p>
                                </td>
                                <td style="width: 25%; box-shadow: 0 1px 0 0 #000" colspan="2">{{$data->first_authorised->first_name}}</td>
                                <td rowspan="2">
                                    <table class="shadow-1px"
                                        style="width: 100%; text-align: center; padding: 40px; margin-top: 10px; margin-left: 0">
                                        <tr>
                                            <td>
                                                <span style="margin-top: -10px">Thumb Print</span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="margin-bottom: -25px">GSM No.</p>
                                </td>
                                <td style="width: 25%; box-shadow: 0 1px 0 0 #000" colspan="2"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table style="width: 100%; margin-top: 10px">
                <tr>
                    <td style="width: 40%">
                        <table style="width: 100%">
                            <tr>
                                <td colspan="4">
                                    <h4>AUTHORIZED BY:</h4>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    Signature
                                </td>
                                <td style="width: 25%; box-shadow: 0 1px 0 0 #000"></td>
                                <td style="width: 25%; text-align: right">
                                    Date
                                </td>
                                <td style="width: 25%; box-shadow: 0 1px 0 0 #000"></td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <p style="margin-bottom: -25px">Name</p>
                                </td>
                                <td style="width: 25%; box-shadow: 0 1px 0 0 #000" colspan="2"></td>
                                <td rowspan="2">
                                    <table class="shadow-1px"
                                        style="width: 100%; text-align: center; padding: 40px; margin-top: 10px; margin-left: 15px">
                                        <tr>
                                            <td>
                                                <span style="margin-top: -10px">Thumb Print</span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="margin-bottom: -25px">GSM No.</p>
                                </td>
                                <td style="width: 25%; box-shadow: 0 1px 0 0 #000" colspan="2"></td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 20%">
                        <table style="width: 100%"></table>
                    </td>
                    <td style="width: 40%">
                        <table style="width: 100%">
                            <tr>
                                <td colspan="4">
                                    <h4>FOR CBN USE ONLY:</h4>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    Signature
                                </td>
                                <td style="width: 25%; box-shadow: 0 1px 0 0 #000"></td>
                                <td style="width: 25%; text-align: right">
                                    Date
                                </td>
                                <td style="width: 25%; box-shadow: 0 1px 0 0 #000"></td>
                            </tr>
                            <tr>
                                <td style="width: 25%">
                                    <p style="margin-bottom: -25px">Name</p>
                                </td>
                                <td style="width: 25%; box-shadow: 0 1px 0 0 #000" colspan="2"></td>
                                <td rowspan="2">
                                    <table class="shadow-1px"
                                        style="width: 100%; text-align: center; padding: 40px; margin-top: 10px; margin-left: 0">
                                        <tr>
                                            <td>
                                                <span style="margin-top: -10px">Thumb Print</span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="margin-bottom: -25px">GSM No.</p>
                                </td>
                                <td style="width: 25%; box-shadow: 0 1px 0 0 #000" colspan="2"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
