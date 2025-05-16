<?php
session_start();
require_once "../../config/dbConnection.php";
require_once "../../app/controller/UserController.php";
require_once "../../app/controller/AnimalController.php";
require_once "../../app/controller/QuestionnaireController.php";

if (!isset($_SESSION['user_id'])) { // Comprobar que el usuario ha iniciado sesión
    header("Location: LoginScreen.php");
    exit();
}

$success = false;
$error = '';
$errors = [];
$user = null;

$userController = new UserController();
$animalController = new AnimalController();
$questionnaireController = new QuestionnaireController();

try {
    $user = $userController->getUserById($_SESSION['user_id']);
} catch (PDOException $e) {
    die("Error al obtener los datos: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pets_allowed = '';
    if (isset($_POST['ownership_status']) && $_POST['ownership_status'] === 'alquilada') {
        $pets_allowed = $_POST['pets_allowed'] ?? '';
    }

    $data = [
        'id_user'         => $_SESSION['user_id'],
        'id_animal' => $_POST['id_animal'] ?? $_GET['id_animal'] ?? '',
        'date'            => date('Y-m-d'),
        'status'          => 'status',
        'text'            => $_POST['text'] ?? '',
        'resolution'      => '',
        'applic_name'     => $_POST['applic_name'] ?? '',
        'applic_mail'     => $_POST['applic_mail'] ?? '',
        'applic_phone'    => $_POST['applic_phone'] ?? '',
        'applic_address'  => $_POST['applic_address'] ?? '',
        'housing_type'    => $_POST['housing_type'] ?? '',
        'ownership_status' => $_POST['ownership_status'] ?? ($_POST['housing_type'] ?? ''),
        'pets_allowed'    => $pets_allowed,
        'outdoor_space'   => $_POST['outdoor_space'] ?? '',
        'pets_before'     => $_POST['pets_before'] ?? '',
        'other_pets'      => $_POST['other_pets'] ?? '',
        'maintenance'     => $_POST['maintenance'] ?? '',
        'contract'        => $_POST['contract'] ?? '',
        'post_adop'       => $_POST['post_adop'] ?? ''
    ];

    $errors = $questionnaireController->validateQuestionnaire($_POST);

    if (empty($errors)) {
        if ($questionnaireController->submitQuestionnaire($data)) {
            if (!empty($data['id_animal'])) {
                $animalController->setInactive($data['id_animal']);
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
                    <input type="hidden" name="id_animal" value="<?php
                        echo htmlspecialchars(
                            $_POST['id_animal'] ?? $_GET['id_animal'] ?? ''
                        );
                    ?>">
                    <h3>Datos personales</h3>
                    <div class="form-group">
                        <label>Nombre completo</label>
                        <input type="text" name="applic_name" placeholder="Lorena Gómez López" required value="<?php echo htmlspecialchars($_POST['applic_name'] ?? ''); ?>">
                        <?php if (!empty($errors['applic_name'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['applic_name']; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Correo electrónico</label>
                            <input type="email" name="applic_mail" placeholder="lorena123@gmail.com" required value="<?php echo htmlspecialchars($_POST['applic_mail'] ?? ''); ?>">
                            <?php if (!empty($errors['applic_mail'])): ?>
                                <div style="color: #dc3545;"><?php echo $errors['applic_mail']; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="tel" name="applic_phone" placeholder="111 11 11 11" required value="<?php echo htmlspecialchars($_POST['applic_phone'] ?? ''); ?>">
                            <?php if (!empty($errors['applic_phone'])): ?>
                                <div style="color: #dc3545;"><?php echo $errors['applic_phone']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" name="applic_address" placeholder="Calle Ejemplo, Nº3" required value="<?php echo htmlspecialchars($_POST['applic_address'] ?? ''); ?>">
                        <?php if (!empty($errors['applic_address'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['applic_address']; ?></div>
                        <?php endif; ?>
                    </div>

                    <h3>Sobre tu hogar</h3>
                    <div class="form-group">
                        <label>Tipo de vivienda:</label>
                        <div class="radio-group">
                            <label><input type="radio" name="housing_type" value="casa" <?php if (($_POST['housing_type'] ?? '') == 'casa') echo 'checked'; ?>> Casa</label>
                            <label><input type="radio" name="housing_type" value="piso" <?php if (($_POST['housing_type'] ?? '') == 'piso') echo 'checked'; ?>> Piso</label>
                            <label><input type="radio" name="housing_type" value="otro" <?php if (($_POST['housing_type'] ?? '') == 'otro') echo 'checked'; ?>> Otro</label>
                        </div>
                        <?php if (!empty($errors['housing_type'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['housing_type']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>¿Es vivienda propia o alquilada?</label>
                        <select name="ownership_status" class="form-select">
                            <option value="propia" <?php if (($_POST['ownership_status'] ?? '') == 'propia') echo 'selected'; ?>>Propia</option>
                            <option value="alquilada" <?php if (($_POST['ownership_status'] ?? '') == 'alquilada') echo 'selected'; ?>>Alquilada</option>
                        </select>
                        <?php if (!empty($errors['ownership_status'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['ownership_status']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>¿Permiten mascotas? (en caso de alquiler)</label>
                        <div class="radio-group">
                            <label><input type="radio" name="pets_allowed" value="si" <?php if (($_POST['pets_allowed'] ?? '') == 'si') echo 'checked'; ?>> Sí</label>
                            <label><input type="radio" name="pets_allowed" value="no" <?php if (($_POST['pets_allowed'] ?? '') == 'no') echo 'checked'; ?>> No</label>
                        </div>
                        <?php if (!empty($errors['pets_allowed'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['pets_allowed']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>¿Tienes patio o jardín?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="outdoor_space" value="si" <?php if (($_POST['outdoor_space'] ?? '') == 'si') echo 'checked'; ?>> Sí</label>
                            <label><input type="radio" name="outdoor_space" value="no" <?php if (($_POST['outdoor_space'] ?? '') == 'no') echo 'checked'; ?>> No</label>
                        </div>
                        <?php if (!empty($errors['outdoor_space'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['outdoor_space']; ?></div>
                        <?php endif; ?>
                    </div>

                    <h3>Experiencia y motivación</h3>
                    <div class="form-group">
                        <label>¿Has tenido mascotas antes?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="pets_before" value="si" <?php if (($_POST['pets_before'] ?? '') == 'si') echo 'checked'; ?>> Sí</label>
                            <label><input type="radio" name="pets_before" value="no" <?php if (($_POST['pets_before'] ?? '') == 'no') echo 'checked'; ?>> No</label>
                        </div>
                        <?php if (!empty($errors['pets_before'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['pets_before']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>¿Tienes otras mascotas actualmente?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="other_pets" value="si" <?php if (($_POST['other_pets'] ?? '') == 'si') echo 'checked'; ?>> Sí</label>
                            <label><input type="radio" name="other_pets" value="no" <?php if (($_POST['other_pets'] ?? '') == 'no') echo 'checked'; ?>> No</label>
                        </div>
                        <?php if (!empty($errors['other_pets'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['other_pets']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>¿Por qué quieres adoptar?</label>
                        <textarea name="text" rows="4"><?php echo htmlspecialchars($_POST['text'] ?? ''); ?></textarea>
                        <?php if (!empty($errors['text'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['text']; ?></div>
                        <?php endif; ?>
                    </div>

                    <h3>Compromiso</h3>
                    <div class="form-group">
                        <label>¿Estás dispuesto/a a asumir los cuidados?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="maintenance" value="si" <?php if (($_POST['maintenance'] ?? '') == 'si') echo 'checked'; ?>> Sí</label>
                            <label><input type="radio" name="maintenance" value="no" <?php if (($_POST['maintenance'] ?? '') == 'no') echo 'checked'; ?>> No</label>
                        </div>
                        <?php if (!empty($errors['maintenance'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['maintenance']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>¿Estás de acuerdo en firmar un contrato de adopción?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="contract" value="si" <?php if (($_POST['contract'] ?? '') == 'si') echo 'checked'; ?>> Sí</label>
                            <label><input type="radio" name="contract" value="no" <?php if (($_POST['contract'] ?? '') == 'no') echo 'checked'; ?>> No</label>
                        </div>
                        <?php if (!empty($errors['contract'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['contract']; ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>¿Aceptarías seguimiento post-adopción si es necesario?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="post_adop" value="si" <?php if (($_POST['post_adop'] ?? '') == 'si') echo 'checked'; ?>> Sí</label>
                            <label><input type="radio" name="post_adop" value="no" <?php if (($_POST['post_adop'] ?? '') == 'no') echo 'checked'; ?>> No</label>
                        </div>
                        <?php if (!empty($errors['post_adop'])): ?>
                            <div style="color: #dc3545;"><?php echo $errors['post_adop']; ?></div>
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