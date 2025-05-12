<?php
session_start();
require_once "../../config/dbConnection.php";
require_once "../../app/model/Donations.php";

// Verifica que el usuario esté logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: LoginScreen.php");
    exit();
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'] ?? '';
    $id_shelter = $_POST['id_shelter'] ?? $_GET['id_shelter'] ?? '';
    $card_number = $_POST['card_number'] ?? '';
    $expiry = $_POST['expiry'] ?? '';
    $cvv = $_POST['cvv'] ?? '';

    $iban_pattern = '/^ES\d{2}(?:\s?\d{4}){5}$/';

    if ($amount <= 0) {
        $errors['amount'] = "Introduce una cantidad válida.";
    }
    if (!preg_match($iban_pattern, $card_number)) {
        $errors['card_number'] = "El número de cuenta debe ser un IBAN español válido.";
    }
    if (!preg_match('/^\d{3,4}$/', $cvv)) {
        $errors['cvv'] = "El CVV debe tener 3 o 4 dígitos.";
    }

    if (preg_match('/^(0[1-9]|1[0-2])\/\d{2}$/', $expiry, $matches)) {
        $month = (int)substr($expiry, 0, 2);
        $year = (int)substr($expiry, 3, 2) + 2000;
        $now = new DateTime();
        $exp = DateTime::createFromFormat('Y-m', "$year-$month");
        $exp->modify('last day of this month');
        if ($exp < $now) {
            $errors['expiry'] = "La fecha de caducidad no puede ser anterior a la actual.";
        }
    } else {
        $errors['expiry'] = "Formato de fecha de caducidad inválido. Usa MM/YY.";
    }

    if (empty($errors) && !empty($id_shelter)) {
        try {
            $pdo = getDBConnection();
            $donations = new Donations($pdo);
            $result = $donations->create($_SESSION['user_id'], $id_shelter, $amount);
            if ($result) {
                header("Location: PaymentScreen.php?success=1&id_shelter=" . urlencode($id_shelter));
                exit();
            } else {
                $errors['general'] = "Error al guardar la donación.";
            }
        } catch (PDOException $e) {
            $errors['general'] = "Error al guardar la donación: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sheltra - Inicio</title>
    <link rel="stylesheet" href="css/paymentScreen.css">
</head>

<body>
    <header>
        <div class="header-content">
            <a href="LoggedHomeScreen.php">
                <img src="../../img/sheltra-logo.png" alt="Sheltra" class="logo">
            </a>
            <div class="user-info">
                <img src="../../img/favorites-icon.png" alt="Favorites" class="favorites-icon">
                <a href="EditProfileScreen.php">
                    <img src="../../img/user-icon.png" alt="User" class="user-icon">
                </a>
                <span><?php echo htmlspecialchars($user['username'] ?? ''); ?></span>
            </div>
        </div>
    </header>

    <div class="payment-container">
        <div class="payment-form">
            <h2>Pago</h2>
            <?php if (!empty($success)): ?>
                <div class="success-message"><?php echo $success; ?></div>
            <?php endif; ?>
            <?php if (!empty($error)): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if (!empty($_GET['success'])): ?>
                <div class="success-message" style="display:flex;align-items:center;gap:8px;">
                    <span style="color:#388e3c;font-size:1.5em;">&#10003;</span>
                    <span>Pago realizado, ¡muchas gracias!</span>
                </div>
            <?php endif; ?>
            <form method="post">
                <div class="amount-section">
                    <label>¿Que cantidad desea donar?</label>
                    <input type="number" name="amount" class="amount-input" placeholder="Value" min="1" required value="<?php echo htmlspecialchars($_POST['amount'] ?? ''); ?>">
                    <?php if (!empty($errors['amount'])): ?>
                        <div class="input-error"><?php echo $errors['amount']; ?></div>
                    <?php endif; ?>
                </div>
                    <input type="hidden" name="id_shelter" value="<?php echo htmlspecialchars($_POST['id_shelter'] ?? $_GET['id_shelter'] ?? ''); ?>">                <div class="card-details">
                    <h3>Datos de la tarjeta</h3>
                    <div class="form-group">
                        <label>Tarjeta bancaria:</label>
                        <input type="text" name="card_number" placeholder="ES00 0000 0000 0000 0000 0000" required value="<?php echo htmlspecialchars($_POST['card_number'] ?? ''); ?>">
                        <?php if (!empty($errors['card_number'])): ?>
                            <div class="input-error"><?php echo $errors['card_number']; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Fecha caducidad:</label>
                            <input type="text" name="expiry" required value="<?php echo htmlspecialchars($_POST['expiry'] ?? ''); ?>">
                            <?php if (!empty($errors['expiry'])): ?>
                                <div class="input-error"><?php echo $errors['expiry']; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>CVV:</label>
                            <input type="text" name="cvv" placeholder="CVV" required value="<?php echo htmlspecialchars($_POST['cvv'] ?? ''); ?>">
                            <?php if (!empty($errors['cvv'])): ?>
                                <div class="input-error"><?php echo $errors['cvv']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <button class="donate-button" type="submit">Donar</button>
                    <?php if (!empty($errors['general'])): ?>
                        <div class="input-error"><?php echo $errors['general']; ?></div>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

</html>

<?php include 'Footer-2.php'; ?>