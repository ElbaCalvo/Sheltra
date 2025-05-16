<?php

require_once __DIR__ . '/../model/Animal.php';
require_once __DIR__ . '/../model/User.php';

class AnimalController {
    
    public function addAnimal($name, $type, $age, $sex, $size, $description, $foto, $entry_date, $state, $user_id) {
        $animal = new Animal(getDBConnection());
        $animal->setName($name);
        $animal->setType($type);
        $animal->setAge($age);
        $animal->setSex($sex);
        $animal->setSize($size);
        $animal->setDescription($description);
        $animal->setFoto($foto);
        $animal->setEntryDate($entry_date);
        $animal->setState($state);
        return $animal->addAnimal($user_id);
    }

    public function getAnimalById($id) {
        $animal = new Animal(getDBConnection());
        return $animal->getById($id);
    }

    public function getAnimalsByType($type) {
        $animal = new Animal(getDBConnection());
        return $animal->getByType($type);
    }

    public function getAnimalsByTypeExcept($type, $excludeId) {
        $animal = new Animal(getDBConnection());
        return $animal->getByTypeExcept($type, $excludeId);
    }

    public function getAllAnimals() {
        $animal = new Animal(getDBConnection());
        return $animal->getAll();
    }

    public function getAllAnimalsOrdered() {
        $animal = new Animal(getDBConnection());
        return $animal->getAllOrdered();
    }

    public function getLatestAnimals($limit = 3) {
        $animal = new Animal(getDBConnection());
        return $animal->getLatest($limit);
    }

    public function getFavorites($user_id) {
        $animal = new Animal(getDBConnection());
        return $animal->getFavorites($user_id);
    }

    public function addFavorite($user_id, $animal_id) {
        $animal = new Animal(getDBConnection());
        return $animal->addFavorite($user_id, $animal_id);
    }

    public function removeFavorite($user_id, $animal_id) {
        $animal = new Animal(getDBConnection());
        return $animal->removeFavorite($user_id, $animal_id);
    }

    public function getUserFavoriteIds($user_id) {
        $animal = new Animal(getDBConnection());
        return $animal->getUserFavoriteIds($user_id);
    }

    public function setInactive($id_animal) {
        $animal = new Animal(getDBConnection());
        return $animal->setInactive($id_animal);
    }

    public function validateAnimal($data) {
        $animal = new Animal(getDBConnection());
        $animal->setName($data['name'] ?? '');
        $animal->setType($data['type'] ?? '');
        $animal->setAge($data['age'] ?? '');
        $animal->setSex($data['sex'] ?? '');
        $animal->setSize($data['size'] ?? '');
        $animal->setDescription($data['description'] ?? '');
        $animal->setFoto($data['foto'] ?? '');
        $animal->setEntryDate($data['entry_date'] ?? '');
        $animal->setState($data['state'] ?? '');
        return $animal->validateAnimal();
    }
}