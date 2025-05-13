<?php
session_start();
require_once "../../config/dbConnection.php";
require_once "../../app/model/Animal.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: LoginScreen.php");
    exit();
}

$pdo = getDBConnection();
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$id_animal = $_GET['id_animal'] ?? null;
$animal = null;
if ($id_animal) {
    $animalModel = new Animal($pdo);
    $animal = $animalModel->getById($id_animal);
}

$publisher = null;
if ($animal && !empty($animal['id_user'])) {
    $stmt = $pdo->prepare("SELECT username, address FROM users WHERE id = :id");
    $stmt->bindParam(':id', $animal['id_user']);
    $stmt->execute();
    $publisher = $stmt->fetch(PDO::FETCH_ASSOC);
}

$type = $animal['type'] ?? null;
$id_actual = $animal['id'] ?? null;

if ($type) {
    // Muestra todos los animales del mismo tipo, excepto el actual, ordenados por fecha de ingreso descendente
    $stmt = $pdo->prepare("SELECT * FROM animals WHERE type = :type AND id != :id_actual ORDER BY entry_date DESC");
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':id_actual', $id_actual);
    $stmt->execute();
    $allAnimals = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $total = count($allAnimals);

    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $perPage = 3;
    $offset = ($page - 1) * $perPage;
    $animalsPage = array_slice($allAnimals, $offset, $perPage);
} else {
    // Si no hay tipo, muestra todos ordenados por fecha de ingreso descendente
    $stmt = $pdo->query("SELECT * FROM animals ORDER BY entry_date DESC");
    $allAnimals = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $total = count($allAnimals);

    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $perPage = 3;
    $offset = ($page - 1) * $perPage;
    $animalsPage = array_slice($allAnimals, $offset, $perPage);
}
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
                        <img src="<?php echo htmlspecialchars($animal['foto'] ?? '../../img/placeholder.png'); ?>" alt="Animal" class="animal-image-container">
                    </div>
                    <div class="animal-info">
                        <div class="info-header">
                            <h1><?php echo htmlspecialchars($animal['name'] ?? 'Nombre de la mascota'); ?></h1>
                            <img src="../../img/empty-like.png" alt="Favorite" class="favorite-icon">
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
                                            <img src="../../img/empty-like.png" alt="Paw" class="paw-icon">
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