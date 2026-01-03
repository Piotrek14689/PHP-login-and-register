<?php
class Login
{
    private string $success_message = "";
    private string $error_message = "";

    private function checkUsername($username): bool
    {
        if(ctype_alnum($username))
            return true;
        return false;

    }

    private function checkPassword($password) : bool
    {
        return
            preg_match('/[A-Z]/', $password) &&
            preg_match('/[a-z]/', $password) &&
            preg_match('/\d/', $password) &&
            preg_match('/[^a-zA-Z0-9]/', $password);


    }

    public function login_authorization() : null
    {
        if (!empty($_POST["login"]) && !empty($_POST["password"])) {

            try {
                $con = mysqli_connect("localhost", "root", "", "users_db");
            } catch (Exception $ex) {
                $this->error_message = "Database connection error! Please try again later.";
                return null;
            }
            $login = $_POST["login"];
            $login_escaped = mysqli_real_escape_string($con, $_POST["login"]);
            $password_input = $_POST["password"];
            $password_hash = null;

            if(!$this->checkUsername($login))
            {
                $this->error_message = "Username must contain only alphanumeric characters.";
                return null;
            }

            $res = mysqli_query($con, "SELECT * FROM users WHERE username='$login_escaped'");

            if (mysqli_num_rows($res) == 0) {
                $this->error_message = "Incorrect username or password";
                return null;
            } 
            while ($users = mysqli_fetch_assoc($res)) {
                $password_hash = $users["password"];
            }

            if (!password_verify($password_input, $password_hash)) {
                $this->error_message = "Incorrect username or password";
                return null;
            } 
            $this->success_message = "Welcome, $login!";
            
            mysqli_close($con);
            
        }
        return null;
    }
    public function register() : null
    {
        
        if (!empty($_POST["login"]) && !empty($_POST["password"]) && !empty($_POST["confirm_password"])) {
            $login = $_POST["login"];
            $password = $_POST["password"];
            $confirm_password = $_POST["confirm_password"];

            if ($password != $confirm_password) {
                $this->error_message = "Passwords don't match!";
                return null;
            }
            if(!$this->checkUsername($login))
            {
                $this->error_message = "Username must contain ONLY alphanumeric characters.";
                return null;
            }
            if(!$this->checkPassword($password))
            {
                $this->error_message = "Password requirements not met.";
            }
            try {
                $con = mysqli_connect("localhost", "root", "", "users_db");
            } catch (Exception $ex) {
                $this->error_message = "Database connection error! Please try again later.";
                return null;
            }

            $login_escaped = mysqli_real_escape_string($con, $login);
            $password_escaped = mysqli_real_escape_string($con, password_hash($password, PASSWORD_DEFAULT));


            $res = mysqli_query($con, "SELECT * FROM users WHERE username='$login'");

            if (mysqli_num_rows($res) != 0) {
                $this->error_message = "Username already taken!";
                return null;
            } 
            mysqli_query($con, "INSERT INTO users (username, password) VALUES ('$login_escaped', '$password_escaped')");
            $this->success_message = "Successfully created account!";

            mysqli_close($con);

        }
        return null;
    }
    public function getError() : string
    {
        return $this->error_message;
    }
    public function getSuccess() : string
    {
        return $this->success_message;
    }

}