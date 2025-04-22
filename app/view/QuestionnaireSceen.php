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
            <img src="../../img/sheltra-logo.png" alt="Sheltra" class="logo">
            <div class="user-info">
                <img src="../../img/favorites-icon.png" alt="Favorites" class="favorites-icon">
                <img src="../../img/user-icon.png" alt="User" class="user-icon">
                <span>NombreUsuario</span>
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

                <form class="adoption-form">
                    <h3>Datos personales</h3>
                    <div class="form-group">
                        <label>Nombre completo</label>
                        <input type="text" name="nombre" placeholder="Lorena Gómez López" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Correo electrónico</label>
                            <input type="email" name="email" placeholder="lorena123@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="tel" name="telefono" placeholder="111 11 11 11" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" name="direccion" placeholder="Calle Ejemplo, Nº3" required>
                    </div>

                    <h3>Sobre tu hogar</h3>
                    <div class="form-group">
                        <label>Tipo de vivienda:</label>
                        <div class="radio-group">
                            <label><input type="radio" name="vivienda" value="casa"> Casa</label>
                            <label><input type="radio" name="vivienda" value="piso"> Piso</label>
                            <label><input type="radio" name="vivienda" value="otro"> Otro</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>¿Es vivienda propia o alquilada?</label>
                        <select name="vivienda" class="form-select">
                            <option value="propia">Propia</option>
                            <option value="alquilada">Alquilada</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>¿Permiten mascotas? (en caso de alquiler)</label>
                        <div class="radio-group">
                            <label><input type="radio" name="permiten_mascotas" value="si"> Sí</label>
                            <label><input type="radio" name="permiten_mascotas" value="no"> No</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>¿Tienes patio o jardín?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="jardin" value="si"> Sí</label>
                            <label><input type="radio" name="jardin" value="no"> No</label>
                        </div>
                    </div>

                    <h3>Experiencia y motivación</h3>
                    <div class="form-group">
                        <label>¿Has tenido mascotas antes?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="mascotas_previas" value="si"> Sí</label>
                            <label><input type="radio" name="mascotas_previas" value="no"> No</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>¿Tienes otras mascotas actualmente?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="mascotas_actuales" value="si"> Sí</label>
                            <label><input type="radio" name="mascotas_actuales" value="no"> No</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>¿Por qué quieres adoptar?</label>
                        <textarea name="motivo" rows="4"></textarea>
                    </div>

                    <h3>Compromiso</h3>
                    <div class="form-group">
                        <label>¿Estás dispuesto/a a asumir los cuidados?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="asumir_cuidados" value="si"> Sí</label>
                            <label><input type="radio" name="asumir_cuidados" value="no"> No</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>¿Estás de acuerdo en firmar un contrato de adopción?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="contrato" value="si"> Sí</label>
                            <label><input type="radio" name="contrato" value="no"> No</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>¿Aceptarías seguimiento post-adopción si es necesario?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="seguimiento" value="si"> Sí</label>
                            <label><input type="radio" name="seguimiento" value="no"> No</label>
                        </div>
                    </div>

                    <button type="submit" class="submit-button">Enviar</button>
                </form>
            </div>
        </div>
        <div class="side-panel"></div>
    </div>
</body>

</html>