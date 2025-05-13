<?php
// filepath: c:\xampp\htdocs\Sheltra\app\model\Questionnaire.php

class Questionnaire {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO applications (
                id_user, id_animal, date, status, text, resolution,
                applic_name, applic_mail, applic_phone, applic_address,
                housing_type, ownership_status, pets_allowed, outdoor_space,
                pets_before, other_pets, maintenance, contract, post_adop
            ) VALUES (
                :id_user, :id_animal, :date, :status, :text, :resolution,
                :applic_name, :applic_mail, :applic_phone, :applic_address,
                :housing_type, :ownership_status, :pets_allowed, :outdoor_space,
                :pets_before, :other_pets, :maintenance, :contract, :post_adop
            )
        ");
        return $stmt->execute($data);
    }
}