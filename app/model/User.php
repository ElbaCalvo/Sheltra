<?php
require_once "../../config/dbConnection.php";

class User {
    private $username;
    private $email;
    private $password;
    private $dni;
    private $phone;
    private $bankAccount;
    private $cvv;
    private $expirationDate;

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

    public function setBankAccount($bankAccount) {
        $this->bankAccount = $bankAccount;
    }

    public function setCVV($cvv) {
        $this->cvv = $cvv;
    }

    public function setExpirationDate($expirationDate) {
        $this->expirationDate = $expirationDate;
    }

    public function addUsuario() {
        try {
            $conn = getDBConnection();
            $sql = $conn->prepare("INSERT INTO usuarios (username, email, password, DNI, phone, bank_acc, CVV, exp_date) VALUES (:username, :email, :password, :DNI, :phone, :bankAccount, :cvv, :expirationDate)");
            $sql->bindParam(':username', $this->username);
            $sql->bindParam(':email', $this->email);
            $sql->bindParam(':password', $this->password);
            $sql->bindParam(':dni', $this->dni);
            $sql->bindParam(':phone', $this->phone);
            $sql->bindParam(':bankAccount', $this->bankAccount);
            $sql->bindParam(':cvv', $this->cvv);
            $sql->bindParam(':expirationDate', $this->expirationDate);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function comprobarUsuario() {
        try {
            $conn = getDBConnection();
            $sql = $conn->prepare("SELECT * FROM users WHERE Nombre = :username && Contraseña = :password");
            $sql->bindParam(':username', $this->username);
            $sql->bindParam(':password', $this->password);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>