<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous" defer></script>
</head>
<body>
    <div class="container">
        <h1 class="mb-3">Register</h1>
        <!-- <form>
            <input type="text" placeholder="Login" name="login" id="login"><br>
            <input type="password" placeholder="Password" name="password" id="password"><br>
            <input type="password" placeholder="Repeat password" name="password2" id="password2"><br>
            <input type="submit" value="Register">
        </form> -->
        <form method="post" action="register.php" class="mb-3">
            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input type="text" class="form-control" id="login" name="login">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="password2" class="form-label">Confirm password</label>
                <input type="password" class="form-control" id="password" name="password2">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
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
