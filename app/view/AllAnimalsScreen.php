<?php
require_once "../../config/dbConnection.php";
require_once "../../app/controller/AnimalController.php";

try {
    $animalController = new AnimalController();
    $animals = $animalController->getAllAnimals();
} catch (PDOException $e) {
    die("Error al obtener los animales: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tus Favoritos</title>
    <link rel="stylesheet" href="css/allAnimalsScreen.css">
</head>

<body>
    <header>
        <div class="header-content">
            <a href="HomeScreen.php">
                <img src="../../img/sheltra-logo.png" alt="Sheltra" class="logo">
            </a>
            <div class="auth-buttons">
                <a href="LoginScreen.php">
                    <button class="sign-in">Sign in</button>
                </a>
                <a href="RegisterScreen.php">
                    <button class="register">Register</button>
                </a>
            </div>
        </div>
    </header>

    <div class="page-content">
        <div class="side-panel"></div>
        <div class="main-content">
            <div class="animals-container">
                <h2>Todos nuestros animales</h2>

                <div class="animals-grid">
                    <?php foreach ($animals as $animal): ?>
                        <div class="animal-card">
                        <img src="<?php echo htmlspecialchars($animal['foto']); ?>" alt="Animal" class="animal-image">
                            <h3><?php echo htmlspecialchars($animal['name']); ?></h3>
                            <p class="limited-description"><?php echo htmlspecialchars($animal['description']); ?></p>
                            <div class="card-footer">
                                <a href="LoginScreen.php">
                                    <button class="view-more">Ver más</button>
                                </a>
                                <img src="../../img/empty-like.png" alt="Paw" class="paw-icon">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="side-panel"></div>
    </div>
</body>

</html>

<?php include 'Footer-2.php'; ?>