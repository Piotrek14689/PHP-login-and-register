<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="login.php">
        <input type="text" placeholder="Login" name="login"><br>
        <input type="password" placeholder="Password" name="password"><br>
        <input type="submit" value="Log in">
    </form>
    <?php
        class User{
            private $username;
            private $password;

            function addUser($user_input, $password_input)
            {
                $this->username = $user_input;
                $this->password = $password_input;
            }
            function CheckLogin($user_input, $password_input)
            {
                if($this->password==$password_input && $this->username==$user_input)
                {
                    return true;
                }
                else return false;
            }
        }
        

        $users = [];

        $con = mysqli_connect("localhost", "root", "", "users_db");
        $res = mysqli_query($con, "SELECT * FROM users");
        $j=0;
        while($temp = mysqli_fetch_assoc($res))
        {
            $users[$j] = new User();
            $users[$j]->addUser($temp["username"], $temp["password"]);
            $j++;
        }


        mysqli_close($con);
        // $uzytkownicy = [];
        
        // $uzytkownicy[0] = new User();
        // $uzytkownicy[1] = new User();
        // $uzytkownicy[2] = new User();

        
        // $uzytkownicy[0]->addUser("frank", "abc12345");
        // $uzytkownicy[1]->addUser("admin", "admin");
        // $uzytkownicy[2]->addUser("user", "password");

        
        
        if(isset($_POST["login"], $_POST["password"]))
        {
            $login = $_POST["login"];
            $password = $_POST["password"];
            $userLoggedIn = false;
            
            for($i = 0; $i<sizeof($users); $i++)
            {
                if($userLoggedIn == true) break;
                if($userLoggedIn == false)
                {
                    $userLoggedIn = $users[$i]->CheckLogin($login, $password);
                }

            }
            if($userLoggedIn == true) echo "Succesfully logged in!";
            else echo "Incorrect username or password.";       
            
        }
        //else echo "Please enter username and password.";
        
    ?>
</body>
</html>
