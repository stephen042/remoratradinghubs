<?php

function connect_to_database()
{
    $conn_details = [
        "host" => "localhost",
        "user" => "removknv_santusfx",
        "password" => "removknv_santusfx",
        "database" => "removknv_santusfx",
        "port" => "3308"
    ];

    $connection = new mysqli(
        $conn_details["host"],
        $conn_details["user"],
        $conn_details["password"],
        $conn_details["database"],
        $conn_details["port"]
    );

    return $connection;
}


// function connect_to_database()
// {
//     $conn_details = [
//         "host" => "localhost",
//         "user" => "root",
//         "password" => "",
//         "database" => "s-code",
//         "port" => "3308"
//     ];

//     $connection = new mysqli(
//         $conn_details["host"],
//         $conn_details["user"],
//         $conn_details["password"],
//         $conn_details["database"],
//         $conn_details["port"]
//     );

//     return $connection;
// }
