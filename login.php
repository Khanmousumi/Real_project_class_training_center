
<?php
session_start();

if (isset($_SESSION['email_login'])) {
    header('Location: ../dashboard/admin_index.php');
    exit;
}

require_once '../../config/db.php';

$error = [];

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $email_check = mysqli_query(
        $dbcon,
        "SELECT * FROM `users` WHERE `email`='$email'"
    );

    if (mysqli_num_rows($email_check) > 0) {

        $rows = mysqli_fetch_assoc($email_check);

        if ($rows['password'] == md5($password)) {

            $_SESSION['email_login'] = $rows['email'];

            header('Location: ../dashboard/admin_index.php');
            exit;

        } else {
            $error['password_check'] = "Password is not correct";
        }

    } else {
        $error['email_check'] = "The email is not found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/login.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
          rel="stylesheet">
</head>
<body>

    <div class="login-container">

        <div class="login-card">

            <div class="logo">
                <span>✦</span>
            </div>

            <h2>Welcome Back!</h2>
            <p class="subtitle">Login to your account</p>

            <form action="#" method="POST">

                <div class="input-group">
                    <label for="email">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter your email"
                        required
                    >
                    <label style="color:red;" for=""><?php if(isset($error['email_check'])){ echo $error['email_check']; }?></label>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >
                    <label for="">
<?php if (isset($error['password_check'])) { ?>
    <p style="color: red; margin-top: 5px;">
        <?php echo $error['password_check']; ?>
    </p>
<?php } ?>
</label>
                  
                </div>

                <div class="form-options">
                    <label class="remember">
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>

                    <a href="#">Forgot Password?</a>
                </div>

                <button type="submit" name="login">
                    Login Now
                </button>

                <p class="register-link">
                    Don't have an account?
                    <a href="../registration/register.php">
                    Register Now</a>
                </p>

            </form>

        </div>

    </div>

</body>
</html>
