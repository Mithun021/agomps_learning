<?php

namespace App\Controllers;

use App\Models\League_session_model;
use App\Models\Players_category_model;
use App\Models\Sports_model;
use App\Models\Sports_subcategory_model;
use App\Models\Teams_model;

class MasterController extends BaseController
{
    public function sports_category()
    {
        $sports_model = new Sports_model();
        $data = ['title' => 'Sports'];
        if ($this->request->is('get')) {
            $data['sports'] = $sports_model->get();
            return view('admin/master/sports-category',$data);
        }else if ($this->request->is('post')) {
            $sportsPhoto = $this->request->getFile('sports_category_image');
            if ($sportsPhoto->isValid() && ! $sportsPhoto->hasMoved()) {
                $sportsPhotoImageName = rand(0,9999) . $sportsPhoto->getRandomName();
                $sportsPhoto->move(ROOTPATH . 'public/assets/images/sports', $sportsPhotoImageName);
            } else {
                $sportsPhotoImageName = "";
            }

            $sportsWhite = $this->request->getFile('sports_category_white_image');
            if ($sportsWhite->isValid() && ! $sportsWhite->hasMoved()) {
                $sportsWhiteImageName = 'w'.rand(0,9999) . $sportsWhite->getRandomName();
                $sportsWhite->move(ROOTPATH . 'public/assets/images/sports', $sportsWhiteImageName);
            } else {
                $sportsWhiteImageName = "";
            }

            $data = [
                'name' => $this->request->getPost('sports_category_name'),
                'sports_image' => $sportsPhotoImageName,
                'sports_image_category' => $sportsWhiteImageName,
                'description' => $this->request->getPost('sports_category_description'),
                'status' => $this->request->getPost('sports_category_status'),
                'cometitive_tournament' => $this->request->getPost('cometitive_tournament')
            ];
            $result = $sports_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/sports-category')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/sports-category')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function edit_sports_category($id){
        $sports_model = new Sports_model();
        $data = ['title' => 'Sports','sports_id' => $id];
        $data['sports_detail'] = $sports_model->get($id);
        if ($this->request->is('get')) {
            $data['sports'] = $sports_model->get();
            return view('admin/master/edit-sports-category',$data);
        }else if ($this->request->is('post')) {

            $sportsPhoto = $this->request->getFile('sports_category_image');
            $sportsWhite = $this->request->getFile('sports_category_white_image');


            $sports_detail = $sports_model->get($id);
            $oldsportsPhoto = $sports_detail['sports_image'];
            $oldsportsWhite = $sports_detail['sports_image_category'];

            if ($sportsPhoto->isValid() && !$sportsPhoto->hasMoved()) {
                if(file_exists("public/assets/images/sports/".$oldsportsPhoto)){
                    unlink("public/assets/images/sports/".$oldsportsPhoto);
                }
                $new_sport_file = $sportsPhoto->getRandomName();
                $sportsPhoto->move(ROOTPATH.'public/assets/images/sports/', $new_sport_file);
            }
            else{
                $new_sport_file = $oldsportsPhoto;
            }

            if ($sportsWhite->isValid() && !$sportsWhite->hasMoved()) {
                if(file_exists("public/assets/images/sports/".$oldsportsWhite)){
                    unlink("public/assets/images/sports/".$oldsportsWhite);
                }
                $new_sportwhite_file = 'w'.$sportsWhite->getRandomName();
                $sportsWhite->move(ROOTPATH.'public/assets/images/sports/', $new_sportwhite_file);
            }
            else{
                $new_sportwhite_file = $oldsportsWhite;
            }

            $data = [
                'name' => $this->request->getPost('sports_category_name'),
                'sports_image' => $new_sport_file,
                'sports_image_category' => $new_sportwhite_file,
                'description' => $this->request->getPost('sports_category_description'),
                'status' => $this->request->getPost('sports_category_status'),
                'cometitive_tournament' => $this->request->getPost('cometitive_tournament') ?? 0
            ];
            $result = $sports_model->add($data,$id);
            if ($result === true) {
                return redirect()->to('admin/edit-sports-category/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/edit-sports-category/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }

        }
    }

    public function delete_sports_category($id){
        $sports_model = new Sports_model();
        $sports_detail = $sports_model->get($id);
        if(file_exists("public/assets/images/sports/".$sports_detail['sports_image'])){
            unlink("public/assets/images/sports/".$sports_detail['sports_image']);
        }
        if(file_exists("public/assets/images/sports/".$sports_detail['sports_image_category'])){
            unlink("public/assets/images/sports/".$sports_detail['sports_image_category']);
        }
        $result = $sports_model->delete($id);
        if ($result === true) {
            return redirect()->to('admin/sports-category')->with('status','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/sports-category')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
        }
    }



    public function sports_subcategory()
    {
        $sports_subcategory_model = new Sports_subcategory_model();
        $sports_model = new Sports_model();
        $data = ['title' => 'Sports Sub Category'];
        if ($this->request->is('get')) {
            $data['sports'] = $sports_model->get();
            $data['sports_subcat'] = $sports_subcategory_model->get();
            return view('admin/master/sports-subcategory',$data);
        }else if ($this->request->is('post')) {
            
            $data = [
                'sports_id' => $this->request->getPost('sports_category_name'),
                'sub_category_name' => $this->request->getPost('sports_sub_category_name'),
                'status' => $this->request->getPost('sports_category_status')
            ];
            $result = $sports_subcategory_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/sports-subcategory')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/sports-subcategory')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function edit_sports_subcategory($id){
        $sports_subcategory_model = new Sports_subcategory_model();
        $sports_model = new Sports_model();
        $data = ['title' => 'Sports Sub Category','sports_id' => $id];
        $data['sports_detail'] = $sports_subcategory_model->get($id);
        if ($this->request->is('get')) {
            $data['sports'] = $sports_model->get();
            $data['sports_subcat'] = $sports_subcategory_model->get();
            return view('admin/master/edit-sports-subcategory',$data);
        }else if ($this->request->is('post')) {
            $data = [
                'sports_id' => $this->request->getPost('sports_category_name'),
                'sub_category_name' => $this->request->getPost('sports_sub_category_name'),
                'status' => $this->request->getPost('sports_category_status')
            ];
            $result = $sports_subcategory_model->add($data,$id);
            if ($result === true) {
                return redirect()->to('admin/edit-sports-subcategory/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/edit-sports-subcategory/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function delete_sports_subcategory($id){
        $sports_subcategory_model = new Sports_subcategory_model();
        $result = $sports_subcategory_model->delete($id);
        if ($result === true) {
            return redirect()->to('admin/sports-subcategory')->with('status','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/sports-subcategory')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
        }
    }

    public function league_session()
    {
        $league_session_model = new League_session_model();
        $data = ['title' => 'League Session'];
        if ($this->request->is('get')) {
            $data['league_session'] = $league_session_model->get();
            return view('admin/master/league-session', $data);
        } else if ($this->request->is('post')) {
            $data = [
                'league_name' => $this->request->getPost('league_session_name'),
                'notes' => $this->request->getPost('league_session_notes'),
                'status' => $this->request->getPost('status') 
            ];
            $result = $league_session_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/league-session')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/league-session')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function teams()
    {
        $teams_model = new Teams_model();
        $data = ['title' => 'Teams'];
        if ($this->request->is('get')) {
            $data['teams'] = $teams_model->get();
            return view('admin/master/teams', $data);
        } else if ($this->request->is('post')) {
            $logo = $this->request->getFile('team_logo');
            if ($logo->isValid() && ! $logo->hasMoved()) {
                $logoImageName = rand(0, 9999) . $logo->getRandomName();
                $logo->move(ROOTPATH . 'public/assets/images/teams', $logoImageName);
            } else {
                $logoImageName = "";
            }
            $data = [
                'name' => $this->request->getPost('team_name'),
                'logo' => $logoImageName,
                'status' => $this->request->getPost('status')
            ];
            $result = $teams_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/teams')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/teams')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function players_category()
    {
        $sports_model = new Sports_model();
        $players_category_model = new Players_category_model();
        $data = ['title' => 'Players Category'];
        if ($this->request->is('get')) {
            $data['players'] = $players_category_model->get();
            $data['sports'] = $sports_model->get();
            return view('admin/master/players-category', $data);
        } else if ($this->request->is('post')) {
            $data = [
                'sports_id' => $this->request->getPost('sports_category'),
                'name' => $this->request->getPost('player_category'),
            ];
            $result = $players_category_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/players-category')->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/players-category')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function edit_players_category($id)
    {
        $sports_model = new Sports_model();
        $players_category_model = new Players_category_model();
        $data = ['title' => 'Players Category', 'players_id' => $id];
        $data['players_detail'] = $players_category_model->get($id);
        if ($this->request->is('get')) {
            $data['players'] = $players_category_model->get();
            $data['sports'] = $sports_model->get();
            return view('admin/master/edit-players-category', $data);
        } else if ($this->request->is('post')) {
            $data = [
                'sports_id' => $this->request->getPost('sports_category'),
                'name' => $this->request->getPost('player_category'),
            ];
            $result = $players_category_model->add($data, $id);
            if ($result === true) {
                return redirect()->to('admin/edit-players-category/' . $id)->with('status', '<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/edit-players-category/' . $id)->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
            }
        }
    }

    public function delete_players_category($id)
    {
        $players_category_model = new Players_category_model();
        $result = $players_category_model->delete($id);
        if ($result === true) {
            return redirect()->to('admin/players-category')->with('status', '<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/players-category')->with('status', '<div class="alert alert-danger" role="alert"> ' . $result . ' </div>');
        }
    }

}
