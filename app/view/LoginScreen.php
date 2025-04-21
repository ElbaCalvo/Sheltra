<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="css/loginScreen.css">
</head>

<body>
    <header>
        <img src="../../img/sheltra-logo.png" alt="Sheltra" class="logo">
    </header>

    <div class="login-container">
        <h2>¡Hola de nuevo!</h2>
        <div class="login-box">
            <div class="login-content">
                <div class="form-side">
                    <form action="signInScreen.php" method="POST">
                        <div class="form-group">
                            <label>Correo electrónico</label>
                            <input type="email" name="email" placeholder="juan123@gmail.com">
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" name="password" placeholder="••••••••">
                        </div>
                        <button type="submit" class="login-button">Iniciar sesión</button>
                        <div class="register-link">
                            <span>No tienes cuenta?</span>
                            <a href="register.html">Registrate</a>
                        </div>
                    </form>
                </div>
                <div class="welcome-side"></div>
            </div>
        </div>
    </div>
</body>

</html>