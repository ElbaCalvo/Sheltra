<?php
session_start();

require_once "../../config/dbConnection.php";
require_once "../../app/model/User.php";
require_once "../../app/model/Animal.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: LoginScreen.php");
    exit();
}

try {
    $pdo = getDBConnection();
    $userModel = new User($pdo);
    $animalModel = new Animal($pdo);

    $user = $userModel->getUserById($_SESSION['user_id']); 
    $latestAnimals = $animalModel->getLatest(3);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sheltra - Inicio</title>
    <link rel="stylesheet" href="css/loggedHomeScreen.css">
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

    <section class="hero">
        <div class="hero-content">
            <h1>"Cada vida cuenta, desde el pico hasta la cola"</h1>
            <p>Nos dedicamos a dar una nueva oportunidad a cada animal, brindándoles<br>
                un hogar lleno de amor y cuidado. Ayúdanos a transformar vidas a través<br>
                de la adopción responsable.</p>
            <a href="LoggedAllAnimalsScreen.php" class="adopt-button">Adopta ahora</a>
        </div>
    </section>

    <section class="latest-additions">
        <h2 class="latest-additions-h2">Nuestras tres últimas incorporaciones</h2>
        <div class="animals-grid">
            <?php foreach ($latestAnimals as $animal): ?>
                <div class="animal-card">
                    <img src="<?php echo htmlspecialchars($animal['foto'] ?? '../../img/placeholder.png'); ?>" alt="Animal" class="animal-image">
                    <h3><?php echo htmlspecialchars($animal['name']); ?></h3>
                    <p class="limited-description"><?php echo htmlspecialchars($animal['description']); ?></p>                    <div class="card-footer">
                    <form action="AdoptScreen.php" method="get" style="display:inline;">
                        <input type="hidden" name="id_animal" value="<?php echo htmlspecialchars($animal['id']); ?>">
                        <button class="view-more" type="submit">Ver más</button>
                    </form>
                    <img src="../../img/empty-like.png" alt="Paw" class="paw-icon">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="ideal-companion">
        <div class="border-line top"></div>
        <h2 class="ideal-companion-h2">¿Cuál es tu compañero ideal?</h2>
        <div class="companion-grid">
            <div class="companion-card">
                <a href="LoggedTypeScreen.php?type=gato">
                    <img src="../../img/cats.jpg" alt="Gatos">
                    <span>Gatos</span>
                </a>
            </div>
            <div class="companion-card">
                <a href="LoggedTypeScreen.php?type=perro">
                    <img src="../../img/dogs.jpg" alt="Perros">
                    <span>Perros</span>
                </a>
            </div>
            <div class="companion-card">
                <a href="LoggedTypeScreen.php?type=ave">
                    <img src="../../img/birds.jpg" alt="Aves">
                    <span>Aves</span>
                </a>
            </div>
            <div class="companion-card">
                <a href="LoggedTypeScreen.php?type=pez">
                    <img src="../../img/fishes.jpg" alt="Peces">
                    <span>Peces</span>
                </a>
            </div>
            <div class="companion-card">
                <a href="LoggedTypeScreen.php?type=reptil">
                    <img src="../../img/reptiles.jpg" alt="Reptiles">
                    <span>Reptiles</span>
                </a>
            </div>
            <div class="companion-card">
                <a href="LoggedTypeScreen.php?type=roedor">
                    <img src="../../img/rodents.jpg" alt="Roedores">
                    <span>Roedores</span>
                </a>
            </div>
        </div>
        <div class="border-line bottom"></div>
    </section>

    <section class="donations-section">
        <div class="donations-card">
            <div class="donations-content">
                <h1 class="donations-label">DONACIONES</h1>
                <h2>No puedes adoptar un animal? </h2>
                <h3>No te preocupes, puedes ayudar igualmente, accede a este apartado para descubrir más</h3>
                <a href="DonateScreen.php" class="Donar">
                    <button class="donate-button">Donar</button>
                </a>
            </div>
        </div>
    </section>
</body>

</html>

<?php include 'Footer.php'; ?>