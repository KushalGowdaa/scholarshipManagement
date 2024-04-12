<?php
$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $mysqli = require __DIR__ . "/database.php";
    $sql = sprintf("SELECT * From user_details WHERE user_id = '%d'",
    $mysqli->real_escape_string($_POST['user_id']));//to avoid sql injections we escape from the value from the form.

    $result = $mysqli->query($sql);

    $user_details= $result->fetch_assoc();//to fetch data from the result object returned from the query.

    if($user_details){
        if(password_verify($_POST['password'], $user_details['password'])) {

            session_start();

            session_regenerate_id(); //so that the session cannot be attacked using the session fixation attacks.

            $_SESSION['user_id'] = $user_details['user_id']; #storing the session values in the session global variable.

            header('Location:UserDash.php');
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
    <title>Login</title>
    <link rel="icon" type="img/png" href="../Logo/Mscholar-1.png">
    <link rel="stylesheet" href="../style/userlogin.css" type="text/css">
</head>
<body>
    <?php if ($is_invalid): ?>
        <em>Invalid Credentials</em>
    <?php endif; ?>
    <form method="post">
        <div class="form-container">
            <div class="form-head">
                <h1 class="register">User Login</h1>
            </div>
            <p class="description">
                Enter your credentials.
            </p>
            <div class="form-elements">
                <label for="user_id"><b>User Id</b></label>
                <input type="text" placeholder="Enter User Id" name="user_id" id="user_id" value="<?= htmlspecialchars($_POST['user_id'] ?? "") ?>" required>
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" id="password" required>
                <p><a class="forgot" href="#">Forgot password?</a>.</p>
                <button type="submit" class="loginbtn">Login</button>
                
            </div>
        </div>
    </form>
</body>
</html>