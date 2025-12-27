<?php
class Login
{
    private $success_message = null;
    private $error_message = null;

    // private function checkUsername()
    // {

    // }

    public function login()
    {
        if (!empty($_POST["login"]) && !empty($_POST["password"])) {
            $con = mysqli_connect("localhost", "root", "", "users_db");
            if (!$con) {
                echo "Database error!";
            } 
            $login = $_POST["login"];
            $login_escaped = mysqli_real_escape_string($con, $_POST["login"]);
            $password_input = $_POST["password"];

            $res = mysqli_query($con, "SELECT * FROM users WHERE username='{$login_escaped}'");

            if (mysqli_num_rows($res) == 0) {
                $this->error_message = "Incorrect username or password";
                return;
            } 
            while ($users = mysqli_fetch_assoc($res)) {
                $password_hash = $users["password"];
            }

            if (!password_verify($password_input, $password_hash)) {
                $this->error_message = "Incorrect username or password";
                return;
            } 
            $this->success_message = "Welcome, {$login}!";
            
            mysqli_close($con);
            
        }
    }
    public function register()
    {
        if (!empty($_POST["login"]) && !empty($_POST["password"]) && !empty($_POST["confirm_password"])) {

            if ($_POST["password"] != $_POST["confirm_password"]) {
                $this->error_message = "Passwords don't match!";
                return;
            } 
            $con = mysqli_connect("localhost", "root", "", "users_db");

            $login = mysqli_real_escape_string($con, $_POST["login"]);
            $password = mysqli_real_escape_string($con, password_hash($_POST["password"], PASSWORD_DEFAULT));


            $res = mysqli_query($con, "SELECT * FROM users WHERE username='{$login}'");

            if (mysqli_num_rows($res) != 0) {
                $this->error_message = "Username already taken!";
                return;
            } 
            mysqli_query($con, "INSERT INTO users (username, password) VALUES ('{$login}', '{$password}')");
            $this->success_message = "Successfully created account!";
            


            mysqli_close($con);


            


        }
    }
    public function getError()
    {
        return $this->error_message;
    }
    public function getSuccess()
    {
        return $this->success_message;
    }

}

?>