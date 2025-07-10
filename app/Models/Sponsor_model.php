<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Sponsor_model extends Model
    {
        protected $table         = 'create_sponsor_package';
        protected $primaryKey = 'id';
        protected $allowedFields = ['sponsor_name','package_name','package_type','promotion_days','promotion_location','promotion_amount','discount_promotion_amount','additional_benefits'];

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
                $result = $this->orderBy('sponsor_name','asc')->findAll();
            }
            return $result;
        }
        public function getByCategory($id){
            return $this->where('sponsor_name',$id)->findAll();
        }
    }
?>