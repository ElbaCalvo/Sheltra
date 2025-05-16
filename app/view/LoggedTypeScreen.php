<?php
require_once "../../config/dbConnection.php";
require_once "../../app/controller/UserController.php";
require_once "../../app/controller/AnimalController.php";

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

$animalController = new AnimalController();
$userController = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['animal_id'])) {
    if (isset($_POST['remove_favorite'])) {
        $animalController->removeFavorite($_SESSION['user_id'], $_POST['animal_id']);
    } else {
        $animalController->addFavorite($_SESSION['user_id'], $_POST['animal_id']);
    }
    header("Location: LoggedTypeScreen.php?type=" . urlencode($type));
    exit();
}

try {
    $user = $userController->getUserById($_SESSION['user_id']);
    $animals = $animalController->getAnimalsByType($type);
    $userFavorites = array_column($animalController->getFavorites($_SESSION['user_id']), 'id');
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
                <a href="FavoritesScreen.php">
                    <img src="../../img/favorites-icon.png" alt="Favorites" class="favorites-icon">
                </a>
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
                        </form>
                        <div class="paw-icon">
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="animal_id" value="<?php echo htmlspecialchars($animal['id']); ?>">
                                <?php if (in_array($animal['id'], $userFavorites)): ?>
                                    <button type="submit" name="remove_favorite" style="background:none;border:none;padding:0;">
                                        <img src="../../img/like.png" alt="Like">
                                    </button>
                                <?php else: ?>
                                    <button type="submit" style="background:none;border:none;padding:0;">
                                        <img src="../../img/empty-like.png" alt="Like">
                                    </button>
                                <?php endif; ?>
                            </form>
                        </div>
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