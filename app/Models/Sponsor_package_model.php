<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Sponsor_package_model extends Model
    {
        protected $table         = 'sponsor_package';
        protected $primaryKey = 'id';
        protected $allowedFields = ['sponsor_category_id','package_name'];

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
        public function getByCategory($id){
            return $this->where('sponsor_category_id',$id)->findAll();
        }
        
    }
?>