<?php

session_start();
include "db_conn.php";

function initialize_registration($data)
{
    // Check if passwords match
    if ($data["password"] !== $data["confirm_password"]) {
        $_SESSION["feedback"] = "Passwords do not match.";
        return false;
    }

    // Connect to the database
    $db_conn = connect_to_database();

    // Check if email or username already exists
    $stmt = $db_conn->prepare("SELECT * FROM `accounts` WHERE JSON_EXTRACT(`datasource`, '$.email_address') = ? OR JSON_EXTRACT(`datasource`, '$.username') = ?");
    $stmt->bind_param("ss", $data["email_address"], $data["username"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION["feedback"] = "An account with this email or username already exists.";
        return false;
    }

    // Create a new account
    $account_id = bin2hex(random_bytes(32));
    $hashed_password = password_hash($data["password"], PASSWORD_BCRYPT);

    // Prepare the account data
    $datasource = [
        "account_id" => $account_id,
        "account_role" => "Investor",
        "username" => $data["username"],
        "full_names" => $data["full_names"],
        "email_address" => $data["email_address"],
        "phone_number" => $data["phone_number"],
        "country" => $data["country"],
        "password" => $hashed_password,
        "registration_date" => date("jS M Y"),
        "account_balance" => 0,
        "account_earnings" => 0,
        "transaction_token" => "",
        "investment_plan" => "-- / --",
        "amount_invested" => 0,
        "bitcoin_wallet_address" => "",
        "ethereum_wallet_address" => "",
        "tether_wallet_address" => "",
        "dogecoin_wallet_address" => "",
    ];

    // Convert and save datasource as JSON
    $datasource = json_encode($datasource);

    // Store the account data and provide success feedback
    $stmt = $db_conn->prepare("INSERT INTO `accounts`(`datasource`) VALUES (?)");
    $stmt->bind_param("s", $datasource);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "Account creation failed.";
        return false;
    }

    // Clear the feedback message and redirect to authentication page
    $_SESSION["authorized"] = $account_id;
    header("Location: ./");
    return true;
}

function initialize_login($data)
{
    $db_conn = connect_to_database();

    $stmt = $db_conn->prepare("SELECT * FROM `accounts` WHERE JSON_EXTRACT(`datasource`, '$.email_address') = ?");
    $stmt->bind_param("s", $data["email_address"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        $_SESSION["feedback"] = "The provided email address is not registered in our systems.";
        return false;
    }

    $row = $result->fetch_assoc();
    $datasource = json_decode($row["datasource"], true);

    if (!password_verify($data["password"], $datasource["password"])) {
        $_SESSION["feedback"] = "Please enter the correct password and try again.";
        return false;
    }

    $_SESSION["authorized"] = $datasource["account_id"];
    header("Location: ./");
}

function fetch_account_data($data)
{
    $db_conn = connect_to_database();

    $stmt = $db_conn->prepare("SELECT * FROM `accounts` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("s", $data);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result->num_rows > 0) {
        header("Location: ./authx");
    }

    $row = mysqli_fetch_assoc($result);
    $investor_datasource = json_decode($row["datasource"], true);

    $manager_role = "Manager";
    $stmt = $db_conn->prepare("SELECT * FROM `accounts` WHERE JSON_EXTRACT(`datasource`, '$.account_role') = ?");
    $stmt->bind_param("s", $manager_role);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result->num_rows > 0) {
        header("Location: ./authx");
    }

    $row = mysqli_fetch_assoc($result);
    $manager_datasource = json_decode($row["datasource"], true);

    $datasources = [
        "investor_datasource" => $investor_datasource,
        "manager_datasource" => $manager_datasource,
    ];

    return $datasources;
}

function update_account_information($data)
{
    $db_conn = connect_to_database();

    $stmt = $db_conn->prepare("SELECT * FROM `accounts` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("s", $data["account_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $row = mysqli_fetch_assoc($result);
    $datasource = json_decode($row["datasource"], true);

    foreach ($data as $key => $value) {
        if (isset($datasource[$key])) {
            $datasource[$key] = $value;
        }
    }

    $datasource = json_encode($datasource);

    $stmt = $db_conn->prepare("UPDATE `accounts` SET `datasource` = ? WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("ss", $datasource, $data["account_id"]);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $_SESSION["feedback"] = "We're pleased to inform you that your account information has been successfully modified and updated in our system.";
    return true;
}

function update_account_security($data)
{
    $db_conn = connect_to_database();

    if ($data["new_password"] !== $data["confirm_password"]) {
        $_SESSION["feedback"] = "It appears that the passwords you have provided do not match. Please make sure that you have entered the same password in both fields.";
        return false;
    }

    $stmt = $db_conn->prepare("SELECT * FROM `accounts` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("s", $data["account_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $row = mysqli_fetch_assoc($result);
    $datasource = json_decode($row["datasource"], true);

    if (!password_verify($data["current_password"], $datasource["password"])) {
        $_SESSION["feedback"] = "Please input your account's current password in the specified form field.";
        return false;
    }

    $new_password = password_hash($data["new_password"], PASSWORD_BCRYPT);

    $stmt = $db_conn->prepare("UPDATE `accounts` SET `datasource` = JSON_SET(`datasource`, '$.password', ?) WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("ss", $new_password, $data["account_id"]);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $_SESSION["feedback"] = "We're pleased to inform you that your account information has been successfully modified and updated in our system.";
    return true;
}

function terminate_datasource($data)
{
    $db_conn = connect_to_database();

    $stmt = $db_conn->prepare("SELECT * FROM `accounts` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("s", $data["account_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $stmt = $db_conn->prepare("DELETE FROM `activities` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("s", $data["account_id"]);
    $stmt->execute();

    $stmt = $db_conn->prepare("DELETE FROM `contracts` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("s", $data["account_id"]);
    $stmt->execute();

    $stmt = $db_conn->prepare("DELETE FROM `accounts` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("s", $data["account_id"]);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $_SESSION["feedback"] = "The investor's account has been effectively removed, along with all associated account activities.";
    return true;
}

function manually_credit_balance($data)
{
    $db_conn = connect_to_database();

    $stmt = $db_conn->prepare("SELECT * FROM `accounts` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("s", $data["account_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $row = mysqli_fetch_assoc($result);
    $datasource = json_decode($row["datasource"], true);
    $datasource["account_balance"] += $data["amount"];
    $datasource = json_encode($datasource);

    $stmt = $db_conn->prepare("UPDATE `accounts` SET `datasource` = ? WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("ss", $datasource, $data["account_id"]);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $_SESSION["feedback"] = "Investor's account has been successfully updated!";
    return true;
}

function manually_debit_balance($data)
{
    $db_conn = connect_to_database();

    $stmt = $db_conn->prepare("SELECT * FROM `accounts` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("s", $data["account_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $row = mysqli_fetch_assoc($result);
    $datasource = json_decode($row["datasource"], true);
    $datasource["account_balance"] -= $data["amount"];
    $datasource = json_encode($datasource);

    $stmt = $db_conn->prepare("UPDATE `accounts` SET `datasource` = ? WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("ss", $datasource, $data["account_id"]);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $_SESSION["feedback"] = "Investor's account has been successfully updated!";
    return true;
}

function manually_credit_earnings($data)
{
    $db_conn = connect_to_database();

    $stmt = $db_conn->prepare("SELECT * FROM `accounts` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("s", $data["account_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $row = mysqli_fetch_assoc($result);
    $datasource = json_decode($row["datasource"], true);
    $datasource["account_earnings"] += $data["amount"];
    $datasource = json_encode($datasource);

    $stmt = $db_conn->prepare("UPDATE `accounts` SET `datasource` = ? WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("ss", $datasource, $data["account_id"]);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $_SESSION["feedback"] = "Investor's account has been successfully updated!";
    return true;
}

function manually_debit_earnings($data)
{
    $db_conn = connect_to_database();

    $stmt = $db_conn->prepare("SELECT * FROM `accounts` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("s", $data["account_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $row = mysqli_fetch_assoc($result);
    $datasource = json_decode($row["datasource"], true);
    $datasource["account_earnings"] -= $data["amount"];
    $datasource = json_encode($datasource);

    $stmt = $db_conn->prepare("UPDATE `accounts` SET `datasource` = ? WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("ss", $datasource, $data["account_id"]);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $_SESSION["feedback"] = "Investor's account has been successfully updated!";
    return true;
}

function send_transaction_token($data)
{
    $db_conn = connect_to_database();

    $stmt = $db_conn->prepare("SELECT * FROM `accounts` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("s", $data["account_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $row = mysqli_fetch_assoc($result);
    $datasource = json_decode($row['datasource'], true);

    $datasource["transaction_token"] = $data["transaction_token"];
    $datasource = json_encode($datasource);

    $stmt = $db_conn->prepare("UPDATE `accounts` SET `datasource` = ? WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("ss", $datasource, $data["account_id"]);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $_SESSION["feedback"] = "Investor's transaction token has been successfully updated!";
    return true;
}

function update_wallet_addresses($data)
{
    $db_conn = connect_to_database();

    $stmt = $db_conn->prepare("SELECT * FROM `accounts` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("s", $data["account_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $row = mysqli_fetch_assoc($result);
    $datasource = json_decode($row["datasource"], true);

    foreach ($data as $key => $value) {
        if (isset($datasource[$key])) {
            $datasource[$key] = $value;
        }
    }

    $datasource = json_encode($datasource);

    $stmt = $db_conn->prepare("UPDATE `accounts` SET `datasource` = ? WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("ss", $datasource, $data["account_id"]);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $_SESSION["feedback"] = "We're pleased to inform you that your account information has been successfully modified and updated in our system.";
    return true;
}

function initialize_withdrawal($data)
{
    if (empty($data["ewallet"])) {
        $_SESSION["feedback"] = "The selected E-Wallet is missing or empty. Please update wallet addresses and try again!";
        return false;
    }

    $db_conn = connect_to_database();

    $stmt = $db_conn->prepare("SELECT * FROM `accounts` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("s", $data["account_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        $_SESSION["feedback"] = "Unable to find the specified account. Please try again later.";
        return false;
    }

    $row = $result->fetch_assoc();
    $datasource = json_decode($row['datasource'], true);

    if ($data["amount"] > $datasource["account_earnings"]) {
        $_SESSION["feedback"] = "Insufficient funds! Your earnings are not enough for this withdrawal.";
        return false;
    }

    if ($data["transaction_token"] !== $datasource["transaction_token"]) {
        $_SESSION["feedback"] = "Invalid transaction token. Please verify and try again.";
        return false;
    }

    $transaction_data = [
        "transaction_id" => bin2hex(random_bytes(32)),
        "account_id" => $datasource["account_id"],
        "transaction_date" => date("jS M Y"),
        "transaction_status" => "Pending",
        "amount" => $data["amount"],
        "category" => "Debit TXN",
        "proof_img" => "-- / --",
        "ewallet" => ""
    ];

    $valid_media = [
        $datasource["bitcoin_wallet_address"] => "Bitcoin [BTC]",
        $datasource["ethereum_wallet_address"] => "Ethereum [ETH]",
        $datasource["tether_wallet_address"] => "Tether [USDT]",
        $datasource["dogecoin_wallet_address"] => "Dogecoin [DOGE]"
    ];

    if (!isset($valid_media[$data["ewallet"]])) {
        $_SESSION["feedback"] = "Invalid payment ewallet selected.";
        return false;
    }

    $transaction_data["ewallet"] = $valid_media[$data["ewallet"]];
    $encoded_transaction_data = json_encode($transaction_data);

    $stmt = $db_conn->prepare("INSERT INTO `activities`(`datasource`) VALUES (?)");
    $stmt->bind_param("s", $encoded_transaction_data);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "Failed to initiate the withdrawal. Please try again later.";
        return false;
    }

    $datasource["account_earnings"] -= $data["amount"];
    $datasource["transaction_token"] = "";
    $encoded_datasource = json_encode($datasource);

    $stmt = $db_conn->prepare("UPDATE `accounts` SET `datasource` = ? WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("ss", $encoded_datasource, $data["account_id"]);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "Failed to update account data. Please try again later.";
        return false;
    }

    $_SESSION["feedback"] = "Your withdrawal request has been successfully initiated and is currently under review. Your funds will be arriving in your wallet shortly.";
    return false;
}

function initialize_deposit($data)
{
    if (empty($data["ewallet"])) {
        $_SESSION["feedback"] = "The selected payment medium is currently unavailable!";
        return false;
    }

    $file_path = "../_servers/proof_of_pay/";
    $payment_proof_size_limit = 10 * 1024 * 1024;
    $payment_proof = $_FILES["payment_proof"];

    if ($payment_proof["size"] > $payment_proof_size_limit) {
        $_SESSION["feedback"] = "The uploaded file exceeds the size limit of 10 MB. Please choose a smaller file.";
        return false;
    }

    $db_conn = connect_to_database();

    $stmt = $db_conn->prepare("SELECT * FROM `accounts` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("s", $data["account_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        $_SESSION["feedback"] = "Unable to find the specified account. Please try again later.";
        return false;
    }

    $row = $result->fetch_assoc();
    $datasource = json_decode($row['datasource'], true);

    $transaction_data = [
        "transaction_id" => bin2hex(random_bytes(32)),
        "account_id" => $datasource["account_id"],
        "transaction_date" => date("jS M Y"),
        "transaction_status" => "Pending",
        "amount" => $data["amount"],
        "category" => "Credit TXN",
        "proof_img" => "-- / --",
        "ewallet" => $data["ewallet"]
    ];

    $transaction_data["proof_img"] = bin2hex(random_bytes(32)) . "." . pathinfo($payment_proof["name"], PATHINFO_EXTENSION);

    if (!move_uploaded_file($payment_proof["tmp_name"], $file_path . $transaction_data["proof_img"])) {
        $_SESSION["feedback"] = "We're currently unable to process your request. We kindly request that you try again at a later time.";
        return false;
    }

    $encoded_transaction_data = json_encode($transaction_data);

    $stmt = $db_conn->prepare("INSERT INTO `activities`(`datasource`) VALUES (?)");
    $stmt->bind_param("s", $encoded_transaction_data);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "Failed to initiate account funding. Please try again later.";
        return false;
    }

    $_SESSION["feedback"] = "Your deposit request has been successfully initiated and is currently under review. Your funds will be arriving in your account balance shortly.";
    return false;
}

function cancel_transaction($data)
{
    $db_conn = connect_to_database();

    $stmt = $db_conn->prepare("SELECT * FROM `activities` WHERE JSON_EXTRACT(`datasource`, '$.transaction_id') = ? AND JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("ss", $data["transaction_id"], $data["account_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    if ($data["category"] == "Debit TXN") {
        $data["account_earnings"] += $data["amount"];

        $stmt = $db_conn->prepare("UPDATE `accounts` SET `datasource` = JSON_SET(`datasource`, '$.account_earnings', ?) WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
        $stmt->bind_param("ss", $data["account_earnings"], $data["account_id"]);
        $stmt->execute();

        if ($stmt->affected_rows <= 0) {
            $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
            return false;
        }
    }

    $transaction_status = "Cancelled";

    $stmt = $db_conn->prepare("UPDATE `activities` SET `datasource` = JSON_SET(`datasource`, '$.transaction_status', ?) WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ? AND JSON_EXTRACT(`datasource`, '$.transaction_id') = ?");
    $stmt->bind_param("sss", $transaction_status, $data["account_id"],  $data["transaction_id"]);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $_SESSION["feedback"] = "Investor's account has been successfully updated!";
    return true;
}

function approve_transaction($data)
{
    $db_conn = connect_to_database();

    $stmt = $db_conn->prepare("SELECT * FROM `activities` WHERE JSON_EXTRACT(`datasource`, '$.transaction_id') = ? AND JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("ss", $data["transaction_id"], $data["account_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    if ($data["category"] == "Credit TXN") {
        $data["account_balance"] += $data["amount"];

        $stmt = $db_conn->prepare("UPDATE `accounts` SET `datasource` = JSON_SET(`datasource`, '$.account_balance', ?) WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
        $stmt->bind_param("ss", $data["account_balance"], $data["account_id"]);
        $stmt->execute();

        if ($stmt->affected_rows <= 0) {
            $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
            return false;
        }
    }

    $transaction_status = "Completed";

    $stmt = $db_conn->prepare("UPDATE `activities` SET `datasource` = JSON_SET(`datasource`, '$.transaction_status', ?) WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ? AND JSON_EXTRACT(`datasource`, '$.transaction_id') = ?");
    $stmt->bind_param("sss", $transaction_status, $data["account_id"],  $data["transaction_id"]);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $_SESSION["feedback"] = "Investor's account has been successfully updated!";
    return true;
}

function initialize_subscription($data)
{
    $db_conn = connect_to_database();

    $active = "Active";

    $stmt = $db_conn->prepare("SELECT * FROM `contracts` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ? AND JSON_EXTRACT(`datasource`, '$.investment_status') = ?");
    $stmt->bind_param("ss", $data["account_id"], $active);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION["feedback"] = "You currently have an active subscription! Try again after current subscription is expired.";
        return false;
    }

    $stmt = $db_conn->prepare("SELECT * FROM `accounts` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("s", $data["account_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        $_SESSION["feedback"] = "Unable to find the specified account. Please try again later.";
        return false;
    }

    $row = $result->fetch_assoc();
    $datasource = json_decode($row['datasource'], true);

    if ($data["amount"] > $datasource["account_balance"]) {
        $_SESSION["feedback"] = "Insufficient funds! Your account balance is too low for this investment.";
        return false;
    }

    $investment_data = [
        "investment_id" => bin2hex(random_bytes(32)),
        "investment_plan" => $data["investment_plan"],
        "account_id" => $datasource["account_id"],
        "duration" => $data["duration"],
        "amount" => $data["amount"],
        "plan_roi" => $data["plan_roi"],
        "investment_status" => "Active",
        "investment_date" => date("jS M Y"),
    ];

    $encoded_investment_data = json_encode($investment_data);

    $stmt = $db_conn->prepare("INSERT INTO `contracts`(`datasource`) VALUES (?)");
    $stmt->bind_param("s", $encoded_investment_data);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "Failed to initiate account funding. Please try again later.";
        return false;
    }

    $datasource["account_balance"] -= $data["amount"];
    $datasource["amount_invested"] += $data["amount"];
    $datasource["investment_plan"] = $data["investment_plan"];
    $encoded_datasource = json_encode($datasource);

    $stmt = $db_conn->prepare("UPDATE `accounts` SET `datasource` = ? WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("ss", $encoded_datasource, $data["account_id"]);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "Failed to update account data. Please try again later.";
        return false;
    }

    $_SESSION["feedback"] = "Your investment has been successfully initiated and is currently active. Please note that this plan will expire after 7 days!";
    return false;
}

function cancel_investment($data)
{
    $db_conn = connect_to_database();

    $stmt = $db_conn->prepare("SELECT * FROM `contracts` WHERE JSON_EXTRACT(`datasource`, '$.investment_id') = ? AND JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("ss", $data["investment_id"], $data["account_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $stmt = $db_conn->prepare("SELECT * FROM `accounts` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("s", $data["account_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        $_SESSION["feedback"] = "Unable to find the specified account. Please try again later.";
        return false;
    }

    $row = $result->fetch_assoc();
    $datasource = json_decode($row['datasource'], true);

    $datasource["account_balance"] += $data["amount"];
    $datasource["amount_invested"] = 0;
    $datasource["investment_plan"] = "-- / --";
    $encoded_datasource = json_encode($datasource);

    $stmt = $db_conn->prepare("UPDATE `accounts` SET `datasource` = ? WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("ss", $encoded_datasource, $data["account_id"]);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "Failed to update account data. Please try again later.";
        return false;
    }

    $investment_status = "Cancelled";

    $stmt = $db_conn->prepare("UPDATE `contracts` SET `datasource` = JSON_SET(`datasource`, '$.investment_status', ?) WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ? AND JSON_EXTRACT(`datasource`, '$.investment_id') = ?");
    $stmt->bind_param("sss", $investment_status, $data["account_id"],  $data["investment_id"]);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $_SESSION["feedback"] = "Investor's account has been successfully updated!";
    return true;
}

function complete_investment($data)
{
    $db_conn = connect_to_database();

    $stmt = $db_conn->prepare("SELECT * FROM `contracts` WHERE JSON_EXTRACT(`datasource`, '$.investment_id') = ? AND JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("ss", $data["investment_id"], $data["account_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $stmt = $db_conn->prepare("SELECT * FROM `accounts` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("s", $data["account_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        $_SESSION["feedback"] = "Unable to find the specified account. Please try again later.";
        return false;
    }

    $row = $result->fetch_assoc();
    $datasource = json_decode($row['datasource'], true);

    $datasource["amount_invested"] = 0;
    $datasource["investment_plan"] = "-- / --";
    $encoded_datasource = json_encode($datasource);

    $stmt = $db_conn->prepare("UPDATE `accounts` SET `datasource` = ? WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("ss", $encoded_datasource, $data["account_id"]);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "Failed to update account data. Please try again later.";
        return false;
    }

    $investment_status = "Completed";

    $stmt = $db_conn->prepare("UPDATE `contracts` SET `datasource` = JSON_SET(`datasource`, '$.investment_status', ?) WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ? AND JSON_EXTRACT(`datasource`, '$.investment_id') = ?");
    $stmt->bind_param("sss", $investment_status, $data["account_id"],  $data["investment_id"]);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "We're currently unable to process your request. Please try again later.";
        return false;
    }

    $_SESSION["feedback"] = "Investor's account has been successfully updated!";
    return true;
}

// ================================================================================
// trading services and functions

function Trade($data)
{
    $db_conn = connect_to_database();

    $stmt = $db_conn->prepare("SELECT * FROM `accounts` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("s", $data["account_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        $_SESSION["feedback"] = "Unable to find the specified account. Please try again later.";
        return false;
    }

    $row = $result->fetch_assoc();
    $datasource = json_decode($row['datasource'], true);

    if ($datasource["account_balance"] < $data["amount"]) {
        $_SESSION["feedback"] = "Insufficient funds to innitiate Trade.";
        return false;
    }


    $profitLoss = 0;
    // 1 = "Trade on", 2 = "completed"
    $status = 1;
    // 1 = "pending", 2 = "win", 3 = "loss"
    $winLoss = 1;

    $datasource["account_balance"] = $datasource["account_balance"] - $data["amount"];

    $stmt = $db_conn->prepare("INSERT INTO `trades`                     (`userEmail`,`stakeAmt`,`type`,`asset`,`duration`,`market`,`profitLoss`,`status`,`winLoss`) VALUES (?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sissssiii",
        $datasource["email_address"],
        $data["amount"],
        $data["type"],
        $data["asset"],
        $data["duration"],
        $data["market"],
        $profitLoss,
        $status,
        $winLoss,
    );
    $stmt->execute();

    $datasourceEncoded = json_encode($datasource);
    $stmt = $db_conn->prepare("UPDATE `accounts` SET `datasource` = ? WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("ss", $datasourceEncoded , $data["account_id"]);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "Failed to initiate Trade funding. Please try again later.";
        return false;
    }else{
        $_SESSION["feedback"] = "Trade has been successfully initiated!";
        return true;
    }
}

function editTrade($data)  {
    
    $db_conn = connect_to_database();

    $stmt = $db_conn->prepare("SELECT * FROM `accounts` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("s", $data["account_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        $_SESSION["feedback"] = "Unable to find the specified account. Please try again later.";
        return false;
    }

    // echo '<script>window.alert("editTrade")</script>';

    $row = $result->fetch_assoc();
    $datasource = json_decode($row['datasource'], true);

    if ($data["winLoss"] == 1) {
        $_SESSION["feedback"] = "Please choose if trade is win or Loss";
        return false;
    }elseif ($data["winLoss"] == 2 || $data["winLoss"] == 3) {
        $status = 2;
    }

    if ($data['winLoss'] == 2) {
        $datasource["account_earnings"] = $datasource["account_earnings"] + $data["profitLoss"];
    } elseif ($data['winLoss'] == 3) {
        $data["profitLoss"] = 0;
        $datasource["account_earnings"] = $datasource["account_earnings"] + $data["profitLoss"];
    }

    $datasourceEncoded = json_encode($datasource);
    
    $stmt = $db_conn->prepare("UPDATE `accounts` SET `datasource` = ? WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
    $stmt->bind_param("ss", $datasourceEncoded , $data["account_id"]);
    $stmt->execute();

    $stmt = $db_conn->prepare("UPDATE `trades` SET `status` = ? , `winLoss` = ?, `profitLoss` = ? WHERE id = ?");
    $stmt->bind_param("iisi", $status, $data["winLoss"], $data["profitLoss"], $data["trade_id"]);
    $stmt->execute();
    
    if ($stmt->affected_rows <= 0) {
        $_SESSION["feedback"] = "Failed to initiate Your Request. Please try again later.";
        return false;
    }else{
        $_SESSION["feedback"] = "Request has been successfully initiated!";
        return true;
    }

}