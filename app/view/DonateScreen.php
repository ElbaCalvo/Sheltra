<?php
require_once "../../config/dbConnection.php";

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: LoginScreen.php");
    exit();
}

try {
    $pdo = getDBConnection();

    // Consulta para obtener el nombre del usuario
    $stmt = $pdo->prepare("SELECT username FROM users WHERE id = :user_id");
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Consulta para obtener los refugios
    $stmt = $pdo->prepare("SELECT * FROM shelters");
    $stmt->execute();
    $shelters = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

            <div class="shelters-grid">
                <?php if (!empty($shelters)): ?>
                    <?php foreach ($shelters as $shelter): ?>
                        <div class="shelter-card">
                            <div class="shelter-image">
                                <img src="<?php echo htmlspecialchars($shelter['foto'] ?? '../../img/placeholder.png'); ?>" alt="<?php echo htmlspecialchars($shelter['name']); ?>">
                            </div>
                            <h3><?php echo htmlspecialchars($shelter['name']); ?></h3>
                            <p><a href="<?php echo htmlspecialchars($shelter['web']); ?>" target="_blank">Página web</a></p> <button class="donate-button">Donar</button>
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