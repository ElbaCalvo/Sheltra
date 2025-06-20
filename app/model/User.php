<?php
require_once __DIR__ . '/../../config/dbConnection.php';

class User {
    private $pdo;

    private $id;
    private $username;
    private $email;
    private $password;
    private $dni;
    private $phone;
    private $address;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function setPhone($phone) {
        $this->phone = str_replace(' ', '', $phone);
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function addUser($username, $email, $password, $dni, $phone, $address) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password, DNI, phone, address) VALUES (:username, :email, :password, :dni, :phone, :address)");
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':dni', $this->dni);
            $stmt->bindParam(':phone', $this->phone);
            $stmt->bindParam(':address', $this->address);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getUserById($user_id) {
        try {
            $stmt = $this->pdo->prepare("SELECT username FROM users WHERE id = ?");
            $stmt->execute([$user_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getUsernameAndAddress($user_id) {
        try {
            $stmt = $this->pdo->prepare("SELECT username, address FROM users WHERE id = ?");
            $stmt->execute([$user_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function checkUsuario() {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $this->email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && password_verify($this->password, $result['password'])) {
                $this->id = $result['id'];
                $this->username = $result['username'];
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function profileUpdate($user_id) {
        try {
            $sql = "UPDATE users SET username = :username, email = :email, dni = :dni, phone = :phone, address = :address";
            if (!empty($this->password)) {
                $sql .= ", password = :password";
            }
            $sql .= " WHERE id = :user_id";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':dni', $this->dni);
            $stmt->bindParam(':phone', $this->phone);
            $stmt->bindParam(':address', $this->address);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

            if (!empty($this->password)) {
                $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
                $stmt->bindParam(':password', $hashed_password);
            }

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function emailExistsEdit($excludeUserId = null) {
        if ($excludeUserId) {
            $stmt = $this->pdo->prepare("SELECT id FROM users WHERE email = :email AND id != :id");
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':id', $excludeUserId, PDO::PARAM_INT);
        } else {
            $stmt = $this->pdo->prepare("SELECT id FROM users WHERE email = :email");
            $stmt->bindParam(':email', $this->email);
        }
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function deleteUser($user_id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :user_id");
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public static function validateLogin($email, $password) {
        $errors = [];

        if (empty($email)) {
            $errors['email'] = "El correo electrónico es obligatorio.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "El correo electrónico no es válido.";
        }

        if (empty($password)) {
            $errors['password'] = "La contraseña es obligatoria.";
        }

        return $errors;
    }


    public static function validateRegister($username, $phone, $email, $password, $confirm_password, $dni) {
        $errors = [];

        if (empty($username)) {
            $errors['username'] = "El nombre de usuario es obligatorio.";
        } elseif (strlen($username) > 10) {
            $errors['username'] = "El nombre no puede tener más de 10 caracteres.";
        }

        if (empty($phone)) {
            $errors['phone'] = "El teléfono es obligatorio.";
        } else {
            $phone_digits = str_replace(' ', '', $phone);
            if (!preg_match('/^[0-9]{9}$/', $phone_digits)) {
                $errors['phone'] = "El teléfono debe tener exactamente 9 dígitos.";
            }
        }

        if (empty($email)) {
            $errors['email'] = "El correo electrónico es obligatorio.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "El correo electrónico no es válido.";
        }

        if (empty($password)) {
            $errors['password'] = "La contraseña es obligatoria.";
        } elseif (strlen($password) < 8) {
            $errors['password'] = "La contraseña debe tener al menos 8 caracteres.";
        }

        if (empty($confirm_password)) {
            $errors['confirm_password'] = "Debes confirmar la contraseña.";
        } elseif ($password !== $confirm_password) {
            $errors['confirm_password'] = "Las contraseñas no coinciden.";
        }

        if (empty($dni)) {
            $errors['dni'] = "El DNI es obligatorio.";
        } elseif (!preg_match('/^[0-9]{8}[A-Za-z]$/', $dni)) {
            $errors['dni'] = "El DNI debe tener 8 números seguidos de una letra.";
        }

        return $errors;
    }
}
