<?php
/**
 * Created by PhpStorm.
 * User: keshavashta
 * Date: 2019-05-13
 * Time: 18:16
 */

namespace App\Constants;


class AppConstant
{

    const EMPLOYEE_MARITAL_STATUS_MARRIED = 'MARRIED';
    const EMPLOYEE_MARITAL_STATUS_SINGLE = 'SINGLE';
    const EMPLOYEE_MARITAL_STATUS_DIVORCED = 'DIVORCED';
    const EMPLOYEE_MARITAL_STATUS_WIDOWED = 'WIDOWED';
    const EMPLOYEE_MARITAL_STATUS_OTHER = 'OTHER';

    const EMPLOYEE_GENDER_MALE = 'MALE';
    const EMPLOYEE_GENDER_FEMALE = 'FEMALE';

    const EMPLOYEE_RELIGION_CHRISTIANITY = 'CHRISTIANITY';
    const EMPLOYEE_RELIGION_ISLAM = 'ISLAM';
    const EMPLOYEE_RELIGION_OTHER = 'OTHER';

    const EMPLOYEE_TYPE_APPOINTMENT_PERMANENT_STAFF = 'PERMANENT_STAFF';
    const EMPLOYEE_TYPE_APPOINTMENT_TENURED = 'TENURED';
    const EMPLOYEE_TYPE_APPOINTMENT_SABBATICAL = 'SABBATICAL';
    const EMPLOYEE_TYPE_APPOINTMENT_VISITING = 'VISITING';
    const EMPLOYEE_TYPE_APPOINTMENT_CONTRACT = 'CONTRACT';
    const EMPLOYEE_TYPE_APPOINTMENT_ADJUNCT = 'ADJUNCT';
    const EMPLOYEE_TYPE_APPOINTMENT_MONTH_TO_MONTH = 'MONTH_TO_MONTH';
    const EMPLOYEE_TYPE_APPOINTMENT_TEMPORARY = 'TEMPORARY';
    const EMPLOYEE_TYPE_APPOINTMENT_FULL_TIME = 'FULL_TIME';
    const EMPLOYEE_TYPE_APPOINTMENT_NOT_APPLICABLE = 'NOT_APPLICABLE';


    const RETIRE_TYPE_FIRST_APPOINTMENT = 'FIRST_APPOINTMENT';
    const RETIRE_TYPE_CURRENT_APPOINTMENT = 'CURRENT_APPOINTMENT';
    const RETIRE_TYPE_DATE_OF_BIRTH = 'DATE_OF_BIRTH';

    const PROGRESSION_STATUS_ACTIVE = 'ACTIVE';
    const PROGRESSION_STATUS_NEW = 'NEW';
    const PROGRESSION_STATUS_RETIRE = 'RETIRE';
    const PROGRESSION_STATUS_RETIREMENT_DUE = 'RETIREMENT_DUE';
    const PROGRESSION_STATUS_CONFIRMED = 'CONFIRMED';
    const PROGRESSION_STATUS_CONFIRMATION_DUE = 'CONFIRMATION_DUE';
    const PROGRESSION_STATUS_INCREMENT = 'INCREMENT';
    const PROGRESSION_STATUS_INCREMENT_DUE = 'INCREMENT_DUE';
    const PROGRESSION_STATUS_PROMOTION = 'PROMOTION';
    const PROGRESSION_STATUS_PROMOTION_DUE = 'PROMOTION_DUE';

    const LANGUAGE_PROFICIENCY_NO = 'NO';
    const LANGUAGE_PROFICIENCY_POOR = 'POOR';
    const LANGUAGE_PROFICIENCY_GOOD = 'GOOD';
    const LANGUAGE_PROFICIENCY_VERY_GOOD = 'VERY GOOD';

//    Admin segment Constants
    const ADMIN_SEGMENT_CHARACTER_COUNT = 2;

    const COMPANY_TYPE_SUPPLIER = 'SUPPLIER';
    const COMPANY_TYPE_DEPARTMENT = 'DEPARTMENT';
    const COMPANY_TYPE_CUSTOMER = 'CUSTOMER';
    const TYPE_IN = 'IN';
    const TYPE_OUT = 'OUT';
}
