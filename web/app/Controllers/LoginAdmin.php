<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\RegisterAdminModel;
use Firebase\JWT\JWT;
 
class LoginAdmin extends ResourceController
{
    use ResponseTrait;
    
    //Fungsi untuk melakukan autentikasi ke akun Admin 
    public function auth()
    {
        $session = session();
        $model = new RegisterAdminModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $model->where('email', $email)->first();
        if($data){
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if($verify_pass){
                $key = getenv('TOKEN_SECRET');
                    $payload = array(
                    "iat"       => 1356999524,
                    "nbf"       => 1357000000,
                    "id"        => $data['id'],
                    "username"  => $data['username'],
                    "email"     => $data['email'],
                    "nama"      => $data['nama'],
                    "jabatan"   => $data['jabatan'],
                );
                $token = JWT::encode($payload, $key, 'HS256');
                $ses_data = [
                    'token'    => $token,
                    'logged_in'=> TRUE,
                ];
                $session->set($ses_data);
                return redirect()->to(base_url('/admin/menu'));
            }else{
                $session->setFlashdata('msg', 'Salah Password');
                return redirect()->to(base_url('/admin/signin'));
            }
        }else{
            $session->setFlashdata('msg', 'Email tidak ditemukan');
            return redirect()->to(base_url('/admin/signin'));
        }
    }
 
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }
} 