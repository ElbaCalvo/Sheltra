<?php
session_start();

require_once "../../app/model/User.php";
require_once "../../config/dbConnection.php";

$host = 'localhost';
$dbname = 'sheltra';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validar campos vacíos
    if (empty($email)) {
        $errors['email'] = "El correo electrónico es obligatorio.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "El correo electrónico no es válido.";
    }

    if (empty($password)) {
        $errors['password'] = "La contraseña es obligatoria.";
    }

    if (empty($errors)) {
        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);

        if ($user->checkUsuario()) {
            $_SESSION['user_id'] = $user->getId(); 
            $_SESSION['user_name'] = $user->getUsername(); 

            header("Location: LoggedHomeScreen.php");
            exit();
        } else {
            $errors['general'] = "Correo electrónico o contraseña incorrectos.";
        }
    }
}
?>

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
        <div class="header-content">
            <img src="../../img/sheltra-logo.png" alt="Sheltra" class="logo">
        </div>
    </header>

    <div class="login-container">
        <h2>¡Hola de nuevo!</h2>
        <div class="login-box">
            <div class="login-content">
                <div class="form-side">
                    <form action="LoginScreen.php" method="POST">
                        <div class="form-group">
                            <label>Correo electrónico</label>
                            <input type="email" name="email" placeholder="juan123@gmail.com" value="<?php echo htmlspecialchars($email ?? ''); ?>">
                            <?php if (isset($errors['email'])): ?>
                                <p style="color: red; font-size: 0.8rem; margin-top: 0.5rem;"><?php echo $errors['email']; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" name="password" placeholder="••••••••">
                            <?php if (isset($errors['password'])): ?>
                                <p style="color: red; font-size: 0.8rem; margin-top: 0.5rem;"><?php echo $errors['password']; ?></p>
                            <?php endif; ?>
                        </div>
                        <?php if (isset($errors['general'])): ?>
                            <p style="color: red; font-size: 0.8rem; margin-top: 0.5rem;"><?php echo $errors['general']; ?></p>
                        <?php endif; ?>
                        <button type="submit" class="login-button">Iniciar sesión</button>
                        <div class="register-link">
                            <span>¿No tienes cuenta?</span>
                            <a href="RegisterScreen.php">Regístrate</a>
                        </div>
                    </form>
                </div>
                <div class="welcome-side"></div>
            </div>
        </div>
    </div>
</body>

</html>

<?php include 'Footer.php'; ?>