<?php

require_once __DIR__ . '/../model/Payment.php';

class PaymentController {

    public function validatePayment($data, $user_id, $id_shelter) {
        $payment = new Payment(getDBConnection());

        $errors = $payment->validatePayment($data);
        if (!empty($errors)) {
            return $errors;
        }
        $result = $payment->saveDonation($user_id, $id_shelter, $data['amount']);
        return $result;
    }
}