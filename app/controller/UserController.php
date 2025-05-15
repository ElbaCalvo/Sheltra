<?php
require_once __DIR__ . '/../model/User.php';

class UsuerController {

    public function addUsuario($nombreUsuario, $contrasena, $correo, $telefono, $dni) {
        $usuario = new User();
        $usuario->setUsername($nombreUsuario);
        $usuario->setEmail($correo);
        $usuario->setPassword($contrasena);
        $usuario->setDni($dni);
        $usuario->setPhone($telefono);
        return $usuario->addUser();
    }

    public function comprobarUsuario($nombreUsuario, $contrasena, $usuario = null) {
        if ($usuario === null) {
            $usuario = new User();
        }
        $usuario->setUsuario($nombreUsuario);
        $usuario->setContrasena($contrasena);
        return $usuario->comprobarUsuario();
    }

    public function updateUsuario($usuario, $correo, $contrasena, $dni, $telefono, $direccion, $cuentaBanco) {
        try {
            $conn = getDBConnection();
            $sql = $conn->prepare("UPDATE usuarios SET Contraseña = :contrasena, Correo_electronico = :correo, TELEFONO = :telefono, DNI = :dni, Direccion = :direccion, Cuenta_bancaria = :cuentaBanco WHERE Nombre = :nombre");
            $sql->bindParam(':nombre', $usuario);
            $sql->bindParam(':contrasena', $contrasena);
            $sql->bindParam(':correo', $correo);
            $sql->bindParam(':telefono', $telefono);
            $sql->bindParam(':dni', $dni);
            $sql->bindParam(':direccion', $direccion);
            $sql->bindParam(':cuentaBanco', $cuentaBanco);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>