<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="box">
        <h1>Register</h1>
        <form method="post" action="register.php">
            <input type="text" placeholder="Login" name="login"><br>
            <input type="password" placeholder="Password" name="password"><br>
            <input type="password" placeholder="Repeat password" name="password2"><br>
            <input type="submit" value="Register">
        </form>
        Already have an account? <a href="login.php">Login here</a>
        <br><br>
        <?php
            
            if(isset($_POST["login"], $_POST["password"], $_POST["password2"]))
            {     
                if($_POST["password"] != $_POST["password2"]) 
                {
                    echo "Passwords don't match!";
                    return;
                }
                $con = mysqli_connect("localhost", "root", "", "users_db");
                

                $login = mysqli_real_escape_string($con, $_POST["login"]);
                $password = mysqli_real_escape_string($con, password_hash($_POST["password"], PASSWORD_DEFAULT));
                

                $res = mysqli_query($con, "SELECT * FROM users WHERE username='{$login}'"); 

                if(mysqli_num_rows($res)!=0)
                {
                    echo "Username already taken!";
                    return;
                }
                mysqli_query($con, "INSERT INTO users (username, password) VALUES ('{$login}', '{$password}')");

                mysqli_close($con);


                
                
            }
        ?>

    </div>
    
</body>
</html>
