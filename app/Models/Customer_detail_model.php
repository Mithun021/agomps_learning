<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Customer_detail_model extends Model
    {
        protected $table         = 'customers_detail';
        protected $primaryKey = 'id';
        protected $allowedFields = ['user_id','name','email','phone_number','dob'];

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

        public function getByuserid($id){
            if($id != null){
                return $this->where('user_id',$id)->first();
            }
        }

        public function generateUserId(){
            $lastUser = $this->select('user_id')
                            ->orderBy('id', 'DESC')
                            ->first();

            if ($lastUser && isset($lastUser['user_id'])) {
                // Extract the numeric part
                $lastNumber = (int) substr($lastUser['user_id'], 4);
                $newNumber  = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            // Format USER### (e.g., USER001, USER002)
            return 'USER' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        }
        
    }
?>