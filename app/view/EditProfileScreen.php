<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="css/editProfileScreen.css">
</head>

<body>
    <header>
        <div class="header-content">
            <img src="../../img/sheltra-logo.png" alt="Sheltra" class="logo">
            <div class="user-info">
                <img src="../../img/user-icon.png" alt="User" class="user-icon">
                <span>NombreUsuario</span>
            </div>
        </div>
    </header>

    <div class="profile-container">
        <h2>Editar perfil</h2>
        <div class="edit-form">
            <form action="update_profile.php" method="POST">
                <div class="form-group full-width">
                    <label>Nombre de usuario</label>
                    <input type="text" name="username" placeholder="Juan">
                </div>
                <div class="form-group full-width">
                    <label>Correo electrónico</label>
                    <input type="email" name="email" placeholder="juan@gmail.com">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" name="password" placeholder="••••••••">
                    </div>
                    <div class="form-group">
                        <label>Confirma contraseña</label>
                        <input type="password" name="confirm_password" placeholder="••••••••">
                    </div>
                </div>
                <div class="form-group full-width">
                    <label>DNI/NIF</label>
                    <input type="text" name="dni" placeholder="11111111A">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="tel" name="phone" placeholder="111 11 11 11">
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" name="address" placeholder="Calle ejemplo, 123">
                    </div>
                </div>
                <div class="form-group full-width">
                    <label>Cuenta bancaria</label>
                    <input type="text" name="bank_account" placeholder="ES12 3456 7891 2345 6789">
                </div>
                <div class="button-group">
                    <button type="submit" class="save-button">Guardar</button>
                    <button type="button" class="logout-button">Cerrar sesión</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

<?php include 'Footer.php'; ?>