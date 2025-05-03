<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sheltra - Inicio</title>
    <link rel="stylesheet" href="css/DonateScreen.css">
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

    <div class="page-content">
        <div class="side-panel"></div>
        <div class="main-content">
            <div class="hero-section">
                <div class="hero-text">
                    <h1>DONACIONES</h1>
                    <p>Aunque no puedas adoptar, aún puedes cambiar vidas.<br>Conoce a los refugios que lo dan todo por ellos.</p>
                </div>
            </div>

            <div class="shelters-grid">
                <div class="shelter-card">
                    <div class="shelter-image">
                        <img src="../../img/placeholder.png" alt="Refugio">
                    </div>
                    <h3>Nombre del refugio</h3>
                    <button class="donate-button">Donar</button>
                </div>
            </div>
        </div>
        <div class="side-panel"></div>
    </div>

</html>

<?php include 'Footer-2.php'; ?>