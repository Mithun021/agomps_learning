<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Enroll_tournament_model extends Model
    {
        protected $table         = 'enroll_tournament';
        protected $primaryKey = 'id';
        protected $allowedFields = ['participant_id','tournament_id','registration_status','payment_status'];

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
        
        public function get_by_participant_and_tournament($participant_id,$tournament_id){
            return $this->where('participant_id',$participant_id)->where('tournament_id',$tournament_id)->where('registration_status',1)->first();
        }

    }
?>