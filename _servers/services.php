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

  if ($_SESSION["authorized"]) {
    $message = '';
    $fname = $datasource['full_names'];
    $email = $datasource['email_address'];

    // Send mail to user with verification here
    $to = $email;
    $subject = "SUCCESSFUL LOGIN NOTIFICATION";

    // Create the body message
    $message .= '<!DOCTYPE html>
        <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width,initial-scale=1">
          <meta name="x-apple-disable-message-reformatting">
          <title></title>
          <!--[if mso]>
          <noscript>
            <xml>
              <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
              </o:OfficeDocumentSettings>
            </xml>
          </noscript>
          <![endif]-->
          <style>
            table, td, div, h1, p {font-family: Arial, sans-serif;}
            button{
                font: inherit;
                background-color: #FF7A59;
                border: none;
                padding: 10px;
                text-transform: uppercase;
                letter-spacing: 2px;
                font-weight: 700; 
                color: white;
                border-radius: 5px; 
                box-shadow: 1px 2px #d94c53;
              }
          </style>
        </head>
        <body style="margin:0;padding:0;">
          <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
            <tr>
              <td align="center" style="padding:0;">
                <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                  <tr>
                        <td align="center" style="padding:20px 0 20px 0;background:#70bbd9; font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;font-size: 20px;margin: 10px;">
                            <h1 style="margin:24px">Remoratradinghubs</h1> 
                        </td>
                  </tr>
                  <tr style="background-color: #eeeeee;">
                    <td style="padding:36px 30px 42px 30px;">
                      <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                        <tr>
                          <td style="padding:0 0 36px 0;color:#153643;">
                            <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Dear ' . $fname . ' , </h1>
                            <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                              You have successfully logged in to your Remoratradinghubs account on : ' . date('Y-m-d h:i A') . '.
                            </p>
                            <br>
                            <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                            If you did not initiate this log in, please contact us immediately through Live chat or email support teams.
                              
                            </p>
                            <p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                <a href="mailto:support@remoratradinghubs.com" style="color:#ee4c50;text-decoration:underline;"> 
                                    <button> 
                                        Click to mail support
                                    </button>  
                                </a>
                            </p>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td style="padding:30px;background:#ee4c50;">
                      <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                        <tr>
                          <td style="padding:0;width:50%;" align="left">
                            <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                              &reg; 2024 copyright remoratradinghubs<br/><a href="https://remoratradinghubs.com" style="color:#ffffff;text-decoration:underline;">visit site</a>
                            </p>
                          </td>
                          <td style="padding:0;width:50%;" align="right">
                            <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
                              <tr>
                                <td style="padding:0 0 0 10px;width:38px;">
                                  <a href="http://www.twitter.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/tw_1.png" alt="Twitter" width="38" style="height:auto;display:block;border:0;" /></a>
                                </td>
                                <td style="padding:0 0 0 10px;width:38px;">
                                  <a href="http://www.facebook.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/fb_1.png" alt="Facebook" width="38" style="height:auto;display:block;border:0;" /></a>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </body>
        </html>';
    $header = "From:Remoratradinghubs <support@remoratradinghubs.com> \r\n";
    $header .= "Cc:@remoratradinghubs.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    @$retval = mail($to, $subject, $message, $header);
  }
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
  if ($_SESSION["feedback"]) {

    // mail function
    $message = '';
    $fname = $datasource['full_names'];
    $email = $datasource['email_address'];

    // Send mail to user with verification here
    $to = $email;
    $subject = "WITHDRAWAL NOTIFICATION";

    // Create the body message
    $message .= '<!DOCTYPE html>
                <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                  <meta charset="UTF-8">
                  <meta name="viewport" content="width=device-width,initial-scale=1">
                  <meta name="x-apple-disable-message-reformatting">
                  <title></title>
                  <!--[if mso]>
                  <noscript>
                    <xml>
                      <o:OfficeDocumentSettings>
                        <o:PixelsPerInch>96</o:PixelsPerInch>
                      </o:OfficeDocumentSettings>
                    </xml>
                  </noscript>
                  <![endif]-->
                  <style>
                    table, td, div, h1, p {font-family: Arial, sans-serif;}
                    button{
                        font: inherit;
                        background-color: #FF7A59;
                        border: none;
                        padding: 10px;
                        text-transform: uppercase;
                        letter-spacing: 2px;
                        font-weight: 700; 
                        color: white;
                        border-radius: 5px; 
                        box-shadow: 1px 2px #d94c53;
                      }
                  </style>
                </head>
                <body style="margin:0;padding:0;">
                  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
                    <tr>
                      <td align="center" style="padding:0;">
                        <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                          <tr>
                                <td align="center" style="padding:20px 0 20px 0;background:#70bbd9; font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;font-size: 20px;margin: 10px;">
                                    <h1 style="margin:24px">Remoratradinghubs</h1> 
                                </td>
                          </tr>
                          <tr style="background-color: #eeeeee;">
                            <td style="padding:36px 30px 42px 30px;">
                              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                  <td style="padding:0 0 36px 0;color:#153643;">
                                    <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Dear ' . $fname . ' , </h1>
                                    <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                      Your Withdrawal Request of ' . $data["amount"] . ' has been submitted, your account will be credited once it is confirmed .
                                    </p>
                                    <br>
                                    <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                    <br>
                                    <i><b>Thanks for choosing us</b></i> 
                                    </p>
                                    <p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                        <a href="https://remoratradinghubs.com/account" style="color:#ee4c50;text-decoration:underline;"> 
                                            <button> 
                                                Click to Login
                                            </button>  
                                        </a>
                                    </p>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding:30px;background:#ee4c50;">
                              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                                <tr>
                                  <td style="padding:0;width:50%;" align="left">
                                    <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                                      &reg; 2024 copyright remoratradinghubs<br/><a href="https://remoratradinghubs.com" style="color:#ffffff;text-decoration:underline;">visit site</a>
                                    </p>
                                  </td>
                                  <td style="padding:0;width:50%;" align="right">
                                    <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
                                      <tr>
                                        <td style="padding:0 0 0 10px;width:38px;">
                                          <a href="http://www.twitter.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/tw_1.png" alt="Twitter" width="38" style="height:auto;display:block;border:0;" /></a>
                                        </td>
                                        <td style="padding:0 0 0 10px;width:38px;">
                                          <a href="http://www.facebook.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/fb_1.png" alt="Facebook" width="38" style="height:auto;display:block;border:0;" /></a>
                                        </td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </body>
                </html>';
    $header = "From:Remoratradinghubs <support@remoratradinghubs.com> \r\n";
    $header .= "Cc:@remoratradinghubs.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    @$retval = mail($to, $subject, $message, $header);
  }
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

  if ($_SESSION["feedback"]) {

    // mail function
    $message = '';
    $fname = $datasource['full_names'];
    $email = $datasource['email_address'];

    // Send mail to user with verification here
    $to = $email;
    $subject = "DEPOSIT NOTIFICATION";

    // Create the body message
    $message .= '<!DOCTYPE html>
                <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                  <meta charset="UTF-8">
                  <meta name="viewport" content="width=device-width,initial-scale=1">
                  <meta name="x-apple-disable-message-reformatting">
                  <title></title>
                  <!--[if mso]>
                  <noscript>
                    <xml>
                      <o:OfficeDocumentSettings>
                        <o:PixelsPerInch>96</o:PixelsPerInch>
                      </o:OfficeDocumentSettings>
                    </xml>
                  </noscript>
                  <![endif]-->
                  <style>
                    table, td, div, h1, p {font-family: Arial, sans-serif;}
                    button{
                        font: inherit;
                        background-color: #FF7A59;
                        border: none;
                        padding: 10px;
                        text-transform: uppercase;
                        letter-spacing: 2px;
                        font-weight: 700; 
                        color: white;
                        border-radius: 5px; 
                        box-shadow: 1px 2px #d94c53;
                      }
                  </style>
                </head>
                <body style="margin:0;padding:0;">
                  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
                    <tr>
                      <td align="center" style="padding:0;">
                        <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                          <tr>
                                <td align="center" style="padding:20px 0 20px 0;background:#70bbd9; font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;font-size: 20px;margin: 10px;">
                                    <h1 style="margin:24px">Remoratradinghubs</h1> 
                                </td>
                          </tr>
                          <tr style="background-color: #eeeeee;">
                            <td style="padding:36px 30px 42px 30px;">
                              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                  <td style="padding:0 0 36px 0;color:#153643;">
                                    <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Dear ' . $fname . ' , </h1>
                                    <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                      Your Deposit of $' . $data["amount"] . ' has been submitted, your account will be credited once it is confirmed .
                                    </p>
                                    <br>
                                    <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                    <br>
                                    <i><b>Thanks for choosing us</b></i> 
                                    </p>
                                    <p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                        <a href="https://remoratradinghubs.com/account" style="color:#ee4c50;text-decoration:underline;"> 
                                            <button> 
                                                Click to Login
                                            </button>  
                                        </a>
                                    </p>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding:30px;background:#ee4c50;">
                              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                                <tr>
                                  <td style="padding:0;width:50%;" align="left">
                                    <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                                      &reg; 2024 copyright remoratradinghubs<br/><a href="https://remoratradinghubs.com" style="color:#ffffff;text-decoration:underline;">visit site</a>
                                    </p>
                                  </td>
                                  <td style="padding:0;width:50%;" align="right">
                                    <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
                                      <tr>
                                        <td style="padding:0 0 0 10px;width:38px;">
                                          <a href="http://www.twitter.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/tw_1.png" alt="Twitter" width="38" style="height:auto;display:block;border:0;" /></a>
                                        </td>
                                        <td style="padding:0 0 0 10px;width:38px;">
                                          <a href="http://www.facebook.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/fb_1.png" alt="Facebook" width="38" style="height:auto;display:block;border:0;" /></a>
                                        </td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </body>
                </html>';
    $header = "From:Remoratradinghubs <support@remoratradinghubs.com> \r\n";
    $header .= "Cc:@remoratradinghubs.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    @$retval = mail($to, $subject, $message, $header);
  }

  return false;
}

function cancel_transaction($data)
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

  if ($_SESSION["feedback"]) {

    // mail function
    $message = '';
    $fname = $datasource['full_names'];
    $email = $datasource['email_address'];

    // Send mail to user with verification here
    $to = $email;
    $subject = "DEPOSIT NOTIFICATION";

    // Create the body message
    $message .= '<!DOCTYPE html>
                <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                  <meta charset="UTF-8">
                  <meta name="viewport" content="width=device-width,initial-scale=1">
                  <meta name="x-apple-disable-message-reformatting">
                  <title></title>
                  <!--[if mso]>
                  <noscript>
                    <xml>
                      <o:OfficeDocumentSettings>
                        <o:PixelsPerInch>96</o:PixelsPerInch>
                      </o:OfficeDocumentSettings>
                    </xml>
                  </noscript>
                  <![endif]-->
                  <style>
                    table, td, div, h1, p {font-family: Arial, sans-serif;}
                    button{
                        font: inherit;
                        background-color: #FF7A59;
                        border: none;
                        padding: 10px;
                        text-transform: uppercase;
                        letter-spacing: 2px;
                        font-weight: 700; 
                        color: white;
                        border-radius: 5px; 
                        box-shadow: 1px 2px #d94c53;
                      }
                  </style>
                </head>
                <body style="margin:0;padding:0;">
                  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
                    <tr>
                      <td align="center" style="padding:0;">
                        <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                          <tr>
                                <td align="center" style="padding:20px 0 20px 0;background:#70bbd9; font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;font-size: 20px;margin: 10px;">
                                    <h1 style="margin:24px">Remoratradinghubs</h1> 
                                </td>
                          </tr>
                          <tr style="background-color: #eeeeee;">
                            <td style="padding:36px 30px 42px 30px;">
                              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                  <td style="padding:0 0 36px 0;color:#153643;">
                                    <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Dear ' . $fname . ' , </h1>
                                    <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                      Your Deposit of $' . $data["amount"] . ' has been Cancelled. Your account will not be credited. 
                                      <br>
                                      Contact Us for more information. 
                                    </p>
                                    <br>
                                    <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                    <br>
                                    <i><b>Thanks for choosing us</b></i> 
                                    </p>
                                    <p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                        <a href="https://remoratradinghubs.com/account" style="color:#ee4c50;text-decoration:underline;"> 
                                            <button> 
                                                Click to Login
                                            </button>  
                                        </a>
                                    </p>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding:30px;background:#ee4c50;">
                              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                                <tr>
                                  <td style="padding:0;width:50%;" align="left">
                                    <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                                      &reg; 2024 copyright remoratradinghubs<br/><a href="https://remoratradinghubs.com" style="color:#ffffff;text-decoration:underline;">visit site</a>
                                    </p>
                                  </td>
                                  <td style="padding:0;width:50%;" align="right">
                                    <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
                                      <tr>
                                        <td style="padding:0 0 0 10px;width:38px;">
                                          <a href="http://www.twitter.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/tw_1.png" alt="Twitter" width="38" style="height:auto;display:block;border:0;" /></a>
                                        </td>
                                        <td style="padding:0 0 0 10px;width:38px;">
                                          <a href="http://www.facebook.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/fb_1.png" alt="Facebook" width="38" style="height:auto;display:block;border:0;" /></a>
                                        </td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </body>
                </html>';
    $header = "From:Remoratradinghubs <support@remoratradinghubs.com> \r\n";
    $header .= "Cc:@remoratradinghubs.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    @$retval = mail($to, $subject, $message, $header);
  }
  return true;
}

function approve_transaction($data)
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

  if ($_SESSION["feedback"]) {

    // mail function
    $message = '';
    $fname = $datasource['full_names'];
    $email = $datasource['email_address'];

    // Send mail to user with verification here
    $to = $email;
    $subject = "DEPOSIT NOTIFICATION";

    // Create the body message
    $message .= '<!DOCTYPE html>
                <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                  <meta charset="UTF-8">
                  <meta name="viewport" content="width=device-width,initial-scale=1">
                  <meta name="x-apple-disable-message-reformatting">
                  <title></title>
                  <!--[if mso]>
                  <noscript>
                    <xml>
                      <o:OfficeDocumentSettings>
                        <o:PixelsPerInch>96</o:PixelsPerInch>
                      </o:OfficeDocumentSettings>
                    </xml>
                  </noscript>
                  <![endif]-->
                  <style>
                    table, td, div, h1, p {font-family: Arial, sans-serif;}
                    button{
                        font: inherit;
                        background-color: #FF7A59;
                        border: none;
                        padding: 10px;
                        text-transform: uppercase;
                        letter-spacing: 2px;
                        font-weight: 700; 
                        color: white;
                        border-radius: 5px; 
                        box-shadow: 1px 2px #d94c53;
                      }
                  </style>
                </head>
                <body style="margin:0;padding:0;">
                  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
                    <tr>
                      <td align="center" style="padding:0;">
                        <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                          <tr>
                                <td align="center" style="padding:20px 0 20px 0;background:#70bbd9; font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;font-size: 20px;margin: 10px;">
                                    <h1 style="margin:24px">Remoratradinghubs</h1> 
                                </td>
                          </tr>
                          <tr style="background-color: #eeeeee;">
                            <td style="padding:36px 30px 42px 30px;">
                              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                  <td style="padding:0 0 36px 0;color:#153643;">
                                    <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Dear ' . $fname . ' , </h1>
                                    <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                      Your Deposit of $' . $data["amount"] . ' has been approved, your account will be credited shortly.
                                    </p>
                                    <br>
                                    <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                    <br>
                                    <i><b>Thanks for choosing us</b></i> 
                                    </p>
                                    <p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                        <a href="https://remoratradinghubs.com/account" style="color:#ee4c50;text-decoration:underline;"> 
                                            <button> 
                                                Click to Login
                                            </button>  
                                        </a>
                                    </p>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding:30px;background:#ee4c50;">
                              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                                <tr>
                                  <td style="padding:0;width:50%;" align="left">
                                    <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                                      &reg; 2024 copyright remoratradinghubs<br/><a href="https://remoratradinghubs.com" style="color:#ffffff;text-decoration:underline;">visit site</a>
                                    </p>
                                  </td>
                                  <td style="padding:0;width:50%;" align="right">
                                    <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
                                      <tr>
                                        <td style="padding:0 0 0 10px;width:38px;">
                                          <a href="http://www.twitter.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/tw_1.png" alt="Twitter" width="38" style="height:auto;display:block;border:0;" /></a>
                                        </td>
                                        <td style="padding:0 0 0 10px;width:38px;">
                                          <a href="http://www.facebook.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/fb_1.png" alt="Facebook" width="38" style="height:auto;display:block;border:0;" /></a>
                                        </td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </body>
                </html>';
    $header = "From:Remoratradinghubs <support@remoratradinghubs.com> \r\n";
    $header .= "Cc:@remoratradinghubs.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    @$retval = mail($to, $subject, $message, $header);
  }
  return true;
}

function initialize_subscription($data)
{

  if ($data['min'] > $data['amount']) {
    $_SESSION["feedback"] = "Insufficient Amount! Minimum is $" . $data['min'] . " ";
    return false;
  } elseif ($data['amount'] > $data['max']) {
    $_SESSION["feedback"] = "Max is $" . $data['max'] . " Try a higher Plan ";
    return false;
  }

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

  if ($_SESSION["feedback"]) {

    // mail function
    $message = '';
    $fname = $datasource['full_names'];
    $email = $datasource['email_address'];

    // Send mail to user with verification here
    $to = $email;
    $subject = "SUBSCRIPTION NOTIFICATION";

    // Create the body message
    $message .= '<!DOCTYPE html>
                <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                <head>
                  <meta charset="UTF-8">
                  <meta name="viewport" content="width=device-width,initial-scale=1">
                  <meta name="x-apple-disable-message-reformatting">
                  <title></title>
                  <!--[if mso]>
                  <noscript>
                    <xml>
                      <o:OfficeDocumentSettings>
                        <o:PixelsPerInch>96</o:PixelsPerInch>
                      </o:OfficeDocumentSettings>
                    </xml>
                  </noscript>
                  <![endif]-->
                  <style>
                    table, td, div, h1, p {font-family: Arial, sans-serif;}
                    button{
                        font: inherit;
                        background-color: #FF7A59;
                        border: none;
                        padding: 10px;
                        text-transform: uppercase;
                        letter-spacing: 2px;
                        font-weight: 700; 
                        color: white;
                        border-radius: 5px; 
                        box-shadow: 1px 2px #d94c53;
                      }
                  </style>
                </head>
                <body style="margin:0;padding:0;">
                  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
                    <tr>
                      <td align="center" style="padding:0;">
                        <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                          <tr>
                                <td align="center" style="padding:20px 0 20px 0;background:#70bbd9; font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;font-size: 20px;margin: 10px;">
                                    <h1 style="margin:24px">Remoratradinghubs</h1> 
                                </td>
                          </tr>
                          <tr style="background-color: #eeeeee;">
                            <td style="padding:36px 30px 42px 30px;">
                              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                  <td style="padding:0 0 36px 0;color:#153643;">
                                    <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Dear ' . $fname . ' , </h1>
                                    <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                      Your subscription on ' . $data["investment_plan"] . ' of 
                                       $' . $data['amount'] . ' has been purchased successfully.
                                    </p>
                                    <br>
                                    <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                    <br>
                                    <i><b>Thanks for choosing us</b></i> 
                                    </p>
                                    <p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                        <a href="https://remoratradinghubs.com/account" style="color:#ee4c50;text-decoration:underline;"> 
                                            <button> 
                                                Click to Login
                                            </button>  
                                        </a>
                                    </p>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding:30px;background:#ee4c50;">
                              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                                <tr>
                                  <td style="padding:0;width:50%;" align="left">
                                    <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                                      &reg; 2024 copyright remoratradinghubs<br/><a href="https://remoratradinghubs.com" style="color:#ffffff;text-decoration:underline;">visit site</a>
                                    </p>
                                  </td>
                                  <td style="padding:0;width:50%;" align="right">
                                    <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
                                      <tr>
                                        <td style="padding:0 0 0 10px;width:38px;">
                                          <a href="http://www.twitter.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/tw_1.png" alt="Twitter" width="38" style="height:auto;display:block;border:0;" /></a>
                                        </td>
                                        <td style="padding:0 0 0 10px;width:38px;">
                                          <a href="http://www.facebook.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/fb_1.png" alt="Facebook" width="38" style="height:auto;display:block;border:0;" /></a>
                                        </td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </body>
                </html>';
    $header = "From:Remoratradinghubs <support@remoratradinghubs.com> \r\n";
    $header .= "Cc:@remoratradinghubs.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    @$retval = mail($to, $subject, $message, $header);
  }
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

  if ($_SESSION["feedback"]) {

    // mail function
    $message = '';
    $fname = $datasource['full_names'];
    $email = $datasource['email_address'];

    // Send mail to user with verification here
    $to = $email;
    $subject = "SUBSCRIPTION NOTIFICATION";

    // Create the body message
    $message .= '<!DOCTYPE html>
              <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
              <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width,initial-scale=1">
                <meta name="x-apple-disable-message-reformatting">
                <title></title>
                <!--[if mso]>
                <noscript>
                  <xml>
                    <o:OfficeDocumentSettings>
                      <o:PixelsPerInch>96</o:PixelsPerInch>
                    </o:OfficeDocumentSettings>
                  </xml>
                </noscript>
                <![endif]-->
                <style>
                  table, td, div, h1, p {font-family: Arial, sans-serif;}
                  button{
                      font: inherit;
                      background-color: #FF7A59;
                      border: none;
                      padding: 10px;
                      text-transform: uppercase;
                      letter-spacing: 2px;
                      font-weight: 700; 
                      color: white;
                      border-radius: 5px; 
                      box-shadow: 1px 2px #d94c53;
                    }
                </style>
              </head>
              <body style="margin:0;padding:0;">
                <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
                  <tr>
                    <td align="center" style="padding:0;">
                      <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                        <tr>
                              <td align="center" style="padding:20px 0 20px 0;background:#70bbd9; font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;font-size: 20px;margin: 10px;">
                                  <h1 style="margin:24px">Remoratradinghubs</h1> 
                              </td>
                        </tr>
                        <tr style="background-color: #eeeeee;">
                          <td style="padding:36px 30px 42px 30px;">
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                              <tr>
                                <td style="padding:0 0 36px 0;color:#153643;">
                                  <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Dear ' . $fname . ' , </h1>
                                  <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                    Your subscription on ' . $data["investment_plan"] . ' of 
                                     $' . $data['amount'] . ' has been Completed successfully.
                                  </p>
                                  <br>
                                  <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                  <br>
                                  <i><b>Thanks for choosing us</b></i> 
                                  </p>
                                  <p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                      <a href="https://remoratradinghubs.com/account" style="color:#ee4c50;text-decoration:underline;"> 
                                          <button> 
                                              Click to Login
                                          </button>  
                                      </a>
                                  </p>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td style="padding:30px;background:#ee4c50;">
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                              <tr>
                                <td style="padding:0;width:50%;" align="left">
                                  <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                                    &reg; 2024 copyright remoratradinghubs<br/><a href="https://remoratradinghubs.com" style="color:#ffffff;text-decoration:underline;">visit site</a>
                                  </p>
                                </td>
                                <td style="padding:0;width:50%;" align="right">
                                  <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
                                    <tr>
                                      <td style="padding:0 0 0 10px;width:38px;">
                                        <a href="http://www.twitter.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/tw_1.png" alt="Twitter" width="38" style="height:auto;display:block;border:0;" /></a>
                                      </td>
                                      <td style="padding:0 0 0 10px;width:38px;">
                                        <a href="http://www.facebook.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/fb_1.png" alt="Facebook" width="38" style="height:auto;display:block;border:0;" /></a>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </body>
              </html>';
    $header = "From:Remoratradinghubs <support@remoratradinghubs.com> \r\n";
    $header .= "Cc:@remoratradinghubs.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    @$retval = mail($to, $subject, $message, $header);
  }
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

  $stmt = $db_conn->prepare("INSERT INTO `trades`                     (`userEmail`,`trade_by`,`stakeAmt`,`type`,`asset`,`duration`,`market`,`profitLoss`,`status`,`winLoss`) VALUES (?,?,?,?,?,?,?,?,?,?)");
  $stmt->bind_param(
    "ssissssiii",
    $datasource["email_address"],
    $data["by"],
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
  $stmt->bind_param("ss", $datasourceEncoded, $data["account_id"]);
  $stmt->execute();

  if ($stmt->affected_rows <= 0) {
    $_SESSION["feedback"] = "Failed to initiate Trade funding. Please try again later.";
    return false;
  } else {
    $_SESSION["feedback"] = "Trade has been successfully initiated!";

    // mail function
    $message = '';
    $fname = $datasource['full_names'];
    $email = $datasource['email_address'];

    // Send mail to user with verification here
    $to = $email;
    $subject = "TRADE NOTIFICATION";

    // Create the body message
    $message .= '<!DOCTYPE html>
        <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width,initial-scale=1">
          <meta name="x-apple-disable-message-reformatting">
          <title></title>
          <!--[if mso]>
          <noscript>
            <xml>
              <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
              </o:OfficeDocumentSettings>
            </xml>
          </noscript>
          <![endif]-->
          <style>
            table, td, div, h1, p {font-family: Arial, sans-serif;}
            button{
                font: inherit;
                background-color: #FF7A59;
                border: none;
                padding: 10px;
                text-transform: uppercase;
                letter-spacing: 2px;
                font-weight: 700; 
                color: white;
                border-radius: 5px; 
                box-shadow: 1px 2px #d94c53;
              }
          </style>
        </head>
        <body style="margin:0;padding:0;">
          <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
            <tr>
              <td align="center" style="padding:0;">
                <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                  <tr>
                        <td align="center" style="padding:20px 0 20px 0;background:#70bbd9; font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;font-size: 20px;margin: 10px;">
                            <h1 style="margin:24px">Remoratradinghubs</h1> 
                        </td>
                  </tr>
                  <tr style="background-color: #eeeeee;">
                    <td style="padding:36px 30px 42px 30px;">
                      <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                        <tr>
                          <td style="padding:0 0 36px 0;color:#153643;">
                            <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Dear ' . $fname . ' , </h1>
                            <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                              You have successfully Place a trade in your Remoratradinghubs account on : ' . date('Y-m-d h:i A') . '.
                            </p>
                            <br>
                            <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                            Type : ' . $data['type'] . '
                            <br>
                            Asset : ' . $data['asset'] . '
                            <br>
                            Amount : $' . $data['amount'] . '
                            <br>
                            Market : ' . $data['market'] . '
                            <br>
                            Duration : ' . $data['duration'] . '
                            <br>

                            <br>
                            <br>
                            <i><b>Thanks for trading with us</b></i> 
                            </p>
                            <p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                <a href="https://remoratradinghubs.com/account" style="color:#ee4c50;text-decoration:underline;"> 
                                    <button> 
                                        Click to Login
                                    </button>  
                                </a>
                            </p>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td style="padding:30px;background:#ee4c50;">
                      <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                        <tr>
                          <td style="padding:0;width:50%;" align="left">
                            <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                              &reg; 2024 copyright remoratradinghubs<br/><a href="https://remoratradinghubs.com" style="color:#ffffff;text-decoration:underline;">visit site</a>
                            </p>
                          </td>
                          <td style="padding:0;width:50%;" align="right">
                            <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
                              <tr>
                                <td style="padding:0 0 0 10px;width:38px;">
                                  <a href="http://www.twitter.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/tw_1.png" alt="Twitter" width="38" style="height:auto;display:block;border:0;" /></a>
                                </td>
                                <td style="padding:0 0 0 10px;width:38px;">
                                  <a href="http://www.facebook.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/fb_1.png" alt="Facebook" width="38" style="height:auto;display:block;border:0;" /></a>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </body>
        </html>';
    $header = "From:Remoratradinghubs <support@remoratradinghubs.com> \r\n";
    $header .= "Cc:@remoratradinghubs.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    @$retval = mail($to, $subject, $message, $header);
    return true;
  }
}

function editTrade($data)
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

  // echo '<script>window.alert("editTrade")</script>';

  $row = $result->fetch_assoc();
  $datasource = json_decode($row['datasource'], true);

  if ($data["winLoss"] == 1) {
    $_SESSION["feedback"] = "Please choose if trade is win or Loss";
    return false;
  } elseif ($data["winLoss"] == 2 || $data["winLoss"] == 3) {
    $status = 2;
  }

  if ($data['winLoss'] == 2) {
    $datasource["account_earnings"] = $datasource["account_earnings"] + $data["profitLoss"];
  } elseif ($data['winLoss'] == 3) {
    $datasource["account_balance"] = floatval($datasource["account_balance"]) + floatval($data["stakeAmt"]);
    $totalLoss = floatval($data["profitLoss"]) - floatval($data["stakeAmt"]);
    $datasource["account_balance"] = floatval($datasource["account_balance"]) - $totalLoss;
  }

  $stmt = $db_conn->prepare("UPDATE `trades` SET `status` = ? , `winLoss` = ?, `profitLoss` = ? WHERE id = ?");
  $stmt->bind_param("iisi", $status, $data["winLoss"], $data["profitLoss"], $data["trade_id"]);
  $stmt->execute();

  $datasourceEncoded = json_encode($datasource);

  $stmt = $db_conn->prepare("UPDATE `accounts` SET `datasource` = ? WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
  $stmt->bind_param("ss", $datasourceEncoded, $data["account_id"]);
  $stmt->execute();

  if ($stmt->affected_rows <= 0) {
    $_SESSION["feedback"] = "Failed to initiate Your Request. Please try again later.";
    return false;
  } else {
    $_SESSION["feedback"] = "Request has been successfully initiated!";

    // mail function
    $message = '';
    $fname = $datasource['full_names'];
    $email = $datasource['email_address'];
    $winLossEmail = $data['winLoss'] == 2 ? "Win" : "Loss";

    // Send mail to user with verification here
    $to = $email;
    $subject = "TRADE NOTIFICATION";

    // Create the body message
    $message .= '<!DOCTYPE html>
    <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <meta name="x-apple-disable-message-reformatting">
      <title></title>
      <!--[if mso]>
      <noscript>
        <xml>
          <o:OfficeDocumentSettings>
            <o:PixelsPerInch>96</o:PixelsPerInch>
          </o:OfficeDocumentSettings>
        </xml>
      </noscript>
      <![endif]-->
      <style>
        table, td, div, h1, p {font-family: Arial, sans-serif;}
        button{
            font: inherit;
            background-color: #FF7A59;
            border: none;
            padding: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 700; 
            color: white;
            border-radius: 5px; 
            box-shadow: 1px 2px #d94c53;
          }
      </style>
    </head>
    <body style="margin:0;padding:0;">
      <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tr>
          <td align="center" style="padding:0;">
            <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
              <tr>
                    <td align="center" style="padding:20px 0 20px 0;background:#70bbd9; font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;font-size: 20px;margin: 10px;">
                        <h1 style="margin:24px">Remoratradinghubs</h1> 
                    </td>
              </tr>
              <tr style="background-color: #eeeeee;">
                <td style="padding:36px 30px 42px 30px;">
                  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                    <tr>
                      <td style="padding:0 0 36px 0;color:#153643;">
                        <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Dear ' . $fname . ' , </h1>
                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                          Your trade in Remoratradinghubs account have completed on : ' . date('Y-m-d h:i A') . '.
                        </p>
                        <br>
                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                        Type : ' . $data['type'] . '
                        <br>
                        Asset : ' . $data['asset'] . '
                        <br>
                        Amount : $' . $data['amount'] . '
                        <br>
                        Market : ' . $data['market'] . '
                        <br>
                        Duration : ' . $data['duration'] . '
                        <br>
                        Profit/Loss : $' . $data["profitLoss"] . '
                        <br>
                        Win/Loss : ' . $winLossEmail . '
                        <br>

                        <br>
                        <br>
                        <i><b>Thanks for trading with us</b></i> 
                        </p>
                        <p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                            <a href="https://remoratradinghubs.com/account" style="color:#ee4c50;text-decoration:underline;"> 
                                <button> 
                                    Click to Login
                                </button>  
                            </a>
                        </p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td style="padding:30px;background:#ee4c50;">
                  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                    <tr>
                      <td style="padding:0;width:50%;" align="left">
                        <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                          &reg; 2024 copyright remoratradinghubs<br/><a href="https://remoratradinghubs.com" style="color:#ffffff;text-decoration:underline;">visit site</a>
                        </p>
                      </td>
                      <td style="padding:0;width:50%;" align="right">
                        <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
                          <tr>
                            <td style="padding:0 0 0 10px;width:38px;">
                              <a href="http://www.twitter.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/tw_1.png" alt="Twitter" width="38" style="height:auto;display:block;border:0;" /></a>
                            </td>
                            <td style="padding:0 0 0 10px;width:38px;">
                              <a href="http://www.facebook.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/fb_1.png" alt="Facebook" width="38" style="height:auto;display:block;border:0;" /></a>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </body>
    </html>';
    $header = "From:Remoratradinghubs <support@remoratradinghubs.com> \r\n";
    $header .= "Cc:@remoratradinghubs.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    @$retval = mail($to, $subject, $message, $header);
    return true;
  }
}

function ai_subscription($data)
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

  if ($data['min'] > $data['amount']) {
    $_SESSION["feedback"] = "Insufficient Amount! Minimum is $" . $data['min'] . " ";
    return false;
  } elseif ($data['amount'] > $data['max']) {
    $_SESSION["feedback"] = "Max is $" . $data['max'] . " Try a higher Plan ";
    return false;
  }

  if ($data["amount"] > $datasource["account_balance"]) {
    $_SESSION["feedback"] = "Insufficient funds! Your account balance is too low for this investment.";
    return false;
  }

  $account_id = $data['account_id'];
  $ai_plan = $data['ai_plan'];
  $winRate = $data['winRate'];
  $amount = $data['amount'];
  $duration = $data['duration'];
  $status = 1;

  $stmt = $db_conn->prepare("INSERT INTO `ai_investments`(`account_id`,`ai_plan`,`winRate`,`amount`,`duration`,`status`) VALUES (?,?,?,?,?,?)");
  $stmt->bind_param("ssssss", $account_id, $ai_plan, $winRate, $amount, $duration, $status);
  $stmt->execute();

  if ($stmt->affected_rows <= 0) {
    $_SESSION["feedback"] = "Failed to initiate account funding. Please try again later.";
    return false;
  }

  $datasource["account_balance"] -= $data["amount"];
  $datasource["amount_invested"] += $data["amount"];

  $encoded_datasource = json_encode($datasource);

  $stmt = $db_conn->prepare("UPDATE `accounts` SET `datasource` = ? WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
  $stmt->bind_param("ss", $encoded_datasource, $data["account_id"]);
  $stmt->execute();

  if ($stmt->affected_rows <= 0) {
    $_SESSION["feedback"] = "Failed to update account data. Please try again later.";
    return false;
  }

  $_SESSION["feedback"] = "Your investment has been successfully initiated ";
  if ($_SESSION["feedback"]) {

    // mail function
    $message = '';
    $fname = $datasource['full_names'];
    $email = $datasource['email_address'];

    // Send mail to user with verification here
    $to = $email;
    $subject = "SUBSCRIPTION NOTIFICATION";

    // Create the body message
    $message .= '<!DOCTYPE html>
              <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
              <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width,initial-scale=1">
                <meta name="x-apple-disable-message-reformatting">
                <title></title>
                <!--[if mso]>
                <noscript>
                  <xml>
                    <o:OfficeDocumentSettings>
                      <o:PixelsPerInch>96</o:PixelsPerInch>
                    </o:OfficeDocumentSettings>
                  </xml>
                </noscript>
                <![endif]-->
                <style>
                  table, td, div, h1, p {font-family: Arial, sans-serif;}
                  button{
                      font: inherit;
                      background-color: #FF7A59;
                      border: none;
                      padding: 10px;
                      text-transform: uppercase;
                      letter-spacing: 2px;
                      font-weight: 700; 
                      color: white;
                      border-radius: 5px; 
                      box-shadow: 1px 2px #d94c53;
                    }
                </style>
              </head>
              <body style="margin:0;padding:0;">
                <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
                  <tr>
                    <td align="center" style="padding:0;">
                      <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                        <tr>
                              <td align="center" style="padding:20px 0 20px 0;background:#70bbd9; font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;font-size: 20px;margin: 10px;">
                                  <h1 style="margin:24px">Remoratradinghubs</h1> 
                              </td>
                        </tr>
                        <tr style="background-color: #eeeeee;">
                          <td style="padding:36px 30px 42px 30px;">
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                              <tr>
                                <td style="padding:0 0 36px 0;color:#153643;">
                                  <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Dear ' . $fname . ' , </h1>
                                  <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                    Your AI subscription on ' . $data["investment_plan"] . ' of 
                                     $' . $data['amount'] . ' has been purchased successfully.
                                  </p>
                                  <br>
                                  <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                  <br>
                                  <i><b>Thanks for choosing us</b></i> 
                                  </p>
                                  <p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                      <a href="https://remoratradinghubs.com/account" style="color:#ee4c50;text-decoration:underline;"> 
                                          <button> 
                                              Click to Login
                                          </button>  
                                      </a>
                                  </p>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td style="padding:30px;background:#ee4c50;">
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                              <tr>
                                <td style="padding:0;width:50%;" align="left">
                                  <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                                    &reg; 2024 copyright remoratradinghubs<br/><a href="https://remoratradinghubs.com" style="color:#ffffff;text-decoration:underline;">visit site</a>
                                  </p>
                                </td>
                                <td style="padding:0;width:50%;" align="right">
                                  <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
                                    <tr>
                                      <td style="padding:0 0 0 10px;width:38px;">
                                        <a href="http://www.twitter.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/tw_1.png" alt="Twitter" width="38" style="height:auto;display:block;border:0;" /></a>
                                      </td>
                                      <td style="padding:0 0 0 10px;width:38px;">
                                        <a href="http://www.facebook.com/" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/fb_1.png" alt="Facebook" width="38" style="height:auto;display:block;border:0;" /></a>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </body>
              </html>';
    $header = "From:Remoratradinghubs <support@remoratradinghubs.com> \r\n";
    $header .= "Cc:@remoratradinghubs.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    @$retval = mail($to, $subject, $message, $header);
  }
  return false;
}

function ai_completeDelete($data)
{
  $db_conn = connect_to_database();

  if ($data["ai_complete"]) {

    if ($data['status'] == 2) {
      $_SESSION["feedback"] = "Item have been completed previously";
      return false;
    }

    $status = 2;
    $stmt = $db_conn->prepare("UPDATE `ai_investments` SET `status` = ? WHERE id = ?");
    $stmt->bind_param("ii", $status, $data["id"]);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
      $_SESSION["feedback"] = "Failed to initiate Your Request. Please try again later.";
      return false;
    } else {
      $_SESSION["feedback"] = "Item completed successfully!";
      return true;
    }
  } else {
    if ($data['status'] == 3) {
      $_SESSION["feedback"] = "Item have been Cancelled previously";
      return false;
    }

    $status = 3;
    $stmt = $db_conn->prepare("UPDATE `ai_investments` SET `status` = ? WHERE id = ?");
    $stmt->bind_param("ii", $status, $data["id"]);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
      $_SESSION["feedback"] = "Failed to initiate Your Request. Please try again later.";
      return false;
    } else {
      $_SESSION["feedback"] = "Item Cancelled successfully!";
      return true;
    }
  }
}

function ai_delete($data)
{

  $db_conn = connect_to_database();
  $stmt = $db_conn->prepare("DELETE FROM `ai_investments` WHERE id = ?");
  $stmt->bind_param("i", $data["id"]);
  $stmt->execute();

  if ($stmt->affected_rows <= 0) {
    $_SESSION["feedback"] = "Failed to initiate Your Request. Please try again later.";
    return false;
  } else {
    $_SESSION["feedback"] = "Item deleted successfully!";
    return true;
  }
}
