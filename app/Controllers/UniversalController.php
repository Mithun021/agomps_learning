<?php

namespace App\Controllers;

use App\Models\Players_category_model;
use App\Models\Sponsor_package_model;
use App\Models\Sponsor_package_type_model;
use App\Models\Sports_model;
use App\Models\Sports_subcategory_model;

class UniversalController extends BaseController{
    public function fetch_sports_subcategory(){
        $sports_subcategory_model = new Sports_subcategory_model();
        $sports_id = $this->request->getPost('sports_id');
        $data = $sports_subcategory_model->find_sports($sports_id);
        return $this->response->setJSON($data);
    }

    public function getParticipantTypes(){
        $players_category_model = new Players_category_model();
        $sports_id = $this->request->getPost('sports_id');
        $data = $players_category_model->getbysports($sports_id);
        return $this->response->setJSON($data);
    }

    public function find_sponsor_package(){
        $sponsor_package_model = new Sponsor_package_model();
        $sponsor_name = $this->request->getPost('sponsor_name');
        $data = $sponsor_package_model->getByCategory($sponsor_name);
        return $this->response->setJSON($data);
    }

    public function find_sponsor_package_type(){
        $sponsor_package_type_model = new Sponsor_package_type_model();
        $package_name = $this->request->getPost('package_name');
        $data = $sponsor_package_type_model->getByCategory($package_name);
        return $this->response->setJSON($data);
    }

    public function test_mail(){
        $email = \Config\Services::email();

        // Set SMTP configuration (if not configured globally)
        $email->setFrom('contact@agomps.com', 'Agomps');
        $email->setTo('mithunkr79038@gmail.com');
        $email->setSubject('Test Emai');

        // HTML message with embedded image
        $email->setMessage('
            <html>
            <body>
                <h1>Welcome to AGOMPS</h1>
                <p>Kese ho dosto:</p>
                <p>Thank you for choosing us!</p>
            </body>
            </html>
        ');

        // Send the email
        if ($email->send()) {
            echo "Email with logo successfully sent!";
        } else {
            echo "Failed to send email. Debug: " . $email->printDebugger(['headers']);
        }
}

}