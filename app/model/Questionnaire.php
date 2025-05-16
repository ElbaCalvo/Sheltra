<?php
// filepath: c:\xampp\htdocs\Sheltra\app\model\Questionnaire.php

class Questionnaire
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($data)
    {
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
        $result = $stmt->execute($data);
        if (!$result) {
            echo '<pre>';
            print_r($stmt->errorInfo());
            echo '</pre>';
        }
        return $result;
    }

    public function validateQuestionnaire($post)
    {
        $errors = [];

        if (empty($post['applic_name'])) $errors['applic_name'] = "El nombre es obligatorio.";
        if (empty($post['applic_mail'])) $errors['applic_mail'] = "El email es obligatorio.";
        if (empty($post['applic_phone'])) $errors['applic_phone'] = "El teléfono es obligatorio.";
        if (empty($post['applic_address'])) $errors['applic_address'] = "La dirección es obligatoria.";
        if (empty($post['housing_type'])) $errors['housing_type'] = "Selecciona el tipo de vivienda.";
        if (empty($post['ownership_status'])) $errors['ownership_status'] = "Indica si la vivienda es propia o alquilada.";

        if (isset($post['ownership_status']) && $post['ownership_status'] === 'alquilada' && !isset($post['pets_allowed'])) {
            $errors['pets_allowed'] = "Indica si permiten mascotas en la vivienda alquilada.";
        }

        if (!isset($post['outdoor_space'])) $errors['outdoor_space'] = "Indica si tienes patio o jardín.";
        if (!isset($post['pets_before'])) $errors['pets_before'] = "Indica si has tenido mascotas antes.";
        if (!isset($post['other_pets'])) $errors['other_pets'] = "Indica si tienes otras mascotas.";
        if (empty($post['text'])) $errors['text'] = "Cuéntanos por qué quieres adoptar.";
        if (!isset($post['maintenance'])) $errors['maintenance'] = "Indica si asumirás los cuidados.";
        if (!isset($post['contract'])) $errors['contract'] = "Indica si aceptas firmar contrato.";
        if (!isset($post['post_adop'])) $errors['post_adop'] = "Indica si aceptas seguimiento post-adopción.";

        return $errors;
    }
}
