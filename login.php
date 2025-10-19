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
            public $nazwa;
            public $haslo;

            function addUser($user, $password)
            {
                $this->nazwa = $user;
                $this->haslo = $password;
            }
            function CheckLogin($user, $password)
            {
                if($this->haslo==$password && $this->nazwa==$user)
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


        if(isset($_POST["login"], $_POST["password"]))
        {
            $login = $_POST["login"];
            $password = $_POST["password"];
            $userLoggedIn = false;
            
            for($i = 0; $i<3; $i++)
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
