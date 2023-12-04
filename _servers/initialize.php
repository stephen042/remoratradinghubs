<?php

include "services.php";

if (isset($_POST["initialize_registration"])) {
    initialize_registration($_POST);
}

if (isset($_POST["initialize_login"])) {
    initialize_login($_POST);
}

if (isset($_POST["update_account_information"])) {
    update_account_information($_POST);
}

if (isset($_POST["update_account_security"])) {
    update_account_security($_POST);
}

if (isset($_POST["terminate_datasource"])) {
    terminate_datasource($_POST);
}

if (isset($_POST["manually_credit_balance"])) {
    manually_credit_balance($_POST);
}

if (isset($_POST["manually_debit_balance"])) {
    manually_debit_balance($_POST);
}

if (isset($_POST["manually_credit_earnings"])) {
    manually_credit_earnings($_POST);
}

if (isset($_POST["manually_debit_earnings"])) {
    manually_debit_earnings($_POST);
}

if (isset($_POST["send_transaction_token"])) {
    send_transaction_token($_POST);
}

if (isset($_POST["update_wallet_addresses"])) {
    update_wallet_addresses($_POST);
}

if (isset($_POST["initialize_withdrawal"])) {
    initialize_withdrawal($_POST);
}

if (isset($_POST["initialize_deposit"])) {
    initialize_deposit($_POST);
}

if (isset($_POST["cancel_transaction"])) {
    cancel_transaction($_POST);
}

if (isset($_POST["approve_transaction"])) {
    approve_transaction($_POST);
}

if (isset($_POST["initialize_subscription"])) {
    initialize_subscription($_POST);
}

if (isset($_POST["cancel_investment"])) {
    cancel_investment($_POST);
}

if (isset($_POST["complete_investment"])) {
    complete_investment($_POST);
}
