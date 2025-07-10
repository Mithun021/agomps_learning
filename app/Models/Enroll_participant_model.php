<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Enroll_participant_model extends Model
    {
        protected $table         = 'enroll_participant_details';
        protected $primaryKey = 'id';
        protected $allowedFields = ['enroll_tournament_id','participant_name','participant_mobile','participant_age','participant_type'];

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

        public function get_by_enroll_tournament($enroll_tournament_id){
            return $this->where('enroll_tournament_id',$enroll_tournament_id)->findAll();
        }
        
    }
?>