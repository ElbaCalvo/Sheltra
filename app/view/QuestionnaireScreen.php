<?php
session_start();
require_once "../../config/dbConnection.php";
require_once "../../app/model/User.php";
require_once "../../app/model/Animal.php";
require_once "../../app/model/Questionnaire.php";

if (!isset($_SESSION['user_id'])) { // Comprobar que el usuario ha iniciado sesión
    header("Location: LoginScreen.php");
    exit();
}

$pdo = getDBConnection();
$questionnaireModel = new Questionnaire($pdo);
$userModel = new User($pdo);
$animalModel = new Animal($pdo);

$success = false;
$error = '';
$errors = [];
$user = null;

try {
    $userModel = new User($pdo);
    $user = $userModel->getUserById($_SESSION['user_id']);
} catch (PDOException $e) {
    die("Error al obtener los datos: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = $questionnaireModel->validateQuestionnaire($_POST);

    $pets_allowed = '';
    if (isset($_POST['vivienda_prop']) && $_POST['vivienda_prop'] === 'alquilada') {
        $pets_allowed = $_POST['permiten_mascotas'] ?? '';
    }

    $data = [
        'id_user'         => $_SESSION['user_id'],
        'id_animal'       => $_GET['id_animal'] ?? null,
        'date'            => date('Y-m-d'),
        'status'          => 'pendiente',
        'text'            => $_POST['motivo'] ?? '',
        'resolution'      => '',
        'applic_name'     => $_POST['nombre'] ?? '',
        'applic_mail'     => $_POST['email'] ?? '',
        'applic_phone'    => $_POST['telefono'] ?? '',
        'applic_address'  => $_POST['direccion'] ?? '',
        'housing_type'    => $_POST['vivienda'] ?? '',
        'ownership_status' => $_POST['vivienda_prop'] ?? ($_POST['vivienda'] ?? ''),
        'pets_allowed'    => $pets_allowed,
        'outdoor_space'   => $_POST['jardin'] ?? '',
        'pets_before'     => $_POST['mascotas_previas'] ?? '',
        'other_pets'      => $_POST['mascotas_actuales'] ?? '',
        'maintenance'     => $_POST['asumir_cuidados'] ?? '',
        'contract'        => $_POST['contrato'] ?? '',
        'post_adop'       => $_POST['seguimiento'] ?? ''
    ];

    if (empty($errors)) {
        if ($questionnaireModel->create($data)) {
            if (!empty($data['id_animal'])) { // Cambiar el estado del animal a "Adopción no activa"
                require_once "../../app/model/Animal.php";
                $animalModel->setInactive($data['id_animal']);
            }
            $success = true;
        } else {
            $error = "Error al guardar el cuestionario.";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cuestionario de Adopción</title>
    <link rel="stylesheet" href="css/questionnaireScreen.css">
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
            <div class="questionnaire-container">
                <div class="info-section">
                    <div class="image-section">
                        <img src="../../img/questionnaire-img.jpg" alt="Cat" class="adoption-image">
                    </div>
                    <div class="info-text">
                        <h2>Cuestionario de solicitud de adopción</h2>
                        <p>Cada animalito necesita una segunda oportunidad.</p>
                        <p>Cuéntanos un poco sobre ti y el hogar que estás dispuesto a ofrecer.</p>
                        <p>Ellos solo necesitan amor... ¿lo tienes tú?</p>
                    </div>
                </div>

                <form class="adoption-form" method="post">
                    <input type="hidden" name="id_animal" value="<?php echo htmlspecialchars($_GET['id_animal'] ?? ''); ?>">
                    <h3>Datos personales</h3>
                    <div class="form-group">
                        <label>Nombre completo</label>
                        <input type="text" name="nombre" placeholder="Lorena Gómez López" required value="<?php echo htmlspecialchars($_POST['nombre'] ?? ''); ?>">
                        <?php if (!empty($errors['nombre'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['nombre']; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Correo electrónico</label>
                            <input type="email" name="email" placeholder="lorena123@gmail.com" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                            <?php if (!empty($errors['email'])): ?>
                                <div style="color: #dc3545;"><?php echo $errors['email']; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="tel" name="telefono" placeholder="111 11 11 11" required value="<?php echo htmlspecialchars($_POST['telefono'] ?? ''); ?>">
                            <?php if (!empty($errors['telefono'])): ?>
                                <div style="color: #dc3545;"><?php echo $errors['telefono']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" name="direccion" placeholder="Calle Ejemplo, Nº3" required value="<?php echo htmlspecialchars($_POST['direccion'] ?? ''); ?>">
                        <?php if (!empty($errors['direccion'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['direccion']; ?></div>
                        <?php endif; ?>
                    </div>

                    <h3>Sobre tu hogar</h3>
                    <div class="form-group">
                        <label>Tipo de vivienda:</label>
                        <div class="radio-group">
                            <label><input type="radio" name="vivienda" value="casa" <?php if (($_POST['vivienda'] ?? '') == 'casa') echo 'checked'; ?>> Casa</label>
                            <label><input type="radio" name="vivienda" value="piso" <?php if (($_POST['vivienda'] ?? '') == 'piso') echo 'checked'; ?>> Piso</label>
                            <label><input type="radio" name="vivienda" value="otro" <?php if (($_POST['vivienda'] ?? '') == 'otro') echo 'checked'; ?>> Otro</label>
                        </div>
                        <?php if (!empty($errors['vivienda'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['vivienda']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>¿Es vivienda propia o alquilada?</label>
                        <select name="vivienda_prop" class="form-select">
                            <option value="propia" <?php if (($_POST['vivienda_prop'] ?? '') == 'propia') echo 'selected'; ?>>Propia</option>
                            <option value="alquilada" <?php if (($_POST['vivienda_prop'] ?? '') == 'alquilada') echo 'selected'; ?>>Alquilada</option>
                        </select>
                        <?php if (!empty($errors['vivienda_prop'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['vivienda_prop']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>¿Permiten mascotas? (en caso de alquiler)</label>
                        <div class="radio-group">
                            <label><input type="radio" name="permiten_mascotas" value="si" <?php if (($_POST['permiten_mascotas'] ?? '') == 'si') echo 'checked'; ?>> Sí</label>
                            <label><input type="radio" name="permiten_mascotas" value="no" <?php if (($_POST['permiten_mascotas'] ?? '') == 'no') echo 'checked'; ?>> No</label>
                        </div>
                        <?php if (!empty($errors['permiten_mascotas'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['permiten_mascotas']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>¿Tienes patio o jardín?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="jardin" value="si" <?php if (($_POST['jardin'] ?? '') == 'si') echo 'checked'; ?>> Sí</label>
                            <label><input type="radio" name="jardin" value="no" <?php if (($_POST['jardin'] ?? '') == 'no') echo 'checked'; ?>> No</label>
                        </div>
                        <?php if (!empty($errors['jardin'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['jardin']; ?></div>
                        <?php endif; ?>
                    </div>

                    <h3>Experiencia y motivación</h3>
                    <div class="form-group">
                        <label>¿Has tenido mascotas antes?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="mascotas_previas" value="si" <?php if (($_POST['mascotas_previas'] ?? '') == 'si') echo 'checked'; ?>> Sí</label>
                            <label><input type="radio" name="mascotas_previas" value="no" <?php if (($_POST['mascotas_previas'] ?? '') == 'no') echo 'checked'; ?>> No</label>
                        </div>
                        <?php if (!empty($errors['mascotas_previas'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['mascotas_previas']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>¿Tienes otras mascotas actualmente?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="mascotas_actuales" value="si" <?php if (($_POST['mascotas_actuales'] ?? '') == 'si') echo 'checked'; ?>> Sí</label>
                            <label><input type="radio" name="mascotas_actuales" value="no" <?php if (($_POST['mascotas_actuales'] ?? '') == 'no') echo 'checked'; ?>> No</label>
                        </div>
                        <?php if (!empty($errors['mascotas_actuales'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['mascotas_actuales']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>¿Por qué quieres adoptar?</label>
                        <textarea name="motivo" rows="4"><?php echo htmlspecialchars($_POST['motivo'] ?? ''); ?></textarea>
                        <?php if (!empty($errors['motivo'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['motivo']; ?></div>
                        <?php endif; ?>
                    </div>

                    <h3>Compromiso</h3>
                    <div class="form-group">
                        <label>¿Estás dispuesto/a a asumir los cuidados?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="asumir_cuidados" value="si" <?php if (($_POST['asumir_cuidados'] ?? '') == 'si') echo 'checked'; ?>> Sí</label>
                            <label><input type="radio" name="asumir_cuidados" value="no" <?php if (($_POST['asumir_cuidados'] ?? '') == 'no') echo 'checked'; ?>> No</label>
                        </div>
                        <?php if (!empty($errors['asumir_cuidados'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['asumir_cuidados']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>¿Estás de acuerdo en firmar un contrato de adopción?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="contrato" value="si" <?php if (($_POST['contrato'] ?? '') == 'si') echo 'checked'; ?>> Sí</label>
                            <label><input type="radio" name="contrato" value="no" <?php if (($_POST['contrato'] ?? '') == 'no') echo 'checked'; ?>> No</label>
                        </div>
                        <?php if (!empty($errors['contrato'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['contrato']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>¿Aceptarías seguimiento post-adopción si es necesario?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="seguimiento" value="si" <?php if (($_POST['seguimiento'] ?? '') == 'si') echo 'checked'; ?>> Sí</label>
                            <label><input type="radio" name="seguimiento" value="no" <?php if (($_POST['seguimiento'] ?? '') == 'no') echo 'checked'; ?>> No</label>
                        </div>
                        <?php if (!empty($errors['seguimiento'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['seguimiento']; ?></div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="submit-button">Enviar</button>
                </form>
            </div>
        </div>
        <div class="side-panel"></div>
    </div>
</body>

<?php if ($success): ?>
    <div style="color: #fff; background: #28a745; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
        Cuestionario enviado correctamente.
    </div>
<?php elseif (!empty($error)): ?>
    <div style="color: #fff; background: #dc3545; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
        <?php echo htmlspecialchars($error); ?>
    </div>
<?php endif; ?>

</html>

<?php include 'Footer-2.php'; ?>