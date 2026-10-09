<?php
require_once '../../config/db.php';

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
    $inputerror['fullname']="Fullname is required";
}

if(empty($username)){
    $inputerror['username']="username is required";
}

if(empty($email)){
    $inputerror['email']="email is required";
}
if(empty($phone)){
    $inputerror['phone']="phone is required";
}
if(empty($dob)){
    $inputerror['dob']="dob is required";
}
// if(empty($country)){
//     $inputerror['country']="country is required";
// }

if(empty($password)){
    $inputerror['password']="password is required";
}
if(empty($confirmpassword)){
    $inputerror['confirmpassword']="confirmpassword is required";
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
                        value="<?php if(isset($fullname)){echo $fullname;}?>"
                    >
                    <label style="color:red;" for=""><?php if(isset($inputerror['fullname'])){ echo $inputerror['fullname'];} ?></label>

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
                          value="<?php if(isset($username)){echo $fullname;}?>"
                    >
                    <label style="color:red;" for=""><?php if(isset($inputerror['username'])){ echo $inputerror['username'];} ?></label>

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
                          value="<?php if(isset($email)){echo $email;}?>"
                    >

                    <label style="color:red;" for=""><?php if(isset($inputerror['email'])){ echo $inputerror['email'];} ?></label>

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
                          value="<?php if(isset($phone)){echo $phone;}?>"
                    >

                    <label style="color:red;" for=""><?php if(isset($inputerror['phone'])){ echo $inputerror['phone'];} ?></label>

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
                          value="<?php if(isset($dob)){echo $dob;}?>"
                    >

                    <label style="color:red;" for=""><?php if(isset($inputerror['dob'])){ echo $inputerror['dob'];} ?></label>

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
                    <!-- <label style="color:red;" for=""><?php if(isset($inputerror['fullname'])){ echo $inputerror['fullname'];} ?></label> -->

                </div>

            </div>


            <!-- Gender -->

            <div class="form-group">

                <label>
                    Gender
                </label>

                <div class="gender-options">

                    <label>
                        <input
                            type="radio"
                            name="gender"
                            value="male"
                        >
                        Male
                    </label>

                    <label>
                        <input
                            type="radio"
                            name="gender"
                            value="female"
                        >
                        Female
                    </label>

                    <label>
                        <input
                            type="radio"
                            name="gender"
                            value="other"
                        >
                        Other
                    </label>

                </div>

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
                          value="<?php if(isset($password)){echo $password;}?>"
                    >

                    <label style="color:red;" for=""><?php if(isset($inputerror['password'])){ echo $inputerror['password'];} ?></label>

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
                          value="<?php if(isset($confirmpassword)){echo $confirmpassword;}?>"
                    >

                    <label style="color:red;" for=""><?php if(isset($inputerror['confirmpassword'])){ echo $inputerror['confirmpassword'];} ?></label>

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

</body>
</html>

