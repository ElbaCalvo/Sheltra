<?php
require_once "../../config/dbConnection.php";
require_once "../../app/model/Animal.php";

try {
    $pdo = getDBConnection();
    $animalModel = new Animal($pdo);
    $latestAnimals = $animalModel->getLatest(3);
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
    <link rel="stylesheet" href="css/homeScreen.css">
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

    <section class="hero">
        <div class="hero-content">
            <h1>"Cada vida cuenta, desde el pico hasta la cola"</h1>
            <p>Nos dedicamos a dar una nueva oportunidad a cada animal, brindándoles<br>
                un hogar lleno de amor y cuidado. Ayúdanos a transformar vidas a través<br>
                de la adopción responsable.</p>
            <a href="AllAnimalsScreen.php" class="adopt-button">Adopta ahora</a>
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
                        <a href="LoginScreen.php">
                            <button class="view-more">Ver más</button>
                        </a>
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
                <a href="TypeScreen.php?type=gato">
                    <img src="../../img/cats.jpg" alt="Gatos">
                    <span>Gatos</span>
                </a>
            </div>
            <div class="companion-card">
                <a href="TypeScreen.php?type=perro">
                    <img src="../../img/dogs.jpg" alt="Perros">
                    <span>Perros</span>
                </a>
            </div>
            <div class="companion-card">
                <a href="TypeScreen.php?type=ave">
                    <img src="../../img/birds.jpg" alt="Aves">
                    <span>Aves</span>
                </a>
            </div>
            <div class="companion-card">
                <a href="TypeScreen.php?type=pez">
                    <img src="../../img/fishes.jpg" alt="Peces">
                    <span>Peces</span>
                </a>
            </div>
            <div class="companion-card">
                <a href="TypeScreen.php?type=reptil">
                    <img src="../../img/reptiles.jpg" alt="Reptiles">
                    <span>Reptiles</span>
                </a>
            </div>
            <div class="companion-card">
                <a href="TypeScreen.php?type=roedor">
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
                <a href="LoginScreen.php" class="Donar">
                    <button class="donate-button">Donar</button>
                </a>
            </div>
        </div>
    </section>
</body>

</html>

<?php include 'Footer.php'; ?>