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
            width: 38%;
            font-size: 24px;
        }

        .info-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .image-table {
            width: 20%;
            font-size: 24px;
            margin-left: 2%;
            margin-right: 2%
        }

        .address-table {
            border: 1px solid #e0e0e0;
            width: 38%;
            font-size: 24px;
        }

        .address-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .d-flex {
            display: flex !important
        }

        .image-table tr:nth-child(even) {
            background-color: #f2f2f2;
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
            width: 100%;
            font-size: 24px;
        }

        .background-table {
            border: 1px solid #e0e0e0;
            width: 94%;
            font-size: 24px;
            margin-left: 15%;
        }

        .background-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .text-center{
            text-align: center;
        }

        .user-img {
            box-shadow: 0 0 5px 3px #e0e0e0 !important;
            margin-left: 15%;
        }
    </style>
</head>
<body>
<div class="main-container">
    <div class="d-flex mt--35px">
        <h2 class="mr-38-per">Profile</h2>
        <h2>Mishra Abhishek, Abia State, India</h2>
    </div>
    <div class="d-flex">
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
            </tr>
            <tr>
                <td colspan="2">
                    <b>Date of Birth:</b> {{(isset($data['employee_personal_details']) && isset($data['employee_personal_details']['date_of_birth'])) ? $data['employee_personal_details']['date_of_birth'] : ''}}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Martial Status:</b> {{(isset($data['employee_personal_details']) && isset($data['employee_personal_details']['marital_status'])) ? $data['employee_personal_details']['marital_status'] : ''}}
                </td>
            </tr>
            <tr>
                <td>
                    <b>Date of 1st Appt:</b> {{(isset($data['employee_personal_details']) && isset($data['employee_personal_details']['appointed_on'])) ? $data['employee_personal_details']['appointed_on'] : ''}}
                </td>
                <td>
                    <b>Length of Service:</b> 0 Years
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Relatives (Staff) / Time of Service:</b>
                </td>
            </tr>
            </tbody>
        </table>
        <table class="image-table">
            <tbody>
            <tr>
                <td>
                    <img src="{{(isset($data['file'])) ? $data['file']['name'] : ''}}" class="user-img" />
                </td>
            </tr>
            <tr class="shadow">
                <td>
                    <b>Email:</b> {{(isset($data['employee_personal_details']) && isset($data['employee_personal_details']['email'])) ? $data['employee_personal_details']['email'] : ''}}
                </td>
            </tr>
            <tr class="shadow">
                <td>
                    <b>Phone No:</b> {{(isset($data['employee_personal_details']) && isset($data['employee_personal_details']['phone'])) ? $data['employee_personal_details']['phone'] : ''}}
                </td>
            </tr>
            </tbody>
        </table>
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
                    <b>Geographic Location:</b>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <b>Position:</b> VP Sales
                </td>
            </tr>
            <tr>
                <td>
                    <b>Supervisor:</b> 05-Dec-1994
                </td>
                <td>
                    <b>Level No:</b> 1
                </td>
                <td>
                    <b>Other Language:</b> 1
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <b>Degree (Master or Specialization):</b> Single
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="d-flex mt-15px">
        <h3 class="mr-38-per">COMPETENCIES:</h3>
        <h3>BACKGROUND:</h3>
    </div>
    <div class="d-flex">
        <div style="width: 38%">
            <div class="d-flex">
                <table class="competencies-table">
                    <tr>
                        <td>
                                {{(isset($data['employee_job_profiles']) && isset($data['employee_job_profiles']['job_position']) && isset($data['employee_job_profiles']['job_position']['competences'])) ? $data['employee_job_profiles']['job_position']['competences'] : ''}}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="d-flex mt-15px">
                <h3 class="mr-38-per">ACTIVITIES OF POSITION:</h3>
            </div>
            <table class="competencies-table">
                <tr>
                    <td>
                        {{(isset($data['employee_job_profiles']) && isset($data['employee_job_profiles']['job_position']) && isset($data['employee_job_profiles']['job_position']['activities'])) ? $data['employee_job_profiles']['job_position']['activities'] : ''}}
                    </td>
                </tr>
            </table>
        </div>
        <div style="width: 57%">
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
        </div>
    </div>
</div>
</body>
</html>
