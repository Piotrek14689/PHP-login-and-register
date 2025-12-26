<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous" defer></script>
</head>
<body>
    <?php
        // TO DO: INPUT VALIDATION!!!!!
        $error = null;
        $success = null;
        if(isset($_POST["login"], $_POST["password"]))
        { 
            $con = mysqli_connect("localhost", "root", "", "users_db");
            if(!$con)
            {
                echo "Database error!";
            }
            else{
                $login = $_POST["login"];
                $login_escaped = mysqli_real_escape_string($con, $_POST["login"]);
                $password_input = $_POST["password"];

                $res = mysqli_query($con, "SELECT * FROM users WHERE username='{$login_escaped}'"); 

                if(mysqli_num_rows($res)==0)
                {
                    $error = "Incorrect username or password";
                }else{
                    while($users = mysqli_fetch_assoc($res))
                    {
                        $password_hash = $users["password"]; 
                    }

                    if(!password_verify($password_input, $password_hash))
                    {
                        $error = "Incorrect username or password";
                        
                    }else{
                        $success = "Welcome, {$login}";
                    }
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
    <div class="container">
        <div class="mx-auto my-5 p-4 card shadow-sm" style="max-width:500px; ">
            <h1 class="mb-3">Login</h1>
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


            <form method="post" action="login.php" class="mb-3">
                <div class="mb-3">
                    <label for="login" class="form-label">Login</label>
                    <input type="text" class="form-control" id="login" name="login">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <div class="text-center mt-3">
                <small class="text-muted">
                    Don't have an account? 
                    <a href="register.php" class="link-primary">Register now</a>
                </small>
            </div>
            



        </div>
        

    </div>
    <script src="js/theme.js"></script>
</body>
</html>
