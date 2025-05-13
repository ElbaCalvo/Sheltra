<?php

class Animal {
    private $pdo;

    public $id;
    public $name;
    public $type;
    public $age;
    public $sex;
    public $size;
    public $description;
    public $foto;
    public $entry_date;
    public $state;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addAnimal() {
        $stmt = $this->pdo->prepare("
            INSERT INTO animals (name, type, age, sex, size, description, foto, entry_date, state)
            VALUES (:name, :type, :age, :sex, :size, :description, :foto, :entry_date, :state)
        ");
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':age', $this->age);
        $stmt->bindParam(':sex', $this->sex);
        $stmt->bindParam(':size', $this->size);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':foto', $this->foto);
        $stmt->bindParam(':entry_date', $this->entry_date);
        $stmt->bindParam(':state', $this->state);

        return $stmt->execute();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM animals WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}