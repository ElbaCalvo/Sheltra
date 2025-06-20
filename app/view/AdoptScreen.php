<?php
session_start();
require_once "../../config/dbConnection.php";
require_once "../../app/controller/AnimalController.php";
require_once "../../app/controller/UserController.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: LoginScreen.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['animal_id'])) {
    $animalController = new AnimalController();
    if (isset($_POST['remove_favorite'])) {
        $animalController->removeFavorite($_SESSION['user_id'], $_POST['animal_id']);
    } else {
        $animalController->addFavorite($_SESSION['user_id'], $_POST['animal_id']);
    }
    header("Location: AdoptScreen.php?id_animal=" . urlencode($_GET['id_animal'] ?? '') . "&page=" . ($_GET['page'] ?? 1));
    exit();
}

$userController = new UserController();
$animalController = new AnimalController();

$user = $userController->getUserById($_SESSION['user_id']);

$id_animal = $_GET['id_animal'] ?? null;
$animal = $id_animal ? $animalController->getAnimalById($id_animal) : null;

$publisher = null;
if ($animal && !empty($animal['id_user'])) {
    $publisher = $userController->getUsernameAndAddress($animal['id_user']);
}

$type = $animal['type'] ?? null;
$id_actual = $animal['id'] ?? null;

if ($type) {
    $allAnimals = $animalController->getAnimalsByTypeExcept($type, $id_actual);
} else {
    $allAnimals = $animalController->getAllAnimalsOrdered();
}

$userFavorites = array_column($animalController->getFavorites($_SESSION['user_id']), 'id');
$total = count($allAnimals);
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$perPage = 3;
$offset = ($page - 1) * $perPage;
$animalsPage = array_slice($allAnimals, $offset, $perPage);
?>

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
            <div class="animal-detail">
                <div class="detail-grid">
                    <div>
                        <img src="<?php echo htmlspecialchars($animal['foto'] ?? '../../img/placeholder.png'); ?>" alt="Animal" class="animal-image-container">
                    </div>
                    <div class="animal-info">
                        <div class="info-header">
                            <h1><?php echo htmlspecialchars($animal['name'] ?? 'Nombre de la mascota'); ?></h1>
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
                        <p class="location">
                            <?php
                            echo !empty($publisher['address'])
                                ? htmlspecialchars($publisher['address'])
                                : 'Ubicación no proporcionada';
                            ?>
                        </p>
                        </p>
                        <p class="description"><?php echo htmlspecialchars($animal['description'] ?? 'Sin descripción'); ?></p>
                        <div class="additional-info">
                            <h3>Información adicional:</h3>
                            <ul>
                                <li>Edad:</li>
                                <div><?php echo htmlspecialchars($animal['age'] ?? ''); ?></div>
                                <li>Tamaño:</li>
                                <div><?php echo htmlspecialchars($animal['size'] ?? ''); ?></div>
                                <li>Sexo:</li>
                                <div><?php echo htmlspecialchars($animal['sex'] ?? ''); ?></div>
                                <li>Fecha ingreso:</li>
                                <div><?php echo htmlspecialchars($animal['entry_date'] ?? ''); ?></div>
                            </ul>
                        </div>
                        <form action="QuestionnaireScreen.php" method="get" style="display:inline;">
                            <input type="hidden" name="id_animal" value="<?php echo htmlspecialchars($animal['id']); ?>">
                            <button class="adopt-button" type="submit">Adoptar</button>
                        </form>
                    </div>
                </div>

                <div class="user-info-section">
                    <img src="../../img/user-icon.png" alt="User" class="user-avatar">
                    <span>
                        <?php
                        if (!empty($publisher['username'])) {
                            echo "Subido por " . htmlspecialchars($publisher['username']);
                        } else {
                            echo "Subido por usuario desconocido";
                        }
                        ?>
                    </span>
                </div>

                <div class="related-section">
                    <h2>También te pueden interesar:</h2>
                    <div class="carousel" id="carousel">
                        <button class="carousel-button prev"
                            <?php if ($page <= 1) echo 'disabled'; ?>
                            onclick="window.location.href='AdoptScreen.php?id_animal=<?php echo urlencode($animal['id']); ?>&page=<?php echo $page - 1; ?>#carousel'">‹</button>
                        <div class="carousel-items">
                            <div class="animals-grid">
                                <?php foreach ($animalsPage as $a): ?>
                                    <div class="animal-card">
                                        <img src="<?php echo htmlspecialchars($a['foto'] ?? '../../img/placeholder.png'); ?>" alt="Animal" class="animal-image">
                                        <h3><?php echo htmlspecialchars($a['name']); ?></h3>
                                        <p><?php echo htmlspecialchars($a['type']); ?></p>
                                        <div class="card-footer">
                                            <form action="AdoptScreen.php" method="get" style="display:inline;">
                                                <input type="hidden" name="id_animal" value="<?php echo htmlspecialchars($a['id']); ?>">
                                                <button class="view-more" type="submit">Ver más</button>
                                            </form>
                                            <div class="paw-icon">
                                                <form method="post" style="display:inline;">
                                                    <input type="hidden" name="animal_id" value="<?php echo htmlspecialchars($a['id']); ?>">
                                                    <?php if (in_array($a['id'], $userFavorites)): ?>
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
                            </div>
                        </div>
                        <button class="carousel-button next"
                            <?php if ($offset + $perPage >= $total) echo 'disabled'; ?>
                            onclick="window.location.href='AdoptScreen.php?id_animal=<?php echo urlencode($animal['id']); ?>&page=<?php echo $page + 1; ?>#carousel'">›</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="side-panel"></div>
    </div>

</html>

<?php include 'Footer-2.php'; ?>