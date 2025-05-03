<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sheltra - Inicio</title>
    <link rel="stylesheet" href="css/AdoptScreen.css">
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
            <div class="animal-detail">
                <div class="detail-grid">
                    <div>
                        <img src="../../img/placeholder.png" alt="Animal" class="animal-image-container">
                    </div>
                    <div class="animal-info">
                        <div class="info-header">
                            <h1>Nombre de la mascota</h1>
                            <img src="../../img/empty-like.png" alt="Favorite" class="favorite-icon">
                        </div>
                        <p class="location">Localidad</p>
                        <p class="description">Descripción descripción descripción descripción descripción descripción descripción descripción descripción descripción descripción descripción descripción descripción...</p>

                        <div class="additional-info">
                            <h3>Información adicional:</h3>
                            <ul>
                                <li>Edad:</li>
                                <div> 2 años</div>
                                <li>Tamaño:</li>
                                <div> Pequeño</div>
                                <li>Sexo:</li>
                                <div> Macho</div>
                                <li>Fecha ingreso:</li>
                                <div> 01/05/2025</div>
                            </ul>
                        </div>

                        <button class="adopt-button">Adoptar</button>
                    </div>
                </div>

                <div class="user-info-section">
                    <img src="../../img/user-icon.png" alt="User" class="user-avatar">
                    <span>Nombre de usuario</span>
                </div>

                <div class="related-section">
                    <h2>También te pueden interesar:</h2>
                    <div class="carousel">
                        <button class="carousel-button prev">‹</button>
                        <div class="carousel-items">
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
                                <div class="animal-card">
                                    <img src="../../img/placeholder.png" alt="Animal" class="animal-image">
                                    <h3>Nombre de la animal</h3>
                                    <p>Tipo de animal</p>
                                    <div class="card-footer">
                                        <button class="view-more">Ver más</button>
                                        <img src="../../img/empty-like.png" alt="Paw" class="paw-icon">
                                    </div>
                                </div>
                                <div class="animal-card">
                                    <img src="../../img/placeholder.png" alt="Animal" class="animal-image">
                                    <h3>Nombre de la animal</h3>
                                    <p>Tipo de animal</p>
                                    <div class="card-footer">
                                        <button class="view-more">Ver más</button>
                                        <img src="../../img/empty-like.png" alt="Paw" class="paw-icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-button next">›</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="side-panel"></div>
    </div>

</html>

<?php include 'Footer-2.php'; ?>