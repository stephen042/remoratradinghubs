<?php

function email_verification($mail_data): bool
{
    include "../_servers/mail_service/server.php";
    $mail_template = "https://servers.excceedder.com/mail_service/templates/email_verification.php";

    $template_placeholders = [
        "{FULL_NAMES}" => $mail_data["full_names"],
        "{EMAIL_VERIFICATION_URL}" => $mail_data["email_verification_url"],
    ];

    $message_body = file_get_contents($mail_template);
    foreach ($template_placeholders as $key => $value) {
        $message_body = str_replace($key, $value, $message_body);
    }

    $mail->addAddress($mail_data["email_address"]);
    $mail->Subject = "Excceedder | Email Verification";
    $mail->Body = $message_body;

    return $mail->send();
}

function account_welcome($mail_data): bool
{
    include "../_servers/mail_service/server.php";
    $mail_template = "https://servers.excceedder.com/mail_service/templates/account_welcome.php";

    $template_placeholders = [
        "{FULL_NAMES}" => $mail_data["full_names"],
        "{DASHBOARD_ACCESS_URL}" => $mail_data["dashboard_access_url"],
    ];

    $message_body = file_get_contents($mail_template);
    foreach ($template_placeholders as $key => $value) {
        $message_body = str_replace($key, $value, $message_body);
    }

    $mail->addAddress($mail_data["email_address"]);
    $mail->Subject = "Excceedder | Welcome Message";
    $mail->Body = $message_body;

    return $mail->send();
}

function account_recovery($mail_data): bool
{
    include "../_servers/mail_service/server.php";
    $mail_template = "https://servers.excceedder.com/mail_service/templates/account_recovery.php";

    $template_placeholders = [
        "{FULL_NAMES}" => $mail_data["full_names"],
        "{ACCOUNT_RECOVERY_URL}" => $mail_data["account_recovery_url"],
    ];

    $message_body = file_get_contents($mail_template);
    foreach ($template_placeholders as $key => $value) {
        $message_body = str_replace($key, $value, $message_body);
    }

    $mail->addAddress($mail_data["email_address"]);
    $mail->Subject = "Excceedder | Account Recovery";
    $mail->Body = $message_body;

    return $mail->send();
}

function successful_recovery($mail_data): bool
{
    include "../_servers/mail_service/server.php";
    $mail_template = "https://servers.excceedder.com/mail_service/templates/successful_recovery.php";

    $template_placeholders = [
        "{FULL_NAMES}" => $mail_data["full_names"],
        "{DASHBOARD_ACCESS_URL}" => $mail_data["dashboard_access_url"],
    ];

    $message_body = file_get_contents($mail_template);
    foreach ($template_placeholders as $key => $value) {
        $message_body = str_replace($key, $value, $message_body);
    }

    $mail->addAddress($mail_data["email_address"]);
    $mail->Subject = "Excceedder | Recovery Successful";
    $mail->Body = $message_body;

    return $mail->send();
}

function account_access_token($mail_data): bool
{
    include "../_servers/mail_service/server.php";
    $mail_template = "https://servers.excceedder.com/mail_service/templates/account_access_token.php";

    $template_placeholders = [
        "{FULL_NAMES}" => $mail_data["full_names"],
        "{ACCESS_TOKEN}" => $mail_data["access_token"],
    ];

    $message_body = file_get_contents($mail_template);
    foreach ($template_placeholders as $key => $value) {
        $message_body = str_replace($key, $value, $message_body);
    }

    $mail->addAddress($mail_data["email_address"]);
    $mail->Subject = "Excceedder | Account Access Token";
    $mail->Body = $message_body;

    return $mail->send();
}

function successful_login($mail_data): bool
{
    include "../_servers/mail_service/server.php";
    $mail_template = "https://servers.excceedder.com/mail_service/templates/successful_login.php";

    $template_placeholders = [
        "{FULL_NAMES}" => $mail_data["full_names"],
        "{DEVICE_NAME}" => $mail_data["device_name"],
        "{TIME_OF_AUTHORIZATION}" => $mail_data["time_of_authorization"]
    ];

    $message_body = file_get_contents($mail_template);
    foreach ($template_placeholders as $key => $value) {
        $message_body = str_replace($key, $value, $message_body);
    }

    $mail->addAddress($mail_data["email_address"]);
    $mail->Subject = "Excceedder | Login Detected";
    $mail->Body = $message_body;

    return $mail->send();
}

function account_email_update($mail_data): bool
{
    include "../_servers/mail_service/server.php";
    $mail_template = "https://servers.excceedder.com/mail_service/templates/account_email_update.php";

    $template_placeholders = [
        "{FULL_NAMES}" => $mail_data["full_names"],
        "{EMAIL_UPDATE_URL}" => $mail_data["email_update_url"],
    ];

    $message_body = file_get_contents($mail_template);
    foreach ($template_placeholders as $key => $value) {
        $message_body = str_replace($key, $value, $message_body);
    }

    $mail->addAddress($mail_data["new_email_address"]);
    $mail->Subject = "Excceedder | Email Address Update";
    $mail->Body = $message_body;

    return $mail->send();
}

function successful_account_email_update($mail_data): bool
{
    include "../_servers/mail_service/server.php";
    $mail_template = "https://servers.excceedder.com/mail_service/templates/successful_email_update.php";

    $template_placeholders = [
        "{FULL_NAMES}" => $mail_data["full_names"],
        "{OLD_EMAIL_ADDRESS}" => $mail_data["old_email_address"],
        "{NEW_EMAIL_ADDRESS}" => $mail_data["new_email_address"],
    ];

    $message_body = file_get_contents($mail_template);

    foreach ($template_placeholders as $key => $value) {
        $message_body = str_replace($key, $value, $message_body);
    }

    $email_address_list = [
        $mail_data["new_email_address"],
        $mail_data["old_email_address"]
    ];

    foreach ($email_address_list as $email_address) {
        $mail->addAddress($email_address);
    }

    $mail->Subject = "Excceedder | Account Email Update Successful";
    $mail->Body = $message_body;

    return $mail->send();
}
