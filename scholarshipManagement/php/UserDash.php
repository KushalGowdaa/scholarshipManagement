<?php

session_start();

if(isset($_SESSION['user_id'])) {
    $mysqli = require __DIR__.'/database.php';
    $sql = "SELECT * FROM user_details WHERE user_id = {$_SESSION['user_id']}"; #it is not an untrusted content because the value is set in session itslef so no need to escape the value.
    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}

$sql_1 = "SELECT applicant_name, user_id, applied_clause FROM ugapplication WHERE user_id = {$_SESSION['user_id']}";
$result_1 = $mysqli->query($sql_1);

$sql_2 = "SELECT applicant_name, user_id, applied_clause FROM pgapplication WHERE user_id = {$_SESSION['user_id']}";
$result_2 = $mysqli->query($sql_2);

$sql_3 = "SELECT applicant_name, user_id, applied_clause, status FROM ugapplication WHERE user_id = {$_SESSION['user_id']}";
$result_3 = $mysqli->query($sql_3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/userdash.css">
    <link rel="icon" type="img/png" href="../Logo/Mscholar-1.png">
    <title>User dashboard</title>
</head>
<body>
    <div class="user-header">
        <div class="user-header-logo">
            <img class="user-header-img" src="../Logo/Mscholar.png">
        </div>
        <?php if (isset($user)):?>
            <p> You are logged in.</p>
        <?php else : ?>
            <p><a href="userlogin.php">Log in</a> or <a href = "../UserRegistration.html"> sign up</a>
        <?php endif; ?>
        <div class="user-profile">
            <div class="user-name">
                <?= htmlspecialchars($user['user_name']) ?>
                <div class="user-id">
                    <?= htmlspecialchars($user['user_id'])?>
                </div>
            </div>
            <div class="user-profile-photo">
                <img class="user-profile-img" src="../Logo/Profile icon.png">
            </div>
        </div>
    </div>
    <div class="user-body">
        <div class="user-menu-container">
            <button class="user_tabs active">Scholarships</button>
            <button class="user_tabs">Your applications</button>
            <button class="user_tabs">Application status</button>
            <a href="logOut.php">
                <button class="user_tabs">Log out</button>        
            </a>
        </div>
        <div class="content-container">
            <div class="content active">
                <div class="underGraduate-container">
                    <div class="uGcontent">
                        <h1>Under Graduate Program</h1>
                        <p>Apply now for Under Graduate Program and get financial support untill the graduation ends.</p>
                        <p>
                            <a href="../UGapplication.html">
                                <button>Apply Now</button>
                            </a>
                        </p>
                    </div>
                </div>
                <div class="postGraduate-container">
                    <div class="pGcontent">
                        <h1>Post Graduate Program</h1>
                        <p>Apply now for Post Graduate Program and get financial support untill the graduation ends.</p>
                        <p>
                            <a href="../pGapplication.html">
                                <button>Apply Now</button>
                            </a>
                        </p>
                    </div>
                </div>
                <div class="Jindal-container">
                    <div class="pGcontent">
                        <h1>Jindal Under Graduate Program</h1>
                        <p>Apply now for Under Graduate Program from Jindal and get financial support untill the graduation ends.</p>
                        <p>
                            <a href="../application_annexure_form.pdf">
                                <button>Apply Now</button>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="user-applications">
                    <table>
                        <h1>Your applications</h1>
                        <tr>
                            <th>Applicant name</th>
                            <th>Application Id</th>
                            <th>Program</th>
                        </tr>
                        <tr>
                        <?php while($row = $result_1->fetch_assoc())
                        {?>
                            <?php if($row > 0){ ?>
                                <td><?php echo $row['applicant_name']; ?></td>
                                <td><?php echo $row['user_id']; ?></td>
                                <td><?php echo $row['applied_clause']; ?></td>
                            </tr>
                            <?php }?>
                        <?php }?>
                        <tr>
                        <?php while($row = $result_2->fetch_assoc())
                        {?>
                            <?php if($row > 0){ ?>
                                <td><?php echo $row['applicant_name']; ?></td>
                                <td><?php echo $row['user_id']; ?></td>
                                <td><?php echo $row['applied_clause']; ?></td>
                            </tr>
                            <?php }?>
                        <?php }?>
                    </table>
                </div>
            </div>
            <div class="content">
                <div class="applicationStatus">
                    <h1>Application Status</h1>
                    <table>
                        <tr>
                            <th>Applicant name</th>
                            <th>Application Id</th>
                            <th>Program</th>
                            <th>Status</th>
                        </tr>
                        <tr>
                        <?php while($row = $result_3->fetch_assoc())
                        {?>
                            <?php if($row > 0){ ?>
                                <td><?php echo $row['applicant_name']; ?></td>
                                <td><?php echo $row['user_id']; ?></td>
                                <td><?php echo $row['applied_clause']; ?></td>
                                <td><?php echo $row['status'];?></td>
                            </tr>
                            <?php }?>
                        <?php }?>
                    </table>
                </div>
            </div>
            <div class="content">

            </div>
        </div>
    </div>
    <script src="../javaScript/userScript.js"></script>
</body>
</html>