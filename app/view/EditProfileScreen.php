<?php
session_start();
require_once "../../app/model/User.php";
require_once "../../config/dbConnection.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: LoginScreen.php");
    exit();
}

$errors = [];
$success = false;

$pdo = getDBConnection();

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    $user->setUsername(trim($_POST['username']));
    $user->setEmail(trim($_POST['email']));
    $user->setDni(trim($_POST['dni']));
    $user->setPhone(trim($_POST['phone']));
    $user->setAddress(trim($_POST['address']));
    $user->setBankAccount(trim($_POST['bank_acc']));


    if (!empty($_POST['password'])) {
        $user->setPassword(trim($_POST['password']));
    }

    if (empty($user->getUsername())) {
        $errors['username'] = "El nombre de usuario es obligatorio.";
    }

    if (empty($user->getEmail())) {
        $errors['email'] = "El correo electrónico es obligatorio.";
    } elseif (!filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "El correo electrónico no es válido.";
    }

    if (!empty($_POST['password']) && strlen($_POST['password']) < 8) {
        $errors['password'] = "La contraseña debe tener al menos 8 caracteres.";
    } elseif ($_POST['password'] !== $_POST['confirm_password']) {
        $errors['confirm_password'] = "Las contraseñas no coinciden.";
    }

    if (empty($user->getDni())) {
        $errors['dni'] = "El DNI es obligatorio.";
    } elseif (!preg_match('/^[0-9]{8}[A-Za-z]$/', $user->getDni())) {
        $errors['dni'] = "El DNI debe tener 8 números seguidos de una letra.";
    }
    if (empty($user->getPhone())) {
        $errors['phone'] = "El teléfono es obligatorio.";
    } elseif (!preg_match('/^[0-9]{9}$/', $user->getPhone())) {
        $errors['phone'] = "El teléfono debe tener exactamente 9 dígitos.";
    }

    if (empty($user->getAddress())) {
        $errors['address'] = "La dirección es obligatoria.";
    }

    if (empty($user->getBankAccount())) {
        $errors['bank_acc'] = "La cuenta bancaria es obligatoria.";
    } elseif (!preg_match('/^([A-Z]{2}[0-9]{2})(\s[0-9A-Z]{4}){1,7}$/', $user->getBankAccount())) {
        $errors['bank_acc'] = "La cuenta bancaria no es válida. Debe seguir el formato IBAN.";
    }

    // Si no hay errores, actualizar el perfil
    if (empty($errors)) {
        if ($user->profileUpdate($user_id)) {
            $_SESSION['success'] = "Perfil actualizado correctamente.";
            header("Location: EditProfileScreen.php");
            exit();
        } else {
            $errors['general'] = "Hubo un error al actualizar el perfil. Inténtalo de nuevo.";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="css/editProfileScreen.css">
</head>

<body>
    <header>
        <div class="header-content">
            <a href="LoggedHomeScreen.php">
                <img src="../../img/sheltra-logo.png" alt="Sheltra" class="logo">
            </a>
            <div class="user-info">
                <a href="EditProfileScreen.php">
                    <img src="../../img/user-icon.png" alt="User" class="user-icon">
                </a>
                <span><?php echo htmlspecialchars($user['username'] ?? ''); ?></span>
            </div>
        </div>
    </header>

    <div class="profile-container">
        <h2>Editar perfil</h2>
        <div class="edit-form">
            <form action="EditProfileScreen.php" method="POST">
                <div class="form-group full-width">
                    <label>Nombre de usuario</label>
                    <input type="text" name="username" placeholder="Juan" value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>">
                    <?php if (isset($errors['username'])): ?>
                        <p style="color: red; font-size: 0.8rem; margin-top: 0.5rem;"><?php echo $errors['username']; ?></p>
                        <?php endif; ?>
                </div>
                <div class="form-group full-width">
                    <label>Correo electrónico</label>
                    <input type="email" name="email" placeholder="juan@gmail.com" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>">
                    <?php if (isset($errors['email'])): ?>
                        <p style="color: red; font-size: 0.8rem; margin-top: 0.5rem;"><?php echo $errors['email']; ?></p>
                        <?php endif; ?>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" name="password" placeholder="••••••••">
                        <?php if (isset($errors['password'])): ?>
                            <p style="color: red; font-size: 0.8rem; margin-top: 0.5rem;"><?php echo $errors['password']; ?></p>
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
                <div class="form-group full-width">
                    <label>DNI/NIF</label>
                    <input type="text" name="dni" placeholder="11111111A" value="<?php echo htmlspecialchars($user['dni'] ?? ''); ?>">
                    <?php if (isset($errors['dni'])): ?>
                        <p style="color: red; font-size: 0.8rem; margin-top: 0.5rem;"><?php echo $errors['dni']; ?></p>
                        <?php endif; ?>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="tel" name="phone" placeholder="111 11 11 11" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
                        <?php if (isset($errors['phone'])): ?>
                            <p style="color: red; font-size: 0.8rem; margin-top: 0.5rem;"><?php echo $errors['phone']; ?></p>
                            <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" name="address" placeholder="Calle ejemplo, 123" value="<?php echo htmlspecialchars($user['address'] ?? ''); ?>">
                        <?php if (isset($errors['address'])): ?>
                            <p style="color: red; font-size: 0.8rem; margin-top: 0.5rem;"><?php echo $errors['address']; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group full-width">
                    <label>Cuenta bancaria</label>
                    <input type="text" name="bank_acc" placeholder="ES12 3456 7891 2345 6789" value="<?php echo htmlspecialchars($user['bank_acc'] ?? ''); ?>">
                    <?php if (isset($errors['bank_acc'])): ?>
                        <p style="color: red; font-size: 0.8rem; margin-top: 0.5rem;"><?php echo $errors['bank_acc']; ?></p>
                        <?php endif; ?>
                </div>
                <div class="button-group">
                    <button type="submit" class="save-button">Guardar</button>
                    <button type="button" class="logout-button">Cerrar sesión</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

<?php include 'Footer.php'; ?>