<?php
namespace App\Controllers;

use App\Models\Sponsor_category_model;
use App\Models\Sponsor_model;
use App\Models\Sponsor_package_model;
use App\Models\Sponsor_package_type_model;

class SponsorController extends BaseController
{
    public function create_sponsor(){
        $sponsor_category_model = new Sponsor_category_model();
        $sponsor_model= new Sponsor_model();
        $data = ['title' => 'Sponsor'];
        if ($this->request->is('get')) {
            $data['category'] = $sponsor_category_model->get();
            $data['sponsor'] = $sponsor_model->get();
            return view('admin/sponsor/create-sponsor',$data);
        }else if ($this->request->is('post')) {
            $data =[
                'sponsor_name' => $this->request->getPost('sponsor_name'),
                'package_name' => $this->request->getPost('package_name'),
                'package_type' => implode(',',$this->request->getPost('package_type')),
                'promotion_days' => $this->request->getPost('promotion_days'),
                'promotion_location' => $this->request->getPost('promotion_location'),
                'promotion_amount' => $this->request->getPost('promotion_amount'),
                'discount_promotion_amount' => $this->request->getPost('discount_promotion_amount'),
                'additional_benefits' => $this->request->getPost('additional_benefits'),
            ];
            $result = $sponsor_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/create-sponsor')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/create-sponsor')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }
    public function delete_create_sponsor($id){
        $sponsor_model= new Sponsor_model();
        $result = $sponsor_model->delete($id);
        if ($result === true) {
            return redirect()->to('admin/create-sponsor')->with('status','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/create-sponsor')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
        }
    }

    public function applied_sponsor_list(){
        $data = ['title' => 'Sponsor Applied List'];
        if ($this->request->is('get')) {
            return view('admin/sponsor/applied-sponsor-list',$data);
        }else if ($this->request->is('post')) {
        }
    }

    public function sponsor_category(){
        $sponsor_category_model = new Sponsor_category_model();
        $data = ['title' => 'Sponsor Category'];
        if ($this->request->is('get')) {
            $data['category'] = $sponsor_category_model->get();
            return view('admin/sponsor/sponsor-category',$data);
        }else if ($this->request->is('post')) {
            $data =[
                'sponsor_categpry' => $this->request->getPost('sponsor_categpry')
            ];
            $result = $sponsor_category_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/sponsor-category')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/sponsor-category')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function edit_sponsor_category($id){
        $sponsor_category_model = new Sponsor_category_model();
        $data = ['title' => 'Sponsor Category','sponsor_id' => $id];
        if ($this->request->is('get')) {
            $data['category'] = $sponsor_category_model->get();
            $data['category_detail'] = $sponsor_category_model->get($id);
            return view('admin/sponsor/edit-sponsor-category',$data);
        }else if ($this->request->is('post')) {
            $data =[
                'sponsor_categpry' => $this->request->getPost('sponsor_categpry')
            ];
            $result = $sponsor_category_model->add($data,$id);
            if ($result === true) {
                return redirect()->to('admin/edit-sponsor-category/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/edit-sponsor-category/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function delete_sponsor_category($id){
        $sponsor_category_model = new Sponsor_category_model();
        $result = $sponsor_category_model->delete($id);
        if ($result === true) {
            return redirect()->to('admin/sponsor-category')->with('status','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/sponsor-category')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
        }
    }

    public function sponsor_package(){
        $sponsor_category_model = new Sponsor_category_model();
        $sponsor_package_model = new Sponsor_package_model();
        $data = ['title' => 'Sponsor Package'];
        if ($this->request->is('get')) {
            $data['category'] = $sponsor_category_model->get();
            $data['package'] = $sponsor_package_model->get();
            return view('admin/sponsor/sponsor-package',$data);
        }else if ($this->request->is('post')) {
            $data =[
                'sponsor_category_id' => $this->request->getPost('sponsor_category_id'),
                'package_name' => $this->request->getPost('package_name')
            ];
            $result = $sponsor_package_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/sponsor-package')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/sponsor-package')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function edit_sponsor_package($id){
        $sponsor_category_model = new Sponsor_category_model();
        $sponsor_package_model = new Sponsor_package_model();
        $data = ['title' => 'Sponsor Package','package_id' => $id];
        if ($this->request->is('get')) {
            $data['category'] = $sponsor_category_model->get();
            $data['package'] = $sponsor_package_model->get();
            $data['package_detail'] = $sponsor_package_model->get($id);
            return view('admin/sponsor/edit-sponsor-package',$data);
        }else if ($this->request->is('post')) {
            $data =[
                'sponsor_category_id' => $this->request->getPost('sponsor_category_id'),
                'package_name' => $this->request->getPost('package_name')
            ];
            $result = $sponsor_package_model->add($data,$id);
            if ($result === true) {
                return redirect()->to('admin/edit-sponsor-package/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/edit-sponsor-package/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function delete_sponsor_package($id){
        $sponsor_package_model = new Sponsor_package_model();
        $result = $sponsor_package_model->delete($id);
        if ($result === true) {
            return redirect()->to('admin/sponsor-package')->with('status','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/sponsor-package')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
        }
    }

    public function sponsor_package_type(){
        $sponsor_package_model = new Sponsor_package_model();
        $sponsor_package_type_model = new Sponsor_package_type_model();
        $data = ['title' => 'Sponsor Package Type'];
        if ($this->request->is('get')) {
            $data['package'] = $sponsor_package_model->get();
            $data['package_type'] = $sponsor_package_type_model->get();
            return view('admin/sponsor/sponsor-package-type',$data);
        }else if ($this->request->is('post')) {
            $data =[
                'sponsor_package_id' => $this->request->getPost('sponsor_package_id'),
                'package_type' => $this->request->getPost('package_type')
            ];
            $result = $sponsor_package_type_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/sponsor-package-type')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/sponsor-package-type')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function edit_sponsor_package_type($id){
        $sponsor_package_model = new Sponsor_package_model();
        $sponsor_package_type_model = new Sponsor_package_type_model();
        $data = ['title' => 'Sponsor Package Type','package_type_id' => $id];
        if ($this->request->is('get')) {
            $data['package'] = $sponsor_package_model->get();
            $data['package_type'] = $sponsor_package_type_model->get();
            $data['package_type_detail'] = $sponsor_package_type_model->get($id);
            return view('admin/sponsor/edit-sponsor-package-type',$data);
        }else if ($this->request->is('post')) {
            $data =[
                'sponsor_package_id' => $this->request->getPost('sponsor_package_id'),
                'package_type' => $this->request->getPost('package_type')
            ];
            $result = $sponsor_package_type_model->add($data,$id);
            if ($result === true) {
                return redirect()->to('admin/edit-sponsor-package-type/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/edit-sponsor-package-type/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function delete_sponsor_package_type($id){
        $sponsor_package_type_model = new Sponsor_package_type_model();
        $result = $sponsor_package_type_model->delete($id);
        if ($result === true) {
            return redirect()->to('admin/sponsor-package-type')->with('status','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/sponsor-package-type')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
        }
    }

}