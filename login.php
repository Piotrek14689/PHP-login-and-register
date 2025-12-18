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
        <?php
            // class User{
            //     private $username;
            //     private $password;

            //     function addUser($user_input, $password_input)
            //     {
            //         $this->username = $user_input;
            //         $this->password = $password_input;
            //     }
            //     function CheckLogin($user_input, $password_input)
            //     {
            //         if($this->password==$password_input && $this->username==$user_input)
            //         {
            //             return true;
            //         }
            //         else return false;
            //     }
            // }

            
            
            if(isset($_POST["login"], $_POST["password"]))
            {
                
                $login = $_POST["login"];
                $password = $_POST["password"];
                
                $con = mysqli_connect("localhost", "root", "", "users_db");
                $res = mysqli_query($con, "SELECT * FROM users WHERE username='{$login}' AND password='{$password}'"); 

                if(mysqli_num_rows($res)==0)
                {
                    echo "Incorrect username or password";
                    return;
                }
                while($users = mysqli_fetch_assoc($res))
                {
                    echo "Welcome, {$users['username']}";
                }
                   


                mysqli_close($con);


                
                
            }
        ?>

    </div>
    
</body>
</html>
