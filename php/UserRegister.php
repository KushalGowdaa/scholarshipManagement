<?php

if(empty($_POST["userName"])) {
    die("Name is required");
}

if(! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if(strlen($_POST["password"]) < 8) {
    die("Password must be atleast 8 characters");
}

if (! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if (! preg_match("/[0-9]/i", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST['password'] !== $_POST['confirmPassword']) {
    die("Passwords must match.");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$date = date('Y-m-d', strtotime($_POST['dateOfBirth']));

$mysqli = require __DIR__ . '/database.php';

$sql_insert = 'INSERT INTO user_details (user_name, email, dob, password)
VALUES (?, ?, ?, ?)';

$stmt = $mysqli->stmt_init();

if(! $stmt->prepare($sql_insert)) {
    die('SQL error: '.$mysqli->error);
}

#binding values to placeholder characters
$stmt-> bind_param('ssss', $_POST['userName'], $_POST['email'], $date, $password_hash);

#executing the statement
if($stmt->execute()) {
    #redirect to the login page after registration.
    header("Refresh:2; url=userlogin.php");
    echo "You have successfully registered. please login using your password and userid sent to your email";
    exit;
}
else {
    if($mysqli->errno === 1062){
        die('emial already taken');//if the email is already registered then the message appears on the window.
    } else {
        die($mysqli->error." ".$mysqli->errno);
    }
}
?>