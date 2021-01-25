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
    const COMPANY_TYPE_STORE = 'STORE';
    const TYPE_IN = 'IN';
    const TYPE_OUT = 'OUT';

    // Coasting Methods
    const COSTING_METHOD_LIFO = 'LIFO';
    const COSTING_METHOD_FIFO = 'FIFO';
    const COSTING_METHOD_AVG = 'AVG';


    //JV
    const JV_STATUS_ALL = 'ALL';
    const JV_STATUS_NEW = 'NEW';
    const JV_STATUS_CHECKED = 'CHECKED';
    const JV_STATUS_POSTED = 'POSTED';
    const LINE_VALUE_TYPE_DEBIT = 'DEBIT';
    const LINE_VALUE_TYPE_CREDIT = 'CREDIT';


    //BUDGET
    const BUDGET_TYPE_ECONOMIC = 'ECONOMIC';
    const BUDGET_TYPE_PROGRAM = 'PROGRAM';


    const PAYEE_EMPLOYEE = 'EMPLOYEE';
    const PAYEE_CUSTOMER = 'CUSTOMER';


    //Treasury payment voucher
    const VOUCHER_TYPE_EXPENDITURE_VOUCHER = 'EXPENDITURE_VOUCHER';
    const VOUCHER_TYPE_NON_PERSONAL_VOUCHER = 'NON_PERSONAL_VOUCHER';
    const VOUCHER_TYPE_PERSONAL_ADVANCES_VOUCHER = 'PERSONAL_ADVANCES_VOUCHER';
    const VOUCHER_TYPE_SPECIAL_VOUCHER = 'SPECIAL_VOUCHER';
    const VOUCHER_TYPE_STANDING_VOUCHER = 'STANDING_VOUCHER';
    const VOUCHER_TYPE_TRANSFER_CASHBOOK_VOUCHER = 'TRANSFER_CASHBOOK_VOUCHER';
    const VOUCHER_TYPE_REMITTANCE_VOUCHER = 'REMITTANCE_VOUCHER';
    const VOUCHER_TYPE_DEPOSIT_VOUCHER = 'DEPOSIT_VOUCHER';
    const VOUCHER_TYPE_EXPENDITURE_CREDIT_VOUCHER = 'CREDIT_VOUCHER';


    const VOUCHER_STATUS_NEW = 'NEW';
    const VOUCHER_STATUS_CHECKED = 'CHECKED';
    const VOUCHER_STATUS_DRAFT = 'DRAFT';
    const VOUCHER_STATUS_APPROVED = 'APPROVED';
    const VOUCHER_STATUS_BUDGET_CONTROL_VERIFIED = 'BUDGET_CODES_VERIFIED';
    const VOUCHER_STATUS_AUDITED = 'AUDITED';
    const VOUCHER_STATUS_ON_MANDATE = 'ON_MANDATE';
    const VOUCHER_STATUS_CLOSED = 'CLOSED';
    const VOUCHER_STATUS_POSTED_TO_GL = 'POSTED_TO_GL';
    const VOUCHER_STATUS_PAID = 'PAID';


    //Treasury receipt voucher
    const RECEIPT_VOUCHER_STATUS_NEW = 'NEW';
    const RECEIPT_VOUCHER_STATUS_CLOSED = 'CLOSED';
    const RECEIPT_VOUCHER_STATUS_POSTED_TO_GL = 'POSTED_TO_GL';


    const VOUCHER_TYPE_REVENUE_VOUCHER = 'REVENUE_VOUCHER';
    const VOUCHER_TYPE_NON_PERSONAL_ADVANCES_RECEIVED_VOUCHER = 'NON_PERSONAL_ADVANCES_RECEIVED';
    const VOUCHER_TYPE_SPECIAL_IMPREST_RECEIVED_VOUCHER = 'SPECIAL_IMPREST_RECEIVED';
    const VOUCHER_TYPE_STANDING_IMPREST_RECEIVED_VOUCHER = 'STANDING_IMPREST_RECEIVED';
    const VOUCHER_TYPE_REMITTANCE_RECEIVED_VOUCHER = 'REMITTANCE_RECEIVED';
    const VOUCHER_TYPE_DEPOSIT_RECEIVED_VOUCHER = 'DEPOSIT_RECEIVED';
    const VOUCHER_TYPE_REVENUE_DEBIT_VOUCHER = 'REVENUE_DEBIT';


    //Paymode
    const RECEIPT_PAY_MODE_CASH = 'CASH';
    const RECEIPT_PAY_MODE_DIRECT_PAYMENTS = 'DIRECT_PAYMENT';
    const RECEIPT_PAY_MODE_INSTRUMENTS = 'INSTRUMENTS';


    const REPORT_TYPE_SEMESTER = 'SEMESTER';
    const REPORT_TYPE_QUARTER = 'QUARTER';
    const REPORT_TYPE_MONTHLY = 'MONTHLY';

    const REPORT_APPLICATION_OF_FUND = 'APPLICATION_OF_FUNDS';
    const REPORT_USES_OF_FUND = 'USES_OF_FUNDS';

    const ON_MANDATE_NEW = 'NEW';
    const ON_MANDATE_1ST_AUTHORISED = '1ST_AUTHORISED';
    const ON_MANDATE_2ND_AUTHORISED = '2ND_AUTHORISED';
    const ON_MANDATE_POSTED_TO_GL = 'POSTED_TO_GL';


    const RETIRE_VOUCHER_NEW = 'EDIT_LIABILITY';
    const RETIRE_VOUCHER_RETIRE = 'RETIRE';
    const RETIRE_VOUCHER_CHECKED = 'CHECKED';
    const RETIRE_VOUCHER_APPROVED = 'APPROVED';
    const RETIRE_VOUCHER_BUDGET_CODES_VERIFIED = 'BUDGET_CODES_VERIFIED';
    const RETIRE_VOUCHER_AUDITED = 'AUDITED';
    const RETIRE_VOUCHER_CLOSED = 'CLOSED';
    const RETIRE_VOUCHER_RETIRE_POSTED_TO_GL = 'POSTED_TO_GL';


    //payment approval
    const PAYMENT_APPROVAL_NEW = 'NEW';
    const PAYMENT_APPROVAL_CHECKED = 'CHECKED';
    const PAYMENT_APPROVAL_APPROVED_AND_READY = 'APPROVED_AND_READY';
    const PAYMENT_APPROVAL_READY_FOR_PV = 'READY_FOR_PV';
    const PAYMENT_APPROVAL_FULLY_USED = 'FULLY_USED';

}
