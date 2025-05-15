<?php
require_once "../../config/dbConnection.php";
require_once "../../app/model/Animal.php";
require_once "../../app/model/User.php";

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: LoginScreen.php");
    exit();
}

try {
    $pdo = getDBConnection();
    $userModel = new User($pdo);
    $animalModel = new Animal($pdo);

    $user = $userModel->getUserById($_SESSION['user_id']);
    $animals = $animalModel->getAll();
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
    <link rel="stylesheet" href="css/loggedAllAnimalsScreen.css">
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
                                <form action="AdoptScreen.php" method="get" style="display:inline;">
                                    <input type="hidden" name="id_animal" value="<?php echo htmlspecialchars($animal['id']); ?>">
                                    <button class="view-more" type="submit">Ver más</button>
                                </form>
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