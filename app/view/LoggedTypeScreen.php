<?php
require_once "../../config/dbConnection.php";
require_once "../../app/model/User.php";
require_once "../../app/model/Animal.php";

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: LoginScreen.php");
    exit();
}

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
    $userModel = new User($pdo);
    $animalModel = new Animal($pdo);

    $user = $userModel->getUserById($_SESSION['user_id']);
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
    <link rel="stylesheet" href="css/LoggedTypeScreen.css">
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
                <img src="../../img/favorites-icon.png" alt="Favorites" class="favorites-icon">
                <a href="EditProfileScreen.php">
                    <img src="../../img/user-icon.png" alt="User" class="user-icon">
                </a>
                <span><?php echo htmlspecialchars($user['username'] ?? ''); ?></span>
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
                        <form action="AdoptScreen.php" method="get" style="display:inline;">
                            <input type="hidden" name="id_animal" value="<?php echo htmlspecialchars($animal['id']); ?>">
                            <button class="view-more" type="submit">Ver más</button>
                        </form> <img src="../../img/empty-like.png" alt="Paw" class="paw-icon">
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