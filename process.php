<?php

$password_hash = password_hash($_POST["password"],PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/connect.php";

$sql = "INSERT INTO users (firstname,lastname,email,password_hash)
        VALUES (?,?,?,?)";
$stmt = $mysqli -> stmt_init();

$stmt->prepare($sql);

if ( ! $stmt->prepare($sql)){
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssss",$_POST["firstname"],
                         $_POST["lastname"],
                         $_POST["email"],
                         $password_hash);
                         


try{
    $stmt->execute();
    header("Location: success.html");
    

}
catch(mysqli_sql_exception $e){
    header("Location: email_taken.html");
}


            



?>