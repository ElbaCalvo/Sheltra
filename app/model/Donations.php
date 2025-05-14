<?php

class Donations {
    private $pdo;
    
    public $id;
    public $id_user;
    public $id_shelter;
    public $amount;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($id_user, $id_shelter, $amount) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO donations (id_user, id_shelter, amount) VALUES (:id_user, :id_shelter, :amount)"
        );
        return $stmt->execute([
            ':id_user' => $id_user,
            ':id_shelter' => $id_shelter,
            ':amount' => $amount
        ]);
    }

        public function getAllShelters() {
        $stmt = $this->pdo->query("SELECT * FROM shelters");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}