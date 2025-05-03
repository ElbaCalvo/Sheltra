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

            <div class="amount-section">
                <label>¿Que cantidad desea donar?</label>
                <input type="number" class="amount-input" placeholder="Value">
            </div>

            <div class="card-details">
                <h3>Datos de la tarjeta</h3>

                <div class="form-group">
                    <label>Tarjeta bancaria:</label>
                    <input type="text" placeholder="Value">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Fecha caducidad:</label>
                        <input type="text" placeholder="Value">
                    </div>

                    <div class="form-group">
                        <label>CVV:</label>
                        <input type="text" placeholder="Value">
                    </div>
                </div>

                <button class="donate-button">Donar</button>
            </div>
        </div>
    </div>

</html>

<?php include 'Footer-2.php'; ?>