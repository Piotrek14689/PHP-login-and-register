<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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

        
        $uzytkownicy = [];
        
        $uzytkownicy[0] = new User();
        $uzytkownicy[1] = new User();
        $uzytkownicy[2] = new User();

        
        $uzytkownicy[0]->addUser("frank", "abc12345");
        $uzytkownicy[1]->addUser("admin", "admin");
        $uzytkownicy[2]->addUser("user", "password");

        file_put_contents('database.json', json_encode($uzytkownicy));
        
        if(isset($_POST["login"], $_POST["password"]))
        {
            $login = $_POST["login"];
            $password = $_POST["password"];
            $userLoggedIn = false;
            
            for($i = 0; $i<sizeof($uzytkownicy); $i++)
            {
                if($userLoggedIn == true) break;
                if($userLoggedIn == false)
                {
                    $userLoggedIn = $uzytkownicy[$i]->CheckLogin($login, $password);
                }

            }
            if($userLoggedIn == true) echo "Succesfully logged in!";
            else echo "Incorrect username or password.";       
            
        }
        
    ?>
</body>
</html>
