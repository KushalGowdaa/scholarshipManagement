<?php
$mysqli = require __DIR__.'/database.php';

$sql_insert = "INSERT INTO pgapplication (user_id, applicant_name, email, gender, father_name, mother_name, dob, 12th_reg_no, 12th_percent, 12th_college_name, applied_clause, degree, course, uni_name, college_name, college_city, uni_reg_no, course_dur, curr_study_year)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = $mysqli->stmt_init();
if(!$stmt->prepare($sql_insert)) {
    die('SQL error: '.$mysqli->error);
}

$user_id = $_POST['user_id'];
$name = $_POST['applicant_name'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$father_name = $_POST['father_name'];
$mother_name = $_POST['mother_name'];
$dob = date('Y-m-d', strtotime($_POST['dob']));
$twelve_reg = $_POST['12th_reg_no'];
$twelve_percent = $_POST['12th_percentage'];
$twelve_coll = $_POST['12th_coll_name'];
$clause = $_POST['clause'];
$degree = $_POST['degree'];
$course = $_POST['course'];
$uni = $_POST['uni_name'];
$college = $_POST['college_name'];
$city = $_POST['city'];
$uni_reg = $_POST['uni_regno'];
$course_dur = $_POST['course_dur'];
$current = $_POST['study_year'];


$stmt->bind_param('issssssissssssssiii', $user_id, $name, $email, $gender, $father_name, $mother_name, $dob, $twelve_reg, $twelve_percent, $twelve_coll, $clause, $degree, $course, $uni, $college, $city, $uni_reg, $course_dur, $current);


if($stmt->execute()) {
    header("Refresh:2; url=UserDash.php");
    echo "Your application has been submitted";
    exit;
}
else {
    if($mysqli->errno == 1062){
        die('you have already submitted.');
    }
    else{
        die($mysqli->error." ".$mysqli->errno);
    }
}
?>