<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tus Favoritos</title>
    <link rel="stylesheet" href="css/loggedAllAnimalsScreen.css">
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
            <div class="favorites-container">
                <h2>Todos nuestros animales</h2>

                <div class="animals-grid">
                    <div class="animal-card">
                        <img src="../../img/placeholder.png" alt="Animal" class="animal-image">
                        <h3>Nombre del animal</h3>
                        <p>Tipo de animal</p>
                        <div class="card-footer">
                            <button class="view-more">Ver más</button>
                            <img src="../../img/empty-like.png" alt="Paw" class="paw-icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="side-panel"></div>
    </div>
</body>

</html>

<?php include 'Footer-2.php'; ?>