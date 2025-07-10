<?php

namespace App\Controllers;

use App\Models\Apply_spondor_model;
use App\Models\Customer_detail_model;
use App\Models\Sponsor_category_model;
use App\Models\Sponsor_model;
use App\Models\Tournament_model;

class FrontController extends BaseController
{
    public function userlogin()
    {
        $data = ['title' => 'User Login'];
        return view('user-login', $data);
    }

    public function userRegister()
    {
        $data = ['title' => 'User Register'];
        return view('user-register', $data);
    }

    public function tournaments()
    {
        $data = ['title' => 'All Tournament'];
        return view('tournaments', $data);
    }

    public function tournament_details($id)
    {
        $tournament_model = new Tournament_model();
        $data = ['title' => 'All Tournament', 'tournament_id' => $id];
        $data['tournament'] = $tournament_model->get($id);
        return view('tournament-details', $data);
    }

    public function privacy_policy()
    {
        $data = ['title' => 'Privacy Policy'];
        return view('legal/privacy-policy', $data);
    }
    public function term_condition()
    {
        $data = ['title' => 'Term & Condition'];
        return view('legal/term-condition', $data);
    }
    public function refund()
    {
        $data = ['title' => 'Refund Policy'];
        return view('legal/refund', $data);
    }

    public function contact()
    {
        $data = ['title' => 'Contact Us'];
        return view('legal/contact', $data);
    }

    public function sponsor()
    {
        $sponsor_category_model = new Sponsor_category_model();
        $data = ['title' => 'Sponsor', 'sponsor_category' => $sponsor_category_model->findAll()];
        return view('sponsor/sponsor', $data);
    }

    public function apply_sponsor($id)
    {
        $customer_detail_model = new Customer_detail_model();
        $apply_spondor_model = new Apply_spondor_model();
        $sponsor_model = new Sponsor_model();
        $data = ['title' => 'Apply Sponsor', 'sponsor_id' => $id, 'sponsor_detail' => $sponsor_model->where('id', $id)->first()];
        $customer_ac_id = session()->get('customer_ac_id'); 
        $customer_detail = $customer_detail_model->getByuserid($customer_ac_id);
        $data['customer_detail'] = $apply_spondor_model->getByuserAndSponsor($customer_detail['id'],$id);
        if ($this->request->is('get')) {
            return view('sponsor/apply-sponsor', $data);
        } else if ($this->request->is('post')) {
            $firm_logo = $this->request->getFile('firm_logo');
            if ($firm_logo->isValid() && ! $firm_logo->hasMoved()) {
                $firm_logoNewName = rand(0, 9999) . $firm_logo->getRandomName();
                $firm_logo->move(ROOTPATH . 'public/assets/images/sponsor', $firm_logoNewName);
            } else {
                $firm_logoNewName = "";
            }
            $data = [
                'customer_id' => $customer_detail['id'],
                'sponsor_package_id' => $id,
                'firm_name' => $this->request->getPost('firm_name'),
                'firm_type' => $this->request->getPost('firm_type'),
                'firm_logo' => $firm_logoNewName,
                'customer_name' => $this->request->getPost('customer_name'),
                'phone_number' => $this->request->getPost('phone_number'),
                'email_id' => $this->request->getPost('email_id'),
                'state' => $this->request->getPost('state'),
                'city' => $this->request->getPost('city'),
                'pincode' => $this->request->getPost('pincode'),
                'aadhar_no' => $this->request->getPost('aadhar_no'),
                'pan_no' => $this->request->getPost('pan_no'),
                'sponsor_amount' => $this->request->getPost('sponsor_amount'),
                'apply_status' => 1
            ];
            $result = $apply_spondor_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/apply-sponsor/'.$id)->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/apply-sponsor/'.$id)->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }
}
