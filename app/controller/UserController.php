<?php
require_once __DIR__ . '/../model/User.php';

class UserController {

    public function addUser($username, $email, $password, $dni, $phone, $address) {
        $usuario = new User(getDBConnection());
        $usuario->setUsername($username);
        $usuario->setEmail($email);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $usuario->setPassword($hashedPassword);
        $usuario->setDni($dni);
        $usuario->setPhone($phone);
        $usuario->setAddress($address);
        return $usuario->addUser($username, $email, $hashedPassword, $dni, $phone, $address);
    }

    public function getUserById($user_id) {
        $usuario = new User(getDBConnection());
        return $usuario->getUserById($user_id);
    }

    public function getUsernameAndAddress($user_id) {
        $usuario = new User(getDBConnection());
        return $usuario->getUsernameAndAddress($user_id);
    }

    public function emailExistsEdit($email, $excludeUserId) {
        $usuario = new User(getDBConnection());
        $usuario->setEmail($email);
        return $usuario->emailExistsEdit($excludeUserId);
    }

    public function emailExists($email) {
        $usuario = new User(getDBConnection());
        return $usuario->emailExistsEdit($email);
    }

    public function profileUpdate($user_id, $username, $email, $dni, $phone, $password, $address) {
        $usuario = new User(getDBConnection());
        $usuario->setUsername($username);
        $usuario->setEmail($email);
        $usuario->setDni($dni);
        $usuario->setPhone($phone);
        $usuario->setPassword($password);
        $usuario->setAddress($address);
        return $usuario->profileUpdate($user_id);
    }

    public function deleteUser($user_id) {
        $usuario = new User(getDBConnection());
        return $usuario->deleteUser($user_id);
    }

    public static function validateLogin($email, $password) {
        return User::validateLogin($email, $password);
    }

    public static function validateRegister($username, $phone, $email, $password, $confirm_password, $dni) {
        return User::validateRegister($username, $phone, $email, $password, $confirm_password, $dni);
    }

    public function userLogout() {
        session_unset();
        session_destroy();
        header("Location: LoginScreen.php");
        exit();
    }

    public function login($email, $password, User $user = null) {
        if ($user === null) {
            $user = new User(getDBConnection());
        }
        $user->setEmail($email);
        $user->setPassword($password);
        if ($user->checkUsuario()) {
            return [
                'id' => $user->getId(),
                'username' => $user->getUsername()
            ];
        }
        return false;
    }
}
?>