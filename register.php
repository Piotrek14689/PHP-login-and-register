<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous" defer></script>
</head>
<body>
    <?php
        $error = null;
        $success = null;
        if(isset($_POST["login"], $_POST["password"], $_POST["password2"]))
        {     
            if($_POST["password"] != $_POST["password2"]) 
            {
                $error = "Passwords don't match!";
            }
            else
            {
                $con = mysqli_connect("localhost", "root", "", "users_db");

                $login = mysqli_real_escape_string($con, $_POST["login"]);
                $password = mysqli_real_escape_string($con, password_hash($_POST["password"], PASSWORD_DEFAULT));
                

                $res = mysqli_query($con, "SELECT * FROM users WHERE username='{$login}'"); 

                if(mysqli_num_rows($res)!=0)
                {
                    $error = "Username already taken!";
                }
                else
                {
                    mysqli_query($con, "INSERT INTO users (username, password) VALUES ('{$login}', '{$password}')");
                    $success = "Successfully created account!";
                }
                    

                mysqli_close($con);


            }
            
            
        }
    ?>
    <div class="d-flex justify-content-end p-2">
        <button id="theme-toggle" class="btn btn-outline-secondary btn-sm d-none d-md-inline">
            ☀️ Light Mode
        </button>
    </div>
    <div class="d-md-none text-center mb-3">
        <button id="theme-toggle-mobile" class="btn btn-outline-secondary btn-sm">
            ☀️ Light Mode
        </button>
    </div>
    <div class="d-md-none text-center mb-3">
        <button id="theme-toggle" class="btn btn-outline-secondary btn-sm">🌙 Dark Mode</button>
    </div>
    <div class="container">
        <div class="mx-auto my-5 p-4 card shadow-sm" style="max-width:500px;">    
            <h1 class="mb-3">Register</h1>

            <?php if($error): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            <?php if($success): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>
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
                    <input type="password" class="form-control" id="password2" name="password2">
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>

            <div class="text-center mt-3">
                <small class="text-muted">
                    Already have an account? 
                    <a href="login.php" class="link-primary">Login here</a>
                </small>
            </div>
            
        </div>
    </div>
    <script src="js/theme.js"></script>
</body>
</html>
