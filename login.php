<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TripBoss</title>
     <!-- font awesome cdn -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <!-- fonts -->
     <link rel = "stylesheet" href = "font/fonts.css">
     <!-- normalize css -->
     <link rel = "stylesheet" href = "css/normalize.css">
     <!-- custom css -->
     <link rel = "stylesheet" href = "css/utility.css">
     <link rel = "stylesheet" href = "css/style.css">
     <link rel = "stylesheet" href = "css/responsive.css">
     <link rel = "stylesheet" href = "./css/login.css">
 </head>
</head>
<body>
<?php
    include_once "./config/dbconnect.php"; 

    if (isset($_POST['upload'])) {
        $fullName = $_POST['re_Name'];
        $email = $_POST['re_Email'];
        $password = $_POST['re_Pass'];
        $dayOfBirth = $_POST['re_day'];
        $phone = $_POST['re_phone'];
        $description = $_POST['re_desc'];

        // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
        $checkEmailQuery = "SELECT * FROM users WHERE email='$email'";
        $checkEmailResult = mysqli_query($conn, $checkEmailQuery);
        if (mysqli_num_rows($checkEmailResult) > 0) {
            echo "<script>alert('Email already exists. Please use a different email address.')</script>";
        } else {
            // Thực hiện câu truy vấn INSERT để thêm người dùng mới vào cơ sở dữ liệu
            $insertQuery = "INSERT INTO users (fullName, email, password, DOB, phone, usersDesc) 
                            VALUES ('$fullName', '$email', '$password', '$dayOfBirth', '$phone', '$description')";
            $insertResult = mysqli_query($conn, $insertQuery);

            if ($insertResult) {
                echo "<script>alert('Registration Successfully')</script>";
                // Chuyển hướng người dùng đến trang đăng nhập sau khi đăng ký thành công
                echo '<meta http-equiv="refresh" content="0;URL=index.php?page=login"/>';
            } else {
                echo "<script>alert('Registration failed. Please try again.')</script>";
            }
        }
    }
?>

     <!-- header -->
        <header class = "flex header-sm">
            <div class = "container">                 
    <div id='login-form' class='login-page'>
        <!---creating the form-box--->
        <div class="form-box">
            <div class='button-box'>
                <div id='btn'></div>
                <button type='button'onclick='login()'class='toggle-btn'>Login</button>
                <button type='button'onclick='register()'class='toggle-btn'>Register</button>
            </div>
            <!--creating login form-->
            <form id='login'class='input-group-login' method="post">
            <input type='email' class='input-field'name="inputEmail" placeholder='Email'required>
            <input type='password' class='input-field' name="inputPass" placeholder='Enter Password'required>
            <input type='checkbox'class='checkbox'>
            <span class="checkbox-txt">Remember Password</span> 
            <button type='submit'class='submit-btn' name="btnLogin">Login</button>
            </form>
            <?php

                if (isset($_POST['btnLogin'])) {
                $us = $_POST['inputEmail'];
                $pa = $_POST['inputPass'];
                $err = "";
                if ($us == "") {
                    $err .= "<script> alert('Enter Email, please')</script>";
                }
                if ($pa == "") {
                    $err .= "<script> alert('Enter Password, please')</script>";
                }
                if ($err != "") {
                    echo $err;
                } else {
                    $res = mysqli_query($conn, "SELECT * FROM users WHERE email='$us' AND password='$pa'")
                    or die(mysqli_errno($conn));
                    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

                    if (mysqli_num_rows($res) == 1) {
                    $_SESSION["us"] = $us;
                    $_SESSION["admin"] = $row["status"];
                    echo "<script> alert('Login successfully')</script>";
                    if (isset($_SESSION['us']) && $_SESSION['admin']==0){
                        echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
                    }elseif (isset($_SESSION['us']) && $_SESSION['admin']==1){
                        echo '<meta http-equiv="refresh" content="0;URL=admin_index.php"/>';
                    }
                    } else {
                    echo "<script>alert('You loged in fail');</script>";
                        
                    // echo '<meta http-equiv="refresh" content="0;URL=login.php"/>';

                    }
                }
                }
                ?>

            <!--creating the registration form-->
            <form id='register'class='input-group-register' method="POST">
                <input type='text' class='input-field' name="re_Name" placeholder='FullName'required>
                <input type='email' class='input-field' name="re_Email" placeholder='Email'required>
                <input type='password' class='input-field' name="re_Pass" placeholder='Enter Password'required>
                <input type='date' class='input-field' name="re_day" placeholder='Day of birth'required>
                <input type='phone' class='input-field' name="re_phone" placeholder='Phone'>
                <input type='text' class='input-field' name="re_desc" placeholder='Description'>
                <button type='submit'class='submit-btn' name="upload">Register</button>
            </form>


        </div>
    </div>
    <!--the first script code is for login 
            and registration form to move correctly-->
    <script>
        var x=document.getElementById('login');
        var y=document.getElementById('register');
        var z=document.getElementById('btn');
        function register()
        {
            x.style.left='-400px';
            y.style.left='50px';
            z.style.left='110px';
        }
        function login()
        {
            x.style.left='50px';
            y.style.left='450px';
            z.style.left='0px';
        }
    </script>
    <!--this code is for the when you click out the login or registration page
    the form-box disappear-->
    <script>
        var modal = document.getElementById('login-form');
        window.onclick = function(event)
        {
            if (event.target == modal)
            {
                modal.style.display = 'none';
            }
        }
    </script>
    </div>
 </header>
 <!-- header -->  
</body>
</html>