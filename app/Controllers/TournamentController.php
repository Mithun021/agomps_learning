<?php

namespace App\Controllers;
use App\Models\League_session_model;
use App\Models\Sports_model;
use App\Models\Sports_subcategory_model;
use App\Models\Tournament_model;

class TournamentController extends BaseController{
    public function add_tournament()
    {
        $tournament_model = new Tournament_model();
        $sports_model = new Sports_model();
        $league_session_model = new League_session_model();
        $data = ['title' => 'Add Tournament'];
        if($this->request->is('get')){
            $data['sports'] = $sports_model->getActiveData();
            $data['league_session'] = $league_session_model->getActiveData();
            return view('admin/tournament/add-tournament',$data);
        }else if($this->request->is('post')){
           $tournamentID = $tournament_model->generateTournamentID();
            // $featuredPhoto = $this->request->getFile('featured_image');
            // if ($featuredPhoto->isValid() && ! $featuredPhoto->hasMoved()) {
            //     $featuredPhotoNewName = rand(0, 9999) . $featuredPhoto->getRandomName();
            //     $featuredPhoto->move(ROOTPATH . 'public/admin/uploads/tournament', $featuredPhotoNewName);
            // } else {
            //     $featuredPhotoNewName = "";
            // }

            $data = [
                'tournament_id' => $tournamentID,
                'title' => $this->request->getPost('tournament_title'),
                'league_session_id' => $this->request->getPost('league_category_name'),
                'league_for' => $this->request->getPost('league_for'),
                'game_type' => $this->request->getPost('game_type'),
                'sports_id' => $this->request->getPost('sports_category'),
                'sport_subcategory' => $this->request->getPost('sport_subcategory'),
                'min_players' => $this->request->getPost('min_players'),
                'max_players' => $this->request->getPost('max_players'),
                'min_age' => $this->request->getPost('min_age'),
                'max_age' => $this->request->getPost('max_age'),
                'registration_fee' => $this->request->getPost('registration_fee') ?? 0,
                'discount_registration_fee' => $this->request->getPost('registration_fee_after_discount') ?? 0,
                'team_entry_fee' => $this->request->getPost('team_entry_fee') ?? 0,
                'team_entry_fee_discount' => $this->request->getPost('discount_team_entry_fee') ?? 0,
                'first_rank_price' => $this->request->getPost('first_rank_price'),
                'first_rank_trophy' => $this->request->getPost('first_rank_trophy'),
                'second_rank_price' => $this->request->getPost('second_rank_price'),
                'second_rank_trophy' => $this->request->getPost('second_rank_trophy'),
                'third_rank_price' => $this->request->getPost('third_rank_price'),
                'third_rank_trophy' => $this->request->getPost('third_rank_trophy'),
                'description' => $this->request->getPost('description'),
                'venue_address' => $this->request->getPost('venue_address'),
                'city' => $this->request->getPost('venue_city'),
                'state' => $this->request->getPost('venue_state'),
                'reg_date_start' => $this->request->getPost('reg_start_date'),
                'reg_date_end' => $this->request->getPost('reg_end_date'),
                'gift_hampers' => $this->request->getPost('git_hampers'),
                // 'featured_image' => $featuredPhotoNewName,
                'status' => $this->request->getPost('status'),
            ];

            //echo "<pre>"; print_r($data); die;

            $result = $tournament_model->add($data);
            if ($result === true) {
                return redirect()->to('admin/add-tournament')->with('status','<div class="alert alert-success" role="alert"> Data Add Successful </div>');
            } else {
                return redirect()->to('admin/add-tournament')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }

        }
    }

    public function tournament_list()
    {
        $tournament_model = new Tournament_model();
        $data = ['title' => 'Tournament List'];
        $data['tournament'] = $tournament_model->get();
        return view('admin/tournament/tournament-list',$data);
    }

    public function edit_tournament($id)
    {
        $tournament_model = new Tournament_model();
        $sports_model = new Sports_model();
        $sports_subcategory_model = new Sports_subcategory_model();
        $league_session_model = new League_session_model();
        $data = ['title' => 'Edit Tournament','tournament_id' => $id];
        $data['tournament_detail'] = $tournament_model->get($id);
        $data['sports_subcategory'] = $sports_subcategory_model->find_sports($data['tournament_detail']['sports_id']);
        if($this->request->is('get')){
            $data['sports'] = $sports_model->getActiveData();
            $data['league_session'] = $league_session_model->getActiveData();
            $data['tournament'] = $tournament_model->get($id);
            return view('admin/tournament/edit-tournament',$data);
        }else if($this->request->is('post')){
            $data = [
                'title' => $this->request->getPost('tournament_title'),
                'league_session_id' => $this->request->getPost('league_category_name'),
                'league_for' => $this->request->getPost('league_for'),
                'game_type' => $this->request->getPost('game_type'),
                'sports_id' => $this->request->getPost('sports_category'),
                'sport_subcategory' => $this->request->getPost('sport_subcategory'),
                'min_players' => $this->request->getPost('min_players'),
                'max_players' => $this->request->getPost('max_players'),
                'min_age' => $this->request->getPost('min_age'),
                'max_age' => $this->request->getPost('max_age'),
                'registration_fee' => $this->request->getPost('registration_fee') ?? 0,
                'discount_registration_fee' => $this->request->getPost('registration_fee_after_discount') ?? 0,
                'team_entry_fee' => $this->request->getPost('team_entry_fee') ?? 0,
                'team_entry_fee_discount' => $this->request->getPost('discount_team_entry_fee') ?? 0,
                'first_rank_price' => $this->request->getPost('first_rank_price'),
                'first_rank_trophy' => $this->request->getPost('first_rank_trophy'),
                'second_rank_price' => $this->request->getPost('second_rank_price'),
                'second_rank_trophy' => $this->request->getPost('second_rank_trophy'),
                'third_rank_price' => $this->request->getPost('third_rank_price'),
                'third_rank_trophy' => $this->request->getPost('third_rank_trophy'),
                'description' => $this->request->getPost('description'),
                'venue_address' => $this->request->getPost('venue_address'),
                'city' => $this->request->getPost('venue_city'),
                'state' => $this->request->getPost('venue_state'),
                'reg_date_start' => $this->request->getPost('reg_start_date'),
                'reg_date_end' => $this->request->getPost('reg_end_date'),
                'gift_hampers' => $this->request->getPost('git_hampers'),
                // 'featured_image' => $featuredPhotoNewName,
                'status' => $this->request->getPost('status'),
            ];

            //echo "<pre>"; print_r($data); die;

            $result = $tournament_model->add($data,$id);
            if ($result === true) {
                return redirect()->to('admin/edit-tournament/'.$id)->with('status','<div class="alert alert-success" role="alert"> Data Update Successful </div>');
            } else {
                return redirect()->to('admin/edit-tournament/'.$id)->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
            }
        }
    }

    public function delete_tournament($id)
    {
        $tournament_model = new Tournament_model();
        $result = $tournament_model->delete($id);
        if ($result === true) {
            return redirect()->to('admin/tournament-list')->with('status','<div class="alert alert-success" role="alert"> Data Delete Successful </div>');
        } else {
            return redirect()->to('admin/tournament-list')->with('status','<div class="alert alert-danger" role="alert"> '.$result.' </div>');
        }
    }

}
?>