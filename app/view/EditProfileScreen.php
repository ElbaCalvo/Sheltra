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

$userModel = new User($pdo);
$user = $userModel->getUserById($_SESSION['user_id']);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $dni = trim($_POST['dni']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');
    $address = trim($_POST['address'] ?? '');

    $userObj = new User($pdo);
    $userObj->setUsername($username);
    $userObj->setEmail($email);
    $userObj->setDni($dni);
    $userObj->setPhone($phone);
    $userObj->setPassword($password);
    $userObj->setAddress($address);

    $errors = User::validateRegister($username, $phone, $email, $password, $confirm_password, $dni);

    if (empty($errors)) {
        if ($userObj->emailExistsEdit()) {
            $errors['email'] = "El correo electrónico ya está registrado.";
        }
    }

    if (empty($errors)) {
        if ($userObj->profileUpdate($_SESSION['user_id'])) {
            $_SESSION['success'] = "Perfil actualizado correctamente.";
            header("Location: EditProfileScreen.php");
            exit();
        } else {
            $errors['general'] = "Hubo un error al actualizar el perfil. Inténtalo de nuevo.";
        }
    }
}

if (isset($_POST['logout'])) {
    $userModel = new User($pdo);
    $userModel->userLogout();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['delete_account'])) {
    $userModel = new User($pdo);
    if ($userModel->deleteUser($user_id)) {
        session_destroy();
        header("Location: RegisterScreen.php");
        exit();
    } else {
        $errors['general'] = "No se pudo eliminar la cuenta. Inténtalo de nuevo.";
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
                <div class="button-group">
                    <button type="submit" class="save-button">Guardar</button>
                    <div class="red-buttons">
                        <form method="post" style="display:inline;">
                            <button type="submit" name="logout" class="logout-button">Cerrar sesión</button>
                        </form>
                        <form method="post" style="display:inline;" onsubmit="return confirm('¿Seguro que quieres eliminar tu cuenta? Esta acción no se puede deshacer.');">
                            <button type="submit" name="delete_account" class="delete-button">Eliminar cuenta</button>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

<?php include 'Footer.php'; ?>