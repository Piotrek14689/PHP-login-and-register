<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous" defer></script>
</head>
<body>
    <?php
        require("functions.php");
        $login = new Login();
        $login->register();
    ?>
    <div class="d-flex justify-content-end p-2">
        <button id="theme-toggle" class="btn btn-outline-secondary btn-sm d-md-inline">
            ☀️ Light Mode
        </button>
    </div>
    <div class="d-md-none text-center mb-3">
        <button id="theme-toggle" class="btn btn-outline-secondary btn-sm">🌙 Dark Mode</button>
    </div>
    <div class="container">
        <div class="mx-auto my-5 p-4 card shadow-sm" style="max-width:500px;">    
            <h1 class="mb-3">Register</h1>

            <?php if($login->getError()): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($login->getError()) ?>
                </div>
            <?php endif; ?>
            <?php if($login->getSuccess()): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($login->getSuccess()) ?>
                </div>
            <?php endif; ?>
            <form method="post" action="register.php" class="mb-3">
                <div class="mb-3">
                    <label for="login" class="form-label">Login</label>
                    <input type="text" class="form-control" id="login" name="login" required autocomplete="off">
                    <small class="login-hint text-muted d-flex align-items-center gap-1 mt-1">
                        <span>ⓘ</span>
                        Only letters and numbers.
                    </small>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <small class="text-muted d-flex align-items-center gap-1 mt-1 password-hint">
                        <span>ⓘ</span>
                        <span id="length" class="not-met smooth-transition">Minimum 8 chars</span>
                        <span id="ucase" class="not-met smooth-transition">Uppercase</span>
                        <span id="lcase" class="not-met smooth-transition">Lowercase</span>
                        <span id="number" class="not-met smooth-transition">Number</span>
                        <span id="special_character" class="not-met smooth-transition">Special character</span>
                    </small>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                </div>
                <button type="submit" class="btn btn-primary" disabled>Register</button>
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
    <script src="js/input_validation.js"></script>
</body>
</html>
