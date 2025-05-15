<?php
require_once "../../config/dbConnection.php";
require_once "../../app/model/Animal.php";

$type = isset($_GET['type']) ? htmlspecialchars($_GET['type']) : 'Desconocido';

$typeImages = [
    'gato' => '../../img/cats-banner.jpg',
    'perro' => '../../img/dogs-banner.jpg',
    'ave' => '../../img/birds-banner.jpg',
    'pez' => '../../img/fishes-banner.jpg',
    'reptil' => '../../img/reptiles-banner.jpg',
    'roedor' => '../../img/rodents-banner.jpg',
];

$typeImage = $typeImages[$type] ?? '../../img/default-banner.jpg';

try {
    $pdo = getDBConnection();
    $animalModel = new Animal($pdo);
    $animals = $animalModel->getByType($type);
} catch (PDOException $e) {
    die("Error al obtener los animales: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sheltra - Inicio</title>
    <link rel="stylesheet" href="css/typeScreen.css">
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

    <div class="animal-type-header">
        <img src="<?php echo $typeImage; ?>" alt="<?php echo ucfirst($type); ?>">
    </div>

    <h2 class="animal-type-title"><?php echo ucfirst($type); ?></h2>

    <div class="animals-grid">
        <?php if (!empty($animals)): ?>
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
        <?php else: ?>
            <p>No hay animales disponibles de este tipo en este momento.</p>
        <?php endif; ?>
    </div>
    </div>
</body>

</html>

<?php include 'Footer.php'; ?>