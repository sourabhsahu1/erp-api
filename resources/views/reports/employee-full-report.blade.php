<!DOCTYPE html>
<html>
<head>
    <title>Profile Full</title>
    <style type="text/css">
        * {
            font-family: 'Noto Sans', sans-serif !important;
        }

        table td {
            padding: 10px;
        }

        table th {
            padding: 10px;
        }

        .info-table {
            border: 1px solid #e0e0e0;
            width: 100%;
            font-size: 12px;
        }

        .info-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .image-table {
            width: 100%;
            font-size: 12px;
            margin-left: 6%;
            margin-right: 2%
        }

        .address-table {
            border: 1px solid #e0e0e0;
            width: 90%;
            font-size: 12px;
            margin-left: 5%;
            height:300px
        }

        .address-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .image-table tr:nth-child(even) {
            background-color: #f2f2f2;
            margin-right: 5%;
            padding-right: 10%;
            padding-left: 10%;
        }

        .main-container {
            box-shadow: 0 0 1px 2px #000;
            padding: 50px;
            border-radius: 10px;
        }

        .shadow {
            box-shadow: 0 0 0 1px #e0e0e0;
        }

        .mr-38-per {
            margin-right: 38%;
        }

        .mt--35px {
            margin-top: -35px
        }

        .mt-15px {
            margin-top: 15px;
        }

        .competencies-table {
            border: 1px solid #e0e0e0;
            width: 75%;
            font-size: 24px;
        }

        .activity-table {
            border: 1px solid #e0e0e0;
            width: 75%;
            font-size: 12px;
        }

        .background-table {
            border: 1px solid #e0e0e0;
            width: 100%;
            font-size: 12px;
        }

        .background-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .text-center{
            text-align: center;
        }

        .user-img {
            box-shadow: 0 0 5px 3px #e0e0e0 !important;
            /* margin-left: 10%; */
        }
    </style>
</head>
<body>
<div class="main-container">
    <table style="width: 100%">
        <tbody>
        <tr>
            <td style="width: 25%">
                <h2>Profile</h2>
            </td>
            <td class="text-center" style="width: 33.33%">
                <h2>{{isset($data['last_name']) ? $data['last_name']. ' '. $data['first_name'] : ''}}</h2>
            </td>
            <td class="text-center" style="width: 33.33%">
            </td>
        </tr>
        </tbody>
    </table>
    <table>
        <tr>
            <td>
                <table class="info-table">
                    <tbody>
                    <tr>
                        <td colspan="2">
                            <b>Surname:</b> {{isset($data['last_name']) ? $data['last_name'] : ''}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Other Names:</b> {{isset($data['first_name']) ? $data['first_name'] : ''}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>ID Number:</b> {{$data['id']}}
                        </td>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Date of
                                Birth:</b> {{(isset($data['employee_personal_details']) && isset($data['employee_personal_details']['date_of_birth'])) ? \Illuminate\Support\Carbon::parse($data['employee_personal_details']['date_of_birth'])->toDateString() : ''}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Martial
                                Status:</b> {{(isset($data['employee_personal_details']) && isset($data['employee_personal_details']['marital_status'])) ? $data['employee_personal_details']['marital_status'] : ''}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Date of 1st
                                Appt:</b> {{(isset($data['employee_personal_details']) && isset($data['employee_personal_details']['appointed_on'])) ? \Illuminate\Support\Carbon::parse($data['employee_personal_details']['appointed_on'])->toDateString() : ''}}
                        </td>
                        <td>
                            <b>Length of Service:</b>
                            {{isset($data['yearsOfWork']) ? $data['yearsOfWork']. 'Years' : ''}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Relatives (Staff) / Time of Service:</b>
                            @if(isset($data['employee_relatives']))
                                @foreach($data['employee_relatives'] as $emp)
                                    <p>
                                        {{$emp['last_name'] .' '.$emp['first_name'] .' '. \Illuminate\Support\Carbon::parse($emp['relative_job_profile']['current_appointment'])->diffInYears(\Illuminate\Support\Carbon::now()) . ' Years'}}
                                    </p>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td>
                <table class="image-table">
                    <tbody>
                    <tr>
                        <td>
                            <img src="{{(isset($data['file'])) ? $data['file']['url'] : ''}}" class="user-img"/>
                        </td>
                    </tr>
                    <tr class="shadow">
                        <td>
                            <b>Email:</b> {{(isset($data['employee_personal_details']) && isset($data['employee_personal_details']['email'])) ? $data['employee_personal_details']['email'] : ''}}
                        </td>
                    </tr>
                    <tr class="shadow">
                        <td>
                            <b>Phone
                                No:</b> {{(isset($data['employee_personal_details']) && isset($data['employee_personal_details']['phone'])) ? $data['employee_personal_details']['phone'] : ''}}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td>
                <table class="address-table">
                    <tbody>
                    <tr>
                        <td colspan="3">
                            <b>Sector/Sub-Sector/Division:</b> {{isset($data['parent_details']['parent_department']) ? $data['parent_details']['parent_department'] : '' }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Department/Section:</b> {{(isset($data['employee_job_profiles']) && isset($data['employee_job_profiles']['department'])) ? $data['employee_job_profiles']['department']['name'] : ''}}
                        </td>
                        <td>
                            <b>Geographic Location:</b> {{(isset($data['employee_job_profiles']) && isset($data['employee_job_profiles']['work_location'])) ? $data['employee_job_profiles']['work_location']['name'] : ''}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <b>Position:</b> {{(isset($data['employee_job_profiles']) && isset($data['employee_job_profiles']['job_position']) && isset($data['employee_job_profiles']['job_position']['name'])) ? $data['employee_job_profiles']['job_position']['name'] : ''}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Supervisor:</b> {{isset($data['parent_details']['parent_job_position']) ? $data['parent_details']['parent_job_position'] : '' }}
                        </td>
                        <td>
                            <b>Level No:</b> {{isset($data['parent_details']['parent_grade_level']) ? $data['parent_details']['parent_grade_level'] : '' }}
                        </td>
                        <td>
                            <b>Other Language:</b>
                            @if(isset($data['employee_languages']))
                                @foreach($data['employee_languages'] as $empLanguage)
                                    {{$empLanguage['language']['name']}}
                                @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <b>Degree (Master or Specialization):</b>
                            @if(isset($data['employee_academics']))
                                @foreach($data['employee_academics'] as $empLanguage)
                                    {{$empLanguage['qualification']['name']. ' '. $empLanguage['academic']['name']}}
                                @endforeach
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <table class="mt-15px" width="100%">
        <tbody>
        <tr>
            <td style="width: 50%">
                <h3 class="mr-38-per">COMPETENCIES:</h3>
            </td>
            <td style="width: 50%">
                <h3 class="mr-38-per"> BACKGROUND:</h3>
            </td>
        </tr>
        </tbody>
    </table>
    <table style="width: 100%">
        <tr>
            <td style="width: 50%">
                <table class="competencies-table">
                    <tr>
                        <td style="font-size:15px;">
                         {{(isset($data['employee_job_profiles']) && isset($data['employee_job_profiles']['job_position']) && isset($data['employee_job_profiles']['job_position']['competences'])) ? $data['employee_job_profiles']['job_position']['competences'] : ''}} 
                        </td>
                    </tr>
                </table>
            </td>
            <td style="width: 50%">
                <table class="background-table">
                    <thead style="background-color: #020a30; color: white">
                    <tr>
                        <th>
                            S/N
                        </th>
                        <th>
                            YEAR
                        </th>
                        <th>
                            LEVEL
                        </th>
                        <th>
                            POSITION
                        </th>
                        <th>
                            LOCATION
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-center">
                            1.
                        </td>
                        <td class="text-center">
                            {{(isset($data['employee_job_profiles']) && isset($data['employee_job_profiles']['current_appointment'])) ? \Illuminate\Support\Carbon::parse($data['employee_job_profiles']['current_appointment'])->format('m/Y') : ''}}
                        </td>
                        <td class="text-center">
                            {{(isset($data['employee_job_profiles']) && isset($data['employee_job_profiles']['job_position']) && isset($data['employee_job_profiles']['job_position']['grade_level'])) ? $data['employee_job_profiles']['job_position']['grade_level']['name'] : ''}}
                        </td>
                        <td class="text-center">
                            {{(isset($data['employee_job_profiles']) && isset($data['employee_job_profiles']['job_position'])) ? $data['employee_job_profiles']['job_position']['name'] : ''}}
                        </td>
                        <td class="text-center">
                            {{(isset($data['employee_job_profiles']) && isset($data['employee_job_profiles']['work_location'])) ? $data['employee_job_profiles']['work_location']['name'] : ''}}
                        </td>
                    </tr>

                    </tbody>
                </table>
            </td>
        </tr>
    </table>
    <table class="mt-15px" style="width: 50%">
        <tr>
            <td><h3 class="mr-38-per">ACTIVITIES OF POSITION:</h3></td>
        </tr>
        <tr>
            <td style="width: 100%">
                <table class="activity-table">
                    <tr>
                        <td style="font-size:15px;">
                        {{(isset($data['employee_job_profiles']) && isset($data['employee_job_profiles']['job_position']) && isset($data['employee_job_profiles']['job_position']['activities'])) ? $data['employee_job_profiles']['job_position']['activities'] : ''}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
</div>
</div>
</body>
</html>
