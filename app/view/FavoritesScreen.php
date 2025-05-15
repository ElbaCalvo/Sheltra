<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tus Favoritos</title>
    <link rel="stylesheet" href="css/favoritesScreen.css">
</head>

<body>
    <header>
        <div class="header-content">
            <a href="LoggedHomeScreen.php">
                <img src="../../img/sheltra-logo.png" alt="Sheltra" class="logo">
            </a>
            <div class="user-info">
                <a href="AnimalDataScreen.php" class="add-animal-link">
                    <img src="../../img/add-animal-empty.png" alt="Add" class="user-icon">
                </a>
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
                <h2>Tus favoritos</h2>

                <div class="favorites-list">
                    <div class="animal-card">
                        <div class="card-image">
                            <img src="../../img/placeholder.png" alt="Animal">
                        </div>
                        <div class="card-content">
                            <div class="content-header">
                                <div>
                                    <h3>Nombre de la animal</h3>
                                    <p class="animal-type">Tipo de animal</p>
                                </div>
                                <div class="paw-icon">
                                    <img src="../../img/empty-like.png" alt="Paw">
                                </div>
                            </div>
                            <p class="description">Descripción descripción descripción...</p>
                            <button class="view-more">Ver más</button>
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