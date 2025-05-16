<?php
session_start();
require_once "../../app/controller/UserController.php";
require_once "../../config/dbConnection.php";

try {
    $pdo = getDBConnection();
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

$errors = [];
$user_name = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $dni = trim($_POST['dni']);
    $address = trim($_POST['address']);

    $userController = new UserController();

    $errors = User::validateRegister($username, $phone, $email, $password, $confirm_password, $dni, $address);

    if (empty($errors)) {
        if ($userController->emailExists($email)) {
            $errors['email'] = "El correo electrónico ya está registrado.";
        }
    }

    if (empty($errors)) {
        if ($userController->addUser($username, $email, $password, $dni, $phone, $address)) {
            $_SESSION['success'] = "Registro exitoso. Ahora puedes iniciar sesión.";
            header("Location: LoginScreen.php");
            exit();
        } else {
            $errors['general'] = "Hubo un error al registrar el usuario. Inténtalo de nuevo.";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="stylesheet" href="css/registerScreen.css">
</head>

<body>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <header>
        <div class="header-content">
            <img src="../../img/sheltra-logo.png" alt="Sheltra" class="logo">
        </div>
    </header>

    <div class="register-container">
        <h2>¡Bienvenido/a!</h2>
        <div class="register-box">
            <div class="register-content">
                <div class="form-side">
                    <form action="RegisterScreen.php" method="POST">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Nombre de usuario</label>
                                <input type="text" name="username" placeholder="María" value="<?php echo htmlspecialchars($user_name ?? ''); ?>">                                <?php if (isset($errors['username'])): ?>
                                    <p style="color: red; font-size: 0.8rem; margin-top: 0.5rem;"><?php echo $errors['username']; ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input type="tel" name="phone" placeholder="111 11 11 11" value="<?php echo htmlspecialchars($phone ?? ''); ?>">
                                <?php if (isset($errors['phone'])): ?>
                                    <p style="color: red; font-size: 0.8rem; margin-top: 0.5rem;"><?php echo $errors['phone']; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Correo electrónico</label>
                                <input type="email" name="email" placeholder="maria1234@gmail.com" value="<?php echo htmlspecialchars($email ?? ''); ?>">
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
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>DNI/NIF</label>
                                <input type="text" name="dni" placeholder="11111111A" value="<?php echo htmlspecialchars($dni ?? ''); ?>">
                                <?php if (isset($errors['dni'])): ?>
                                    <p style="color: red; font-size: 0.8rem; margin-top: 0.5rem;"><?php echo $errors['dni']; ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>Confirma contraseña</label>
                                <input type="password" name="confirm_password" placeholder="••••••••">
                                <?php if (isset($errors['confirm_password'])): ?>
                                    <p style="color: red; font-size: 0.8rem; margin-top: 0.5rem;"><?php echo $errors['confirm_password']; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Dirección</label>
                                <input type="text" name="address" placeholder="Calle Ejemplo 123" value="<?php echo htmlspecialchars($address ?? ''); ?>">
                                <?php if (isset($errors['address'])): ?>
                                    <p style="color: red; font-size: 0.8rem; margin-top: 0.5rem;"><?php echo $errors['address']; ?></p>
                                <?php endif; ?>
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

<?php include 'Footer.php'; ?>