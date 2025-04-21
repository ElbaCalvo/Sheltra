<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="stylesheet" href="css/registerScreen.css">
</head>

<body>
    <header>
        <img src="../../img/sheltra-logo.png" alt="Sheltra" class="logo">
    </header>

    <div class="register-container">
        <h2>¡Bienvenido/a!</h2>
        <div class="register-box">
            <div class="register-content">
                <div class="form-side">
                    <form action="register.php" method="POST">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Nombre de usuario</label>
                                <input type="text" name="username" placeholder="María">
                            </div>
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input type="tel" name="phone" placeholder="111 11 11 11">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Correo electrónico</label>
                                <input type="email" name="email" placeholder="maria1234@gmail.com">
                            </div>
                            <div class="form-group">
                                <label>Contraseña</label>
                                <input type="password" name="password" placeholder="••••••••">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>DNI/NIF</label>
                                <input type="text" name="dni" placeholder="11111111A">
                            </div>
                            <div class="form-group">
                                <label>Confirma contraseña</label>
                                <input type="password" name="confirm_password" placeholder="••••••••">
                            </div>
                        </div>
                        <button type="submit" class="login-button">Registrarme</button>
                        <div class="login-link">
                            <span>Ya tienes cuenta?</span>
                            <a href="LoginScreen.php">Inicia sesión</a>
                        </div>
                    </form>
                </div>
                <div class="welcome-side"></div>
            </div>
        </div>
    </div>
</body>

</html>