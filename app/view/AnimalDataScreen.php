<?php
session_start();
require_once "../../app/model/Animal.php";
require_once "../../app/model/User.php";
require_once "../../config/dbConnection.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: LoginScreen.php");
    exit();
}

$errors = [];
$success = false;

try {
    $pdo = getDBConnection();
    $userModel = new User($pdo);
    $user = $userModel->getUserById($_SESSION['user_id']);
} catch (PDOException $e) {
    die("Error al obtener los datos del usuario: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = getDBConnection();

        $animal = new Animal($pdo);

        $animal->name = trim($_POST['nombre']);
        $animal->type = trim($_POST['tipo']);
        $animal->age = trim($_POST['edad']);
        $animal->sex = trim($_POST['sexo']);
        $animal->size = trim($_POST['tamano']);
        $animal->description = trim($_POST['descripcion']);
        $animal->foto = trim($_POST['foto']);
        $animal->entry_date = trim($_POST['fecha_ingreso']);
        $animal->state = trim($_POST['estado']);

        $errors = $animal->validateAnimal();

        if (empty($errors)) {
            if ($animal->addAnimal($_SESSION['user_id'])) {
                $success = true;
                $_SESSION['success'] = "El animal se ha subido correctamente.";
                header("Location: AnimalDataScreen.php");
                exit();
            } else {
                $errors['general'] = "Hubo un error al subir el animal. Inténtalo de nuevo.";
            }
        }
    } catch (PDOException $e) {
        $errors['general'] = "Error al conectar con la base de datos: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Subir Animal</title>
    <link rel="stylesheet" href="css/animalDataScreen.css">
</head>

<body>
    <header>
        <div class="header-content">
            <a href="LoggedHomeScreen.php">
                <img src="../../img/sheltra-logo.png" alt="Sheltra" class="logo">
            </a>
            <div class="user-info">
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

    <div class="upload-container">
        <h2>Subir animal</h2>
        <div class="upload-form">
            <form action="AnimalDataScreen.php" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" placeholder="Bigotes">
                    </div>
                    <div class="form-group">
                        <label>Edad</label>
                        <select name="edad" class="form-select">
                            <option value="3m">3 meses</option>
                            <option value="4m">4 meses</option>
                            <option value="5m">5 meses</option>
                            <option value="6m">6 meses</option>
                            <option value="7m">7 meses</option>
                            <option value="8m">8 meses</option>
                            <option value="9m">9 meses</option>
                            <option value="10m">10 meses</option>
                            <option value="11m">11 meses</option>
                            <option value="1">1 año</option>
                            <option value="2">2 años</option>
                            <option value="3">3 años</option>
                            <option value="4">4 años</option>
                            <option value="5">5 años</option>
                            <option value="6">6 años</option>
                            <option value="7">7 años</option>
                            <option value="8">8 años</option>
                            <option value="9">9 años</option>
                            <option value="10">10 años</option>
                            <option value="11">11 años</option>
                            <option value="12">12 años</option>
                            <option value="13">13 años</option>
                            <option value="14">14 años</option>
                            <option value="15">15 años</option>
                            <option value="16">16 años</option>
                            <option value="17">17 años</option>
                            <option value="18">18 años</option>
                            <option value="19">19 años</option>
                            <option value="20">20 años</option>
                            <option value="21">21 años</option>
                            <option value="22">22 años</option>
                            <option value="23">23 años</option>
                            <option value="24">24 años</option>
                            <option value="25">25 años</option>
                            <option value="26">26 años</option>
                            <option value="27">27 años</option>
                            <option value="28">28 años</option>
                            <option value="29">29 años</option>
                            <option value="30">30 años</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Sexo</label>
                        <select name="sexo" class="form-select">
                            <option value="Macho">Macho</option>
                            <option value="Hembra">Hembra</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tamaño</label>
                        <select name="tamano" class="form-select">
                            <option value="Pequeno">Pequeño</option>
                            <option value="Mediano">Mediano</option>
                            <option value="Grande">Grande</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Tipo</label>
                        <select name="tipo" class="form-select">
                            <option value="Gato">Gato</option>
                            <option value="Perro">Perro</option>
                            <option value="Ave">Ave</option>
                            <option value="Roedor">Roedor</option>
                            <option value="Reptil">Reptil</option>
                            <option value="Pez">Pez</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fecha ingreso</label>
                        <input type="date" name="fecha_ingreso" class="date-input">
                    </div>
                </div>

                <div class="form-group">
                    <label>Foto</label>
                    <input type="text" name="foto" placeholder="URL de la imagen">
                </div>

                <div class="form-group">
                    <label>Estado de la adopción</label>
                    <input type="text" name="estado" value="Adopción activa" readonly class="readonly-input">
                </div>

                <div class="form-group">
                    <label>Descripción del animal</label>
                    <textarea name="descripcion" placeholder="Bigotes es un gato tranquilo y le encanta dormir..."></textarea>
                </div>

                <button type="submit" class="upload-button">Subir producto</button>
            </form>
        </div>
    </div>
</body>

</html>

<?php include 'Footer.php'; ?>