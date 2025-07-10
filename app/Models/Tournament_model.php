<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Tournament_model extends Model
    {
        protected $table         = 'tournament_detail';
        protected $primaryKey = 'id';
        protected $allowedFields = ['tournament_id','title','league_session_id','league_for','game_type','sports_id','sport_subcategory','min_players','max_players','min_age','max_age','registration_fee','discount_registration_fee','team_entry_fee','team_entry_fee_discount','first_rank_price','first_rank_trophy','second_rank_price','second_rank_trophy','third_rank_price','third_rank_trophy','description','featured_image','venue_address','city','state','reg_date_start','reg_date_end','gift_hampers','status'];
        protected $createdField  = 'created_at';

        public function add($data, $id = null) {
            if ($id != null) {
                $result = $this->update($id, $data);
                return $result ? true : 'Data not updated: Update failed.';
            } else {
                $result = $this->insert($data);
                return $result ? true : 'Data not inserted: Insertion failed.';
            }
        }

        public function get($id = null){
            if($id != null){
                $result = $this->where('id',$id)->first();
            }else{
                $result = $this->findAll();
            }
            return $result;
        }

        public function getActiveData() {
            return $this->where('status', 1)->findAll();
        }
        public function getBySportsLeague($sports_id,$league_id){
            return $this->where('sports_id', $sports_id)->where('league_category_id', $league_id)->first();
        }
        public function getBySportsLeagueCurrentSession($sports_id,$league_id,$session_id){
            return $this->where('sports_id', $sports_id)->where('league_category_id', $league_id)->where('league_category_id',$session_id)->first();
        }

        public function get_by_category($league_id,$sports_id,$game_type){
            return $this->where('sports_id', $sports_id)->where('league_session_id', $league_id)->where('game_type',$game_type)->findAll();
        }

        public function generateTournamentID(){
            // Get the last inserted tournament_id
            $lastTournament = $this->orderBy('id', 'DESC')->first();

            if ($lastTournament && isset($lastTournament['tournament_id'])) {
                // Extract numeric part
                preg_match('/(\d+)$/', $lastTournament['tournament_id'], $matches);
                $newNumber = isset($matches[1]) ? intval($matches[1]) + 1 : 1;
            } else {
                $newNumber = 1; // If no previous record exists
            }

            // Format the ID (e.g., UPPLCRIC001)
            return 'UPPL' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        }


        public function search($tournament_for = null, $sports_category = null, $sport_subcategory = null)
        {
            $builder = $this->db->table('tournament_detail');
            $builder->select('tournament_detail.*, sports.name as sports_name,sports.sports_image');
            $builder->join('sports', 'sports.id = tournament_detail.sports_id', 'left');

            if (!empty($tournament_for)) {
                $builder->where('league_for', $tournament_for);
            }

            if (!empty($sports_category)) {
                $builder->where('sports_id', $sports_category);
            }

            if (!empty($sport_subcategory)) {
                $builder->where('sport_subcategory', $sport_subcategory);
            }

            $query = $builder->get();
            return $query->getResult(); // returns array of objects
        }

        
    }
?>