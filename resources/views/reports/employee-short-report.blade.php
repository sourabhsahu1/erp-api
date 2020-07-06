<!DOCTYPE html>
<html>
<head>
    <title>Staff</title>
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

        .main-container {
            box-shadow: 0 0 1px 2px #000;
            padding: 20px;
            border-radius: 10px;
        }

        .staff-details {
            width: 45%
        }

        .staff-details-table {
            width: 100%;
            font-size: 15px;
            border: 1px solid #e0e0e0;
        }

        .staff-details-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .staff-header {
            background-color: #020a30;
            color: white
        }

        .img-citizenship-details {
            width: 50%;
            font-size: 15px;
        }

        .citizenship-details {
            width: 100%
        }

        .citizenship-details-table {
            width: 100%;
        }

        .citizenship-details-header {
            background-color: #020a30;
            color: white
        }

        .citizenship-details-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .user-img {
            box-shadow: 0 0 5px 3px #e0e0e0 !important;
            width: 30%;
            height: 230px !important;
            margin-left: 30%;
            margin-bottom: 20px;
        }

        .contact-address-details {
            width: 100%;
        }

        .contact-address-table {
            width: 100%;
            margin-top: 70px;
            font-size: 15px;
            border: 1px solid #e0e0e0;
        }

        .contact-address-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .contact-address-header {
            background-color: #020a30;
            color: white
        }
    </style>
</head>
<body>
<div class="main-container">
    <table style="width: 100%">
        <tr>
            <td style="width: 50%">
                <table class="staff-details-table">
                    <thead class="staff-header">
                    <tr>
                        <th colspan="2">Staff Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Staff ID:</td>
                        <td>{{$data['id']}}</td>
                    </tr>
                    <tr>
                        <td>Last Name:</td>
                        <td>{{isset($data['last_name']) ? $data['last_name'] : ''}}</td>
                    </tr>
                    <tr>
                        <td>First Name:</td>
                        <td>{{isset($data['first_name']) ? $data['first_name'] : ''}}</td>
                    </tr>
                    <tr>
                        <td>Marital Status:</td>
                        <td>{{(isset($data['employee_personal_details']) && isset($data['employee_personal_details']['marital_status'])) ? $data['employee_personal_details']['marital_status'] : ''}}</td>
                    </tr>
                    <tr>
                        <td>Religion:</td>
                        <td>{{(isset($data['employee_personal_details']) && isset($data['employee_personal_details']['religion'])) ? $data['employee_personal_details']['religion'] : ''}}</td>
                    </tr>
                    <tr>
                        <td>Birth Date:</td>
                        <td>{{(isset($data['employee_personal_details']) && isset($data['employee_personal_details']['date_of_birth'])) ? \Illuminate\Support\Carbon::parse($data['employee_personal_details']['date_of_birth'])->toDateString() : ''}}</td>
                    </tr>

                    <tr>
                        <td>Department:</td>
                        <td>{{(isset($data['employee_job_profiles']) && isset($data['employee_job_profiles']['department'])) ? $data['employee_job_profiles']['department']['name'] : ''}}</td>
                    </tr>
                    <tr>
                        <td>Designation:</td>
                        <td>{{(isset($data['employee_job_profiles']) && isset($data['employee_job_profiles']['designation'])) ? $data['employee_job_profiles']['designation']['name'] : ''}}  </td>
                    </tr>
                    <tr>
                        <td>Date Employed:</td>
                        <td>{{(isset($data['employee_personal_details']) && isset($data['employee_personal_details']['appointed_on'])) ?\Illuminate\Support\Carbon::parse($data['employee_personal_details']['appointed_on'])->toDateString()  : ''}}</td>

                    </tr>
                    <tr>
                        <td>Current App Date:</td>
                        <td>{{(isset($data['employee_job_profiles']) && isset($data['employee_job_profiles']['current_appointment'])) ?  \Illuminate\Support\Carbon::parse($data['employee_job_profiles']['current_appointment'])->toDateString(): ''}}</td>
                    </tr>
                    <tr>
                        <td>Location:</td>
                        <td>{{(isset($data['employee_job_profiles']) && isset($data['employee_job_profiles']['work_location'])) ? $data['employee_job_profiles']['work_location']['name'] : ''}}</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td class="img-citizenship-details">
                <table style="width: 100%">
                    <tr>
                        <td>
                            <img src="{{(isset($data['file'])) ? $data['file']['url'] : ''}}" class="user-img" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class="citizenship-details-table">
                                <thead class="citizenship-details-header">
                                <tr>
                                    <th colspan="2">Citizenship Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Country:</td>
                                    <td>{{(isset($data['employee_contact_details']) && isset($data['employee_contact_details']['country'])) ? $data['employee_contact_details']['country']['name'] : ''}}</td>
                                </tr>
                                <tr>
                                    <td>Region:</td>
                                    <td>{{(isset($data['employee_contact_details']) && isset($data['employee_contact_details']['region'])) ? $data['employee_contact_details']['region']['name'] : ''}}</td>
                                </tr>
                                <tr>
                                    <td>State:</td>
                                    <td>{{(isset($data['employee_contact_details']) && isset($data['employee_contact_details']['state'])) ? $data['employee_contact_details']['state']['name'] : ''}}</td>
                                </tr>
                                <tr>
                                    <td>LGA</td>
                                    <td>{{(isset($data['employee_contact_details']) && isset($data['employee_contact_details']['lga'])) ? $data['employee_contact_details']['lga']['name'] : ''}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <div class="contact-address-details">
        <table class="contact-address-table">
            <thead class="contact-address-header">
            <tr>
                <th colspan="2">Contact Address Details</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Address:</td>
                <td>{{(isset($data['employee_contact_details']) && isset($data['employee_contact_details']['address_line_1'])) ? $data['employee_contact_details']['address_line_1'] : ''}}</td>
            </tr>
            <tr>
                <td>Street:</td>
                <td>{{(isset($data['employee_contact_details']) && isset($data['employee_contact_details']['address_line_2'])) ? $data['employee_contact_details']['address_line_2'] : ''}}</td>
            </tr>
            <tr>
                <td>City:</td>
                <td>{{(isset($data['employee_contact_details']) && isset($data['employee_contact_details']['city'])) ? $data['employee_contact_details']['city'] : ''}}</td>
            </tr>
            <tr>
                <td>Country:</td>
                <td>{{(isset($data['employee_contact_details']) && isset($data['employee_contact_details']['other_country'])) ? $data['employee_contact_details']['other_country']['name'] : ''}}</td>
            </tr>
            <tr>
                <td>Region:</td>
                <td>{{(isset($data['employee_contact_details']) && isset($data['employee_contact_details']['other_region'])) ? $data['employee_contact_details']['other_region']['name'] : ''}}</td>
            </tr>
            <tr>
                <td>State:</td>
                <td>{{(isset($data['employee_contact_details']) && isset($data['employee_contact_details']['other_state'])) ? $data['employee_contact_details']['other_state']['name'] : ''}}</td>
            </tr>
            <tr>
                <td>LGA:</td>
                <td>{{(isset($data['employee_contact_details']) && isset($data['employee_contact_details']['other_lga'])) ? $data['employee_contact_details']['other_lga']['name'] : ''}}</td>
            </tr>
            <tr>
                <td>Sex:</td>
                <td>{{(isset($data['employee_personal_details']) && isset($data['employee_personal_details']['gender'])) ? $data['employee_personal_details']['gender'] : ''}}</td>
            </tr>
            <tr>
                <td>Phone No.:</td>
                <td>{{(isset($data['employee_personal_details']) && isset($data['employee_personal_details']['phone'])) ? $data['employee_personal_details']['phone'] : ''}}</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>{{(isset($data['employee_personal_details']) && isset($data['employee_personal_details']['email'])) ? $data['employee_personal_details']['email'] : ''}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
