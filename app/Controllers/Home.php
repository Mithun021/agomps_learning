<?php

namespace App\Controllers;

use App\Models\Customer_detail_model;

class Home extends BaseController
{
    public function index(): string
    {
        if(session()->get('isLoggedIn')){
            $customerId = session()->get('customer_ac_id');
            $data = ['title' => 'Complete Profile','user_id' => $customerId];
            $customer_detail_model = new Customer_detail_model();
            $customer_detail = $customer_detail_model->where('user_id',$customerId)->first();
            if ($customer_detail['name'] == "" || $customer_detail['phone_number'] == false || $customer_detail['phone_number'] == "") {
                return view('auth/user-kyc',$data);
            }
        }

        $data = ['title' => 'Agomps India'];
        return view('index',$data);
    }
}
