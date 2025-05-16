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

    public function setName($name) {
        $this->name = $name;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setAge($age) {
        $this->age = $age;
    }
    
    public function setSex($sex) {
        $this->sex = $sex;
    }

    public function setSize($size) {
        $this->size = $size;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function setEntryDate($entry_date) {
        $this->entry_date = $entry_date;
    }

    public function setState($state) {
        $this->state = $state;
    }

    public function addAnimal($user_id) {
        $stmt = $this->pdo->prepare("
            INSERT INTO animals (name, type, age, sex, size, description, foto, entry_date, state, id_user)
            VALUES (:name, :type, :age, :sex, :size, :description, :foto, :entry_date, :state, :id_user)
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
        $stmt->bindParam(':id_user', $user_id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM animals WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByType($type) {
        $stmt = $this->pdo->prepare("SELECT * FROM animals WHERE type = :type AND state = 'Adopción activa' ORDER BY entry_date DESC");
        $stmt->bindParam(':type', $type);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByTypeExcept($type, $excludeId) {
        $stmt = $this->pdo->prepare("SELECT * FROM animals WHERE type = :type AND id != :excludeId AND state = 'Adopción activa' ORDER BY entry_date DESC");
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':excludeId', $excludeId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM animals WHERE state = 'Adopción activa'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllOrdered() {
        $stmt = $this->pdo->query("SELECT * FROM animals WHERE state = 'Adopción activa' ORDER BY entry_date DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLatest($limit = 3) {
        $stmt = $this->pdo->prepare("SELECT * FROM animals WHERE state = 'Adopción activa' ORDER BY entry_date DESC LIMIT :limit");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFavorites($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM animals WHERE id IN (SELECT id_animal FROM favorites WHERE id_user = :user_id) AND state = 'Adopción activa'");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addFavorite($user_id, $animal_id) {
        $stmt = $this->pdo->prepare("SELECT 1 FROM favorites WHERE id_user = :user_id AND id_animal = :animal_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':animal_id', $animal_id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->fetch()) {
            return true;
        }

        $stmt = $this->pdo->prepare("INSERT INTO favorites (id_user, id_animal) VALUES (:user_id, :animal_id)");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':animal_id', $animal_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function removeFavorite($user_id, $animal_id) {
        $stmt = $this->pdo->prepare("DELETE FROM favorites WHERE id_user = :user_id AND id_animal = :animal_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':animal_id', $animal_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getUserFavoriteIds($user_id) {
        $stmt = $this->pdo->prepare("SELECT id_animal FROM favorites WHERE id_user = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }  

    public function setInactive($id_animal) {
        $stmt = $this->pdo->prepare("UPDATE animals SET state = 'Adopción no activa' WHERE id = :id_animal");
        $stmt->bindParam(':id_animal', $id_animal, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function validateAnimal() {
        $errors = [];

        if (empty($this->name)) {
            $errors['nombre'] = "El nombre del animal es obligatorio.";
        }
        if (empty($this->type)) {
            $errors['tipo'] = "El tipo de animal es obligatorio.";
        }
        if (empty($this->age)) {
            $errors['edad'] = "La edad del animal es obligatoria.";
        }
        if (empty($this->sex)) {
            $errors['sexo'] = "El sexo del animal es obligatorio.";
        }
        if (empty($this->size)) {
            $errors['tamano'] = "El tamaño del animal es obligatorio.";
        }
        if (empty($this->entry_date)) {
            $errors['fecha_ingreso'] = "La fecha de ingreso es obligatoria.";
        }
        if (empty($this->state)) {
            $errors['estado'] = "El estado de adopción es obligatorio.";
        }
        if (empty($this->foto)) {
            $errors['foto'] = "La foto del animal es obligatoria.";
        } elseif (!filter_var($this->foto, FILTER_VALIDATE_URL)) {
            $errors['foto'] = "La URL de la foto no es válida.";
        }
        if (empty($this->description)) {
            $errors['descripcion'] = "La descripción del animal es obligatoria.";
        } elseif (strlen($this->description) > 500) {
            $errors['descripcion'] = "La descripción no puede exceder los 500 caracteres.";
        }

        return $errors;
    }
}