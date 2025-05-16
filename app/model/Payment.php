<?php
require_once __DIR__ . '/Donations.php';

class Payment
{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function validatePayment($data) {
        $errors = [];
        $iban = str_replace(' ', '', strtoupper($data['card_number']));
        
        if ($data['amount'] <= 0) {
            $errors['amount'] = "Introduce una cantidad válida.";
        }
        if (!preg_match('/^ES\d{22}$/', $iban)) {
            $errors['card_number'] = "El número de cuenta debe ser un IBAN español válido.";
        }
        if (!preg_match('/^\d{3,4}$/', $data['cvv'])) {
            $errors['cvv'] = "El CVV debe tener 3 o 4 dígitos.";
        }
        if (!preg_match('/^(0[1-9]|1[0-2])\/\d{2}$/', $data['expiry'])) {
            $errors['expiry'] = "Formato de fecha de caducidad inválido. Usa MM/YY.";
        } else {
            $month = (int)substr($data['expiry'], 0, 2);
            $year = (int)substr($data['expiry'], 3, 2) + 2000;
            $now = new DateTime();
            $exp = DateTime::createFromFormat('Y-m', "$year-$month");
            $exp->modify('last day of this month');
            if ($exp < $now) {
                $errors['expiry'] = "La fecha de caducidad no puede ser anterior a la actual.";
            }
        }

        return $errors;
    }

    public function saveDonation($user_id, $id_shelter, $amount) {
        $donations = new Donations($this->pdo);
        return $donations->addDonation($user_id, $id_shelter, $amount);
    }
}