<?php
    include('connection.php');
    
    if(isset($_POST['signup'])) {
        $id = $_POST['id'];
        $regUsername = $_POST['regUsername'];
        $regEmail = $_POST['regEmail'];
        $regPassword = $_POST['regPassword'];
        
        try {
            $sql = "insert into user (user_id, username, email, password) values('$id','$regUsername','$regEmail','$regPassword')";
            if ($con->query($sql) === TRUE) {
                session_start();
                $_SESSION['id'] = $id;
                header("Location: redirect.php");
            } else {
                throw new Exception("Error: " . $sql . "<br>" . $con->error);
            }
        } catch (mysqli_sql_exception $e) {
            echo "<script> alert('Username already exists!')</script>";
        }
    }

    if(isset($_POST['login'])) {
        $username = $_POST['logUsername'];
        $password = $_POST['logPassword'];

        $sql1 = "select * from user where username = '$username' and password = '$password'";
        $result = mysqli_query($con, $sql1);
        $count = mysqli_num_rows($result);

        if($count == 1) {
            $i = $con->query($sql1)->fetch_assoc();
            $id = $i['user_id'];
            session_start();
            $_SESSION['id'] = $id;
            header("Location: redirect.php");
        }
        else {
            echo "<script> alert('Invalid Username or Password!')</script>";
        }
    }
?>
    
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icons/logo.png"/>
    <link rel="stylesheet" href="loginstyle.css">
    <title>Spendle | Login</title>
</head>

<body>
<a href="home.html"><img src="icons/logo.png" height="85" width="85"/></a>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form id="registrationForm" action="" method="POST">
                <h1>Create Account</h1><br>
                <input type="text" placeholder="Username" id="regUsername" name="regUsername" required>
                <input type="email" placeholder="Email" id="regEmail" name="regEmail" required>

                <input type="password" placeholder="Password" id="regPassword" name="regPassword" pattern="(?=.*\d).{8,}"
                title="Must contain at least one number and at least 8 or more characters" required>

                <input type="password" placeholder="Confirm Password" id="confirm_password" name="confirm_password"
                pattern="(?=.*\d).{8,}" required onkeyup="validate_password()">
                <span id="alert"></span>
                <input type="hidden" id="id" name="id" value="" />
                <input type="checkbox" onclick="reg()"/>Show Password<br/><br/>
                <button type="submit" name="signup" id="create">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form id="loginForm" action="" method="POST">
                <h1>Login</h1><br>
                <input type="text" placeholder="Username" id="logUsername" name="logUsername" required>
                <input type="password" placeholder="Password" id="logPassword" name="logPassword" pattern="(?=.*\d).{8,}" required>

                <input type="checkbox" onclick="log()" />Show Password<br/><br/>
                <!-- <a href="#">Forgot Password?</a> -->
                <button type="submit" name="login">Log In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your details to use all of the site features</p>
                    <button class="hidden" id="login">Log In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello There!</h1>
                    <p>Register with your details to use all of the site features</p>
                    <button class="hidden" id="signup">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="logscript.js"></script>
</body>

</html>