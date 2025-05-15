<?php
require_once "../../config/dbConnection.php";
require_once "../../app/model/User.php";
require_once "../../app/model/Donations.php";

session_start();

if (!isset($_SESSION['user_id'])) { // Comprobar que el usuario ha iniciado sesión
    header("Location: LoginScreen.php");
    exit();
}

try {
    $pdo = getDBConnection();

    // Obtener el usuario
    $userModel = new User($pdo);
    $user = $userModel->getUserById($_SESSION['user_id']);

    // Obtener todos los refugios
    $donationsModel = new Donations($pdo);
    $shelters = $donationsModel->getAllShelters();
} catch (PDOException $e) {
    die("Error al obtener los datos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sheltra - Inicio</title>
    <link rel="stylesheet" href="css/DonateScreen.css">
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


    <div class="page-content">
        <div class="side-panel"></div>
        <div class="main-content">
            <div class="hero-section">
                <div class="hero-text">
                    <h1>DONACIONES</h1>
                    <p>Aunque no puedas adoptar, aún puedes cambiar vidas.<br>Conoce a los refugios que lo dan todo por ellos.</p>
                </div>
            </div>

            <h2 class="shelters-title">Refugios</h2>

            <div class="shelters-grid">
                <?php if (!empty($shelters)): ?>
                    <?php foreach ($shelters as $shelter): ?>
                        <div class="shelter-card">
                            <div class="shelter-image">
                                <img src="<?php echo htmlspecialchars($shelter['foto'] ?? '../../img/placeholder.png'); ?>" alt="<?php echo htmlspecialchars($shelter['name']); ?>">
                            </div>
                            <h3><?php echo htmlspecialchars($shelter['name']); ?></h3>
                            <p><a href="<?php echo htmlspecialchars($shelter['web']); ?>" target="_blank">Página web</a></p>
                            <form action="PaymentScreen.php" method="get" style="display:inline;">
                                <input type="hidden" name="id_shelter" value="<?php echo htmlspecialchars($shelter['id']); ?>">
                                <button class="donate-button" type="submit">Donar</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No hay refugios disponibles en este momento.</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="side-panel"></div>
    </div>

</html>

<?php include 'Footer-2.php'; ?>