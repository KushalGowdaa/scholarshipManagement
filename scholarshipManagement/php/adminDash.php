<?php  

session_start();

if(isset($_SESSION['admin_id'])) {
    $mysqli = require __DIR__.'/database.php';
    $sql = "SELECT admin_id, admin_name From admin_details";

    $result = $mysqli->query($sql);

    $admin = $result->fetch_assoc();

}

$sql_1 = "SELECT (SELECT count(*) FROM ugapplication)+(SELECT count(*) FROM pgapplication) as total_count"; 
$result_1 = $mysqli->query($sql_1); 

$sql_2 = "SELECT count(*) FROM user_details";
$result_2 = $mysqli->query($sql_2);

$sql_3 = "SELECT applicant_name, user_id, applied_clause from ugapplication";
$result_3 = $mysqli->query($sql_3);

$sql_4 = "SELECT user_id, user_name, email, dob FROM user_details";
$result_4 = $mysqli->query($sql_4);

if(isset($_GET['idd'])){
    $id_1 = $_GET['idd'];
    $sql_7 = $mysqli->query("UPDATE ugapplication set status='issued' WHERE user_id = $id_1");
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql_5 = $mysqli->query("DELETE from user_details WHERE user_id = $id");
}

$sql_6 = "SELECT count(*) FROM ugapplication WHERE status = 'Submitted, Under Verification'"; 
$result_6 = $mysqli->query($sql_6);


$sql_8 = "SELECT count(*) FROM issued";
$result_8 = $mysqli->query($sql_8);

$sql_9 = "SELECT applicant_name, user_id, applied_clause, date_issued from issued";
$result_9 = $mysqli->query($sql_9);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/adminDash.css">
    <link rel="icon" type="img/png" href="../Logo/Mscholar-1.png">
    <title>Admin dashboard</title>
</head>
<body>
    <div class="admin-header">
        <div class="admin-header-logo">
            <img class="admin-header-img" src="../Logo/Mscholar.png">
        </div>
        <?php if(isset($admin)): ?>
            <p>You are logged in.</p>
        <?php else: ?>
            <p>please enter valid credentials.</p>
        <?php endif; ?>
        <div class="admin_head">
            Admin
        </div>
        <div class="admin-profile">
            <div class="admin-name">
                <?= htmlspecialchars($admin['admin_name'])?>
                <div class="admin-id">
                <?= htmlspecialchars($admin['admin_id'])?>
                </div>
            </div>
            <div class="admin-profile-photo">
                <img class="admin-profile-img" src="../Logo/Profile icon.png">
            </div>
        </div>
    </div>
    <div class="admin-body">
        <div class="admin-menu-container">
            <button class="admin_tabs active">Home</button>
            <button class="admin_tabs">Review Application</button>
            <button class="admin_tabs">Issued Scholarships</button>
            <button class="admin_tabs">Remove users</button>
            <button class="admin_tabs">Report</button>          
            <a href="logOut.php">
                <button class="admin_tabs">Log out</button>        
            </a>        
        </div>
        <div class="verifyWindow">
            <?php ?>
        </div>
        <div class="content-container">
            <div class="content active">
                <div class="desc-container_1">
                    <div class="application_count">
                        Total Applications
                        <p class="appli_count"> <?php while($row = $result_1->fetch_assoc()) { 
                            echo  $row['total_count']; 
                            }?></p>
                    </div>
                    <div class="no_of_users">
                        Active users
                        <p class="user_count"><p class="appli_count"> <?php while($row = mysqli_fetch_array($result_2)) { 
                            echo  $row['count(*)']; 
                            }?></p></p>
                    </div>
                    <div class="rejected_applications">
                        Rejected Applications
                        <p class="rejected_count">0</p>
                    </div>
                </div>
                <div class="desc-container_2">
                    <div class="scholarship_issued">
                        Scholarship Issued
                        <p class="issued_count"><?php while($row = mysqli_fetch_array($result_8)) { 
                            echo  $row['count(*)']; 
                            }?></p>
                    </div>
                    <div class="appli_under_review">
                        Applications under Review
                        <p class="review_count"> <?php while($row = mysqli_fetch_array($result_6)) { 
                            echo  $row['count(*)']; 
                            }?></p>
                    </div>
                </div>
            </div>
            <div class="content">
                <table>
                    <tr>
                        <th>Applicant name</th>
                        <th>Application Id</th>
                        <th>Program</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <?php while($row = $result_3->fetch_assoc())
                        {
                        echo "<td>".$row['applicant_name'],"</td>";
                        echo "<td>".$row['user_id'],"</td>";
                        echo "<td>".$row['applied_clause'],"</td>";
                        echo "<td><a href='adminDash.php?idd=".$row['user_id'],"' class='btn'>
                                    <input type='submit' value='Verify' class='removebtn'>
                            </a>
                        </td>";
                    echo "</tr>";
                 }?>
                </table>
            </div>
            <div class="content">
                <table>
                    <tr>
                        <th>Applicant name</th>
                        <th>Application Id</th>
                        <th>Program</th>
                        <th>Date Issued</th>
                    </tr>
                    <tr>
                    <?php while($row = $result_9->fetch_assoc())
                        {?>
                        <td><?php echo $row['applicant_name'];?></td>
                        <td><?php echo $row['user_id'];?></td>
                        <td><?php echo $row['applied_clause'];?></td>
                        <td><?php echo $row['date_issued'];?></td>
                    </tr>
                <?php } ?>
                </table>
            </div>
            <div class="content">
                <table>
                    <h1 class='table-head'>User List</h1>
                    <tr>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>E-mail</th>
                        <th>Date of Birth</th>
                        <th>Action</th>
                    </tr>
                    <?php while($row = $result_4->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['user_id'],"</td>";
                        echo "<td>".$row['user_name'],"</td>";
                        echo "<td>".$row['email'],"</td>";
                        echo "<td>".$row['dob'],"</td>";
                        echo "<td>
                                <a href='adminDash.php?id=".$row['user_id'],"' class='btn'>
                                    <input type='submit' value='Remove' class='removebtn' onclick='return confirmRemove()'>
                                </a>
                            </td>";
                        echo "</tr>";
                    } ?>
                </table>
            </div>
            <div class="content">
                report analysis of students
            </div>
        </div>
    </div>
    <script src="../javaScript/adminScript.js"></script>
    <script>
        function confirmRemove () {
            return confirm('Are you sure you want to remove this user?');
        }

        function confirmVerify () {
            return confirm('Are you sure you want to verify this application?');
        }
    </script>
</body>
</html>