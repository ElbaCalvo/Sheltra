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

    public function validateQuestionnaire($post) {
        $errors = [];

        if (empty($post['nombre'])) $errors['nombre'] = "El nombre es obligatorio.";
        if (empty($post['email'])) $errors['email'] = "El email es obligatorio.";
        if (empty($post['telefono'])) $errors['telefono'] = "El teléfono es obligatorio.";
        if (empty($post['direccion'])) $errors['direccion'] = "La dirección es obligatoria.";
        if (empty($post['vivienda'])) $errors['vivienda'] = "Selecciona el tipo de vivienda.";
        if (isset($post['vivienda']) && $post['vivienda'] === 'alquilada' && !isset($post['permiten_mascotas'])) {
            $errors['permiten_mascotas'] = "Indica si permiten mascotas en la vivienda alquilada.";
        }
        if (!isset($post['jardin'])) $errors['jardin'] = "Indica si tienes patio o jardín.";
        if (!isset($post['mascotas_previas'])) $errors['mascotas_previas'] = "Indica si has tenido mascotas antes.";
        if (!isset($post['mascotas_actuales'])) $errors['mascotas_actuales'] = "Indica si tienes otras mascotas.";
        if (empty($post['motivo'])) $errors['motivo'] = "Cuéntanos por qué quieres adoptar.";
        if (!isset($post['asumir_cuidados'])) $errors['asumir_cuidados'] = "Indica si asumirás los cuidados.";
        if (!isset($post['contrato'])) $errors['contrato'] = "Indica si aceptas firmar contrato.";
        if (!isset($post['seguimiento'])) $errors['seguimiento'] = "Indica si aceptas seguimiento post-adopción.";

        return $errors;
    }
}