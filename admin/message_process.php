<?php


$mysqli = require __DIR__ . "/admin_db.php";
$sql = "INSERT INTO messages (author,message,admin_time)
        VALUES (?,?,?)";
$stmt = $mysqli -> stmt_init();

$stmt->prepare($sql);

if ( ! $stmt->prepare($sql)){
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sss",$_POST["author"],
                       $_POST["message"],
                       $_POST["admin_time"]);
                         



$stmt->execute();
header("Location: message_sent.html");
    



            



?>