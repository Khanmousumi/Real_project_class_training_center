<?php
error_reporting(0);
require_once '../../config/db.php';
$showAlert = '';
$fullname = $username = $email = $phone = '';
$dob = $country = $gender = '';
$password = $confirmpassword = '';
$inputError = [];

if(isset($_POST['register'])){
date_default_timezone_set('Asia/Dhaka');

 $fullname=$_POST['fullname'];
 $username=$_POST['username'];
 $email=$_POST['email'];
 $phone=$_POST['phone'];
 $dob=$_POST['dob'];
 $country=$_POST['country'];
 $gender=$_POST['gender'];
 $password=$_POST['password'];
 $confirmpassword=$_POST['confirmpassword'];
 $terms_condition=$_POST['terms_condition'];
 $reg_time=date("Y-m-d");

$inputError=array();
if(empty($fullname)){
    $inputError['fullname']="Fullname is required";
}

if(empty($username)){
    $inputError['username']="Username is required";
}

if(empty($email)){
    $inputError['email']="Email is required";
}
if(empty($phone)){
    $inputError['phone']="Phone is required";
}
if(empty($dob)){
    $inputError['dob']="Date of Birth is required";
}
if(empty($country)){
    $inputError['country']="Country is required";
}

   if (empty($gender)) {
        $inputError['gender'] = 'Gender is required';
    }

if(empty($password)){
    $inputError['password']="Password is required";
}
if(empty($confirmpassword)){
    $inputError['confirmpassword']="Confirmpassword is required";
}
 if (empty($terms_condition)) {
        $inputError['terms_condition'] =
            'Please accept Terms & Conditions';
    }

 if (count($inputError) === 0) {
        if ($password !== $confirmpassword) {
            $inputError['donot_match_password'] = 'Confirm password does not match!';
        } elseif (strlen($password) < 8) {
            $inputError['password_length'] = 'Password must be at least 8 characters long!';
        } else {
            // Check email
            $email_safe = mysqli_real_escape_string($dbcon, $email);
            $phone_safe = mysqli_real_escape_string($dbcon, $phone);
            $username_safe = mysqli_real_escape_string($dbcon, $username);

            $email_select = mysqli_query(
                $dbcon,
                "SELECT email FROM users WHERE email='$email_safe' LIMIT 1"
            );

            if (mysqli_num_rows($email_select) > 0) {
                $inputError['email_unique'] = 'The email address already exists!';
            } else {
                // Check phone
                $phone_select = mysqli_query(
                    $dbcon,
                    "SELECT phone FROM users WHERE phone='$phone_safe' LIMIT 1"
                );

                if (mysqli_num_rows($phone_select) > 0) {
                    $inputError['phone_unique'] = 'The phone number already exists!';
                } else {
                    // Check username
                    $user_select = mysqli_query(
                        $dbcon,
                        "SELECT username FROM users WHERE username='$username_safe' LIMIT 1"
                    );

                    if (mysqli_num_rows($user_select) > 0) {
                        $inputError['username_unique'] = 'The username already exists!';
                    } else {
                        // Escape form values
                        $fullname_safe = mysqli_real_escape_string($dbcon, $fullname);
                        $gender_safe = mysqli_real_escape_string($dbcon, $gender);
                        $dob_safe = mysqli_real_escape_string($dbcon, $dob);
                        $country_safe = mysqli_real_escape_string($dbcon, $country);
                 
                        $reg_time_safe = mysqli_real_escape_string($dbcon, $reg_time);

                        // Store password securely
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $password_safe = mysqli_real_escape_string($dbcon, $hashed_password);

                        $insert_query = mysqli_query(
                            $dbcon,
                            "INSERT INTO users
                            (`fullname`,`username`, `email`, `phone`, `dob`, `country`, `gender`,`password`,  `reg_time`)
                            VALUES
                            ('$fullname_safe', '$username_safe', '$email_safe', '$phone_safe',
                            '$dob_safe', '$country_safe', '$gender_safe', '$password_safe', '$reg_time_safe')"
                        );

                        if ($insert_query) {
                            $showAlert = 'success';
                        } else {
                            $showAlert = 'error';
                        }
                    }
                }
            }
        }
    }
 
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/register.css">
    <title>Registration Form</title>

    
</head>

<body>

    <div class="form-wrapper">

        <!-- Header -->

        <div class="form-header">

            <h2>Create Your Account</h2>

            <p>
                Please enter your information to create a new account.
            </p>

        </div>


        <form action="" method="POST">

            <!-- Full Name + Username -->

            <div class="form-row">

                <div class="form-group">

                    <label for="fullname">
                        Full Name
                    </label>

                    <input
                        type="text"
                        id="fullname"
                        name="fullname"
                        placeholder="Enter your full name"
                        value="<?php echo htmlspecialchars($fullname, ENT_QUOTES, 'UTF-8'); ?>">
                        
                    
                     <label style="color:red;"><?php echo $inputError['fullname'] ?? ''; ?></label>
                      <label style="color:red;"><?php echo $inputError['fullname_unique'] ?? ''; ?></label>
   

                </div>


                <div class="form-group">

                    <label for="username">
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Choose a username"
                         value="<?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>">
                          
             
                     <label style="color:red;"><?php echo $inputError['username'] ?? ''; ?></label>
                     <label style="color:red;"><?php echo $inputError['username_unique'] ?? ''; ?></label>


                </div>

            </div>


            <!-- Email + Phone -->

            <div class="form-row">

                <div class="form-group">

                    <label for="email">
                        Email Address
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="example@email.com"
                         value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>">
                    

                     <label style="color:red;"><?php echo $inputError['email'] ?? ''; ?></label>
                      <label style="color:red;"><?php echo $inputError['email_unique'] ?? ''; ?></label>

                </div>


                <div class="form-group">

                    <label for="phone">
                        Phone Number
                    </label>

                    <input
                        type="tel"
                        id="phone"
                        name="phone"
                        placeholder="+880 1XXXXXXXXX"
                       value="<?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>">
                    

                     <label style="color:red;"><?php echo $inputError['phone'] ?? ''; ?></label>
                      <label style="color:red;"><?php echo $inputError['phone_unique'] ?? ''; ?></label>

                </div>

            </div>


            <!-- Date of Birth + Country -->

            <div class="form-row">

                <div class="form-group">

                    <label for="dob">
                        Date of Birth
                    </label>

                    <input
                        type="date"
                        id="dob"
                        name="dob"
                           value="<?php echo htmlspecialchars($dob, ENT_QUOTES, 'UTF-8'); ?>">
                    
                    <label style="color:red;"><?php echo $inputError['dob'] ?? ''; ?></label>

                </div>


                <div class="form-group">

                    <label for="country">
                        Country
                    </label>

                    <select id="country" name="country">

                        <option value="">
                            Select Country
                        </option>

                        <option value="bangladesh">
                            Bangladesh
                        </option>

                        <option value="india">
                            India
                        </option>

                        <option value="usa">
                            United States
                        </option>

                        <option value="uk">
                            United Kingdom
                        </option>

                        <option value="canada">
                            Canada
                        </option>

                    </select>
                    <label style="color:red;">
                    <?php echo $inputError['country'] ?? ''; ?>
                    </label>

                </div>

            </div>


            <div class="form-row">
                    <div class="form-group">
                        <label>Gender <span class="required">*</span></label>
                        <select name="gender" class="form-control">
                            <option value="">Select Gender</option>
                            <option value="male" <?php if ($gender === 'male') echo 'selected'; ?>>Male</option>
                            <option value="female" <?php if ($gender === 'female') echo 'selected'; ?>>Female</option>
                            <option value="other" <?php if ($gender === 'other') echo 'selected'; ?>>Other</option>
                        </select>
                        <label style="color:red;"><?php echo $inputError['gender'] ?? ''; ?></label>
                    </div>


 


            <!-- Password + Confirm Password -->

            <div class="form-row">

                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Create password"
                           
                    >

                    <label style="color:red;"><?php echo $inputError['password'] ?? ''; ?></label>
                        
                    <label style="color:red;"><?php echo $inputError['password_length'] ?? ''; ?></label>
                    

                </div>


                <div class="form-group">

                    <label for="confirm_password">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="confirmpassword"
                        id="confirm_password"
                        placeholder="Confirm password"
                        >
                    

                     <label style="color:red;"><?php echo $inputError['confirmpassword'] ?? ''; ?></label>
                    <label style="color:red;"><?php echo $inputError['donot_match_password'] ?? ''; ?></label>

                </div>

            </div>


            <!-- Agreement -->

            <div class="agreement">

                <input
                    type="checkbox"
                    name="terms_condition"
                    required
                >

                <label for="terms">
                    I agree to the
                    <a href="#">Terms & Conditions</a>
                </label>
                <label style="color:red;">
               <?php echo $inputError['terms_condition'] ?? ''; ?>
              </label>

            </div>


            <!-- Button -->

            <button
                type="submit" name="register" class="register_btn"
                >

                Create Account

            </button>


        </form>


        <!-- Login -->

        <div class="login-text">

            Already have an account?

            <a href="#">
                Login
            </a>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

     <?php if ($showAlert === 'success'): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Registration Successful!',
            text: 'Your account has been created successfully.',
            position: 'top',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
            allowOutsideClick: false
        }).then(function () {
            window.location.href = 'register.php';
        });
    </script>
    <?php elseif ($showAlert === 'error'): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Registration Failed!',
            text: 'Something went wrong. Please try again.',
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    </script>
    <?php endif; ?>


</body>
</html>

