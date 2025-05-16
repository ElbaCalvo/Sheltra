<?php

require_once __DIR__ . '/../model/Donations.php';
require_once __DIR__ . '/../model/User.php';

class DonationsController {
    
    public function addDonation($id_user, $id_shelter, $amount) {
        $donation = new Donations(getDBConnection());
        return $donation->addDonation($id_user, $id_shelter, $amount);
    }
    
    public function getAllShelters() {
        $donation = new Donations(getDBConnection());
        return $donation->getAllShelters();
    }
}