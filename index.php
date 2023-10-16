<?php

/**
 * Quickad classified native android application API
 * @author Bylancer
 * @version 1.5
 * @Date: 30/Jan/2020
 * @url https://codecanyon.net/item/quickad-classified-native-android-app/23956447
 * @Copyright (c) 2015-19 Devendra Katariya (bylancer.com)
 */

// Path to root directory of app.
define("ROOTPATH", dirname(dirname(__DIR__)));

require_once('../../includes/config.php');
require_once('../../includes/sql_builder/idiorm.php');
require_once('../../includes/db.php');
require_once('../../includes/classes/class.template_engine.php');
require_once('../../includes/classes/class.country.php');
require_once('../../includes/functions/func.global.php');
require_once('../../includes/lib/password.php');
require_once('../../includes/functions/func.sqlquery.php');
require_once('../../includes/functions/func.users.php');
require_once('../../includes/lang/lang_' . $config['lang'] . '.php');
require_once('../../includes/seo-url.php');
require_once('../../includes/lib/php-jwt/src/BeforeValidException.php');
require_once('../../includes/lib/php-jwt/src/ExpiredException.php');
require_once('../../includes/lib/php-jwt/src/SignatureInvalidException.php');
require_once('../../includes/lib/php-jwt/src/JWT.php');
require_once('../../includes/lib/php-jwt/src/Key.php');


use Firebase\JWT\JWT;
use Firebase\JWT\Key;

global $key;
$key = "example_key";

display_error(true);

$con = db_connect();
sec_session_start();

const HTTP_METHOD_NOT_ALLOWED = 405;

/**
 * The request cannot be fulfilled due to multiple errors
 */
const HTTP_BAD_REQUEST = 400;

/**
 * Request Timeout
 */
const HTTP_REQUEST_TIMEOUT = 408;

/**
 * The requested resource could not be found
 */
const HTTP_NOT_FOUND = 404;

/**
 * The user is unauthorized to access the requested resource
 */
const HTTP_UNAUTHORIZED = 401;

/**
 * The request has succeeded
 */
const HTTP_OK = 200;

const HTTP_UNPROCESSABLE_ENTITY = 422;

/**
 * HTTP status codes and their respective description
 */
const HEADER_STATUS_STRINGS = [
    '405' => 'HTTP/1.1 405 Method Not Allowed',
    '400' => 'BAD REQUEST',
    '408' => 'Request Timeout',
    '404' => 'NOT FOUND',
    '401' => 'UNAUTHORIZED',
    '200' => 'OK',
];


if (isset($_REQUEST['action'])) {

    if ($_REQUEST['action'] == "app_config") {
        app_config();
    }
    if ($_REQUEST['action'] == "payment_api_detail_config") {
        payment_api_detail_config();
    }
    if ($_REQUEST['action'] == "login") {
        login();
    }
    if ($_REQUEST['action'] == 'logout') {
        logout();
    }
    if ($_REQUEST['action'] == "forgot_password") {
        forgot_password();
    }
    if ($_REQUEST['action'] == "register_account") {
        register_account();
    }
    if ($_REQUEST['action'] == "get_userdata_by_email") {
        get_userdata_by_email();
    }  //not Using
    if ($_REQUEST['action'] == "featured_urgent_ads") {
        featured_urgent_ads();
    }
    if ($_REQUEST['action'] == "home_latest_ads") {
        home_latest_ads();
    }
    if ($_REQUEST['action'] == "home_premium_ads") {
        home_premium_ads();
    }
    if ($_REQUEST['action'] == "related_ads") {
        related_ads();
    }
    if ($_REQUEST['action'] == "ad_detail") {
        ad_detail();
    }
    if ($_REQUEST['action'] == "ad_delete") {
        ad_delete();
    }
    if ($_REQUEST['action'] == "installed_countries") {
        installed_countries();
    }
    if ($_REQUEST['action'] == "getStateByCountryCode") {
        getStateByCountryCode();
    }
    if ($_REQUEST['action'] == "getCityByStateCode") {
        getCityByStateCode();
    }
    if ($_REQUEST['action'] == "getCityidByCityName") {
        getCityidByCityName();
    }

    if ($_REQUEST['action'] == "get_all_msg") {
        get_all_msg();
    }
    if ($_REQUEST['action'] == "chat_conversation") {
        chat_conversation();
    }
    if ($_REQUEST['action'] == "send_message") {
        send_message();
    }
    if ($_REQUEST['action'] == "upload_chat_file") {
        uploadChatFile();
    }
    if ($_REQUEST['action'] == "updateSeenmsg") {
        updateSeenmsg();
    }

    if ($_REQUEST['action'] == "unread_note_chat_count") {
        unread_note_chat_count();
    }
    if ($_REQUEST['action'] == "languages_list") {
        languages_list();
    }
    if ($_REQUEST['action'] == "language_file") {
        language_file();
    }
    if ($_REQUEST['action'] == "categories") {
        categories();
    }
    if ($_REQUEST['action'] == "sub_categories") {
        sub_categories();
    }
    if ($_REQUEST['action'] == "favourite_jobs") {
        favourite_jobs();
    }
    if ($_REQUEST['action'] == "add_remove_favorite_user") {
        add_remove_favorite_user();
    }
    if ($_REQUEST['action'] == "add_remove_favorite_job") {
        add_remove_favorite_job();
    }
    if ($_REQUEST['action'] == "payment_success_saving") {
        payment_success_saving();
    }
    if ($_REQUEST['action'] == "get_userMembership_by_id") {
        get_userMembership_by_id();
    }
    if ($_REQUEST['action'] == "get_membership_plan") {
        get_membership_plan();
    }

    if ($_REQUEST['action'] == "make_offer") {
        make_offer();
    }
    if ($_REQUEST['action'] == "get_notification") {
        get_notification();
    }
    if ($_REQUEST['action'] == "add_firebase_device_token") {
        add_firebase_device_token();
    }
    if ($_REQUEST['action'] == "user_custom_field_list") {
        user_custom_field_list();
    }

    if ($_REQUEST['action'] == "getCustomFieldByCatID") {
        getCustomFieldByCatID();
    }
    if ($_REQUEST['action'] == "send_cusdata_getjson") {
        send_cusdata_getjson();
    }
    if ($_REQUEST['action'] == "custom_fields_json") {
        custom_fields_json();
    }
    if ($_REQUEST['action'] == "upload_product_picture") {
        upload_product_picture();
    }
    if ($_REQUEST['action'] == "upload_profile_picture") {
        upload_profile_picture();
    }
    if ($_REQUEST['action'] == "save_post") {
        save_post();
    }
    if ($_REQUEST['action'] == "edit_post") {
        edit_post();
    }
    if ($_REQUEST['action'] == "remove_post") {
        remove_post();
    }

    if ($_REQUEST['action'] == "search_post") {
        search_post();
    }
    if ($_REQUEST['action'] == "hide_post") {
        hide_post();
    }
    if ($_REQUEST['action'] == "payumoney_create_hash") {
        payumoney_create_hash();
    }
    // User Profile APIs
    if ($_REQUEST['action'] == "get_user_profile_data") {
        get_user_profile_data();
    }
    if ($_REQUEST['action'] == "edit_profile") {
        edit_profile();
    }
    if ($_REQUEST['action'] == "get_user_address_details") {
        get_user_address_details();
    }
    if ($_REQUEST['action'] == "check_user_address_details_completed") {
        check_user_address_details_completed();
    }

    if ($_REQUEST['action'] == 'set_user_address_details') {
        set_user_address_details();
    }

    if ($_REQUEST['action'] == "get_rate_and_availability") {
        get_rate_and_availability();
    }
    if ($_REQUEST['action'] == "set_rate_and_availability") {
        set_rate_and_availability();
    }
    if ($_REQUEST['action'] == "get_cultural_background_list") {
        get_cultural_background_list();
    }
    if ($_REQUEST['action'] == "get_user_cultural_background") {
        get_user_cultural_background();
    }
    // if ($_REQUEST['action'] == "set_user_cultural_background") {
    //     set_user_cultural_background();
    // }
    if ($_REQUEST['action'] == "get_user_educations") {
        get_user_educations();
    }
    if ($_REQUEST['action'] == "set_user_education") {
        set_user_education();
    }
    if ($_REQUEST['action'] == "remove_user_education") {
        remove_user_education();
    }
    if ($_REQUEST['action'] == "get_user_experiences") {
        get_user_experiences();
    }
    if ($_REQUEST['action'] == "set_user_experience") {
        set_user_experience();
    }
    if ($_REQUEST['action'] == "remove_user_experience") {
        remove_user_experience();
    }
    if ($_REQUEST['action'] == "getUserAdditionalInformation") {
        getUserAdditionalInformation();
    }
    if ($_REQUEST['action'] == "getUserImmunisationInfo") {
        getUserImmunisationInfo();
    }
    if ($_REQUEST['action'] == "setUserImmunisationInfo") {
        setUserImmunisationInfo();
    }
    if ($_REQUEST['action'] == "getAllSkillLevel") {
        all_skill_level();
    }
    if ($_REQUEST['action'] == "skill_list") {
        get_skill_list();
    }
    if ($_REQUEST['action'] == "get_user_skills") {
        getUserSkills();
    }
    if ($_REQUEST['action'] == "set_user_skills") {
        set_user_skills();
    }
    if ($_REQUEST['action'] == "get_profile_language_list") {
        profile_language_list();
    }
    if ($_REQUEST['action'] == "get_user_profile_language") {
        getUserProfileLanguages();
    }
    // if ($_REQUEST['action'] == "set_user_profile_language") {
    //     set_user_profile_language();
    // }
    if ($_REQUEST['action'] == "get_religion_list") {
        religion_list();
    }
    if ($_REQUEST['action'] == "get_provider_list") {
        get_provider_list();
    }
    if ($_REQUEST['action'] == "get_user_religion") {
        get_user_religion();
    }
    // if ($_REQUEST['action'] == "set_user_religion") {
    //     set_user_religion();
    // }
    if ($_REQUEST['action'] == "get_user_preferences") {
        get_user_preferences();
    }
    if ($_REQUEST['action'] == "set_user_preferences") {
        set_user_preferences();
    }
    if ($_REQUEST['action'] == "interest_and_hobbies_list") {
        interest_and_hobbies_list();
    }

    if ($_REQUEST['action'] == "get_user_interest_hobbies") {
        getUserInterestHobbies();
    }
    // if ($_REQUEST['action'] == "set_user_interest") {
    //     set_user_interest();
    // }
    if ($_REQUEST['action'] == "get_user_aboutme") {
        get_user_aboutme();
    }
    if ($_REQUEST['action'] == "set_user_aboutme") {
        set_user_aboutme();
    }
    if ($_REQUEST['action'] == "getUserCustomFields") {
        getUserCustomFields();
    }
    if ($_REQUEST['action'] == "setUserCustomFields") {
        setUserCustomFields();
    }
    /* End of User Profile Api */
    if ($_REQUEST['action'] == "apply_to_job") {
        applyToJob();
    }
    if ($_REQUEST['action'] == "search_cities") {
        search_cities();
    }
    if ($_REQUEST['action'] == "get_agreement_data") {
        get_agreement_data();
    }
    if ($_REQUEST['action'] == "update_agreement_status") {
        update_agreement_status();
    }
    if ($_REQUEST['action'] == "get_agreement_with_rates") {
        get_agreement_with_rates();
    }
    if ($_REQUEST['action'] == "save_agreement") {
        save_agreement();
    }
    if ($_REQUEST['action'] == "remove_agreement") {
        remove_agreement();
    }
    if ($_REQUEST['action'] == "get_user_all_agreements") {
        get_user_all_agreements();
    }
    if ($_REQUEST['action'] == "get_user_profile_details") {
        get_user_profile_details();
    }

    if ($_REQUEST['action'] == "popular_cities") {
        popularCities();
    }
    if ($_REQUEST['action'] == "user_nearby_cities") {
        userNearbyCity();
    }

    if ($_REQUEST['action'] == "search_seeker") {
        search_seeker();
    }
    if ($_REQUEST['action'] == "get_user_resume") {
        get_user_resume();
    }
    if ($_REQUEST['action'] == "save_resume") {
        save_resume();
    }
    if ($_REQUEST['action'] == "delete_resume") {
        delete_resume();
    }
    if ($_REQUEST['action'] == "report_job") {
        report_job();
    }
    //manage-jobs (Consumer)
    if ($_REQUEST['action'] == "get_employer_job_list") {
        get_employer_job_list();
    }
    if ($_REQUEST['action'] == "applied_jobs") {
        applied_jobs();
    }

    if ($_REQUEST['action'] == "get_timesheets") {
        get_timesheets();
    }
    if ($_REQUEST['action'] == "getShiftById") {
        getShiftById();
    }
    if ($_REQUEST['action'] == "incident_detail") {
        incident_detail();
    }
    if ($_REQUEST['action'] == 'save_shift') {
        save_shift();
    }

    if ($_REQUEST['action'] == 'approve_reject_shift') {
        approve_reject_shift();
    }
    if ($_REQUEST['action'] == 'delete_shift') {
        delete_shift();
    }
    if ($_REQUEST['action'] == 'available_agreement_rates') {
        userAvailableAgreementRates();
    }
    if ($_REQUEST['action'] == 'agreement_with_id_title') {
        agreementWithIdTitle();
    }
    if ($_REQUEST['action'] == 'applied_users') {
        applied_users();
    }
    if ($_REQUEST['action'] == 'set_user_visibility_status') {
        set_user_visibility_status();
    }
    if ($_REQUEST['action'] == 'get_user_account_details') {
        get_user_account_details();
    }
    if ($_REQUEST['action'] == 'user_account_setting') {
        user_account_setting();
    }
    if ($_REQUEST['action'] == 'user_bank_detail_setting') {
        user_bank_detail_setting();
    }
    if ($_REQUEST['action'] == 'abn_lookup_search') {
        abnLookupSearch();
    }
    if ($_REQUEST['action'] == 'user_invoice_details_setting') {
        user_invoice_details_setting();
    }
    if ($_REQUEST['action'] == 'get_user_documents') {
        get_user_documents();
    }
    if ($_REQUEST['action'] == 'requirement_list') {
        requirement_list();
    }
    if ($_REQUEST['action'] == 'save_document') {
        save_document();
    }
    if ($_REQUEST['action'] == 'delete_document') {
        delete_document();
    }
    if ($_REQUEST['action'] == 'invoice_list') {
        invoice_list();
    }
    if ($_REQUEST['action'] == 'invoiceById') {
        invoiceById();
    }

    if ($_REQUEST['action'] == 'user_notification_setting') {
        user_notification_setting();
    }

    if ($_REQUEST['action'] == 'user_transactions') {
        user_transactions();
    }
    if ($_REQUEST['action'] == 'user_wallet_history') {
        user_wallet_history();
    }
    if ($_REQUEST['action'] == 'withdraw_amount') {
        withdraw_amount();
    }
    if ($_REQUEST['action'] == 'wallet_add_amount_offline') {
        wallet_add_amount_offline();
    }
    if ($_REQUEST['action'] == 'wallet_add_amount_online') {
        wallet_add_amount_online();
    }
    if ($_REQUEST['action'] == 'createPaymentIntent') {
        createPaymentIntent();
    }
    if ($_REQUEST['action'] == 'reviews_list') {
        reviews_list();
    }
    if ($_REQUEST['action'] == 'reply_review') {
        reply_review();
    }
    if ($_REQUEST['action'] == 'productReviewById') {
        productReviewById();
    }
    if ($_REQUEST['action'] == 'userReviewById') {
        userReviewById();
    }
    if ($_REQUEST['action'] == 'save_product_review') {
        save_product_review();
    }
    if ($_REQUEST['action'] == 'save_review') {
        save_review();
    }

    if ($_REQUEST['action'] == 'invitation_details') {
        invitation_details();
    }
    if ($_REQUEST['action'] == 'save_shift_log') {
        save_shift_log();
    }
    if ($_REQUEST['action'] == 'notification_list') {
        notification_list();
    }
    if ($_REQUEST['action'] == 'mark_as_read') {
        mark_as_read();
    }
    if ($_REQUEST['action'] == 'dashboard_details') {
        dashboard_details();
    }
    if ($_REQUEST['action'] == 'job_filled_status') {
        job_filled_status();
    }
    if ($_REQUEST['action'] == 'resend_email') {
        resend_email();
    }
    if ($_REQUEST['action'] == 'get_salary_types') {
        get_salary_types();
    }
    if ($_REQUEST['action'] == 'user_profile_progress_bar') {
        profile_progress_bar();
    }
    if ($_REQUEST['action'] == 'set_user_address_details') {
        set_user_address_details();
    }
    if ($_REQUEST['action'] == 'user_progress_status') {
        user_progress_status();
    }
    if ($_REQUEST['action'] == 'category_based_document') {
        category_based_document();
    }

    if ($_REQUEST['action'] == "get_user_last_active_status") {
        get_user_last_active_status();
    }

    if ($_REQUEST['action'] == "worker_list") {
        worker_list();
    }
    if ($_REQUEST['action'] == "conversation_starter") {
        conversation_starter();
    }

    if ($_REQUEST['action'] == "find_city") {
        find_city();
    }
    if ($_REQUEST['action'] == "premium_job_payment") {
        premium_job_payment();
    }
    if ($_REQUEST['action'] == "product_type") {
        product_type();
    }
    if ($_REQUEST['action'] == "getCity_range") {
        getCity_range();
    }
    if ($_REQUEST['action'] == "show_offer_agreements_jobs") {
        show_offer_agreements_jobs();
    }
    if ($_REQUEST['action'] == "client_request_agreement") {
        client_request_agreement();
    }
    if ($_REQUEST['action'] == "getTimesheetDetailsById") {
        getTimesheetDetailsById();
    }
    if ($_REQUEST['action'] == "get_invoicePaymentListing") {
        get_invoicePaymentListing();
    }
    if ($_REQUEST['action'] == "invoice_Payment_Wallet") {
        invoice_Payment_Wallet();
    }
    if ($_REQUEST['action'] == "invoice_Payment_online") {
        invoice_Payment_online();
    }
    if ($_REQUEST['action'] == "showInvoiceAllAmount") {
        showInvoiceAllAmount();
    }

    if ($_REQUEST['action'] == "get_city_range") {
        get_city_range();
    }

    if ($_REQUEST['action'] == "set_additional_info") {
        set_additional_info();
    }

    if ($_REQUEST['action'] == "get_additional_info") {
        get_additional_info();
    }

    if ($_REQUEST['action'] == "get_timesheet_filter") {
        get_timesheet_filter();
    }
}

$status = "";
$message = "";
$results = array();
$status_code = "";
/*Request Fields (* are mandatory)*/

/*
Payment Success Saving Order
action = payment_success_saving
1. name
2. amount
3. user_id
4. product_id
5. featured
6. urgent
7. highlight
8. folder
9. payment_type
10. trans_desc

Messages
1. Success : success
*/
function payment_success_saving()
{
    global $config, $lang, $link;
    $pdo = ORM::get_db();
    //$lang_code = isset($_REQUEST['lang_code']) ? $_REQUEST['lang_code'] : null;
    $title = $_REQUEST['name'];
    $amount = $_REQUEST['amount'];
    $folder = $_REQUEST['folder'];
    $payment_type = $_REQUEST['payment_type'];
    $user_id = $_REQUEST['user_id'];
    $now = time();
    $trans_desc = $title;

    if ($payment_type == "subscr") {
        $subcription_id = $_REQUEST['sub_id'];

        // Check that the payment is valid
        $subsc_details = ORM::for_table($config['db']['pre'] . 'subscriptions')
            ->where('sub_id', $subcription_id)
            ->find_one();
        if (!empty($subsc_details)) {
            // output data of each row

            $term = 0;
            if ($subsc_details['sub_term'] == 'DAILY') {
                $term = 86400;
            } elseif ($subsc_details['sub_term'] == 'WEEKLY') {
                $term = 604800;
            } elseif ($subsc_details['sub_term'] == 'MONTHLY') {
                $term = 2678400;
            } elseif ($subsc_details['sub_term'] == 'YEARLY') {
                $term = 31536000;
            }

            $sub_group_id = $subsc_details['group_id'];
            $sub_amount = $subsc_details['sub_amount'];

            $subsc_check = ORM::for_table($config['db']['pre'] . 'upgrades')
                ->where('user_id', $user_id)
                ->count();
            if ($subsc_check == 1) {
                $txn_type = 'subscr_update';
            } else {
                $txn_type = 'subscr_signup';
            }

            // Add time to their subscription
            $expires = (time() + $term);

            if ($txn_type == 'subscr_update') {

                $query = "UPDATE `" . $config['db']['pre'] . "upgrades` SET `sub_id` = '" . validate_input($subcription_id) . "',`upgrade_expires` = '" . validate_input($expires) . "' WHERE `user_id` = '" . validate_input($user_id) . "' LIMIT 1 ";
                $pdo->query($query);

                $person = ORM::for_table($config['db']['pre'] . 'user')->find_one($user_id);
                $person->group_id = $sub_group_id;
                $person->save();
            } elseif ($txn_type == 'subscr_signup') {
                $unique_subscription_id = uniqid();
                $subscription_status = "Active";

                $subscription_stripe_customer_id = isset($_REQUEST['customer_id']) ? $_REQUEST['customer_id'] : null;
                $subscription_stripe_subscription_id = isset($_REQUEST['subscription_id']) ? $_REQUEST['subscription_id'] : null;
                $subscription_billing_day = isset($_REQUEST['billing_day']) ? $_REQUEST['billing_day'] : null;
                $subscription_length = 0;
                $subscription_interval = isset($_REQUEST['interval']) ? $_REQUEST['interval'] : null;
                $subscription_trial_days = isset($_REQUEST['trial_days']) ? $_REQUEST['trial_days'] : null;
                $subscription_date_trial_ends = isset($_REQUEST['date_trial_ends']) ? $_REQUEST['date_trial_ends'] : null;

                $upgrades_insert = ORM::for_table($config['db']['pre'] . 'upgrades')->create();
                $upgrades_insert->sub_id = $subcription_id;
                $upgrades_insert->user_id = $user_id;
                $upgrades_insert->upgrade_lasttime = $now;
                $upgrades_insert->upgrade_expires = $expires;
                $upgrades_insert->unique_id = $unique_subscription_id;
                $upgrades_insert->stripe_customer_id = $subscription_stripe_customer_id;
                $upgrades_insert->stripe_subscription_id = $subscription_stripe_subscription_id;
                $upgrades_insert->billing_day = $subscription_billing_day;
                $upgrades_insert->length = $subscription_length;
                $upgrades_insert->interval = $subscription_interval;
                $upgrades_insert->trial_days = $subscription_trial_days;
                $upgrades_insert->status = $subscription_status;
                $upgrades_insert->date_trial_ends = $subscription_date_trial_ends;
                $upgrades_insert->save();

                $person = ORM::for_table($config['db']['pre'] . 'user')->find_one($user_id);
                $person->group_id = $sub_group_id;
                $person->save();
            }

            //Update Amount in balance table
            $balance = ORM::for_table($config['db']['pre'] . 'balance')->find_one(1);
            $current_amount = $balance['current_balance'];
            $total_earning = $balance['total_earning'];

            $updated_amount = ($sub_amount + $current_amount);
            $total_earning = ($sub_amount + $total_earning);

            $balance->current_balance = $updated_amount;
            $balance->total_earning = $total_earning;
            $balance->save();

            $trans_insert = ORM::for_table($config['db']['pre'] . 'transaction')->create();
            $trans_insert->product_name = $title;
            $trans_insert->product_id = $subcription_id;
            $trans_insert->seller_id = $user_id;
            $trans_insert->status = 'success';
            $trans_insert->amount = $amount;
            $trans_insert->transaction_gatway = $folder;
            $trans_insert->transaction_ip = $_SERVER['REMOTE_ADDR'];
            $trans_insert->transaction_time = $now;
            $trans_insert->transaction_description = $trans_desc;
            $trans_insert->transaction_method = 'Subscription';
            $trans_insert->save();

            $results['status'] = "success";
            send_json($results);
            die();
        } else {
            $results['status'] = "error";
            send_json($results);
            die();
        }
    } else {
        $item_pro_id = $_REQUEST['product_id'];
        $item_featured = ($_REQUEST['featured'] == "1") ? "1" : "0";
        $item_urgent =  ($_REQUEST['urgent'] == "1") ? "1" : "0";
        $item_highlight = ($_REQUEST['highlight'] == "1") ? "1" : "0";

        $num_rows = ORM::for_table($config['db']['pre'] . 'product')
            ->where(array(
                'id' => $item_pro_id,
                'user_id' => $user_id
            ))
            ->count();
        if ($num_rows == 1)
            $valid_author = true;
        else
            $valid_author = false;

        if ($valid_author) {

            $user_info = ORM::for_table($config['db']['pre'] . 'user')
                ->select('group_id')
                ->find_one($user_id);

            $group_id = isset($user_info['group_id']) ? $user_info['group_id'] : 0;

            $group_info = get_usergroup_settings($group_id);
            $featured_duration = $group_info['featured_duration'];
            $urgent_duration = $group_info['urgent_duration'];
            $highlight_duration = $group_info['highlight_duration'];
            if ($item_featured == '1') {
                $f_duration_timestamp = $featured_duration * 86400;
                $featured_exp_date = (time() + $f_duration_timestamp);
                $featured_insert = ORM::for_table($config['db']['pre'] . 'product')->find_one($item_pro_id);
                $featured_insert->featured = '1';
                $featured_insert->featured_exp_date = $featured_exp_date;
                $featured_insert->save();
            }
            if ($item_urgent == '1') {
                $u_duration_timestamp = $urgent_duration * 86400;
                $urgent_exp_date = (time() + $u_duration_timestamp);
                $urgent_insert = ORM::for_table($config['db']['pre'] . 'product')->find_one($item_pro_id);
                $urgent_insert->urgent = '1';
                $urgent_insert->urgent_exp_date = $urgent_exp_date;
                $urgent_insert->save();
            }
            if ($item_highlight == '1') {
                $h_duration_timestamp = $highlight_duration * 86400;
                $highlight_exp_date = (time() + $h_duration_timestamp);
                $highlight_insert = ORM::for_table($config['db']['pre'] . 'product')->find_one($item_pro_id);
                $highlight_insert->highlight = '1';
                $highlight_insert->highlight_exp_date = $highlight_exp_date;
                $highlight_insert->save();
            }

            $num_rows2 = ORM::for_table($config['db']['pre'] . 'product_resubmit')
                ->where(array(
                    'product_id' => $item_pro_id,
                    'user_id' => $user_id
                ))
                ->count();
            if ($num_rows2 == 1)
                $valid_resubmission = false;
            else
                $valid_resubmission = true;

            if ($valid_resubmission) {
                if ($item_featured == '1') {
                    $f_duration_timestamp = $featured_duration * 86400;
                    $featured_exp_date = (time() + $f_duration_timestamp);
                    $query = "UPDATE " . $config['db']['pre'] . "product_resubmit set featured = '1',featured_exp_date='$featured_exp_date' where product_id='" . $item_pro_id . "' LIMIT 1";
                    $pdo->query($query);
                }
                if ($item_urgent == '1') {
                    $u_duration_timestamp = $urgent_duration * 86400;
                    $urgent_exp_date = (time() + $u_duration_timestamp);
                    $query = "UPDATE " . $config['db']['pre'] . "product_resubmit set urgent = '1',urgent_exp_date='$urgent_exp_date' where product_id='" . $item_pro_id . "' LIMIT 1";
                    $pdo->query($query);
                }
                if ($item_highlight == '1') {
                    $h_duration_timestamp = $highlight_duration * 86400;
                    $highlight_exp_date = (time() + $h_duration_timestamp);
                    $query = "UPDATE " . $config['db']['pre'] . "product_resubmit set highlight = '1',highlight_exp_date='$highlight_exp_date' where product_id='" . $item_pro_id . "' LIMIT 1";
                    $pdo->query($query);
                }
            }

            //Update Amount in balance table
            $balance = ORM::for_table($config['db']['pre'] . 'balance')->find_one(1);
            $current_amount = $balance['current_balance'];
            $total_earning = $balance['total_earning'];

            $updated_amount = ($amount + $current_amount);
            $total_earning = ($amount + $total_earning);
            $balance->current_balance = $updated_amount;
            $balance->total_earning = $total_earning;
            $balance->save();

            $trans_insert = ORM::for_table($config['db']['pre'] . 'transaction')->create();
            $trans_insert->product_name = $title;
            $trans_insert->product_id = $item_pro_id;
            $trans_insert->seller_id = $user_id;
            $trans_insert->status = 'success';
            $trans_insert->amount = $amount;
            $trans_insert->featured = $item_featured;
            $trans_insert->urgent = $item_urgent;
            $trans_insert->highlight = $item_highlight;
            $trans_insert->transaction_gatway = $folder;
            $trans_insert->transaction_ip = $_SERVER['REMOTE_ADDR'];
            $trans_insert->transaction_time = $now;
            $trans_insert->transaction_description = $trans_desc;
            $trans_insert->transaction_method = 'Premium Ad';
            $trans_insert->save();

            $results['status'] = "success";
            send_json($results);
            die();
        } else {
            $results['status'] = "error";
            send_json($results);
            die();
        }
    }
}
/*
Get User Membership with user_id
action = get_userMembership_by_id
1. user_id

Messages
1. Success : success
2. Error : User Id does not exist
*/

function get_userMembership_by_id()
{
    global $config, $lang, $results;
    $user_id = $_REQUEST['user_id'];

    $num_rows = ORM::for_table($config['db']['pre'] . 'user')
        ->where('id', $user_id)
        ->count();

    if ($num_rows >= 1) {

        $info = ORM::for_table($config['db']['pre'] . 'upgrades')
            ->where('user_id', $user_id)
            ->find_one();

        $sub_info = ORM::for_table($config['db']['pre'] . 'subscriptions')
            ->where('sub_id', $info['sub_id'])
            ->find_one();

        $upgrade_id = $info['upgrade_id'];
        $upgrades_status = $info['status'];
        $upgrades_title = $sub_info['sub_title'];
        $upgrades_cost = $sub_info['sub_amount'];
        $pay_mode = $sub_info['pay_mode'];

        if ($sub_info['sub_term'] == 'DAILY') {
            $upgrades_term = $lang['DAILY'];
        } elseif ($sub_info['sub_term'] == 'WEEKLY') {
            $upgrades_term = $lang['WEEKLY'];
        } elseif ($sub_info['sub_term'] == 'MONTHLY') {
            $upgrades_term = $lang['MONTHLY'];
        } elseif ($sub_info['sub_term'] == 'YEARLY') {
            $upgrades_term = $lang['YEARLY'];
        }

        $upgrades_start_date = date("d-m-Y", $info['upgrade_lasttime']);
        $upgrades_expiry_date = date("d-m-Y", $info['upgrade_expires']);

        $results['status'] = "success";
        $results['message'] = $lang['SUCCESS'];
        $results['package_id'] = $info['upgrade_id'];
        $results['status'] = $info['status'];
        $results['plan_title'] = $sub_info['sub_title'];
        $results['amount'] = $sub_info['sub_amount'];
        $results['pay_mode'] = $sub_info['pay_mode'];
        $results['image_url'] = $sub_info['sub_image'];
        $results['plan_term'] = $upgrades_term;
        $results['start_date'] = $upgrades_start_date;
        $results['expiry_date'] = $upgrades_expiry_date;
    } else {
        $results['status'] = "success";
        $results['message'] = $lang['USERNOTFOUND'];
    }
    send_json($results);
    die();
}

function get_membership_plan()
{
    global $config, $lang, $link;

    $membership_plans = array();
    $rows = ORM::for_table($config['db']['pre'] . 'subscriptions')
        ->where('active', '1')
        ->find_many();

    foreach ($rows as $info) {
        $plans['Selected'] = 0;
        $plans['id'] = $info['sub_id'];
        $plans['title'] = $info['sub_title'];
        $plans['recommended'] = $info['recommended'];
        $plans['cost'] = $info['sub_amount'];
        $plans['pay_mode'] = $info['pay_mode'];
        $plans['image'] = $info['sub_image'];

        if ($info['sub_term'] == 'DAILY') {
            $plans['term'] = $lang['DAILY'];
        } elseif ($info['sub_term'] == 'WEEKLY') {
            $plans['term'] = $lang['WEEKLY'];
        } elseif ($info['sub_term'] == 'MONTHLY') {
            $plans['term'] = $lang['MONTHLY'];
        } elseif ($info['sub_term'] == 'YEARLY') {
            $plans['term'] = $lang['YEARLY'];
        }
        $info2 = ORM::for_table($config['db']['pre'] . 'usergroups')
            ->where('group_id', $info['group_id'])
            ->find_one();

        $plans['limit'] = ($info2['ad_limit'] == "999") ? "Unlimited" : $info2['ad_limit'];
        $plans['duration'] = $info2['ad_duration'];
        $plans['featured_fee'] = $info2['featured_project_fee'];
        $plans['urgent_fee'] = $info2['urgent_project_fee'];
        $plans['highlight_fee'] = $info2['highlight_project_fee'];
        $plans['featured_duration'] = $info2['featured_duration'];
        $plans['urgent_duration'] = $info2['urgent_duration'];
        $plans['highlight_duration'] = $info2['highlight_duration'];
        $plans['top_search_result'] = $info2['top_search_result'];
        $plans['show_on_home'] = $info2['show_on_home'];
        $plans['show_in_home_search'] = $info2['show_in_home_search'];

        $membership_plans[] = $plans;
    }

    $results['plans'] = $membership_plans;

    send_json($results);
    die();
}
/*
User Login Api
action = login
1. username or email
2. password

Messages
1. Success : Logged in success
2. Error : Username or Password not found
3. Error : This account has been banned
*/

function get_category_translation_api($cattype, $catid, $lang_code)
{
    global $config;
    $info = ORM::for_table($config['db']['pre'] . 'category_translation')
        ->select_many('title', 'slug')
        ->where(array(
            'translation_id' => $catid,
            'lang_code' => $lang_code,
            'category_type' => $cattype,
        ))
        ->find_one();
    return $info;
}

function app_config()
{
    global $config, $lang, $results;
    $results['status_code'] = HTTP_OK;
    $results['status'] = $lang['SUCCESS'];
    $results['message'] = $lang['SUCCESS'];

    $results['site_url'] = $config['site_url'] ?? "";
    $results['app_name'] = $config['app_name'] ?? "";
    $results['app_version'] = $config['version'] ?? "";
    $results['site_logo'] = $config['site_logo'] ?? "";
    $results['site_title'] = $config['site_logo'] ?? "";
    $results['timezone'] = $config['timezone'] ?? "";
    $results['default_country'] = $config['specific_country'] ?? "";
    $results['default_lang_code'] = $config['lang_code'] ?? "";
    $results['default_lang'] = ucfirst($config['default_lang']) ?? "";
    $results['currency_sign'] = $config['currency_sign'] ?? "";
    $results['currency_code'] = $config['currency_code'] ?? "";
    $results['currency_pos'] = $config['currency_pos'] ?? "";
    $results['featured_fee'] = $config['featured_fee'] ?? "";
    $results['urgent_fee'] = $config['urgent_fee'] ?? "";
    $results['highlight_fee'] = $config['highlight_fee'] ?? "";
    $results['terms_page_link'] = $config['termcondition_link'] ?? "";
    $results['policy_page_link'] = $config['privacy_link'] ?? "";
    $results['featured_fee'] = $config['featured_fee'] ?? "";
    $results['urgent_fee'] = $config['urgent_fee'] ?? "";
    $results['highlight_fee'] = $config['highlight_fee'] ?? "";
    $results['currency_code'] = $config['currency_code'] ?? "";
    $results['currency_sign'] = $config['currency_sign'] ?? "";
    $results['detect_live_location'] = isset($config['detect_live_location']) && ($config['detect_live_location'] == 1) ? "yes" : "no";
    $results['facebook_interstitial'] = isset($config['facebook_interstitial']) && ($config['facebook_interstitial'] == 1) ? true : false;
    $results['google_banner'] = isset($config['google_banner']) && ($config['google_banner'] == 1) ? true : false;
    $results['google_interstitial'] = isset($config['google_interstitial']) && ($config['google_interstitial'] == 1) ? true : false;
    $results['premium_app'] = isset($config['google_interstitial']) && ($config['premium_app'] == 1) ? true : false;
    $results['user_custom_fields_enable'] =  ($config['user_custom_fields_enable'] == 1) ? true : false;
    $results['custom_field_enable'] =  ($config['custom_field_enable'] == 1) ? true : false;
    $results['worker_commission'] =  $config['worker_commission'] ?? 10;
    $results['client_commission'] = $config['client_commission'] ?? 5;
    $results['resume_enable'] = ($config['resume_enable'] == 1) ? true : false;
    $results['resume_files'] =  $config['resume_files'] ?? 'pdf';
    $results['company_enable'] =  ($config['company_enable'] == 1) ? true : false;
    $results['non_active_allow'] =  ($config['non_active_allow'] == 1) ? true : false;
    $results['non_active_msg'] = ($config['non_active_msg'] == 1) ? true : false;

    //ad (Job) post settings 
    $results['post_without_login'] = ($config['post_without_login'] == 1) ? true : false;
    $results['post_premium_listing'] = ($config['post_premium_listing'] == 1) ? true : false;
    $results['post_desc_editor'] =  ($config['post_desc_editor'] == 1) ? true : false;
    $results['job_image_field'] =  ($config['job_image_field'] == 1) ? true : false;
    $results['post_address_mode'] = ($config['post_address_mode'] == 1) ? true : false;
    $results['post_tags_mode'] = ($config['post_tags_mode'] == 1) ? true : false;
    $results['theme_color'] = $config['theme_color'];

    /*********************Category / Sub Category****************************************/

    $lang_code = isset($_REQUEST['lang_code']) ? $_REQUEST['lang_code'] : null;

    if ($lang_code == 'en') {
        $lang_code = null;
    }

    $category = array();
    $sub_category = array();

    $result1 = ORM::for_table($config['db']['pre'] . 'catagory_main')
        ->order_by_asc('cat_order')
        ->find_many();

    foreach ($result1 as $info1) {
        $cat['id'] = $info1['cat_id'];
        $cat['icon'] = $info1['icon'];
        $cat['name'] = $info1['cat_name'];
        $cat['picture'] = $info1['picture'];
        if ($lang_code != null && $config['userlangsel'] == '1') {
            $maincat = get_category_translation_api("main", $info1['cat_id'], $lang_code);
            $cat['name'] = $maincat['title'];
        }

        $cat['sub_category'] = array();

        $result = ORM::for_table($config['db']['pre'] . 'catagory_sub')
            ->where('main_cat_id', $info1['cat_id'])
            ->find_many();
        foreach ($result as $info) {
            $subcat['id'] = $info['sub_cat_id'];
            $subcat['picture'] = $info['picture'];
            if ($lang_code != null && $config['userlangsel'] == '1') {
                $scat = get_category_translation_api("sub", $info['sub_cat_id'], $lang_code);
                $subcat['name'] = $scat['title'];
            } else {
                $subcat['name'] = $info['sub_cat_name'];
            }

            $cat['sub_category'][] = $subcat;
        }

        $category[] = $cat;
    }

    $results['categories'] = $category;

    /******************************Installed Languages************************************/

    $language_array = array();

    $result = ORM::for_table($config['db']['pre'] . 'languages')
        ->where('active', '1')
        ->order_by_asc('name')
        ->find_many();
    foreach ($result as $info) {
        $language['id'] = $info['id'];
        $language['code'] = $info['code'];
        $language['direction'] = $info['direction'];
        $language['name'] = $info['name'];
        $language['file_name'] = $info['file_name'];
        $language['active'] = $info['active'];
        $language['default'] = $info['default'];

        $language_array[] = $language;
    }

    $results['languages'] = $language_array;

    /***************************Payment Methods****************************/

    $payment_types = array();

    $rows = ORM::for_table($config['db']['pre'] . 'payments')->find_many();
    foreach ($rows as $info) {
        $payment_types[$info['payment_folder']] = $info['payment_install'];
    }

    $group_get_info = get_usergroup_settings(1);

    $premium_job = [
        'featured_fee'  => get_option('featured_fee'),
        'urgent_fee'    => get_option('urgent_fee'),
        'highlight_fee' => get_option('highlight_fee'),
        'featured_days'  => $group_get_info['featured_duration'],
        'urgent_days'    => $group_get_info['urgent_duration'],
        'highlight_days' => $group_get_info['highlight_duration']
    ];

    $results['payment_method'] = $payment_types;
    $results['premium_job'] = $premium_job;
    send_json($results);
    die();
}

function payment_api_detail_config()
{
    global $config, $lang, $results;

    /******************PAYPAL*******************/
    $results['paypal_sandbox_mode'] = $config['paypal_sandbox_mode'];
    //$results['paypal_api_username'] = $config['paypal_api_username'];
    //$results['paypal_api_password'] = $config['paypal_api_password'];
    //$results['paypal_api_signature'] = $config['paypal_api_signature'];
    $results['paypal_client_id'] = $config['paypal_client_id'];

    /******************STRIPE*******************/
    $results['stripe_publishable_key'] = $config['stripe_publishable_key'];
    $results['stripe_secret_key'] = $config['stripe_secret_key'];

    /******************PAYSTACK*******************/
    $results['paystack_public_key'] = $config['paystack_public_key'];
    $results['paystack_secret_key'] = $config['paystack_secret_key'];

    /******************PAYUMONEY*******************/
    $results['payumoney_sandbox_mode'] = $config['payumoney_sandbox_mode'];
    $results['payumoney_merchant_key'] = $config['payumoney_merchant_key'];
    $results['payumoney_merchant_id'] = $config['payumoney_merchant_id'];

    /******************2CHECKOUT*******************/
    $results['checkout_account_number'] = $config['checkout_account_number'];
    $results['checkout_public_key'] = $config['checkout_public_key'];
    $results['checkout_private_key'] = $config['checkout_private_key'];

    /******************PAYTM*******************/
    /*$results['PAYTM_ENVIRONMENT'] = $config['PAYTM_ENVIRONMENT'];
    $results['PAYTM_MERCHANT_KEY'] = $config['PAYTM_MERCHANT_KEY'];
    $results['PAYTM_MERCHANT_MID'] = $config['PAYTM_MERCHANT_MID'];
    $results['PAYTM_MERCHANT_WEBSITE'] = $config['PAYTM_MERCHANT_WEBSITE'];*/

    /******************OFFLINE PAYMENT INFO*******************/
    /*$results['company_bank_info'] = $config['company_bank_info'];
    $results['company_cheque_info'] = $config['company_cheque_info'];
    $results['cheque_payable_to'] = $config['cheque_payable_to'];*/

    /******************SKRILL*******************/
    //$results['skrill_merchant_id'] = $config['skrill_merchant_id'];

    /******************NOCHEX*******************/
    //$results['nochex_merchant_id'] = $config['nochex_merchant_id'];

    send_json($results);
    die();
}

/*
Get unread count for notification and chat conversation
action = unread_note_chat_count

1. user_id

Messages
1. unread_notification
2. unread_chat
*/

function unread_note_chat_count()
{
    global $config, $lang, $results;
    //$user_id = $_REQUEST["user_id"];

    // $notification_count = ORM::for_table($config['db']['pre'] . 'push_notification')
    //     ->where(array(
    //         'owner_id' => $user_id,
    //         'recd' => '0',
    //     ))
    //     ->count();
    $loggedin = checkIsloggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];

    $notification_count = ORM::for_table($config['db']['pre'] . 'user_notifications')
        ->where(['recepient_id' => $user_id, 'read' => '0', 'trash' => '0'])
        ->count();
    $chat_count = ORM::for_table($config['db']['pre'] . 'messages')
        ->where(array(
            'to_id' => $user_id,
            'seen' => '0',
        ))
        ->count();
    $results['status_code'] = HTTP_OK;
    $results['status'] = $lang['SUCCESS'];
    $results['message'] = $lang['SUCCESS'];
    $results['unread_notification'] = $notification_count;
    $results['unread_chat'] = $chat_count;
    $results['auth_token'] =   $loggedin['auth_token'];

    send_json($results);
    die();
}
function make_offer()
{
    global $config, $lang, $results;
    $SenderName = $_REQUEST['SenderName'];
    $SenderId = $_REQUEST['SenderId'];
    $OwnerName = $_REQUEST['OwnerName'];
    $OwnerId = $_REQUEST['OwnerId'];
    $productId = $_REQUEST['productId'];
    $productTitle = $_REQUEST['productTitle'];
    $type = $_REQUEST['type'];
    $message = $_REQUEST['message'];

    $email = $_REQUEST['email'];
    $subject = $_REQUEST['subject'];

    email($email, $SenderName, $subject, $message);
    $noteMsg = "New offer for " . $productTitle;
    // if ($note_id = add_firebase_notification($SenderName, $SenderId, $OwnerName, $OwnerId, $productId, $productTitle, $type, $message)) {
    //     sendFCM($noteMsg, $OwnerId, "Offer Received");
    // }

    $results['status'] = "success";
    send_json($results);
    die();
}

/*
Get Notification
action = get_notification

1. user_id

Messages
1. Success : array
2. Error : not found
*/

function get_notification()
{
    global $config, $lang, $results;

    $user_id = $_REQUEST["user_id"];

    $notification = array();

    $rows = ORM::for_table($config['db']['pre'] . 'push_notification')
        ->where('owner_id', $user_id)
        ->find_many();

    foreach ($rows as $info) {
        $note['sender_id'] = $info['sender_id'];
        $note['sender_name'] = $info['sender_name'];
        $note['owner_id'] = $info['owner_id'];
        $note['owner_name'] = $info['owner_name'];
        $note['product_id'] = $info['product_id'];
        $note['product_title'] = $info['product_title'];
        $note['type'] = $info['type'];
        $note['message'] = $info['message'];
        $notification[] = $note;
    }

    $pdo = ORM::get_db();
    $query = "UPDATE `" . $config['db']['pre'] . "push_notification` SET `recd` = '1' WHERE `owner_id` = '" . $user_id . "' ";
    $pdo->query($query);

    $results = $notification;
    send_json($results);
    die();
}

/*
Add firebase device token
action = add_firebase_device_token

1. user_id
2. device_id
3. name
4. token

Messages
1. Success
*/

function add_firebase_device_token($user_id = null)
{

    global $config, $lang, $results;
    $user_auth_token = '';
    $issued_at = time();
    $auth_token_expiration = $issued_at + (60 * 60 * 2); //2 hours
    $refresh_token_expiration = $issued_at + (60 * 60 * 24 * 30);  //30 Days
    $issuer = ROOTPATH;
    if ($user_id == null) {
        $user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : null;
    }
    $device_id = isset($_REQUEST['device_id']) ? $_REQUEST['device_id'] : null;
    $device_type  = isset($_REQUEST['device_type']) ? $_REQUEST['device_type'] : null;
    $ip_address  = isset($_REQUEST['ip_address']) ? $_REQUEST['ip_address'] : null;
    $device_name = isset($_REQUEST['device_name']) ? $_REQUEST['device_name'] : null;
    $token = isset($_REQUEST['token']) ? $_REQUEST['token'] : null;

    if ($user_id != null) {
        $user_data = get_user_data(null, $user_id);
        $payload = array(
            "iat" => $issued_at,
            "exp" => $auth_token_expiration,
            "iss" => $issuer,
            "data" => array(
                "id" => $user_id,
                "username" => $user_data['username'],
                "email" =>  $user_data['email'],
                "device_id" =>  $device_id
            )
        );
        $auth_token = generateToken($payload);
        $refresh_token_payload =  array(
            "iat" => $issued_at,
            "exp" => $refresh_token_expiration,
            "iss" => $issuer,
            "data" => array(
                "id" => $user_id,
                "name" => !empty($user_data['name']) ? $user_data['name'] : $user_data['username'],
                "email" =>  $user_data['email'],
                "user_type" =>  $user_data['user_type'],
                "device_id" =>  $device_id
            )
        );
        $refresh_token = generateToken($refresh_token_payload);
        if ($token != null) {
            $num_count = ORM::for_table($config['db']['pre'] . 'firebase_device_token')
                ->where(['device_id' => $device_id])
                ->count();
            if ($num_count == 1) {
                $firebase_device_token = ORM::for_table($config['db']['pre'] . 'firebase_device_token')->where(['device_id' => $device_id])->find_one();

                $firebase_device_token->set([
                    'user_id' => $user_id,
                    'device_type' => $device_type,
                    'ip_address' => $ip_address,
                    'name' => $device_name,
                    'token' => $token,
                    'auth_token' => $auth_token,
                    'auth_token_expiration' => $auth_token_expiration,
                    // 'refresh_token'=>$refresh_token,
                    'last_login' => date('Y-m-d H:i:s'),
                ]);
                $firebase_device_token->save();
                $user_auth_token = $auth_token;
                $status = true;
            } else {
                $insert_token = ORM::for_table($config['db']['pre'] . 'firebase_device_token')->create();
                $insert_token->user_id = $user_id;
                $insert_token->device_id = $device_id;
                $insert_token->device_type = $device_type;
                $insert_token->ip_address = $ip_address;
                $insert_token->name = $device_name;
                $insert_token->token = $token;
                $insert_token->auth_token = $auth_token;
                $insert_token->auth_token_expiration = $auth_token_expiration;
                $insert_token->refresh_token = $refresh_token;
                $insert_token->refresh_token_expiration = $refresh_token_expiration;
                $insert_token->last_login = date('Y-m-d H:i:s');
                $insert_token->save();
                $note_id = $insert_token->id();
                $user_auth_token = $auth_token;
                $status = true;
            }
        } else {
            $status = false;
        }
    }
    return  $user_auth_token;
}

/*
User Login Api
action = login
1. username or email
2. password

Messages
1. Success : Logged in success
2. Error : Username or Password not found
3. Error : This account has been banned
*/

function login()
{
    global $config, $lang, $status, $message, $results;
    $auth_token = '';
    $loggedin = userlogin($_REQUEST['username'], $_REQUEST['password']);

    if (!is_array($loggedin)) {
        $status = "error";
        $message = $lang['USERNOTFOUND'];
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
    } elseif ($loggedin['status'] == 2) {
        $status = "error";
        $message = $lang['ACCOUNTBAN'];
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
    } else {
        $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
        $user_id = preg_replace("/[^0-9]+/", "", $loggedin['id']); // XSS protection as we might print this value
        $_SESSION['user']['id']  = $user_id;
        $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $loggedin['username']); // XSS protection as we might print this value
        $_SESSION['user']['username'] = $username;
        $_SESSION['user']['login_string'] = hash('sha512', $loggedin['password'] . $user_browser);

        update_lastactive();
        $auth_token = add_firebase_device_token($user_id);
        $status = "success";
        $message = $lang['LOGGEDIN_SUCCESS'];
        $userdata = get_user_data($username);
        $status_code = HTTP_OK;
    }

    // $results['status'] = $status;
    // $results['message'] = $message;

    // $results['user_id'] = $user_id;
    // $results['username'] = $username;

    // $userdata = get_user_data($username);
    // $results['email'] = $userdata['email'];
    // $results['name'] = $userdata['name'];
    // $results['picture'] = $config['site_url']."storage/profile/small_".$userdata['image'];

    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $auth_token, 'user_data' => ($userdata ?? [])];
    send_json($results);
}

/*
User Forgot Password Api
action = forgot_password
1. email

Messages
1. Success : Please check your email account for the forgot password details
2. Error : Email address does not exist
*/

function forgot_password()
{
    global $config, $lang, $status, $message, $results;

    // Lookup the email address
    $email_info1 = check_account_exists($_REQUEST['email']);

    // Check if the email address exists
    if ($email_info1 != 0) {
        $email_userid = get_user_id_by_email($_REQUEST['email']);
        // Send the email
        send_forgot_email($_REQUEST['email'], $email_userid);

        $status = "success";
        $message = $lang['CHECKEMAILFORGOT'];
    } else {
        $status = "error";
        $message = $lang['EMAILNOTEXIST'];
    }

    $results['status'] = $status;
    $results['message'] = $message;

    send_json($results);
}

/*
User Register Api field name
action = register
1. name
2. username
3. email
4. password

Error Messages
1. Enter your full name.
2. Name must be between 4 and 20 characters long.
3. Please enter an username
4. Username may only contain alphanumeric characters
5. Username must be between 4 and 15 characters long
6. Username not available
7. Please enter an email address
8. This is not a valid email address
9. An account already exists with that e-mail address
10. Please enter password
11. Password must be between 4 and 20 characters long
*/

function register_account()
{
    global $config, $con, $lang, $results;
    $error = 0;
    $errors = 0;
    $dob = '';
    $firstname_length = strlen(utf8_decode($_REQUEST['firstname']));
    $lastname_length = strlen(utf8_decode($_REQUEST['lastname']));
    $status = "";
    $message = "";
    $user_type = 'user';
    if (empty($_REQUEST["firstname"])) {
        $error++;
        $errors['firstname'] = $lang['ENTERFIRSTNAME'];
    } elseif (($firstname_length < 4) or ($firstname_length > 21)) {
        $status = "error";
        $errors['firstname'] = $lang['NAMELEN'];
    }
    if (empty($_REQUEST["lastname"])) {
        $error++;
        $errors['lastname'] = $lang['ENTERLASTNAME'];
    } elseif (($lastname_length < 4) or ($lastname_length > 21)) {
        $error++;
        $errors['lastname'] = $lang['NAMELEN'];
    }
    if (empty($_POST['dob'])) {
        $errors++;
        $dob_error = 'Enter Dob of Worker.';
        $dob_error = "<span class='status-not-available'> " . $dob_error . ".</span>";
    } else {
        $from = new DateTime($_POST["dob"]);
        $to   = new DateTime('today');
        $dob_check = $from->diff($to)->y;
        if ($dob_check >= 18) {
            $dob = date("Y-m-d", strtotime($_POST['dob']));
        } else {
            $errors++;
            $dob_error = 'Enter Age At least 18 Years.';
            $dob_error = "<span class='status-not-available'> " . $dob_error . ".</span>";
        }

        $dob = date("Y-m-d", strtotime($_POST['dob']));
    }

    if (empty($_REQUEST["phone"])) {
        $error++;
        $errors['phone'] =  $lang['ENTERPHONE'];
    } elseif (preg_match('/^[0-9][9]*$/', $_REQUEST['phone'])) {
        $error++;
        $errors['phone'] =  $lang['PHONENUMERIC'];
    } elseif ((strlen($_REQUEST['phone']) < 10) or (strlen($_REQUEST['phone']) > 10)) {
        $error++;
        $errors['phone'] =  $lang['PHONELEN'];
    } else {
        if (isset($_REQUEST['fb_login']) && $_REQUEST['fb_login'] == 1) {
        } else {
            $user_count = check_phonenumber_exists($_REQUEST["phone"]);
            if ($user_count > 0) {
                $error++;
                $errors['phone'] = $lang['PHONENOUNAV'];
            }
        }
    }

    if ($_REQUEST["user_type"] == 1) {
        $user_type = 'user';
    } else {
        $user_type = 'employer';
    }

    // Check if this is an Email availability check from signup page using ajax
    $_REQUEST["email"] = strtolower($_REQUEST["email"]);
    $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

    if (empty($_REQUEST["email"])) {
        $error++;
        $errors['email'] = $lang['ENTEREMAIL'];
    } elseif (!preg_match($regex, $_REQUEST['email'])) {
        $error++;
        $errors['email'] = $lang['EMAILINV'];
    } else {
        if (!isset($_REQUEST['fb_login'])) {
            $user_count = check_account_exists($_REQUEST["email"]);
            if ($user_count > 0) {
                $error++;
                $errors['email'] = $lang['ACCAEXIST'];
            }
        }
    }

    // Check if this is an Password availability check from signup page using ajax
    if (!isset($_REQUEST['fb_login'])) {
        if (empty($_REQUEST["password"])) {
            $error++;
            $errors['password'] = $lang['ENTERPASS'];
        } elseif ((strlen($_REQUEST['password']) < 4) or (strlen($_REQUEST['password']) > 21)) {
            $error++;
            $errors['password'] = $lang['PASSLENG'];
        }
    }

    if ($error == 0) {

        $firstname =  $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $username = generate_username($_POST["firstname"], $_POST["lastname"], 100);
        $fullname =  ucfirst($firstname) . ' ' . ucfirst($lastname);

        $refrelcode = generateRandomRefrel();

        if (isset($_REQUEST['referral']) && $_REQUEST['referral'] != "") {
            $code = explode(',', base64_decode($_REQUEST['referral']));
            $referaluse = $code[1];
        } else {
            $referaluse = "";
        }

        if (isset($_REQUEST['fb_login']) && $_REQUEST['fb_login'] == '1') {
            $email = $_REQUEST['email'];

            $num_rows = ORM::for_table($config['db']['pre'] . 'user')
                ->select_many('id', 'email', 'username', 'name')
                ->where('email', $email)
                ->count();

            if ($num_rows >= 1) {

                $info = ORM::for_table($config['db']['pre'] . 'user')
                    ->select_many('id', 'email', 'username', 'name')
                    ->where('email', $email)
                    ->find_one();

                $results['status'] = "success";
                $results['message'] = $lang['SUCCESS'];

                $results['user_id'] = $info['id'];
                $results['username'] = $info['username'];
                $results['email'] = $info['email'];
                $results['name'] = $info['name'];
            } else {
                $password = get_random_id();
                $pass_hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 13]);
                $confirm_id = get_random_id();
                $location = getLocationInfoByIp();
                $now = date("Y-m-d H:i:s");
                $insert_user = ORM::for_table($config['db']['pre'] . 'user')->create();
                $insert_user->status = 1;
                $insert_user->group_id = 4;
                $insert_user->firstname = $firstname;
                $insert_user->lastname =  $lastname;
                $insert_user->name =   $fullname;
                $insert_user->username = $username;
                $insert_user->phone = $_REQUEST['phone'];
                $insert_user->dob = $dob;
                $insert_user->user_type = $user_type;
                $insert_user->email = $_REQUEST['email'];
                $insert_user->password_hash = $pass_hash;
                $insert_user->confirm = $confirm_id;
                $insert_user->created_at = $now;
                $insert_user->updated_at = $now;
                $insert_user->country = $location['country'];
                $insert_user->country_code = $location['countryCode'];
                $insert_user->city = $location['city'];
                $insert_user->refrel_code = $refrelcode;
                $insert_user->referal_use = $referaluse;
                $insert_user->save();

                $user_id = $insert_user->id();

                /*SEND CONFIRMATION EMAIL*/
                email_template("signup_confirm", $user_id);

                /*SEND ACCOUNT DETAILS EMAIL*/
                email_template("signup_details", $user_id, $password);

                $results['status_code'] = HTTP_OK;
                $results['status'] = "success";
                $results['message'] = $lang['SUCCESS'];
                $userdata = get_user_data(null, $user_id);
                $results['user_id'] = $userdata['id'];;
                $results['username'] = $userdata['username'];;
                $results['email'] = $userdata['email'];
                $results['name'] = $userdata['name'];
            }
        } else {
            $confirm_id = get_random_id();
            $location = getLocationInfoByIp();
            $password = $_REQUEST["password"];
            $pass_hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 13]);
            $now = date("Y-m-d H:i:s");

            $insert_user = ORM::for_table($config['db']['pre'] . 'user')->create();
            $insert_user->status = 1;
            $insert_user->group_id = 4;
            $insert_user->firstname = $firstname;
            $insert_user->lastname =  $lastname;
            $insert_user->phone =  $_POST["phone"];
            $insert_user->name =   $fullname;
            $insert_user->dob = $dob;
            $insert_user->username = $username;
            $insert_user->user_type = $user_type;
            $insert_user->email = $_REQUEST['email'];
            $insert_user->password_hash = $pass_hash;
            $insert_user->confirm = $confirm_id;
            $insert_user->created_at = $now;
            $insert_user->updated_at = $now;
            $insert_user->country = $location['country'];
            $insert_user->country_code = $location['countryCode'];
            $insert_user->city = $location['city'];
            $insert_user->refrel_code = $refrelcode;
            $insert_user->referal_use = $referaluse;
            $insert_user->save();

            $user_id = $insert_user->id();

            /*SEND CONFIRMATION EMAIL*/
            email_template("signup_confirm", $user_id);

            /*SEND ACCOUNT DETAILS EMAIL*/
            email_template("signup_details", $user_id, $password);

            $results['status'] = "success";
            $results['status_code'] = HTTP_OK;
            $results['message'] = $lang['SUCCESS'];
            $userdata = get_user_data(null, $user_id);
            // $results['user_id'] = $userdata['id'];;
            // $results['username'] = $userdata['username'];;
            // $results['email'] = $userdata['email'];
            // $results['name'] = $userdata['name'];
            $user_data = ['user_id' => $userdata['id'], 'username' => $userdata['username'], 'email' => $userdata['email'], 'name' => $userdata['name']];
            $results['user_data'] = $user_data;
        }
        if (isset($_REQUEST['referral']) && $_REQUEST['referral'] != "") {
            $code = explode(',', base64_decode($_REQUEST['referral']));
            $profit = getShareProfit($user_id);
            $invite = ORM::for_table($config['db']['pre'] . 'invite')->create();
            $invite->userid = $code[0];
            $invite->referid = $user_id;
            $invite->user_profit = $profit['sender_profit'];
            $invite->refer_profit = $profit['reciver_profit'];
            $invite->status = "pending";
            $invite->created_at = $now;
            $invite->save();
        }
        $loggedin = userlogin($username, $_REQUEST['password']);

        if ($loggedin) {
            $auth_token = add_firebase_device_token($loggedin['id']);
            $results['auth_token'] =   $auth_token;
        }
        $results['status_code'] = HTTP_OK;
        $results['status'] = $lang['SUCCESS'];
        $results['message'] = $lang['SUCCESS'];
        $results['errors'] = $errors;
        send_json($results);
    } else {
        $results['status_code'] = HTTP_UNPROCESSABLE_ENTITY;
        $results['status'] = $lang['ERROR'];
        $results['message'] = $lang['FAILED'];
        $results['errors'] = $errors;
        send_json($results);
    }
    // $results['status_code'] = HTTP_UNPROCESSABLE_ENTITY;
    // $results['status'] = "error";

    // $results['message'] = $lang['SOMETHING_WENT_WRONG'];
    // send_json($results);
}

/*
Get Userdata with email
action = get_userdata_by_email
1. email

Messages
1. Success : success
2. Error : Email address does not exist
*/

function get_userdata_by_email()
{
    global $config, $lang, $results;
    $email = $_REQUEST['email'];

    $num_rows = ORM::for_table($config['db']['pre'] . 'user')
        ->select_many('id', 'email', 'username', 'name')
        ->where('email', $email)
        ->count();

    if ($num_rows >= 1) {

        $info = ORM::for_table($config['db']['pre'] . 'user')
            ->select_many('id', 'email', 'username', 'name')
            ->where('email', $email)
            ->find_one();

        $results['status'] = "success";
        $results['message'] = $lang['SUCCESS'];

        $results['user_id'] = $info['id'];;
        $results['username'] = $info['username'];;
        $results['email'] = $info['email'];
        $results['name'] = $info['name'];
    } else {
        $results['status'] = "success";
        $results['message'] = $lang['EMAILNOTEXIST'];
    }
    send_json($results);
    die();
}

function get_products_data($userid = null, $cat_id = null, $subcat_id = null, $location = false, $country_code = null, $state_code = null, $city = null, $status = null, $premium = false, $page = null, $limit = null, $order = false, $sort = "id", $sort_order = "DESC")
{
    global $config, $con, $lang, $results;
    $where = '';
    if ($userid != null) {
        if ($where == '')
            $where .= "where p.user_id = '" . $userid . "'";
        else
            $where .= " AND p.user_id = '" . $userid . "'";
    }
    if ($status != null && $status != "hide") {
        if ($where == '')
            $where .= "where p.status = '" . $status . "'";
        else
            $where .= " AND p.status = '" . $status . "'";
    }

    if ($cat_id != null) {
        if ($where == '')
            $where .= "where p.category = '" . $cat_id . "'";
        else
            $where .= " AND p.category = '" . $cat_id . "'";
    }

    if ($subcat_id != null) {
        if ($where == '')
            $where .= "where p.sub_category = '" . $subcat_id . "'";
        else
            $where .= " AND p.sub_category = '" . $subcat_id . "'";
    }

    if ($status == "hide") {
        if ($where == '')
            $where .= "where p.hide = '1'";
        else
            $where .= " AND p.hide = '1'";
    }

    if ($status != null) {
        if ($where == '')
            $where .= "where p.hide = '0'";
        else
            $where .= " AND p.hide = '0'";
    }

    if ($premium) {
        if ($where == '')
            $where .= "where (g.show_on_home = 'yes')";
        else
            $where .= " AND (g.show_on_home = 'yes')";
    }

    if ($location) {
        if ($country_code == null) {
            $country_code = check_user_country();
        }

        if ($where == '')
            $where .= "where p.country = '" . $country_code . "'";
        else
            $where .= " AND p.country = '" . $country_code . "'";

        if ($state_code != null) {
            if ($where == '')
                $where .= "where p.state = '" . $state_code . "'";
            else
                $where .= " AND p.state = '" . $state_code . "'";
        }

        if ($city != null) {
            if ($where == '')
                $where .= "where p.city = '" . $city . "'";
            else
                $where .= " AND p.city = '" . $city . "'";
        }
    }

    if ($order) {
        $order_by = "
      (CASE
        WHEN g.show_on_home = 'yes' and p.featured = '1' and p.urgent = '1' and p.highlight = '1' THEN 1
        WHEN g.show_on_home = 'yes' and p.urgent = '1' and p.featured = '1' THEN 2
        WHEN g.show_on_home = 'yes' and p.urgent = '1' and p.highlight = '1' THEN 3
        WHEN g.show_on_home = 'yes' and p.featured = '1' and p.highlight = '1' THEN 4
        WHEN g.show_on_home = 'yes' and p.urgent = '1' THEN 5
        WHEN g.show_on_home = 'yes' and p.featured = '1' THEN 6
        WHEN g.show_on_home = 'yes' and p.highlight = '1' THEN 7
        WHEN g.show_on_home = 'yes' THEN 8
        ELSE 9
      END), " . $sort . " " . $sort_order;
        //$order_by = $sort." ".$sort_order;
    } else {
        $order_by = $sort . " " . $sort_order;
    }

    $pagelimit = "";
    if ($page != null && $limit != null) {
        $pagelimit = "LIMIT  " . ($page - 1) * $limit . "," . $limit;
    }

    $pdo = ORM::get_db();

    $query = "SELECT p.id,p.product_name,p.featured,p.urgent,p.highlight,p.salary_min,p.salary_max,p.category,p.sub_category,p.tag,p.screen_shot,p.user_id,p.city,p.country,p.status,p.hide,p.created_at,p.expire_date,
    u.group_id, g.show_on_home
    FROM `" . $config['db']['pre'] . "product` as p
    INNER JOIN `" . $config['db']['pre'] . "user` as u ON u.id = p.user_id
    INNER JOIN `" . $config['db']['pre'] . "usergroups` as g ON g.group_id = u.group_id
    $where ORDER BY $order_by $pagelimit";

    //echo "<pre>". $query."</pre>";

    $result = $pdo->query($query);
    $rows = $result->rowCount();
    $items = array();
    if ($rows > 0) {
        foreach ($result as $info) {
            $item['id'] = $info['id'];
            $item['product_name'] = $info['product_name'];
            $item['featured'] = $info['featured'];
            $item['urgent'] = $info['urgent'];
            $item['highlight'] = $info['highlight'];
            $item['highlight_bgClr'] = ($info['highlight'] == 1) ? "highlight-premium-ad" : "";

            $cityname = get_cityName_by_id($info['city']);
            $item['location'] = $cityname;
            $item['city'] = $cityname;
            $item['status'] = $info['status'];
            $item['hide'] = $info['hide'];

            $item['created_at'] = timeAgo($info['created_at']);
            $expire_date_timestamp = $info['expire_date'];
            $expire_date = date('d-M-y', $expire_date_timestamp);
            $item['expire_date'] = $expire_date;

            $item['cat_id'] = $info['category'];
            $item['sub_cat_id'] = $info['sub_category'];
            $get_main = get_maincat_by_id($info['category']);
            $get_sub = get_subcat_by_id($info['sub_category']);
            $item['category'] = $get_main['cat_name'];
            $item['sub_category'] = $get_sub['sub_cat_name'];

            $fav_num_rows = ORM::for_table($config['db']['pre'] . 'favads')
                ->where(array(
                    'product_id' => $info['id'],
                    'user_id' => $info['user_id']
                ))
                ->count();
            if ($fav_num_rows == 1)
                $product_favorite = true;
            else
                $product_favorite = false;

            $item['favorite'] = $product_favorite;

            if ($info['tag'] != '') {
                $item['showtag'] = "1";
                $item['tag'] = $info['tag'];
            } else {
                $item['tag'] = "";
                $item['showtag'] = "0";
            }

            $picture = explode(',', $info['screen_shot']);
            $item['pic_count'] = count($picture);

            if ($picture[0] != "") {
                $item['picture'] = $config['site_url'] . "storage/products/thumb/" . $picture[0];
            } else {
                $item['picture'] = $config['site_url'] . "storage/products/thumb/default.png";
            }

            $currency = set_user_currency($info['country']);
            $item['price'] = !empty($info['price']) ? $info['price'] : null;
            $item['currency'] = $currency['html_entity'];
            $item['currency_in_left'] = $currency['in_left'];


            $userinfo = get_user_data("", $info['user_id']);
            $item['username'] = $userinfo['username'];
            $item['user_id'] = $userinfo['id'];


            if (check_user_upgrades($info['user_id'])) {
                $sub_info = get_user_membership_detail($info['user_id']);
                $item['subcription_title'] = $sub_info['sub_title'];
                $item['subcription_image'] = $sub_info['sub_image'];
            } else {
                $item['subcription_title'] = '';
                $item['subcription_image'] = '';
            }

            $items[] = $item;
        }
    } else {
        //echo "0 results";
    }

    send_json($items);
    die();
}

function featured_urgent_ads()
{
    global $config, $lang, $results;

    $cat_id = isset($_REQUEST['category_id']) ? $_REQUEST['category_id'] : null;
    $subcat_id = isset($_REQUEST['subcategory_id']) ? $_REQUEST['subcategory_id'] : null;

    $user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : null;
    $location = isset($_REQUEST['location']) ? $_REQUEST['location'] : false;
    $country_code = isset($_REQUEST['country_code']) ? $_REQUEST['country_code'] : null;
    $state_code = isset($_REQUEST['state']) ? $_REQUEST['state'] : null;
    $city = isset($_REQUEST['city']) ? $_REQUEST['city'] : null;
    $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : null;
    $premium = isset($_REQUEST['premium']) ? $_REQUEST['premium'] : false;
    $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '1';
    $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : '10';
    $sorting = isset($_REQUEST['sorting']) ? $_REQUEST['sorting'] : false;
    $sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : "id";
    $sort_order = isset($_REQUEST['sort_order']) ? $_REQUEST['sort_order'] : "DESC";

    if (isset($_REQUEST['country_code'])) {
        $location = true;
    }


    $where = "where (p.featured = '1' OR p.urgent = '1') ";

    if ($status != null && $status != "hide") {
        $where .= " AND p.status = '" . $status . "'";
    }

    if ($cat_id != null) {
        $where .= " AND p.category = '" . $cat_id . "'";
    }

    if ($subcat_id != null) {
        $where .= " AND p.sub_category = '" . $subcat_id . "'";
    }

    if ($status == "hide") {
        $where .= " AND p.hide = '1'";
    } else {
        $where .= " AND p.hide = '0'";
    }

    if ($location) {
        if ($country_code == null) {
            $country_code = check_user_country();
        }

        $where .= " AND p.country = '" . $country_code . "'";

        if ($state_code != null) {
            $where .= " AND p.state = '" . $state_code . "'";
        }

        if ($city != null) {
            $where .= " AND p.city = '" . $city . "'";
        }
    }

    $order_by = $sort . " " . $sort_order;

    $pagelimit = "";
    if ($page != null && $limit != null) {
        $pagelimit = "LIMIT  " . ($page - 1) * $limit . "," . $limit;
    }

    $pdo = ORM::get_db();

    $query = "SELECT p.id,p.product_name,p.featured,p.urgent,p.highlight,p.salary_min,p.salary_max,p.category,p.sub_category,p.tag,p.screen_shot,p.user_id,p.city,p.country,p.status,p.hide,p.created_at,p.expire_date,
    u.group_id, g.show_on_home
    FROM `" . $config['db']['pre'] . "product` as p
    INNER JOIN `" . $config['db']['pre'] . "user` as u ON u.id = p.user_id
    INNER JOIN `" . $config['db']['pre'] . "usergroups` as g ON g.group_id = u.group_id
    $where ORDER BY $sort $sort_order $pagelimit";
    $result = $pdo->query($query);
    $rows = $result->rowCount();
    $items = array();
    if ($rows > 0) {
        foreach ($result as $info) {
            $item['id'] = $info['id'];
            $item['product_name'] = $info['product_name'];
            $item['featured'] = $info['featured'];
            $item['urgent'] = $info['urgent'];
            $item['highlight'] = $info['highlight'];
            $item['highlight_bgClr'] = ($info['highlight'] == 1) ? "highlight-premium-ad" : "";

            $cityname = get_cityName_by_id($info['city']);
            $item['location'] = $cityname;
            $item['city'] = $cityname;
            $item['status'] = $info['status'];
            $item['hide'] = $info['hide'];

            $item['created_at'] = timeAgo($info['created_at']);
            $expire_date_timestamp = $info['expire_date'];
            $expire_date = date('d-M-y', $expire_date_timestamp);
            $item['expire_date'] = $expire_date;

            $item['cat_id'] = $info['category'];
            $item['sub_cat_id'] = $info['sub_category'];
            $get_main = get_maincat_by_id($info['category']);
            $get_sub = get_subcat_by_id($info['sub_category']);
            $item['category'] = $get_main['cat_name'];
            $item['sub_category'] = $get_sub['sub_cat_name'];


            $fav_num_rows = ORM::for_table($config['db']['pre'] . 'favads')
                ->where(array(
                    'product_id' => $info['id'],
                    'user_id' => $info['user_id']
                ))
                ->count();
            if ($fav_num_rows == 1)
                $product_favorite = true;
            else
                $product_favorite = false;

            $item['favorite'] = $product_favorite;

            if ($info['tag'] != '') {
                $item['showtag'] = "1";
                $item['tag'] = $info['tag'];
            } else {
                $item['tag'] = "";
                $item['showtag'] = "0";
            }

            $picture = explode(',', $info['screen_shot']);
            $item['pic_count'] = count($picture);

            if ($picture[0] != "") {
                $item['picture'] = $config['site_url'] . "storage/products/thumb/" . $picture[0];
            } else {
                $item['picture'] = $config['site_url'] . "storage/products/thumb/default.png";
            }

            $currency = set_user_currency($info['country']);
            $item['price'] = !empty($info['price']) ? $info['price'] : null;
            $item['currency'] = $currency['html_entity'];
            $item['currency_in_left'] = $currency['in_left'];


            $userinfo = get_user_data("", $info['user_id']);
            $item['username'] = $userinfo['username'];
            $item['user_id'] = $userinfo['id'];


            if (check_user_upgrades($info['user_id'])) {
                $sub_info = get_user_membership_detail($info['user_id']);
                $item['subcription_title'] = $sub_info['sub_title'];
                $item['subcription_image'] = $sub_info['sub_image'];
            } else {
                $item['subcription_title'] = '';
                $item['subcription_image'] = '';
            }

            $items[] = $item;
        }
    } else {
        //echo "0 results";
    }
    send_json($items);
    die();
}

/*
Home page show premium ads
action = home_premium_ads
1. status = "active"
2. location = true or false
3. country_code 
4. premium = true or false
5. page   
6. limit
7. sorting = true or false
*/

function home_premium_ads()
{
    global $config, $lang, $results;

    $cat_id = isset($_REQUEST['category_id']) ? $_REQUEST['category_id'] : null;
    $subcat_id = isset($_REQUEST['subcategory_id']) ? $_REQUEST['subcategory_id'] : null;

    $user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : null;
    $location = isset($_REQUEST['location']) ? $_REQUEST['location'] : false;
    $country_code = isset($_REQUEST['country_code']) ? $_REQUEST['country_code'] : null;
    $state_code = isset($_REQUEST['state']) ? $_REQUEST['state'] : null;
    $city = isset($_REQUEST['city']) ? $_REQUEST['city'] : null;
    $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : null;
    $premium = isset($_REQUEST['premium']) ? $_REQUEST['premium'] : true;
    $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '1';
    $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : '10';
    $sorting = isset($_REQUEST['sorting']) ? $_REQUEST['sorting'] : false;
    $sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : "id";
    $sort_order = isset($_REQUEST['sort_order']) ? $_REQUEST['sort_order'] : "DESC";

    if (isset($_REQUEST['country_code'])) {
        $location = true;
    }

    $results = get_products_data($user_id, $cat_id, $subcat_id, $location, $country_code, $state_code, $city, $status, $premium, $page, $limit, $order = false, $sort = "id", $sort_order = "DESC");
}



/*
Home page show latest ads
action = home_latest_ads
1. country_code
2. limit
3. user_id
4. session_user_id
5. category_id
6. subcategory_id
*/

function home_latest_ads()
{
    global $results;

    $cat_id = isset($_REQUEST['category_id']) ? $_REQUEST['category_id'] : null;
    $subcat_id = isset($_REQUEST['subcategory_id']) ? $_REQUEST['subcategory_id'] : null;

    $user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : null;
    $location = isset($_REQUEST['location']) ? $_REQUEST['location'] : false;
    $country_code = isset($_REQUEST['country_code']) ? $_REQUEST['country_code'] : null;
    $state_code = isset($_REQUEST['state']) ? $_REQUEST['state'] : null;
    $city = isset($_REQUEST['city']) ? $_REQUEST['city'] : null;
    $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : null;
    $premium = isset($_REQUEST['premium']) ? $_REQUEST['premium'] : false;
    $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '1';
    $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : '10';
    $sorting = isset($_REQUEST['sorting']) ? $_REQUEST['sorting'] : false;
    $sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : "id";
    $sort_order = isset($_REQUEST['sort_order']) ? $_REQUEST['sort_order'] : "DESC";

    if (isset($_REQUEST['country_code'])) {
        $location = true;
    }

    $results = get_products_data($user_id, $cat_id, $subcat_id, $location, $country_code, $state_code, $city, $status, $premium, $page, $limit, $order = false, $sort = "id", $sort_order = "DESC");
}

/*
Related ads by category or subcategory
action = related_ads
1. category_id
2. subcategory_id
*/

function related_ads()
{
    global $results;

    $cat_id = isset($_REQUEST['category_id']) ? $_REQUEST['category_id'] : null;
    $subcat_id = isset($_REQUEST['subcategory_id']) ? $_REQUEST['subcategory_id'] : null;

    $user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : null;
    $location = isset($_REQUEST['location']) ? $_REQUEST['location'] : false;
    $country_code = isset($_REQUEST['country_code']) ? $_REQUEST['country_code'] : null;
    $state_code = isset($_REQUEST['state']) ? $_REQUEST['state'] : null;
    $city = isset($_REQUEST['city']) ? $_REQUEST['city'] : null;
    $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : null;
    $premium = isset($_REQUEST['premium']) ? $_REQUEST['premium'] : false;
    $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '1';
    $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : '10';
    $sorting = isset($_REQUEST['sorting']) ? $_REQUEST['sorting'] : false;
    $sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : "id";
    $sort_order = isset($_REQUEST['sort_order']) ? $_REQUEST['sort_order'] : "DESC";

    if (isset($_REQUEST['country_code'])) {
        $location = true;
    }

    $results = get_products_data($user_id, $cat_id, $subcat_id, $location, $country_code, $state_code, $city, $status, $premium, $page, $limit, $order = false, $sort = "id", $sort_order = "DESC");
}

/*
Ad details by ad id
action = ad_detail
1. item_id

Messages
1. Success : ad data in json
2. Error : not found
*/

function ad_detail()
{
    global $config, $link, $lang, $status, $status_code, $message, $results;
    $item_custom = array();
    $job_data = [];
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
    } else {
        $user_id = "";
    }
    if (isset($_REQUEST['item_id'])) {
        $job_id = $_REQUEST['item_id'];
        $num_rows = ORM::for_table($config['db']['pre'] . 'product')->where('id',  $job_id)->count();
        if ($num_rows > 0) {
            $sql = "SELECT p.*, u.username as username,u.name as user_name, u.image as user_image, u.city as user_city, u.city_code as user_city_code, u.country as user_country, u.phone as user_phone, u.email as user_email, u.website as user_website, c.id company_id, c.name company_name, c.logo company_image, c.city company_city, c.state company_state, c.phone company_phone, c.email company_email, c.website company_website FROM `" . $config['db']['pre'] . "product` p LEFT JOIN `" . $config['db']['pre'] . "companies` c on p.company_id = c.id INNER JOIN `" . $config['db']['pre'] . "user` as u ON u.id = p.user_id WHERE p.id = '" . $job_id . "' ";

            $info = ORM::for_table($config['db']['pre'] . 'product')->raw_query($sql)->find_one();
            if (!empty($info)) {
                $item_id = $info['id'];
                $categories_data = get_job_category_and_subcategory($item_id);
                if ($config['company_enable'] && !empty($info['company_id'])) {
                    $company_id = $info['company_id'];
                    $company_name = $info['company_name'];
                    $company_image = !empty($info['company_image']) ? $info['company_image'] : 'default.png';
                    $company_image = $config['site_url'] . 'storage/products/' . $company_image;
                    $company_city = get_cityName_by_id($info['company_city']);
                    $company_state = get_stateName_by_id($info['company_state']);
                    $company_phone = $info['company_phone'];
                    $company_email = $info['company_email'];
                    $company_website = $info['company_website'];
                    $company_link = $link['COMPANY-DETAIL'] . '/' . $info['company_id'] . '/' . create_slug($info['company_name']);
                } else {
                    $company_id = $info['user_id'];
                    $company_name = $info['user_name'];
                    $company_image = !empty($info['user_image']) ? $info['user_image'] : 'default_user.png';
                    $company_image = $config['site_url'] . 'storage/profile/' . $company_image;
                    $company_city = $info['user_city'];
                    $company_state = $info['user_country'];
                    $company_phone = $info['user_phone'];
                    $company_email = $info['user_email'];
                    $company_website = $info['user_website'];
                    $company_link = $link['PROFILE'] . '/' . $info['username'];

                    if (!empty($info['user_city_code'])) {
                        $city_detail = get_cityDetail_by_id($info['user_city_code']);
                        if (!empty($city_detail)) {
                            $company_city = $city_detail['asciiname'];
                            $company_state = get_stateName_by_id($city_detail['subadmin1_code']);
                        }
                    }
                }
                update_itemview($job_id);
                $item_id = $info['id'];

                $item_negotiable = $info['negotiable'];
                if ($item_negotiable == 1)
                    $item_negotiable = $lang['NEGOTIABLE'];
                else
                    $item_negotiable = "";

                $get_main = get_maincat_by_id($info['category']);
                $q_result = ORM::for_table($config['db']['pre'] . 'custom_data')
                    ->where('product_id', $item_id)
                    ->find_many();
                $item_custom_field = count($q_result);
                foreach ($q_result as $customdata) {
                    $field_id = $customdata['field_id'];
                    $field_type = $customdata['field_type'];
                    $field_data = $customdata['field_data'];
                    $item_custom[$field_id]['field_type'] = $customdata['field_type'];

                    $custom_fields_title = get_customField_title_by_id($field_id);

                    if ($field_type == 'checkboxes') {
                        $checkbox_value2 = array();

                        $checkbox_value = explode(",", $field_data);

                        foreach ($checkbox_value as $val) {
                            $val = get_customOption_by_id(trim($val));
                            $checkbox_value2[] = $val;
                        }
                        if ($custom_fields_title != "") {
                            $item_custom[$field_id]['title'] = $custom_fields_title;
                            $item_custom[$field_id]['value'] = implode('  ', $checkbox_value2);
                        }
                    }

                    if ($field_type == 'textarea') {
                        $item_custom[$field_id]['title'] = $custom_fields_title;
                        $item_custom[$field_id]['value'] = preg_replace("/\r|\n/", "", strip_tags(stripslashes($field_data)));
                    }

                    if ($field_type == 'radio-buttons' or $field_type == 'drop-down') {
                        $custom_fields_data = get_customOption_by_id($field_data);
                        $item_custom[$field_id]['title'] = $custom_fields_title;
                        $item_custom[$field_id]['value'] = $custom_fields_data;
                    }

                    if ($field_type == 'text-field') {
                        $custom_fields_data = stripcslashes($field_data);
                        $item_custom[$field_id]['title'] = $custom_fields_title;
                        $item_custom[$field_id]['value'] = $custom_fields_data;
                    }
                }
                if ($info['tag'] != "") {
                    $tag = explode(',', $info['tag']);
                    $tag2 = array();
                    foreach ($tag as $val) {
                        //REMOVE SPACE FROM $VALUE ----
                        $tagTrim = preg_replace("/[\s_]/", "-", trim($val));
                        $tag2[] = '<a href="' . $config['site_url'] . 'listing?keywords=' . $tagTrim . '">' . $val . '</a>';
                    }
                    $item_tag = implode('  ', $tag2);
                    $show_tag = 1;
                } else {
                    $item_tag = "";
                    $show_tag = 0;
                }
                if (!empty($info['latlong'])) {
                    $map = explode(',', $info['latlong']);
                    $mapLat = $map[0];
                    $mapLong = $map[1];
                } else {
                    $mapLat     =  get_option("home_map_latitude");
                    $mapLong    =  get_option("home_map_longitude");
                }

                //similar jobs;
                $country_code = check_user_country();
                $result1 = ORM::for_table($config['db']['pre'] . 'product')
                    ->table_alias('p')
                    ->select('p.*')
                    ->select('c.name', 'company_name')
                    ->select('c.logo', 'company_logo')
                    ->where(array(
                        'p.status' => 'active',
                        'p.hide' => '0',
                        'p.country' => $country_code
                    ))
                    ->join($config['db']['pre'] . 'companies', array('p.company_id', '=', 'c.id'), 'c')
                    ->where_not_equal('p.id', $item_id)
                    ->order_by_desc('p.id')
                    ->limit(4)
                    ->find_many();

                $item = array();
                if (count($result1) > 0) {
                    // output data of each row
                    foreach ($result1 as $info1) {
                        $item[$info1['id']]['id'] = $info1['id'];
                        $item[$info1['id']]['featured'] = $info1['featured'];
                        $item[$info1['id']]['urgent'] = $info1['urgent'];
                        $item[$info1['id']]['product_name'] = $info1['product_name'];
                        $item[$info1['id']]['product_id'] = $info1['company_id'];
                        $item[$info1['id']]['company_name'] = $info1['company_name'];
                        $item[$info1['id']]['company_image'] = !empty($info1['company_logo']) ? $info1['company_logo'] : 'default.png';
                        $item[$info1['id']]['location'] = $info1['location'];
                        $item[$info1['id']]['city'] = $info1['city'];
                        $item[$info1['id']]['cityname'] = get_cityName_by_id($info1['city']);
                        $item[$info1['id']]['state'] = get_stateName_by_id($info1['state']);
                        $item[$info1['id']]['country'] = get_countryName_by_id($info1['country']);
                        $item[$info1['id']]['created_at'] = timeago($info1['created_at']);
                        $item[$info1['id']]['author_id'] = $info['user_id'];
                        $get_main = get_maincat_by_id($info1['category']);
                        $item[$info1['id']]['category'] = $get_main['cat_name'];

                        $item[$info1['id']]['image'] = !empty($info1['screen_shot']) ? $info1['screen_shot'] : $item[$info1['id']]['company_image'];

                        $item[$info1['id']]['product_type'] = get_productType_title_by_id($info1['product_type']);
                        $item[$info1['id']]['salary_type'] = get_salaryType_title_by_id($info1['salary_type']);
                        $item[$info1['id']]['salary_min'] = price_format($info1['salary_min'], $info1['country']);
                        $item[$info1['id']]['salary_max'] = price_format($info1['salary_max'], $info1['country']);

                        $userinfo = get_user_data(null, $info1['user_id']);

                        $item[$info1['id']]['username'] = $userinfo['username'];

                        $pro_url = create_slug($info1['product_name']);
                        $item[$info1['id']]['link'] = $config['site_url'] . 'job/' . $info1['id'] . '/' . $pro_url;

                        $cat_url = create_slug($get_main['cat_name']);
                        $item[$info1['id']]['catlink'] = $config['site_url'] . 'category/' . $info1['category'] . '/' . $cat_url;

                        $city = create_slug($item[$info1['id']]['cityname']);
                        $item[$info1['id']]['citylink'] = $config['site_url'] . 'city/' . $info1['city'] . '/' . $city;
                    }
                }

                $job_data = [
                    'company_id' => $company_id,
                    'company_name' =>  $company_name,
                    'company_image' => $company_image,
                    'company_city' => $company_city,
                    'company_city' => $company_city,
                    'company_state' => $company_state,
                    'company_phone' => $company_phone,
                    'company_email' => $company_email,
                    'company_website' => $company_website,
                    'company_link' => $company_link,
                    'author_id' => $info['user_id'],
                    'username' => $info['username'],

                    'item_title' => $info['product_name'],
                    'item_description' => $info['description'],
                    'item_city' => get_cityName_by_id($info['city']),
                    'item_state' => get_stateName_by_id($info['state']),
                    'item_country' => get_countryName_by_id($info['country']),
                    'item_product_type' => get_productType_title_by_id($info['product_type']),
                    'item_salary_type' => get_salaryType_title_by_id($info['salary_type']),
                    'item_salary_min' => price_format($info['salary_min'], $info['country']),
                    'item_salary_max' => price_format($info['salary_max'], $info['country']),
                    'item_negotiable' => $item_negotiable,
                    'item_created' => timeAgo($info['created_at']),
                    'item_phone' => $info['phone'],
                    'item_hide_phone' => $info['hide_phone'],
                    'item_views' => thousandsCurrencyFormat($info['view']),
                    'item_application_url' => $info['application_url'],
                    'item_image' => $info['screen_shot'] ? $config['site_url'] . '/storage/products/' . $info['screen_shot'] : '',
                    'item_category' => array_values($categories_data['categories']),
                    'item_subcategory' => array_values($categories_data['subcategories']),
                    'item_total customdata' => $item_custom_field,
                    'item_customdata' => array_values($item_custom),
                    'item_show_tags' => $show_tag,
                    'item_tags' => $item_tag,
                    'latitude' => $mapLat,
                    'longitude' => $mapLong,
                    'similar_jobs' => array_values($item),

                ];
                if (!empty($user_id)) {
                    $job_data['is_favourite'] = check_product_favorite($item_id, $user_id);
                    $job_data['is_applied'] = check_user_applied($item_id, $user_id);
                }
                $status_code = HTTP_OK;
                $status = $lang['SUCCESS'];
                $message = $lang['SUCCESS'];
            } else {
                $status_code = HTTP_UNPROCESSABLE_ENTITY;
                $status = $lang['ERROR'];
                $message = $lang['NOT_FOUND'];
            }
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['NOT_FOUND'];
        }
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = 'Unique id not provided.';
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'job_data' => $job_data];
    send_json($results);
    die();
}


/*
Ad delete by ad id
action = ad_delete
1. item_id
1. user_id

Messages
1. status : success or error
*/

function ad_delete()
{
    global $config, $results, $lang;
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    if (isset($_REQUEST['item_id'])) {
        $row = ORM::for_table($config['db']['pre'] . 'product')
            ->select_many('id', 'screen_shot')
            ->where(array(
                'id' => $_REQUEST['item_id'],
                'user_id' => $user_id,
            ))
            ->find_one();

        if (!empty($row)) {
            // $uploaddir =  "../../storage/products/";
            // $screen_sm = explode(',', $row['screen_shot']);
            // foreach ($screen_sm as $value) {
            //     $value = trim($value);
            //     //Delete Image From Storage ----
            //     if (!empty($value)) {
            //         $filename1 = $uploaddir . $value;
            //         $filename2 = $uploaddir . "small_" . $value;
            //         if (file_exists($filename1)) {
            //             // $filename1 = $uploaddir.$value;
            //             unlink($filename1);
            //         }
            //         if (file_exists($filename2)) {
            //             unlink($filename2);
            //         }
            //     }
            //}

            // ORM::for_table($config['db']['pre'] . 'product')
            //     ->where(array(
            //         'id' => $_REQUEST['item_id'],
            //         'user_id' => $user_id,
            //     ))
            //     ->delete_many();
            $row->deleted = 1;
            $row->deleted_at = date('Y-m-d H:i:s');
            $row->save();
        }

        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['FAILED'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token']];

    send_json($results);
    die();
}

function get_countries_list($selected = "", $selected_text = 'selected', $installed = 1)
{
    global $config;
    $countries_array = array();
    if ($installed) {
        $result = ORM::for_table($config['db']['pre'] . 'countries')
            ->select_many('id', 'code', 'asciiname', 'languages')
            ->where('active', '1')
            ->order_by_asc('asciiname')
            ->find_many();
    } else {

        $result = ORM::for_table($config['db']['pre'] . 'countries')
            ->select_many('id', 'code', 'asciiname', 'languages')
            ->order_by_asc('asciiname')
            ->find_many();
    }

    foreach ($result as $info) {
        $countries['id'] = $info['id'];
        $countries['code'] = $info['code'];
        $countries['lowercase_code'] = strtolower($info['code']);
        $countries['name'] = $info['asciiname'];
        $countries['lang'] = getLangFromCountry($info['languages']);
        if ($selected != "") {
            if (is_array($selected)) {
                foreach ($selected as $select) {

                    $select = strtoupper(str_replace('"', '', $select));
                    if ($select == $info['id']) {
                        $countries['selected'] = $selected_text;
                    }
                }
            } else {
                if ($selected == $info['id'] or $selected == $info['code'] or $selected == $info['asciiname']) {
                    $countries['selected'] = $selected_text;
                } else {
                    $countries['selected'] = "";
                }
            }
        }

        $countries_array[] = $countries;
    }

    return $countries_array;
}

/*
Installed Countries
action = installed_countries

Messages
1. Success : Countries list json
2. Error : not found
*/

function installed_countries()
{
    global $config, $con, $lang, $results;

    $countries = new Country();
    $country_list = $countries->transAll(get_countries_list());

    if (is_array($country_list)) {
        $results = $country_list;
        send_json($results);
    }

    $results['status'] = "error";
    $results['message'] = "No country found";
    send_json($results);
}

/*
Get State By Country Code
action = getStateByCountryCode
1. country_code

Messages
1. Success : States list json
2. Error : not found
*/

function getStateByCountryCode()
{
    global $config, $con, $lang, $results;

    if (isset($_REQUEST['country_code'])) {
        $country_code = $_REQUEST['country_code'];

        $result = ORM::for_table($config['db']['pre'] . 'subadmin1')
            ->select_many('id', 'code', 'name')
            ->where(array(
                'country_code' => $country_code,
                'active' => '1'
            ))
            ->order_by_asc('name')
            ->find_many();

        $states = array();
        foreach ($result as $info) {
            $get_state['id'] = $info['id'];
            $get_state['code'] = $info['code'];
            $get_state['name'] = $info['name'];

            $states[] = $get_state;
        }
        $results = $states;
        send_json($results);
    }


    $results['status'] = "error";
    $results['message'] = "No state found";
}

/*
Get City id By State Code
action = getCityByStateCode
1. state_code

Messages
1. Success : cities list json
2. Error : not found
*/

function getCityByStateCode()
{
    global $config, $con, $lang, $results;

    if (isset($_REQUEST['state_code'])) {
        $state_id = $_REQUEST['state_code'];

        $result = ORM::for_table($config['db']['pre'] . 'cities')
            ->select_many('id', 'name', 'longitude', 'latitude')
            ->where(array(
                'subadmin1_code' => $state_id,
                'active' => '1'
            ))
            ->order_by_asc('name')
            ->find_many();

        $cities = array();
        foreach ($result as $info) {
            $get_city['id'] = $info['id'];
            $get_city['name'] = $info['name'];
            $get_city['longitude'] = $info['longitude'];
            $get_city['latitude'] = $info['latitude'];

            $cities[] = $get_city;
        }
        $results = $cities;
        send_json($results);
    }


    $results['status'] = "error";
    $results['message'] = "No state found";
}

/*
Get City id By CityName
action = getCityidByCityName
1. country_code
2. state_name
2. city_name

Messages
1. Success : city_id
2. Error : not found
*/

function getCityidByCityName()
{
    global $config, $con, $lang, $results;

    $country_code = isset($_REQUEST['country_code']) ? $_REQUEST['country_code'] : "";
    $state = isset($_REQUEST['state_name']) ? $_REQUEST['state_name'] : "";
    $city_name = isset($_REQUEST['city_name']) ? $_REQUEST['city_name'] : "";

    $row = ORM::for_table($config['db']['pre'] . 'subadmin1')
        ->select('code')
        ->where('active', 1)
        ->where_raw('(`name` = ? OR `asciiname` = ?)', array($state, $state))
        ->find_one();
    $state_code = $row['code'];

    $info2 = ORM::for_table($config['db']['pre'] . 'cities')
        ->select('id')
        ->where(array(
            'subadmin1_code' => $state_code,
            'country_code' => $country_code,
            'active' => '1'
        ))
        ->where_raw('(`name` = ? OR `asciiname` = ?)', array($city_name, $city_name))
        ->find_one();

    $id = $info2['id'];
    if ($id) {
        $status_code = HTTP_OK;
        $results['status'] = "success";
        $results['city_id'] = $id;
        $results['status_code'] = $status_code;
        send_json($results);
        die();
    }
    $status_code = HTTP_UNAUTHORIZED;
    $results['status'] = "error";
    $results['status_code'] = $status_code;
    $results['message'] = $lang['NO_RESULT_FOUND'];
    send_json($results);
    die();
}


/*
Get Chat Messages
action = get_all_msg
1. ses_userid
2. client_id

Messages
1. Success : messages array
2. Error : not found
*/

function get_all_msg()
{
    global $config, $con, $lang, $results, $status_code, $status, $message;
    $chat_message = array();
    $perPage = 10;
    $chat_message = array();
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();

    if ($bearer_token != null && $valid_auth_token) {
        $ses_userid = get_device_token($valid_auth_token, 'user_id');
        $client_id = $_REQUEST['client_id'];

        /*$info = ORM::for_table($config['db']['pre'].'messages')
            ->where_any_is(array(
                array('to_id' => $ses_userid, 'from_id' => $client_id),
                array('to_id' => $client_id, 'from_id' => $ses_userid)))
            ->order_by_desc('message_id')
            ->find_many();*/

        $sql = "select * from `" . $config['db']['pre'] . "messages` where ((to_id = '" . $ses_userid . "' AND from_id = '" . $client_id . "') OR (to_id = '" . $client_id . "' AND from_id = '" . $ses_userid . "' ))order by message_id DESC ";

        $page = 1;
        if (!empty($_REQUEST["page"])) {
            $_SESSION['chatpage'] = $page = $_REQUEST["page"];
        }

        $start = ($page - 1) * $perPage;
        if ($start < 0) $start = 0;

        $query =  $sql . " limit " . $start . "," . $perPage;

        $query = $con->query($query);

        if (empty($_REQUEST["rowcount"])) {
            $_GET["rowcount"] = $rowcount = mysqli_num_rows(mysqli_query($con, $sql));
        }

        $pages  = ceil($_GET["rowcount"] / $perPage);

        $chatBoxes = array();
        $items = '';
        if (!empty($query)) {
        }

        // print_r(mysqli_fetch_array($query));
        while ($chat = mysqli_fetch_array($query)) {

            $picname = "";
            $picname2 = "";

            $info = ORM::for_table($config['db']['pre'] . 'user')
                ->select('image')
                // ->where('username', $chat['from_uname'])
                ->where_raw('(`username` = ? OR `id` = ?)', array($chat['from_uname'], $chat['from_id']))
                ->find_one();
            $picname = "small_" . $info['image'];

            $info4 = ORM::for_table($config['db']['pre'] . 'user')
                ->select('image')
                // ->where('username', $chat['to_uname'])
                ->where_raw('(`username` = ? OR `id` = ?)', array($chat['to_uname'], $chat['to_id']))
                ->find_one();
            $picname2 = "small_" . $info4['image'];

            if ($picname == "small_")
                $picname = "default_user.png";

            if ($picname2 == "small_")
                $picname2 = "default_user.png";

            $status = "0";
            if ($status == "0")
                $status = "Offline";
            else
                $status = "Online";
            if (strpos($chat['message_content'], sanitize('file_name')) !== false) {
            } else {
                if ($chat['message_type'] != 'html') {
                    $chat['message_content'] = sanitize($chat['message_content']);
                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,10}(\/\S*)?/";

                    // Check if there is a url in the text
                    if (preg_match($reg_exUrl, $chat['message_content'], $url)) {

                        // make the urls hyper links
                        $chat['message_content'] = preg_replace($reg_exUrl, "<a href='{$url[0]}'>{$url[0]}</a>", $chat['message_content']);
                    } else {
                        // The Regular Expression filter
                        $reg_exUrl = "/(www)\.[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,10}(\/\S*)?/";

                        // Check if there is a url in the text
                        if (preg_match($reg_exUrl, $chat['message_content'], $url)) {

                            // make the urls hyper links
                            $chat['message_content'] = preg_replace($reg_exUrl, "<a href='{$url[0]}'>{$url[0]}</a>", $chat['message_content']);
                        }
                    }
                }
            }

            $timeago = timeAgo($chat['message_date']);
            $chatContent = $chat['message_type'] == 'file' ? json_decode($chat['message_content']) : $chat['message_content']; //stripslashes($chat['message_content']);
            $chatting['sender_username'] = $chat['from_uname'];
            $chatting['sender_id'] = $chat['from_id'];
            $chatting['client_username'] = $chat['to_uname'];
            $chatting['sender_pic'] = $picname;
            $chatting['client_pic'] = $picname2;
            $chatting['total_pages'] = $pages;
            $chatting['page'] = @$_SESSION['chatpage'] ?? 1;
            $chatting['mtype'] = $chat['message_type'];
            $chatting['message'] = $chatContent;
            $chatting['time'] = $timeago;
            $chatting['recd'] = $chat['recd'];
            $chatting['seen'] = $chat['seen'];

            $chat_message[] = $chatting;
        }

        $results = $chat_message;

        $query = "UPDATE `" . $config['db']['pre'] . "messages` SET `recd` = '1', `seen` = '1' WHERE (to_id = '" . $ses_userid . "' AND from_id = '" . $client_id . "') OR (to_id = '" . $client_id . "' AND from_id = '" . $ses_userid . "' ) ";
        $query = $con->query($query);

        $status_code = HTTP_OK;
        $status =  $lang['SUCCESS'];
        $message = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status =  $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'total_pages' => $pages, 'chat_message' => $chat_message];
    send_json($results);
    die();
}


/*
Get Chat Conversation
action = chat_conversation
1. session_user_id

Messages
1. Success : messages array
2. Error : not found
*/

function getlastActiveTime($userid)
{
    // global $config, $lang;
    // if (get_option('quickchat_ajax_on_off') == 'on') {
    //     $json3 = file_get_contents('../../plugins/quickchat-ajax/json/online-status.json');
    // } else {
    //     $json3 = file_get_contents('../../plugins/wchat/json/online-status.json');
    // }
    // $obj3 = json_decode($json3, true);
    // $lastActiveTime = $obj3['lastActive'];

    // $lastseen = "";
    // for ($i = 0; $i < count($lastActiveTime); $i++) {
    //     if ($lastActiveTime[$i]['username'] == $username) {
    //         $last_active = $lastActiveTime[$i]['last_active_timestamp'];

    //         $timeFirst  = strtotime($last_active);
    //         $timeSecond = strtotime($GLOBALS['timenow']);
    //         $differenceInSeconds = $timeSecond - $timeFirst;

    //         if ($differenceInSeconds >= "0" and $differenceInSeconds <= "5")
    //             $lastseen = "Online";
    //         else
    //             $lastseen = $lang['LAST_SEEN'] . " " . timeAgo($last_active);

    //         break;
    //     } else {
    //         $lastseen = "Offline";
    //     }
    // }
    // return $lastseen;
    global $config, $lang, $con;
    $res = mysqli_query($con, "SELECT * FROM `" . $config['db']['pre'] . "user` WHERE id = '$userid' AND TIMESTAMPDIFF(MINUTE, lastactive, NOW()) > 1");
    if ($res === FALSE) {
        $onofst = "offline";
    } else {
        $num = mysqli_num_rows($res);
        if ($num == "0")
            $onofst = "online";
        else
            $onofst = "offline";
    }
    return $onofst;
}



function chat_conversation()
{
    global $con, $config, $lang, $status, $status_code, $message, $results;
    $chatfriendlist = [];
    $chat_message = array();
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();

    if ($bearer_token != null && $valid_auth_token) {
        $session_user_id = get_device_token($valid_auth_token, 'user_id');
        //$session_user_id = $_REQUEST['session_user_id'];
        $row1 = ORM::for_table($config['db']['pre'] . 'user')
            ->select_many('username', 'image')
            ->where('id', $session_user_id)
            ->find_one();
        //print_r($row1);
        $session_username = $row1['username'];
        $session_user_image = $row1['image'];
        $searchKey = isset($_POST['searchKey']) ? $_POST['searchKey'] : '';
        if ($searchKey != '') {
            $where = "( u.username like '%$searchKey%' ) AND";
        } else {
            $where = '';
        }
        if ($session_user_image == "")
            $session_user_image = "default_user.png";

        // This query shows user contact list by conversation
        // $query = "select id,username,name,image,message_date from `".$config['db']['pre']."user` as u
        //         INNER JOIN
        //         (
        //             select max(message_id) as message_id,to_id,from_id,message_date from `".$config['db']['pre']."messages` where to_id = '".$session_user_id."' or from_id = '".$session_user_id."' GROUP BY to_id,from_id
        //         )
        //         m ON u.id = m.from_id or u.id = m.to_id  where (u.id != '".$session_user_id."') GROUP BY u.id
        //         ORDER BY message_id DESC";
        $query = "select id,username,name,image, message_date,message_content,message_type, post_id, m.message_id from `" . $config['db']['pre'] . "user` as u
        INNER JOIN
        (
            select max(message_id) as message_id,to_id,from_id from `" . $config['db']['pre'] . "messages` where to_id = '" . $session_user_id . "' or from_id = '" . $session_user_id . "'  GROUP BY  least(from_id, to_id), greatest(from_id, to_id)
        )
        m ON u.id = m.from_id or u.id = m.to_id JOIN job_messages m1 ON  m1.message_id=m.message_id  where $where (u.id != '" . $session_user_id . "') GROUP BY u.id
        ORDER BY m.message_id DESC ";
        //This query shows all user list publicly
        // $query = "select id,username,name,image from `".$config['db']['pre'].$GLOBALS['MySQLi_user_table_name']."` where `".$GLOBALS['MySQLi_userid_field']."` != '".$session_user_id."' ORDER BY id DESC";

        $result = $con->query($query);
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $from_user_id = $row['id'];
                $from_username = $row['username'];
                $from_fullname = $row['name'];
                $from_user_image = $row['image'];
                if ($row['message_type'] == 'file') {
                    $chatContent = json_decode($row['message_content']);
                } else {
                    $chatContent = $row['message_content'];
                }

                $timeago = timeAgo($row['message_date']);
                if ($from_user_image == "")
                    $from_user_image = "default_user.png";
                else {
                    $from_user_image = "small_" . $from_user_image;
                }
                $unseen_message = ORM::for_table($config['db']['pre'] . 'messages')
                    ->where(array(
                        'to_id' => $session_user_id,
                        'from_id' => $from_user_id,
                        'seen' => '0',
                    ))->count();
                $onofst =  getlastActiveTime($from_user_id);

                $chatting['session_user_id'] = $session_user_id;
                $chatting['session_username'] = $session_username;
                $chatting['session_user_image'] = $session_user_image;
                $chatting['from_user_id'] = $from_user_id;
                $chatting['from_username'] = $from_username;
                $chatting['from_user_image'] = $from_user_image;
                $chatting['from_fullname'] = $from_fullname;
                $chatting['unseen'] = $unseen_message;
                $chatting['status'] = $onofst;
                $chatting['mtype'] = $row['message_type'];
                $chatting['message'] = $chatContent;
                $chatting['time'] = $timeago;

                $chat_message[] = $chatting;
            }
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['SUCCESS'];
            $chatfriendlist = $chat_message;
        } else {
            $status_code = HTTP_OK;
            $status =  $lang['ERROR'];
            $message = $lang['NO_RESULT_FOUND'];
            $chatfriendlist = [];
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status =  $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'chatfriendlist' => $chatfriendlist];
    send_json($results);
    die();
}

/*
Send Message
action = send_message

1. from_id
2. to_id
3. message

Messages
1. Success : message_id
2. Error : not found
*/

function send_message()
{
    global $config, $con, $lang, $results, $status_code, $status, $message;
    $message_id = $fcm_response = '';
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();

    if ($bearer_token != null && $valid_auth_token) {
        $from_id = get_device_token($valid_auth_token, 'user_id');
        //$from_id = $_REQUEST['from_id'];
        $to_id = $_REQUEST['to_id'];
        $message = $_REQUEST['message'];
        //$now = time();
        $timenow = date('Y-m-d H:i:s');
        $info = ORM::for_table($config['db']['pre'] . 'user')
            ->select('username')
            ->where('id', $from_id)
            ->find_one();
        $from = $info['username'];

        $info2 = ORM::for_table($config['db']['pre'] . 'user')
            ->select('username')
            ->where('id', $to_id)
            ->find_one();
        if (!empty($info2)) {
            $to = $info2['username'];
        } else {
            $to = "";
        }

        if ($to != "") {
            //$pdo = ORM::get_db();
            $sql = "insert into `" . $config['db']['pre'] . "messages` (from_uname,to_uname,from_id,to_id,message_content,message_type,message_date) values ('" . mysqli_real_escape_string($con, $from) . "', '" . mysqli_real_escape_string($con, $to) . "','" . mysqli_real_escape_string($con, $from_id) . "','" . mysqli_real_escape_string($con, $to_id) . "','" . mysqli_real_escape_string($con, $message) . "','text','" . $timenow . "')";
            $query = $con->query($sql);
            $msg_id = $con->insert_id;

            /*SEND AD DELETED FIREBASE NOTIFICATION TO AUTHOR*/
            $note_title = "New message from " . $from;
            $message = $message;
            $fcm_resp = sendFCM($message, $to_id, $note_title, ['reference_id' => $msg_id, 'action_type' => 'chat'], "", $from_id);
            $status_code = HTTP_OK;
            $status =  $lang['SUCCESS'];
            $message = $lang['MSG_SENT'];
            $message_id =  $msg_id;
            $fcm_response = json_decode($fcm_resp, true);
        } else {
            $status_code = HTTP_UNAUTHORIZED;
            $status =  $lang['ERROR'];
            $message = $lang['ERROR'];
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status =  $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'message_id' => $message_id, 'fcm_response' => $fcm_response];
    send_json($results);
    die();
}

function updateSeenmsg()
{
    global $con, $lang, $config;
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $userid = $loggedin['user_id'];
    $chat_user_id = (isset($_REQUEST['chat_user_id']) && !empty($_REQUEST['chat_user_id'])) ? $_REQUEST['chat_user_id'] : 0;
    $query = "Update `" . $config['db']['pre'] . "messages` set seen='1' where to_id = '" . $userid . "' AND from_id = '$chat_user_id'";
    $con->query($query);
    $query1 = "SELECT 1 FROM `" . $config['db']['pre'] . "messages` where to_id = '" . $userid . "' AND seen = '0'";
    $msg_count = mysqli_num_rows($con->query($query1));
    $results = ['status_code' => HTTP_OK, 'status' => $lang['SUCCESS'], 'message' => $lang['SUCCESS'], 'auth_token' => $loggedin['auth_token'], 'unseen_messages' => $msg_count];
    send_json($results);
    die();
}


/*
Get Laguages List
action = languages_list
*/

function languages_list()
{

    global $config, $con, $lang, $results;

    $language_array = array();

    $rows = ORM::for_table($config['db']['pre'] . 'languages')
        ->where('active', '1')
        ->order_by_asc('name')
        ->find_many();

    foreach ($rows as $info) {
        $language['id'] = $info['id'];
        $language['code'] = $info['code'];
        $language['direction'] = $info['direction'];
        $language['name'] = $info['name'];
        $language['file_name'] = $info['file_name'];
        $language['active'] = $info['active'];
        $language['default'] = $info['default'];

        $language_array[] = $language;
    }

    $results = $language_array;
    send_json($results);
    die();
}

/*
Get language variables
action = language_file
1. file_name

Messages
1. Success : array
*/
function language_file()
{
    global $lang, $results;

    $lang_file_path = 'lang/all-languages.json';

    if (file_exists($lang_file_path)) {
        echo $json_lang = file_get_contents($lang_file_path);
        die();
    } else {
        $results['status'] = "Language File Not exist";
        send_json($results);
        die();
    }
    die();
}

/*
Get main categories List
action = categories
*/
function categories()
{
    global $config, $con, $lang, $results;

    $category = array();

    $rows = ORM::for_table($config['db']['pre'] . 'catagory_main')
        ->order_by_asc('cat_order')
        ->find_many();

    foreach ($rows as $info) {
        $cat['id'] = $info['cat_id'];
        $cat['icon'] = $info['icon'];
        $cat['image'] = $config['site_url'] . "storage/cat-picture/" . $info['picture'];

        if ($config['lang_code'] != 'en' && $config['userlangsel'] == '1') {
            $maincat = get_category_translation("main", $info['cat_id']);
            $cat['name'] = $maincat['title'];
            $cat['slug'] = $maincat['slug'];
        } else {
            $cat['name'] = $info['cat_name'];
            $cat['slug'] = $info['slug'];
        }

        $category[] = $cat;
    }
    $results = ['status_code' => HTTP_OK, 'status' => $lang['SUCCESS'], 'message' => $lang['SUCCESS'], 'category' => $category];
    send_json($results);
    die();
}

/*
Get sub categories By main category id
action = sub_categories
1. category_id

Messages
1. Success : array
*/
function sub_categories()
{
    global $config, $con, $lang, $results;
    $category_id = json_decode($_REQUEST['category_id']);
    $sub_category = array();
    $selectid = isset($_REQUEST['selectid']) ? json_decode($_REQUEST['selectid']) : [];
    $rows = ORM::for_table($config['db']['pre'] . 'catagory_sub')
        ->where_in('main_cat_id', $category_id)
        ->order_by_asc('cat_order')
        ->find_many();

    foreach ($rows as $info) {
        $subcat['id'] = $info['sub_cat_id'];
        $subcat['photo_show'] = $info['photo_show'];
        $subcat['price_show'] = $info['price_show'];
        $subcat['image'] = $config['site_url'] . "storage/subcat-picture/" . $info['picture'];

        if ($config['lang_code'] != 'en' && $config['userlangsel'] == '1') {
            $subcategory = get_category_translation("sub", $info['sub_cat_id']);

            $subcat['name'] = $subcategory['title'];
            $subcat['slug'] = $subcategory['slug'];
        } else {
            $subcat['name'] = $info['sub_cat_name'];
            $subcat['slug'] =  $info['slug'];
        }
        if (in_array($subcat['id'], $selectid)) {
            $selected_text = true;
        } else {
            $selected_text = false;
        }
        $subcat['selected'] =  $selected_text;
        $sub_category[] = $subcat;
    }

    // $results = $sub_category;
    $results = ['status_code' => HTTP_OK, 'status' => $lang['SUCCESS'], 'message' => $lang['SUCCESS'], 'sub_categories' => $sub_category];
    send_json($results);
    die();
}

/*
Make Offer
action = make_offer
1. SenderName
2. SenderId
3. OwnerName
4. OwnerId
5. email
6. subject
7. message
8. productId
9. productTitle
10. type

Messages
1. Success
*/

/*Post Ad APi*/
function custom_fields_json()
{

    global $config, $lang;
    $maincatid = isset($_REQUEST['category_id']) ? $_REQUEST['category_id'] : null;
    $subcatid = isset($_REQUEST['subcategory_id']) ? $_REQUEST['subcategory_id'] : null;

    $custom_fields = array();


    $custom_fields = get_customFields_by_catid($maincatid, $subcatid);
    $results['status_code'] = HTTP_OK;
    $results['status'] = $lang['SUCCESS'];
    $results['message'] = $lang['SUCCESS'];
    $results['custom_fields'] = array_values($custom_fields);
    send_json($results);
    die();
}

function send_cusdata_getjson()
{
    global $config, $lang;
    $cusfields = array();
    $maincatid = isset($_REQUEST['catid']) ? $_REQUEST['catid'] : null;
    $subcatid = isset($_REQUEST['subcatid']) ? $_REQUEST['subcatid'] : null;
    if ($maincatid != null) {
        $custom_fields = get_customFields_by_catid($maincatid, $subcatid);
        if (isset($_REQUEST['custom'])) {
            foreach ($custom_fields as $key => $value) {
                if ($value['userent']) {
                    $cf['id'] = $value['id'];
                    $cf['type'] = $value['type'];
                    if ($cf['textarea'] == "textarea")
                        $cf['value'] = validate_input($value['default'], true);
                    else
                        $cf['value'] = validate_input($value['default']);

                    $cusfields[] = $cf;
                }
            }

            echo json_encode($cusfields);
            die();
        }
    } else {
        echo "error";
        die();
    }
}

function save_post_customField_data($custom_fields = array(), $product_id)
{

    global $config;

    if (count($custom_fields) > 0) {
        foreach ($custom_fields as $key => $value) {
            $field_id = $value['id'];
            $field_type = $value['type'];
            if ($field_type == "textarea")
                $field_data = validate_input($value['value'], true);
            else
                $field_data = validate_input($value['value']);

            if (isset($product_id)) {
                $exist = 0;
                //Checking Data exist
                $exist = ORM::for_table($config['db']['pre'] . 'custom_data')
                    ->where(array(
                        'product_id' => $product_id,
                        'field_id' => $field_id
                    ))
                    ->count();

                if ($exist > 0) {
                    //Update here
                    $pdo = ORM::get_db();
                    $query = "UPDATE `" . $config['db']['pre'] . "custom_data` set field_type = '" . $field_type . "', field_data = '" . $field_data . "' where product_id = '" . $product_id . "' and field_id = '" . $field_id . "' LIMIT 1";
                    $pdo->query($query);
                } else {
                    //Insert here
                    if ($field_data != "") {
                        $field_insert = ORM::for_table($config['db']['pre'] . 'custom_data')->create();
                        $field_insert->product_id = $product_id;
                        $field_insert->field_id = $field_id;
                        $field_insert->field_type = $field_type;
                        $field_insert->field_data = $field_data;
                        $field_insert->save();
                    }
                }
            }
        }
    }
}

function getCustomFieldByCatID()
{
    global $config, $lang;
    $cusfields = array();

    if (is_numeric($_REQUEST['catid']) && $_REQUEST['catid'] != 0) {
        $maincatid = isset($_REQUEST['catid']) ? $_REQUEST['catid'] : null;
    } else {
        $maincatid = null;
    }

    if (is_numeric($_REQUEST['subcatid']) && $_REQUEST['subcatid'] != 0) {
        $subcatid = isset($_REQUEST['subcatid']) ? $_REQUEST['subcatid'] : null;
    } else {
        $subcatid = null;
    }

    if (isset($_REQUEST['additionalinfo'])) {
        $_REQUEST['custom'] = array();
        $json_array = json_decode($_REQUEST['additionalinfo'], true);

        if (is_array($json_array)) {

            $field_id = array();
            $field_value = array();

            foreach ($json_array as $key => $value) {
                $field_id[] = $value['id'];
                $field_value[] = $value['value'];
            }

            $custom_fields = get_customFields_by_catid($maincatid, $subcatid, false, $field_id, $field_value);
            $showCustomField = (count($custom_fields) > 0) ? 1 : 0;
        } elseif ($maincatid != null) {
            $custom_fields = get_customFields_by_catid($maincatid, $subcatid);
            $showCustomField = (count($custom_fields) > 0) ? 1 : 0;
        } else {
            $showCustomField = 0;
        }
    } else {
        if ($maincatid != null) {
            $custom_fields = get_customFields_by_catid($maincatid, $subcatid);
            $showCustomField = (count($custom_fields) > 0) ? 1 : 0;
        } else {
            $showCustomField = 0;
        }
    }


    $tpl = '
    <input type="hidden" name="catid" value="' . $maincatid . '"/>
    <input type="hidden" name="subcatid" value="' . $subcatid . '"/>
    ';
    if ($showCustomField) {
        foreach ($custom_fields as $row) {
            $id = $row['id'];
            $name = $row['title'];
            $type = $row['type'];
            $required = $row['required'];

            if ($type == "text-field") {
                $lookFront = $row['textbox'];
                $tpl .= '<div class="row form-group">
                            <label class="col-sm-3 label-title">' . $name . ' ' . ($required === "1" ? '<span class="required">*</span>' : "") . '</label>
                            <div class="col-sm-9">
                                ' . $lookFront . '
                            </div>
                        </div>';
            } elseif ($type == "textarea") {
                $lookFront = $row['textarea'];
                $tpl .= '<div class="row form-group">
                            <label class="col-sm-3 label-title">' . $name . ' ' . ($required === "1" ? '<span class="required">*</span>' : "") . '</label>
                            <div class="col-sm-9">
                                ' . $lookFront . '
                            </div>
                        </div>';
            } elseif ($type == "radio-buttons") {
                $lookFront = $row['radio'];
                $tpl .= '<div class="row form-group">
                            <label class="col-sm-3 label-title">' . $name . ' ' . ($required === "1" ? '<span class="required">*</span>' : "") . '</label>
                            <div class="col-sm-9">' . $lookFront . '</div>
                        </div>';
            } elseif ($type == "checkboxes") {
                $lookFront = $row['checkboxBootstrap'];
                $tpl .= '<div class="row form-group">
                            <label class="col-sm-3 label-title">' . $name . ' ' . ($required === "1" ? '<span class="required">*</span>' : "") . '</label>
                            <div class="col-sm-9">' . $lookFront . '</div>
                        </div>';
            } elseif ($type == "drop-down") {
                $lookFront = $row['selectbox'];
                $tpl .= '<div class="row form-group">
                            <label class="col-sm-3 label-title">' . $name . ' ' . ($required === "1" ? '<span class="required">*</span>' : "") . '</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="custom[' . $id . ']" ' . $required . '>
                                    <option value="" selected>' . $lang['SELECT'] . ' ' . $name . '</option>
                                    ' . $lookFront . '
                                </select>
                            </div>
                        </div>';
            }
        }

        echo '<!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">   
                <title>Additional information form</title>

                <!-- Latest compiled and minified CSS -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
                
                <!-- Optional theme -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
            
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                
                <link rel="stylesheet" href="css/font-awesome.min.css">
                <link rel="stylesheet" href="css/checkbox-radio.css">
            
            </head>
            <body class="pad-20">
                <form method="post" id="custom_field_frm" action="' . $config['site_url'] . 'api/v1/?action=send_cusdata_getjson" accept-charset="UTF-8">
                ' . $tpl . '
                <input type="submit"  type="button" value="Done" class="btn btn-success">
                </form>
                
                <script type="text/javascript">
                    // this is the id of the form
                    $("#custom_field_frm").submit(function(e) {
                        e.preventDefault(); // avoid to execute the actual submit of the form.
                        var form = $(this);
                        var url = form.attr(\'action\');

                        $.ajax({
                            type: "POST",
                            url: url,
                            data: form.serialize(), // serializes the form\'s elements.
                            success: function(data)
                            {
                                AndroidInterface.additionalInfo(data);
                            }
                        });
                    });
                </script>
            </body>
        </html>';

        die();
    } else {
        echo "There is no additional field available for this category.";
        die();
    }
}


/*
Save Post
action = save_post
1. user_id
2. category_id
3. subcategory_id
4. country_code
5. state
6. city
7. description
8. location
9. hide_phone
10. negotiable
11. price
12. phone
13. latitude
14. longitude
15. tags
16. item_screen

Messages
1. Success : insert id
*/
function save_post()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = array();
    $response = array();
    $loggedin = false;
    global $config, $lang, $results;
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    $user_id = '';
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $loggedin = true;
    }
    if (($loggedin == false) && get_option("post_without_login") == '0') {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['POST_WITHOUT_LOGIN_ERR'];
    } else {
        if ($loggedin) {
            $user_data = get_user_data(null, $user_id);
            if ($user_data['user_type'] == 'user') {
                $errors['user_type_error'] = $lang['INVALID_USER'];
            }
            $post_limit =  check_user_post_limit($user_id);
            if (!$post_limit) {
                $errors['post_limit_error'] = $lang['POST_LIMIT_EXCEED'];
            }
            if (!$config['non_active_allow']) {
                $user_data = get_user_data(null, $user_id);

                if ($user_data['status'] == 0) {
                    $errors['email_verify'] = $lang['EMAIL_VERIFY_MSG'];
                }
            }
        }
        $additionalinfo = isset($_REQUEST['additionalinfo']) ? $_REQUEST['additionalinfo'] : null;
        $custom_fields = array();
        if ($additionalinfo != null) {
            $custom_fields = json_decode($additionalinfo, true);
        }
        if (empty($_REQUEST['subcatid'])) {
            $errors['subcatid'] = $lang['SUBCAT_REQ'];
        }
        if (empty($_REQUEST['title'])) {
            $errors['title'] = $lang['JOB_TITLE_REQ'];
        }
        if (empty($_REQUEST['content'])) {
            $errors['content'] = $lang['DESC_REQ'];
        }
        if (empty($_REQUEST['content'])) {
            $errors['content'] = $lang['JOB_TYPE_REQ'];
        }

        if (!empty($_REQUEST['salary_min']) or !empty($_REQUEST['salary_max'])) {
            if (!is_numeric($_REQUEST['salary_min']) or !is_numeric($_REQUEST['salary_max'])) {
                $errors['salary'] = $lang['SALARY_MUST_NO'];
            }
        }
        if (!empty($_REQUEST['application_url'])) {
            if (filter_var($_REQUEST['application_url'], FILTER_VALIDATE_URL) === FALSE) {
                $errors['application_url'] = $lang['APPLICATION_URL_INVALID'];
            }
        }
        if (!$loggedin) {
            if (isset($_REQUEST['user_name'])) {
                $seller_name = $_REQUEST['user_name'];
                if (empty($seller_name)) {
                    $errors['user_name'] = $lang['USER_NAME_REQ'];
                }
            } else {
                $errors['user_name'] = $lang['USER_NAME_REQ'];
            }

            if (isset($_REQUEST['user_email'])) {
                $seller_email = $_REQUEST['user_email'];
                if (empty($seller_email)) {
                    $errors['user_email'] = $lang['USER_EMAIL_REQ'];
                } else {
                    $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
                    if (!preg_match($regex, $seller_email)) {
                        $errors['user_email'] = $lang['USER_EMAIL'] . " : " . $lang['EMAILINV'];
                    }
                }

                $user_count = check_account_exists($seller_email);
                if ($user_count > 0) {
                    $info = ORM::for_table($config['db']['pre'] . 'user')
                        ->where('email', $seller_email)
                        ->find_one();
                    $errors['email-exist'] = $lang['ACCAEXIST'];
                }
            } else {
                $errors['user_email'] = $lang['USER_EMAIL_REQ'];
            }
        }
        $urgent = isset($_REQUEST['urgent']) ? 1 : 0;
        $featured = isset($_REQUEST['featured']) ? 1 : 0;
        $highlight = isset($_REQUEST['highlight']) ? 1 : 0;

        $company_logo = null;

        $job_image = null;
        if ($config['job_image_field']) {
            if (!count($errors) > 0) {
                if (isset($_FILES['job_image'])) {
                    $file = $_FILES['job_image'];
                    $valid_formats = array("jpg", "jpeg", "png"); // Valid image formats
                    $filename = $file['name'];
                    $ext = getExtension($filename);
                    $ext = strtolower($ext);
                    if (!empty($filename)) {
                        //File extension check
                        if (in_array($ext, $valid_formats)) {
                            //Valid File extension check
                            $main_path = ROOTPATH . "/storage/products/";
                            $filename = uniqid(time()) . '.' . $ext;
                            move_uploaded_file($file['tmp_name'], $main_path . $filename);
                            // resize image
                            resizeImage(200, $main_path . $filename, $main_path . $filename);
                            $job_image = $filename;
                        } else {
                            $errors['job_image'] = $lang['ONLY_JPG_ALLOW'];
                        }
                    }
                }
            }
        }

        if (!count($errors) > 0) {
            if (!$loggedin) {
                $seller_name = $_REQUEST['user_name'];
                $seller_email = $_REQUEST['user_email'];
                /*Create user account with givern email id*/
                $created_username = parse_name_from_email($seller_email);
                //mysql query to select field username if it's equal to the username that we check '
                $check_username = ORM::for_table($config['db']['pre'] . 'user')
                    ->select('username')
                    ->where('username', $created_username)
                    ->count();

                //if number of rows fields is bigger them 0 that means it's NOT available '
                if ($check_username > 0) {
                    $username = createusernameslug($created_username);
                } else {
                    $username = $created_username;
                }
                $location = getLocationInfoByIp();
                $confirm_id = get_random_id();
                $password = get_random_id();
                $pass_hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 13]);
                $now = date("Y-m-d H:i:s");

                $insert_user = ORM::for_table($config['db']['pre'] . 'user')->create();
                $insert_user->status = '0';
                $insert_user->name = $seller_name;
                $insert_user->username = $username;
                $insert_user->password_hash = $pass_hash;
                $insert_user->email = $seller_email;
                $insert_user->confirm = $confirm_id;
                $insert_user->user_type = 'employer';
                $insert_user->created_at = $now;
                $insert_user->updated_at = $now;
                $insert_user->country = $location['country'];
                $insert_user->city = $location['city'];
                $insert_user->save();

                $user_id = $insert_user->id();

                /*CREATE ACCOUNT CONFIRMATION EMAIL*/
                email_template("signup_confirm", $user_id);

                /*SEND ACCOUNT DETAILS EMAIL*/
                email_template("signup_details", $user_id, $password);

                $loggedin = userlogin($username, $password);
                if ($loggedin) {
                    $auth_token = add_firebase_device_token($loggedin['id']);
                    $valid_auth_token =   $auth_token;
                }
            }

            if (isset($_REQUEST['location']) && $_REQUEST['location'] != "") {
                $emp_address = $_REQUEST['location'];
            } else {
                $user_data = get_user_data(null, $user_id);
                $emp_address = $user_data['address'];
            }
            $address = explode(",", $emp_address);
            $get_user_city_code = ORM::for_table($config['db']['pre'] . 'cities')
                ->where_raw('`asciiname` LIKE "%' . $address[0] . '%"')
                ->find_one();
            if (!empty($get_user_city_code) && $get_user_city_code['id'] != "") {
                $city_id = $get_user_city_code['id'];
                $country_code = $get_user_city_code['country_code'];
            } else {
                $city_id = "";
                $country_code = "";
            }
            if ($loggedin) {
                $salary_type = $_REQUEST['salary_type'];
                $salary_min = !empty($_REQUEST['salary_min']) ? $_REQUEST['salary_min'] : '0';
                $salary_max = !empty($_REQUEST['salary_max']) ? $_REQUEST['salary_max'] : '0';
                $phone = !empty($_REQUEST['phone']) ? $_REQUEST['phone'] : '0';
                $negotiable = isset($_REQUEST['negotiable']) ? '1' : '0';
                $hide_phone = isset($_REQUEST['hide_phone']) ? '1' : '0';
                $private = isset($_REQUEST['private']) ? '1' : '0';
                $cityid = $city_id;
                if ($config['post_desc_editor'] == 1)
                    $description = addslashes($_REQUEST['content']);
                else
                    $description = validate_input($_REQUEST['content']);
                $citydata = get_cityDetail_by_id($cityid);
                $country = $citydata['country_code'];
                $state = $citydata['subadmin1_code'];

                $latlong = '';
                if (isset($_REQUEST['location'])) {
                    $location = $_REQUEST['location'];
                    $mapLat = $_REQUEST['latitude'];
                    $mapLong = $_REQUEST['longitude'];
                    $latlong = $mapLat . "," . $mapLong;
                } else {
                    $location = '';
                }
                $post_title = removeEmailAndPhoneFromString($_REQUEST['title']);
                // Get usergroup details
                $group_id = get_user_group($user_id);
                // Get membership details
                $group_get_info = get_usergroup_settings($group_id);
                $slug = create_post_slug($post_title);

                if (isset($_REQUEST['tags'])) {
                    $tags = $_REQUEST['tags'];
                } else {
                    $tags = '';
                }

                if ($config['post_auto_approve'] == 1) {
                    $status = "active";
                } else {
                    $status = "pending";
                }
                $urgent_project_fee = $group_get_info['urgent_project_fee'];
                $featured_project_fee = $group_get_info['featured_project_fee'];
                $highlight_project_fee = $group_get_info['highlight_project_fee'];

                $ad_duration = $group_get_info['ad_duration'];
                $timenow = date('Y-m-d H:i:s');
                $expire_time = date('Y-m-d H:i:s', strtotime($timenow . ' +' . $ad_duration . ' day'));
                $expire_timestamp = strtotime($expire_time);

                $company_id = 0;
                $item_insrt = ORM::for_table($config['db']['pre'] . 'product')->create();
                $item_insrt->user_id = $user_id;
                $item_insrt->company_id = $company_id;
                $item_insrt->product_name = $post_title;
                $item_insrt->slug = $slug;
                $item_insrt->status = $status;
                $item_insrt->description = $description;
                $item_insrt->product_type = $_REQUEST['job_type'];
                $item_insrt->salary_min = $salary_min;
                $item_insrt->salary_max = $salary_max;
                $item_insrt->salary_type = $salary_type;
                $item_insrt->negotiable = $negotiable;
                $item_insrt->phone = $phone;
                $item_insrt->hide_phone = $hide_phone;
                $item_insrt->application_url = $_REQUEST['application_url'];
                $item_insrt->location = $location;
                $item_insrt->city = $city_id;
                $item_insrt->state = $state;
                $item_insrt->country = $country;
                $item_insrt->latlong = $latlong;
                $item_insrt->screen_shot = $job_image;
                $item_insrt->tag = $tags;
                $item_insrt->created_at = $timenow;
                $item_insrt->updated_at = $timenow;
                $item_insrt->expire_date = $expire_timestamp;
                $item_insrt->private = $private;

                $item_insrt->save();

                $customer_id = $user_id;
                $product_id = $item_insrt->id();
                save_post_customField_data($custom_fields, $product_id);
                $all_sub_category = json_decode($_REQUEST['subcatid']);
                foreach ($all_sub_category as $sub_res) {
                    $category = ORM::for_table($config['db']['pre'] . 'catagory_sub')->where('sub_cat_id', $sub_res)->find_one();
                    if (!empty($category)) {
                        $item_insrt = ORM::for_table($config['db']['pre'] . 'product_category')->create();
                        $item_insrt->job_id = $product_id;
                        $item_insrt->cat_id = $category['main_cat_id'];
                        $item_insrt->subcat_id = $sub_res;
                        $item_insrt->save();
                    }
                }
                send_job_notification($city_id, $customer_id, $product_id);
                $amount = 0;
                $trans_desc = $lang['PACKAGE'];
                if ($featured == 1) {
                    $amount = $featured_project_fee;
                    $trans_desc = $trans_desc . " " . $lang['FEATURED'];
                }
                if ($urgent == 1) {
                    $amount = $amount + $urgent_project_fee;
                    $trans_desc = $trans_desc . " " . $lang['URGENT'];
                }
                if ($highlight == 1) {
                    $amount = $amount + $highlight_project_fee;
                    $trans_desc = $trans_desc . " " . $lang['HIGHLIGHT'];
                }
                if ($amount > 0) {

                    $access_token = uniqid();
                    $response['title'] = $post_title;
                    $response['payment_type'] = "premium";
                    $response['access_token'] = $access_token;
                    $response['ad_type'] = "package";
                }
                $status_code = HTTP_OK;
                $status = $lang['SUCCESS'];
                $message = $lang['JOB_SAVED'];
            } else {
                $status_code = HTTP_UNAUTHORIZED;
                $status = $lang['ERROR'];
                $message = $lang['ERROR'];
            }
        } else {
            $status_code = HTTP_UNAUTHORIZED;
            $status = $lang['ERROR'];
            $message = $lang['ERROR'];
        }
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, "errors" => $errors, 'auth_token' => $valid_auth_token, 'premium_detail' => $response];
    send_json($results);
    die();
}

function edit_post()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = array();
    $response = array();
    $loggedin = false;
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $loggedin = true;
        if (!check_valid_author($_REQUEST['product_id'], $user_id)) {
            $errors['invalid_user'] = $lang['INVALID_USER'];
        }
        $status = check_item_status($_REQUEST['product_id']);
        if ($status == "active" or $status == "softreject" or $status == "hide" or $status == "expire") {
            if (!check_valid_resubmission($_REQUEST['product_id'], $user_id)) {
                $errors['resubmit_error'] =  $lang['RESUMIT_EXIST_TEXT'];
            }
        }

        if (empty($_REQUEST['subcatid'])) {
            $errors['subcatid'] = $lang['SUBCAT_REQ'];
        }
        if (empty($_REQUEST['title'])) {
            $errors['title'] = $lang['JOB_TITLE_REQ'];
        }
        if (empty($_REQUEST['content'])) {
            $errors['content'] = $lang['DESC_REQ'];
        }
        if (empty($_REQUEST['content'])) {
            $errors['content'] = $lang['JOB_TYPE_REQ'];
        }
        if (!empty($_REQUEST['salary_min']) or !empty($_REQUEST['salary_max'])) {
            if (!is_numeric($_REQUEST['salary_min']) or !is_numeric($_REQUEST['salary_max'])) {
                $errors['salary'] = $lang['SALARY_MUST_NO'];
            }
        }
        if (!empty($_REQUEST['application_url'])) {
            if (filter_var($_REQUEST['application_url'], FILTER_VALIDATE_URL) === FALSE) {
                $errors['application_url'] = $lang['APPLICATION_URL_INVALID'];
            }
        }
        if (isset($_POST['comments']) && empty($_POST['comments'])) {
            $errors[]['message'] = $lang['COMMENT_PLACEHOLDER'];
        }

        /*IF : USER GO TO PEMIUM POST*/
        $urgent = isset($_POST['urgent']) ? 1 : 0;
        $featured = isset($_POST['featured']) ? 1 : 0;
        $highlight = isset($_POST['highlight']) ? 1 : 0;

        $company_logo = null;
        $additionalinfo = isset($_REQUEST['additionalinfo']) ? $_REQUEST['additionalinfo'] : null;
        $custom_fields = array();
        if ($additionalinfo != null) {
            $custom_fields = json_decode($additionalinfo, true);
        }

        $job_image = null;
        if ($config['job_image_field']) {
            if (!count($errors) > 0) {
                if (isset($_FILES['job_image'])) {
                    $file = $_FILES['job_image'];
                    $valid_formats = array("jpg", "jpeg", "png"); // Valid image formats
                    $filename = $file['name'];
                    $ext = getExtension($filename);
                    $ext = strtolower($ext);
                    if (!empty($filename)) {
                        //File extension check
                        if (in_array($ext, $valid_formats)) {
                            //Valid File extension check
                            $main_path = ROOTPATH . "/storage/products/";
                            $filename = uniqid(time()) . '.' . $ext;
                            move_uploaded_file($file['tmp_name'], $main_path . $filename);
                            // resize image
                            resizeImage(200, $main_path . $filename, $main_path . $filename);
                            $job_image = $filename;
                        } else {
                            $errors[]['message'] = $lang['ONLY_JPG_ALLOW'];
                        }
                    }
                }
            }
        }
        if (!count($errors) > 0) {
            if ($loggedin) {
                $salary_type = $_REQUEST['salary_type'];
                $salary_min = !empty($_REQUEST['salary_min']) ? $_REQUEST['salary_min'] : '0';
                $salary_max = !empty($_REQUEST['salary_max']) ? $_REQUEST['salary_max'] : '0';
                $phone = !empty($_REQUEST['phone']) ? $_REQUEST['phone'] : '0';
                $negotiable = isset($_REQUEST['negotiable']) ? '1' : '0';
                $hide_phone = isset($_REQUEST['hide_phone']) ? '1' : '0';
                $private = isset($_REQUEST['private']) ? '1' : '0';

                if (isset($_REQUEST['location']) && $_REQUEST['location'] != "") {
                    $emp_address = $_REQUEST['location'];
                } else {
                    $user_data = get_user_data(null, $user_id);
                    $emp_address = $user_data['address'];
                }
                $address = explode(",", $emp_address);
                $get_user_city_code = ORM::for_table($config['db']['pre'] . 'cities')
                    ->where_raw('`asciiname` LIKE "%' . $address[0] . '%"')
                    ->find_one();
                if (!empty($get_user_city_code) && $get_user_city_code['id'] != "") {
                    $city_id = $get_user_city_code['id'];
                    $country_code = $get_user_city_code['country_code'];
                } else {
                    $city_id = "";
                    $country_code = "";
                }

                $cityid = $city_id;
                if ($config['post_desc_editor'] == 1)
                    $description = addslashes($_REQUEST['content']);
                else
                    $description = validate_input($_REQUEST['content']);

                $timenow = date('Y-m-d H:i:s');
                $country = $state = "";
                $citydata = get_cityDetail_by_id($cityid);
                if (!empty($citydata)) {
                    $country = $citydata['country_code'];
                    $state = $citydata['subadmin1_code'];
                }

                $latlong = '';
                if (isset($_REQUEST['location'])) {
                    $location = $_REQUEST['location'];
                    $mapLat = $_REQUEST['latitude'];
                    $mapLong = $_REQUEST['longitude'];
                    $latlong = $mapLat . "," . $mapLong;
                } else {
                    $location = '';
                }
                $post_title = removeEmailAndPhoneFromString($_REQUEST['title']);
                // Get usergroup details
                $group_id = get_user_group($user_id);
                // Get membership details
                $group_get_info = get_usergroup_settings($group_id);
                $slug = create_post_slug($post_title);
                if (isset($_REQUEST['tags'])) {
                    $tags = $_REQUEST['tags'];
                } else {
                    $tags = '';
                }
                $info = ORM::for_table($config['db']['pre'] . 'product')->select('status')->find_one($_REQUEST['product_id']);
                $item_status = $info['status'];

                $company_id = 0;
                if ($item_status == "pending" or $config['post_auto_approve'] == 1) {
                    $item_edit = ORM::for_table($config['db']['pre'] . 'product')->find_one($_POST['product_id']);
                    $item_edit->set('company_id', $company_id);
                    $item_edit->set('product_name', $post_title);
                    $item_edit->set('slug', $slug);
                    $item_edit->set('description', $description);
                    $item_edit->set('product_type', $_REQUEST['job_type']);
                    $item_edit->set('negotiable', $negotiable);
                    $item_edit->set('salary_min', $salary_min);
                    $item_edit->set('salary_max', $salary_max);
                    $item_edit->set('salary_type', $salary_type);
                    $item_edit->set('phone', $phone);
                    $item_edit->set('hide_phone', $hide_phone);
                    $item_edit->set('private', $private);
                    $item_edit->set('application_url', $_REQUEST['application_url']);
                    $item_edit->set('location', $location);
                    $item_edit->set('city', $cityid);
                    $item_edit->set('state', $state);
                    $item_edit->set('country', $country);
                    $item_edit->set('latlong', $latlong);
                    $item_edit->set('tag', $tags);
                    $item_edit->set('screen_shot', $job_image);
                    $item_edit->set('updated_at', $timenow);
                    $item_edit->save();

                    $all_sub_category = json_decode($_REQUEST['subcatid']);

                    ORM::for_table($config['db']['pre'] . 'product_category')
                        ->where(array(
                            'job_id' => $_POST['product_id'],
                        ))
                        ->delete_many();

                    foreach ($all_sub_category as $sub_res) {
                        $category = ORM::for_table($config['db']['pre'] . 'catagory_sub')->where('sub_cat_id', $sub_res)->find_one();
                        if (!empty($category)) {
                            $item_insrt = ORM::for_table($config['db']['pre'] . 'product_category')->create();
                            $item_insrt->job_id = $_POST['product_id'];
                            $item_insrt->cat_id = $category['main_cat_id'];
                            $item_insrt->subcat_id = $sub_res;
                            $item_insrt->save();
                        }
                    }
                } elseif ($item_status == "active" or $item_status == "softreject" or $item_status == "expire") {
                    $item_insrt = ORM::for_table($config['db']['pre'] . 'product_resubmit')->create();
                    $item_insrt->product_id = $_REQUEST['product_id'];
                    $item_insrt->user_id = $user_id;
                    $item_insrt->company_id = $company_id;
                    $item_insrt->product_name = $post_title;
                    $item_insrt->description = $description;
                    $item_insrt->product_type = $_REQUEST['job_type'];
                    $item_insrt->salary_min = $salary_min;
                    $item_insrt->salary_max = $salary_max;
                    $item_insrt->salary_type = $salary_type;
                    $item_insrt->negotiable = $negotiable;
                    $item_insrt->phone = $phone;
                    $item_insrt->hide_phone = $hide_phone;
                    $item_insrt->private = $private;
                    $item_insrt->application_url = $_REQUEST['application_url'];
                    $item_insrt->location = $location;
                    $item_insrt->city = $cityid;
                    $item_insrt->state = $state;
                    $item_insrt->country = $country;
                    $item_insrt->latlong = $latlong;
                    $item_insrt->tag = $tags;
                    $item_insrt->screen_shot = $job_image;
                    $item_insrt->created_at = $timenow;
                    $item_insrt->comments = validate_input($_REQUEST['comments']);
                    $item_insrt->save();
                }
                $product_id = $_REQUEST['product_id'];

                save_post_customField_data($custom_fields, $product_id);
                $status_code = HTTP_OK;
                $status = $lang['SUCCESS'];
                $message = $lang['UPDATED_SUCCESS'];
            }
        } else {
            $status_code = HTTP_UNAUTHORIZED;
            $status = $lang['ERROR'];
            $message = $lang['FAILED'];
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, "errors" => $errors, 'auth_token' => $valid_auth_token, 'premium_detail' => $response];
    send_json($results);
    die();
}

function remove_post()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = array();
    $response = array();
    $loggedin = false;
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $loggedin = true;
        $product_id  = (isset($_REQUEST['product_id']) && !empty($_REQUEST['product_id'])) ? $_REQUEST['product_id'] : '';

        if (!empty($product_id)) {
            if (!check_valid_author($_REQUEST['product_id'], $user_id)) {
                $errors['invalid_user'] = $lang['INVALID_USER'];
            }
            if (!count($errors) > 0) {
                $info = ORM::for_table($config['db']['pre'] . 'product')->select_many('id', 'screen_shot')->where(array(
                    'id' => $product_id,
                    'user_id' => $user_id,
                ))->find_one();
                $old_image = $info['screen_shot'];
                if (!empty($info)) {
                    if ($info->delete()) {
                        if (!empty($old_image)) {
                            $file = ROOTPATH . "/storage/products/" . $old_image;
                            if (file_exists($file))
                                unlink($file);
                        }
                    } else {
                        $errors['delete_error'] = $lang['SOMETHING_WENT_WRONG'];
                    }
                } else {
                    $errors['product_id'] = $lang['NOT_FOUND'];
                }
            }
        } else {
            $errors['product_id'] = $lang['INVALID_ID'];
        }
        if (count($errors) > 0) {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['FAILED'];
        } else {
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['DELETED'];
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, "errors" => $errors, 'auth_token' => $valid_auth_token, 'premium_detail' => $response];
    send_json($results);
    die();
}
/*
Search Post
action = search_post
1. page
2. order
3. limit
4. keywords
5. cat
6. subcat
7. placetype
8. placeid
9. range1 (price min)
10. range2 (price max)
11. custom (array for custom values)

Messages
1. array
*/

function search_post()
{
    global $config, $lang, $results;
    $pdo = ORM::getDb();
    $mysqli = db_connect();
    $category = "";
    $subcat = "";
    $total = $total_map_records = 0;
    $where = '';
    $order_by_keyword = '';

    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
    } else {
        $user_id = "";
    }

    $page_number = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $order = isset($_REQUEST['order']) && ($_REQUEST['order'] != "") ? $_REQUEST['order'] : "DESC";
    $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 10;
    $filter = isset($_REQUEST['filter']) ? $_REQUEST['filter'] : "";
    $sorting = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : "Newest";
    $budget = isset($_REQUEST['budget']) ? $_REQUEST['budget'] : "";
    $keywords = isset($_REQUEST['keywords']) ? str_replace("-", " ", trim($_REQUEST['keywords'])) : "";
    $city = isset($_REQUEST['city']) && ($_REQUEST['city'] != "") ? $_REQUEST['city'] : "";
    $country_code = isset($_REQUEST['country_code']) ? $_REQUEST['country_code'] : null;
    $state_code = isset($_REQUEST['state']) ? $_REQUEST['state'] : null;

    if (!isset($_REQUEST['sort']))
        $sort = "id";
    elseif ($_REQUEST['sort'] == "title")
        $sort = "product_name";
    elseif ($_REQUEST['sort'] == "price")
        $sort = "price";
    elseif ($_REQUEST['sort'] == "date")
        $sort = "created_at";
    else
        $sort = "id";

    if (isset($_REQUEST['subcategory_id']) && !empty($_REQUEST['subcategory_id'])) {
        if (is_numeric($_REQUEST['subcategory_id'])) {
            if (check_sub_category_exists($_REQUEST['subcategory_id'])) {
                $subcat = $_REQUEST['subcategory_id'];
            }
        }
    }
    if (isset($_REQUEST['category_id']) && !empty($_REQUEST['category_id'])) {
        if (is_numeric($_REQUEST['category_id'])) {
            if (check_category_exists($_REQUEST['category_id'])) {
                $category = $_REQUEST['category_id'];
            }
        }
    }
    if (isset($_REQUEST['keywords']) && !empty($_REQUEST['keywords'])) {

        $where .= "AND (p.product_name LIKE '%$keywords%' or p.tag LIKE '%$keywords%') ";
        $order_by_keyword = "(CASE
            WHEN p.product_name = '$keywords' THEN 1
            WHEN p.product_name LIKE '$keywords%' THEN 2
            WHEN p.product_name LIKE '%$keywords%' THEN 3
            WHEN p.tag = '$keywords' THEN 4
            WHEN p.tag LIKE '$keywords%' THEN 5
            WHEN p.tag LIKE '%$keywords%' THEN 6
            ELSE 7
        END),";
    }

    if (isset($category) && !empty($category)) {
        $where .= "AND (exists(SELECT p_cat.id FROM `" . $config['db']['pre'] . "product_category` as p_cat WHERE cat_id='" . $category . "' and job_id = p.id))";
    }

    if (isset($subcat) && !empty($subcat)) {
        $where .= "AND (exists(SELECT p_subcat.id FROM `" . $config['db']['pre'] . "product_category` as p_subcat WHERE subcat_id='" . $subcat . "' and job_id = p.id))";
    }

    if (isset($_REQUEST['range1']) && $_REQUEST['range1'] != '') {

        $range1 = str_replace('.', '', $_REQUEST['range1']);
        $range2 = str_replace('.', '', $_REQUEST['range2']);
        $where .= ' AND (p.salary_min BETWEEN ' . $range1 . ' AND ' . $range2 . ') OR (p.salary_max BETWEEN ' . $range1 . ' AND ' . $range2 . ')';
    } else {
        $range1 = "";
        $range2 = "";
    }

    if (isset($_REQUEST['search_by_suburb']) && !empty($user_id)) {
        $where .= "AND (p.city IN (SELECT city_code FROM " . $config['db']['pre'] . 'user_cities' . " WHERE user_id = $user_id ))";
    } else {
        if (isset($city) && !empty($city)) {
            $where .= "AND (p.city = '" . $city . "') ";
        } elseif (isset($_REQUEST['location']) && !empty($_REQUEST['location'])) {

            $placetype = $_REQUEST['placetype'];
            $placeid = $_REQUEST['placeid'];

            if ($placetype == "country") {
                $where .= "AND (p.country = '$placeid') ";
            } elseif ($placetype == "state") {
                $where .= "AND (p.state = '$placeid') ";
            } else {
                $where .= "AND (p.city = '$placeid') ";
            }
        } else {
            $country_code = check_user_country();
            $where .= "AND (p.country = '$country_code') ";
        }
    }

    $additionalinfo = isset($_REQUEST['custom']) ? $_REQUEST['custom'] : null;
    $custom_fields = json_decode($additionalinfo, true);
    $custom_fields = array();
    if ($additionalinfo != null) {

        $custom_fields = json_decode($additionalinfo, true);

        $whr_count = 1;
        $custom_where = "";
        $custom_join = "";
        foreach ($custom_fields as $field_id => $field_value) {
            //$field_id = $value['id'];
            // $field_type = $value['type'];
            //$field_value = $value['value'];

            if (empty($field_value)) {
                unset($custom_fields[$field_id]);
            }
            if (!empty($field_value)) {
                // custom value is not empty.

                if ($field_id != "" && $field_value != "") {
                    $c_as = "c" . $whr_count;
                    $custom_join .= " 
                    JOIN `" . $config['db']['pre'] . "custom_data` AS $c_as ON $c_as.product_id = p.id AND `$c_as`.`field_id` = '$field_id' ";

                    if (is_array($field_value)) {
                        $custom_where = " AND ( ";
                        $cond_count = 0;
                        foreach ($field_value as $val) {
                            if ($cond_count == 0) {
                                $custom_where .= " find_in_set('$val',$c_as.field_data) <> 0 ";
                            } else {
                                $custom_where .= " AND find_in_set('$val',$c_as.field_data) <> 0 ";
                            }
                            $cond_count++;
                        }
                        $custom_where .= " )";
                    } else {
                        $custom_where .= " AND `$c_as`.`field_data` = '$field_value' ";
                    }

                    $whr_count++;
                }
            }
        }
        if ($custom_where != "")
            $where .= $custom_where;

        if ($additionalinfo != null) {
            $sql = "SELECT DISTINCT p.*
                FROM `" . $config['db']['pre'] . "product` AS p
                $custom_join
                WHERE p.status = 'active' AND p.hide = '0' ";
        } else {
            $sql = "SELECT DISTINCT p.*
                FROM `" . $config['db']['pre'] . "product` AS p
                WHERE p.status = 'active' AND p.hide = '0' ";
        }

        $q = "$sql $where";
        $query = $pdo->query($q);
        $totalWithoutFilter = $query->rowCount();
    } else {
        $q = "SELECT 1 FROM " . $config['db']['pre'] . "product as p where status = 'active' $where";
        $query = $pdo->query($q);
        $totalWithoutFilter = $query->rowCount();
    }

    if (isset($_REQUEST['filter'])) {
        if ($_REQUEST['filter'] == 'free') {
            $where .= "AND (p.urgent='0' AND p.featured='0' AND p.highlight='0') ";
        } elseif ($_REQUEST['filter'] == 'featured') {
            $where .= "AND (p.featured='1') ";
        } elseif ($_REQUEST['filter'] == 'urgent') {
            $where .= "AND (p.urgent='1') ";
        } elseif ($_REQUEST['filter'] == 'highlight') {
            $where .= "AND (p.highlight='1') ";
        }
    }

    $order_by = "
      (CASE
        WHEN g.top_search_result = 'yes' and p.featured = '1' and p.urgent = '1' and p.highlight = '1' THEN 1
        WHEN g.top_search_result = 'yes' and p.urgent = '1' and p.featured = '1' THEN 2
        WHEN g.top_search_result = 'yes' and p.urgent = '1' and p.highlight = '1' THEN 3
        WHEN g.top_search_result = 'yes' and p.featured = '1' and p.highlight = '1' THEN 4
        WHEN g.top_search_result = 'yes' and p.urgent = '1' THEN 5
        WHEN g.top_search_result = 'yes' and p.featured = '1' THEN 6
        WHEN g.top_search_result = 'yes' and p.highlight = '1' THEN 7
        WHEN g.top_search_result = 'yes' THEN 8
        WHEN p.featured = '1' and p.urgent = '1' and p.highlight = '1' THEN 9
        WHEN p.urgent = '1' and p.featured = '1' THEN 10
        WHEN p.urgent = '1' and p.highlight = '1' THEN 11
        WHEN p.featured = '1' and p.highlight = '1' THEN 12
        WHEN p.urgent = '1' THEN 13
        WHEN p.featured = '1' THEN 14
        WHEN p.highlight = '1' THEN 15
        ELSE 16
      END)," . $order_by_keyword . " $sort $order";

    if ($additionalinfo != null) {


        if ($additionalinfo != null) {
            $sql = "SELECT DISTINCT p.*,  c.name company_name, c.logo company_image
        FROM `" . $config['db']['pre'] . "product` AS p
        LEFT JOIN `" . $config['db']['pre'] . "companies` c on p.company_id = c.id
        $custom_join
        WHERE p.status = 'active' AND p.hide = '0' AND p.private = '0' ";
        } else {
            $sql = "SELECT DISTINCT p.*, c.name company_name, c.logo company_image
        FROM `" . $config['db']['pre'] . "product` AS p
        LEFT JOIN `" . $config['db']['pre'] . "companies` c on p.company_id = c.id
        WHERE p.status = 'active' AND p.hide = '0' AND p.private = '0'";
        }

        $query =  $sql . " $where ORDER BY $sort $order LIMIT " . ($page_number - 1) * $limit . ",$limit";

        $total = mysqli_num_rows(mysqli_query($mysqli, "$sql $where"));
        $featuredAds = mysqli_num_rows(mysqli_query($mysqli, "$sql and (p.featured='1') $where"));
        $urgentAds = mysqli_num_rows(mysqli_query($mysqli, "$sql and (p.urgent='1') $where"));
        $map_query = $sql . " $where ORDER BY $sort $order ";
    } else {
        $total = mysqli_num_rows(mysqli_query($mysqli, "SELECT 1 FROM " . $config['db']['pre'] . "product as p where status = 'active' AND private=0  $where"));
        $featuredAds = mysqli_num_rows(mysqli_query($mysqli, "SELECT 1 FROM " . $config['db']['pre'] . "product as p where status = 'active' and featured='1' $where"));
        $urgentAds = mysqli_num_rows(mysqli_query($mysqli, "SELECT 1 FROM " . $config['db']['pre'] . "product as p where status = 'active' and urgent='1' $where"));

        $query = "SELECT p.*,u.group_id,g.top_search_result, c.name company_name, c.logo company_image FROM `" . $config['db']['pre'] . "product` as p
        LEFT JOIN `" . $config['db']['pre'] . "companies` c on p.company_id = c.id 
        LEFT JOIN `" . $config['db']['pre'] . "user` as u ON u.id = p.user_id
        LEFT JOIN `" . $config['db']['pre'] . "usergroups` as g ON g.group_id = u.group_id
        where p.status = 'active' AND p.hide = '0' AND p.private = '0' $where ORDER BY $order_by ";

        if ($limit != "" || $limit != 0) {
            $query .= "LIMIT " . ($page_number - 1) * $limit . "," . $limit;
        }

        $map_query = "SELECT p.*,u.group_id,g.top_search_result, c.name company_name, c.logo company_image, (SELECT AVG(rating) from job_product_reviews where productID=p.id) as product_rating FROM `" . $config['db']['pre'] . "product` as p
        LEFT JOIN `" . $config['db']['pre'] . "companies` c on p.company_id = c.id 
        LEFT JOIN `" . $config['db']['pre'] . "user` as u ON u.id = p.user_id
        LEFT JOIN `" . $config['db']['pre'] . "usergroups` as g ON g.group_id = u.group_id
        LEFT JOIN `" . $config['db']['pre'] . "product_category` as pc ON pc.job_id = p.id
        where p.status = 'active' AND p.hide = '0' AND p.private = '0' $where ORDER BY product_rating DESC, $order_by ";
    }

    $map_data = [];

    $data_map = $mysqli->query($map_query);
    if (mysqli_num_rows($data_map) > 0) {
        // output data of each row
        while ($info = mysqli_fetch_assoc($data_map)) {
            $map_data[$info['id']]['id'] = $info['id'];
            $map_data[$info['id']]['product_name'] = $info['product_name'];
            $map_data[$info['id']]['company_image_link'] = !empty($info['company_image']) ? ($config['site_url'] . 'storage/products/' . $info['company_image']) : $config['site_url'] . 'storage/products/default.png';
            if ($info['company_name'] != "") {
                $map_data[$info['id']]['company_name'] = $info['company_name'];
            } else {
                $userinfo = get_user_data("", $info['user_id']);
                if (!empty($userinfo)) {
                    $map_data[$info['id']]['company_name'] = $userinfo['username'];
                }
            }
            $pro_url = create_slug($info['product_name']);
            // make latlon array [lat, long]
            $cordinates = explode(',', $info['latlong']);
            $map_data[$info['id']]['link'] = $config['site_url'] . 'job/' . $info['id'] . '/' . $pro_url;
            // for lat
            $map_data[$info['id']]['latitude'] = ($cordinates[0] - 0.008846);
            // for long
            $map_data[$info['id']]['longitude'] = ($cordinates[1] + 0.008194);
        }
    }
    $total_map_records = count($map_data);

    $count = 0;
    $noresult_id = "";

    $favourite = false;
    //Loop for list view
    $item = array();
    $posts = array();
    $result = $pdo->query($query);
    $row_count = $result->rowCount();
    if ($row_count > 0) {
        // output data of each row
        foreach ($result as $info) {
            $item['id'] = $info['id'];
            $item['product_name'] = $info['product_name'];
            $item['featured'] = $info['featured'];
            $item['urgent'] = $info['urgent'];
            $item['highlight'] = $info['highlight'];
            $item['highlight_bgClr'] = ($info['highlight'] == 1) ? "highlight-premium-ad" : "";

            $cityname = get_cityName_by_id($info['city']);
            $item['location'] = $cityname;
            $item['city'] = $cityname;
            $item['status'] = $info['status'];
            $item['hide'] = $info['hide'];

            $item['created_at'] = timeAgo($info['created_at']);
            $expire_date_timestamp = $info['expire_date'];
            $expire_date = date('d-M-y', $expire_date_timestamp);
            $item['expire_date'] = $expire_date;

            $item['cat_id'] = $info['category'];
            $item['sub_cat_id'] = $info['sub_category'];
            $get_main = get_maincat_by_id($info['category']);
            $get_sub = get_subcat_by_id($info['sub_category']);
            $cate_data = get_job_category_and_subcategory($info['id']);
            $item['category'] = array_values($cate_data['categories']);
            $item['sub_category'] = array_values($cate_data['subcategories']);
            if (!empty($user_id)) {
                $favourite =  check_product_favorite($info['id'], $user_id);
            }
            $item['favorite'] = $favourite;

            if ($info['tag'] != '') {
                $item['showtag'] = "1";
                $item['tag'] = $info['tag'];
            } else {
                $item['tag'] = "";
                $item['showtag'] = "0";
            }

            $picture = explode(',', $info['screen_shot']);
            $item['pic_count'] = count($picture);

            if ($picture[0] != "") {
                $item['picture'] = $config['site_url'] . "storage/products/thumb/" . $picture[0];
            } else {
                $item['picture'] = $config['site_url'] . "storage/products/thumb/default.png";
            }

            $currency = set_user_currency($info['country']);
            $item['price'] = !empty($info['price']) ? $info['price'] : null;
            $item['currency'] = $currency['html_entity'];
            $item['currency_in_left'] = $currency['in_left'];


            $userinfo = get_user_data("", $info['user_id']);
            if (!empty($userinfo)) {
                $item['username'] = $userinfo['username'];
                $item['user_id'] = $userinfo['id'];
            }

            if (check_user_upgrades($info['user_id'])) {
                $sub_info = get_user_membership_detail($info['user_id']);
                $item['subcription_title'] = $sub_info['sub_title'];
                $item['subcription_image'] = $sub_info['sub_image'];
            } else {
                $item['subcription_title'] = '';
                $item['subcription_image'] = '';
            }
            if (!empty($info['latlong'])) {
                // make latlon array [lat, long]
                $cordinates = explode(',', $info['latlong']);
                // for lat
                $item['latitude'] = ($cordinates[0] - 0.008846);
                // for long
                $item['longitude'] = ($cordinates[1] + 0.008194);
            } else {
                $item['latitude'] = "";
                $item['longitude'] = "";
            }
            $item['product_type'] = get_productType_title_by_id($info['product_type']);

            $posts[] = $item;
        }
        if (empty($posts)) {
            $status_code = HTTP_UNAUTHORIZED;
            $status = $lang['ERROR'];
            $message = $lang['NOT_FOUND'];
        } else {
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['SUCCESS'];
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['NOT_FOUND'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'total' => $total, 'jobs' => $posts, 'total_map_data' => $total_map_records, 'map_data' => array_values($map_data), 'auth_token' => $valid_auth_token];
    send_json($results);
    die();
}

function hide_post()
{
    global $config, $lang, $results;
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $id = isset($_REQUEST['job_id']) && ($_REQUEST['job_id'] != "") ? trim($_REQUEST['job_id']) : "0";
        $info = ORM::for_table($config['db']['pre'] . 'product')->select_many('id', 'hide')->find_one($id);
        //print_r( $info);
        if (!empty($info)) {
            $status = $info['hide'];
            if ($status == "0") {
                $info->hide = "1";
                $message = 'Job is hide';
            } else {
                $info->hide = "0";
                $message = 'Job is visible';
            }
            $info->save();
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['NOT_FOUND'];
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token];
    send_json($results);
    die();
}

function search_seeker()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $users = [];
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
    } else {
        $user_id = "";
    }
    $pdo = ORM::getDb();
    $mysqli = db_connect();
    $category = $subcat = $gender = $range1 = $range2 = $age_range1 = $age_range2 = $languages = $interests = $religions = $cultural_backgrounds = $skills = $immunisation = "";
    $total = 0;
    $where = '';
    if (!$config['job_seeker_enable']) {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['PAGE_NOT_FOUND'];
    } else {
        $page_number = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 10;

        $keywords = isset($_REQUEST['keywords']) ? str_replace("-", " ", trim($_REQUEST['keywords'])) : "";
        $city = isset($_REQUEST['city']) && ($_REQUEST['city'] != "") ? $_REQUEST['city'] : "";
        $country_code = isset($_REQUEST['country_code']) ? $_REQUEST['country_code'] : null;
        $state_code = isset($_REQUEST['state']) ? $_REQUEST['state'] : null;
        if (isset($_REQUEST['subcat']) && !empty($_REQUEST['subcat'])) {

            if (check_sub_category_exists($_REQUEST['subcat'])) {
                $subcat = $_REQUEST['subcat'];
            }
        } elseif (isset($_REQUEST['cat']) && !empty($_REQUEST['cat'])) {
            if (check_category_exists($_GET['cat'])) {
                $category = $_REQUEST['cat'];
            }
        }
        if (isset($_REQUEST['city']) && !empty($_REQUEST['city'])) {
            $city = $_REQUEST['city'];
        } else {
            $city = "";
        }
        $total = 0;
        $where = '';
        $order_by = 'u.id DESC';
        if (isset($_REQUEST['keywords']) && !empty($_REQUEST['keywords'])) {
            $where .= "AND (u.name LIKE '%$keywords%' or u.tagline LIKE '%$keywords%' or u.description LIKE '%$keywords%') ";
            $order_by = "(CASE
            WHEN u.name = '$keywords' THEN 1
            WHEN u.name LIKE '$keywords%' THEN 2
            WHEN u.name LIKE '%$keywords%' THEN 3
            WHEN u.tagline = '$keywords' THEN 4
            WHEN u.tagline LIKE '$keywords%' THEN 5
            WHEN u.tagline LIKE '%$keywords%' THEN 6
            WHEN u.description LIKE '$keywords%' THEN 7
            WHEN u.description LIKE '%$keywords%' THEN 8
            ELSE 9
          END)";
        }
        if (isset($category) && !empty($category)) {
            $where .= "AND (exists(SELECT category FROM `" . $config['db']['pre'] . "user_main_category` WHERE category_id='" . $category . "' and user_id = u.id))";
        }

        if (isset($subcat) && !empty($subcat)) {
            $where .= "AND (exists(SELECT category FROM `" . $config['db']['pre'] . "user_sub_category` WHERE subcategory_id='" . $_REQUEST['subcat'] . "' and user_id = u.id))";
        }

        if (!empty($_REQUEST['range1'])) {
            $range1 = str_replace('.', '', $_REQUEST['range1']);
            $range2 = str_replace('.', '', $_REQUEST['range2']);
            $where .= 'AND (u.salary_min BETWEEN ' . $range1 . ' AND ' . $range2 . ') OR (u.salary_max BETWEEN ' . $range1 . ' AND ' . $range2 . ')';
        }

        if (!empty($_REQUEST['age_range1'])) {
            $age_range1 = $_REQUEST['age_range1'];
            $age_range2 = $_REQUEST['age_range2'];
            $where .= ' AND (DATEDIFF(CURRENT_DATE, u.dob) BETWEEN (' . $age_range1 . ' * 365.25) AND (' . $age_range2 . ' * 365.25))';
        }

        if (isset($_REQUEST['city']) && !empty($_REQUEST['city'])) {
            $where .= "AND exists(SELECT city_code FROM `" . $config['db']['pre'] . "user_cities` WHERE city_code='" . $_REQUEST['city'] . "' and user_id = u.id)";
        } elseif (isset($_REQUEST['location']) && !empty($_REQUEST['location'])) {
            $placetype = $_REQUEST['placetype'];
            $placeid = $_REQUEST['placeid'];
            if ($placetype == "country") {
                $where .= "AND (exists(SELECT country_code FROM `" . $config['db']['pre'] . "user_cities` WHERE country_code= '" . $placeid . "' and user_id = u.id) OR (u.country_code = '$placeid'))";
            } elseif ($placetype == "state") {
                $where .= "AND exists(SELECT state_code FROM `" . $config['db']['pre'] . "user_cities` WHERE state_code= $placeid and user_id = u.id)";
            } else {
                $where .= "AND exists(SELECT city_code FROM `" . $config['db']['pre'] . "user_cities` WHERE city_code= $placeid and user_id = u.id)";
            }
        } else {
            $country_code = check_user_country();
            $where .= "AND (u.country_code = '$country_code' OR u.country_code IS NULL) ";
            $order_by = "(CASE
            WHEN u.country_code = '$country_code' THEN 1
            WHEN u.country_code IS NULL THEN 2
            ELSE 3
            END)," . $order_by;
        }
        if (!empty($_REQUEST['gender'])) {
            $gender = $_REQUEST['gender'];
            $where .= "AND (u.sex = '$gender') ";
        }

        $additionalinfo = isset($_REQUEST['custom']) ? $_REQUEST['custom'] : null;
        $custom_fields = array();
        if ($additionalinfo != null) {
            $custom_fields = json_decode($additionalinfo, true);
            $whr_count = 1;
            $custom_where = "";
            $custom_join = "";
            foreach ($custom_fields as $key => $value) {
                if (empty($value)) {
                    unset($_REQUEST['custom'][$key]);
                }
                if (!empty($_REQUEST['custom'])) {
                    // custom value is not empty.
                    if ($key != "" && $value != "") {
                        $c_as = "c" . $whr_count;
                        $custom_join .= " JOIN `" . $config['db']['pre'] . "user_custom_data` AS $c_as ON $c_as.user_id = u.id AND `$c_as`.`field_id` = '$key' ";
                        if (is_array($value)) {
                            $custom_where = " AND ( ";
                            $cond_count = 0;
                            foreach ($value as $val) {
                                if ($cond_count == 0) {
                                    $custom_where .= " find_in_set('$val',$c_as.field_data) <> 0 ";
                                } else {
                                    $custom_where .= " AND find_in_set('$val',$c_as.field_data) <> 0 ";
                                }
                                $cond_count++;
                            }
                            $custom_where .= " )";
                        } else {
                            $custom_where .= " AND `$c_as`.`field_data` = '$value' ";
                        }

                        $whr_count++;
                    }
                }
            }
            if ($custom_where != "")
                $where .= $custom_where;
            if (!empty($_REQUEST['custom'])) {
                $sql = "SELECT  u.*
                        FROM `" . $config['db']['pre'] . "user` AS u
                        $custom_join
                        WHERE status = '1'";
            } else {
                $sql = "SELECT  u.*
                        FROM `" . $config['db']['pre'] . "user` AS u
                        WHERE status = '1' ";
            }
            $q = "$sql $where";
            $totalWithoutFilter = mysqli_num_rows(mysqli_query($mysqli, $q));
        } else {
            $totalWithoutFilter = mysqli_num_rows(mysqli_query($mysqli, "SELECT 1 FROM " . $config['db']['pre'] . "user as u where u.status = '1' $where"));
        }

        if (!empty($_REQUEST['languages'])) {
            $languages = implode(",", json_decode($_REQUEST['languages']));
            $where .= "AND exists(SELECT language_id FROM `" . $config['db']['pre'] . "user_languages` WHERE language_id IN ( $languages ) and user_id = u.id ) ";
        }
        if (!empty($_REQUEST['interests'])) {

            $interests =  implode(",", json_decode($_REQUEST['interests']));
            $where .= "AND exists(SELECT interest_id FROM `" . $config['db']['pre'] . "user_interests` WHERE interest_id IN ( $interests ) and user_id = u.id ) ";
        }
        if (!empty($_REQUEST['religions'])) {

            $religions = implode(",", json_decode($_REQUEST['religions']));
            $where .= "AND exists(SELECT religion_id FROM `" . $config['db']['pre'] . "user_religions` WHERE religion_id IN ( $religions ) and user_id = u.id ) ";
        }
        if (!empty($_REQUEST['cultural_backgrounds'])) {
            $cultural_backgrounds = implode(",", json_decode($_REQUEST['cultural_backgrounds']));
            $where .= "AND exists(SELECT cultural_background_id FROM `" . $config['db']['pre'] . "user_cultural_backgrounds` WHERE cultural_background_id IN ( $cultural_backgrounds ) and user_id = u.id )";
        }
        if (!empty($_REQUEST['skills'])) {
            $skills = json_decode($_REQUEST['skills']);
            $skills = "'" . implode("', '", $skills) . "'";
            $where .= "AND exists(SELECT skill FROM `" . $config['db']['pre'] . "user_skills` WHERE LOWER(skill) IN ( $skills ) and user_id = u.id ) ";
        }
        $immunisation = '';
        if (!empty($_REQUEST['immunisation'])) {
            $immunisation = $_REQUEST['immunisation'];
            $where .= "AND (SELECT is_vaccinated FROM `" . $config['db']['pre'] . "user_immunisation_info` WHERE is_vaccinated = $immunisation  and user_id = u.id ) ";
        }
    }
    $sort = "";
    if (isset($_REQUEST['custom'])) {
        $where1 = "WHERE u.status = '1' AND u.user_type = 'user' AND  u.available_to_work = '1'";
        if (!empty($_REQUEST['custom'])) {
            $sql = "SELECT u.* FROM `" . $config['db']['pre'] . "user` AS u 
            $custom_join $where1
        ";
        } else {
            $sql = "SELECT  u.* FROM `" . $config['db']['pre'] . "user` AS u $where1";
        }

        $total = mysqli_num_rows(mysqli_query($mysqli, "$sql $where"));
        $query =  $sql . " $where ORDER BY $sort $order_by LIMIT " . ($page_number - 1) * $limit . ",$limit";
        $map_query = $sql . " $where ORDER BY $sort $order_by ";
    } else {
        $total = mysqli_num_rows(mysqli_query($mysqli, "SELECT 1 FROM `" . $config['db']['pre'] . "user` u where u.status = '1' AND u.user_type = 'user'  AND  u.available_to_work = '1' $where"));

        $query = "SELECT u.*,(SELECT AVG(rating) from job_reviews where user_id=u.id) as user_rating FROM `" . $config['db']['pre'] . "user` u 
                where u.status = '1' AND u.user_type = 'user'  AND  u.available_to_work = '1'  $where ORDER BY user_rating DESC, $order_by LIMIT " . ($page_number - 1) * $limit . ",$limit";
        $map_query = "SELECT u.*,(SELECT AVG(rating) from job_reviews where user_id=u.id) as user_rating FROM `" . $config['db']['pre'] . "user` u 
        where u.status = '1' AND u.user_type = 'user'  AND  u.available_to_work = '1'  $where ";
    }
    $data_map = $mysqli->query($map_query);

    $latitude = $longitude = "";
    $map_data = [];
    $total_map_records = 0;
    if (mysqli_num_rows($data_map) > 0) {
        // output data of each row
        while ($info = mysqli_fetch_assoc($data_map)) {
            $map_data[$info['id']]['id'] = $info['id'];
            $map_data[$info['id']]['company_name'] = "";
            $username = !empty($info['name']) ? $info['name'] : $info['username'];
            $map_data[$info['id']]['company_image_link'] = !empty($info['image']) ? ($config['site_url'] . 'storage/profile/' . $info['image']) : $config['site_url'] . 'storage/products/default_user.png';
            $map_data[$info['id']]['product_name'] = $username;
            if (!empty($info['city_code'])) {
                $cordinates = find_user_location($info['city_code']);
                // Map Longitude and Latitude
                $map_longitude = !empty($cordinates) ? ($cordinates['longitude'] - 0.008846) : '';
                $map_latitude = !empty($cordinates) ? ($cordinates['latitude'] + 0.008194) : '';
                $map_data[$info['id']]['latitude'] = $map_latitude;
                $map_data[$info['id']]['longitude'] = $map_longitude;
            } else {
                $map_data[$info['id']]['latitude'] = "";
                $map_data[$info['id']]['longitude'] = "";
            }
            $map_data[$info['id']]['link'] = $config['site_url'] . 'profile/' . $username;
            $map_data[$info['id']]['color'] = "blue";
        }
    }
    $total_map_records = count($map_data);
    $count = 0;
    $noresult_id = "";
    $favourite = false;
    $item = array();
    $result = $mysqli->query($query);
    if (mysqli_num_rows($result) > 0) {
        while ($info = mysqli_fetch_assoc($result)) {
            $item[$info['id']]['id'] = $info['id'];
            $item[$info['id']]['username'] = $info['username'];
            $item[$info['id']]['name'] = !empty($info['name']) ? $info['name'] : $info['username'];
            $item[$info['id']]['description'] = !empty($info['tagline']) ? $info['tagline'] : strlimiter(strip_tags($info['description']), 200);
            $item[$info['id']]['sex'] = $info['sex'];
            $item[$info['id']]['image'] = !empty($info['image']) ? $info['image'] : 'default_user.png';

            $item[$info['id']]['category'] = $item[$info['id']]['subcategory'] = null;
            if (!empty($info['category'])) {
                $get_cat = get_maincat_by_id($info['category']);
                $item[$info['id']]['category'] = $get_cat['cat_name'];
            }
            if (!empty($info['subcategory'])) {
                $get_cat = get_subcat_by_id($info['subcategory']);
                $item[$info['id']]['subcategory'] = $get_cat['sub_cat_name'];
            }

            $country_code = $info['country_code'];
            $item[$info['id']]['salary_min'] = price_format($info['salary_min'], $country_code);
            $item[$info['id']]['salary_max'] = price_format($info['salary_max'], $country_code);

            $item[$info['id']]['city'] = $info['city'];
            if (!empty($info['city_code'])) {
                $cordinates = find_user_location($info['city_code']);
                // Item Longitude and Latitude
                $item_longitude = $cordinates ? ($cordinates['longitude'] - 0.008846) : '';
                $item_latitude = $cordinates ? ($cordinates['latitude'] + 0.008194) : '';
                $item[$info['id']]['latitude'] = $item_latitude;
                $item[$info['id']]['longitude'] = $item_longitude;

                $city_detail = get_cityDetail_by_id($info['city_code']);
                if ($city_detail) {
                    if (isset($city_detail['asciiname'])) {
                        $item[$info['id']]['city'] = $city_detail['asciiname'];
                    } else {
                        $item[$info['id']]['city'] = "";
                    }
                    if (isset($city_detail['subadmin1_code'])) {
                        $item[$info['id']]['city'] .= ', ' . get_stateName_by_id($city_detail['subadmin1_code']);
                    } else {
                        $item[$info['id']]['city'] .= "";
                    }
                } else {
                    $item[$info['id']]['city'] .= "";
                }
            } else {
                $item[$info['id']]['latitude'] = "";
                $item[$info['id']]['longitude'] = "";
            }
            if (!empty($user_id)) {
                $favourite  = check_user_favorite($info['id'], $user_id);
            }
            $item[$info['id']]['favorite'] = $favourite;
            $item[$info['id']]['avg_rating'] = avg_review($info['id']);
        }
        $users = array_values($item);
        $message == $lang['SUCCESS'];
    } else {

        $message = $lang['NOT_FOUND'];
    }
    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];
    $message = $lang['SUCCESS'];

    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'total' => $total, 'users' => $users, 'total_map_data' => $total_map_records, 'map_data' => array_values($map_data), 'auth_token' => $valid_auth_token];
    send_json($results);
    die();
}

function upload_product_picture()
{
    global $config, $results;


    $file_avatar = $_FILES["fileToUpload"];
    $path_avatar = "../../storage/products/";
    $first_title = uniqid();

    $getAvatar = fileUpload($path_avatar, $file_avatar, "image", $first_title, 800, 800, true);

    if ($getAvatar != "") {

        $imagePath = $path_avatar . "small_" . $getAvatar;
        $newpath = "../../storage/products/thumb/" . $getAvatar;
        $copied = rename($imagePath, $newpath);

        $picture_url = $config['site_url'] . 'storage/products/thumb/' . $getAvatar;

        $results['status'] = "success";
        $results['picture'] = $getAvatar;
        send_json($results);
    } else {
        $results['status'] = "failed";
        $results['picture'] = "";
        send_json($results);
    }

    send_json($results);
    die();
}

function upload_profile_picture($user_id = null)
{
    global $config, $results;
    if ($user_id == null) {
        $user_id = $_REQUEST['user_id'];
    }

    $file_avatar = $_FILES["fileToUpload"];
    $path_avatar = "../../storage/profile/";
    $first_title = uniqid();


    // receive image as POST Parameter
    $image = str_replace('data:image/png;base64,', '', $_POST['image']);
    $image = str_replace(' ', '+', $image);
    // Decode the Base64 encoded Image
    $data = base64_decode($image);
    // Create Image path with Image name and Extension
    $file = '../images/' . "MyImage" . '.jpg';
    // Save Image in the Image Directory
    $success = file_put_contents($file, $data);

    $getAvatar = fileUpload($path_avatar, $file_avatar, "image", $first_title, 800, 800, true);

    if ($getAvatar != "") {
        if ($user_id) {
            $user_update = ORM::for_table($config['db']['pre'] . 'user')->find_one($user_id);
            $user_update->set('image', $getAvatar);
            $user_update->save();
        }
        $picture_url = $config['site_url'] . 'storage/profile/small_' . $getAvatar;

        $results['status'] = "success";
        $results['url'] = $picture_url;
        send_json($results);
    } else {
        $results['status'] = "failed";
        $results['url'] = "";
        send_json($results);
    }

    send_json($results);
    die();
}

function payumoney_create_hash()
{
    if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0) {
        //Request hash
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if (strcasecmp($contentType, 'application/json') == 0) {
            $data = json_decode(file_get_contents('php://input'));
            $hash = hash('sha512', $data->key . '|' . $data->txnid . '|' . $data->amount . '|' . $data->pinfo . '|' . $data->fname . '|' . $data->email . '|||||' . $data->udf5 . '||||||' . $data->salt);
            $json = array();
            $json['hash'] = $hash;
            echo json_encode($json);
        }
        exit(0);
    }
}

function send_json($results = array())
{
    http_response_code($results['status_code']);
    echo json_encode($results);
    unset($_SESSION['user']);
    die();
}

function add_remove_favorite_job()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $product_id = isset($_REQUEST['product_id']) ? $_REQUEST['product_id'] : null;
        $num_rows = ORM::for_table($config['db']['pre'] . 'favads')
            ->where(array(
                'user_id' => $user_id,
                'product_id' => $product_id
            ))
            ->count();
        if ($num_rows == 0) {
            $insert_favads = ORM::for_table($config['db']['pre'] . 'favads')->create();
            $insert_favads->user_id = $user_id;
            $insert_favads->product_id = $product_id;
            $insert_favads->save();
            if ($insert_favads->id()) {
                $status_code = HTTP_OK;
                $status = $lang['SUCCESS'];
                $message = $lang['ADDED'];
            } else {
                $status_code = HTTP_UNPROCESSABLE_ENTITY;
                $status = $lang['ERROR'];
                $message = $lang['FAILED'];
            }
        } else {
            $result = ORM::for_table($config['db']['pre'] . 'favads')
                ->where(array(
                    'user_id' => $user_id,
                    'product_id' => $product_id,
                ))
                ->delete_many();
            if ($result) {
                $status_code = HTTP_OK;
                $status = $lang['SUCCESS'];
                $message = $lang['REMOVED'];
            } else {
                $status_code = HTTP_UNPROCESSABLE_ENTITY;
                $status = $lang['ERROR'];
                $message = $lang['FAILED'];
            }
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token];
    send_json($results);
    die();
}

function add_remove_favorite_user()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $fav_user_id = isset($_REQUEST['fav_user_id']) ? $_REQUEST['fav_user_id'] : null;
        $num_rows = ORM::for_table($config['db']['pre'] . 'fav_users')
            ->where(array(
                'user_id' => $user_id,
                'fav_user_id' => $fav_user_id
            ))
            ->count();
        if ($num_rows == 0) {
            $insert_favusers = ORM::for_table($config['db']['pre'] . 'fav_users')->create();
            $insert_favusers->user_id = $user_id;
            $insert_favusers->fav_user_id = $fav_user_id;
            $insert_favusers->save();
            if ($insert_favusers->id()) {
                $status_code = HTTP_OK;
                $status = $lang['SUCCESS'];
                $message = $lang['ADDED'];
            } else {
                $status_code = HTTP_UNPROCESSABLE_ENTITY;
                $status = $lang['ERROR'];
                $message = $lang['FAILED'];
            }
        } else {
            $result = ORM::for_table($config['db']['pre'] . 'fav_users')
                ->where(array(
                    'user_id' => $user_id,
                    'fav_user_id' => $fav_user_id,
                ))
                ->delete_many();
            if ($result) {
                $status_code = HTTP_OK;
                $status = $lang['SUCCESS'];
                $message = $lang['REMOVED'];
            } else {
                $status_code = HTTP_UNPROCESSABLE_ENTITY;
                $status = $lang['ERROR'];
                $message = $lang['FAILED'];
            }
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token];
    send_json($results);
    die();
}

function _allow_methods(array $methods = [])
{
    $allowed_http_methods = ['get', 'delete', 'post', 'put', 'options', 'patch', 'head'];
    $REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
    if (in_array(strtolower($REQUEST_METHOD), $allowed_http_methods)) {
        // check request method in user define `$methods` array()
        if (in_array(strtolower($REQUEST_METHOD), $methods) or in_array(strtoupper($REQUEST_METHOD), $methods)) {
            // allow request method
            return true;
        } else {
            // not allow request method
            return false;
        }
    } else {
        return false;
    }
}

function generateToken($payload)
{
    global $key;
    return JWT::encode($payload, $key, 'HS256');
}

function decodeToken($token)
{
    global $key;
    return JWT::decode($token, new Key($key, 'HS256'));
}

function getAuthorizationHeader()
{
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } elseif (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        //print_r($requestHeaders);
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }
    return $headers;
}

function getBearerToken()
{
    $headers = getAuthorizationHeader();
    // HEADER: Get the access token from the header
    if (!empty($headers)) {
        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
    }
    return null;
}

function isAuthTokenValid()
{
    global $config;
    $auth_token = getBearerToken();
    $current_time = time();
    $device_token = ORM::for_table($config['db']['pre'] . 'firebase_device_token')->where('auth_token', $auth_token)->find_one();
    if ($device_token) {
        if ($device_token['auth_token_expiration'] > $current_time) {
            return $auth_token;
        } else {
            $new_auth_token = newAuthTokenByRefreshToken($device_token['refresh_token']);
            if ($new_auth_token)
                return  $new_auth_token;
            else
                return  false;
        }
    } else {
        return false;
    }
}

function newAuthTokenByRefreshToken($refresh_token)
{
    global $config;
    $current_time = time();
    $device_token = ORM::for_table($config['db']['pre'] . 'firebase_device_token')->where('refresh_token', $refresh_token)->find_one();

    if ($device_token && $device_token['refresh_token_expiration'] > $current_time) {
        $user_id =  $device_token['user_id'];
        $user_data = get_user_data(null, $user_id);
        $issued_at = time();
        $issuer = ROOTPATH;
        $auth_token_expiration = $issued_at + (60 * 60 * 2); // 2 hours 
        $payload = array(
            "iat" => $issued_at,
            "exp" => $auth_token_expiration,
            "iss" => $issuer,
            "data" => array(
                "id" => $user_id,
                "username" => $user_data['username'],
                "email" =>  $user_data['email'],
                "device_id" =>  $device_token['device_id'],
            )
        );
        $new_auth_token = generateToken($payload);
        $device_token->set([
            'auth_token' => $new_auth_token,
            'auth_token_expiration' => $auth_token_expiration,

        ]);
        $device_token->save();
        return $device_token->auth_token;
    } else {
        return false;
    }
}

function get_device_token($auth_token, $field_name = '')
{
    global $config;
    $device_token = ORM::for_table($config['db']['pre'] . 'firebase_device_token')->where('auth_token', $auth_token)->find_one();
    if (!empty($field_name)) {
        return  $device_token[$field_name];
    } else {
        return $device_token;
    }
}

function checkIsLoggedin()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        return ['auth_token' => $valid_auth_token, 'user_id' => $user_id];
    } else {
        $results['status_code'] = HTTP_UNAUTHORIZED;
        $results['status'] = $lang['ERROR'];
        $results['message'] = $lang['AUTHTOKENMISMATCH'];
        send_json($results);
        die;
    }
}

function get_user_profile_data()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    $profile_data = [];

    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $profile_data = get_user_profile_all_data($user_id, 'profile');
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'data' => $profile_data];
    send_json($results);
    die();
}

function edit_profile()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = [];
    $userdata = [];
    $avatarName = $dob = null;
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    $categories =  $sub_categories = [];
    $loggedin = checkIsLoggedin();
    $user_id = $loggedin['user_id'];
    $user_data = get_user_data(null, $user_id);
    $user_main_category_ids = get_user_main_categories($user_id, true);
    $user_sub_category_ids =  get_user_sub_categories($user_id, true);
    $author_image = $user_data['image'];

    $firstname_length = strlen(utf8_decode($_REQUEST['firstname']));
    $lastname_length = strlen(utf8_decode($_REQUEST['lastname']));
    if (empty($_REQUEST["firstname"])) {

        $errors['firstname'] = $lang['ENTERFIRSTNAME'];
    } elseif (($firstname_length < 2) or ($firstname_length > 21)) {
        $status = "error";
        $errors['firstname'] = $lang['NAMELEN'];
    }
    if (empty($_REQUEST["lastname"])) {
        $errors['lastname'] = $lang['ENTERLASTNAME'];
    } elseif (($lastname_length < 2) or ($lastname_length > 21)) {
        $errors['lastname'] = $lang['NAMELEN'];
    }

    $about_me = (isset($_REQUEST['about_me']) && !empty($_REQUEST['about_me'])) ? $_REQUEST['about_me'] : '';
    if (empty($about_me)) {
        $errors['about_me'] = 'Write something about you.';
    }

    $address = (isset($_REQUEST['address']) && !empty($_REQUEST['address'])) ? $_REQUEST['address'] : '';
    if (empty($address)) {
        $errors['address'] = 'Enter or Select Address.';
    }

    $summary = (isset($_REQUEST['summary']) && !empty($_REQUEST['summary'])) ? $_REQUEST['summary'] : '';
    if (empty($summary)) {
        $errors['summary'] = 'Write something in summary.';
    }
    $dob = (isset($_REQUEST['dob']) && !empty($_REQUEST['dob'])) ? date('Y-m-d H:i:s', strtotime($_REQUEST['dob'])) : '';
    if (empty($dob)) {
        $errors['dob'] = $lang['DOB_REQ'];
    } elseif (getAge($dob) < 18) {
        $errors['dob'] = 'Minimum age should be 18 years';
    }
    // if ($user_data == 'user') {
    //     $category = (isset($_REQUEST['category']) && !empty($_REQUEST['category'])) ? $_REQUEST['category'] : '';
    //     if (empty($category)) {
    //         $errors['category'] = 'Category is required';
    //     }
    //     $subcategory = (isset($_REQUEST['subcategory']) && !empty($_REQUEST['subcategory'])) ? $_REQUEST['subcategory'] : '';
    //     if (empty($subcategory)) {
    //         $errors['subcategory'] = 'Sub Category is required';
    //     }
    // }

    if (!count($errors) > 0) {
        if (!empty($_FILES['avatar'])) {
            $file = $_FILES['avatar'];
            // Valid formats
            $valid_formats = array("jpeg", "jpg", "png");
            $filename = $file['name'];

            $ext = getExtension($filename);
            $ext = strtolower($ext);
            if (!empty($filename)) {
                //File extension check
                if (in_array($ext, $valid_formats)) {
                    $main_path = ROOTPATH . "/storage/profile/";
                    $filename = uniqid($user_data['username'] . '_') . '.' . $ext;
                    if (move_uploaded_file($file['tmp_name'], $main_path . $filename)) {
                        $avatarName = $filename;
                        resizeImage(150, $main_path . $filename, $main_path . $filename);
                        resizeImage(60, $main_path . 'small_' . $filename, $main_path . $filename);
                        if (file_exists($main_path . $author_image) && $author_image != 'default_user.png') {
                            unlink($main_path . $author_image);
                            unlink($main_path . 'small_' . $author_image);
                        }
                    } else {
                        $errors['image'] = $lang['ERROR_TRY_AGAIN'];
                    }
                } else {
                    $errors['image'] = $lang['ONLY_JPG_ALLOW'];
                }
            }
        }
    }

    if (!count($errors) > 0) {
        // if (isset($_REQUEST['category'])) {
        //     $categories = json_decode($_REQUEST['category']);
        //     if (!empty($categories)) {
        //         $main_categories = $categories;
        //         if (!empty($user_main_category_ids)) {
        //             foreach ($user_main_category_ids as $cate_id) {
        //                 if (!in_array($cate_id, $main_categories)) {
        //                     $mcate = ORM::for_table($config['db']['pre'] . 'user_main_category')->where(['user_id' => $user_id, 'category_id' => $cate_id])->find_one();
        //                     $mcate->delete();
        //                 }
        //             }
        //         }
        //         foreach ($main_categories as $key => $m_cate) {
        //             $exist = ORM::for_table($config['db']['pre'] . 'user_main_category')->where(['user_id' => $user_id, 'category_id' => $m_cate])->find_one();
        //             if (!$exist) {
        //                 $u_m_cate = ORM::for_table($config['db']['pre'] . 'user_main_category')->create();
        //                 $u_m_cate->user_id = $user_id;
        //                 $u_m_cate->category_id  = $m_cate;
        //                 $u_m_cate->created_at  = date('Y-m-d');
        //                 $u_m_cate->updated_at  = date('Y-m-d');
        //                 $u_m_cate->save();
        //             }
        //         }
        //     }
        // }
        // if (isset($_REQUEST['subcategory'])) {
        //     if (!empty($_REQUEST['subcategory'])) {
        //         $sub_categories = json_decode($_REQUEST['subcategory']);
        //         if (!empty($user_sub_category_ids)) {
        //             foreach ($user_sub_category_ids as $cate_id) {
        //                 if (!in_array($cate_id, $sub_categories)) {
        //                     $mcate = ORM::for_table($config['db']['pre'] . 'user_sub_category')->where(['user_id' => $user_id, 'subcategory_id' => $cate_id])->find_one();
        //                     $mcate->delete();
        //                 }
        //             }
        //         }
        //         foreach ($sub_categories as $key => $sub_cate) {
        //             $exist = ORM::for_table($config['db']['pre'] . 'user_sub_category')->where(['user_id' => $user_id, 'subcategory_id' => $sub_cate])->find_one();
        //             if (!$exist) {
        //                 $u_s_cate = ORM::for_table($config['db']['pre'] . 'user_sub_category')->create();
        //                 $u_s_cate->user_id = $user_id;
        //                 $u_s_cate->subcategory_id  = $sub_cate;
        //                 $u_s_cate->created_at  = date('Y-m-d');
        //                 $u_s_cate->updated_at  = date('Y-m-d');
        //                 $u_s_cate->save();
        //             }
        //         }
        //     }
        // }
        $dob = null;
        if (!empty($_REQUEST['dob'])) {
            $dob = date("Y-m-d", strtotime($_REQUEST['dob']));
        }
        $now = date("Y-m-d H:i:s");
        $user_update = ORM::for_table($config['db']['pre'] . 'user')->find_one($user_id);
        $user_update->set('firstname', $_REQUEST["firstname"]);
        $user_update->set('lastname', $_REQUEST["lastname"]);
        $user_update->set('name', $_REQUEST["firstname"] . ' ' . $_REQUEST["lastname"]);
        $user_update->set('sex', $_REQUEST["gender"]);
        $user_update->set('tagline', isset($_REQUEST["summary"]) ? validate_input(strlimiter($_REQUEST["summary"], 200)) : null);
        $user_update->set('dob', $dob);

        $user_update->set('description',  validate_input($_REQUEST['about_me']));
        $user_update->set('address', validate_input($_REQUEST["address"]));
        $user_update->set('address_latitude', $_REQUEST['latitude']);
        $user_update->set('address_longitude', $_REQUEST['longitude']);
        $user_update->set('updated_at', $now);
        if ($avatarName) {
            $user_update->set('image', $avatarName);
        }
        $user_update->save();
        if ($user_data['user_type'] == 'user' && !empty($sub_categories)) {
            $requirement_ids = ORM::for_table($config['db']['pre'] . 'requirement_categories')->table_alias('req_c')
                ->select('req_c.requirement_id')
                ->where_in('subcategory_id', $sub_categories)
                ->where('req.status', '1')
                ->join($config['db']['pre'] . 'requirements', 'req.id = req_c.requirement_id ', 'req')
                ->group_by('requirement_id')->find_many()->as_array();
            $requirement_ids = array_column($requirement_ids, 'requirement_id');
            $user_requirement = ORM::for_table($config['db']['pre'] . 'user_documents')->where('user_id', $user_id)->find_many()->as_array();
            $user_requirement_ids = array_column($user_requirement, 'requirement_id');
            foreach ($requirement_ids as $requirement_id) {
                if (!in_array($requirement_id, $user_requirement_ids)) {
                    $user_documents = ORM::for_table($config['db']['pre'] . 'user_documents')->create();
                    $user_documents->user_id = $user_id;
                    $user_documents->requirement_id = $requirement_id;
                    $user_documents->status = 'requested';
                    $user_documents->save();
                }
            }
        }

        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['PROFILE_UPDATED'];
        $userdata = get_user_data(null, $user_id);
        $userdata['category'] =  get_user_main_categories($user_id, true);
        $userdata['subcategory'] =  get_user_sub_categories($user_id, true);
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['FAILED'];
    }

    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'errors' => $errors, 'auth_token' => $loggedin['auth_token'], 'user_data' => $userdata];
    send_json($results);
    die();
}

function get_user_address_details()
{
    global $config, $lang;
    $addr_details = [];
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $user_data = get_user_data(null, $user_id);

    if (!empty($user_data['address_latitude']) && !empty($user_data['address_longitude'])) {
        $home_latitude = $user_data['address_latitude'];
        $home_longitude = $user_data['address_longitude'];
    } elseif ($user_data['city_code'] != "") {
        $city_latlong = ORM::for_table($config['db']['pre'] . 'cities')->find_one($user_data['city_code']);
        $home_latitude = $city_latlong['latitude'];
        $home_longitude = $city_latlong['longitude'];
    } else {
        $home_latitude = get_option('home_map_latitude');
        $home_longitude = get_option('home_map_longitude');
    }

    $addr_details = [
        'city' => $user_data['city_code'],
        'city_name' => get_cityName_by_id($user_data['city_code']),
        'address' => $user_data['address'],
        'state_code' => $user_data['state_code'],
        'country_code' => $user_data['country_code'],
        'latitude' => $home_latitude,
        'longitude' => $home_longitude,
    ];
    $results = ['status_code' => HTTP_OK, 'status' => $lang['SUCCESS'], 'message' => $lang['SUCCESS'], 'auth_token' => $loggedin['auth_token'], 'address_details' => $addr_details];
    send_json($results);
    die();
}

function set_user_address_details()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = $addr_details = [];
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $city = (isset($_REQUEST['city']) && !empty($_REQUEST['city'])) ? $_REQUEST['city'] : null;
    $address = (isset($_REQUEST['address']) && !empty($_REQUEST['address'])) ? $_REQUEST['address'] : null;
    if (empty($city)) {
        $errors['city'] = $lang['CITY_REQ'];
    }
    if (empty($address)) {
        $errors['address'] = $lang['ADDRESS_REQ'];
    }
    if (!count($errors) > 0) {
        $citydata = get_cityDetail_by_id($city);
        $country = $citydata['country_code'];
        $state = $citydata['subadmin1_code'];
        $user_update = ORM::for_table($config['db']['pre'] . 'user')->find_one($user_id);
        $user_update->set('city_code', $city);
        $user_update->set('state_code', $state);
        $user_update->set('country_code', $country);
        $user_update->set('address', $_REQUEST['address']);
        $user_update->set('address_latitude', $_REQUEST['latitude']);
        $user_update->set('address_longitude', $_REQUEST['longitude']);
        $user_update->save();

        $user_data = get_user_data(null, $user_id);
        if (!empty($user_data['address_latitude']) && !empty($user_data['address_longitude'])) {
            $home_latitude = $user_data['address_latitude'];
            $home_longitude = $user_data['address_longitude'];
        } elseif ($user_data['city_code'] != "") {
            $city_latlong = ORM::for_table($config['db']['pre'] . 'cities')->find_one($user_data['city_code']);
            $home_latitude = $city_latlong['latitude'];
            $home_longitude = $city_latlong['longitude'];
        } else {
            $home_latitude = get_option('home_map_latitude');
            $home_longitude = get_option('home_map_longitude');
        }
        $addr_details = [
            'city' => $user_data['city_code'],
            'city_name' => get_cityName_by_id($user_data['city_code']),
            'address' => $user_data['address'],
            'state_code' => $user_data['state_code'],
            'country_code' => $user_data['country_code'],
            'latitude' => $home_latitude,
            'longitude' => $home_longitude,
        ];
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['UPDATED_SUCCESS'];
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang["FAILED"];
    }

    $results = ['status_code' => HTTP_OK, 'status' => $lang['SUCCESS'], 'message' => $lang['SUCCESS'], 'auth_token' => $loggedin['auth_token'], 'address_details' => $addr_details];
    send_json($results);
    die();
}

function check_user_address_details_completed()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = $addr_details = [];
    $completed = false;
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $addr_details = address_details_check($user_id);
    if (!empty($addr_details)) {
        $completed = true;
    }
    $results = ['status_code' => HTTP_OK, 'status' => $lang['SUCCESS'], 'message' => $lang['SUCCESS'], 'auth_token' => $loggedin['auth_token'], 'completed' => $completed];
    send_json($results);
    die();
}

function set_user_visibility_status()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    $visibilty = (isset($_REQUEST['visibility']) && $_REQUEST['visibility'] == 1) ? '1' : '0';
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $user_data = get_user_data(null, $user_id);
        $profile_progress = progress_bar($user_id);
        $is_doc_verified = $user_data['is_verified'];
        $is_active = ($user_data['status'] == 1) ? true : false;
        if ($is_active && $is_doc_verified && $profile_progress >= 50) {
            $user = ORM::for_table($config['db']['pre'] . 'user')->find_one($user_id);
            $user->set('available_to_work', $visibilty);
            if ($user->save()) {
                $status_code = HTTP_OK;
                $status = $lang['SUCCESS'];
                $message = $lang['SUCCESS'];
            } else {
                $status_code = HTTP_UNPROCESSABLE_ENTITY;
                $status = $lang['ERROR'];
                $message = $lang['SOMETHING_WENT_WRONG'];
            }
        } else {
            if (!$is_active) {
                $message =  'Your email is not verified yet, please verify it first.';
            } elseif ($profile_progress < 50) {
                $message = 'your profile is not completed yet, please complete it at least 50%';
            } elseif (!$is_doc_verified) {
                $message = 'Your documents are not verified yet.';
            } else {
                $message = $lang['ERROR'];
            }
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'visibility' => $visibilty];
    send_json($results);
    die();
}

function get_user_account_details()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = [];
    $details = [];
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $user_data = get_user_data(null, $user_id);
        $details['account_details'] = [
            'username' => $user_data['username'],
            'dob' => $user_data['dob'],
            'email' => $user_data['email'],
            'phone' => $user_data['phone'],
            'user_type' => $user_data['user_type'],
        ];
        $details['bank_details'] = user_bank_details($user_id);
        $details['invoice_details'] = user_invoice_details($user_id);
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'errors' => $errors, 'details' => $details];
    send_json($results);
    die();
}

function user_account_setting()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = [];
    $details = [];
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $user_data = get_user_data(null, $user_id);
        // Check if this is an Email availability check from signup page using ajax
        if (is_null($_REQUEST["email"])) {
            $errors['email'] = $lang['ENTEREMAIL'];
        } elseif ($_REQUEST["email"] != $user_data['email']) {
            $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

            if (!preg_match($regex, $_REQUEST['email'])) {
                $errors['email'] = $lang['EMAILINV'];
            } else {
                $user_count = check_account_exists($_REQUEST["email"]);
                if ($user_count > 0) {
                    $errors['email'] = $lang['ACCAEXIST'];
                }
            }
        }

        if (!count($errors) > 0) {

            $now = date("Y-m-d H:i:s");
            $user_update = ORM::for_table($config['db']['pre'] . 'user')->find_one($user_id);
            $user_update->set('phone', $_REQUEST['phone']);
            $user_update->set('email', $_REQUEST["email"]);
            $user_update->set('updated_at', $now);
            $user_update->save();
            $user_data = get_user_data(null, $user_id);
            $details['account_details'] = [
                'name' => $user_data['name'],
                'dob' => $user_data['dob'],
                'email' => $user_data['email'],
                'phone' => $user_data['phone'],
                'user_type' => $user_data['user_type'],
            ];
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['UPDATED_SUCCESS'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['FAILED'];
        }

        if (empty($_POST["account_name"])) {
            $errors['account_name'] = $lang['ENTERACCOUNTNAME'];
        }
        if (empty($_POST["bank_name"])) {
            $errors['bank_name'] = $lang['ENTERBANKNAME'];
        }
        if (empty($_POST["bsb"])) {
            $errors['bsb'] =  $lang['ENTERBSBNAME'];
        }
        if (empty($_POST["account_number"])) {
            $errors['account_number'] = $lang['ENTERACCOUNTNUMBER'];
        }
        if (!count($errors) > 0) {
            $now = date("Y-m-d H:i:s");
            $user_bankdata = ORM::for_table($config['db']['pre'] . 'user_bank_details')->where('user_id', $user_id)->find_one();
            if ($user_bankdata) {
                $user_bankdata->set(
                    [
                        'account_name' => $_REQUEST['account_name'],
                        'bank_name' => $_REQUEST['bank_name'],
                        'bsb' => $_REQUEST['bsb'],
                        'account_number' => $_REQUEST['account_number'],
                        'updated_at' => $now
                    ]
                );
                $user_bankdata->save();
                $message = $lang['UPDATED_SUCCESS'];
            } else {
                $insert_bankdata = ORM::for_table($config['db']['pre'] . 'user_bank_details')->create();
                $insert_bankdata->user_id = $user_id;
                $insert_bankdata->account_name = $_REQUEST['account_name'];
                $insert_bankdata->bank_name = $_REQUEST['bank_name'];
                $insert_bankdata->bsb = $_REQUEST['bsb'];
                $insert_bankdata->account_number = $_REQUEST['account_number'];
                $insert_bankdata->created_at = $now;
                $insert_bankdata->updated_at = $now;
                $insert_bankdata->save();
                $message = $lang['SAVED_SUCCESS'];
            }
            $details['bank_details'] = user_bank_details($user_id);
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['FAILED'];
        }

        $user_data = get_user_data(null, $user_id);
        $user_type =   $user_data['user_type'];
        if ($user_type == 'user') {
            $old_invoice_logo = $user_abndata['invoice_logo'] ?? null;
            if (empty($_REQUEST['invoice_number'])) {
                $errors['invoice_number'] = $lang['INVNUM_REQ'];
            }
            if (empty($_REQUEST['abn'])) {
                $errors['abn'] = $lang['ABN_REQ'];
            }
            if (empty($_REQUEST['company_name'])) {
                $errors['company_name'] = $lang['COMPANYNAME_REQ'];
            }
            if (empty($_REQUEST['trading_name'])) {
                $errors['trading_name'] = $lang['TRADINGNAME_REQ'];
            }
            if (empty($_REQUEST['provider_id'])) {
                $errors['provider_id'] = $lang['PROVIDER_REQ'];
            }
        }
        if (empty($_REQUEST['emails'])) {
            $errors['emails'] = $lang['ANOTHER_EMAIL_REQ'];
        }
        if ((!count($errors) > 0) && ($user_type == 'user')) {
            if (isset($_FILES['invoice_logo'])) {
                if (!empty($_FILES['invoice_logo']['name'])) {
                    $files = $_FILES['invoice_logo'];
                    $path = ROOTPATH . "/storage/invoice_logo/";
                    list($width, $height) = getimagesize($files["tmp_name"]);
                    $uploaded_file = fileUpload($path, $files, 'image', 'invoice_logo', $width, $height, false, $old_invoice_logo);
                    if ($uploaded_file['status']) {
                        $uploaded_filename =  $uploaded_file['filetitle'];
                    } else {
                        $errors['invoice_logo'] = $uploaded_file['message'];
                    }
                }
            }
        }
        if (!count($errors) > 0) {
            $user_ano_emails = ORM::for_table($config['db']['pre'] . 'user_another_emails')->select_many('id', 'email')->where('user_id', $user_id)->find_array();

            if ($user_type == 'user') {
                $user_abndata = ORM::for_table($config['db']['pre'] . 'user_abn_details')->where('user_id', $user_id)->find_one();
                if ($user_abndata) {
                    $user_abndata->set([
                        'invoice_logo' => !empty($uploaded_filename) ? $uploaded_filename : $user_abndata['invoice_logo'],
                        'invoice_number' => $_REQUEST['invoice_number'],
                        'abn' => $_REQUEST['abn'],
                        'company_name' => $_REQUEST['company_name'],
                        'trading_name' => $_REQUEST['trading_name'],
                        'provider_id' => $_REQUEST['provider_id'],
                    ]);
                    $user_abndata->save();
                } else {
                    $create_abndata = ORM::for_table($config['db']['pre'] . 'user_abn_details')->create();
                    $create_abndata->user_id = $user_id;
                    $create_abndata->invoice_logo = !empty($uploaded_filename) ? $uploaded_filename : null;
                    $create_abndata->invoice_number = $_REQUEST['invoice_number'];
                    $create_abndata->abn = $_REQUEST['abn'];
                    $create_abndata->company_name = $_REQUEST['company_name'];
                    $create_abndata->trading_name = $_REQUEST['trading_name'];
                    $create_abndata->provider_id = $_REQUEST['provider_id'];
                    $create_abndata->created_at = date('Y-m-d H:i:s');
                    $create_abndata->save();
                }
            }

            //adding multiple emails
            $post_email_data = json_decode($_REQUEST['emails'], true);
            //dd($post_email_data);
            $u_posted_ids = array_map(function ($email) {
                return $email['id'];
            }, $post_email_data);
            foreach (array_column($user_ano_emails, 'id') as  $id) {
                if (!in_array($id, $u_posted_ids)) {
                    $d = ORM::for_table($config['db']['pre'] . 'user_another_emails')->where(['user_id' => $user_id, 'id' => $id])->find_one();
                    $d->delete();
                }
            }
            foreach ($post_email_data as $key => $value) {

                if (!empty($value['id'])) {
                    $u_email = ORM::for_table($config['db']['pre'] . 'user_another_emails')->where(['user_id' => $user_id, 'id' => $value['id']])->find_one();
                    $u_email->set('email', $value['email']);
                    $u_email->set('name', $value['name']);
                    $u_email->set('role', $value['role']);
                    $u_email->save();
                } else {
                    $insert_email = ORM::for_table($config['db']['pre'] . 'user_another_emails')->create();
                    $insert_email->user_id = $user_id;
                    $insert_email->email = $value['email'];
                    $insert_email->name = $value['name'];
                    $insert_email->role = $value['role'];
                    $insert_email->save();
                }
            }
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['UPDATED_SUCCESS'];
            $details['invoice_detail'] = user_invoice_details($user_id);
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['FAILED'];
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'errors' => $errors, 'details' => $details];
    send_json($results);
    die();
}

function user_bank_detail_setting()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = [];
    $bank_details = [];
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        if (empty($_POST["account_name"])) {
            $errors['account_name'] = $lang['ENTERACCOUNTNAME'];
        }
        if (empty($_POST["bank_name"])) {
            $errors['bank_name'] = $lang['ENTERBANKNAME'];
        }
        if (empty($_POST["bsb"])) {
            $errors['bsb'] =  $lang['ENTERBSBNAME'];
        }
        if (empty($_POST["account_number"])) {
            $errors['account_number'] = $lang['ENTERACCOUNTNUMBER'];
        }
        if (!count($errors) > 0) {
            $now = date("Y-m-d H:i:s");
            $user_bankdata = ORM::for_table($config['db']['pre'] . 'user_bank_details')->where('user_id', $user_id)->find_one();
            if ($user_bankdata) {
                $user_bankdata->set(
                    [
                        'account_name' => $_REQUEST['account_name'],
                        'bank_name' => $_REQUEST['bank_name'],
                        'bsb' => $_REQUEST['bsb'],
                        'account_number' => $_REQUEST['account_number'],
                        'updated_at' => $now
                    ]
                );
                $user_bankdata->save();
                $message = $lang['UPDATED_SUCCESS'];
            } else {
                $insert_bankdata = ORM::for_table($config['db']['pre'] . 'user_bank_details')->create();
                $insert_bankdata->user_id = $user_id;
                $insert_bankdata->account_name = $_REQUEST['account_name'];
                $insert_bankdata->bank_name = $_REQUEST['bank_name'];
                $insert_bankdata->bsb = $_REQUEST['bsb'];
                $insert_bankdata->account_number = $_REQUEST['account_number'];
                $insert_bankdata->created_at = $now;
                $insert_bankdata->updated_at = $now;
                $insert_bankdata->save();
                $message = $lang['SAVED_SUCCESS'];
            }
            $bank_details = user_bank_details($user_id);
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['FAILED'];
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'errors' => $errors, 'bank_details' => $bank_details];
    send_json($results);
    die();
}

function abnLookupSearch()
{
    global $lang, $status, $status_code, $message, $results;
    $abn_details = [];
    $errors = [];
    $abn_string = isset($_REQUEST['abn']) && !empty($_REQUEST['abn']) ? trim($_REQUEST['abn']) : '';
    if (!empty($abn_string)) {
        $result = abn_search($abn_string);
        if (isset($result->exception)) {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $errors['exceptionCode'] = $result->exception->exceptionCode;
            $errors['message'] =  $result->exception->exceptionDescription;
            $message = 'exception occurred';
        } else {
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['SUCCESS'];
            $abn_details['company_name'] = $result->businessEntity->mainName->organisationName;
            $abn_details['trading_name'] = $result->businessEntity->mainTradingName->organisationName;
        }
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['ABN_REQ'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'errors' => $errors, 'abn_details' => $abn_details];
    send_json($results);
    die();
}

function user_invoice_details_setting()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = [];
    $invoice_detail = [];
    $uploaded_filename = '';
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $user_data = get_user_data(null, $user_id);
    $user_type =   $user_data['user_type'];
    if ($user_type == 'user') {
        $old_invoice_logo = $user_abndata['invoice_logo'] ?? null;
        if (empty($_REQUEST['invoice_number'])) {
            $errors['invoice_number'] = $lang['INVNUM_REQ'];
        }
        if (empty($_REQUEST['abn'])) {
            $errors['abn'] = $lang['ABN_REQ'];
        }
        if (empty($_REQUEST['company_name'])) {
            $errors['company_name'] = $lang['COMPANYNAME_REQ'];
        }
        if (empty($_REQUEST['trading_name'])) {
            $errors['trading_name'] = $lang['TRADINGNAME_REQ'];
        }
        if (empty($_REQUEST['provider_id'])) {
            $errors['provider_id'] = $lang['PROVIDER_REQ'];
        }
    }
    if (empty($_REQUEST['emails'])) {
        $errors['emails'] = $lang['ANOTHER_EMAIL_REQ'];
    }
    if ((!count($errors) > 0) && ($user_type == 'user')) {
        if (isset($_FILES['invoice_logo'])) {
            if (!empty($_FILES['invoice_logo']['name'])) {
                $files = $_FILES['invoice_logo'];
                $path = ROOTPATH . "/storage/invoice_logo/";
                list($width, $height) = getimagesize($files["tmp_name"]);
                $uploaded_file = fileUpload($path, $files, 'image', 'invoice_logo', $width, $height, false, $old_invoice_logo);
                if ($uploaded_file['status']) {
                    $uploaded_filename =  $uploaded_file['filetitle'];
                } else {
                    $errors['invoice_logo'] = $uploaded_file['message'];
                }
            }
        }
    }
    if (!count($errors) > 0) {
        $user_ano_emails = ORM::for_table($config['db']['pre'] . 'user_another_emails')->select_many('id', 'email')->where('user_id', $user_id)->find_array();

        if ($user_type == 'user') {
            $user_abndata = ORM::for_table($config['db']['pre'] . 'user_abn_details')->where('user_id', $user_id)->find_one();
            if ($user_abndata) {
                $user_abndata->set([
                    'invoice_logo' => !empty($uploaded_filename) ? $uploaded_filename : $user_abndata['invoice_logo'],
                    'invoice_number' => $_REQUEST['invoice_number'],
                    'abn' => $_REQUEST['abn'],
                    'company_name' => $_REQUEST['company_name'],
                    'trading_name' => $_REQUEST['trading_name'],
                    'provider_id' => $_REQUEST['provider_id'],
                ]);
                $user_abndata->save();
            } else {
                $create_abndata = ORM::for_table($config['db']['pre'] . 'user_abn_details')->create();
                $create_abndata->user_id = $user_id;
                $create_abndata->invoice_logo = !empty($uploaded_filename) ? $uploaded_filename : null;
                $create_abndata->invoice_number = $_REQUEST['invoice_number'];
                $create_abndata->abn = $_REQUEST['abn'];
                $create_abndata->company_name = $_REQUEST['company_name'];
                $create_abndata->trading_name = $_REQUEST['trading_name'];
                $create_abndata->provider_id = $_REQUEST['provider_id'];
                $create_abndata->created_at = date('Y-m-d H:i:s');
                $create_abndata->save();
            }
        }

        //adding multiple emails
        $post_email_data = json_decode($_REQUEST['emails'], true);

        $u_posted_ids = array_map(function ($email) {
            return $email['id'];
        }, $post_email_data);
        foreach (array_column($user_ano_emails, 'id') as  $id) {
            if (!in_array($id, $u_posted_ids)) {
                $d = ORM::for_table($config['db']['pre'] . 'user_another_emails')->where(['user_id' => $user_id, 'id' => $id])->find_one();
                $d->delete();
            }
        }
        foreach ($post_email_data as $key => $value) {

            if (!empty($value['id'])) {
                $u_email = ORM::for_table($config['db']['pre'] . 'user_another_emails')->where(['user_id' => $user_id, 'id' => $value['id']])->find_one();
                $u_email->set('email', $value['email']);
                $u_email->set('name', $value['name']);
                $u_email->set('role', $value['role']);
                $u_email->save();
            } else {
                $insert_email = ORM::for_table($config['db']['pre'] . 'user_another_emails')->create();
                $insert_email->user_id = $user_id;
                $insert_email->email = $value['email'];
                $insert_email->name = $value['name'];
                $insert_email->role = $value['role'];
                $insert_email->save();
            }
        }
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['UPDATED_SUCCESS'];
        $invoice_detail = user_invoice_details($user_id);
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['FAILED'];
    }

    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'errors' => $errors, 'invoice_detail' => $invoice_detail];
    send_json($results);
    die();
}

function get_rate_and_availability()
{
    global $lang, $status, $status_code, $message, $results;
    $availabilitydata = [];
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $availabilitydata = get_user_profile_all_data($user_id, 'rate_availability');
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'rate_availability' => $availabilitydata];
    send_json($results);
    die();
}

function set_rate_and_availability()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = 0;
    $time_error = [];
    $categories =  $sub_categories = [];
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $user_main_category_ids = get_user_main_categories($user_id, true);
    $user_sub_category_ids =  get_user_sub_categories($user_id, true);

    $days = json_decode($_REQUEST['days']) ?? [];
    $time_slots = json_decode($_REQUEST['time_slot'], true) ?? [];
    $user_pr_days = get_user_preferred_days($user_id);
    if (empty($days)) {
        $errors++;
        $message = $lang['DAY_REQ'];
    }
    foreach ($time_slots as $key => $slot) {

        $slot = $slot;
        $st_time = !empty($slot['start_time']) ? date('H:i:s', strtotime($slot['start_time'])) : '';
        $en_time = !empty($slot['end_time']) ? date('H:i:s', strtotime($slot['end_time'])) : '';
        if (!empty($st_time) || !empty($en_time)) {
            if ($en_time <= $st_time) {
                $errors++;
                $time_error[$key] = $lang['INVALID_END_TIME'] . ' for ' . $key . '';
                break;
            }
        } else {
            continue;
        }
    }
    if (!empty($time_error)) {
        $errors++;
        $message = implode(',', $time_error);
    }

    $category = (isset($_REQUEST['category']) && !empty($_REQUEST['category'])) ? $_REQUEST['category'] : '';
    if (empty($category)) {
        $message = 'Category is required';
        $errors++;
    }
    $subcategory = (isset($_REQUEST['subcategory']) && !empty($_REQUEST['subcategory'])) ? $_REQUEST['subcategory'] : '';
    if (empty($subcategory)) {
        $message = 'Sub Category is required';
        $errors++;
    }
    if ($errors == 0) {
        if (isset($_REQUEST['category'])) {
            $categories = json_decode($_REQUEST['category']);
            if (!empty($categories)) {
                $main_categories = $categories;
                if (!empty($user_main_category_ids)) {
                    foreach ($user_main_category_ids as $cate_id) {
                        if (!in_array($cate_id, $main_categories)) {
                            $mcate = ORM::for_table($config['db']['pre'] . 'user_main_category')->where(['user_id' => $user_id, 'category_id' => $cate_id])->find_one();
                            $mcate->delete();
                        }
                    }
                }
                foreach ($main_categories as $key => $m_cate) {
                    $exist = ORM::for_table($config['db']['pre'] . 'user_main_category')->where(['user_id' => $user_id, 'category_id' => $m_cate])->find_one();
                    if (!$exist) {
                        $u_m_cate = ORM::for_table($config['db']['pre'] . 'user_main_category')->create();
                        $u_m_cate->user_id = $user_id;
                        $u_m_cate->category_id  = $m_cate;
                        $u_m_cate->created_at  = date('Y-m-d');
                        $u_m_cate->updated_at  = date('Y-m-d');
                        $u_m_cate->save();
                    }
                }
            }
        }
        if (isset($_REQUEST['subcategory'])) {
            if (!empty($_REQUEST['subcategory'])) {
                $sub_categories = json_decode($_REQUEST['subcategory']);
                if (!empty($user_sub_category_ids)) {
                    foreach ($user_sub_category_ids as $cate_id) {
                        if (!in_array($cate_id, $sub_categories)) {
                            $mcate = ORM::for_table($config['db']['pre'] . 'user_sub_category')->where(['user_id' => $user_id, 'subcategory_id' => $cate_id])->find_one();
                            $mcate->delete();
                        }
                    }
                }
                foreach ($sub_categories as $key => $sub_cate) {
                    $exist = ORM::for_table($config['db']['pre'] . 'user_sub_category')->where(['user_id' => $user_id, 'subcategory_id' => $sub_cate])->find_one();
                    if (!$exist) {
                        $u_s_cate = ORM::for_table($config['db']['pre'] . 'user_sub_category')->create();
                        $u_s_cate->user_id = $user_id;
                        $u_s_cate->subcategory_id  = $sub_cate;
                        $u_s_cate->created_at  = date('Y-m-d');
                        $u_s_cate->updated_at  = date('Y-m-d');
                        $u_s_cate->save();
                    }
                }
            }
        }
        $salary_min = $salary_max = 0;
        if (!empty($_REQUEST['salary_min']) or !empty($_REQUEST['salary_max'])) {
            $salary_min = is_numeric($_REQUEST['salary_min']) ? $_REQUEST['salary_min'] : 0;
            $salary_max = is_numeric($_REQUEST['salary_max']) ? $_REQUEST['salary_max'] : 0;
        }
        $user_update = ORM::for_table($config['db']['pre'] . 'user')->find_one($user_id);
        $user_update->set('salary_min', $salary_min);
        $user_update->set('salary_max', $salary_max);
        $user_update->set('is_session_willing', $_REQUEST['session_willing'] ?? "0");
        $user_update->set('is_negotiable', $_REQUEST['is_negotiable'] ?? "0");
        $user_update->set('city_range', $_REQUEST['city_range']);
        $user_update->save();

        $day_codes = array_column($user_pr_days, 'day');
        foreach ($day_codes as $day) {
            if (!in_array($day, $days)) {
                $c = ORM::for_table($config['db']['pre'] . 'user_prefered_days')->where(['user_id' => $user_id, 'day' => $day])->find_one();
                $c->delete();
            }
        }
        foreach ($days as $key => $day) {
            $e_day = ORM::for_table($config['db']['pre'] . 'user_prefered_days')->where(['user_id' => $user_id, 'day' => $day])->find_one();
            $d_start_time = !empty($time_slots[$key]['start_time']) ? date('H:i:s', strtotime($time_slots[$key]['start_time'])) : null;
            $d_end_time = !empty($time_slots[$key]['end_time']) ? date('H:i:s', strtotime($time_slots[$key]['end_time'])) : null;
            if (!$e_day) {
                $u_day = ORM::for_table($config['db']['pre'] . 'user_prefered_days')->create();
                $u_day->user_id = $user_id;
                $u_day->day = $day;
                $u_day->start_time = $d_start_time;
                $u_day->end_time = $d_end_time;
                $u_day->save();
            } else {
                $e_day->set('start_time', $d_start_time);
                $e_day->set('end_time', $d_end_time);
                $e_day->save();
            }
        }
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['RATE_AVAILABILITY_UPDATED'];
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $message;
    }

    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'rate_availability' => get_rate_and_availability()];
    send_json($results);
    die();
}

function get_cultural_background_list()
{
    global $lang;
    $cultural_backgrounds = get_cultural_background();
    $results = ['status_code' => HTTP_OK, 'status' => $lang['SUCCESS'], 'message' => $lang['SUCCESS'], 'cultural_backgrounds' => $cultural_backgrounds];
    send_json($results);
    die();
}

function get_user_cultural_background()
{
    global $lang, $status, $status_code, $message, $results;
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $cultural_background = get_cultural_background_data($user_id);
    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];
    $message = $lang['SUCCESS'];
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'cultural_background' => $cultural_background];
    send_json($results);
    die();
}

// function set_user_cultural_background()
// {
//     global $config, $lang, $status, $status_code, $message, $results;
//     $errors = 0;
//     $cultural_background = array();
//     $backs = json_decode($_REQUEST['background']) ?? [];
//     $background_options = json_decode($_REQUEST['back_options']) ?? [];
//     $loggedin = checkIsLoggedin();
//     update_lastactive();
//     $user_id = $loggedin['user_id'];
//     $backgrounds = [];
//     $backgroundOptions = [];
//     foreach ($backs as $main) {
//         array_push($backgrounds, '(' . $user_id . ',' . $main . ')');
//     }
//     $u_c_back = implode(',', $backgrounds);
//     foreach ($background_options as $background_option) {
//         if (in_array(parent_culture($background_option), $backs)) {
//             array_push($backgroundOptions, '(' . $user_id . ',' . parent_culture($background_option) . ',' . $background_option . ')');
//         }
//     }
//     $u_c_backopt = implode(',', $backgroundOptions);
//     $userBackg = ORM::for_table($config['db']['pre'] . 'user_cultural_backgrounds')->where('user_id', $user_id)->find_array();
//     if (count($userBackg)) {
//         ORM::for_table($config['db']['pre'] . 'user_cultural_backgrounds')->where_equal('user_id', $user_id)->delete_many();
//     }
//     ORM::raw_execute('INSERT INTO ' . $config['db']['pre'] . 'user_cultural_backgrounds (user_id,cultural_background_id) VALUES' . $u_c_back . '');
//     ORM::raw_execute('INSERT INTO ' . $config['db']['pre'] . 'user_cultural_backgrounds (user_id,cultural_background_id,cultural_background_option_id) VALUES' . $u_c_backopt . '');
//     $status_code = HTTP_OK;
//     $status = $lang['SUCCESS'];
//     $message = $lang['CULTURAL_BACKGROUNDS_UPDATED'];
//     $cultural_background = get_cultural_background($user_id);

//     $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'cultural_background' => $cultural_background];
//     send_json($results);
//     die();
// }

function get_skill_list()
{
    global $config, $lang;
    $skills = ORM::for_table($config['db']['pre'] . 'user_skills')->find_array();
    $skill_data = [];
    foreach ($skills as $skill) {
        if (!in_array(strtolower($skill['skill']), $skill_data)) {
            array_push($skill_data, strtolower($skill['skill']));
        }
    }
    $results = ['status_code' => HTTP_OK, 'status' => $lang['SUCCESS'], 'message' => $lang['SUCCESS'], 'skills' => $skill_data];
    send_json($results);
    die();
}

function getUserSkills()
{
    global $lang, $status, $status_code, $message, $results;
    $user_skills = array();
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $user_skills = get_user_skills($user_id);
    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];
    $message = $lang['SUCCESS'];
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'user_skills' => $user_skills];
    send_json($results);
    die();
}

function all_skill_level()
{
    global $lang;
    $levels = getLevels();
    $results = ['status_code' => HTTP_OK, 'status' => $lang['SUCCESS'], 'levels' => $levels];
    send_json($results);
}

function set_user_skills()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = 0;
    $user_skills_data = [];
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];

    $post_data = json_decode($_REQUEST['skill'], true) ?? [];
    if (empty($post_data)) {
        $errors++;
        $message = $lang['SKILL_REQ'];
    }

    if ($errors == 0) {
        $user_skills = get_user_skills($user_id);
        $u_posted_ids = array_map(function ($skill) {
            return $skill['id'];
        }, $post_data);
        foreach (array_column($user_skills, 'id') as  $id) {
            if (!in_array($id, $u_posted_ids)) {
                $d = ORM::for_table($config['db']['pre'] . 'user_skills')->where(['user_id' => $user_id, 'id' => $id])->find_one();
                $d->delete();
            }
        }
        foreach ($post_data as $key => $skill) {
            if (!empty($skill['id'])) {
                $u_skill = ORM::for_table($config['db']['pre'] . 'user_skills')->where(['user_id' => $user_id, 'id' => $skill['id']])->find_one();
                if ($u_skill) {
                    $u_skill->set(['skill' => $skill['skill'], 'level' => $skill['level']]);
                    $u_skill->save();
                }
            } else {
                $insert_skill = ORM::for_table($config['db']['pre'] . 'user_skills')->create();
                $insert_skill->user_id = $user_id;
                $insert_skill->skill = $skill['skill'];
                $insert_skill->level = $skill['level'];
                $insert_skill->save();
            }
        }
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $message;
    }
    $user_skills_data = get_user_skills($user_id);

    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'user_skills' => $user_skills_data];
    send_json($results);
    die();
}

function profile_language_list()
{
    global $lang;
    $all_language = user_languages();
    $results = ['status_code' => HTTP_OK, 'status' => $lang['SUCCESS'], 'message' => $lang['SUCCESS'], 'languages' => $all_language];
    send_json($results);
    die();
}

function getUserProfileLanguages()
{
    global $lang, $status, $status_code, $message, $results;
    $user_languages = array();
    $only_ids = isset($_REQUEST['only_ids']) ? true : false;
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $user_languages = user_languages($user_id, $only_ids);
    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];
    $message = $lang['SUCCESS'];

    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'user_languages' => $user_languages];
    send_json($results);
    die();
}

// function set_user_profile_language()
// {
//     global $config, $lang, $status, $status_code, $message, $results;
//     $errors = 0;
//     $user_language_data = [];
//     $loggedin = checkIsLoggedin();
//     update_lastactive();
//     $user_id = $loggedin['user_id'];

//     $user_language_data = user_languages($user_id);
//     $m_langs = json_decode($_REQUEST['language']);
//     $user_main_lang_ids = array_column($user_language_data, 'language_id');
//     foreach ($user_main_lang_ids as $lang_id) {
//         if (!in_array($lang_id, $m_langs)) {
//             $ml = ORM::for_table($config['db']['pre'] . 'user_languages')->where(['user_id' => $user_id, 'language_id' => $lang_id])->find_one();
//             $ml->delete();
//         }
//     }
//     foreach ($m_langs as $key => $m_lang) {
//         $exist = ORM::for_table($config['db']['pre'] . 'user_languages')->where(['user_id' => $user_id, 'language_id' => $m_lang])->find_one();
//         if (!$exist) {
//             $u_m_lang = ORM::for_table($config['db']['pre'] . 'user_languages')->create();
//             $u_m_lang->user_id = $user_id;
//             $u_m_lang->language_id  = $m_lang;
//             $u_m_lang->save();
//         }
//     }
//     $user_language_data = user_languages($user_id);
//     $status_code = HTTP_OK;
//     $status = $lang['SUCCESS'];
//     $message = $lang['SUCCESS'];

//     $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'user_languages' => $user_language_data];
//     send_json($results);
//     die();
// }

function religion_list()
{
    global $lang;
    $all_religion = get_religion();
    $results = ['status_code' => HTTP_OK, 'status' => $lang['SUCCESS'], 'message' => $lang['SUCCESS'], 'religions' => $all_religion];
    send_json($results);
    die();
}

function get_user_religion()
{
    global $lang, $status, $status_code, $message, $results;

    $user_religion_data = [];
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $only_ids = isset($_REQUEST['only_ids']) ? true : false;
    $user_religion_data = get_religion($user_id, $only_ids);
    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];
    $message = $lang['SUCCESS'];
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'user_religions' => $user_religion_data];
    send_json($results);
    die();
}

// function set_user_religion()
// {
//     global $config, $lang, $status, $status_code, $message, $results;
//     $errors = 0;
//     $user_religion_data = [];
//     $loggedin = checkIsLoggedin();
//     update_lastactive();
//     $user_id = $loggedin['user_id'];

//     $userReligion = get_religion($user_id);
//     $userReligionIds = array_column($userReligion, 'religion_id');
//     $rel = json_decode($_REQUEST['religion']);
//     if (empty($rel)) {
//         $errors++;
//         $message = $lang['RELIGIONREQ'];
//     }
//     if ($errors == 0) {
//         foreach ($userReligionIds as $rel_id) {
//             if (!in_array($rel_id, $rel)) {
//                 $rl = ORM::for_table($config['db']['pre'] . 'user_religions')->where(['user_id' => $user_id, 'religion_id' => $rel_id])->find_one();
//                 $rl->delete();
//             }
//         }
//         foreach ($rel as $key => $r) {
//             $exist = ORM::for_table($config['db']['pre'] . 'user_religions')->where(['user_id' => $user_id, 'religion_id' => $r])->find_one();
//             if (!$exist) {
//                 $u_rel = ORM::for_table($config['db']['pre'] . 'user_religions')->create();
//                 $u_rel->user_id = $user_id;
//                 $u_rel->religion_id  = $r;
//                 $u_rel->save();
//             }
//         }
//         $status_code = HTTP_OK;
//         $status = $lang['SUCCESS'];
//         $message = $lang['RELIGION_UPDATED'];
//     } else {
//         $status_code = HTTP_UNPROCESSABLE_ENTITY;
//         $status = $lang['ERROR'];
//         $message = $message;
//     }
//     $user_religion_data = get_religion($user_id);

//     $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'user_religions' => $user_religion_data];
//     send_json($results);
//     die();
// }

function interest_and_hobbies_list()
{
    global $lang;
    $interest_and_hobbies  = interest_and_hobbies();
    $results = ['status_code' => HTTP_OK, 'status' => $lang['SUCCESS'], 'message' => $lang['SUCCESS'], 'interests' => $interest_and_hobbies];
    send_json($results);
    die();
}

function getUserInterestHobbies()
{
    global $lang, $status, $status_code, $message, $results;
    $interest_and_hobbies = array();
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $interest_and_hobbies = interest_and_hobbies($user_id);
    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];
    $message = $lang['SUCCESS'];
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'interest_and_hobbies' => $interest_and_hobbies['interest'], 'other_interests' => $interest_and_hobbies['others']];
    send_json($results);
    die();
}

// function set_user_interest()
// {
//     global $config, $lang, $status, $status_code, $message, $results;
//     $errors = 0;
//     $user_interest = [];
//     $loggedin = checkIsLoggedin();
//     update_lastactive();
//     $user_id = $loggedin['user_id'];
//     $interest = json_decode($_REQUEST['interest']) ?? [];

//     $userInterest = ORM::for_table($config['db']['pre'] . 'user_interests')->select('interest_id')->where(['user_id' => $user_id])->where_raw('interest_id != 0')->find_array();
//     $userInterestIds = array_column($userInterest, 'interest_id');
//     foreach ($userInterestIds as $inte_id) {
//         if (!in_array($inte_id, $interest)) {
//             $rl = ORM::for_table($config['db']['pre'] . 'user_interests')->where(['user_id' => $user_id, 'interest_id' => $inte_id])->find_one();
//             $rl->delete();
//         }
//     }
//     foreach ($interest as $key => $r) {
//         $exist = ORM::for_table($config['db']['pre'] . 'user_interests')->where(['user_id' => $user_id, 'interest_id' => $r])->find_one();

//         if (!$exist) {
//             $u_inte = ORM::for_table($config['db']['pre'] . 'user_interests')->create();
//             $u_inte->user_id = $user_id;
//             $u_inte->interest_id = $r;
//             $u_inte->save();
//         }
//     }

//     //Other interest Section
//     $other_interest = (isset($_REQUEST['otherinterest']) && !empty($_REQUEST['otherinterest'])) ? $_REQUEST['otherinterest'] : '';
//     $other_interest = json_decode($other_interest, true) ?? [];
//     if (!empty($other_interest)) {
//         $user_other_data = ORM::for_table($config['db']['pre'] . 'user_interests')->select_many('id', 'user_id', 'interest_id', 'others')->where(['user_id' => $user_id, 'interest_id' => '0'])->find_array();
//         $otherIntrest = array_column($user_other_data, 'others');
//         foreach ($otherIntrest as $otherId) {
//             if (!in_array($otherId, $other_interest)) {
//                 $o_interest = ORM::for_table($config['db']['pre'] . 'user_interests')->where(['user_id' => $user_id, 'others' => $otherId])->find_one();
//                 $o_interest->delete();
//             }
//         }
//         foreach ($other_interest as  $o_interest) {
//             $exist_other = ORM::for_table($config['db']['pre'] . 'user_interests')->where(['user_id' => $user_id, 'others' => $o_interest])->find_one();
//             if (!$exist_other) {
//                 $u_inte = ORM::for_table($config['db']['pre'] . 'user_interests')->create();
//                 $u_inte->user_id = $user_id;
//                 $u_inte->interest_id = '0';
//                 $u_inte->others = $o_interest;
//                 $u_inte->save();
//             }
//         }
//     } else {
//         ORM::for_table($config['db']['pre'] . 'user_interests')->where(['user_id' => $user_id])->where_not_null('others')->delete_many();
//     }
//     $status_code = HTTP_OK;
//     $status = $lang['SUCCESS'];
//     $message = $lang['SUCCESS'];
//     $user_interest = interest_and_hobbies($user_id);

//     $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'user_interest' => $user_interest];
//     send_json($results);
//     die();
// }

function get_user_preferences()
{
    global $lang, $status, $status_code, $message, $results;
    $user_preferences = array();
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $user_preferences = get_preferences($user_id);
    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];
    $message = $lang['SUCCESS'];
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'user_preferences' => $user_preferences];
    send_json($results);
    die();
}

function set_user_preferences()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $user_preferences = [];
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $user_preference = ORM::for_table($config['db']['pre'] . 'user_preferences')->select_many('preference_id', 'preference_option_id')->where('user_id', $user_id)->where_raw('NOT(preference_id <=> NULL)')->find_array();
    $user_preference_option_ids = array_column($user_preference, 'preference_option_id');
    $preference_options = json_decode($_REQUEST['option'], true) ?? [];
    foreach ($preference_options as $key => $options) {
        foreach ($user_preference_option_ids as $pre_opt_id) {
            if (!in_array($pre_opt_id, $options)) {
                $data = ORM::for_table($config['db']['pre'] . 'user_preferences')->where(['user_id' => $user_id, 'preference_id' => $key, 'preference_option_id' => $pre_opt_id])->find_one();
                if ($data) {
                    $data->delete();
                }
            }
        }
        foreach ($options as  $value) {
            $pre_data = ORM::for_table($config['db']['pre'] . 'user_preferences')->where(['user_id' => $user_id, 'preference_option_id' => $value])->find_one();
            if (!$pre_data) {
                $pre_insert = ORM::for_table($config['db']['pre'] . 'user_preferences')->create();
                $pre_insert->user_id = $user_id;
                $pre_insert->preference_id = $key;
                $pre_insert->preference_option_id = $value;
                $pre_insert->created_at = date('Y-m-d H:i:s');
                $pre_insert->save();
            }
        }
    }
    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];
    $message = $lang['SUCCESS'];
    $user_preferences = get_preferences($user_id);
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'preferences' => $user_preferences];
    send_json($results);
    die();
}
function get_user_aboutme()
{
    global $lang, $status, $status_code, $message, $results;
    $about_me = array();
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $about_me = get_about_me($user_id);
    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];
    $message = $lang['SUCCESS'];
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'user_aboutme' => $about_me];
    send_json($results);
    die();
}

function set_user_aboutme()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = 0;
    $user_about_me = [];
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $option_data = json_decode($_REQUEST['option'], true) ?? [];
    foreach ($option_data as $key => $value) {
        $user_about_v = ORM::for_table($config['db']['pre'] . 'user_about_mes')->where(['user_id' => $user_id, 'about_me_id' => $key])->find_one();
        if ($user_about_v) {
            $user_about_v->about_me_option_id = $value;
            $user_about_v->save();
        } else {
            $user_about_v = ORM::for_table($config['db']['pre'] . 'user_about_mes')->create();
            $user_about_v->user_id = $user_id;
            $user_about_v->about_me_id = $key;
            $user_about_v->about_me_option_id = $value;
            $user_about_v->save();
        }
    }
    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];
    $message = $lang['SUCCESS'];
    $user_about_me = get_about_me($user_id);

    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'user_aboutme' => $user_about_me];
    send_json($results);
    die();
}

function get_user_educations()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $eduactions = [];
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];

    $education_id = isset($_REQUEST['education_id']) ? $_REQUEST['education_id'] : null;
    if ($education_id != null) {

        $eduactions = user_educations($user_id, $education_id);
    } else {
        $eduactions = user_educations($user_id);
    }
    $message = empty($eduactions) ? $lang['NOT_FOUND'] : $lang['SUCCESS'];
    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];

    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'total' => $eduactions['total'], 'educations' => $eduactions['items']];
    send_json($results);
    die();
}

function set_user_education()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = 0;
    $educations = [];
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];

    if (empty($_REQUEST['institution']) || empty($_REQUEST['course']) || empty($_REQUEST['start_date'])) {
        $errors++;
        $message = $lang['ALL_FIELDS_REQ'];
    }
    $start_date = date("Y-m-d", strtotime($_POST['start_date']));
    $end_date = null;
    if (!empty($_REQUEST['end_date'])) {
        $end_date = date("Y-m-d", strtotime($_REQUEST['end_date']));
        if ($end_date <= $start_date) {
            $errors++;
            $message = $lang['INVALID_END_DATE'];
        }
    } else {
        $_REQUEST['currently_working'] = '1';
    }

    if ($errors == 0) {
        if (!empty($_REQUEST['id'])) {
            $education_update = ORM::for_table($config['db']['pre'] . 'educations')
                ->where('id', $_REQUEST['id'])
                ->where('user_id', $user_id)
                ->find_one();
            $education_update->set('institution', $_REQUEST['institution']);
            $education_update->set('course', $_REQUEST['course']);
            $education_update->set('start_date', $start_date);
            $education_update->set('end_date', $end_date);
            $education_update->set('currently_working', $_REQUEST['currently_working']);
            $education_update->save();
        } else {
            $education = ORM::for_table($config['db']['pre'] . 'educations')->create();
            $education->user_id = $user_id;
            $education->institution = $_REQUEST['institution'];
            $education->course = $_REQUEST['course'];
            $education->start_date = $start_date;
            $education->end_date = $end_date;
            $education->currently_working = $_REQUEST['currently_working'];
            $education->save();
        }
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = 'Added Successfully';
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $message;
    }
    $educations = user_educations($user_id);

    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'total' => $educations['total'], 'educations' => $educations['items']];
    send_json($results);
    die();
}

function remove_user_education()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = 0;
    $educations = [];
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];

    $education_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

    $education = ORM::for_table($config['db']['pre'] . 'educations')
        ->where('id', $education_id)
        ->where('user_id', $user_id)
        ->find_one();
    if ($education && !empty($education_id)) {
        $education->delete();
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['EDUCATION_DELETED'];
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['INVALID_ID'];
    }
    $educations = user_educations($user_id);

    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'educations' => $educations];
    send_json($results);
    die();
}

function get_user_experiences()
{
    global $lang, $status, $status_code, $message, $results;
    $experiences = [];
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $experience_id = isset($_REQUEST['experience_id']) ? $_REQUEST['experience_id'] : null;
    if ($experience_id != null) {
        $experiences = user_experiences($user_id, $experience_id);
    } else {
        $experiences = user_experiences($user_id);
    }
    $message = empty($experiences) ? $lang['NOT_FOUND'] : $lang['SUCCESS'];
    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];

    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'total' => $experiences['total'], 'experiences' => $experiences['items']];
    send_json($results);
    die();
}

function set_user_experience()
{
    //dd($_REQUEST);
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = 0;
    $experiences = [];
    // dd($post_data);
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];

    // dd($errors);

    if (!empty($_REQUEST['id'])) {
        if (empty($_REQUEST['title']) || empty($_REQUEST['phone']) || empty($_REQUEST['email']) || empty($_REQUEST['description']) || empty($_REQUEST['start_date'])) {
            $errors++;
            $message = $lang['ALL_FIELDS_REQ'];
        }
        if ($errors == 0) {
            if ($_REQUEST['currently_working'] == '1') {
                $experience_update = ORM::for_table($config['db']['pre'] . 'experiences')
                    ->where('user_id', $user_id)
                    ->find_many();
                $experience_update->set('currently_working', '0');
                $experience_update->save();
            }

            $experience_create = ORM::for_table($config['db']['pre'] . 'experiences')
                ->where('id', $_REQUEST['id'])
                ->where('user_id', $user_id)
                ->find_one();

            $experience_create->set('title', $_REQUEST['title']);
            $experience_create->set('phone', $_REQUEST['phone']);
            $experience_create->set('email', $_REQUEST['email']);
            $experience_create->set('description', $_REQUEST['description']);
            $experience_create->set('start_date', date("Y-m-d", strtotime($_REQUEST['start_date'])));
            $experience_create->set('end_date', date("Y-m-d", strtotime($_REQUEST['end_date'])));
            $experience_create->set('currently_working', $_REQUEST['currently_working']);
            $experience_create->save();
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = 'Updated Successfully';
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            //$message = 'Not Updated';
        }
    } else {
        $post_data = json_decode($_REQUEST['references'], true) ?? [];
        foreach ($post_data as $ref) {
            if ($ref['currently_working'] == '1') {
                $experience_update = ORM::for_table($config['db']['pre'] . 'experiences')
                    ->where('user_id', $user_id)
                    ->find_many();
                $experience_update->set('currently_working', '0');
                $experience_update->save();
            }
            $experiences = ORM::for_table($config['db']['pre'] . 'experiences')->create();
            $experiences->user_id = $user_id;
            $experiences->title = $ref['title'];
            $experiences->phone = $ref['phone'];
            $experiences->email = $ref['email'];
            $experiences->description = $ref['description'];
            $experiences->start_date = date("Y-m-d", strtotime($ref['start_date']));
            $experiences->end_date = date("Y-m-d", strtotime($ref['end_date']));
            $experiences->currently_working = $ref['currently_working'];
            $experiences->save();
        }
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = 'Added Successfully';
    }

    $experiences = user_experiences($user_id);
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'total' => $experiences['total'], 'experiences' => $experiences['items']];
    send_json($results);
    die();
}

function remove_user_experience()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = 0;
    $experiences = [];
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $experience_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
    $experience = ORM::for_table($config['db']['pre'] . 'experiences')
        ->where('id', $experience_id)
        ->where('user_id', $user_id)
        ->find_one();
    if ($experience && !empty($experience_id)) {
        $experience->delete();
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['EXPERIENCE_DELETED'];
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['INVALID_ID'];
    }
    $experiences = user_experiences($user_id);

    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'experiences' => $experiences];
    send_json($results);
    die();
}

function user_custom_field_list()
{
    global $lang;
    $fields = array_values(get_user_customFields());
    $results = ['status_code' => HTTP_OK, 'status' => $lang['SUCCESS'], 'message' => $lang['SUCCESS'], 'fields' => $fields];
    send_json($results);
    die();
}

function getUserCustomFields()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $custom_fields = array();
    $custom_data = array();
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];

    $customdata = ORM::for_table($config['db']['pre'] . 'user_custom_data')
        ->select_many('field_id', 'field_data')
        ->where('user_id', $user_id)
        ->find_many();
    foreach ($customdata as $array) {
        $custom_fields[] = $array['field_id'];
        $custom_data[] = $array['field_data'];
    }
    $custom_fields = get_user_customFields(true, $custom_fields, $custom_data);
    foreach ($custom_fields as $key => $value) {
        if (isset($value['userent'])) {
            $custom_db_fields[$value['id']] = $value['title'];
            $custom_db_data[$value['id']] = str_replace(',', '&#44;', $value['default']);
        }
    }
    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];
    $message = $lang['SUCCESS'];

    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'user_custom_fields' => array_values($custom_fields)];
    send_json($results);
    die();
}

function setUserCustomFields()
{
    global $lang, $status, $status_code, $message, $results;
    $custom_fields = [];
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];

    $_REQUEST['custom'] = json_decode($_REQUEST['custom'], true)[0];
    add_post_user_customField_data($user_id);
    $custom_fields = get_user_customFields($user_id);
    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];
    $message = $lang['SUCCESS'];

    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'user_custom_fields' => array_values($custom_fields)];
    send_json($results);
    die();
}

function getUserImmunisationInfo()
{
    global $lang, $status, $status_code, $message, $results;
    $immunisation_info = [];
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $immunisation_info = get_user_immunisation_info($user_id);
    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];
    $message = $lang['SUCCESS'];
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'immunisation_info' => $immunisation_info];
    send_json($results);
    die();
}

function setUserImmunisationInfo()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $immunisation_info = [];

    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $error = 0;
    $is_vaccinated = $_REQUEST['is_vaccinated'] ? $_REQUEST['is_vaccinated'] : '0';
    $immunisation_date = $_REQUEST['recent_immunisation_date'] ?? null;
    $is_flu_vaccinated = $_REQUEST['is_flu_vaccinated'] ?? '0';
    $filename = $certificate_file = '';
    $immunisation_info = [];
    $user_immu_info = ORM::for_table($config['db']['pre'] . 'user_immunisation_info')->where('user_id', $user_id)->find_one();

    if ($is_vaccinated != '0') {

        if (empty($immunisation_date)) {
            $error++;
            $message = $lang['IMMUNISATION_DATE_REQ'];
        } else {
            $immunisation_date = date('Y-m-d', strtotime($immunisation_date));
        }
        if (empty($_FILES['covid_certificate']['name'])) {
            $error++;
            $message = $lang['CERTIFICATE_REQ'];
        }
    }
    if ($error == 0) {
        if (!empty($_FILES['covid_certificate']['name'])) {
            $file = $_FILES['covid_certificate'];
            // Valid formats
            $resume_files = trim(get_option("resume_files"));
            $valid_formats = explode(',', $resume_files);
            $filename = $file['name'];
            $ext = getExtension($filename);
            $ext = strtolower($ext);
            if (!empty($filename)) {
                //File extension check
                if (in_array($ext, $valid_formats)) {
                    $main_path = ROOTPATH . "/storage/covid-certificates/";
                    if (!is_dir($main_path)) {
                        mkdir($main_path, 0777);
                    }
                    $filename = uniqid(time()) . '.' . $ext;

                    if (move_uploaded_file($file['tmp_name'], $main_path . $filename)) {
                        $certificate_file = $filename;
                    } else {
                        $message = $lang['ERROR_TRY_AGAIN'];
                    }
                } else {
                    $error++;
                    $message = 'File type error';
                }
            } else {
                $error++;
                $message = $lang['CERTIFICATE_REQ'];
            }
        }
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $message;
    }

    if ($error == 0) {
        $now = date("Y-m-d H:i:s");

        if (!$user_immu_info) {
            $user_immu_info = ORM::for_table($config['db']['pre'] . 'user_immunisation_info')->create();
            $user_immu_info->user_id = $user_id;
            $user_immu_info->is_vaccinated = $is_vaccinated;
            $user_immu_info->recent_immunisation_date = $immunisation_date;
            if (!empty($filename)) {
                $user_immu_info->certificate_file = $certificate_file;
            }
            $user_immu_info->is_flu_vaccinated = $is_flu_vaccinated;
            $user_immu_info->status = 'not verified';
            $user_immu_info->created_at  = $now;
            $user_immu_info->updated_at  = $now;
            $user_immu_info->save();
        } else {

            if (!empty($filename)) {

                $old_path = $user_immu_info['certificate_file'];

                $file = ROOTPATH . "/storage/covid-certificates/" . $old_path;

                if (file_exists($file))
                    unlink($file);
                $user_immu_info->set('certificate_file', $certificate_file);
            }
            $user_immu_info->set('is_vaccinated', $is_vaccinated);
            $user_immu_info->set('recent_immunisation_date', $immunisation_date);
            $user_immu_info->set('is_flu_vaccinated', $is_flu_vaccinated);
            $user_immu_info->set('status', 'not verified');
            $user_immu_info->set('updated_at', $now);
            $user_immu_info->save();
        }

        $immunisation_info = $user_immu_info->as_array();
        $immunisation_info['certificate_file'] = $config['site_url'] . 'storage/covid-certificates/' . $immunisation_info['certificate_file'];

        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $message;
    }

    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'immunisation_info' => $immunisation_info];
    send_json($results);
    die();
}

function applyToJob()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = [];
    $resume_id = null;
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $job_id = (isset($_REQUEST['job_id']) && !empty($_REQUEST['job_id'])) ? $_REQUEST['job_id'] : null;
    $msg = (isset($_REQUEST['message']) && !empty($_REQUEST['message'])) ? $_REQUEST['message'] : "";
    if ($job_id != null) {
        $job_data = ORM::for_table($config['db']['pre'] . 'product')->find_one($job_id);
        if (!empty($job_data)) {
            if ($job_data['status'] != 'active') {
                $message = $lang['NOT_ACTIVE_JOB'];
                $results = ['status_code' => HTTP_UNPROCESSABLE_ENTITY, 'status' => $lang['ERROR'], 'message' => $message, 'auth_token' => $loggedin['auth_token']];
                send_json($results);
                die();
            } else {
                $is_applied = ORM::for_table($config['db']['pre'] . 'user_applied')->where(['user_id' => $user_id, 'job_id' => $job_id])->find_one();
                if ($is_applied) {

                    $applied = true;
                    $message  = $lang['ALREADY_APPLIED'];
                } else {
                    if ($config['resume_enable']) {
                        $resume_id = isset($_REQUEST['resume']) ? $_REQUEST['resume'] : 0;
                        if (isset($_REQUEST['resume'])) {
                            if ($_REQUEST['resume'] == 0 && empty($_FILES['resume_file']['name'])) {
                                $errors['resume_error'] =  $lang['RESUME_REQ'];
                            }
                        } else {
                            $errors['resume_error'] =  $lang['RESUME_REQ'];
                        }
                        if (!count($errors) > 0) {
                            if ($_REQUEST['resume'] == 0) {
                                // save resume
                                $resume_file = '';
                                $file = $_FILES['resume_file'];
                                // Valid formats
                                $resume_files = trim(get_option("resume_files"));
                                $valid_formats = explode(',', $resume_files);
                                $filename = $file['name'];
                                $ext = getExtension($filename);
                                $ext = strtolower($ext);

                                if (!empty($filename)) {
                                    //File extension check
                                    if (in_array($ext, $valid_formats)) {
                                        $main_path = ROOTPATH . "/storage/resumes/";
                                        $filename = uniqid(time()) . '.' . $ext;
                                        if (move_uploaded_file($file['tmp_name'], $main_path . $filename)) {
                                            $resume_file = $filename;
                                        } else {
                                            $errors['resume_error'] = $lang['ERROR_TRY_AGAIN'];
                                        }
                                    } else {
                                        $errors['resume_error'] = $lang['RESUME_FILE_TYPE'];
                                    }
                                }

                                if (!count($errors) > 0) {
                                    $now = date("Y-m-d H:i:s");
                                    $resume_create = ORM::for_table($config['db']['pre'] . 'resumes')->create();
                                    $resume_create->name = date('Y-m-d-h-i');
                                    $resume_create->filename = $resume_file;
                                    $resume_create->user_id = $user_id;
                                    $resume_create->created_at = $now;
                                    $resume_create->updated_at = $now;
                                    $resume_create->save();

                                    $resume_link = $config['site_url'] . "storage/resumes/" . $resume_file;
                                    $resume_id = $resume_create->id();
                                }
                            } else {
                                $result = ORM::for_table($config['db']['pre'] . 'resumes')
                                    ->where('user_id', $user_id)
                                    ->where('id', $_REQUEST['resume'])
                                    ->where('active', '1')
                                    ->find_one();

                                if (!empty($result)) {
                                    $resume_link = $config['site_url'] . "storage/resumes/" . $result['filename'];
                                    $resume_id = $_REQUEST['resume'];
                                } else {
                                    $errors['resume_error'] =  $lang['RESUME_REQ'];
                                }
                            }
                        }
                    }
                    if (!count($errors) > 0) {
                        $apply = ORM::for_table($config['db']['pre'] . 'user_applied')->create();
                        $apply->user_id = $user_id;
                        $apply->job_id = $job_id;
                        $apply->message = $msg;
                        $apply->resume_id = $resume_id;
                        $apply->created_at = date('Y-m-d H:i:s');
                        if ($apply->save()) {
                            $applied = true;
                            $message  = $lang['JOB_APPLIED'];

                            // Send Notification Funtion 
                            $notification = "false";
                            $user_data = get_user_data(null, $user_id);
                            $userfullname = !empty($user_data['name']) ?  $user_data['name'] : $user_data['username'];
                            $client = get_product_post_client($job_id);
                            $reciver_id =  $client['user_id'];
                            $product_name =  $client['product_name'];
                            $check_notification = get_user_notification_type_new($reciver_id);
                            if (!empty($check_notification) && array_key_exists("job_applied", $check_notification)) {
                                if ($check_notification['job_applied'] == "1") {
                                    $notification = "true";
                                }
                            } else {
                                $notification = "true";
                            }
                            if ($notification == "true") {
                                $notify_data = [
                                    'recepient_id' => $reciver_id,
                                    'sender_id' => $user_id,
                                    'reference_id' => $job_id,
                                    'type' =>  'job_applied'
                                ];
                                insert_notification($notify_data);
                                $title = 'New job Applicant!';
                                $msg = ucfirst($userfullname) . ' has applied for job #' . $product_name . '.';
                                $other_data = ['reference_id' => $job_id, 'action_type' => 'job_applied'];
                                $resp = sendFCM($msg, $reciver_id, $title, $other_data);
                            }
                        } else {
                            $applied = false;
                            $message  = $lang['FAILED'];
                        }
                    } else {
                        $applied = false;
                        $message = $message;
                    }
                }
                if ($applied) {

                    $status_code = HTTP_OK;
                    $status  = $lang['SUCCESS'];
                } else {
                    $status_code = HTTP_UNPROCESSABLE_ENTITY;
                    $status  = $lang['ERROR'];
                    $message  = $lang['FAILED'];
                }
            }
        } else {
            $message = $lang['NO_JOBS_FOUND'];
            $results = ['status_code' => HTTP_UNPROCESSABLE_ENTITY, 'status' => $lang['ERROR'], 'message' => $message, 'auth_token' => $loggedin['auth_token']];
            send_json($results);
            die();
        }
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status  = $lang['ERROR'];
        $message  = $lang['JOB_ID_REQ'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'errors' => $errors];
    send_json($results);
    die();
}

function search_cities()
{
    global $lang, $config, $status_code, $status, $message, $results;
    $MyCity = array();
    $total = 0;
    $dataString = isset($_GET['q']) ? $_GET['q'] : "";
    $sortname = check_user_country();
    if (strlen($dataString) < 2) {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = 'Please enter at least 2 characters';
    } else {
        $total = ORM::for_table($config['db']['pre'] . 'cities')
            ->where(array(
                'country_code' =>   $sortname,
                'active' => 1
            ))
            ->where_like('asciiname', '' . $dataString . '%')
            ->count();

        $sql = "SELECT c.id, c.asciiname, c.latitude, c.longitude, c.subadmin1_code, s.name AS statename
                FROM `" . $config['db']['pre'] . "cities` AS c
                INNER JOIN `" . $config['db']['pre'] . "subadmin1` AS s ON s.code = c.subadmin1_code and s.active = 1
                WHERE (c.name like '%$dataString%' or c.asciiname like '%$dataString%') and c.country_code = '$sortname' and c.active = 1
                ORDER BY
                CASE
                    WHEN c.name = '$dataString' THEN 1
                    WHEN c.name LIKE '$dataString%' THEN 2
                    ELSE 3
                END ";
        // $query =  $sql . " limit " . $start . "," . $perPage;
        $query = $sql;
        $pdo = ORM::get_db();
        $rows = $pdo->query($query);
        if (empty($_GET["rowcount"])) {
            $pdo = ORM::get_db();
            $result = $pdo->query($sql);
            $_GET["rowcount"] = $rowcount = $result->rowCount();
        }
        // $pages  = ceil($_GET["rowcount"] / $perPage);
        $i = 0;
        foreach ($rows as $row) {
            $cityid = $row['id'];
            $cityname = $row['asciiname'];
            $latitude = $row['latitude'];
            $longitude = $row['longitude'];
            $statename = $row['statename'];

            $MyCity[$i]["id"]   = $cityid;
            $MyCity[$i]["text"] = $cityname . ", " . $statename;
            $MyCity[$i]["latitude"]   = $latitude;
            $MyCity[$i]["longitude"]   = $longitude;
            $i++;
        }
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['SUCCESS'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'items' => $MyCity, 'totalEntries' => $total];
    send_json($results);
    die();
}

function get_agreement_data()
{
    global $config, $lang, $status, $status_code, $message, $results, $con;
    $replied = 0;
    $agreement_data = $ac_feed_array = [];
    $post_id = null;
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $rate_arr = [];

    $chat_user_id = $_REQUEST['chat_user_id'];
    $ses_user_data = ORM::for_table($config['db']['pre'] . 'user')->find_one($user_id)->as_array();
    $chat_user_data = ORM::for_table($config['db']['pre'] . 'user')->select_many('id', 'name', 'username', 'user_type', 'email', 'dob', 'sex', 'address', 'country', 'city', 'city_code', 'state_code', 'country_code', 'image')->find_one($chat_user_id)->as_array();
    $chat_fullname = ($chat_user_data['name'] != '') ? $chat_user_data['name'] : $chat_user_data['username'];
    $user_type =  $ses_user_data['user_type'];
    $sql = "select * from `" . $config['db']['pre'] . "messages` where ((from_id = '" . mysqli_real_escape_string($con, $user_id) . "' AND to_id = '" . mysqli_real_escape_string($con, $chat_user_id) . "') OR (to_id = '" . mysqli_real_escape_string($con, $user_id) . "' AND from_id = '" . mysqli_real_escape_string($con, $chat_user_id) . "')) AND post_id IS NOT NULL AND message_type='html' order by message_id DESC limit 1";
    $initiated_msg = ORM::for_table($config['db']['pre'] . 'messages')->raw_query($sql)->find_one();
    if ($initiated_msg) {
        $post_id = $initiated_msg['post_id'];
        $job_data = ORM::for_table($config['db']['pre'] . 'product')->select_many('id', 'product_name', 'slug')->find_one($post_id);
        if ($initiated_msg['from_id'] == $user_id &&  $ses_user_data['user_type'] == 'employer' || ($initiated_msg['from_id'] != $user_id && $ses_user_data['user_type'] == 'employer')) {
            $applied = ORM::for_table($config['db']['pre'] . 'user_applied')->where(['user_id' => $chat_user_id, 'job_id' => $post_id])->find_one();
            $replied =  $applied ? 1 : 0;
        } else {
            $applied = ORM::for_table($config['db']['pre'] . 'user_applied')->where(['user_id' => $user_id, 'job_id' => $post_id])->find_one();
            $replied =  $applied ? 1 : 0;
        }

        if ($user_type == 'user') {
            $worker_id = $user_id;
        } else {
            $worker_id = $chat_user_id;
        }

        $agr_data = ORM::for_table($config['db']['pre'] . 'user_agreements')->where(['post_id' => $post_id, 'worker_id' => $worker_id])->where_null('deleted_at')->find_one();

        $activity_log = ORM::for_table($config['db']['pre'] . 'activity_log')
            ->where_like('log_name', '%agreement%')
            ->where('post_id', $post_id)
            ->where_raw('( `receiver_id` = ' . $user_id . ' OR `user_id`= ' . $user_id . ')')
            ->limit(5)->order_by_desc('id')->find_many();


        foreach ($activity_log as $key => $act_log) {
            if ($act_log['status'] == 'accepted') {
                $msg = sprintf(agreement_msg($act_log['status'], $user_type), $chat_fullname, $agr_data['id'] ?? '');
            } else {
                $msg = sprintf(agreement_msg($act_log['status'], $user_type), $chat_fullname);
            }
            $ac_feed_array[$key][] =  $msg;
        }
        if ($agr_data) {
            $agreed_rate = ORM::for_table($config['db']['pre'] . 'user_agreements_rates')->where('agreement_id', $agr_data['id'])->order_by_asc('id')->find_array();

            foreach ($agreed_rate as $rate) {
                $rate_to_pay = $rate['rate'] + ($rate['rate'] * (int)get_option('client_commission') / 100);
                $rate_arr[] = ['rate' => $rate['rate'], 'rate_to_pay' => $rate_to_pay, 'rate_type' => $rate['rate_type']];
            }
            if ($user_type == 'user') {
                $agreement_data = ['agreement_id' => $agr_data['id'], 'status' => $agr_data['status'], 'agreement_rates' => $rate_arr, 'worker_commission' => get_option('worker_commission')];
            } elseif ($user_type == 'employer') {
                $agreement_data = ['agreement_id' => $agr_data['id'], 'status' => $agr_data['status'], 'agreement_rates' => $rate_arr, 'client_commission' => get_option('client_commission')];
            }
        }
    }
    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];
    $message = $lang['SUCCESS'];
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'ses_user_data' => $ses_user_data, 'chat_user_data' => $chat_user_data, 'replied' => $replied, 'job_id' => $post_id, 'activity_feed' => $ac_feed_array, 'agreement_data' => $agreement_data, 'auth_token' => $loggedin['auth_token']];
    send_json($results);
    die();
}

function update_agreement_status()
{
    global $config, $lang;

    $loggedin = checkIsLoggedin();

    $user_id = $loggedin['user_id'];
    $userdata = get_user_data(null, $user_id);
    $fullname = !empty($userdata['name']) ? $userdata['name'] : $userdata['username'];
    $valid_id = $valid_status = false;
    $status =  $_REQUEST['status'];
    $agreement_id = isset($_REQUEST['agreement_id']) && !empty($_REQUEST['agreement_id']) ? $_REQUEST['agreement_id'] : null;
    if ($agreement_id == null) {
        $postid = isset($_REQUEST['job_id']) && !empty($_REQUEST['job_id']) ? $_REQUEST['job_id'] : null;
        $chat_user_id = isset($_REQUEST['chat_user_id']) && !empty($_REQUEST['chat_user_id']) ? $_REQUEST['chat_user_id'] : null;
        if ($postid == null ||  $chat_user_id == null)
            $valid_id = false;
        else
            $valid_id = true;
    } else {
        $valid_id = true;
    }
    if ($userdata['user_type'] == 'user' &&  in_array($status, ['sent', 'changed'])) {
        $valid_status = true;
    } elseif ($userdata['user_type'] == 'employer' && in_array($status, ['requested', 'accepted', 'declined'])) {
        $valid_status = true;
    }
    if ($valid_id && $valid_status) {
        $now = date('Y-m-d H:i:s');
        if ($agreement_id == null) {
            if ($userdata['user_type'] == 'employer') {
                $client_id = $user_id;
                $worker_id = $chat_user_id;
            } elseif ($userdata['user_type'] == 'user') {
                $client_id = $chat_user_id;
                $worker_id = $user_id;
            }
            $agr_data = ORM::for_table($config['db']['pre'] . 'user_agreements')->where(['post_id' => $postid, 'worker_id' => $worker_id])->find_one();
        } else {
            $agr_data = ORM::for_table($config['db']['pre'] . 'user_agreements')->where('id', $agreement_id)->find_one();
            $client_id =  $agr_data['client_id'];
            $worker_id = $agr_data['worker_id'];
            $postid  = $agr_data['post_id'];
        }

        if ($agr_data) {
            $agr_data->status = $status;
            $agr_data->updated_at = $now;
        } else {
            $agr_data = ORM::for_table($config['db']['pre'] . 'user_agreements')->create();
            $agr_data->post_id = $postid;
            $agr_data->client_id = $client_id;
            $agr_data->worker_id = $worker_id;
            $agr_data->status = $status;
            $agr_data->created_at = $now;
            $agr_data->updated_at = $now;
        }
        if ($agr_data->save()) {
            $msg = $title = '';
            $reference_id = $agr_data->id;
            $postid = $agr_data['post_id'];
            $product = get_product_post_client($postid);
            $job_title = $product['product_title'];

            if ($userdata['user_type'] == 'employer') {
                $receiver_id = $worker_id;
                if ($status == 'accepted') {
                    $type = 'agreement_accepted';
                    $msg = $fullname . ' has accepted your agreement on ' . $job_title;
                } elseif ($status == 'declined') {
                    $type = 'agreement_declined';
                    $msg = $fullname . ' has declined your agreement on ' . $job_title;
                } else {
                    $type = 'agreement_requested';
                    $msg = $fullname . ' has requested you agreement on ' . $job_title;
                }
            } else {
                $receiver_id = $client_id;
                if ($status == 'sent') {
                    $type = 'agreement_offer';
                    $msg = $fullname . ' has offer you an agreement on ' . $job_title;
                } elseif ($status == 'changed') {
                    $type = 'agreement_amended';
                    $msg = $fullname . ' has amended an agreement on ' . $job_title;
                }
            }

            // Send Notification Funtion 
            $notification = "false";
            $check_notification = get_user_notification_type_new($receiver_id);
            if (!empty($check_notification) && array_key_exists($type, $check_notification)) {
                if ($check_notification[$type] == "1") {
                    $notification = "true";
                }
            } else {
                $notification = "true";
            }

            if ($notification == "true") {
                $notify_data = [
                    'recepient_id' => $receiver_id,
                    'sender_id' => $user_id,
                    'reference_id' => $reference_id,
                    'type' =>  $type
                ];
                insert_notification($notify_data);

                /*To send FCM notification */
                $title =  ucwords(str_replace("_", " ", $type));
                $other_data = ['reference_id' => $reference_id, 'action_type' => $type];
                sendFCM($msg, $receiver_id, $title, $other_data);
            }
            $data = ['log_name' => 'agreement', 'status' => $status, 'receiver_id' => $receiver_id, 'post_id' => $postid];
            create_activity_log($data, $user_id);
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['UPDATED_SUCCESS'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['ERROR_TRY_AGAIN'];
        }
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['INVALID_ID'] . 'OR' . ['INVALID_STATUS'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token']];
    send_json($results);
    die();
}

function get_agreement_with_rates()
{
    global $lang, $status, $status_code, $message, $results;
    $agreement_data = $item = [];
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $agreement_id = $_REQUEST['agreement_id'];

    $userdata = get_user_data(null, $user_id);
    $user_type = $userdata['user_type'];
    $agr_data = getAgreementWithRates($agreement_id);
    $rate_to_pay = 0;
    $client_commission = (int)get_option('client_commission');
    $worker_commission = (int)get_option('worker_commission');
    $agreement_data =  $agr_data['agr_data'];
    foreach ($agr_data['rates'] as $key => $rate) {

        $item[$key]['description'] = ucfirst($rate['description']);
        $item[$key]['rate'] = ucfirst($rate['rate']);
        if ($user_type == 'employer') {
            $rate_to_pay = number_format($rate['rate'] + ($rate['rate'] * $client_commission / 100), 2, '.', '');
        } else {
            $rate_to_pay = number_format($rate['rate'] - ($rate['rate'] * $worker_commission / 100), 2, '.', '');
        }
        $item[$key]['rate_to_pay'] = $rate_to_pay;
        $item[$key]['rate_type'] = ucwords(str_replace('-', ' ', $rate['rate_type']));
    }
    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];
    $message = $lang['SUCCESS'];

    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'agreement_data' => $agreement_data, 'rates' => $item];
    send_json($results);
    die();
}

function save_agreement()
{
    global $lang, $status, $status_code, $message, $results, $config;
    $gareement_data = [];
    $loggedin = checkIsLoggedin();
    $user_id = $loggedin['user_id'];
    $_POST['post_id'] = $_REQUEST['post_id'];
    $_POST['client_id'] = $_REQUEST['client_id'];
    $_POST['status'] = $_REQUEST['status'];
    $_POST['rates'] = json_decode($_REQUEST['rates'], true);
    $_POST['agreed_services'] = $_REQUEST['agreed_services'];
    $_POST['info_sharing'] = $_REQUEST['info_sharing'];
    $agr_data = ORM::for_table($config['db']['pre'] . 'user_agreements')
        ->where(['post_id' => $_REQUEST['post_id'], 'client_id' => $_REQUEST['client_id'], 'worker_id' => $user_id])
        ->find_one();
    if (empty($agr_data)) {
        $resp = saveAgreementData($_POST, $user_id);
        if ($resp['status']) {
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['AGREEMENT_CREATED'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['SOMETHING_WENT_WRONG'];;
        }
        $agreement_id = $resp['agreement_id'];
        $gareement_data = getAgreementWithRates($agreement_id);
    } else {
        $status_code = HTTP_OK;
        $status = $lang['ERROR'];
        $message = $lang['DUPLICATE_AGREEMENT'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'agreement_data' => $gareement_data];
    send_json($results);
    die();
}

function remove_agreement()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $gareement_data = [];
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $agreement_id = $_REQUEST['agreement_id'];
    $agr_data = ORM::for_table($config['db']['pre'] . 'user_agreements')->where(['id' => $agreement_id, 'worker_id' => $user_id])->find_one();
    if ($agr_data) {
        $agr_data->status = 'cancelled';
        $agr_data->deleted_at = date('Y-m-d H:i:s');
        if ($agr_data->save()) {
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['AGREEMENT_DELETED'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['SOMETHING_WENT_WRONG'];
        }
        $gareement_data = getAgreementWithRates($agreement_id);
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['NOT_FOUND'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'agreement_data' => $gareement_data];
    send_json($results);
    die();
}

function agreementWithIdTitle()
{
    global $config;
    global $lang, $status, $status_code, $message, $results;
    $item = [];
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $agr_data =  ORM::for_table($config['db']['pre'] . 'user_agreements')->table_alias('a')
            ->select_many('a.*', 'p.product_name', ['client_name' => 'c.name'])
            ->left_outer_join($config['db']['pre'] . 'product', array('a.post_id', '=', 'p.id'), 'p')
            ->join($config['db']['pre'] . 'user', array('a.client_id', '=', 'c.id'), 'c')
            ->where_raw('(a.status = "accepted" and a.worker_id = "' . $user_id . '" and a.post_id IS NULL) or ( a.status = "accepted" and a.worker_id = "' . $user_id . '" and p.status = "active" and p.hide = "0")')
            ->find_many()->as_array();

        $item = [];
        foreach ($agr_data as $data) {
            $item[$data['id']]['id'] = $data['id'];
            $item[$data['id']]['product_name'] = !empty($data['product_name']) ? $data['product_name'] : $data['name'];
            $item[$data['id']]['client_name'] = $data['client_name'];
        }
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'agreement_data' => array_values($item)];
    send_json($results);
    die();
}

function userAvailableAgreementRates()
{
    global $config, $lang;
    $id = (isset($_REQUEST['agreementid']) && !empty($_REQUEST['agreementid'])) ? $_REQUEST['agreementid'] : 0;
    $selectedid = (isset($_REQUEST['rate_id']) && !empty($_REQUEST['rate_id'])) ? $_REQUEST['rate_id'] : 0;
    $rates = ORM::for_table($config['db']['pre'] . 'user_agreements_rates')->table_alias('ar')
        ->where('ar.agreement_id', $id)
        ->where_raw('ar.id NOT IN(SELECT agreement_rate_id FROM ' . $config['db']['pre'] . 'timesheets WHERE worker_id=(SELECT worker_id FROM ' . $config['db']['pre'] . 'user_agreements WHERE id = ' . $id . ') AND deleted_at IS NULL AND id NOT IN (SELECT agreement_rate_id FROM ' . $config['db']['pre'] . 'timesheets WHERE agreement_rate_id = ' . $selectedid . '))')
        ->find_array();
    $results = ['status_code' => HTTP_OK, 'status' => $lang['SUCCESS'], 'message' => $lang['SUCCESS'], 'rates' => $rates];
    send_json($results);
    die();
}

function get_user_all_agreements()
{

    global $config, $lang, $status, $status_code, $message, $results;
    if (!isset($_REQUEST['page']))
        $_REQUEST['page'] = 1;
    $limit = 10;
    $page = $_REQUEST['page'];
    $offset = ($page - 1) * $limit;
    $agreementWithRate = [];
    $agreement_data = [];
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $user_type = get_user_data(null, $user_id)['user_type'];
        if ($user_type == 'user') {
            $total_item = ORM::for_table($config['db']['pre'] . 'user_agreements')->table_alias('a')
                ->where(array(
                    'a.worker_id' => $user_id,

                ))->where_null('deleted_at')->count();
            $agreement_data = ORM::for_table($config['db']['pre'] . "user_agreements")->table_alias('a')
                ->select_many(['id' => 'a.id', 'agr_name' => 'a.name', 'agreement_status' => 'a.status', 'rate_id' => 'ar.id', 'agr_username' => 'u.username', 'agr_user_id' => 'a.client_id'], 'a.post_id', 'a.client_id', 'a.worker_id', 'a.agreed_services', 'a.created_at', 'p.product_name', 'ar.description', 'ar.rate', 'ar.rate_type')
                ->select_many_expr(
                    [
                        'rates_count' => '(SELECT COUNT(agreement_id) FROM ' . $config['db']['pre'] . 'user_agreements_rates WHERE agreement_id=a.id)',
                        'average_rate' => '(SELECT AVG(rate) FROM ' . $config['db']['pre'] . 'user_agreements_rates WHERE agreement_id=a.id)',
                        'min_rate' => '(SELECT MIN(rate) FROM ' . $config['db']['pre'] . 'user_agreements_rates WHERE agreement_id=a.id)',
                        'max_rate' => '(SELECT MAX(rate) FROM ' . $config['db']['pre'] . 'user_agreements_rates WHERE agreement_id=a.id)'
                    ]
                )
                ->where(['worker_id' => $user_id])
                ->where_null('a.deleted_at')
                ->join($config['db']['pre'] . "user_agreements_rates", "a.id=ar.agreement_id", "ar")
                ->left_outer_join($config['db']['pre'] . "product", 'a.post_id=p.id', 'p')
                ->join($config['db']['pre'] . "user", 'a.client_id=u.id', 'u')
                ->order_by_desc('a.id')
                ->limit($limit)->offset($offset)
                ->find_many();
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['SUCCESS'];
        } elseif ($user_type == 'employer') {
            $total_item = ORM::for_table($config['db']['pre'] . 'user_agreements')->table_alias('a')
                ->where(array(
                    'a.client_id' => $user_id,
                ))->where_null('deleted_at')->count();

            $agreement_data = ORM::for_table($config['db']['pre'] . "user_agreements")->table_alias('a')
                ->select_many(['id' => 'a.id', 'agr_name' => 'a.name', 'agreement_status' => 'a.status', 'rate_id' => 'ar.id', 'agr_username' => 'u.username', 'agr_user_id' => 'a.worker_id'], 'a.post_id', 'a.client_id', 'a.worker_id', 'a.agreed_services', 'a.created_at', 'p.product_name', 'ar.description', 'ar.rate', 'ar.rate_type')
                ->select_many_expr(
                    [
                        'rates_count' => '(SELECT COUNT(agreement_id) FROM ' . $config['db']['pre'] . 'user_agreements_rates WHERE agreement_id=a.id)',
                        'average_rate' => '(SELECT AVG(rate) FROM ' . $config['db']['pre'] . 'user_agreements_rates WHERE agreement_id=a.id)',
                        'min_rate' => '(SELECT MIN(rate) FROM ' . $config['db']['pre'] . 'user_agreements_rates WHERE agreement_id=a.id)',
                        'max_rate' => '(SELECT MAX(rate) FROM ' . $config['db']['pre'] . 'user_agreements_rates WHERE agreement_id=a.id)'
                    ]
                )
                ->where(['a.client_id' => $user_id])
                ->where_null('a.deleted_at')
                ->join($config['db']['pre'] . "user_agreements_rates", "a.id=ar.agreement_id", "ar")
                ->left_outer_join($config['db']['pre'] . "product", 'a.post_id=p.id', 'p')
                ->join($config['db']['pre'] . "user", 'a.worker_id=u.id', 'u')
                ->order_by_desc('a.id')
                ->limit($limit)->offset($offset)
                ->find_many();
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['SUCCESS'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['INVALID_USER'];
        }
        $old_id = NULL;
        $agreementWithRate = array();
        if (!empty($agreement_data)) {
            foreach ($agreement_data as $key => $agreement) {
                switch ($agreement['agreement_status']) {
                    case 'declined':
                    case 'sent':
                        $status = 'sent';
                        break;
                    case 'accepted':
                    case 'changed':
                        $status = 'changed';
                        break;
                    default:
                        $status = 'sent';
                        break;
                }
                if ($agreement['id'] != $old_id) {
                    $agreementid = base64_url_encode($agreement['id']);
                    $status = base64_url_encode($status);
                    // $edit_url = $config['site_url'].'edit-agreement'."/?agreementid=$agreementid&status=$status";
                    $agreementWithRate[$agreement['id']]['id'] = $agreement['id'];
                    $agreementWithRate[$agreement['id']]['name'] = !empty(ucwords($agreement['product_name'])) ? ucwords($agreement['product_name']) : ucwords($agreement['agr_name']);
                    $agreementWithRate[$agreement['id']]['status'] = ucwords($agreement['agreement_status']);
                    $agreementWithRate[$agreement['id']]['rates_count'] = $agreement['rates_count'];
                    $agreementWithRate[$agreement['id']]['average_rate'] = number_format($agreement['average_rate'], 2, '.', '');
                    $agreementWithRate[$agreement['id']]['min_rate'] = floor($agreement['min_rate']);
                    $agreementWithRate[$agreement['id']]['max_rate'] = floor($agreement['max_rate']);
                    // $agreementWithRate[$agreement['id']]['edit_url']= $edit_url;
                    $agreementWithRate[$agreement['id']]['agr_username'] = $agreement['agr_username'];
                    $agreementWithRate[$agreement['id']]['agr_user_id'] = $agreement['agr_user_id'];
                    $old_id = $agreement['id'];
                }
                if ($agreement['rates_count'] > 0) {
                    $agreementWithRate[$agreement['id']]['rates'][] = [
                        'id' => $agreement['rate_id'],
                        'rate_type' => $agreement['description'],
                        'rate' => $agreement['rate'],
                        'rate_type' => $agreement['rate_type']
                    ];
                } else {
                    $agreementWithRate[$agreement['id']]['rates'] = [];
                }
            }
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'agreement_data' => array_values($agreementWithRate)];
    send_json($results);
    die();
}

function getUserAdditionalInformation()
{
    global $lang, $status, $status_code, $message, $results;
    $additional_info = array();
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $additional_info['user_languages'] = user_languages($user_id);
        $additional_info['user_cultural_backgrounds'] = get_cultural_background($user_id);
        $additional_info['user_religions'] = get_religion($user_id);
        $additional_info['user_skills'] = get_user_skills($user_id);
        $additional_info['preferences'] = get_preferences($user_id);
        $additional_info['about'] = get_about_me($user_id);
        $additional_info['interest_hobbies'] = interest_and_hobbies($user_id);
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'additional_information' => $additional_info];
    send_json($results);
    die();
}

function get_user_profile_details()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $username = $_REQUEST['username'];
    $userdata = array();
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    $user_exist = ORM::for_table($config['db']['pre'] . 'user')->where("username", $username)->find_one();
    if (!empty($user_exist)) {
        if ($bearer_token != null && $valid_auth_token) {
            $user_id = get_device_token($valid_auth_token, 'user_id');
            $logged_user_data =  get_user_data(null, $user_id);
            $userdata = get_profile_data($username);
            if ($logged_user_data['user_type'] == 'employer') {
                $fav_user_id = get_user_data($username)['id'];
                $userdata['profile_detail']['is_favourite_user'] = check_user_favorite($fav_user_id, $user_id);
            }
        } else {
            $userdata = get_profile_data($username);
        }
        if (!empty($userdata)) {
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['SUCCESS'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['NOT_FOUND'];
        }
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['NOT_FOUND'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'userdata' => $userdata];
    send_json($results);
    die();
}

function get_profile_data($username)
{
    global $config;
    $userdata = [];
    if (!isset($_GET['page']))
        $page = 1;
    else
        $page = $_GET['page'];

    $limit = 10;

    $user_data = get_user_data($username);

    if ($user_data) {
    }
    $user_id = $user_data['id'];
    $country_code = $user_data['country_code'];
    $user_salary_min = price_format($user_data['salary_min'], $country_code);
    $user_salary_max = price_format($user_data['salary_max'], $country_code);
    $state_name = '';
    $user_city = $user_data['city'];
    if (!empty($user_data['city_code'])) {
        $city_detail = get_cityDetail_by_id($user_data['city_code']);
        $user_city = !empty($city_detail) ? $city_detail['asciiname'] : "";
        $state_name = !empty($city_detail) ? get_stateName_by_id($city_detail['subadmin1_code']) : "";
    }
    if ($user_data['user_type'] == 'user') {
        $rating = (float)avg_review($user_id, true);
        $total_review = (float)avg_rating_count($user_id);
    } elseif ($user_data['user_type'] == 'employer') {
        $rating = avg_review_product_user($user_data['id'], true);
        $total_review = avg_review_product_user_count($user_id);
    }
    if ($total_review > 0) {

        if ($rating == 5) {
            $msg_rating = 'Excellent';
        } else if ($rating >= 4) {
            $msg_rating = 'Very Good';
        } else if ($rating >= 3) {
            $msg_rating = 'Average';
        } else if ($rating >= 2) {
            $msg_rating = 'Bad';
        } else {
            $msg_rating = 'Very Bad';
        }
    } else {
        $msg_rating = 'None';
    }

    if ($user_data['user_type'] == 'user') {
        // Cities and Suburb data of user.
        $user_cities = ORM::for_table($config['db']['pre'] . 'user_cities')->table_alias('uc')
            ->select_many('uc.*', 'u.username', 'u.name', 'u.email', 'u.image', 'c.latitude', 'c.longitude', 'c.asciiname')
            ->where('user_id', $user_id)
            ->join($config['db']['pre'] . 'cities', array('c.id', '=', 'uc.city_code'), 'c')
            ->join($config['db']['pre'] . 'user', array('u.id', '=', 'uc.user_id'), 'u')
            ->find_array();
        // output data of each row
        $map_data = [];
        foreach ($user_cities as $info) {
            $data['id'] = $info['id'];
            $data['suburb_name'] = $info['asciiname'];
            $data['map_pointer_image'] = $config['site_url'] . 'storage/banner/map_logo.png';
            $data['latitude'] = ($info['latitude'] + 0.008194);
            $data['longitude'] = ($info['longitude'] - 0.008846);
            $map_data[] = $data;
        }

        $userdata['profile_detail'] = [
            'id' => $user_data['id'],
            'image' => $config['site_url'] . 'storage/profile/' . $user_data['image'],
            'username' => $user_data['username'],
            'name' => $user_data['name'],
            'firstname' => $user_data['firstname'],
            'lastname' => $user_data['lastname'],
            'description' => $user_data['description'],
            'status' => $user_data['status'],
            'cityname' => $user_city,
            'statename' => $state_name,
            'address' => $user_data['address'],
            'phone' => $user_data['phone'],
            'email' => $user_data['email'],
            'gender' => $user_data['sex'],
            'age' =>  date_diff(date_create($user_data['dob']), date_create('today'))->y,
            'min_rate' => $user_salary_min,
            'max_rate' => $user_salary_max,
            'profile_url' => $config['site_url'] . 'profile/' . $user_data['username'],
            'created' => date('d M Y', strtotime($user_data['created_at'])),
            'average_rating' => avg_review($user_id),
            'jobs_done' => 'N/A',
            'rehired' => 'N/A',
        ];
        $userdata['skills'] = get_user_skills($user_id);
        $userdata['language'] = user_languages($user_id);
        $userdata['religion'] = get_religion($user_id);
        $userdata['experiences'] = user_experiences($user_id);
        $userdata['education'] = user_educations($user_id);
        $userdata['reviews'] = user_reviews($user_id, 'user');
        $userdata['availabilty'] = get_user_preferred_days($user_id);
        $userdata['rating'] = [
            'overallRatingMessage' => $msg_rating,
            'totalAverageRating' => avg_review($user_id, true),
            'totalRating' => avg_rating_count($user_id),
            'ratings' => [
                ['ratingMessage' => 'Excellent', 'ratingProgress' => intval(progress_rating($user_id, "5")), 'ratingCount' => count_progress_rating($user_id, "5")],
                ['ratingMessage' => 'Very Good', 'ratingProgress' => intval(progress_rating($user_id, "4")), 'ratingCount' => count_progress_rating($user_id, "4")],
                ['ratingMessage' => 'Average', 'ratingProgress' => intval(progress_rating($user_id, "3")), 'ratingCount' => count_progress_rating($user_id, "3")],
                ['ratingMessage' => 'Bad', 'ratingProgress' => intval(progress_rating($user_id, "2")), 'ratingCount' => count_progress_rating($user_id, "2")],
                ['ratingMessage' => 'Very Bad', 'ratingProgress' => intval(progress_rating($user_id, "1")), 'ratingCount' => count_progress_rating($user_id, "1")],
            ],
        ];
        $userdata['suburb'] = $map_data;
    } elseif ($user_data['user_type'] == 'employer') {
        $userdata['profile_detail'] = [
            'id' => $user_data['id'],
            'image' => $config['site_url'] . 'storage/profile/' . $user_data['image'],
            'username' => $user_data['username'],
            'name' => $user_data['name'],
            'firstname' => $user_data['firstname'],
            'lastname' => $user_data['lastname'],
            'description' => $user_data['description'],
            'status' => $user_data['status'],
            'cityname' => $user_city,
            'statename' => $state_name,
            'address' => $user_data['address'],
            'phone' => $user_data['phone'],
            'email' => $user_data['email'],
            'gender' => $user_data['sex'],
            'age' =>  date_diff(date_create($user_data['dob']), date_create('today'))->y,
            'min_rate' => $user_salary_min,
            'max_rate' => $user_salary_max,
            'profile_url' => $config['site_url'] . 'profile/' . $user_data['username'],
            'created' => date('d M Y', strtotime($user_data['created_at'])),
            'average_rating' => avg_review_product_user($user_id),
            'total_job' => total_job_count_by_user($user_id),
            'total_active_job' => total_active_job_by_user_count($user_id),
        ];
        $results = ORM::for_table($config['db']['pre'] . 'product')
            ->where('user_id', $user_id)
            ->where('status', 'active')
            ->where('hide', '0')
            ->limit($limit)
            ->offset(($page - 1) * $limit)
            ->find_many();
        $items = [];
        foreach ($results as $info) {
            $items[$info['id']]['id'] = $info['id'];
            $items[$info['id']]['name'] = $info['product_name'];
            $items[$info['id']]['product_type'] = get_productType_title_by_id($info['product_type']);
            $items[$info['id']]['featured'] = $info['featured'];
            $items[$info['id']]['urgent'] = $info['urgent'];
            $items[$info['id']]['highlight'] = $info['highlight'];

            $salary_min = price_format($info['salary_min'], $info['country']);
            $items[$info['id']]['salary_min'] = $salary_min;
            $salary_max = price_format($info['salary_max'], $info['country']);
            $items[$info['id']]['salary_max'] = $salary_max;

            $cityname = get_cityName_by_id($info['city']);
            $items[$info['id']]['city'] = $cityname;
            $items[$info['id']]['created_at'] = timeAgo($info['created_at']);
            $pro_url = create_slug($info['product_name']);
            $items[$info['id']]['link'] = $config['site_url'] . 'job/' . $info['id'] . '/' . $pro_url;
        }
        $total = ORM::for_table($config['db']['pre'] . 'product')
            ->where('user_id', $user_id)
            ->where('status', 'active')
            ->where('hide', '0')
            ->count();
        $userdata['reviews'] = user_reviews($user_id, 'employer');
        $userdata['jobs']['total'] = $total;
        $userdata['jobs']['item'] = array_values($items);
        $userdata['rating'] = [
            'overallRatingMessage' => $msg_rating,
            'totalAverageRating' => avg_review_product_user($user_id, true),
            'totalRating' => avg_review_product_user_count($user_id),
            'ratings' => [
                ['ratingMessage' => 'Excellent', 'ratingProgress' => progress_pro_rating($user_id, "5"), 'ratingCount' => count_pro_progress_rating($user_id, "5")],
                ['ratingMessage' => 'Very Good', 'ratingProgress' => progress_pro_rating($user_id, "4"), 'ratingCount' => count_pro_progress_rating($user_id, "4")],
                ['ratingMessage' => 'Average', 'ratingProgress' => progress_pro_rating($user_id, "3"), 'ratingCount' => count_pro_progress_rating($user_id, "3")],
                ['ratingMessage' => 'Bad', 'ratingProgress' => progress_pro_rating($user_id, "2"), 'ratingCount' => count_pro_progress_rating($user_id, "2")],
                ['ratingMessage' => 'Very Bad', 'ratingProgress' => progress_pro_rating($user_id, "1"), 'ratingCount' => count_pro_progress_rating($user_id, "1")],
            ],
        ];
    }
    return $userdata;
}

function popularCities()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $popular = array();
    $count = 1;
    $country_code = check_user_country();
    $countryName = get_countryName_by_sortname($country_code);
    $result = ORM::for_table($config['db']['pre'] . 'cities')
        ->select_many('id', 'asciiname')
        ->where(array(
            'country_code' => $country_code,
            'active' => '1'
        ))
        ->order_by_desc('population')
        ->limit(18)
        ->find_many();
    foreach ($result as $info) {
        $popular[$count]['id'] = $info['id'];
        $popular[$count]['name'] = $info['asciiname'];
        $count++;
    }
    $states = array();
    $count = 1;

    $result = ORM::for_table($config['db']['pre'] . 'subadmin1')
        ->select_many('id', 'code', 'asciiname')
        ->where(array(
            'country_code' => $country_code,
            'active' => '1'
        ))
        ->order_by_asc('asciiname')
        ->find_many();

    foreach ($result as $info) {
        if ($count == 1) {
            $states[$count]['id'] = $country_code;
            $states[$count]['name'] = $lang['ALL'] . ' ' . $countryName;
            $states[$count]['type'] =  'country';
        } else {
            $states[$count]['id'] = $info['id'];
            $states[$count]['name'] =  $info['asciiname'];
            $states[$count]['code'] = $info['code'];
            $states[$count]['type'] =  'state';
        }
        $count++;
    }
    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];
    $message = $lang['SUCCESS'];
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'popular_cities' => array_values($popular), 'states' => array_values($states)];
    send_json($results);
    die();
}

function userNearbyCity()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $loggedin = checkIsLoggedin();
    $user_id =  $loggedin['user_id'];
    $user_city = ORM::for_table($config['db']['pre'] . 'user_cities')->where('user_id', $user_id)->find_array();
    //Home neareby Cities
    $city_codes = array_column($user_city, 'city_code');
    $city_data = ORM::for_table($config['db']['pre'] . 'user')->table_alias('u')
        ->select_many('c.name', 'c.id', 'c.latitude', 'c.longitude', 'u.state_code', ['statename' => 's.name'])
        ->where('u.id', $user_id)
        ->join($config['db']['pre'] . 'cities', 'u.city_code = c.id', 'c')
        ->join($config['db']['pre'] . 'subadmin1', 's.code = c.subadmin1_code', 's')
        ->find_one();
    $home_near_data_list = [];
    if ($city_data) {
        $nearest_city_sql = 'SELECT *, ( 3956 * 2 * ASIN( SQRT( POWER( SIN( (' . $city_data['latitude'] . ' - latitude) * PI() / 180 / 2), 2 ) + COS(' . $city_data['latitude'] . ' * PI() / 180) * COS(' . $city_data['latitude'] . ' * PI() / 180) * POWER( SIN( (' . $city_data['longitude'] . ' - longitude) * PI() / 180 / 2), 2 ) ))) AS distance FROM ' . $config['db']['pre'] . 'cities  WHERE id != ' . $city_data['id'] . '    HAVING distance <= 50 ORDER BY distance ASC LIMIT 25;';
        $home_nearest_cities = ORM::for_table($config['db']['pre'] . 'cities')->raw_query($nearest_city_sql)->find_array();
        foreach ($home_nearest_cities as $list_home_nearest_cities) {
            if (!in_array($list_home_nearest_cities['id'], $city_codes)) {
                $home_near_data['id'] = $list_home_nearest_cities['id'];
                $home_near_data['name'] = $list_home_nearest_cities['name'];
                $home_near_data['state'] = $city_data['statename'];
                $home_near_data_list[] = $home_near_data;
            }
        }
    }

    //Work Location neareby Cities
    $work_nearest_cities = [];
    $work_city_data = ORM::for_table($config['db']['pre'] . 'user_cities')->table_alias('u')
        ->select_many('c.name', 'c.id', 'c.latitude', 'c.longitude', 'u.state_code', ['statename' => 's.name'])
        ->where('u.user_id', $user_id)
        ->join($config['db']['pre'] . 'cities', 'u.city_code = c.id', 'c')
        ->join($config['db']['pre'] . 'subadmin1', 's.code = c.subadmin1_code', 's')
        ->find_array();

    $work_da = [];
    foreach ($work_city_data as $work_city) {
        $work_da[$work_city['statename']] = $work_city['state_code'];
    }

    foreach ($work_city_data as $location) {
        $sql = 'SELECT *, ( 3956 * 2 * ASIN( SQRT( POWER( SIN( (' . $location['latitude'] . ' - latitude) * PI() / 180 / 2), 2 ) + COS(' . $location['latitude'] . ' * PI() / 180) * COS(' . $location['latitude'] . ' * PI() / 180) * POWER( SIN( (' . $location['longitude'] . ' - longitude) * PI() / 180 / 2), 2 ) ))) AS distance FROM ' . $config['db']['pre'] . 'cities  WHERE id != ' . $location['id'] . '    HAVING distance <= 2 ORDER BY distance ASC LIMIT 5;';
        // dd($sql);
        $nearest_city = ORM::for_table($config['db']['pre'] . 'cities')->raw_query($sql)->find_array();
        $work_nearest_cities = array_merge($work_nearest_cities, $nearest_city);
    }
    $work_near_data_list = [];
    foreach ($work_nearest_cities as $list_work_nearest_cities) {
        if (isset($work_da)) {
            $name_state = array_search($list_work_nearest_cities['subadmin1_code'], $work_da);
        }
        if (!in_array($list_work_nearest_cities['id'], $city_codes)) {
            $work_near_data['id'] = $list_work_nearest_cities['id'];
            $work_near_data['name'] = $list_work_nearest_cities['name'];
            $work_near_data['state'] = $name_state;
            $work_near_data_list[] = $work_near_data;
        }
    }
    $results = ['status_code' => HTTP_OK, 'status' => $lang['SUCCESS'], 'message' => $lang['SUCCESS'], 'auth_token' => $loggedin['auth_token'], 'home_nearest_cities' => $home_near_data_list, 'work_nearest_cities' => $work_near_data_list];
    send_json($results);
    die();
}

function get_user_resume()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $items = array();
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $result = user_resume_list($user_id);
        if (!empty($result)) {
            $items = array_values($result);
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['SUCCESS'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['NOT_FOUND'];
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'resumes' => $items];
    send_json($results);
    die();
}

function user_resume_list($user_id)
{
    global $config;
    $items = array();
    $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 10;
    $offset = ($page - 1) * $limit;
    $keywords = '';
    $orm = ORM::for_table($config['db']['pre'] . 'resumes')
        ->where('user_id', $user_id)
        ->where('active', '1');
    if (!empty($_REQUEST['keywords'])) {
        $keywords = $_REQUEST['keywords'];
        $orm->where_like('name', '%' . $keywords . '%');
    }
    $result = $orm->limit($limit)->offset($offset)->find_many();
    if ($result) {
        foreach ($result as $info) {
            $items[$info['id']]['id'] = $info['id'];
            $items[$info['id']]['name'] = $info['name'];
            $items[$info['id']]['filename'] = $config['site_url'] . "storage/resumes/" . $info['filename'];
        }
    }
    return $items;
}

function save_resume()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $resume_file = '';
    $error = 0;
    $items = [];
    $additional_info = array();
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $name  = !empty($_REQUEST['name']) ? $_REQUEST['name'] : "";
        if (!empty($_FILES['resume'])) {
            $file = $_FILES['resume'];
            // Valid formats
            $resume_files = trim(get_option("resume_files"));
            $valid_formats = explode(',', $resume_files);
            $filename = $file['name'];
            $ext = getExtension($filename);
            $ext = strtolower($ext);
            if (!empty($filename)) {
                //File extension check
                if (in_array($ext, $valid_formats)) {
                    $main_path = ROOTPATH . "/storage/resumes/";
                    if (!file_exists($main_path)) {
                        mkdir($main_path, 0777);
                    }
                    $filename = uniqid(time()) . '.' . $ext;
                    if (move_uploaded_file($file['tmp_name'], $main_path . $filename)) {
                        $resume_file = $filename;
                    } else {
                        $error++;
                        $message = $lang['ERROR_TRY_AGAIN'];
                    }
                } else {
                    $error++;
                    $message = $lang['RESUME_FILE_TYPE'];
                }
            } else {
                if (empty($_REQUEST['id'])) {
                    $error++;
                    $message = $lang['RESUME_REQ'];
                }
            }
        }
        if ($error == 0) {
            $now = date("Y-m-d H:i:s");
            if (!empty($_REQUEST['id'])) {
                $resume_create = ORM::for_table($config['db']['pre'] . 'resumes')->where('id', $_REQUEST['id'])->where('user_id', $user_id)->find_one();
                if ($resume_create) {
                    $old_file = $resume_create['filename'];
                    if (!empty($resume_file)) {
                        $uploaded_file = $resume_file;
                        $uploaddir =  ROOTPATH . "/storage/resumes/";
                        $file = $uploaddir . $old_file;
                        if (file_exists($file))
                            unlink($file);
                    } else {
                        $uploaded_file = $old_file;
                    }
                    $resume_create->set('filename', $uploaded_file);
                    $resume_create->set('name', $name);
                    $resume_create->set('updated_at', $now);
                    $resume_create->save();
                }
            } else {
                $resume_create = ORM::for_table($config['db']['pre'] . 'resumes')->create();
                $resume_create->name = $name;
                $resume_create->filename = $resume_file;
                $resume_create->user_id = $user_id;
                $resume_create->created_at = $now;
                $resume_create->updated_at = $now;
                $resume_create->save();
            }
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['RESUME_UPLOADED'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $message;
        }
        $items = array_values(user_resume_list($user_id));
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'resumes' => $items];
    send_json($results);
    die();
}

function delete_resume()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $items = [];
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $resume_id = $_REQUEST['resume_id'] ? $_REQUEST['resume_id'] : "";
        $resume = ORM::for_table($config['db']['pre'] . 'resumes')->where('user_id', $user_id)->find_one($resume_id);
        if ($resume) {
            $uploaddir = ROOTPATH . "/storage/resumes/";
            if ($resume->delete()) {
                $file = $uploaddir . $resume['filename'];
                if (file_exists($file))
                    unlink($file);
                $status_code = HTTP_OK;
                $status = $lang['SUCCESS'];
                $message = $lang['RESUME_DELETED'];
            }
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['NOT_FOUND'];
        }
        $items = array_values(user_resume_list($user_id));
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'resumes' => $items];
    send_json($results);
    die();
}

function favourite_jobs()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $item = [];
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 10;
        $offset = ($page - 1) * $limit;
        $total = ORM::for_table($config['db']['pre'] . 'favads')->select('product_id')->where('user_id', $user_id)->count();
        $result = ORM::for_table($config['db']['pre'] . 'favads')->select('product_id')->where('user_id', $user_id)->limit($limit)->offset($offset)->find_many();
        if (count($result) > 0) {
            if (count($result) > 0) {
                foreach ($result as $fav) {
                    $sql = "SELECT p.*, c.name company_name, c.logo company_image
                            FROM `" . $config['db']['pre'] . "product` p 
                            LEFT JOIN `" . $config['db']['pre'] . "companies` c on p.company_id = c.id
                            WHERE p.status = 'active' AND p.hide = '0' AND p.id = '" . $fav['product_id'] . "' ";

                    $info = ORM::for_table($config['db']['pre'] . 'product')->raw_query($sql)->find_one();
                    if (!empty($info)) {
                        $item[$info['id']]['id'] = $info['id'];
                        $item[$info['id']]['product_name'] = $info['product_name'];
                        $item[$info['id']]['company_name'] = $info['company_name'];
                        $item[$info['id']]['company_image'] = !empty($info['company_image']) ? $info['company_image'] : 'default.png';
                        $item[$info['id']]['desc'] = strlimiter(strip_tags($info['description']), 80);
                        $item[$info['id']]['product_type'] = get_productType_title_by_id($info['product_type']);
                        $item[$info['id']]['salary_type'] = get_salaryType_title_by_id($info['salary_type']);
                        $item[$info['id']]['featured'] = $info['featured'];
                        $item[$info['id']]['urgent'] = $info['urgent'];
                        $item[$info['id']]['highlight'] = $info['highlight'];
                        $item[$info['id']]['location'] = get_cityName_by_id($info['city']);
                        $item[$info['id']]['status'] = $info['status'];
                        $item[$info['id']]['created_at'] = timeago($info['created_at']);

                        $item[$info['id']]['image'] = !empty($info['screen_shot']) ? $info['screen_shot'] : $item[$info['id']]['company_image'];

                        $salary_min = price_format($info['salary_min'], $info['country']);
                        $item[$info['id']]['salary_min'] = $salary_min;
                        $salary_max = price_format($info['salary_max'], $info['country']);
                        $item[$info['id']]['salary_max'] = $salary_max;

                        $cate_data =  get_job_category_and_subcategory($info['id']);
                        $item[$info['id']]['category'] = array_values($cate_data['categories']);
                        $item[$info['id']]['sub_category'] = array_values($cate_data['subcategories']);

                        // $get_main = get_maincat_by_id($info['category']);
                        // $get_sub = get_subcat_by_id($info['sub_category']);
                        //$item[$info['id']]['category'] = $get_main['cat_name'];
                        // $item[$info['id']]['sub_category'] = $get_sub['sub_cat_name'];

                        $pro_url = create_slug($info['product_name']);
                        $item[$info['id']]['link'] = $config['site_url'] . 'job/' . $info['id'] . '/' . $pro_url;

                        //  $cat_slug = create_slug($get_main['cat_name']);
                        // $item[$info['id']]['catlink'] = $config['site_url'].'category/'.$info['category'].'/'.$cat_slug;
                    }
                }
            }
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['SUCCESS'];
            $item =  array_values($item);
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['NOT_FOUND'];
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'total' => $total, 'favourite_jobs' => $item];
    send_json($results);
    die();
}

function applied_jobs()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $item = [];
    $total = 0;
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 10;
        $offset = ($page - 1) * $limit;

        $result = ORM::for_table($config['db']['pre'] . 'user_applied')
            ->select('job_id')
            ->where('user_id', $user_id)
            ->limit($limit)->offset($offset)
            ->find_many();
        if (count($result) > 0) {
            foreach ($result as $applied) {
                $sql = "SELECT p.*, c.name company_name, c.logo company_image
                FROM `" . $config['db']['pre'] . "product` p 
                LEFT JOIN `" . $config['db']['pre'] . "companies` c on p.company_id = c.id
                WHERE p.status = 'active' AND p.hide = '0' AND p.id = '" . $applied['job_id'] . "' ";
                $info = ORM::for_table($config['db']['pre'] . 'product')->raw_query($sql)->find_one();
                if (!empty($info)) {
                    $item[$info['id']]['id'] = $info['id'];
                    $item[$info['id']]['product_name'] = $info['product_name'];
                    $item[$info['id']]['company_name'] = $info['company_name'];
                    $item[$info['id']]['company_image'] = !empty($info['company_image']) ? $info['company_image'] : 'default.png';
                    $item[$info['id']]['desc'] = strlimiter(strip_tags($info['description']), 80);
                    $item[$info['id']]['product_type'] = get_productType_title_by_id($info['product_type']);
                    $item[$info['id']]['salary_type'] = get_salaryType_title_by_id($info['salary_type']);
                    $item[$info['id']]['featured'] = $info['featured'];
                    $item[$info['id']]['urgent'] = $info['urgent'];
                    $item[$info['id']]['highlight'] = $info['highlight'];
                    $item[$info['id']]['location'] = get_cityName_by_id($info['city']);
                    $item[$info['id']]['status'] = $info['status'];
                    $item[$info['id']]['created_at'] = timeago($info['created_at']);
                    $item[$info['id']]['image'] = !empty($info['screen_shot']) ? $info['screen_shot'] : $item[$info['id']]['company_image'];

                    $salary_min = price_format($info['salary_min'], $info['country']);
                    $item[$info['id']]['salary_min'] = $salary_min;
                    $salary_max = price_format($info['salary_max'], $info['country']);
                    $item[$info['id']]['salary_max'] = $salary_max;

                    // $item[$info['id']]['cat_id'] = $info['category'];
                    // $item[$info['id']]['sub_cat_id'] = $info['sub_category'];

                    // $get_main = get_maincat_by_id($info['category']);
                    // $get_sub = get_subcat_by_id($info['sub_category']);
                    $cate_data =  get_job_category_and_subcategory($info['id']);
                    $item[$info['id']]['category'] = array_values($cate_data['categories']);
                    $item[$info['id']]['sub_category'] =  array_values($cate_data['subcategories']);

                    $pro_url = create_slug($info['product_name']);
                    $item[$info['id']]['link'] = $config['site_url'] . 'job/' . $info['id'] . '/' . $pro_url;
                    //  $cat_slug = create_slug($get_main['cat_name']);

                    // $item[$info['id']]['catlink'] = $config['site_url'].'category/'.$info['category'].'/'.$cat_slug;
                    // $subcat_slug = create_slug($get_sub['sub_cat_name']);
                    // $item[$info['id']]['subcatlink'] = $config['site_url'].'subcategory/'.$info['sub_category'].'/'.$subcat_slug;
                    $item[$info['id']]['is_favourite'] = check_product_favorite($info['id'], $user_id);
                }
                $item = array_values($item);
            }
            $total = applied_jobs_count($user_id);
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['SUCCESS'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['NOT_FOUND'];
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'total' => $total, 'applied_jobs' => $item];
    send_json($results);
    die();
}

function applied_users()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $valid_auth_token  = isAuthTokenValid();
    $item = [];
    $total = 0;
    $city = $state = '';
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $userdata = get_user_data(null, $user_id);
        if ($userdata['user_type'] == 'employer') {
            $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
            $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 10;
            $offset = ($page - 1) * $limit;
            $job_id = !empty($_REQUEST['job_id']) &&  isset($_REQUEST['job_id']) ?  $_REQUEST['job_id'] : 0;
            $product = ORM::for_table($config['db']['pre'] . 'product')->select('product_name')->where(['id' => $job_id, 'user_id' => $user_id])->whereNotEqual('status', 'pending')->findOne();
            if (!empty($product)) {
                $result = ORM::for_table($config['db']['pre'] . 'user_applied')
                    ->table_alias('ua')
                    ->select_many('ua.*', 'u.id', 'u.username', 'u.name', 'u.salary_min', 'u.salary_max', 'u.sex', 'u.image', 'u.category', 'u.subcategory', 'u.country_code', 'u.city_code')
                    ->where(array(
                        'u.status' => '1',
                        'u.user_type' => 'user',
                        'ua.job_id' => $job_id
                    ))
                    ->join($config['db']['pre'] . 'user', array('ua.user_id', '=', 'u.id'), 'u')
                    ->limit($limit)->offset($offset)
                    ->find_many();
                $total =  count($result);
                foreach ($result as $info) {
                    $item[$info['id']]['id'] = $info['user_id'];
                    $item[$info['id']]['username'] = $info['username'];
                    $item[$info['id']]['name'] = !empty($info['name']) ? $info['name'] : $info['username'];
                    $item[$info['id']]['description'] = nl2br(stripcslashes($info['message']));
                    $item[$info['id']]['sex'] = $info['sex'];
                    $item[$info['id']]['image'] = !empty($info['image']) ? $info['image'] : 'default_user.png';
                    $cate_data = get_user_category_and_subcatagory($info['id']);
                    $item[$info['id']]['category'] = $cate_data['categories'];
                    $item[$info['id']]['subcategory'] = $cate_data['subcategories'];
                    $country_code = $info['country_code'];
                    $item[$info['id']]['salary_min'] = price_format($info['salary_min'], $country_code);
                    $item[$info['id']]['salary_max'] = price_format($info['salary_max'], $country_code);

                    if (!empty($info['city_code'])) {
                        $city_detail = get_cityDetail_by_id($info['city_code']);
                        if (!empty($city_detail)) {
                            $city = $city_detail['asciiname'];
                            $state = get_stateName_by_id($city_detail['subadmin1_code']);
                        }
                    }
                    $item[$info['id']]['city'] = $city ?? $info['city'];
                    $item[$info['id']]['state'] = $state;
                    $item[$info['id']]['user_id'] = $info['user_id'];
                    $item[$info['id']]['favorite'] = check_user_favorite($info['user_id'], $user_id);

                    $resume_link = null;
                    if (!empty($info['resume_id'])) {
                        $result = ORM::for_table($config['db']['pre'] . 'resumes')
                            ->where('user_id', $info['user_id'])
                            ->where('id', $info['resume_id'])
                            ->where('active', '1')
                            ->find_one();

                        if (!empty($result)) {
                            $resume_link = $config['site_url'] . "storage/resumes/" . $result['filename'];
                        }
                    }
                    $item[$info['id']]['resume'] = $resume_link;
                }
                $item = array_values($item);
            }
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['SUCCESS'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['INVALID_USER'];
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }

    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'total' => $total, 'applied_jobs' => $item];
    send_json($results);
    die();
}

function report_job()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $report = ORM::for_table($config['db']['pre'] . 'reports')->create();
    $report->sender_fullname = $_REQUEST['name'];
    $report->sender_email = $_REQUEST['email'];
    $report->sender_username = $_REQUEST['username'];
    $report->violator_username = $_REQUEST['username2'];
    $report->violation_subject = $_REQUEST['violation'];
    $report->violation_url = $_REQUEST['url'];
    $report->violation_message = $_REQUEST['details'];
    $report->created_at = date('Y-m-d H:i:s');
    $report->save();
    /*SEND CONTACT EMAIL*/
    // email_template("report");
    if ($report->id) {
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['REPORTED'];
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['NOT_REPORTED'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message];
    send_json($results);
    die();
}

function get_employer_job_list()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $items = array();

    $total = 0;
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $usertype = get_user_data(null, $user_id)['user_type'];
        $status = (isset($_REQUEST['status']) && !empty($_REQUEST['status'])) ? $_REQUEST['status'] : '';
        $keywords = isset($_REQUEST['keywords']) ? str_replace("-", " ", trim($_REQUEST['keywords'])) : "";
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 10;
        if ($usertype == 'employer') {
            if ($status == 'resubmitted') {
                $items = get_resubmited_items($user_id, $status, $page, $limit, "id", $keywords);
            } else {
                $items =  get_items($user_id, $status, false, $page, $limit, 'p.id', false, false, 'DESC', null, $keywords);
            }
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['SUCCESS'];
            $total = (count($items));
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['INVALID_USER'];
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'total' => $total, 'jobs' => array_values($items)];
    send_json($results);
    die();
}

function get_timesheets()
{
    // dd($_REQUEST);
    global $config, $lang, $status, $status_code, $message, $results;
    $item = $where = [];
    $dispute_id = $dispute_description = $dispute_status = $disputed_at = $dispute_created_at = $rejected_dispute_reason = $dispute_amount = "";
    $is_disputed = false;
    $total = 0;
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');

        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
        $limit = (isset($_REQUEST['limit']) && !empty($_REQUEST['limit'])) ? $_REQUEST['limit'] : 10;
        $offset = ($page - 1) * $limit;

        $user_type = get_user_data(null, $user_id)['user_type'];
        if ($user_type == "employer") {
            $commission = (int)get_option('client_commission');
            //to status filter for employer
            if (isset($_REQUEST['status']) && $_REQUEST['status'] != "") {
                if ($_REQUEST['status'] == "invoiced") {
                    $where = "(a.client_id = '$user_id' AND a.status = 'accepted' AND t.invoice_generate = '1') OR (t.without_agreement ='1' AND t.without_agr_client_id = '$user_id' AND t.invoice_generate = '1')";
                } elseif ($_REQUEST['status'] == "paid" || $_REQUEST['status'] == "unpaid") {
                    $where = "(a.client_id = '$user_id' AND a.status = 'accepted' AND t.payment_status ='" . $_REQUEST['status'] . "') OR (t.without_agreement ='1' AND t.without_agr_client_id = '$user_id' AND t.payment_status = '" . $_REQUEST['status'] . "')";
                } else {
                    $where = "(a.client_id = '$user_id' AND a.status = 'accepted' AND t.status = '" . $_REQUEST['status'] . "') OR (t.without_agreement ='1' AND t.without_agr_client_id = '$user_id' AND t.status = '" . $_REQUEST['status'] . "')";
                }
            } else {
                $where = "(a.client_id = '$user_id' AND a.status = 'accepted') OR (t.without_agreement ='1' AND t.without_agr_client_id = '$user_id')";
            }
            $total = ORM::for_table($config['db']['pre'] . 'timesheets')->table_alias('t')
                ->left_outer_join($config['db']['pre'] . 'user_agreements', array('a.id', '=', 't.agreement_id'), 'a')
                ->where_raw($where)
                ->count();
            // dd(ORM::get_last_query());

            $join_condition = 'a.worker_id=u.id';
            $join_condition1 = ' t.worker_id = wac.id';
        } elseif ($user_type == "user") {
            $commission = (int)get_option('worker_commission');
            //to status filter for user
            if (isset($_REQUEST['status']) && $_REQUEST['status'] != "") {
                if ($_REQUEST['status'] == "invoiced") {
                    $where = "t.worker_id = $user_id AND a.status = 'accepted' AND t.invoice_generate = '1'";
                } elseif ($_REQUEST['status'] == "paid" || $_REQUEST['status'] == "unpaid") {
                    $where = "t.worker_id = $user_id AND a.status = 'accepted' AND t.payment_status = '" . $_REQUEST['status'] . "' ";
                } else {
                    $where = "t.worker_id = $user_id AND a.status = 'accepted' AND t.status = '" . $_REQUEST['status'] . "' ";
                }
            } else {
                $where = "t.worker_id = $user_id AND a.status = 'accepted'";
            }
            $total = ORM::for_table($config['db']['pre'] . 'timesheets')->table_alias('t')
                ->left_outer_join($config['db']['pre'] . 'user_agreements', array('a.id', '=', 't.agreement_id'), 'a')
                ->where_raw($where)->count();
            $join_condition = 'a.client_id=u.id';
            $join_condition1 = ' t.without_agr_client_id = wac.id';
        }
        if ($total > 0) {
            $shift_data = ORM::for_table($config['db']['pre'] . 'timesheets')->table_alias('t')
                ->select_many('t.*', 'a.post_id', 'a.client_id', 'a.worker_id', 'a.status', 'a.agreed_services', 'a.created_at', 'a.updated_at', 'ar.*', 'u.name', 'u.username', ['id' => 't.id', 'status' => 't.status', 'post_status' => 'p.status', 'post_name' => 'p.product_name', 'without_agr_client_name' => 'wac.name', 'without_agr_client_username' => 'wac.username', 'date_created' => 't.created_at'])
                ->where_raw($where)
                ->where_null('t.deleted_at')
                ->left_outer_join($config['db']['pre'] . 'user_agreements', array('a.id', '=', 't.agreement_id'), 'a')
                ->left_outer_join($config['db']['pre'] . 'user_agreements_rates', array('ar.id', '=', 't.agreement_rate_id'), 'ar')
                ->left_outer_join($config['db']['pre'] . 'product', array('a.post_id', '=', 'p.id'), 'p')
                ->left_outer_join($config['db']['pre'] . 'user', $join_condition, 'u')
                ->left_outer_join($config['db']['pre'] . 'user', $join_condition1, 'wac')
                ->limit($limit)->offset($offset)
                ->find_array();
            // dd($shift_data);
            // dd(ORM::get_last_query());    

            foreach ($shift_data as $info) {
                $duspute_info = ORM::for_table($config['db']['pre'] . 'disputes')->where('timesheet_id', $info['id'])->find_one();
                if (!empty($duspute_info)) {
                    $is_disputed = true;
                    $dispute_id = $duspute_info['id'];
                    $dispute_status = $duspute_info['status'];
                    $dispute_amount = $duspute_info['amount'];
                    $dispute_description = $duspute_info['amount'];
                    $dispute_created_at = $duspute_info['created_at'];
                    $disputed_at = $duspute_info['disputed_at'];
                    $rejected_dispute_reason = $duspute_info['reason'];
                }

                if ($info['incidence_occured'] == "1") {
                    $incident = '<i class="icon-feather-archive" style="color: red"> Incident Occured</i><br>';
                } else {
                    $incident = "";
                }
                if ($info['without_agreement'] == 0) {
                    $name = !empty($info['name']) ? ucwords($info['name']) : ucfirst($info['username']);
                } else {
                    $name = !empty($info['without_agr_client_name']) ? ucwords($info['without_agr_client_name']) : ucfirst($info['without_agr_client_username']);
                }

                $datetime1 = new DateTime($info['start_time']);
                $datetime2 = new DateTime($info['end_time']);
                $interval = $datetime1->diff($datetime2);

                $iCostPerHour = !empty($info['rate']) ? $info['rate'] : $info['without_agr_mannual_rate'];
                $h = $interval->format('%H');
                $m = $interval->format('%I');
                $hour_rate = $h * $iCostPerHour + $m / 60 * $iCostPerHour;
                if ($user_type == 'employer') {
                    $total_hour_rate = $hour_rate + ($hour_rate * $commission / 100);
                } else {
                    $total_hour_rate = $hour_rate - ($hour_rate * $commission / 100);
                }

                $total_due = number_format((float)$total_hour_rate, 2, '.', '');

                $item[$info['id']]['id'] = $info['id'];
                $item[$info['id']]['description'] = $info['shift_details'];
                $item[$info['id']]['hours'] = $interval->format('%h') . ' Hrs ' . $interval->format('%i') . ' Min';
                $item[$info['id']]['date'] = date('d/m/Y', strtotime($info['date_created']));
                $item[$info['id']]['due'] =  $total_due;
                $item[$info['id']]['status'] = $info['status'];
                $item[$info['id']]['payment_status'] = ucfirst($info['payment_status']);
                $item[$info['id']]['invoice_generate'] = $info['invoice_generate'];
                $item[$info['id']]['invoice_generate_date'] = !empty($info['invoice_generate_date']) ? date('d/m/Y', strtotime($info['invoice_generate_date'])) : '';
                $item[$info['id']]['payment_at'] = !empty($info['disbursed_at']) ? date('d/m/Y', strtotime($info['disbursed_at'])) : '';
                $item[$info['id']]['approved_at'] = !empty($info['approved_at']) ? date('d/m/Y', strtotime($info['approved_at'])) : '';
                $item[$info['id']]['fullname'] = $name;
                $item[$info['id']]['post_name'] = $info['post_name'];
                $item[$info['id']]['post_status'] = $info['post_status'];
                $item[$info['id']]['is_disputed'] = $is_disputed;
                $item[$info['id']]['dispute_id'] =   $dispute_id;
                $item[$info['id']]['dispute_status'] = $dispute_status;
                $item[$info['id']]['dispute_amount'] = $dispute_amount;
                $item[$info['id']]['dispute_description'] = $dispute_description;
                $item[$info['id']]['dispute_created_at'] = $dispute_created_at;
                $item[$info['id']]['disputed_at'] = $disputed_at;
                $item[$info['id']]['rejected_dispute_reason'] = $rejected_dispute_reason;
                $item[$info['id']]['incident_occurred'] = ($info['incidence_occured'] == 1) ? true : false;
                $incident = ORM::for_table($config['db']['pre'] . 'incidents')->select('id')->where('timesheet_id', $info['id'])->find_one();
                $item[$info['id']]['incident_id'] = !empty($incident) ? $incident['id'] : '';
            }
            $item = array_values($item);
        }
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'total' => $total, 'items' => $item];
    send_json($results);
    die();
}

function getShiftById()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $shift_data = [];
    $loggedin = checkIsLoggedin();
    $user_id = $loggedin['user_id'];
    $shift_id = (isset($_REQUEST['shift_id']) && !empty($_REQUEST['shift_id'])) ? $_REQUEST['shift_id'] : null;
    $shift_data = get_shift_data($shift_id);
    if (!empty($shift_data)) {
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['NOT_FOUND'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'items' => $shift_data];
    send_json($results);
    die();
}

function incident_detail()
{
    global $config, $lang;
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    $item = [];
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
        $timesheetid = isset($_REQUEST['timesheetid']) ? $_REQUEST['timesheetid'] : "";
        if (!empty($id)) {
            $item = get_incident_detail($id);
        } else {
            $item = get_incident_detail(null, $timesheetid);
        }
        if (!empty($item)) {
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['SUCCESS'];
        } else {
            $item = [];
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['NOT_FOUND'];
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'incident_detail' => $item];
    send_json($results);
    die();
}

function save_shift()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $item = [];
    $errors = 0;
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        if ($_REQUEST['agreement'] == "") {
            $message = "Agreement Id Not Found !";
            $errors++;
        } else {
            $agreement_data = ORM::for_table($config['db']['pre'] . 'user_agreements')->find_one($_REQUEST['agreement']);
            if (empty($agreement_data)) {
                $status_code = HTTP_UNPROCESSABLE_ENTITY;
                $status = $lang['ERROR'];
                $message = "No Agreement Found !";
                $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token];
                send_json($results);
                die();
            }
            $shiftvalidation = agreementValidation($agreement_data['post_id'], $_REQUEST['start_time'], $_REQUEST['start_date'], $_REQUEST['agreement'], $_REQUEST['agreement_rate']);
            if ($shiftvalidation == 1) {
                $status_code = HTTP_UNPROCESSABLE_ENTITY;
                $status = $lang['ERROR'];
                $message = "Shift Already Created !";
                $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token];
                send_json($results);
                die();
            }
            $user_id = get_device_token($valid_auth_token, 'user_id');
            $attachment = $attachment_type = '';
            if (!empty($_FILES['attachment'])) {
                $file = $_FILES['attachment'];
                $attc_files = trim(get_option("resume_files"));
                $valid_formats = explode(',', $attc_files);
                $filename = $file['name'];
                $ext = getExtension($filename);
                $ext = strtolower($ext);
                if (!empty($filename)) {
                    if (in_array($ext, $valid_formats)) {
                        $attachment_type = $ext;
                        $main_path = ROOTPATH . "/storage/timesheet/";
                        if (!file_exists($main_path)) {
                            mkdir($main_path, 0777);
                        }
                        $filename = uniqid(time()) . '.' . $ext;
                        if (move_uploaded_file($file['tmp_name'], $main_path . $filename)) {
                            $attachment = $filename;
                        } else {
                            $message = $lang['ERROR_TRY_AGAIN'];
                            $errors++;
                        }
                    } else {
                        $message = $lang['RESUME_FILE_TYPE'];
                        $errors++;
                    }
                }
            }
            if ($errors == 0) {
                $start_date = !empty($_POST['start_date']) ? date('Y-m-d', strtotime($_POST['start_date'])) : date('Y-m-d');
                $end_date = !empty($_POST['end_date']) ? date('Y-m-d', strtotime($_POST['end_date'])) : date('Y-m-d');
                $start_time = !empty($_REQUEST['start_time']) ? date('H:i:s', strtotime($_REQUEST['start_time'])) : '';
                $end_time = !empty($_REQUEST['end_time']) ? date('H:i:s', strtotime($_REQUEST['end_time'])) : '';
                $incident_occured = isset($_REQUEST['incidence_occured']) ? $_REQUEST['incidence_occured'] : '0';
                if (!empty($_REQUEST['id'])) {
                    $timesheet_id = $_REQUEST['id'];
                    $update_shift = ORM::for_table($config['db']['pre'] . 'timesheets')->find_one($_REQUEST['id']);
                    $update_shift->worker_id = $user_id;
                    $update_shift->agreement_id = $_REQUEST['agreement'];
                    $update_shift->agreement_rate_id = $_REQUEST['agreement_rate'];
                    $update_shift->start_time = $start_time;
                    $update_shift->end_time = $end_time;
                    $update_shift->start_date = $start_date;
                    $update_shift->end_date = $end_date;
                    $update_shift->attachment = $attachment;
                    $update_shift->attachment_type = $attachment_type;
                    $update_shift->status    = 'submitted';
                    $update_shift->shift_details = $_REQUEST['shift_details'];
                    $update_shift->incidence_occured = $incident_occured;
                    $update_shift->save();
                    if ($incident_occured == 1) {
                        $time = !empty($_REQUEST['time']) ? date('H:i:s', strtotime($_REQUEST['time'])) : '';
                        $update_incident = ORM::for_table($config['db']['pre'] . 'incidents')->find_one($_REQUEST['incident_id']);
                        if ($update_incident) {
                            $update_incident->date = date("Y-m-d", strtotime($_REQUEST['date']));
                            $update_incident->time = $time;
                            $update_incident->location = $_REQUEST['location'];
                            $update_incident->involved_in_incident = $_REQUEST['involved_in_incident'];
                            $update_incident->before_incident = $_REQUEST['before_incident'];
                            $update_incident->incident_details    = $_REQUEST['incident_details'];
                            $update_incident->immediate_action = $_REQUEST['immediate_action'];
                            $update_incident->incident_result = $_REQUEST['incident_result'];
                            $update_incident->longitude = $_REQUEST['longitude'];
                            $update_incident->latitude = $_REQUEST['latitude'];
                            $update_incident->save();
                        } else {
                            $create_incident =  ORM::for_table($config['db']['pre'] . 'incidents')->create();
                            $create_incident->timesheet_id = $timesheet_id;
                            $create_incident->date = $_REQUEST['date'];
                            $create_incident->time = $time;
                            $create_incident->location = $_REQUEST['location'];
                            $create_incident->involved_in_incident = $_REQUEST['involved_in_incident'];
                            $create_incident->before_incident = $_REQUEST['before_incident'];
                            $create_incident->incident_details    = $_REQUEST['incident_details'];
                            $create_incident->immediate_action = $_REQUEST['immediate_action'];
                            $create_incident->incident_result = $_REQUEST['incident_result'];
                            $create_incident->longitude = $_REQUEST['longitude'];
                            $create_incident->latitude = $_REQUEST['latitude'];
                            $create_incident->save();
                        }
                    }
                    $status_code = HTTP_OK;
                    $status = $lang['SUCCESS'];
                    $message = $lang['UPDATED_SUCCESS'];
                } else {
                    $incident_occured = $_REQUEST['incidence_occured'] ? $_REQUEST['incidence_occured'] : '0';
                    $create_shift =  ORM::for_table($config['db']['pre'] . 'timesheets')->create();
                    $create_shift->worker_id = $user_id;
                    $create_shift->agreement_id = $_REQUEST['agreement'];
                    $create_shift->agreement_rate_id = $_REQUEST['agreement_rate'];
                    $create_shift->start_time = $start_time;
                    $create_shift->end_time = $end_time;
                    $create_shift->start_date = $start_date;
                    $create_shift->end_date = $end_date;
                    $create_shift->attachment = $attachment;
                    $create_shift->attachment_type = $attachment_type;
                    $create_shift->status    = 'submitted';
                    $create_shift->shift_details = $_REQUEST['shift_details'];
                    $create_shift->incidence_occured = $incident_occured;
                    $create_shift->save();
                    $timesheet_id = $create_shift->id;
                    if ($incident_occured == 1) {

                        $time = !empty($_REQUEST['time']) ? date('H:i:s', strtotime($_REQUEST['time'])) : '';
                        $create_incident =  ORM::for_table($config['db']['pre'] . 'incidents')->create();
                        $create_incident->timesheet_id = $timesheet_id;
                        $create_incident->date = $_REQUEST['date'];
                        $create_incident->time = $time;
                        $create_incident->location = $_REQUEST['location'];
                        $create_incident->involved_in_incident = $_REQUEST['involved_in_incident'];
                        $create_incident->before_incident = $_REQUEST['before_incident'];
                        $create_incident->incident_details    = $_REQUEST['incident_details'];
                        $create_incident->immediate_action = $_REQUEST['immediate_action'];
                        $create_incident->incident_result = $_REQUEST['incident_result'];
                        $create_incident->longitude = $_REQUEST['longitude'];
                        $create_incident->latitude = $_REQUEST['latitude'];
                        $create_incident->save();
                    }
                    // WithdrawAffliateMony($user_id);
                    $status_code = HTTP_OK;
                    $status = $lang['SUCCESS'];
                    $message = $lang['SAVED_SUCCESS'];

                    $user_data = get_user_data(null, $user_id);
                    $userfullname = !empty($user_data['name']) ?  $user_data['name'] : $user_data['username'];
                    $shift_data =  get_shift_data($timesheet_id);
                    if (!empty($shift_data)) {
                        // Send Notification Funtion 
                        $notification = "false";

                        $reciver_id =  $shift_data['client_id'];
                        $check_notification = get_user_notification_type_new($reciver_id);
                        if (!empty($check_notification) && array_key_exists("timesheet_submit", $check_notification)) {
                            if ($check_notification['timesheet_submit'] == "1") {
                                $notification = "true";
                            }
                        } else {
                            $notification = "true";
                        }

                        if ($notification == "true") {
                            $notify_data = [
                                'recepient_id' => $reciver_id,
                                'sender_id' => $user_id,
                                'reference_id' => $timesheet_id,
                                'type' =>  'timesheet_submit'
                            ];
                            insert_notification($notify_data);
                            $title = 'New timesheet submitted!';
                            $msg = ucfirst($userfullname) . ' has submitted new timesheet.';
                            $other_data = ['reference_id' => $timesheet_id, 'action_type' => 'timesheet_submit'];
                            sendFCM($msg, $reciver_id, $title, $other_data);
                        }
                    }
                }
            } else {
                $status_code = HTTP_UNPROCESSABLE_ENTITY;
                $status = $lang['ERROR'];
                $message = $lang['FAILED'];
            }
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token];
    send_json($results);
    die();
}

//For employer (Approve or Reject timesheet(shift))
function approve_reject_shift()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $id = $_REQUEST['id'];
    $status = $_REQUEST['status'];
    $loggedin = checkIsLoggedin();
    $user_id = $loggedin['user_id'];
    $user_data = get_user_data(null, $user_id);
    $userfullname = !empty($user_data['name']) ?  $user_data['name'] : $user_data['username'];
    $ts = ORM::for_table($config['db']['pre'] . 'timesheets')->find_one($id);
    if ($user_data['user_type'] == 'employer') {
        $ts->status = $status;
        $ts->approved_at = date("Y-m-d h:i:s");
        if ($ts->save()) {
            $title = $type = $msg = '';
            if ($status == 'approved') {
                $type = 'timesheet_approved';
                $message = $lang['SHIFT_APPROVED'];
                $title = 'Timesheet approved!';
                $msg = ucfirst($userfullname) . ' has approved your timesheet.';
            } else {
                $type = 'timesheet_rejected';
                $message = $lang['SHIFT_REJECTED'];
                $title = 'Timesheet rejected!';
                $msg = ucfirst($userfullname) . ' has rejected your timesheet.';
            }
            // Send Notification Funtion 
            $notification = "false";

            $reciver_id = $ts->worker_id;
            $check_notification = get_user_notification_type_new($reciver_id);
            if (!empty($check_notification) && array_key_exists($type, $check_notification)) {
                if ($check_notification[$type] == "1") {
                    $notification == "true";
                }
            } else {
                $notification = "true";
            }
            if ($notification == "true") {
                $notify_data = [
                    'recepient_id' => $reciver_id,
                    'sender_id' => $user_id,
                    'reference_id' => $id,
                    'type' => $type,
                ];
                insert_notification($notify_data);
                /*To send email*/
                // email_template("shift_approve", $get_shift_data['worker_id'], "", "", "", $id);

                /*To send FCM notification */
                $other_data = ['reference_id' => $id, 'action_type' => $type];
                sendFCM($msg, $reciver_id, $title, $other_data);
            }
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['FAILED'];
        }
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['INVALID_USER'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token']];
    send_json($results);
    die();
}

function delete_shift()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $loggedin = checkIsLoggedin();
    if (isset($_REQUEST['id']) && $_REQUEST['id'] != "") {
        $id = $_REQUEST['id'];
        $ts = ORM::for_table($config['db']['pre'] . 'timesheets')->find_one($id);
        if ($ts) {
            $ts->deleted_at = date('Y-m-d H:i:s');
            $ts->save();
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['DELETE_SUCCESS'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['INVALID_ID'];
        }
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = "Id is required !";
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token']];
    send_json($results);
    die();
}

function get_user_documents()
{
    global $lang, $status, $status_code, $message, $results;
    $items = [];
    $errors = 0;
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $document_id = isset($_REQUEST['id']) && !empty($_REQUEST['id']) ? $_REQUEST['id'] : '';
        $items = user_documents($user_id, $document_id);
        $items = array_values($items);
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['SUCCESS'];
        $items = array_values($items);
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'items' => $items];
    send_json($results);
    die();
}

function requirement_list()
{
    global $config, $lang, $results;
    $items = [];
    $loggedin = checkIsLoggedin();
    $user_id = $loggedin['user_id'];
    $edit = isset($_REQUEST['edit']) ? 1 : 0;
    if ($edit) {
        $user_doc_info = ORM::for_table($config['db']['pre'] . 'user_documents')->where('id', $_GET['id'])->find_one();
        $sql_con1 = 'r.id NOT IN (SELECT requirement_id FROM ' . $config['db']['pre'] . 'user_documents WHERE name NOT LIKE "%custom%" AND user_id=' . $user_id . '  AND r.id NOT IN(SELECT requirement_id FROM ' . $config['db']['pre'] . 'user_documents WHERE user_id=' . $user_id . ' AND requirement_id=' . $user_doc_info['requirement_id'] . '))';
    } else {
        $sql_con1 = 'r.id NOT IN (SELECT requirement_id FROM ' . $config['db']['pre'] . 'user_documents WHERE user_id=' . $user_id . ' AND name NOT LIKE "%custom%")';
    }

    $jobRequirements = ORM::for_table($config['db']['pre'] . 'requirements')->table_alias('r')
        ->where('status', '1')
        ->where_raw($sql_con1)
        ->find_array();
    foreach ($jobRequirements as $info) {
        $items[$info['id']]['id'] = $info['id'];
        $items[$info['id']]['name'] = $info['name'];
        $items[$info['id']]['expiry_date'] = $info['expiry_date'];
        $items[$info['id']]['upload'] = $info['upload'];
        $items[$info['id']]['registration_number'] = $info['registration_number'];
        $items = array_values($items);
    }
    // $data = ORM::for_table($config['db']['pre'] . 'requirements')->where('status', 1)->whereNull('deleted_at')->find_many()->as_array();
    // if (!empty($data)) {
    //     foreach ($data as $info) {
    //         $items[$info['id']]['id'] = $info['id'];
    //         $items[$info['id']]['name'] = $info['name'];
    //         $items[$info['id']]['expiry_date'] = $info['expiry_date'];
    //         $items[$info['id']]['upload'] = $info['upload'];
    //         $items[$info['id']]['registration_number'] = $info['registration_number'];
    //     }
    //     $items = array_values($items);
    // }
    $results = ['status_code' => HTTP_OK, 'status' => $lang['SUCCESS'], 'message' => $lang['SUCCESS'], 'items' => $items];
    send_json($results);
    die();
}

function save_document()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $items = [];
    $errors = [];
    $document_file = $ext = '';
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        if (empty($_REQUEST['document_type'])) {
            $errors['document_type'] = $lang['CHOOSE_OPTION'];
        }
        if (isset($_REQUEST['custom_document']) && empty($_REQUEST['custom_document'])) {
            $errors['custom_document'] = $lang['CUSTOMDOC_NAME_REQ'];
        }
        if (isset($_REQUEST['document_file']) && empty($_REQUEST['document_file'])) {
            if (empty($file_check)) {
                $errors['document_file'] = $lang['DOCUMENT_FILE_REQ'];
            }
        }
        if (isset($_REQUEST['expiry_date']) && empty($_REQUEST['expiry_date'])) {
            $errors['expiry_date'] = $lang['EXPIRY_DATE_REQ'];
        }
        if (isset($_REQUEST['registration_number']) && empty($_REQUEST['registration_number'])) {
            $errors['registration_number'] = $lang['REG_NUM_REQ'];
        }
        if (isset($_REQUEST['description']) && empty($_REQUEST['description'])) {
            $errors['description'] = $lang['DESCRIPTION_REQ'];
        }

        if (!count($errors) > 0) {
            if (!empty($_FILES['document_file']['name'])) {
                $file = $_FILES['document_file'];
                $valid_formats = ['pdf'];
                //$valid_formats = explode(',', $resume_files);
                $filename = $file['name'];
                $ext = getExtension($filename);
                $ext = strtolower($ext);
                if (!empty($filename)) {
                    if (in_array($ext, $valid_formats)) {
                        $main_path = ROOTPATH . "/storage/document/";
                        if (!file_exists($main_path)) {
                            mkdir($main_path, 0777);
                        }
                        $filename = uniqid(time()) . '.' . $ext;
                        if (move_uploaded_file($file['tmp_name'], $main_path . $filename)) {
                            $document_file = $filename;
                        } else {
                            $errors['document_file'] = $lang['ERROR_TRY_AGAIN'];
                        }
                    } else {
                        $errors['document_file'] = $lang['CHOOSE_FILE'];
                    }
                } else {
                    $errors['document_file'] = $lang['DOCUMENT_FILE_REQ'];
                }
            }
        }
        if (!count($errors) > 0) {
            $custom_document = isset($_REQUEST['custom_document']) && !empty($_REQUEST['custom_document']) ? $_REQUEST['custom_document'] : '';
            $expiry_date = date('Y-m-d', strtotime($_REQUEST['expiry_date']));
            $now = date("Y-m-d H:i:s");
            if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
                $user_doc_info = ORM::for_table($config['db']['pre'] . 'user_documents')->where('id', $_REQUEST['id'])->find_one();
                if ($user_doc_info) {
                    if (!empty($document_file)) {
                        $old_path = $user_doc_info['file_path'];
                        $file =  ROOTPATH . "/storage/document/" . $old_path;
                        if (file_exists($file))
                            unlink($file);
                        $user_doc_info->set('file_path', $document_file);
                    }
                    $user_doc_info->set('custom_document', $custom_document);
                    $user_doc_info->set('expiry_date', $expiry_date);
                    $user_doc_info->set('extension', $ext);
                    $user_doc_info->set('requirement_id', $_REQUEST['document_type']);
                    $user_doc_info->set('details', $_REQUEST['description']);
                    $user_doc_info->set('registration_number', $_REQUEST['registration_number']);
                    $user_doc_info->set('status', 'submitted');
                    $user_doc_info->set('updated_at', $now);
                    $user_doc_info->save();
                    $message = $lang['UPDATED_SUCCESS'];
                } else {
                    $message = $lang['INVALID_ID'];
                }
            } else {
                $user_doc_info = ORM::for_table($config['db']['pre'] . 'user_documents')->create();
                $user_doc_info->user_id = $user_id;
                $user_doc_info->requirement_id = $_REQUEST['document_type'];
                $user_doc_info->custom_document = $custom_document;
                $user_doc_info->extension = $ext;
                $user_doc_info->details = $_REQUEST['description'];
                $user_doc_info->registration_number = $_REQUEST['registration_number'];
                $user_doc_info->expiry_date = $expiry_date;
                $user_doc_info->status = 'submitted';
                if (!empty($document_file)) {
                    $user_doc_info->file_path = $document_file;
                }
                $user_doc_info->created_at  = $now;
                $user_doc_info->updated_at  = $now;
                $user_doc_info->save();
                $message = $lang['SAVED_SUCCESS'];
            }
            $items = array_values(user_documents($user_id));
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['FAILED'];
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'errors' => $errors, 'auth_token' => $valid_auth_token, 'items' => $items];
    send_json($results);
    die();
}

function delete_document()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $items = [];
    $errors = [];
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $row = ORM::for_table($config['db']['pre'] . 'user_documents')->select_many('id', 'file_path')->where(array(
            'id' => $_REQUEST['id'],
            'user_id' => $user_id,
        ))->find_one();

        if (!empty($row)) {
            $old_file = $row['file_path'];
            $file =  ROOTPATH . "/storage/document/" . $old_file;
            if ($row->delete()) {
                if (file_exists($file))
                    unlink($file);
            }
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['DELETED'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['NOT_FOUND'];
        }
        $items = array_values(user_documents($user_id));
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'errors' => $errors, 'auth_token' => $valid_auth_token, 'items' => $items];
    send_json($results);
    die();
}

function invoice_list()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $item = [];
    $errors = [];
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $user_data = get_user_data(null, $user_id);
        $user_type = $user_data['user_type'];
        if ($user_type == 'employer') {
            $invoice_data = ORM::for_table($config['db']['pre'] . 'invoice')->where('clientid', $user_id)->find_many();
        } else {
            $invoice_data = ORM::for_table($config['db']['pre'] . 'invoice')->table_alias('i')
                ->select_many('i.*', ['id' => 'i.id'])
                ->where(array(
                    'items.worker_id' => $user_id,
                ))
                ->join($config['db']['pre'] . 'invoice_items', array('items.invoice_id', '=', 'i.id'), 'items')
                ->group_by('i.id')
                ->find_many();
        }
        foreach ($invoice_data as $key => $info) {
            $status_payment = ($info['status'] == "paid") ? "Created" : "Unpaid";
            $item[$key]['id'] = $info['id'];
            $item[$key]['status'] = $status_payment;
            $invoice_workers = explode(',', $info['worker_id']);
            $invoice_for = [];
            foreach ($invoice_workers as $worker) {
                $user_name =  ORM::for_table($config['db']['pre'] . 'user')->select('username')->find_one($worker);
                if (!empty($user_name)) {
                    $invoice_for[] = ['id' => $worker, 'username' => $user_name['username']];
                }
            }
            $invoice_name = 'Invoice from ( ' . date("d M Y", strtotime($info['duedate'])) . ' ) to ( ' . date("d M Y", strtotime($info['date'])) . ' )';
            $item[$key]['invoice_for'] = $invoice_for;
            $item[$key]['payment_status'] = $info['status'];
            $item[$key]['inv_name'] = $info['prefix'] . $info['id'];
            $item[$key]['total_amount'] = $info['total'];
            $item[$key]['invoice_name'] = $invoice_name;
            $item[$key]['date'] = date("d/m/Y", strtotime($info['datecreated']));
        }
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'errors' => $errors, 'auth_token' => $valid_auth_token, 'items' => $item];
    send_json($results);
    die();
}

function invoiceById()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $item = $timesheet = [];
    $errors = [];
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $invoice_id = isset($_REQUEST['id']) && !empty($_REQUEST['id']) ? $_REQUEST['id'] : '';
        $invoice_worker = "";
        if (!empty($invoice_id)) {
            $user_id = get_device_token($valid_auth_token, 'user_id');
            $user_data = get_user_data(null, $user_id);
            $user_type = $user_data['user_type'];
            $invoice_data = ORM::for_table($config['db']['pre'] . 'invoice')->table_alias('inv')
                ->select_many('inv.*', 'abn.invoice_logo', 'abn.abn', 'abn.company_name', 'abn.trading_name')
                ->where('inv.id', $invoice_id)
                ->left_outer_join($config['db']['pre'] . 'user_abn_details', 'abn.user_id=inv.clientid', 'abn')
                ->find_one();
            $commission_client = (int)get_option('client_commission');
            $commission_worker = (int)get_option('worker_commission');
            if (isset($_REQUEST['worker_id']) && $_REQUEST['worker_id'] != "") {
                $invoice_worker = $_REQUEST['worker_id'];
                $result_invoice = ORM::for_table($config['db']['pre'] . 'invoice')->table_alias('i')
                    ->select_many('t.*', 'a.*', 'ar.*', 'w.name', 'w.username', ['id' => 't.id', 'status' => 't.status', 'worker_id' => 't.worker_id', 'username' => 'w.username'])
                    ->where(array(
                        'i.id' => $invoice_id,
                        'items.worker_id' => $invoice_worker,
                    ))
                    ->join($config['db']['pre'] . 'invoice_items', array('items.invoice_id', '=', 'i.id'), 'items')
                    ->join($config['db']['pre'] . 'timesheets', array('t.id', '=', 'items.timesheet_id'), 't')
                    ->join($config['db']['pre'] . 'user_agreements', array('a.id', '=', 't.agreement_id'), 'a')
                    ->join($config['db']['pre'] . 'user_agreements_rates', array('ar.id', '=', 't.agreement_rate_id'), 'ar')
                    ->join($config['db']['pre'] . 'user', array('w.id', '=', 't.worker_id'), 'w')
                    ->find_many();
            } else {
                if ($user_data['user_type'] == 'employer') {
                    $result_invoice = ORM::for_table($config['db']['pre'] . 'invoice')->table_alias('i')
                        ->select_many('t.*', 'a.*', 'ar.*', 'w.name', 'w.username', ['id' => 't.id'], ['status' => 't.status'], ['worker_id' => 't.worker_id'], ['username' => 'w.username', 'name' => 'w.name'])
                        ->where(array(
                            'i.id' => $invoice_id,
                        ))
                        ->join($config['db']['pre'] . 'invoice_items', array('items.invoice_id', '=', 'i.id'), 'items')
                        ->join($config['db']['pre'] . 'timesheets', array('t.id', '=', 'items.timesheet_id'), 't')
                        ->join($config['db']['pre'] . 'user_agreements', array('a.id', '=', 't.agreement_id'), 'a')
                        ->join($config['db']['pre'] . 'user_agreements_rates', array('ar.id', '=', 't.agreement_rate_id'), 'ar')
                        ->join($config['db']['pre'] . 'user', array('w.id', '=', 't.worker_id'), 'w')
                        ->find_many();
                } else {
                    $result_invoice = ORM::for_table($config['db']['pre'] . 'invoice')->table_alias('i')
                        ->select_many('t.*', 'a.*', 'ar.*', 'w.name', 'w.username', ['id' => 't.id'], ['status' => 't.status'], ['worker_id' => 't.worker_id'], ['username' => 'w.username', 'name' => 'w.name'])
                        ->where(array(
                            'i.id' => $invoice_id,
                            'items.worker_id' => $user_id,
                        ))
                        ->join($config['db']['pre'] . 'invoice_items', array('items.invoice_id', '=', 'i.id'), 'items')
                        ->join($config['db']['pre'] . 'timesheets', array('t.id', '=', 'items.timesheet_id'), 't')
                        ->join($config['db']['pre'] . 'user_agreements', array('a.id', '=', 't.agreement_id'), 'a')
                        ->join($config['db']['pre'] . 'user_agreements_rates', array('ar.id', '=', 't.agreement_rate_id'), 'ar')
                        ->join($config['db']['pre'] . 'user', array('w.id', '=', 't.worker_id'), 'w')
                        ->find_many();
                }
            }
            $total_amount = 0;
            $subtotal = 0;

            foreach ($result_invoice as $key => $result) {
                $datetime1 = new DateTime($result['start_time']);
                $datetime2 = new DateTime($result['end_time']);
                $interval = $datetime1->diff($datetime2);
                $iCostPerHour = $result['rate'];
                $h = $interval->format('%H');
                $m = $interval->format('%I');
                $hour_rate = $h * $iCostPerHour + $m / 60 * $iCostPerHour;
                if ($user_type == 'employer') {
                    $invoice_charge = ($hour_rate * $commission_client / 100);
                    $total_hour_rate = $hour_rate + ($hour_rate * $commission_client / 100);
                } else {
                    $invoice_charge = ($hour_rate * $commission_worker / 100);
                    $total_hour_rate = $hour_rate - ($hour_rate * $commission_worker / 100);
                }
                $timesheet[$key]['name'] = empty($result['name']) ? $result['username'] : $result['name'];
                $timesheet[$key]['price'] = number_format($hour_rate, 2, '.', '');
                $timesheet[$key]['plateform_charges'] = number_format($invoice_charge, 2, '.', '');
                $timesheet[$key]['total'] = number_format($total_hour_rate, 2, '.', '');
                $total_amount = $total_amount + $total_hour_rate;
                $subtotal = $subtotal + $hour_rate;
                $timesheet[$key]['shift_start_time'] = date("d/m/Y", strtotime($result['approved_at']));
                $timesheet[$key]['time_duration'] = $result['start_time'] . " to " . $result['end_time'];
                $timesheet[$key]['total_time'] = $h . "." . $m . " hour";
                $timesheet[$key]['rate'] = $iCostPerHour . " Per hour";
            }
            if ($user_type == 'employer') {
                $commission = $commission_client;
            } else {
                $commission = $commission_worker;
            }
            $item['subtotal_amount'] = number_format($subtotal, 2, '.', '');
            $item['amount_total'] = number_format($total_amount, 2, '.', '');
            $item['plateform_charges'] = number_format((($subtotal * $commission) / 100), 2, '.', '');
            $item['status_payment'] = ($invoice_data['status'] == "paid") ? "Created" : "Unpaid";
            $item['invoice_title'] = ($invoice_data['status'] == "paid") ? "Created" : "Unpaid";
            $item['invoice_date'] = 'Date: ' . date("d-m-Y", strtotime($invoice_data['datecreated'])) . '';
            $item['invoice_date2'] = date("d-m-Y", strtotime($invoice_data['datecreated']));
            $item['invoice_to_date'] =  date("d-m-Y", strtotime($invoice_data['date']));
            $item['due_date'] =  date("d-m-Y", strtotime($invoice_data['duedate']));
            $date_diff = (strtotime(date("d-m-Y", strtotime($invoice_data['datecreated']))) - strtotime(date("d-m-Y")));
            $item['date_difference'] = round($date_diff / (60 * 60 * 24));
            $item['currency'] = "eur";
            $client = ORM::for_table($config['db']['pre'] . 'user')->where('id', $user_id)->find_one();
            $item['name'] =  empty($client['name']) ? $client['username'] : $client['name'];
            $citydata = get_cityDetail_by_id($client['city_code']);
            $city = $citydata['asciiname'] ?? '';
            $state = $citydata['subadmin1_code'] ?? '';
            $country = $citydata['country_code'] ?? "AU";
            $item['address'] = [
                'city' => $city,
                'state' => $state,
                'country' => $country,
            ];
            //ABN Details
            $invoice_logo = empty($invoice_data['invoice_logo']) ? 'storage/logo/adminlogo.png' : 'storage/invoice_logo/' . $invoice_data['invoice_logo'];
            $item['invoice_logo'] = $config['site_url'] . $invoice_logo;
            $item['abn'] = !empty($invoice_data['abn']) ? $invoice_data['abn'] : '';
            $item['company_name'] = !empty($invoice_data['company_name']) ? $invoice_data['company_name'] : '';
            $item['trading_name'] =  !empty($invoice_data['trading_name']) ? $invoice_data['trading_name'] : '';
            $item['invoice_item'] = $timesheet;
            $item['download_link'] = $config['site_url'] . 'invoices/' . $invoice_id . '?pdf=true&worker_id=' . $invoice_worker;

            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['SUCCESS'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['INVALID_ID'];
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'errors' => $errors, 'auth_token' => $valid_auth_token, 'items' => $item];
    send_json($results);
    die();
}

function user_notification_setting()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $item = [];
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $user_data = get_user_data(null, $user_id);
        $user_type = $user_data['user_type'];
        $user_noti_types = get_user_notification_type_new($user_id);
        $notification_arr = get_notification_type($user_type);
        if (isset($_REQUEST['notification_type']) && !empty($_REQUEST['notification_type'])) {
            $user_noti_post_data = json_decode($_REQUEST['notification_type'], true);
            foreach ($user_noti_types as $type) {
                if (!in_array($type, $user_noti_post_data)) {
                    $data = ORM::for_table($config['db']['pre'] . 'user_notification_type')->where(['user_id' => $user_id, 'notification_type' => $type])->find_one();
                    if ($data)
                        $data->delete();
                }
            }
            foreach ($user_noti_post_data as $data) {
                $type_exist = ORM::for_table($config['db']['pre'] . 'user_notification_type')->where(['user_id' => $user_id, 'notification_type' => $data])->find_one();
                if (!$type_exist) {
                    $new_type = ORM::for_table($config['db']['pre'] . 'user_notification_type')->create();
                    $new_type->user_id = $user_id;
                    $new_type->notification_type = $data;
                    $new_type->save();
                }
            }
            $notify = in_array('category_job', $user_noti_post_data) ? '1' : '0';
            if ($notify && isset($_REQUEST['choice'])) {
                $choices = json_decode($_REQUEST['choice']);
                $choice = implode(',',  $choices);
                ORM::for_table($config['db']['pre'] . 'notification')
                    ->where_equal('user_id', $user_id)
                    ->delete_many();
                foreach ($choices as $key => $value) {
                    $notification = ORM::for_table($config['db']['pre'] . 'notification')->create();
                    $notification->user_id = $user_id;
                    $notification->cat_id = $value;
                    $notification->user_email = $user_data['email'];
                    $notification->save();
                }
            } else {
                $choice = '';
            }
            $now = date("Y-m-d H:i:s");
            $user_update = ORM::for_table($config['db']['pre'] . 'user')->find_one($user_id);
            $user_update->set('notify', $notify);
            $user_update->set('notify_cat', $choice);
            $user_update->set('updated_at', $now);
            $user_update->save();
            $message = $lang['UPDATED_SUCCESS'];
        } else {
            $message = $lang['SUCCESS'];
        }
        $count = 0;
        $notify_cat = explode(',', $user_data['notify_cat']);
        $category = get_maincategory($notify_cat, true);
        foreach ($notification_arr as $key => $value) {
            $item[$count]['type'] = $key;
            $item[$count]['value'] = $value;
            if ($key == 'category_job') {
                $cate_li = [];
                foreach ($category as $key1 => $cate) {
                    $checked1 = isset($cate['selected']) ? $cate['selected'] : false;
                    $cate_li[$key1]['id'] = $cate['id'];
                    $cate_li[$key1]['name'] = $cate['name'];
                    $cate_li[$key1]['checked'] = $checked1;
                }
                $item[$count]['category_list'] = array_values($cate_li);
            }
            $checked = in_array($key, $user_noti_types) ? true : false;
            $item[$count]['checked'] = $checked;
            $count++;
        }
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'items' => $item];
    send_json($results);
    die();
}

function user_transactions()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $item = [];
    $total = 0;
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $limit = isset($_REQUEST['limit']) && !empty($_REQUEST['limit']) ? $_REQUEST['limit'] :  10;
        $page = isset($_REQUEST['page']) && !empty($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($page - 1) * $limit;
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $total = $rows = ORM::for_table($config['db']['pre'] . 'transaction')->where('userid', $user_id)->where('trash', '0')
            ->count();
        $rows = ORM::for_table($config['db']['pre'] . 'transaction')->where('userid', $user_id)->where('trash', '0')->order_by_desc('id')->limit($limit)->offset($offset)
            ->find_many();

        foreach ($rows as $key => $row) {
            $item[$key]['id'] = $row['id'];
            $item[$key]['product_id'] = $row['product_id'];
            $item[$key]['transaction_description'] = $row['transaction_description'];
            $item[$key]['amount'] = '$' . $row['amount'];
            $item[$key]['payment_by'] = $row['transaction_gatway'];
            $item[$key]['time'] = date('d M Y h:i A', $row['transaction_time']);
            $item[$key]['transaction'] = ucfirst($row['transaction_for']);
            $item[$key]['transaction_type'] = $row['transaction_type'];
            $item[$key]['payment_status'] = $row['status'];
        }
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'total' => $total, 'items' => $item];
    send_json($results);
    die();
}

function user_wallet_history()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $item = [];
    $total_payment = $total_withdraw = 0;
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $limit1 = isset($_REQUEST['p_limit']) && !empty($_REQUEST['p_limit']) ? $_REQUEST['p_limit'] :  10;
        $page1 = isset($_REQUEST['p_page']) && !empty($_REQUEST['p_page']) ? $_REQUEST['p_page'] : 1;
        $offset1 = ($page1 - 1) * $limit1;
        $keyword1 = isset($_REQUEST['keyword1']) && !empty($_REQUEST['p_limit']) ? $_REQUEST['keyword1'] : '';

        $user_id = get_device_token($valid_auth_token, 'user_id');

        $wallet_info = ORM::for_table('job_transaction')->raw_query('SELECT s.*, s.credit - s.debit as Balance, @RunningBalance:= @RunningBalance + s.credit - s.debit RunningBalance from ( SELECT min(id) id,t.userid, sum(case when transaction_type = "debit" then amount else 0 end) as Debit, sum(case when transaction_type = "credit" then amount else 0 end) as Credit from job_transaction t where userid = "' . $user_id . '" and transaction_for = "wallet" and trash = "0" group by userid order by id ) s, (SELECT @RunningBalance:=0) rb order by s.id')->find_one();

        $total_credit = (!empty($wallet_info['Credit']) ? $wallet_info['Credit'] : "0.00");
        $total_debit = (!empty($wallet_info['Debit']) ? $wallet_info['Debit'] : "0.00");

        $total_payment = ORM::for_table($config['db']['pre'] . 'transaction')->where(['userid' => $user_id, 'transaction_for' => 'wallet', 'trash' => '0'])->count();

        $rows = ORM::for_table($config['db']['pre'] . 'transaction')
            ->where(['userid' => $user_id, 'transaction_for' => 'wallet', 'trash' => '0'])
            ->order_by_desc('id')
            ->limit($limit1)->offset($offset1)
            ->find_many();

        $closing_balance = 0;
        $payment = [];
        foreach ($rows as $key => $row) {
            if ($row['transaction_type'] == "credit") {
                $closing_balance = $closing_balance + $row['amount'];
            } else if ($row['transaction_type'] == "debit") {
                $closing_balance = $closing_balance - $row['amount'];
            }
            $payment[$key]['id'] = $row['id'];
            $payment[$key]['description'] = $row['transaction_description'];
            $payment[$key]['date'] = date("d/m/Y", $row['transaction_time']);
            $payment[$key]['debit'] = ($row['transaction_type'] == "debit") ? ($row['amount'] . " $ ") : "--";
            $payment[$key]['credit'] = ($row['transaction_type'] == "credit") ? ($row['amount'] . " $ ") : "--";
            $payment[$key]['closing_balance'] = '$' . sprintf("%.2f", $closing_balance);
        }
        $total_amount = (!empty($wallet_info['RunningBalance']) ? sprintf("%.2f", $wallet_info['RunningBalance']) : "0.00");
        if ($total_amount < 0) {
            $balance_type = "negative";
        } else {
            $balance_type = "positive";
        }


        $limit2 = isset($_REQUEST['w_limit']) && !empty($_REQUEST['w_limit']) ? $_REQUEST['w_limit'] :  10;
        $page2 = isset($_REQUEST['w_page']) && !empty($_REQUEST['w_page']) ? $_REQUEST['w_page'] : 1;
        $offset2 = ($page2 - 1) * $limit2;

        $total_withdraw = ORM::for_table($config['db']['pre'] . 'withdraw')->where('userid', $user_id)->count();
        $withdraw = ORM::for_table($config['db']['pre'] . 'withdraw')->where('userid', $user_id)->order_by_desc('id')
            ->limit($limit2)->offset($offset2)
            ->find_many();
        $withdraw_info = array();
        foreach ($withdraw as $key => $res) {
            $withdraw_info[$key]['amount'] = "$ " . $res['amount'];
            $withdraw_info[$key]['description'] = $res['description'];
            $withdraw_info[$key]['status'] = $res['status'];
            $withdraw_info[$key]['payment_at'] = $res['payment_at'];
            $withdraw_info[$key]['date'] = date("d/m/Y", $res['date']);
        }
        $item['balance_type'] =  $balance_type;
        $item['total_amount'] =  $total_amount;
        $item['total_credit'] = $total_credit;
        $item['total_debit'] = $total_debit;
        $item['total_payment'] = $total_payment;
        $item['payment_history'] =  $payment;
        $item['total_withdraw'] =   $total_withdraw;
        $item['withdraw_history'] = $withdraw_info;

        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'item' => $item];
    send_json($results);
    die();
}

function withdraw_amount()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = [];
    $loggedin = checkIsLoggedin();
    $user_id =  $loggedin['user_id'];
    $userdata = get_user_data(null, $user_id);
    $request_amount = isset($_REQUEST['amount']) && !empty($_REQUEST['amount']) ? $_REQUEST['amount'] : '';
    if (empty($request_amount)) {
        $errors['amount'] = $lang['AMOUNT_REQ'];
    }
    $wallet_amount = preg_replace("/[^0-9.]/", "", show_wallet_amount($user_id));

    if ($request_amount > $wallet_amount) {
        $errors['amount'] = $lang['GREATER_AMT_ERROR'];
    }
    if (!count($errors) > 0) {
        if ($userdata['user_type'] == 'employer') {
            $user_type = 'client';
        } else {
            $user_type = 'worker';
        }
        $data_transaction = ORM::for_table($config['db']['pre'] . 'transaction')->create();
        $data_transaction->userid =  $user_id;
        $data_transaction->amount = $request_amount;
        $data_transaction->transaction_time = time();
        $data_transaction->status = 'success';
        $data_transaction->transaction_gatway = "stripe";
        $data_transaction->transaction_type = "debit";
        $data_transaction->transaction_for = "wallet";
        $data_transaction->transaction_of = $user_type;
        $data_transaction->transaction_ip = $_SERVER['REMOTE_ADDR'];
        $data_transaction->transaction_description = " wallet withdraw";
        $data_transaction->created_at = date('Y-m-d H:i:s');
        $data_transaction->save();
        updateClosingAmount($data_transaction->id, $user_id);

        $withdraw = ORM::for_table($config['db']['pre'] . 'withdraw')->create();
        $withdraw->userid = $user_id;
        $withdraw->amount = $request_amount;
        $withdraw->description = $_REQUEST['description'];
        $withdraw->date = time();
        $withdraw->save();

        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['WITHDRAW_REQ_SENT'];
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message =  $lang['ERROR'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'errors' => $errors];
    send_json($results);
    die();
}

function wallet_add_amount_offline()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = [];
    $image = '';
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $amount = (!isset($_REQUEST['amount']) || !empty($_REQUEST['amount'])) ? $_REQUEST['amount'] : '';
        $refrance_number = (!isset($_REQUEST['refrance_number']) || !empty($_REQUEST['refrance_number'])) ? $_REQUEST['refrance_number'] : '';
        $bank_detail = (!isset($_REQUEST['bank_detail']) || !empty($_REQUEST['bank_detail'])) ? $_REQUEST['bank_detail'] : '';
        $instructions = (!isset($_REQUEST['instructions']) || !empty($_REQUEST['instructions'])) ? $_REQUEST['instructions'] : '';
        if (empty($amount)) {
            $errors['amount'] = $lang['AMOUNT_REQ'];
        }
        if (empty($refrance_number)) {
            $errors['refrance_number'] = $lang['REF_NO_REQ'];
        }
        if (empty($bank_detail)) {
            $errors['bank_detail'] = $lang['BANK_DETAILS_REQ'];
        }
        if (empty($instructions)) {
            $errors['instructions'] = $lang['INSTRUCTIONS_REQ'];
        }

        if (!empty($_FILES['attachment'])) {
            if (!count($errors) > 0) {
                $file = $_FILES['attachment'];
                // Valid formats
                $valid_formats = array("jpeg", "jpg", "png");
                $filename = $file['name'];
                $ext = getExtension($filename);
                $ext = strtolower($ext);
                if (!empty($filename)) {
                    //File extension check
                    if (in_array($ext, $valid_formats)) {
                        $main_path = ROOTPATH . "/storage/payments/";
                        if (!is_dir($main_path)) {
                            mkdir($main_path, 0777);
                        }
                        $filename = uniqid(time()) . '.' . $ext;
                        if (move_uploaded_file($file['tmp_name'], $main_path . $filename)) {
                            $image = $filename;
                            resizeImage(900, $main_path . $filename, $main_path . $filename);
                        } else {
                            $errors['attachment'] = 'Image: Unexpected error, please try again.';
                        }
                    } else {
                        $errors['attachment'] = 'Only jpeg, jpg & png files allowed.';
                    }
                }
            }
        }
        if (!count($errors) > 0) {
            $offline_payment = ORM::for_table($config['db']['pre'] . 'wallet_offline_payments')->create();
            $offline_payment->userid = $user_id;
            $offline_payment->amount = $amount;
            $offline_payment->date = time();
            $offline_payment->referance_number = $refrance_number;
            $offline_payment->bank = $bank_detail;
            $offline_payment->instruction = $instructions;
            $offline_payment->description = $_REQUEST['description'];
            $offline_payment->attachment = $image;
            $offline_payment->created_at = date('Y-m-d H:i:s');
            $offline_payment->save();

            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['PAYMENT_REQ_SENT'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['FAILED'];
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $valid_auth_token, 'errors' => $errors];
    send_json($results);
    die();
}

function stripe_config()
{
    global $config;
    require_once('../../includes/payments/stripe/stripe-php/init.php');
    $secret_key = $config['stripe_secret_key'];
    \Stripe\Stripe::setVerifySslCerts(false);
    \stripe\stripe::setApiKey($secret_key);
}

function createPaymentIntent()
{
    stripe_config();
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $description = $_REQUEST['description'];
    $amount = $_REQUEST['amount'];
    $amount =  $amount * 100;
    $currency = get_option('currency_code') ?? 'AUD';
    try {
        $customer = \Stripe\Customer::create([
            'name' => $name,
            'email' => $email,
            'description' => $description,
        ]);
        // Create a PaymentIntent with amount and currency
        $paymentIntent = \Stripe\PaymentIntent::create([
            'customer' => $customer->id,
            'amount' => $amount,
            'currency' => $currency,
            'automatic_payment_methods' => [
                'enabled' => false,
            ],
        ]);

        $output = [
            'paymentId' => $paymentIntent->id,
        ];

        echo json_encode($output);
        die;
    } catch (Error $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
        die;
    }
}

function wallet_add_amount_online()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $loggedin = checkIsLoggedin();
    $user_id = $loggedin['user_id'];
    stripe_config();
    $paymnetId = $_REQUEST['payment_id'];
    $paymentdata = \Stripe\PaymentIntent::retrieve($paymnetId, []);
    // $stripe = new \Stripe\StripeClient($config['stripe_secret_key']);
    //$paymentdata =  $stripe->paymentIntents->confirm($paymnetId ,['payment_method' => $_REQUEST['payment_method']]);
    if ($paymentdata['status'] == "succeeded") {
        $payment_status = "success";
    } else {
        $payment_status = "failed";
    }
    if (!empty($paymentdata)) {
        $transaction_id = $paymentdata['charges']['data'][0]['balance_transaction'];
        $transaction_gateway = "stripe";
        $transaction_type = "debit";
        $transaction_method = "bank";
        $description = "Cash deposit at Bank";
        $bank_transaction = ORM::for_table($config['db']['pre'] . 'transaction')->create();
        $bank_transaction->userid = $user_id;
        $bank_transaction->amount = $paymentdata['amount'] / 100;
        $bank_transaction->transaction_time = $paymentdata['created'];
        $bank_transaction->status = $payment_status;
        $bank_transaction->transaction_gatway = $transaction_gateway;
        $bank_transaction->transaction_type = $transaction_type;
        $bank_transaction->transaction_ip = $_SERVER['REMOTE_ADDR'];
        $bank_transaction->transaction_description = $description;
        $bank_transaction->transaction_for = $transaction_method;
        $bank_transaction->transaction_of = "client";
        $bank_transaction->transaction_id =  $transaction_id;
        $bank_transaction->paymentintent_id = $paymentdata['id'];
        $bank_transaction->created_at = date('Y-m-d H:i:s');
        $bank_transaction->save();
        updateBankClosingAmount($bank_transaction->id, $user_id);

        $type_transaction = "credit";
        $wallet_description = "Cash Credit At wallet";
        $method_transaction = "wallet";
        $wallet_transaction = ORM::for_table($config['db']['pre'] . 'transaction')->create();
        $wallet_transaction->userid = $user_id;
        $wallet_transaction->amount = $paymentdata['amount'] / 100;
        $wallet_transaction->transaction_time = $paymentdata['created'];
        $wallet_transaction->status = $payment_status;
        $wallet_transaction->transaction_gatway = $transaction_gateway;
        $wallet_transaction->transaction_type = $type_transaction;
        $wallet_transaction->transaction_ip = $_SERVER['REMOTE_ADDR'];
        $wallet_transaction->transaction_description = $wallet_description;
        $wallet_transaction->transaction_for = $method_transaction;
        $wallet_transaction->transaction_of = "client";
        $wallet_transaction->paymentintent_id = $paymentdata['id'];
        $wallet_transaction->created_at = date('Y-m-d H:i:s');
        $wallet_transaction->save();
        updateClosingAmount($wallet_transaction->id, $user_id);
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['PAYMENTSUCCESS'];
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['INVALID_ID'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token']];
    send_json($results);
    die();
}

function premium_job_payment()
{
    global $config, $lang;
    $errors = [];
    $loggedin = checkIsLoggedin();
    $user_id = $loggedin['user_id'];
    stripe_config();
    $paymnetId = (isset($_REQUEST['payment_id']) && $_REQUEST['payment_id']) ? $_REQUEST['payment_id'] : '';;
    $product_id  = (isset($_REQUEST['job_id']) && $_REQUEST['job_id']) ?  $_REQUEST['job_id'] : '';
    $ip_address  = (isset($_REQUEST['ip_address']) && $_REQUEST['ip_address']) ?  $_REQUEST['ip_address'] : '';
    if (empty($paymnetId)) {
        $errors['payment_id'] = 'Payment Id is required';
    }
    if (empty($product_id)) {
        $errors['product_id'] =  'Job Id is required';
    }
    if (empty($product_id)) {
        $errors['ip_address'] =  'IP Address is required';
    }
    if (!count($errors) > 0) {
        $paymentIntent = \Stripe\PaymentIntent::retrieve($paymnetId, []);
        if (!empty($paymentIntent)) {

            $transaction_id = $paymentIntent['charges']['data'][0]['balance_transaction'];
            $transaction_gateway = "stripe";
            $transaction_type = "debit";
            $transaction_method = "bank";

            $description = "Cash Debit for premium Job";

            $bank_transaction = ORM::for_table($config['db']['pre'] . 'transaction')->create();
            $bank_transaction->userid = $user_id;
            $bank_transaction->product_id = $_REQUEST['job_id'];
            $bank_transaction->amount = $paymentIntent['amount'] / 100;
            $bank_transaction->transaction_time = $paymentIntent['created'];
            $bank_transaction->status = $paymentIntent['status'];
            $bank_transaction->transaction_gatway = $transaction_gateway;
            $bank_transaction->transaction_type = $transaction_type;
            $bank_transaction->transaction_ip = $ip_address;
            $bank_transaction->transaction_description = $description;
            $bank_transaction->transaction_for = $transaction_method;
            $bank_transaction->transaction_of = "client";
            $bank_transaction->cash_deposit_for = "job";
            $bank_transaction->transaction_id = $transaction_id;
            $bank_transaction->paymentintent_id = $paymentIntent['id'];
            $bank_transaction->created_at = date('Y-m-d H:i:s');
            $bank_transaction->save();
            updateBankClosingAmount($bank_transaction->id, $user_id);

            /////////////////////// This Feature are Hide //////////////////////////
            $featured_exp_date = $urgent_exp_date = $highlight_exp_date = '';
            $featured = $urgent = $highlight = "0";
            $user_info = ORM::for_table($config['db']['pre'] . 'user')->table_alias('u')
                ->select_many('ug.*')
                ->where('u.id', $user_id)
                ->join($config['db']['pre'] . 'usergroups', 'ug.group_id = u.group_id', 'ug')
                ->find_one();

            if (isset($_REQUEST['featured'])) {
                $featured_exp_date = date('Y-m-d h:i:s', strtotime($user_info['featured_duration'] . ' days'));
                $featured = "1";
            }
            if (isset($_REQUEST['urgent'])) {
                $urgent_exp_date = date('Y-m-d h:i:s', strtotime($user_info['urgent_duration'] . ' days'));
                $urgent = "1";
            }
            if (isset($_REQUEST['highlight'])) {
                $highlight_exp_date = date('Y-m-d h:i:s', strtotime($user_info['highlight_duration'] . ' days'));
                $highlight = "1";
            }

            $update_product = ORM::for_table($config['db']['pre'] . 'product')->find_one($_REQUEST['job_id']);
            $update_product->set('featured', $featured);
            $update_product->set('urgent', $urgent);
            $update_product->set('highlight', $highlight);
            $update_product->set('featured_exp_date', $featured_exp_date);
            $update_product->set('urgent_exp_date', $urgent_exp_date);
            $update_product->set('highlight_exp_date', $highlight_exp_date);
            $update_product->save();


            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = 'Payment saved successfully';
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['INVALID_ID'];
        }
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message =  $lang['FAILED'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'errors' => $errors, 'auth_token' => $loggedin['auth_token']];
    send_json($results);
    die();
}

function reviews_list()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $loggedin = checkIsLoggedin();
    $limit1 = isset($_REQUEST['limit1']) && !empty($_REQUEST['limit1']) ? $_REQUEST['limit1'] :  10;
    $page1 = isset($_REQUEST['page1']) && !empty($_REQUEST['page1']) ? $_REQUEST['page1'] : 1;
    $offset1 = ($page1 - 1) * $limit1;

    $limit2 = isset($_REQUEST['limit2']) && !empty($_REQUEST['limit2']) ? $_REQUEST['limit2'] :  10;
    $page2 = isset($_REQUEST['page2']) && !empty($_REQUEST['page2']) ? $_REQUEST['page2'] : 1;
    $offset2 = ($page2 - 1) * $limit2;

    $user_id = $loggedin['user_id'];
    $userdata = get_user_data(null, $user_id);
    $usertype = $userdata['user_type'];
    $item1 = $item2 = array();
    if ($usertype == 'employer') {
        $total_recieved_reviews = ORM::for_table($config['db']['pre'] . 'product_reviews')->table_alias('r')
            ->where(['p.user_id' => $user_id, 'r.status' => 'accepted'])
            ->join($config['db']['pre'] . 'product', 'p.id = r.productID', 'p')
            ->count();

        $recieved_reviews = ORM::for_table($config['db']['pre'] . 'product_reviews')->table_alias('r')
            ->select_many('r.*', ['pro_name' => 'p.product_name'], ['user_name' => 'u.username'])
            ->where(['p.user_id' => $user_id, 'r.status' => 'accepted'])
            ->join($config['db']['pre'] . 'product', 'p.id=r.productID', 'p')
            ->join($config['db']['pre'] . 'user', 'u.id=r.giver_id', 'u')
            ->order_by_desc('date')
            ->limit($limit1)->offset($offset1)
            ->find_many();

        foreach ($recieved_reviews as $key => $val) {
            $item1[$key]['id'] = $val['id'];
            $item1[$key]['productID'] = $val['productID'];
            $item1[$key]['giver_id'] = $val['giver_id'];
            $item1[$key]['rating'] = $val['rating'];
            $item1[$key]['comments'] = $val['comments'];
            $item1[$key]['reply'] = $val['reply'];
            $item1[$key]['date'] = date('d M, Y', strtotime($val['date']));
            $item1[$key]['product_name'] = $val['pro_name'];
            $item1[$key]['user_name'] = $val['user_name'];
        }
        $total_given_reviews = ORM::for_table($config['db']['pre'] . 'reviews')->where('giver_id', $user_id)->count();
        $given_reviews_data = ORM::for_table($config['db']['pre'] . 'reviews')->table_alias('r')
            ->select_many('r.*', ['pro_name' => 'p.product_name'], ['user_name' => 'u.username'])
            ->where('r.giver_id', $user_id)
            ->join($config['db']['pre'] . 'product', 'p.id=r.productID', 'p')
            ->join($config['db']['pre'] . 'user', 'u.id=r.user_id', 'u')
            ->order_by_desc('date')
            ->limit($limit2)->offset($offset2)
            ->find_many();

        foreach ($given_reviews_data as $key => $value) {
            $item2[$key]['id'] = $value['reviewID'];
            $item2[$key]['productID'] = $value['productID'];
            $item2[$key]['rating'] = $value['rating'];
            $item2[$key]['delivered_budget'] = $value['delivered_budget'];
            $item2[$key]['delivered_time'] = $value['delivered_time'];
            $item2[$key]['comments'] = $value['comments'];
            $item2[$key]['reply'] = $value['reply'];
            $item2[$key]['date'] = date('d M, Y', strtotime($value['date']));
            $item2[$key]['product_name'] = $value['pro_name'];
            $item2[$key]['user_name'] = $value['user_name'];
            $item2[$key]['user_id'] = $value['user_id'];
        }
    } elseif ($usertype == 'user') {
        $total_recieved_reviews = ORM::for_table($config['db']['pre'] . 'reviews')->where(['user_id' => $user_id, 'accepted' => '1', 'locked' => '0'])->count();
        $recieved_reviews = ORM::for_table($config['db']['pre'] . 'reviews')->table_alias('r')
            ->select_many('r.*', ['pro_name' => 'p.product_name'], ['user_name' => 'u.username'])
            ->where(['r.user_id' => $user_id, 'r.accepted' => '1', 'r.locked' => '0'])
            ->join($config['db']['pre'] . 'product', 'p.id=r.productID', 'p')
            ->join($config['db']['pre'] . 'user', 'u.id=r.giver_id', 'u')
            ->order_by_desc('date')
            ->limit($limit1)->offset($offset1)
            ->find_many();
        foreach ($recieved_reviews as $key => $val) {
            $item1[$key]['id'] = $val['reviewID'];
            $item1[$key]['productID'] = $val['productID'];
            $item1[$key]['giver_id'] = $val['giver_id'];
            $item1[$key]['rating'] = $val['rating'];
            $item1[$key]['delivered_budget'] = $val['delivered_budget'];
            $item1[$key]['delivered_time'] = $val['delivered_time'];
            $item1[$key]['comments'] = $val['comments'];
            $item1[$key]['reply'] = $val['reply'];
            $item1[$key]['date'] = date('d M, Y', strtotime($val['date']));
            $item1[$key]['accepted'] = $val['accepted'];
            $item1[$key]['locked'] = $val['locked'];
            $item1[$key]['product_name'] = $val['pro_name'];
            $item1[$key]['user_name'] = $val['user_name'];
        }
        $total_given_reviews = ORM::for_table($config['db']['pre'] . 'product_reviews')->where('giver_id', $user_id)->count();
        $given_reviews = ORM::for_table($config['db']['pre'] . 'product_reviews')->table_alias('r')
            ->select_many('r.*', ['pro_name' => 'p.product_name'])
            ->where('r.giver_id', $user_id)
            ->join($config['db']['pre'] . 'product', 'p.id=r.productID', 'p')
            ->order_by_desc('date')
            ->limit($limit2)->offset($offset2)
            ->find_many();
        foreach ($given_reviews as $key => $value) {
            $item2[$key]['id'] = $value['id'];
            $item2[$key]['productID'] = $value['productID'];
            $item2[$key]['rating'] = $value['rating'];
            $item2[$key]['comments'] = $value['comments'];
            $item2[$key]['reply'] = $value['reply'];
            $item2[$key]['date'] = date('d M, Y', strtotime($value['date']));
            $item2[$key]['product_name'] = $value['pro_name'];
        }
    }
    $item = [
        'total_recieved_reviews' => $total_recieved_reviews,
        'recieved_reviews' => $item1,
        'total_given_reviews' => $total_given_reviews,
        'given_reviews' => $item2,
    ];
    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];
    $message = $lang['SUCCESS'];
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'items' => $item];
    send_json($results);
    die();
}

function productReviewById()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = array();
    $review = [];
    $loggedin = checkIsLoggedin();
    $review_id = (isset($_REQUEST['reviewID']) && !empty($_REQUEST['reviewID'])) ? $_REQUEST['reviewID'] : '';
    if (empty($review_id)) {
        $errors['reviewID'] = $lang['REVIEWID_REQ'];
    }
    if (!count($errors) > 0) {
        $info = ORM::for_table($config['db']['pre'] . 'product_reviews')->table_alias('r')
            ->select_many('r.*', ['pro_name' => 'p.product_name'])
            ->where('r.id', $review_id)
            ->join($config['db']['pre'] . 'product', 'p.id=r.productID', 'p')
            ->find_one();
        if ($info) {
            $review['id'] =  $info['id'];
            $review['productID'] =  $info['productID'];
            $review['rating'] =  $info['rating'];
            $review['comments'] =  $info['comments'];
            $review['reply'] =  $info['reply'];
            $review['date'] = date('d M, Y', strtotime($info['date']));
            $review['product_name'] =  $info['pro_name'];
            $message = $lang['SUCCESS'];
        } else {
            $message = $lang['NOT_FOUND'];
        }
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['FAILED'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'errors' => $errors, 'review_data' => $review];
    send_json($results);
}

function userReviewById()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = array();
    $review = [];
    $loggedin = checkIsLoggedin();
    $review_id = (isset($_REQUEST['reviewID']) && !empty($_REQUEST['reviewID'])) ? $_REQUEST['reviewID'] : '';
    if (empty($review_id)) {
        $errors['reviewID'] = $lang['REVIEWID_REQ'];
    }
    if (!count($errors) > 0) {
        $review_data = ORM::for_table($config['db']['pre'] . 'reviews')->table_alias('r')
            ->select_many('r.*', ['pro_name' => 'p.product_name'], ['user_name' => 'u.username'])
            ->where('r.reviewID', $review_id)
            ->join($config['db']['pre'] . 'product', 'p.id=r.productID', 'p')
            ->join($config['db']['pre'] . 'user', 'u.id=r.giver_id', 'u')
            ->find_one();
        if ($review_data) {
            $review['id'] = $review_data['reviewID'];
            $review['productID'] = $review_data['productID'];
            $review['giver_id'] = $review_data['giver_id'];
            $review['user_id'] = $review_data['user_id'];
            $review['rating'] = $review_data['rating'];
            $review['delivered_budget'] = $review_data['delivered_budget'];
            $review['delivered_time'] = $review_data['delivered_time'];
            $review['comments'] = $review_data['comments'];
            $review['reply'] = $review_data['reply'];
            $review['date'] = date('d M, Y', strtotime($review_data['date']));
            $review['accepted'] = $review_data['accepted'];
            $review['locked'] = $review_data['locked'];
            $review['product_name'] = $review_data['pro_name'];
            $review['user_name'] = $review_data['user_name'];
            $message = $lang['SUCCESS'];
        } else {
            $message = $lang['NOT_FOUND'];
        }

        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['FAILED'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'errors' => $errors, 'review_data' => $review];
    send_json($results);
}

function reply_review()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = array();
    $loggedin = checkIsLoggedin();
    $user_id = $loggedin['user_id'];
    $user_type = get_user_data(null, $user_id)['user_type'];
    $review_id = (isset($_REQUEST['reviewID']) && !empty($_REQUEST['reviewID'])) ? $_REQUEST['reviewID'] : '';
    $reply = (isset($_REQUEST['reply']) || !empty($_REQUEST['reply'])) ? $_POST['reply'] : '';
    if (empty($review_id)) {
        $errors['reviewID'] = $lang['REVIEWID_REQ'];
    }
    if (empty($reply)) {
        $errors['reply'] = $lang['REPLY_REQ'];
    }
    if (!count($errors) > 0) {
        if ($user_type == 'employer') {
            $update_reply = ORM::for_table($config['db']['pre'] . 'product_reviews')->find_one($review_id);
            $update_reply->set('reply', $reply);
            $update_reply->save();
        } else {
            $update_reply = ORM::for_table($config['db']['pre'] . 'reviews')->use_id_column('reviewID')->find_one($review_id);
            $update_reply->set('reply', $reply);
            $update_reply->save();
        }
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['UPDATED_SUCCESS'];
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['FAILED'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'errors' => $errors];
    send_json($results);
}

//by worker
function save_product_review()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = array();
    $review = [];
    $loggedin = checkIsLoggedin();
    $user_id =  $loggedin['user_id'];
    $user_data = get_user_data(null, $user_id);
    $userfullname = !empty($user_data['name']) ? $user_data['name'] : $user_data['username'];
    $now = date("Y-m-d");
    $review_id = isset($_REQUEST['review_id']) && !empty($_REQUEST['review_id']) ? $_REQUEST['review_id'] : null;
    $product_id = isset($_REQUEST['job_id']) && !empty($_REQUEST['job_id']) ? $_REQUEST['job_id'] : '';
    $rating = isset($_REQUEST['rating']) && !empty($_REQUEST['rating']) ? $_REQUEST['rating'] : '';
    $comment = isset($_REQUEST['comment']) && !empty($_REQUEST['comment']) ? $_REQUEST['comment'] : '';
    if (empty($product_id)) {
        $errors['job_id'] = $lang['JOB_ID_REQ'];
    }
    if (empty($rating)) {
        $errors['rating'] = $lang['RATING_REQ'];
    }
    if (empty($comment)) {
        $errors['comment'] = $lang['COMMENT_REQ'];
    }
    if (empty($product_id) && !empty($product_id)) {
        $duplicates = ORM::for_table($config['db']['pre'] . 'reviews')
            ->where('giver_id', $user_id)
            ->where('productID', $product_id)
            ->count();
        if ($duplicates > 0) {
            $errors['comment_error'] = $lang['DUPLICATE_COMMENT'];
        }
    }

    if (!count($errors) > 0) {
        if (!empty($review_id)) {
            $update_reviews = ORM::for_table($config['db']['pre'] . 'product_reviews')->find_one($review_id);
            $update_reviews->set([
                'productID' => $product_id,
                'rating' => $rating,
                'comments' => $comment,
                'date'  => $now,
            ]);
            $update_reviews->save();
        } else {
            $reviews = ORM::for_table($config['db']['pre'] . 'product_reviews')->create();
            $reviews->giver_id = $user_id;
            $reviews->productID = $product_id;
            $reviews->rating = $rating;
            $reviews->comments = $comment;
            $reviews->date  = $now;
            $reviews->save();
            $review_id = $reviews->id();
        }

        // Send Notification Funtion 
        $notification = "false";
        $client = get_product_post_client($product_id);
        $reciver_id =  $client['user_id'];
        $product_name =  $client['product_name'];
        $check_notification = get_user_notification_type_new($reciver_id);
        if (!empty($check_notification) && array_key_exists("review_job", $check_notification)) {
            if ($check_notification['review_job'] == "1") {
                $notification = "true";
            }
        } else {
            $notification = "true";
        }
        if ($notification == "true") {
            $notify_data = [
                'recepient_id' => $reciver_id,
                'sender_id' => $user_id,
                'reference_id' => $review_id,
                'type' =>  'review_job'
            ];
            insert_notification($notify_data);
            $title = 'Got New Review!';
            $msg =  $userfullname . ' left you a ' . $rating . ' rating on ' . $product_name . '.';
            $other_data = ['reference_id' => $review_id, 'action_type' => 'review_job'];
            sendFCM($msg, $reciver_id, $title, $other_data);
        }


        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['COMMENT_REVIEW'];
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['FAILED'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'errors' => $errors];
    send_json($results);
    die();
}

//by employer
function save_review()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = array();
    $loggedin = checkIsLoggedin();
    $user_id =  $loggedin['user_id'];
    $user_data = get_user_data(null, $user_id);
    $userfullname = !empty($user_data['name']) ? $user_data['name'] : $user_data['username'];
    $now = date("Y-m-d");
    $review_id = isset($_REQUEST['review_id']) && !empty($_REQUEST['review_id']) ? $_REQUEST['review_id'] : null;
    $product_id = isset($_REQUEST['job_id']) && !empty($_REQUEST['job_id']) ? $_REQUEST['job_id'] : '';
    $review_user_id = isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id']) ? $_REQUEST['user_id'] : '';
    $rating = isset($_REQUEST['rating']) && !empty($_REQUEST['rating']) ? $_REQUEST['rating'] : '';
    $delivered_at_budget = isset($_REQUEST['delivered_at_budget']) && !empty($_REQUEST['delivered_at_budget']) ? $_REQUEST['delivered_at_budget'] : '';
    $delivered_at_time = isset($_REQUEST['delivered_at_time']) && !empty($_REQUEST['delivered_at_time']) ? $_REQUEST['delivered_at_time'] : '';
    $comment = isset($_REQUEST['comment']) && !empty($_REQUEST['comment']) ? $_REQUEST['comment'] : '';

    if (empty($product_id)) {
        $errors['job_id'] = $lang['JOB_ID_REQ'];
    }
    if (empty($review_user_id)) {
        $errors['user_id'] = $lang['USER_ID_REQ'];
    }
    if (empty($rating)) {
        $errors['rating'] = $lang['RATING_REQ'];
    }
    if (empty($comment)) {
        $errors['comment'] = $lang['COMMENT_REQ'];
    }

    if (empty($review_id) && !empty($product_id) && !empty($review_user_id)) {
        $duplicates = ORM::for_table($config['db']['pre'] . 'reviews')
            ->where('user_id', $review_user_id)
            ->where('productID', $product_id)
            ->count();
        if ($duplicates > 0) {
            $errors['comment_error'] = $lang['DUPLICATE_COMMENT'];
        }
    }

    if (!count($errors) > 0) {
        if (!empty($review_id)) {
            $update_reviews = ORM::for_table($config['db']['pre'] . 'reviews')->use_id_column('reviewID')->find_one($review_id);
            $update_reviews->set([
                'productID' => $product_id,
                'user_id' => $review_user_id,
                'rating' => $rating,
                'delivered_budget' => $delivered_at_budget,
                'delivered_time' => $delivered_at_time,
                'comments' => $comment,
                'date'  => $now,
            ]);
            $update_reviews->save();
        } else {
            $reviews = ORM::for_table($config['db']['pre'] . 'reviews')->create();
            $reviews->giver_id = $user_id;
            $reviews->productID = $product_id;
            $reviews->user_id = $review_user_id;
            $reviews->rating = $rating;
            $reviews->delivered_budget = $delivered_at_budget;
            $reviews->delivered_time = $delivered_at_time;
            $reviews->comments = $comment;
            $reviews->date  = $now;
            $reviews->save();
            $review_id = $reviews->id();
        }
        // Send Notification Funtion 
        $notification = "false";

        $check_notification = get_user_notification_type_new($_REQUEST['user_id']);
        $client = get_product_post_client($product_id);
        $product_name =  $client['product_name'];
        if (!empty($check_notification) && array_key_exists("review", $check_notification)) {
            if ($check_notification['review'] == "1") {
                $notification = "true";
            }
        } else {
            $notification = "true";
        }
        if ($notification == "true") {
            $notify_data = [
                'recepient_id' =>  $review_user_id,
                'sender_id' => $user_id,
                'reference_id' => $review_id,
                'type' =>  'review_job'
            ];
            insert_notification($notify_data);

            $title = 'Got New Review!';
            $msg =  $userfullname . ' left you a ' . $rating . ' rating on ' . $product_name . '.';
            $other_data = ['reference_id' => $review_id, 'action_type' => 'review'];
            sendFCM($msg, $review_user_id, $title, $other_data);
        }
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['COMMENT_REVIEW'];
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['FAILED'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'errors' => $errors];
    send_json($results);
    die();
}

function invitation_details()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = array();
    $loggedin = checkIsLoggedin();
    $user_id =  $loggedin['user_id'];

    $user_data = get_user_data(null, $user_id);
    $usertype = $user_data['user_type'];
    $check_share = checkReferalStatus($user_id);
    if ($check_share == "1") {
        $code = get_refrel_code($user_id);
        if ($code != "") {
            $refrel = $user_id . ',' . $code;
            $refrel_code = base64_encode($refrel);
        } else {
            $code_referal = generateRandomRefrel();
            $set_refrel = ORM::for_table($config['db']['pre'] . 'user')->find_one($user_id);
            $set_refrel->set('refrel_code', $code_referal);
            $set_refrel->set('updated_at', date('Y-m-d H:i:s'));
            $set_refrel->save();
            $refrel =  $user_id . ',' . $code_referal;
            $refrel_code = base64_encode($refrel);
        }
    } else {
        $refrel_code = '';
    }
    $invite = ORM::for_table($config['db']['pre'] . 'invite')->table_alias('i')
        ->select_many('i.*', 'u.username')
        ->left_outer_join($config['db']['pre'] . 'user', 'u.id=i.referid', 'u')
        ->where('i.userid', $user_id)
        ->order_by_desc('i.id')
        ->find_many();
    $invite_info = array();
    foreach ($invite as $key => $res) {
        $invite_info[$key]['date'] = date("d/m/Y", strtotime($res['created_at']));
        $invite_info[$key]['user_profit'] = $res['user_profit'];
        $invite_info[$key]['refer_profit'] = $res['refer_profit'];
        $invite_info[$key]['refername'] = $res['username'];
        $invite_info[$key]['status'] = $res['status'];
        $invite_info[$key]['payment_at'] = $res['payment_at'];
    }

    $invite_money = ORM::for_table($config['db']['pre'] . 'refrelcode')->where('name', $usertype)->find_one();
    if (!empty($invite_money)) {
        $sender_profit = $invite_money['sender_profit'];
    } else {
        $sender_profit = "";
    }

    $total_earn = ORM::for_table($config['db']['pre'] . 'invite')->where(['userid' => $user_id, 'status' => 'complete'])->sum('user_profit') ?? 0;

    $total_referral = ORM::for_table($config['db']['pre'] . 'invite')->where('userid', $user_id)->count('userid') ?? 0;

    $invitation_details = [
        'referral_code' => $refrel_code,
        'total_referral' => $total_referral,
        'total_earn' => $total_earn,
        'invite_money' => $sender_profit,
        'invite_history' => $invite_info
    ];
    $results = ['status_code' => HTTP_OK, 'status' => $lang['SUCCESS'], 'message' => $lang['SUCCESS'], 'auth_token' => $loggedin['auth_token'], 'invitation_details' => $invitation_details];
    send_json($results);
    die();
}

function save_shift_log()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = array();
    $loggedin = checkIsLoggedin();
    $user_id =  $loggedin['user_id'];
    $user_data = get_user_data(null, $user_id);
    $timesheet_data = $shift_log = [];
    $shift_status = '';
    if ($user_data['user_type'] != 'user') {
        $errors['user_type'] = $lang['INVALID_USER'];
    } else {
        $timesheet_id = (isset($_REQUEST['timesheet_id']) && !empty($_REQUEST['timesheet_id'])) ? $_REQUEST['timesheet_id'] : null;
        $status = (isset($_REQUEST['status']) && !empty($_REQUEST['status'])) ? $_REQUEST['status'] : null;
        if (empty($status)) {
            $errors['status'] = 'Missing status';
        } else {
            if (!in_array($status, ['start', 'finished'])) {
                $errors['status'] = 'Invalid status';
            }
        }
        if (empty($timesheet_id)) {
            $errors['timesheet_id'] = $lang['INVALID_TIMESHEET'];
        } else {
            $timesheet_data = ORM::for_table($config['db']['pre'] . 'timesheets')->where('worker_id', $user_id)->find_one($timesheet_id);
            if (!empty($timesheet_data)) {
                if ($timesheet_data['worker_id'] != $user_id) {
                    $error['user_error'] = $lang['INVALID_USER'];
                }
                $timesheet_status = $timesheet_data['status'];
                if ($status == 'start' && $timesheet_status != 'approved') {

                    switch ($timesheet_status) {
                        case 'submitted':
                            $errors['timesheet_error'] = $lang['TIMESHEET_NOT_APPROVED'];
                            break;
                        case 'in_progress':
                            $errors['timesheet_error'] = 'Already started';
                            break;
                        case 'late_finished':
                        case 'finished':
                            $errors['timesheet_error'] = 'Shift is finished';
                            break;
                        case 'missed':
                            $errors['timesheet_error'] = 'Shift is missed';
                            break;
                        default:
                            $errors['timesheet_error'] = 'Can not start the shift ';
                            break;
                    }
                } elseif ($status == 'finished' && $timesheet_status != 'in_progress') {
                    switch ($timesheet_status) {
                        case 'late_finished':
                        case 'finished':
                            $errors['timesheet_error'] = 'Shift is finished';
                            break;
                        case 'missed':
                            $errors['timesheet_error'] = 'Shift is missed';
                            break;
                        default:
                            $errors['timesheet_error'] = 'Can not start the shift ';
                            break;
                    }
                }
            } else {
                $errors['timesheet_error'] = $lang['INVALID_TIMESHEET'];
            }
        }
        $location = (isset($_REQUEST['location']) && !empty($_REQUEST['location'])) ? $_REQUEST['location'] : null;
        $latitude = (isset($_REQUEST['latitude']) && !empty($_REQUEST['latitude'])) ? $_REQUEST['latitude'] : null;
        $longitude = (isset($_REQUEST['longitude']) && !empty($_REQUEST['longitude'])) ? $_REQUEST['longitude'] : null;
        $ip_address = (isset($_REQUEST['ip_address']) && !empty($_REQUEST['ip_address'])) ? $_REQUEST['ip_address'] : null;
        if (!count($errors) > 0) {
            if ($status == 'start') {
                $start_datetime = $current_datetime = date('Y-m-d H:i:s');
                $current_time = date('H:i:s');
                if (empty($location)) {
                    $errors['location'] = $lang['LOCATION_ERROR'];
                }
                if (empty($latitude)) {
                    $errors['latitude'] = $lang['LAT_ERROR'];
                }
                if (empty($longitude)) {
                    $errors['longitude'] = $lang['LONG_ERROR'];
                }
                if (empty($ip_address)) {
                    $errors['ip_address'] = 'IP Address required';
                }

                if (!empty($timesheet_data)) {
                    $start_time = date('Y-m-d H:i:s', strtotime("" . $timesheet_data['start_date'] . " " . $timesheet_data['start_time'] . ""));
                    $end_time = date('Y-m-d H:i:s', strtotime("" . $timesheet_data['end_date'] . " " . $timesheet_data['end_time'] . ""));

                    if (($current_datetime <= $start_time) || ($current_datetime >= $start_time) && $current_datetime <= $end_time) {
                        $difference =  differenceInMinute($current_datetime, $start_time);
                        if ($difference > 30) {
                            $errors['start_time'] = $lang['SHIFT_START_ERROR'];
                        } elseif ($difference < 0) {
                            $hrs = round(abs($difference) / 60, 2);
                            if ($hrs > 1) {
                                $message = $lang["LATE_SHIFT_STARTED"];
                                $shift_status = 'late_finished';
                            }
                        }
                    } else {
                        $errors['start_date'] = $lang['SHIFT_TIME_OVER'];
                    }
                } else {
                    $errors['timesheet_id'] = $lang['INVALID_TIMESHEET'];
                }
                if (!count($errors) > 0) {
                    $shift = ORM::for_table($config['db']['pre'] . 'shift_log')->create();
                    $shift->timesheet_id = $timesheet_id;
                    $shift->worker_id = $user_id;
                    $shift->start_time = $start_time;
                    $shift->location = $location;
                    $shift->latitude = $latitude;
                    $shift->longitude = $longitude;
                    $shift->ip_address = $ip_address;
                    if ($shift->save()) {
                        $timesheet_data->status = 'in_progress';
                        $timesheet_data->save();
                        $status_code = HTTP_OK;
                        $status = $lang['SUCCESS'];
                        $message = empty($message) ? $lang['SHIFT_STARTED'] : $message;
                    } else {
                        $status_code = HTTP_UNPROCESSABLE_ENTITY;
                        $status = $lang['ERROR'];
                        $message = $lang['SOMETHING_WENT_WRONG'];
                    }
                } else {
                    $status_code = HTTP_UNPROCESSABLE_ENTITY;
                    $status = $lang['ERROR'];
                    $message = $lang['FAILED'];
                }
            } else {
                $shift_log = ORM::for_table($config['db']['pre'] . 'shift_log')->where(['timesheet_id' => $timesheet_id, 'worker_id' => $user_id])->find_one();
                $shift_log->end_time = date('H:i:s');
                if ($shift_log->save()) {
                    $timesheet_data->status = !empty($shift_status) ? $shift_status : 'finished';
                    $timesheet_data->save();
                    $status_code = HTTP_OK;
                    $status = $lang['SUCCESS'];
                    $message = $lang['SHIFT_FINISHED'];
                } else {
                    $status_code = HTTP_UNPROCESSABLE_ENTITY;
                    $status = $lang['ERROR'];
                    $message = $lang['SOMETHING_WENT_WRONG'];
                }
            }
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['FAILED'];
        }
    }

    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'errors' => $errors];
    send_json($results);
    die();
}

function notification_list()
{
    global $config, $lang;
    $item = [];
    $loggedin = checkIsLoggedin();
    $user_id =  $loggedin['user_id'];
    $user_type = get_user_data(null, $user_id)['user_type'];
    $user_notification_data = ORM::for_table($config['db']['pre'] . 'user_notifications')
        ->where(['recepient_id' => $user_id, 'read' => '0', 'trash' => '0'])
        ->order_by_desc('id')
        ->find_many();

    $notification_count = ORM::for_table($config['db']['pre'] . 'user_notifications')->where(['recepient_id' => $user_id, 'read' => '0', 'trash' => '0'])->count();
    foreach ($user_notification_data as $key => $data) {
        $item[$key]['id'] =  $data['id'];
        $item[$key]['type'] = $data['type'];
        $item[$key]['sender_id'] =  $data['sender_id'];
        $item[$key]['sender_name'] =  get_user_data(null, $data['sender_id'])['username'];
        $item[$key]['reference_id'] =  $data['reference_id'];
        $item[$key]['recepient_id'] =  $data['recepient_id'];
        $msg_data = get_notification_message($data['type'], $data['sender_id'], $data['reference_id'], $data['recepient_id'], $user_type);
        $item[$key]['title'] =  $msg_data['title'];
        $item[$key]['message'] =  $msg_data['message'];
    }
    $results = ['status_code' => HTTP_OK, 'status' => $lang['SUCCESS'], 'message' => $lang['SUCCESS'], 'auth_token' => $loggedin['auth_token'], 'total' => $notification_count, 'items' => $item];
    send_json($results);
    die();
}

function get_notification_message($type, $sender_id, $reference_id, $recepient_id = null, $user_type = '')
{
    global $config, $link;
    $title = $message = '';
    $sender_data = '';
    $reciver_data = '';
    $name = '';
    $reciver_name = '';
    if (!empty($sender_id)) {
        $sender_data = ORM::for_table($config['db']['pre'] . 'user')->find_one($sender_id);
        if (!empty($sender_data)) {
            $name = !empty($sender_data['name']) ? $sender_data['name'] :  $sender_data['username'];
        }
    }
    if (!empty($recepient_id)) {
        $reciver_data = ORM::for_table($config['db']['pre'] . 'user')->find_one($recepient_id);
        if (!empty($reciver_data)) {
            $reciver_name = !empty($reciver_data['name']) ? $reciver_data['name'] :  $reciver_data['username'];
        }
    }
    $title =  ucwords(str_replace("_", " ", $type));
    switch ($type) {
        case 'timesheet_approved':
            $message = ucwords($name) . ' has approved your timesheet.';
            break;
        case 'timesheet_rejected':
            $message = ucwords($name) . ' has rejected your timesheet.';
            break;
        case 'job_applied':
            $job_data = ORM::for_table($config['db']['pre'] . 'product')->find_one($reference_id);
            $message = ucwords($name) . ' applied for a job' . $job_data['product_name'];
            break;
        case 'job_accepted':
            $job_data = ORM::for_table($config['db']['pre'] . 'product')->find_one($reference_id);
            $message = 'Your job request for ' . $name['product_name'] . ' is accepted.';
            break;
        case 'job_canceled':
            $job_data = ORM::for_table($config['db']['pre'] . 'product')->find_one($reference_id);
            $message = ' Your job request for ' . $name['product_name'] . '</span>  is cancelled.';
            break;
        case 'job_expiring':
            $job_data = ORM::for_table($config['db']['pre'] . 'product')->find_one($reference_id);
            $message = 'Your job ' . $name['product_name'] . ' is going to expire soon.';
            break;
        case 'job_expiring':
            $job_data = ORM::for_table($config['db']['pre'] . 'product')->find_one($reference_id);
            $message = 'Your job ' . $name['product_name'] . ' is going to expire soon.';
            break;
        case 'agreement_offer':
        case 'agreement_amended':
            $agreement_data = ORM::for_table($config['db']['pre'] . 'user_agreements')->table_alias('a')
                ->select_many('p.product_name', ['post_id' => 'p.id'], ['worker_name' => 'u.name'], ['worker_username' => 'u.username'], 'a.worker_id', 'a.client_id')
                ->where('a.id', $reference_id)
                ->left_outer_join($config['db']['pre'] . 'user', 'u.id=a.worker_id', 'u')
                ->left_outer_join($config['db']['pre'] . 'product', 'p.id=a.post_id', 'p')
                ->find_one();
            $fullname = $job_title = '';
            if (!empty($agreement_data)) {
                $fullname = $agreement_data['worker_name'] ? $agreement_data['worker_name'] : $agreement_data['worker_username'];
                $job_title = $agreement_data['product_name'];
            }
            if ($type == 'agreement_offer') {
                $message = $fullname . ' offer you an agreement on ' . $job_title . ' .';
            } else {
                $message = $fullname . ' amended agreement on ' . $job_title . ' .';
            }
            break;
        case 'agreement_requested':
        case 'agreement_accepted':
        case 'agreement_declined':
            $agreement_data = ORM::for_table($config['db']['pre'] . 'user_agreements')->table_alias('a')
                ->select_many('p.product_name', ['post_id' => 'p.id'], ['client_name' => 'u.name'], ['client_username' => 'u.username'], 'a.worker_id', 'a.client_id')
                ->where('a.id', $reference_id)
                ->left_outer_join($config['db']['pre'] . 'user', 'u.id=a.client_id', 'u')
                ->left_outer_join($config['db']['pre'] . 'product', 'p.id=a.post_id', 'p')
                ->find_one();
            $fullname = $job_title = '';
            if (!empty($agreement_data)) {
                $fullname = $agreement_data['client_name'] ? $agreement_data['client_name'] : $agreement_data['client_username'];
                $job_title = $agreement_data['product_name'];
            }
            if ($type == 'agreement_accepted') {
                $message = $fullname . ' has accepted your agreement on #' . $job_title . '.';
            } elseif ($type == 'agreement_requested') {
                $message = $fullname . ' has requested you an agreement on ' . $job_title . '.';
            } else {
                $message = $fullname . ' has declined your agreement on ' . $job_title . '.';
            }
            break;
        case 'review_job':
            $review_data = ORM::for_table($config['db']['pre'] . 'product_reviews')->table_alias('r')
                ->select_many('r.*', 'p.product_name')
                ->left_outer_join($config['db']['pre'] . 'product', 'p.id=r.productID', 'p')
                ->where('r.id', $reference_id)
                ->find_one();
            $message =  $name . ' left you a review of ' . $review_data['rating'] . ' rating on ' . $review_data['product_name'] . '.';
            break;
        case 'review':
            $review_data = ORM::for_table($config['db']['pre'] . 'reviews')->table_alias('r')
                ->select_many('r.*', 'p.product_name')
                ->left_outer_join($config['db']['pre'] . 'product', 'p.id=r.productID', 'p')
                ->where('r.reviewID', $reference_id)
                ->find_one();
            if ($review_data) {
                $message =  $name . ' left you a review of ' . $review_data['rating'] . ' rating on ' . $review_data['product_name'] . '.';
            }
            break;
        case 'invoice_prepared':
            $invoice_data = ORM::for_table($config['db']['pre'] . 'invoice')->find_one($reference_id);
            if ($user_type == 'employer') {
                $message = 'Hi ' . $reciver_name . ' you have an outstanding amount of $' . $invoice_data['total'] . ' for the invoice #' . $invoice_data['prefix'] . '-' . $invoice_data['id'] . '';
            } elseif ($user_type == 'user') {
                $message = 'Hi ' . $reciver_name . ' an invoice #' . $invoice_data['prefix'] . '-' . $invoice_data['id'] . ' is prepared of an outstanding amount of $' . $invoice_data['total'] . '';
            }
            break;
        case 'invoice_paid':
            $invoice_data = ORM::for_table($config['db']['pre'] . 'invoice')->find_one($reference_id);
            $message = 'Hi ' . $reciver_name . ' an 
             is paid of an outstanding amount of $' . $invoice_data['total'] . '.';
            break;
        case 'find_near_job':
            $title = 'New Job Found';
            // $jobs = ORM::for_table($config['db']['pre'] . 'product')->find_one($reference_id);
            $message = 'Hi ' . $reciver_name . ' we have found a new job in your area.';
        default:
            # code...
            break;
    }
    return ['title' => $title, 'message' => $message];
}

function logout()
{
    global $config, $lang, $results;
    $loggedin = checkIsLoggedin();
    if ($loggedin) {
        $device_token = ORM::for_table($config['db']['pre'] . 'firebase_device_token')->where(['auth_token' => $loggedin['auth_token']])->find_one();
        $device_token->token = '';
        $device_token->auth_token = '';
        $device_token->save();
    }
    $results = ['status_code' => HTTP_OK, 'status' => $lang['SUCCESS'], 'message' => $lang['LOGOUT_SUCCESS']];
    send_json($results);
    die();
}

function mark_as_read()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $loggedin = checkIsloggedin();
    $user_id = $loggedin['user_id'];
    $notification_id = (isset($_REQUEST['notification_id']) && !empty($_REQUEST['notification_id'])) ? $_REQUEST['notification_id'] : null;
    $markAll = isset($_REQUEST['markall']) ? 1 : 0;

    if ($markAll) {
        $notification = ORM::for_table($config['db']['pre'] . 'user_notifications')->where('recepient_id', $user_id)->find_many();
        $notification->set(['read' => 1, 'read_at' => date('Y-m-d H:i:s')]);
        if ($notification->save()) {
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['SUCCESS'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['FAILED'];
        }
    } else {
        $notification = ORM::for_table($config['db']['pre'] . 'user_notifications')->find_one($notification_id);
        $notification->read = 1;
        $notification->read_at = date('Y-m-d H:i:s');
        if ($notification->save()) {
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['SUCCESS'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['FAILED'];
        }
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token']];
    send_json($results);
    die();
}

function dashboard_details()
{
    global $config, $lang, $results;
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $userdata = get_user_data(null, $user_id);
    $shift_data = $approved_shifts = $details = [];
    $job_count = $reviews_count = $chat_count = 0;
    if ($userdata['user_type'] == 'employer') {
        $worker_count = worker_count($user_id);
        $job_count = myads_count($user_id);
        $reviews_count = review_count($user_id, 'employer');
        $details['workers_count'] = $worker_count;
        $shift_data = ORM::for_table($config['db']['pre'] . 'timesheets')->table_alias('t')
            ->select_many('t.*', 'a.*', 'ar.*', 'w.name', 'w.username', ['id' => 't.id'], ['status' => 't.status'])
            ->where(array(
                'a.client_id' => $user_id,
                'a.status' => 'accepted',
                't.status' => 'submitted',
            ))
            ->join($config['db']['pre'] . 'user_agreements', array('a.id', '=', 't.agreement_id'), 'a')
            ->join($config['db']['pre'] . 'user_agreements_rates', array('ar.id', '=', 't.agreement_rate_id'), 'ar')
            ->right_outer_join($config['db']['pre'] . 'user', array('w.id', '=', 'a.worker_id'), 'w')
            ->limit(5)
            ->order_by_desc('t.id')
            ->find_many();
    } elseif ($userdata['user_type'] == 'user') {
        $job_count = applied_jobs_count($user_id);
        $reviews_count = review_count($user_id, 'user');
        $details['clients_count'] = clients_count($user_id, 'user');
        $shift_data = ORM::for_table($config['db']['pre'] . 'timesheets')->table_alias('t')
            ->select_many('t.*', 'a.*', 'ar.*', 'c.name', 'c.username', ['id' => 't.id'], ['status' => 't.status'])
            ->where(array(
                't.worker_id' => $user_id,
                'a.status' => 'accepted',
                't.status' => 'approved',
            ))
            ->join($config['db']['pre'] . 'user_agreements', array('a.id', '=', 't.agreement_id'), 'a')
            ->join($config['db']['pre'] . 'user_agreements_rates', array('ar.id', '=', 't.agreement_rate_id'), 'ar')
            ->right_outer_join($config['db']['pre'] . 'user', array('c.id', '=', 'a.client_id'), 'c')
            ->limit(5)
            ->order_by_desc('t.id')
            ->find_many();
    }
    foreach ($shift_data as $key => $approve) {
        $approved_shifts[$key]['id'] = $approve['id'];
        $approved_shifts[$key]['name'] = $approve['name'];
        $approved_shifts[$key]['approve_date'] = $approve['approved_at'] ?  date("d/m/Y", strtotime($approve['approved_at'])) : '';
        $approved_shifts[$key]['submitted_date'] = date("d/m/Y", strtotime($approve['created_at']));
    }
    $user_additionalinfo = userAdditionalInformation($user_id);
    $user_additionalinformation = $user_additionalinfo['total_additioninfo'] . '/4';
    $user_ref = user_references($user_id);
    $user_references = $user_ref['total_approved'] . '/' . $user_ref['total_references'];
    $user_doc = user_docs($user_id);
    $user_documents = $user_doc['total_verified'] . '/' . $user_doc['total_documents'];
    $details['jobs_count'] = $job_count;
    $details['reviews_count'] = $reviews_count;
    $details['chat_count'] = chat_count($user_id);
    $details['recent_shift'] = $approved_shifts;
    $details['profile_complete'] = progress_bar($user_id);
    $details['account_details'] = account_details_check($user_id);
    $details['additional_info'] = $user_additionalinformation;
    $details['user_refrences'] = $user_references;
    $details['user_documents'] = $user_documents;
    $results = ['status_code' => HTTP_OK, 'status' => $lang['SUCCESS'], 'message' => $lang['SUCCESS'], 'details' => $details, 'auth_token' => $loggedin['auth_token']];
    send_json($results);
    die();
}

function job_filled_status()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $userdata = get_user_data(null, $user_id);
    if ($userdata['user_type'] == 'employer') {
        $postid = $_REQUEST['job_id'];
        $is_filled = $_POST['is_filled'] == '1' ? '1' : '0';
        $job = ORM::for_table($config['db']['pre'] . 'product')->find_one($postid);
        $job->filled = $is_filled;
        if ($job->save()) {
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['UPDATED_SUCCESS'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['FAILED'];
        }
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['INVALID_USER'];
    }
    $results = ['status_code' => $status_code, 'status' =>  $status, 'message' => $message, 'auth_token' => $loggedin['auth_token']];
    send_json($results);
    die();
}

function resend_email()
{
    global $lang, $status, $status_code, $message;
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id =  $loggedin['user_id'];
    $sent = email_template("signup_confirm", $user_id);

    $status = $lang['SUCCESS'];
    $status_code = HTTP_OK;
    $message = 'Email sent successfully.';
    $results = ['status_code' => $status_code, 'status' => $status, 'message' =>  $message, 'auth_token' => $loggedin['auth_token']];
    send_json($results);
    die();
}

function get_salary_types()
{
    global $lang;
    $item = [];
    $salary_type = salary_types();
    foreach ($salary_type as $key => $value) {
        $item[$key]['id'] = $value['id'];
        $item[$key]['title'] = $value['title'];
    }
    $results = ['status_code' => HTTP_OK, 'status' => $lang['SUCCESS'], 'message' =>  $lang['SUCCESS'], 'items' =>  $item];
    send_json($results);
    die();
}

function profile_progress_bar()
{
    global $config, $lang;
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $progress_per = progress_bar($user_id);
    if ($progress_per != 100) {
        $message  = 'Your profile is not completed.Please complete it first.';
    } else {
        $message = 'Profile is completed';
    }
    $results = ['status_code' => HTTP_OK, 'status' =>  $lang['SUCCESS'], 'message' => $message, 'percentage' => $progress_per, 'auth_token' => $loggedin['auth_token']];
    send_json($results);
    die();
}

function user_progress_status()
{
    global $config, $lang;
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $profile_checked = $address_checked = $preference_checked = $education_checked = $skills_checked = $immunisation_checked = $document_checked = $about_me_checked = $custom_field_checked = $cult_back_checked = $rate_availibility_checked = false;
    if (profile_detail_check($user_id) != '') {
        $profile_checked = true;
    }

    if (!empty(address_details_check($user_id))) {
        $address_checked = true;
    }

    if (rate_availibility_check($user_id) != '') {
        $rate_availibility_checked = true;
    }

    if (experience_check($user_id) != '') {
        $preference_checked = true;
    }

    if (education_check($user_id) != '') {
        $education_checked = true;
    }

    if (skill_check($user_id) != '') {
        $skills_checked = true;
    }

    if (immunisation_info_check($user_id) != '') {
        $immunisation_checked = true;
    }

    if (documents_check($user_id) != '') {
        $document_checked = true;
    }

    if (about_me_check($user_id) != '') {
        $about_me_checked = true;
    }

    if (preference_check($user_id) != '') {
        $preference_checked = true;
    }

    if (custom_field_check($user_id) != '') {
        $custom_field_checked = true;
    }

    if (language_check($user_id) != '' && cultural_back_check($user_id) != '' && religion_check($user_id) != '' && interest_check($user_id) != '') {
        $cult_back_checked = true;
    }

    $checked_status = [
        'profile_checked' => $profile_checked,
        'address_checked' => $address_checked,
        'rate_availibility_checked' => $rate_availibility_checked,
        'preference_checked' => $preference_checked,
        'education_checked' => $education_checked,
        'skills_checked' => $skills_checked,
        'immunisation_checked' => $immunisation_checked,
        'document_checked' => $document_checked,
        'about_me_checked' => $about_me_checked,
        'custom_field_checked' => $custom_field_checked,
        'cultural_back_checked' => $cult_back_checked,
    ];
    $results = ['status_code' => HTTP_OK, 'status' =>  $lang['SUCCESS'], 'message' => $lang['SUCCESS'], 'checked_status' => $checked_status, 'auth_token' => $loggedin['auth_token']];
    send_json($results);
    die();
}

function category_based_document()
{
    global $config, $lang;
    $sub_category_ids = json_decode($_REQUEST['sub_category_ids'], true);
    $requirements = ORM::for_table($config['db']['pre'] . 'requirement_categories')->table_alias('req_c')
        ->select_many('req_c.requirement_id', 'req.name')
        ->where_in('subcategory_id', $sub_category_ids)
        ->where('req.status', '1')
        ->join($config['db']['pre'] . 'requirements', 'req.id = req_c.requirement_id ', 'req')
        ->group_by('requirement_id')->find_many()->as_array();
    $requirement_name = array_column($requirements, 'name');

    $results = ['status_code' => HTTP_OK, 'status' =>  $lang['SUCCESS'], 'message' => $lang['SUCCESS'], 'document_name' => $requirement_name];
    send_json($results);
    die();
}

function get_user_last_active_status()
{
    global $config, $lang;
    $session_user_id = isset($_REQUEST['session_user_id']) && !empty($_REQUEST['session_user_id']) ? $_REQUEST['session_user_id'] : '';
    $onofsts = '';
    if (!empty($session_user_id)) {
        $onofsts =  getlastActiveTime($session_user_id);
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = 'session user id is required';
    }

    $results = ['status_code' => $status_code, 'status' =>  $status, 'message' => $message, 'onofstatus' => $onofsts];
    send_json($results);
    die();
}

function worker_list()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $total_item = 0;
    $item = [];
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];
    $userdata = get_user_data(null, $user_id);
    if ($userdata['user_type'] == 'employer') {
        $limit = isset($_REQUEST['limit']) && !empty($_REQUEST['limit']) ? $_REQUEST['limit'] :  10;
        $page = isset($_REQUEST['page']) && !empty($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $offset = ($page - 1) * $limit;

        $workers = ORM::for_table($config['db']['pre'] . 'user_applied')->table_alias('ua')
            ->where_raw('job_id IN(SELECT id FROM ' . $config['db']['pre'] . 'product WHERE user_id = ' . $user_id . ') AND u.status = "1"')
            ->join($config['db']['pre'] . 'user', 'u.id=ua.user_id', 'u')
            ->group_by('u.id')
            ->limit($limit)->offset($offset)
            ->find_many();

        foreach ($workers as $key => $info) {
            $item[$info['id']]['id'] = $info['id'];
            $item[$info['id']]['username'] = $info['username'];
            $item[$info['id']]['name'] = !empty($info['name']) ? $info['name'] : $info['username'];
            $item[$info['id']]['firstname'] = $info['firstname'];
            $item[$info['id']]['description'] = nl2br(stripcslashes($info['description']));
            $item[$info['id']]['sex'] = $info['sex'];
            $item[$info['id']]['image'] = !empty($info['image']) ? $info['image'] : 'default_user.png';

            $item[$info['id']]['category'] = $item[$info['id']]['subcategory'] = null;
            if (!empty($info['category'])) {
                $get_cat = get_maincat_by_id($info['category']);
                $item[$info['id']]['category'] = $get_cat['cat_name'];
            }
            if (!empty($info['subcategory'])) {
                $get_cat = get_subcat_by_id($info['subcategory']);
                $item[$info['id']]['subcategory'] = $get_cat['sub_cat_name'];
            }
            $country_code = $info['country_code'];
            $item[$info['id']]['salary_min'] = price_format($info['salary_min'], $country_code);
            $item[$info['id']]['salary_max'] = price_format($info['salary_max'], $country_code);

            $item[$info['id']]['city'] = $info['city'];
            if (!empty($info['city_code'])) {
                $city_detail = get_cityDetail_by_id($info['city_code']);
                if (!empty($city_detail)) {
                    $item[$info['id']]['city'] = $city_detail['asciiname'];
                    $item[$info['id']]['city'] .= ', ' . get_stateName_by_id($city_detail['subadmin1_code']);
                }
            }
            $item[$info['id']]['user_id'] = $info['user_id'];
            $item[$info['id']]['favorite'] = check_user_favorite($info['user_id'], $user_id);
            $resume_link = null;
            if (!empty($info['resume_id'])) {
                $result = ORM::for_table($config['db']['pre'] . 'resumes')
                    ->where('user_id', $info['user_id'])
                    ->where('id', $info['resume_id'])
                    ->where('active', '1')
                    ->find_one();

                if (!empty($result)) {
                    $resume_link = $config['site_url'] . "storage/resumes/" . $result['filename'];
                }
            }
            $item[$info['id']]['resume'] = $resume_link;
        }
        $item = array_values($item);
        $total_item = worker_count($user_id);
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['INVALID_USER'];
    }
    $results = ['status_code' => $status_code, 'status' =>  $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'total' => $total_item, 'items' => $item];
    send_json($results);
    die();
}

function conversation_starter()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $mysqli = db_connect();
    $total_item = 0;
    $item = [];
    $loggedin = checkIsLoggedin();
    $user_id = $loggedin['user_id'];
    $userdata = get_user_data(null, $user_id);
    if ($userdata['user_type'] == 'employer') {
        $worker_id = (isset($_REQUEST['worker_id']) && !empty($_REQUEST['worker_id'])) ? $_REQUEST['worker_id'] : '';
        if (!empty($worker_id)) {
            $sort = "id";
            $order = isset($_REQUEST['order']) && !empty($_REQUEST['order']) ? $_REQUEST['order'] : "DESC";
            $limit = isset($_REQUEST['limit']) && !empty($_REQUEST['limit']) ? $_REQUEST['limit'] :  10;
            $page_number = isset($_REQUEST['page']) && !empty($_REQUEST['page']) ? $_REQUEST['page'] : 1;

            $where = '';
            $order_by = "
           (CASE
            WHEN g.top_search_result = 'yes' and p.featured = '1' and p.urgent = '1' and p.highlight = '1' THEN 1
            WHEN g.top_search_result = 'yes' and p.urgent = '1' and p.featured = '1' THEN 2
            WHEN g.top_search_result = 'yes' and p.urgent = '1' and p.highlight = '1' THEN 3
            WHEN g.top_search_result = 'yes' and p.featured = '1' and p.highlight = '1' THEN 4
            WHEN g.top_search_result = 'yes' and p.urgent = '1' THEN 5
            WHEN g.top_search_result = 'yes' and p.featured = '1' THEN 6
            WHEN g.top_search_result = 'yes' and p.highlight = '1' THEN 7
            WHEN g.top_search_result = 'yes' THEN 8
            WHEN p.featured = '1' and p.urgent = '1' and p.highlight = '1' THEN 9
            WHEN p.urgent = '1' and p.featured = '1' THEN 10
            WHEN p.urgent = '1' and p.highlight = '1' THEN 11
            WHEN p.featured = '1' and p.highlight = '1' THEN 12
            WHEN p.urgent = '1' THEN 13
            WHEN p.featured = '1' THEN 14
            WHEN p.highlight = '1' THEN 15
            ELSE 16
            END),$sort $order";

            $query = "SELECT p.*,u.group_id,g.top_search_result, c.name company_name, c.logo company_image FROM `" . $config['db']['pre'] . "product` as p
            LEFT JOIN `" . $config['db']['pre'] . "companies` c on p.company_id = c.id 
            LEFT JOIN `" . $config['db']['pre'] . "user` as u ON u.id = p.user_id
            LEFT JOIN `" . $config['db']['pre'] . "usergroups` as g ON g.group_id = u.group_id
            where p.status = 'active' AND p.hide = '0' AND p.user_id = $user_id AND NOT EXISTS (SELECT j.id FROM job_user_applied j WHERE j.user_id =$worker_id and j.job_id=p.id) $where ORDER BY $order_by LIMIT " . ($page_number - 1) * $limit . ",$limit";

            $total = mysqli_num_rows(mysqli_query($mysqli, "SELECT 1 FROM " . $config['db']['pre'] . "product as p where p.status = 'active' AND p.hide = '0' AND p.user_id=$user_id AND NOT EXISTS (SELECT j.id FROM job_user_applied j WHERE j.user_id =$worker_id and j.job_id=p.id) $where"));

            $item = array();
            $result = $mysqli->query($query);

            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($info = mysqli_fetch_assoc($result)) {
                    $item[$info['id']]['id'] = $info['id'];
                    $item[$info['id']]['featured'] = $info['featured'];
                    $item[$info['id']]['urgent'] = $info['urgent'];
                    $item[$info['id']]['highlight'] = $info['highlight'];
                    $item[$info['id']]['product_name'] = $info['product_name'];
                    $item[$info['id']]['company_id'] = $info['company_id'];
                    $item[$info['id']]['company_name'] = $info['company_name'];
                    $item[$info['id']]['company_image'] = !empty($info['company_image']) ? $info['company_image'] : 'default.png';
                    $item[$info['id']]['product_type'] = get_productType_title_by_id($info['product_type']);
                    $item[$info['id']]['salary_type'] = get_salaryType_title_by_id($info['salary_type']);
                    $item[$info['id']]['description'] = strlimiter(strip_tags($info['description']), 80);
                    $item[$info['id']]['category'] = $info['category'];
                    $item[$info['id']]['phone'] = $info['phone'];
                    $item[$info['id']]['address'] = strlimiter($info['location'], 20);
                    $cityname = get_cityName_by_id($info['city']);
                    $item[$info['id']]['location'] = $cityname;
                    $item[$info['id']]['city'] = $cityname;
                    $item[$info['id']]['state'] = get_stateName_by_id($info['state']);
                    $item[$info['id']]['country'] = get_countryName_by_id($info['country']);
                    $item[$info['id']]['latlong'] = $info['latlong'];
                    $salary_min = price_format($info['salary_min'], $info['country']);
                    $item[$info['id']]['salary_min'] = $salary_min;
                    $salary_max = price_format($info['salary_max'], $info['country']);
                    $item[$info['id']]['salary_max'] = $salary_max;
                    $item[$info['id']]['tag'] = $info['tag'];
                    $item[$info['id']]['status'] = $info['status'];
                    $item[$info['id']]['view'] = $info['view'];
                    $item[$info['id']]['created_at'] = timeAgo($info['created_at']);
                    $item[$info['id']]['cat_id'] = $info['category'];
                    $item[$info['id']]['sub_cat_id'] = $info['sub_category'];

                    $item[$info['id']]['image'] = !empty($info['screen_shot']) ? $info['screen_shot'] : $item[$info['id']]['company_image'];
                    $item[$info['id']]['favorite'] = check_product_favorite($info['id']);

                    if ($info['tag'] != '') {
                        $item[$info['id']]['showtag'] = "1";
                        $tag = explode(',', $info['tag']);
                        $tag2 = array();
                        foreach ($tag as $val) {
                            //REMOVE SPACE FROM $VALUE ----
                            $val = preg_replace("/[\s_]/", "-", trim($val));
                            $tag2[] = '<li><a href="' . $config['site_url'] . '/listing?keywords=' . $val . '">' . $val . '</a> </li>';
                        }
                        $item[$info['id']]['tag'] = implode('  ', $tag2);
                    } else {
                        $item[$info['id']]['tag'] = "";
                        $item[$info['id']]['showtag'] = "0";
                    }

                    $user = "SELECT username FROM " . $config['db']['pre'] . "user where id='" . $info['user_id'] . "'";
                    $userresult = mysqli_query($mysqli, $user);
                    $userinfo = mysqli_fetch_assoc($userresult);
                    $item[$info['id']]['username'] = $userinfo['username'];

                    if (check_user_upgrades($info['user_id'])) {
                        $sub_info = get_user_membership_detail($info['user_id']);
                        $item[$info['id']]['sub_title'] = $sub_info['sub_title'];
                        $item[$info['id']]['sub_image'] = $sub_info['sub_image'];
                    } else {
                        $item[$info['id']]['sub_title'] = '';
                        $item[$info['id']]['sub_image'] = '';
                    }

                    $item[$info['id']]['highlight_bg'] = ($info['highlight'] == 1) ? "highlight-premium-ad" : "";
                    $author_url = create_slug($userinfo['username']);
                    $item[$info['id']]['author_link'] = $config['site_url'] . 'profile/' . $author_url;
                    $pro_url = create_slug($info['product_name']);
                    $item[$info['id']]['link'] = $config['site_url'] . 'job/' . $info['id'] . '/' . $pro_url;

                    $city = create_slug($item[$info['id']]['city']);
                    $item[$info['id']]['citylink'] = $config['site_url'] . 'city/' . $info['city'] . '/' . $city;
                    $postid = base64_url_encode($info['id']);
                    $qcuserid = base64_url_encode($worker_id);
                    $item[$info['id']]['postid'] = $postid;
                    $item[$info['id']]['qcuserid'] = $qcuserid;
                }
            }
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['SUCCESS'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['NO_RESULT_FOUND'];
        }
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['INVALID_USER'];
    }
    $results = ['status_code' => $status_code, 'status' =>  $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'total' => $total_item, 'items' => array_values($item)];
    send_json($results);
    die();
}

function uploadChatFile()
{
    global $config, $lang, $con;
    $loggedin = checkIsLoggedin();
    $user_id = $loggedin['user_id'];
    $session_user_data = get_user_data(null, $user_id);
    @set_time_limit(5 * 60);
    $targetDir = '../../storage/user_files';
    $uploaddir = '../../storage/user_files/';
    $uploaddirpath = $config['site_url'] . 'storage/user_files/';
    $cleanupTargetDir = false; // Remove old files
    $maxFileAge = 5 * 3600; // Temp file age in seconds
    $post_id = isset($_REQUEST["post_id"]) ? $_REQUEST["post_id"] : 0;
    $chatid = isset($_REQUEST["chatid"]) ? $_REQUEST["chatid"] : 0;
    $to_id = isset($_REQUEST["to_id"]) ? $_REQUEST["to_id"] : 0;
    $from_user_id = $user_id;
    $from_username = $session_user_data['username'];
    $chat_user_data = get_user_data(null, $to_id);
    $tun = $chat_user_data['username'];

    // Create target dir
    if (!file_exists($targetDir)) {
        @mkdir($targetDir);
    }
    //dd($_FILES["file"]["name"]);
    // Get a file name
    if (isset($_REQUEST["name"])) {
        $fileName = $_REQUEST["name"];
    } elseif (!empty($_FILES)) {
        $fileName = $_FILES["file"]["name"];
    } else {
        $fileName = uniqid("file_");
    }

    $extensions = explode(".", $fileName);
    $extension = $extensions[count($extensions) - 1];
    $uniqueName = $fileName;
    $uploadfilepath = $uploaddirpath . $uniqueName;
    $filePath = $targetDir . DIRECTORY_SEPARATOR . $uniqueName;
    $file_type = "file";
    // Chunking might be enabled
    $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
    $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;

    // Remove old temp files	
    if ($cleanupTargetDir) {
        if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
        }
        while (($file = readdir($dir)) !== false) {
            $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
            // If temp file is current file proceed to the next
            if ($tmpfilePath == "{$filePath}.part") {
                continue;
            }
            // Remove temp file if it is older than the max age and is not the current file
            if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                @unlink($tmpfilePath);
            }
        }
        closedir($dir);
    }

    // Open temp file
    if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
        die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
    }
    if (!empty($_FILES)) {
        if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
        }
        // Read binary input stream and append it to temp file
        if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
        }
    } else {
        if (!$in = @fopen("php://input", "rb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
        }
    }

    while ($buff = fread($in, 4096)) {
        fwrite($out, $buff);
    }

    @fclose($out);
    @fclose($in);

    if ($extension == "jpg" || $extension == "jpeg" || $extension == "gif" || $extension == "png") {
        $file_type = "image";
        $size = filesize($_FILES['file']['tmp_name']);
        $image = $_FILES["file"]["name"];
        $uploadedfile = $_FILES['file']['tmp_name'];

        if ($image) {
            if ($extension == "jpg" || $extension == "jpeg") {
                $uploadedfile = $_FILES['file']['tmp_name'];
                $src = imagecreatefromjpeg($uploadedfile);
            } else if ($extension == "png") {
                $uploadedfile = $_FILES['file']['tmp_name'];
                $src = imagecreatefrompng($uploadedfile);
            } else {
                $src = imagecreatefromgif($uploadedfile);
            }

            list($width, $height) = getimagesize($uploadedfile);

            $newwidth = 225;
            $newheight = ($height / $width) * $newwidth;
            $tmp = imagecreatetruecolor($newwidth, $newheight);

            imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

            $filename = $uploaddir . "small" . $uniqueName;

            imagejpeg($tmp, $filename, 100);

            imagedestroy($src);
            imagedestroy($tmp);
        }
    } elseif ($extension == "mp4" || $extension == "MP4" || $extension == "flv") {
        $file_type = "video";
    } elseif ($extension == "doc" || $extension == "pdf") {
        $file_type = "document";
    }
    $result = array("file_name" => $uniqueName, "file_path" => $uploadfilepath, "file_type" => $file_type);
    // Check if file has been uploaded
    if (!$chunks || $chunk == $chunks - 1) {
        // Strip the temp .part suffix off
        rename("{$filePath}.part", $filePath);
        $from_user_id = $user_id;
        $message_content = json_encode($result);
        $query = "insert into `" . $config['db']['pre'] . "messages`
            (message_date,from_id,to_id,from_uname,to_uname,message_content,message_type,post_id) values " .
            "('" . $GLOBALS['timenow'] . "', $from_user_id, $to_id, '" . mysqli_real_escape_string($con, $from_username) . "','" . mysqli_real_escape_string($con, $tun) . "','" . mysqli_real_escape_string($con, $message_content) . "','file','" . mysqli_real_escape_string($con, $post_id) . "')";
        $con->query($query);
        $last_id = $con->insert_id;
        $other_data = ['id' => $last_id, 'toName' => $tun, 'file_name' => $uniqueName, 'file_path' => $uploadfilepath, 'file_type' => $file_type];
        // Return Success JSON-RPC response
        $results = ['status_code' => HTTP_OK, 'status' =>  $lang['SUCCESS'], 'message' => $lang['SUCCESS'], 'auth_token' => $loggedin['auth_token'], 'other_data' => $other_data];
        send_json($results);
        die();
    }
}

function find_city()
{
    global $config, $lang;
    $city_name = $_REQUEST['city_name'];
    $city_data = ORM::for_table($config['db']['pre'] . 'cities')->where_raw('name = ? OR asciiname = ?', array($city_name, $city_name))->find_one();
    if ($city_data) {
        $city_data = $city_data->as_array();
        $results = ['status_code' => HTTP_OK, 'status' =>  $lang['SUCCESS'], 'message' => $lang['SUCCESS'], 'city_data' => $city_data];
    } else {
        $results = ['status_code' => HTTP_UNPROCESSABLE_ENTITY, 'status' =>  $lang['FAILED'], 'message' => 'address not found', 'city_data' => $city_data];
    }
    send_json($results);
    die;
}

function product_type()
{
    global $config, $lang;
    $rows = ORM::for_table($config['db']['pre'] . 'product_type')
        ->where('active', '1')
        ->order_by_asc('position')
        ->find_many();
    $post_types = array();
    if (!empty($rows)) {
        foreach ($rows as $row) {
            $post['id'] = $row['id'];
            $post['title'] = get_productType_title_by_id($row['id']);
            array_push($post_types, $post);
        }
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['NO_RESULT_FOUND'];
    }
    $results = ['status_code' => $status_code, 'status' =>  $status, 'message' => $message, 'data' => $post_types];
    send_json($results);
    die;
}

function getCity_range()
{
    global $config, $lang;
    $MyCity = array();
    $loggedin = checkIsLoggedin();
    $user_id = $loggedin['user_id'];
    $userdata = get_user_data(null, $user_id);
    if ($userdata['user_type'] == 'user') {
        if (isset($_REQUEST['city_range']) && $_REQUEST['city_range'] != "") {
            $city_range = $_REQUEST['city_range'];
            $city_data = ORM::for_table($config['db']['pre'] . 'user')->table_alias('u')
                ->select_many('c.name', 'c.id', 'c.latitude', 'c.longitude', 'u.state_code', ['statename' => 's.name'])
                ->where('u.id', $user_id)
                ->join($config['db']['pre'] . 'cities', 'u.city_code = c.id', 'c')
                ->join($config['db']['pre'] . 'subadmin1', 's.code = c.subadmin1_code', 's')
                ->find_one();
            if (!empty($city_data)) {
                $nearest_city_sql = 'SELECT *, ( 3956 * 2 * ASIN( SQRT( POWER( SIN( (' . $city_data['latitude'] . ' - latitude) * PI() / 180 / 2), 2 ) + COS(' . $city_data['latitude'] . ' * PI() / 180) * COS(' . $city_data['latitude'] . ' * PI() / 180) * POWER( SIN( (' . $city_data['longitude'] . ' - longitude) * PI() / 180 / 2), 2 ) ))) AS distance FROM ' . $config['db']['pre'] . 'cities  WHERE id != ' . $city_data['id'] . '    HAVING distance <= "' . $city_range . '" ORDER BY distance ASC ;';
                $home_nearest_cities = ORM::for_table($config['db']['pre'] . 'cities')->raw_query($nearest_city_sql)->find_array();

                foreach ($home_nearest_cities as $list_home_nearest_cities) {
                    $cityid = $list_home_nearest_cities['id'];
                    $cityname = $list_home_nearest_cities['asciiname'];
                    $latitude = $list_home_nearest_cities['latitude'];
                    $longitude = $list_home_nearest_cities['longitude'];
                    $statename =  $city_data['statename'];
                    $MyCity_data["id"]   = $cityid;
                    $MyCity_data["text"] = $cityname . ", " . $statename;
                    $MyCity_data["latitude"]   = $latitude;
                    $MyCity_data["longitude"]   = $longitude;
                    array_push($MyCity, $MyCity_data);
                }
                $status_code = HTTP_OK;
                $status = $lang['SUCCESS'];
                $message = $lang['SUCCESS'];
            } else {
                $status_code = HTTP_NOT_FOUND;
                $status = $lang['ERROR'];
                $message = $lang['NO_RESULT_FOUND'];
            }
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = $lang['CITY_RANGE_ERR'];
        }
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = $lang['INVALID_USER'];
    }
    $results = ['status_code' => $status_code, 'status' =>  $status, 'message' => $message, 'data' => $MyCity];
    send_json($results);
    die;
}

function show_offer_agreements_jobs()
{
    global $config, $lang;
    $uniqueMyJobs = [];
    if ($_REQUEST['user_id'] != "") {
        $user_id = $_REQUEST['user_id'];

        $sql = "SELECT id,user_id, product_name as text
                FROM `" . $config['db']['pre'] . "product`
                WHERE id IN
                (SELECT distinct job_id
                FROM `" . $config['db']['pre'] . "user_applied`
                WHERE `user_id` = " . $user_id . ")
                ";
        $user_applied_job_lists =  ORM::for_table($config['db']['pre'] . 'product')->raw_query($sql)->find_array();

        $MyJobs = $user_applied_job_lists;
        $uniqueMyJobs = array_values($MyJobs);
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = "User Id not found !";
    }
    $results = ['status_code' => $status_code, 'status' =>  $status, 'message' => $message, 'data' => $uniqueMyJobs];
    send_json($results);
    die;
}

function client_request_agreement()
{
    global $config, $lang;
    $error = 0;
    $errors = [];
    $loggedin = checkIsLoggedin();
    if ($_REQUEST['userid'] == "") {
        $error++;
        $errors['userid'] = "User id is required !";
    }
    if ($_REQUEST['postid'] == "") {
        $error++;
        $errors['postid'] = "Post id is required !";
    }
    if ($_REQUEST['status'] == "") {
        $error++;
        $errors['status'] = "Status is required !";
    }
    if (!count($errors) > 0) {
        $user_id = $loggedin['user_id'];
        $postid = $_REQUEST['postid'];
        $status = $_REQUEST['status'];
        $all_workers = $_REQUEST['userid'];
        $userdata = get_user_data(null, $user_id);
        if ($userdata['user_type'] == 'employer') {
            $client_id = $user_id;
            $worker_id = $all_workers;
        } elseif ($userdata['user_type'] == 'user') {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = "Only Employer can send request !";
            $results = ['status_code' => $status_code, 'status' =>  $status, 'message' => $message];
            send_json($results);
            die;
        }
        $now = date('Y-m-d H:i:s');
        $worker_id = json_decode($worker_id);
        if (!is_array($worker_id)) {
            $agr_data = ORM::for_table($config['db']['pre'] . 'user_agreements')->create();
            $agr_data->post_id = $postid;
            $agr_data->client_id = $client_id;
            $agr_data->worker_id = $worker_id;
            $agr_data->status = $status;
            $agr_data->created_at = $now;
            $agr_data->updated_at = $now;
            $agr_data->save();
        } else {
            foreach ($worker_id as $workerid) {
                $agr_data = ORM::for_table($config['db']['pre'] . 'user_agreements')->create();
                $agr_data->post_id = $postid;
                $agr_data->client_id = $client_id;
                $agr_data->worker_id = $workerid;
                $agr_data->status = $status;
                $agr_data->created_at = $now;
                $agr_data->updated_at = $now;
                $agr_data->save();
            }
        }
        $status = $lang['SUCCESS'];
        $status_code = HTTP_OK;
        $message = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $message = $errors;
    }
    $results = ['status_code' => $status_code, 'status' =>  $status, 'message' => $message];
    send_json($results);
    die;
}

function getTimesheetDetailsById()
{
    global $config, $lang;
    $loggedin = checkIsLoggedin();
    $item = [];
    if (isset($_REQUEST['timesheet_id']) && $_REQUEST['timesheet_id'] != "") {
        $valid_auth_token  = isAuthTokenValid();
        $bearer_token = getBearerToken();
        if ($bearer_token != null && $valid_auth_token) {
            $user_id = get_device_token($valid_auth_token, 'user_id');
            $user_type = get_user_data(null, $user_id)['user_type'];
            if ($user_type == "employer") {
                $commission = (int)get_option('client_commission');
                $total = ORM::for_table($config['db']['pre'] . 'timesheets')->table_alias('t')
                    ->where(array(
                        'a.client_id' => $user_id,
                        't.id' => $_REQUEST['timesheet_id']
                    ))
                    ->join($config['db']['pre'] . 'user_agreements', array('a.id', '=', 't.agreement_id'), 'a')
                    ->count();
                $where = array('a.client_id' => $user_id, 'a.status' => 'accepted', 't.id' => $_REQUEST['timesheet_id']);
                $join_condition = 'a.worker_id=u.id';
            } elseif ($user_type == "user") {
                $commission = (int)get_option('worker_commission');
                $total = ORM::for_table($config['db']['pre'] . 'timesheets')->table_alias('t')
                    ->where(array(
                        't.worker_id' => $user_id,
                        't.id' => $_REQUEST['timesheet_id']
                    ))
                    ->count();
                $where = array('t.worker_id' => $user_id, 'a.status' => 'accepted', 't.id' => $_REQUEST['timesheet_id']);
                $join_condition = 'a.client_id=u.id';
            }
            if ($total > 0) {
                $info = ORM::for_table($config['db']['pre'] . 'timesheets')->table_alias('t')
                    ->select_many('t.*', 'a.post_id', 'a.client_id', 'a.worker_id', 'a.status', 'a.agreed_services', 'a.created_at', 'a.updated_at', 'ar.*', 'u.name', 'u.username', ['id' => 't.id', 'status' => 't.status', 'post_status' => 'p.status', 'post_name' => 'p.product_name'])
                    ->where($where)
                    ->where_raw(" t.deleted_at IS NULL ")
                    ->join($config['db']['pre'] . 'user_agreements', array('a.id', '=', 't.agreement_id'), 'a')
                    ->join($config['db']['pre'] . 'user_agreements_rates', array('ar.id', '=', 't.agreement_rate_id'), 'ar')
                    ->join($config['db']['pre'] . 'product', array('a.post_id', '=', 'p.id'), 'p')
                    ->right_outer_join($config['db']['pre'] . 'user', $join_condition, 'u')
                    ->find_one();
                if (!empty($info)) {
                    $duspute_info = ORM::for_table($config['db']['pre'] . 'disputes')->where('timesheet_id', $info['id'])->find_one();
                    if (!empty($duspute_info)) {
                        $is_disputed = true;
                        $dispute_id = $duspute_info['id'];
                        $dispute_status = $duspute_info['status'];
                        $dispute_amount = $duspute_info['amount'];
                        $dispute_description = $duspute_info['amount'];
                        $dispute_created_at = $duspute_info['created_at'];
                        $disputed_at = $duspute_info['disputed_at'];
                        $rejected_dispute_reason = $duspute_info['reason'];
                    }
                    if ($info['incidence_occured'] == "1") {
                        $incident = '<i class="icon-feather-archive" style="color: red"> Incident Occured</i><br>';
                    } else {
                        $incident = "";
                    }

                    $datetime1 = new DateTime($info['start_time']);
                    $datetime2 = new DateTime($info['end_time']);
                    $interval = $datetime1->diff($datetime2);

                    $iCostPerHour = $info['rate'];
                    $h = $interval->format('%H');
                    $m = $interval->format('%I');
                    $hour_rate = $h * $iCostPerHour + $m / 60 * $iCostPerHour;
                    if ($user_type == 'employer') {
                        $total_hour_rate = $hour_rate + ($hour_rate * $commission / 100);
                    } else {
                        $total_hour_rate = $hour_rate - ($hour_rate * $commission / 100);
                    }

                    $total_due = number_format((float)$total_hour_rate, 2, '.', '');

                    $item['id'] = $info['id'];
                    $item['description'] = $info['shift_details'];
                    $item['hours'] = $interval->format('%h') . ' Hrs ' . $interval->format('%i') . ' Min';
                    $item['date'] = date('d/m/Y', strtotime($info['created_at']));
                    $item['due'] =  $total_due;
                    $item['status'] = $info['status'];
                    $item['payment_status'] = ucfirst($info['payment_status']);
                    $item['invoice_generate'] = $info['invoice_generate'];
                    $item['invoice_generate_date'] = !empty($info['invoice_generate_date']) ? date('d/m/Y', strtotime($info['invoice_generate_date'])) : '';
                    $item['payment_at'] = !empty($info['disbursed_at']) ? date('d/m/Y', strtotime($info['disbursed_at'])) : '';
                    $item['approved_at'] = !empty($info['approved_at']) ? date('d/m/Y', strtotime($info['approved_at'])) : '';
                    $item['fullname'] = !empty($info['name']) ? ucwords($info['name']) : ucfirst($info['username']);

                    $item['post_name'] = $info['post_name'];
                    $item['post_status'] = $info['post_status'];
                    $item['is_disputed'] = $is_disputed;
                    $item['dispute_id'] =   $dispute_id;
                    $item['dispute_status'] = $dispute_status;
                    $item['dispute_amount'] = $dispute_amount;
                    $item['dispute_description'] = $dispute_description;
                    $item['dispute_created_at'] = $dispute_created_at;
                    $item['disputed_at'] = $disputed_at;
                    $item['rejected_dispute_reason'] = $rejected_dispute_reason;
                    $item['incident_occurred'] = ($info['incidence_occured'] == 1) ? true : false;
                    $incident = ORM::for_table($config['db']['pre'] . 'incidents')->select('id')->where('timesheet_id', $info['id'])->find_one();
                    $item['incident_id'] = !empty($incident) ? $incident['id'] : '';

                    //$item = array_values($item);
                    $status_code = HTTP_OK;
                    $status = $lang['SUCCESS'];
                    $message = $lang['SUCCESS'];
                } else {
                    $status_code = HTTP_NOT_FOUND;
                    $status = $lang['ERROR'];
                    $message = "Data Not Found !";
                }
            } else {
                $status_code = HTTP_NOT_FOUND;
                $status = $lang['ERROR'];
                $message = "Data Not Found !";
            }
        } else {
            $status_code = HTTP_UNAUTHORIZED;
            $status = $lang['ERROR'];
            $message = $lang['AUTHTOKENMISMATCH'];
        }
    } else {
        $status_code = HTTP_UNPROCESSABLE_ENTITY;
        $status = $lang['ERROR'];
        $message = "Timesheet Id not Found !";
    }
    $results = ['status_code' => $status_code, 'status' =>  $status, 'message' => $message, 'data' => $item];
    send_json($results);
    die;
}

// function invoicePaymentListing()
// {
//     global $config, $lang, $status, $status_code, $message, $results;
//     $item = [];
//     $loggedin = checkIsLoggedin();
//     update_lastactive();
//     $user_id = $loggedin['user_id'];
//     $userdata = get_user_data(null, $user_id);
//     if ($userdata['user_type'] == 'employer') {
//         $limit = isset($_REQUEST['limit']) && !empty($_REQUEST['limit']) ? $_REQUEST['limit'] :  10;
//         $page = isset($_REQUEST['page']) && !empty($_REQUEST['page']) ? $_REQUEST['page'] : 1;
//         $offset = ($page - 1) * $limit;
//         if ((isset($_REQUEST['limit']) &&  $_REQUEST['limit'] != '') &&  (isset($_REQUEST['page']) && $_REQUEST['page'] != '')) {
//             $invoice_payment_data = ORM::for_table($config['db']['pre'] . 'invoice')->where('clientid', $userdata['id'])->limit($limit)->offset($offset)->find_array();
//         } else {
//             $invoice_payment_data = ORM::for_table($config['db']['pre'] . 'invoice')->where('clientid', $userdata['id'])->find_array();
//         }
//         foreach ($invoice_payment_data as $invoice_data) {
//             $name = '#' . $invoice_data['prefix'] . $invoice_data['id'];
//             $users = invoice_involve_users($invoice_data['worker_id'], $invoice_data['id']);
//             $payment_date = !empty($invoice_data['payment_at']) ? date('d M Y', strtotime($invoice_data['payment_at'])) : "--";

//             $item['invoice'] = $name;
//             $item['workers'] = $users;
//             $item['status'] = $invoice_data['status'];
//             $item['date'] = $payment_date;

//             $status_code = HTTP_OK;
//             $status = $lang['SUCCESS'];
//             $message = $lang['SUCCESS'];
//         }
//     } else {
//         $status_code = HTTP_UNPROCESSABLE_ENTITY;
//         $status = $lang['ERROR'];
//         $message = $lang['INVALID_USER'];
//     }
//     $results = ['status_code' => $status_code, 'status' =>  $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'items' => $item];
//     send_json($results);
//     die();
// }

function showInvoiceAllAmount()
{
    global $config, $lang;
    $loggedin = checkIsLoggedin();
    $user_data = get_user_data(null, $loggedin['user_id']);
    if (!empty($loggedin) && $user_data['user_type'] == "employer") {
        $client_invoice_unpaid = ORM::for_table('job_invoice')->raw_query('SELECT `i`.`clientid`, `u`.`username`,COUNT(`i`.`id`) as count_invoice, SUM(`i`.`total`) as amount_sum FROM `job_invoice` `i` JOIN `job_user` `u` ON `u`.`id` = `i`.`clientid` WHERE `i`.`status` = "unpaid" AND `i`.`clientid` = "' . $loggedin['user_id'] . '" GROUP BY `i`.`clientid`')->find_one();
        if (!empty($client_invoice_unpaid)) {
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = $lang['SUCCESS'];
            $data['clientid'] = $client_invoice_unpaid['clientid'];
            $data['username'] = $client_invoice_unpaid['username'];
            $data['count_invoice'] = $client_invoice_unpaid['count_invoice'];
            $data['amount_sum'] = $client_invoice_unpaid['amount_sum'];
        } else {
            $status_code = HTTP_UNPROCESSABLE_ENTITY;
            $status = $lang['ERROR'];
            $message = "Data Not found !";
            $data = [];
        }
        $results = ['status_code' => $status_code, 'status' =>  $status, 'message' => $message, 'data' => $data];
        send_json($results);
        die;
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = "Please Login Employer !";
        $results = ['status_code' => $status_code, 'status' =>  $status, 'message' => $message];
        send_json($results);
        die;
    }
}

function invoice_Payment_Wallet()
{
    global $config, $lang;
    $loggedin = checkIsLoggedin();
    $user_data = get_user_data(null, $loggedin['user_id']);
    if (!empty($loggedin) && $user_data['user_type'] == "employer") {
        if (isset($_REQUEST['invoice_id']) && !empty($_REQUEST['invoice_id'])) {
            $invoices = ORM::for_table($config['db']['pre'] . 'invoice')->table_alias('i')
                ->select_many('i.*')
                ->where(array(
                    'i.status' => 'unpaid',
                    'i.clientid' => $loggedin['user_id'],
                    'i.id' => $_REQUEST['invoice_id']
                ))
                ->find_array();
        } else {
            $invoices = ORM::for_table($config['db']['pre'] . 'invoice')->table_alias('i')
                ->select_many('i.*')
                ->where(array(
                    'i.status' => 'unpaid',
                    'i.clientid' => $loggedin['user_id']
                ))
                ->find_array();
        }
        if (!empty($invoices)) {
            foreach ($invoices as $invoice) {
                if ($invoice['total'] > 0) {
                    $invoice_clientid = $invoice['clientid'];
                    $client_wallet_amount = show_wallet_amount($invoice['clientid']);
                    $data_tranjection = ORM::for_table($config['db']['pre'] . 'transaction')->create();
                    $data_tranjection->userid = $invoice['clientid'];
                    $data_tranjection->invoice_id = $invoice['id'];
                    $data_tranjection->amount = $invoice['total'];
                    $data_tranjection->transaction_time = time();
                    $data_tranjection->status = 'success';
                    $data_tranjection->transaction_gatway = "stripe";
                    $data_tranjection->transaction_type = "debit";
                    $data_tranjection->transaction_for = "wallet";
                    $data_tranjection->transaction_of = "client";
                    $data_tranjection->transaction_ip = $_SERVER['REMOTE_ADDR'];
                    $data_tranjection->transaction_description = "Invoice Payment ";
                    $data_tranjection->created_at = date('Y-m-d H:i:s');
                    $data_tranjection->save();
                    updateClosingAmount($data_tranjection->id, $invoice['clientid']);

                    $debited_amount = $invoice['total'];
                    $remaing_amount = 0;

                    $invoice_item = ORM::for_table('job_invoice_items')->raw_query('SELECT SUM(`item`.`invoice_amount`) AS `sum`, item.worker_id FROM `job_invoice_items` `item` WHERE `item`.`invoice_id` = "' . $invoice['id'] . '" GROUP BY `item`.`worker_id`')->find_many();

                    foreach ($invoice_item as $item) {
                        $worker_tranjection = ORM::for_table($config['db']['pre'] . 'transaction')->create();
                        $worker_tranjection->userid = $item['worker_id'];
                        $worker_tranjection->invoice_id = $invoice['id'];
                        $worker_tranjection->amount = $item['sum'];
                        $worker_tranjection->transaction_time = time();
                        $worker_tranjection->status = 'success';
                        $worker_tranjection->transaction_gatway = "stripe";
                        $worker_tranjection->transaction_type = "credit";
                        $worker_tranjection->transaction_for = "wallet";
                        $worker_tranjection->transaction_of = "worker";
                        $worker_tranjection->transaction_ip = $_SERVER['REMOTE_ADDR'];
                        $worker_tranjection->transaction_description = "Invoice Payment";
                        $worker_tranjection->created_at = date('Y-m-d H:i:s');
                        $worker_tranjection->save();
                        updateClosingAmount($worker_tranjection->id, $item['worker_id']);

                        $remaing_amount = ($debited_amount - $item['sum']);
                    }

                    $all_timesheets =  ORM::for_table($config['db']['pre'] . 'invoice_items')->table_alias('i')
                        ->where(array(
                            'i.invoice_id' => $invoice['id'],
                        ))
                        ->find_many();

                    foreach ($all_timesheets as $timesheet) {
                        $data_timesheet = ORM::for_table($config['db']['pre'] . 'timesheets')->find_one($timesheet['timesheet_id']);
                        $data_timesheet->set('payment_status', 'paid');
                        $data_timesheet->set('disbursed_at', date('Y-m-d H:i:s'));
                        $data_timesheet->save();
                    }

                    $data_invoice = ORM::for_table($config['db']['pre'] . 'invoice')->find_one($invoice['id']);
                    $data_invoice->set('status', 'paid');
                    $data_invoice->set('payment_at', date('Y-m-d H:i:s'));
                    $data_invoice->save();

                    $admin_tranjection = ORM::for_table($config['db']['pre'] . 'transaction')->create();
                    $admin_tranjection->invoice_id = $invoice['id'];
                    $admin_tranjection->amount = $remaing_amount;
                    $admin_tranjection->transaction_time = time();
                    $admin_tranjection->status = 'success';
                    $admin_tranjection->transaction_gatway = "stripe";
                    $admin_tranjection->transaction_type = "credit";
                    $admin_tranjection->transaction_for = "wallet";
                    $admin_tranjection->transaction_of = "admin";
                    $admin_tranjection->transaction_ip = $_SERVER['REMOTE_ADDR'];
                    $admin_tranjection->transaction_description = "Invoice Payment";
                    $admin_tranjection->created_at = date('Y-m-d H:i:s');
                    $admin_tranjection->save();
                    updateAdminClosingAmount($admin_tranjection->id);

                    WithdrawAffliateMony($invoice_clientid);

                    // Send Notification Funtion 
                    $notification = "false";
                    $check_client_notification = get_user_notification_type_new($invoice_clientid);
                    if (!empty($check_client_notification) && array_key_exists("invoice_paid", $check_client_notification)) {
                        if ($check_client_notification['invoice_paid'] == "1") {
                            $notification = "true";
                        }
                    } else {
                        $notification = "true";
                    }
                    if ($notification == "true") {
                        $noteMsg = "Invoice Payment Successfully !";
                        $OwnerId = $invoice['clientid'];
                        sendFCM($noteMsg, $OwnerId, "Invoice Payment");
                        email_template("shift_invoice_payment", $invoice_clientid, "", $invoice['id']);
                    }

                    if (isset($invoice['worker_id']) && $invoice['worker_id'] != "") {
                        $workers = explode(',', $invoice['worker_id']);
                        foreach ($workers as $worker) {
                            // Send Notification Funtion 
                            $notification = "false";
                            $check_worker_notification = get_user_notification_type_new($worker);
                            if (!empty($check_worker_notification) && array_key_exists("invoice_paid", $check_client_notification)) {
                                if ($check_worker_notification['invoice_paid'] == "1") {
                                    $notification = "true";
                                }
                            } else {
                                $notification = "true";
                            }
                            if ($notification == "true") {
                                $noteMsg = "Invoice Payment Successfully !";
                                $OwnerId = $worker;
                                sendFCM($noteMsg, $OwnerId, "Invoice Payment");
                                email_template("shift_invoice_payment", $worker, "", $invoice['id']);
                            }
                        }
                    }
                }
            }
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = "Invoice Payment Successfull !";
        } else {
            $status_code = HTTP_UNAUTHORIZED;
            $status = $lang['ERROR'];
            $message = "Invoice Already Paid !";
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = "Please Login Employer !";
    }
    $results = ['status_code' => $status_code, 'status' =>  $status, 'message' => $message];
    send_json($results);
    die;
}

function invoice_Payment_online()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $loggedin = checkIsLoggedin();
    $user_id = $loggedin['user_id'];
    stripe_config();
    if (isset($_REQUEST['payment_id']) && $_REQUEST['payment_id'] != "") {
        $paymnetId = $_REQUEST['payment_id'];
        $paymentIntent = \Stripe\PaymentIntent::retrieve($paymnetId, []);
        if (isset($_REQUEST['redirect_status']) && $_REQUEST['redirect_status'] == "succeeded") {
            $payment_status = "success";
        } else {
            $payment_status = "failed";
        }
        //Invoice Payment
        if (isset($_REQUEST['invoice_id']) && !empty($_REQUEST['invoice_id'])) {
            $invoices = ORM::for_table($config['db']['pre'] . 'invoice')->table_alias('i')
                ->select_many('i.*')
                ->where(array(
                    'i.status' => 'unpaid',
                    'i.clientid' => $user_id,
                    'i.id' => $_REQUEST['invoice_id']
                ))
                ->find_array();
        } else {
            $invoices = ORM::for_table($config['db']['pre'] . 'invoice')->table_alias('i')
                ->select_many('i.*')
                ->where(array(
                    'i.status' => 'unpaid',
                    'i.clientid' => $user_id
                ))
                ->find_array();
        }
        if (!empty($invoices)) {
            $tranjection_id = $paymentIntent['charges']['data'][0]['balance_transaction'];
            $tranjection_gateway = "stripe";
            $transaction_type = "debit";
            $transaction_method = "bank";
            $description = "Cash deposit at Bank for invoice Payment.";
            $bank_tranjection = ORM::for_table($config['db']['pre'] . 'transaction')->create();
            $bank_tranjection->userid = $user_id;
            $bank_tranjection->amount = $paymentIntent['amount'] / 100;
            $bank_tranjection->transaction_time = $paymentIntent['created'];
            $bank_tranjection->status = $payment_status;
            $bank_tranjection->transaction_gatway = $tranjection_gateway;
            $bank_tranjection->transaction_type = $transaction_type;
            $bank_tranjection->transaction_ip = $_SERVER['REMOTE_ADDR'];
            $bank_tranjection->transaction_description = $description;
            $bank_tranjection->transaction_for = $transaction_method;
            $bank_tranjection->transaction_of = "client";
            $bank_tranjection->transaction_id = $tranjection_id;
            $bank_tranjection->paymentintent_id = $paymentIntent['id'];
            $bank_tranjection->created_at = date('Y-m-d H:i:s');
            $bank_tranjection->save();
            updateBankClosingAmount($bank_tranjection->id, $user_id);

            foreach ($invoices as $invoice) {
                if ($invoice['total'] > 0) {
                    $invoice_clientid = $invoice['clientid'];

                    $debited_amount = $invoice['total'];
                    $remaing_amount = 0;

                    $invoice_item = ORM::for_table('job_invoice_items')->raw_query('SELECT SUM(`item`.`invoice_amount`) AS `sum`, item.worker_id FROM `job_invoice_items` `item` WHERE `item`.`invoice_id` = "' . $invoice['id'] . '" GROUP BY `item`.`worker_id`')->find_many();

                    foreach ($invoice_item as $item) {
                        $worker_tranjection = ORM::for_table($config['db']['pre'] . 'transaction')->create();
                        $worker_tranjection->userid = $item['worker_id'];
                        $worker_tranjection->invoice_id = $invoice['id'];
                        $worker_tranjection->amount = $item['sum'];
                        $worker_tranjection->transaction_time = time();
                        $worker_tranjection->status = 'success';
                        $worker_tranjection->transaction_gatway = "stripe";
                        $worker_tranjection->transaction_type = "credit";
                        $worker_tranjection->transaction_for = "wallet";
                        $worker_tranjection->transaction_of = "worker";
                        $worker_tranjection->transaction_ip = $_SERVER['REMOTE_ADDR'];
                        $worker_tranjection->transaction_description = "Invoice Payment";
                        $worker_tranjection->created_at = date('Y-m-d H:i:s');
                        $worker_tranjection->save();
                        updateClosingAmount($worker_tranjection->id, $item['worker_id']);
                        $remaing_amount = ($debited_amount - $item['sum']);
                    }

                    $all_timesheets =  ORM::for_table($config['db']['pre'] . 'invoice_items')->table_alias('i')
                        ->where(array(
                            'i.invoice_id' => $invoice['id'],
                        ))
                        ->find_many();

                    foreach ($all_timesheets as $timesheet) {
                        $data_timesheet = ORM::for_table($config['db']['pre'] . 'timesheets')->find_one($timesheet['timesheet_id']);
                        $data_timesheet->set('payment_status', 'paid');
                        $data_timesheet->set('disbursed_at', date('Y-m-d H:i:s'));
                        $data_timesheet->save();
                    }

                    $data_invoice = ORM::for_table($config['db']['pre'] . 'invoice')->find_one($invoice['id']);
                    $data_invoice->set('status', 'paid');
                    $data_invoice->set('payment_at', date('Y-m-d H:i:s'));
                    $data_invoice->save();

                    $admin_tranjection = ORM::for_table($config['db']['pre'] . 'transaction')->create();
                    $admin_tranjection->invoice_id = $invoice['id'];
                    $admin_tranjection->amount = $remaing_amount;
                    $admin_tranjection->transaction_time = time();
                    $admin_tranjection->status = 'success';
                    $admin_tranjection->transaction_gatway = "stripe";
                    $admin_tranjection->transaction_type = "credit";
                    $admin_tranjection->transaction_for = "wallet";
                    $admin_tranjection->transaction_of = "admin";
                    $admin_tranjection->transaction_ip = $_SERVER['REMOTE_ADDR'];
                    $admin_tranjection->transaction_description = "Invoice Payment";
                    $admin_tranjection->created_at = date('Y-m-d H:i:s');
                    $admin_tranjection->save();
                    updateAdminClosingAmount($admin_tranjection->id);

                    WithdrawAffliateMony($invoice_clientid);

                    // Send Notification Funtion 
                    $notification = "false";
                    $check_client_notification = get_user_notification_type_new($invoice_clientid);
                    if (!empty($check_client_notification) && array_key_exists("invoice_paid", $check_client_notification)) {
                        if ($check_client_notification['invoice_paid'] == "1") {
                            $notification = "true";
                        }
                    } else {
                        $notification = "true";
                    }
                    if ($notification == "true") {
                        $noteMsg = $lang['INVOICE_PAYMENT_SUCCESSFULL'];
                        $OwnerId = $invoice['clientid'];
                        sendFCM($noteMsg, $OwnerId, "Invoice Payment");
                        email_template("shift_invoice_payment", $invoice_clientid, "", $invoice['id']);
                    }

                    if (isset($invoice['worker_id']) && $invoice['worker_id'] != "") {
                        $workers = explode(',', $invoice['worker_id']);
                        foreach ($workers as $worker) {
                            // Send Notification Funtion 
                            $notification = "false";
                            $check_worker_notification = get_user_notification_type_new($worker);
                            if (!empty($check_worker_notification) && array_key_exists("invoice_paid", $check_worker_notification)) {
                                if ($check_worker_notification['invoice_paid'] == "1") {
                                    $notification = "true";
                                }
                            } else {
                                $notification = "true";
                            }
                            if ($notification == "true") {
                                $noteMsg = $lang['INVOICE_PAYMENT_SUCCESSFULL'];
                                $OwnerId = $invoice['clientid'];
                                sendFCM($noteMsg, $OwnerId, "Invoice Payment");
                                email_template("shift_invoice_payment", $worker, "", $invoice['id']);
                            }
                        }
                    }
                }
            }
            $status_code = HTTP_OK;
            $status = $lang['SUCCESS'];
            $message = "Invoice Payment Successfull !";
        } else {
            $status_code = HTTP_UNAUTHORIZED;
            $status = $lang['ERROR'];
            $message = "Invoice Already Paid !";
        }
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['PAYMENTID_NOT_FOUND'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message];
    send_json($results);
    die;
}

function get_city_range()
{
    global $lang;
    $range = ['5', '10', '15', '20', '25', '30', '35', '40', '45', '50'];
    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];
    $message = $lang['SUCCESS'];
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'data' => $range];
    send_json($results);
    die;
}

function get_provider_list()
{
    global $lang;
    $providers = [['id' => 1, 'name' => 'provider1', 'email' => 'provider1@gmail.com'], ['id' => 2, 'name' => 'provider2', 'email' => 'provider2@gmail.com'], ['id' => 3, 'name' => 'provider3', 'email' => 'provider3@gmail.com'], ['id' => 4, 'name' => 'provider4', 'email' => 'provider4@gmail.com']];
    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];
    $message = $lang['SUCCESS'];
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'data' => $providers];
    send_json($results);
    die;
}
function set_additional_info()
{
    // Language save data
    global $config, $lang, $status, $status_code, $message, $results;
    $errors = 0;
    $error = [];
    $user_language_data = [];
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];

    $m_langs = json_decode($_REQUEST['language']);
    if (empty($m_langs)) {
        $errors++;
        $error['language'] = $lang['SEL_LANG'];
    }

    $rel = json_decode($_REQUEST['religion']);
    if (empty($rel)) {
        $errors++;
        $error['religion'] = $lang['RELIGIONREQ'];
    }

    $interest = json_decode($_REQUEST['interest']);
    if (empty($interest)) {
        $errors++;
        $error['interest'] = 'Select Interest';
    }

    $backs = json_decode($_REQUEST['background']);

    if (empty($backs)) {
        $errors++;
        $error['background'] = 'Select Cultural Background';
    }

    if ($errors == 0) {
        $user_language_data = user_languages($user_id);

        $m_langs = json_decode($_REQUEST['language']);
        $user_main_lang_ids = array_column($user_language_data, 'id');
        foreach ($user_main_lang_ids as $lang_id) {
            if (!in_array($lang_id, $m_langs)) {
                ORM::for_table($config['db']['pre'] . 'user_languages')
                    ->where(
                        array('user_id' => $user_id, 'language_id' => $lang_id)
                    )
                    ->delete_many();
            }
        }
        foreach ($m_langs as $key => $m_lang) {
            $exist = ORM::for_table($config['db']['pre'] . 'user_languages')->where(['user_id' => $user_id, 'language_id' => $m_lang])->find_one();

            if (!$exist) {
                $u_m_lang = ORM::for_table($config['db']['pre'] . 'user_languages')->create();
                $u_m_lang->user_id = $user_id;
                $u_m_lang->language_id  = $m_lang;
                $u_m_lang->save();
            }
        }

        //religions
        $user_religion_data = [];
        $userReligion = get_religion($user_id);
        $rel = json_decode($_REQUEST['religion']);
        $userReligionIds = array_column($userReligion, 'id');

        foreach ($userReligionIds as $rel_id) {
            if (!in_array($rel_id, $rel)) {
                ORM::for_table($config['db']['pre'] . 'user_religions')
                    ->where(
                        array('user_id' => $user_id, 'religion_id' => $rel_id)
                    )
                    ->delete_many();
            }
        }
        foreach ($rel as $key => $r) {
            $exist = ORM::for_table($config['db']['pre'] . 'user_religions')->where(['user_id' => $user_id, 'religion_id' => $r])->find_one();
            if (!$exist) {
                $u_rel = ORM::for_table($config['db']['pre'] . 'user_religions')->create();
                $u_rel->user_id = $user_id;
                $u_rel->religion_id  = $r;
                $u_rel->save();
            }
        }

        //Intrest
        $user_interest = [];
        $interest = json_decode($_REQUEST['interest']) ?? [];
        $userInterest = ORM::for_table($config['db']['pre'] . 'user_interests')->select('interest_id')->where(['user_id' => $user_id])->where_raw('interest_id != 0')->find_array();
        $userInterestIds = array_column($userInterest, 'interest_id');
        foreach ($userInterestIds as $inte_id) {
            if (!in_array($inte_id, $interest)) {
                $rl = ORM::for_table($config['db']['pre'] . 'user_interests')->where(['user_id' => $user_id, 'interest_id' => $inte_id])->find_one();
                $rl->delete();
            }
        }
        foreach ($interest as $key => $r) {
            $exist = ORM::for_table($config['db']['pre'] . 'user_interests')->where(['user_id' => $user_id, 'interest_id' => $r])->find_one();

            if (!$exist) {
                $u_inte = ORM::for_table($config['db']['pre'] . 'user_interests')->create();
                $u_inte->user_id = $user_id;
                $u_inte->interest_id = $r;
                $u_inte->save();
            }
        }

        //Other interest Section
        $other_interest = (isset($_REQUEST['otherinterest']) && !empty($_REQUEST['otherinterest'])) ? $_REQUEST['otherinterest'] : '';
        $other_interest = json_decode($other_interest, true) ?? [];
        if (!empty($other_interest)) {
            $user_other_data = ORM::for_table($config['db']['pre'] . 'user_interests')->select_many('id', 'user_id', 'interest_id', 'others')->where(['user_id' => $user_id, 'interest_id' => '0'])->find_array();
            $otherIntrest = array_column($user_other_data, 'others');
            foreach ($otherIntrest as $otherId) {
                if (!in_array($otherId, $other_interest)) {
                    $o_interest = ORM::for_table($config['db']['pre'] . 'user_interests')->where(['user_id' => $user_id, 'others' => $otherId])->find_one();
                    $o_interest->delete();
                }
            }
            foreach ($other_interest as  $o_interest) {
                $exist_other = ORM::for_table($config['db']['pre'] . 'user_interests')->where(['user_id' => $user_id, 'others' => $o_interest])->find_one();
                if (!$exist_other) {
                    $u_inte = ORM::for_table($config['db']['pre'] . 'user_interests')->create();
                    $u_inte->user_id = $user_id;
                    $u_inte->interest_id = '0';
                    $u_inte->others = $o_interest;
                    $u_inte->save();
                }
            }
        } else {
            ORM::for_table($config['db']['pre'] . 'user_interests')->where(['user_id' => $user_id])->where_not_null('others')->delete_many();
        }

        //Cultural Background
        $cultural_background = array();
        $backs = json_decode($_REQUEST['background']) ?? [];
        $background_options = json_decode($_REQUEST['back_options']) ?? [];
        $backgrounds = [];
        $backgroundOptions = [];
        foreach ($backs as $main) {
            array_push($backgrounds, '(' . $user_id . ',' . $main . ')');
        }
        $u_c_back = implode(',', $backgrounds);
        foreach ($background_options as $background_option) {
            if (in_array(parent_culture($background_option), $backs)) {
                array_push($backgroundOptions, '(' . $user_id . ',' . parent_culture($background_option) . ',' . $background_option . ')');
            }
        }
        $u_c_backopt = implode(',', $backgroundOptions);
        $userBackg = ORM::for_table($config['db']['pre'] . 'user_cultural_backgrounds')->where('user_id', $user_id)->find_array();
        if (count($userBackg)) {
            ORM::for_table($config['db']['pre'] . 'user_cultural_backgrounds')->where_equal('user_id', $user_id)->delete_many();
        }
        ORM::raw_execute('INSERT INTO ' . $config['db']['pre'] . 'user_cultural_backgrounds (user_id,cultural_background_id) VALUES' . $u_c_back . '');
        ORM::raw_execute('INSERT INTO ' . $config['db']['pre'] . 'user_cultural_backgrounds (user_id,cultural_background_id,cultural_background_option_id) VALUES' . $u_c_backopt . '');

        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = "Updated Successfully !";
        $cultural_background = get_cultural_background($user_id);
        $user_language_data = user_languages($user_id);
        $user_religion_data = get_religion($user_id);
        $user_interest = interest_and_hobbies($user_id);

        $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'cultural_background' => $cultural_background, 'user_languages' => $user_language_data, 'user_religions' => $user_religion_data, 'user_interest' => $user_interest];
        send_json($results);
        die();
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $error;
        $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message];
        send_json($results);
        die();
    }
}

function get_additional_info()
{
    global $lang, $status, $status_code, $message, $results;
    $loggedin = checkIsLoggedin();
    update_lastactive();
    $user_id = $loggedin['user_id'];

    //User Languages get data
    $user_languages = array();
    $only_ids = isset($_REQUEST['only_ids']) ? true : false;
    $user_languages = user_languages($user_id, $only_ids);

    //User Religion get data
    $user_religion_data = [];
    $only_rel_ids = isset($_REQUEST['only_ids']) ? true : false;
    $user_religion_data = get_religion($user_id, $only_rel_ids);

    //User Interest get data 
    $interest_and_hobbies = array();
    $interest_and_hobbies = interest_and_hobbies($user_id);

    //User Cultural-Background get data
    $cultural_background = get_cultural_background_data($user_id);

    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];
    $message = $lang['SUCCESS'];

    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'auth_token' => $loggedin['auth_token'], 'user_languages' => $user_languages, 'user_religions' => $user_religion_data, 'interest_and_hobbies' => $interest_and_hobbies['interest'], 'other_interests' => $interest_and_hobbies['others'], 'cultural_background' => $cultural_background];
    send_json($results);
    die();
}

function get_invoicePaymentListing()
{
    global $config, $lang, $status, $status_code, $message, $results;
    $item = [];
    $errors = [];
    $valid_auth_token  = isAuthTokenValid();
    $bearer_token = getBearerToken();
    if ($bearer_token != null && $valid_auth_token) {
        $user_id = get_device_token($valid_auth_token, 'user_id');
        $user_data = get_user_data(null, $user_id);
        $user_type = $user_data['user_type'];
        if ($user_type == 'employer') {
            $invoice_data = ORM::for_table($config['db']['pre'] . 'invoice')->where('clientid', $user_id)->find_many();
        }
        foreach ($invoice_data as $key => $info) {
            $status_payment = ($info['status'] == "paid") ? "Created" : "Unpaid";
            $item[$key]['id'] = $info['id'];
            $item[$key]['status'] = $status_payment;
            $invoice_workers = explode(',', $info['worker_id']);
            // $invoice_for = [];
            $invoice_for = '';
            foreach ($invoice_workers as $worker) {
                $user_name =  ORM::for_table($config['db']['pre'] . 'user')->select('username')->find_one($worker);
                if (!empty($user_name)) {
                    $invoice_for = $user_name['username'];
                    // $invoice_for[] = ['id' => $worker, 'username' => $user_name['username']];
                }
            }
            // $invoice_name = 'Invoice from ( ' . date("d M Y", strtotime($info['duedate'])) . ' ) to ( ' . date("d M Y", strtotime($info['date'])) . ' )';
            $item[$key]['invoice'] = $info['prefix'] . $info['id'];
            $item[$key]['worker'] = $invoice_for . '(' . $info['total'] . ')';
            $item[$key]['status'] = $info['status'];
            $item[$key]['payment_date'] = date("d/m/Y", strtotime($info['payment_at']));
            // $item[$key]['total_amount'] = $info['total'];
            // $item[$key]['invoice_name'] = $invoice_name;
            $item[$key]['date'] = date("d/m/Y", strtotime($info['datecreated']));
            $item[$key]['duedate'] = date("d/m/Y", strtotime("+30 days", strtotime($info['datecreated'])));
        }
        $status_code = HTTP_OK;
        $status = $lang['SUCCESS'];
        $message = $lang['SUCCESS'];
    } else {
        $status_code = HTTP_UNAUTHORIZED;
        $status = $lang['ERROR'];
        $message = $lang['AUTHTOKENMISMATCH'];
    }
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'errors' => $errors, 'auth_token' => $valid_auth_token, 'items' => $item];
    send_json($results);
    die();
}

function get_timesheet_filter()
{
    global $lang;
    $time_filter_list = ['submitted', 'approved', 'rejected', 'invoiced', 'unpaid', 'paid'];
    $status_code = HTTP_OK;
    $status = $lang['SUCCESS'];
    $message = $lang['SUCCESS'];
    $results = ['status_code' => $status_code, 'status' => $status, 'message' => $message, 'data' => $time_filter_list];
    send_json($results);
    die;
}
