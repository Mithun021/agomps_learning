<?php
    namespace App\Controllers;
    use App\Models\UserModel;
    class AdminControllers extends BaseController{
        public function adminLogin(){
            $admin_model = new UserModel();
            if ($this->request->is("get")) {
                if (isset($_SESSION['adminLoginned'])) {
                    return view("admin/index"); 
                }
                return view('admin/login');
            }
            else if ($this->request->is("post")) {
                $userId = $this->request->getPost('userId');
                $userPassword = $this->request->getVar('userPassword');

                $data = $admin_model->where('email',$userId)
                                    ->orWhere('phoneNumber',$userId)->first();
                if($data){
                    $session_data = [
                        'loggeduserFirstName' => $data['firstName'],
                        'loggeduserId' => $data['userId']
                    ];
                    if (password_verify($userPassword, $data['password'])) {
                        $this->session->set('loggedUserData',$session_data);
                        $this->session->set('adminLoginned',"adminLoginned");
                        echo "dataMatch";
                    } else {
                    echo 'User ID or Password Mismatch';
                    }
                }
                else{
                    echo "Given Username or Phone Number not found";
                }
            }
           
        }
        public function adminDashboard(){
            $data = [
                'title' => 'Home'
            ];
            return view('admin/index',$data);
        }
        public function logout(){
            $session = session();
            session_unset();
            session_destroy();
            return redirect()->to(base_url('admin/login'));
        }
    }
?>