<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="box">
        <h1>Login</h1>
        <form method="post" action="login.php">
            <input type="text" placeholder="Login" name="login"><br>
            <input type="password" placeholder="Password" name="password"><br>
            <input type="submit" value="Log in">
        </form>
        No account? <a href="register.php">Register here</a>
        <br><br>
        <?php
            
            if(isset($_POST["login"], $_POST["password"]))
            {     
                $con = mysqli_connect("localhost", "root", "", "users_db");
                if(!$con)
                {
                    echo "Database error!";
                    return;
                }
                $login = $_POST["login"];
                $login_escaped = mysqli_real_escape_string($con, $_POST["login"]);
                $password_input = $_POST["password"];

                $res = mysqli_query($con, "SELECT * FROM users WHERE username='{$login_escaped}'"); 

                if(mysqli_num_rows($res)==0)
                {
                    echo "Incorrect username or password";
                    return;
                }
                
                while($users = mysqli_fetch_assoc($res))
                {
                    $password_hash = $users["password"]; 
                }

                if(!password_verify($password_input, $password_hash))
                {
                    echo "Incorrect username or password";
                    return;
                }

                echo "Welcome, {$login}";
                




                // $res = mysqli_query($con, "SELECT * FROM users WHERE username='{$login}' AND password='{$password}'"); 

                // if(mysqli_num_rows($res)==0)
                // {
                //     echo "Incorrect username or password";
                //     return;
                // }
                // while($users = mysqli_fetch_assoc($res))
                // {
                //     echo "Welcome, {$users['username']}";
                // }
                   


                mysqli_close($con);


                
                
            }
        ?>

    </div>
    
</body>
</html>
