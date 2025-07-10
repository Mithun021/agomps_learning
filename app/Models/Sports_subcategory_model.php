<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Sports_subcategory_model extends Model
    {
        protected $table         = 'sports_sub_category';
        protected $primaryKey = 'id';
        protected $allowedFields = ['sports_id','sub_category_name','status'];

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

        public function find_sports($id){
           return $this->where('sports_id',$id)->findAll();
        }
        
    }
?>