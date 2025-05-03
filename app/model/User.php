<?php
require_once "../../config/dbConnection.php";

class User
{
    private $id;
    private $username;
    private $email;
    private $password;
    private $dni;
    private $phone;
    private $bank_acc;
    private $address;

    public function getId() {
        if (isset($this->id)) {
            return $this->id;
        }
        return null;
    }

    public function getUsername() {
        if (isset($this->username)) {
            return $this->username;
        }
        return null;
    }

    public function getEmail() {
        if (isset($this->email)) {
            return $this->email;
        }
        return null;
    }

    public function getPassword() {
        if (isset($this->password)) {
            return $this->password;
        }
        return null;
    }

    public function getDni() {
        if (isset($this->dni)) {
            return $this->dni;
        }
        return null;
    }

    public function getPhone() {
        if (isset($this->phone)) {
            return $this->phone;
        }
        return null;
    }

    public function getBankAccount() {
        if (isset($this->bank_acc)) {
            return $this->bank_acc;
        }
        return null;
    }

    public function getAddress() {
        if (isset($this->address)) {
            return $this->address;
        }
        return null;
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
        $this->phone = $phone;
    }

    public function setBankAccount($bank_acc) {
        $this->bank_acc = $bank_acc;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function addUser() {
        try {
            $conn = getDBConnection();
            $sql = $conn->prepare("INSERT INTO users (username, email, password, dni, phone) VALUES (:username, :email, :password, :dni, :phone)");
            $sql->bindParam(':username', $this->username);
            $sql->bindParam(':email', $this->email);
            $sql->bindParam(':password', $this->password);
            $sql->bindParam(':dni', $this->dni);
            $sql->bindParam(':phone', $this->phone);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function checkUsuario() {
        try {
            $conn = getDBConnection();
            $sql = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $sql->bindParam(':email', $this->email);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
    
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
            $conn = getDBConnection();
            $query = "UPDATE users SET username = :username, email = :email, dni = :dni, phone = :phone, address = :address, bank_acc = :bank_acc";
            if (!empty($this->password)) {
                $query .= ", password = :password";
            }
            $query .= " WHERE id = :user_id";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':dni', $this->dni);
            $stmt->bindParam(':phone', $this->phone);
            $stmt->bindParam(':address', $this->address);
            $stmt->bindParam(':bank_acc', $this->bank_acc);
            $stmt->bindParam(':user_id', $user_id);

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
}
