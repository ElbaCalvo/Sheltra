<?php

session_start();

// Configuración de la base de datos
$host = 'localhost';
$dbname = 'sheltra';
$username = 'root';
$password = '';

try {
    // Conexión a la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

// Inicializar array de errores
$errors = [];
$user_name = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $dni = trim($_POST['dni']);

    // Validar campos vacíos
    if (empty($username)) {
        $errors['username'] = "El nombre de usuario es obligatorio.";
    } elseif (strlen($username) > 10) {
        $errors['username'] = "El nombre no puede tener más de 10 caracteres.";
    }

    if (empty($phone)) {
        $errors['phone'] = "El teléfono es obligatorio.";
    } elseif (!preg_match('/^[0-9]{9}$/', $phone)) {
        $errors['phone'] = "El teléfono debe tener exactamente 9 dígitos.";
    }

    if (empty($email)) {
        $errors['email'] = "El correo electrónico es obligatorio.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "El correo electrónico no es válido.";
    }

    if (empty($password)) {
        $errors['password'] = "La contraseña es obligatoria.";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "La contraseña debe tener al menos 8 caracteres.";
    }

    if (empty($confirm_password)) {
        $errors['confirm_password'] = "Debes confirmar la contraseña.";
    } elseif ($password !== $confirm_password) {
        $errors['confirm_password'] = "Las contraseñas no coinciden.";
    }

    if (empty($dni)) {
        $errors['dni'] = "El DNI es obligatorio.";
    } elseif (!preg_match('/^[0-9]{8}[A-Za-z]$/', $dni)) {
        $errors['dni'] = "El DNI debe tener 8 números seguidos de una letra.";
    }

    // Si no hay errores, procesar el registro
    if (empty($errors)) {
        // Verificar si el correo ya está registrado
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $errors['email'] = "El correo electrónico ya está registrado.";
        } else {
            // Encriptar la contraseña
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insertar el usuario en la base de datos
            $stmt = $pdo->prepare("INSERT INTO users (username, phone, email, password, dni) VALUES (:username, :phone, :email, :password, :dni)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':dni', $dni);

            if ($stmt->execute()) {
                // Registro exitoso, redirigir al login
                $_SESSION['success'] = "Registro exitoso. Ahora puedes iniciar sesión.";
                header("Location: LoginScreen.php");
                exit();
            } else {
                $errors['general'] = "Hubo un error al registrar el usuario. Inténtalo de nuevo.";
            }
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