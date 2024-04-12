<?php
$is_invalid = false;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $mysqli = require __DIR__.'/database.php';
    $sql = sprintf("SELECT * From admin_details WHERE admin_id = '%s'",
    $mysqli->real_escape_string($_POST['admin_id']));

    $result = $mysqli->query($sql);

    $admin_details = $result->fetch_assoc();

    if($admin_details) {
        if($_POST['password'] == $admin_details['password']) {
            session_start();

            session_regenerate_id();

            $_SESSION['admin_id'] = $admin_details['admin_id'];

            header('Location: adminDash.php');
            exit;
        }
    }
    $is_invalid = true;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/userlogin.css">
    <link rel="icon" type="img/png" href="../Logo/Mscholar-1.png">
    <title>Login</title>
</head>
<body>
    <?php if($is_invalid): ?>
        <em>Invalid credentials</em>
    <?php endif; ?>
    <form method="post">
        <div class="form-container">
            <div class="form-head">
                <h1 class="register">Admin Login</h1>
            </div>
            <p class="description">
                Enter your credentials.
            </p>
            <div class="form-elements">
                <label for="email"><b>Admin Id</b></label>
                <input type="text" placeholder="Enter Email" name="admin_id" id="admin_id" value="<?= htmlspecialchars($_POST['admin_id'] ?? "") ?>" required>
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" id="password" required>
                <p><a class="forgot" href="#">Forgot password?</a>.</p>
                <button type="submit" class="loginbtn">Login</button>
            </div>
        </div>
    </form>
</body>
</html>