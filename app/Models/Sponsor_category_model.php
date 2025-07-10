<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Sponsor_category_model extends Model
    {
        protected $table         = 'sponsor_category';
        protected $primaryKey = 'id';
        protected $allowedFields = ['sponsor_categpry'];

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
        
    }
?>