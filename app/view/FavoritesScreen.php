<?php
require_once "../../config/dbConnection.php";
require_once "../../app/controller/AnimalController.php";
require_once "../../app/controller/UserController.php";

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: LoginScreen.php");
    exit();
}

$animalController = new AnimalController();
$userController = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['animal_id'])) {
    if (isset($_POST['remove_favorite'])) {
        $animalController->removeFavorite($_SESSION['user_id'], $_POST['animal_id']);
    } else {
        $animalController->addFavorite($_SESSION['user_id'], $_POST['animal_id']);
    }
    header("Location: FavoritesScreen.php");
    exit();
}

try {
    $user = $userController->getUserById($_SESSION['user_id']);
    $animals = $animalController->getFavorites($_SESSION['user_id']);
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
                <?php if (empty($animals)): ?>
                    <p>No tienes animales favoritos aún.</p>
                <?php else: ?>
                    <?php foreach ($animals as $animal): ?>
                        <div class="animal-card">
                            <div class="card-image">
                                <img src="<?php echo htmlspecialchars($animal['foto'] ?? '../../img/placeholder.png'); ?>" alt="Animal">
                            </div>
                            <div class="card-content">
                                <div class="content-header">
                                    <div>
                                        <h3><?php echo htmlspecialchars($animal['name']); ?></h3>
                                        <p class="animal-type"><?php echo htmlspecialchars($animal['type']); ?></p>
                                    </div>
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
                                <p class="description"><?php echo htmlspecialchars($animal['description']); ?></p>
                                <form action="AdoptScreen.php" method="get" style="display:inline;">
                                    <input type="hidden" name="id_animal" value="<?php echo htmlspecialchars($animal['id']); ?>">
                                    <button class="view-more" type="submit">Ver más</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="side-panel"></div>
</div>
</body>

</html>

<?php include 'Footer-2.php'; ?>