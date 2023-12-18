<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\RegisterUserModel;
use Firebase\JWT\JWT;
 
class LoginUser extends ResourceController
{
    use ResponseTrait;

    //Fungsi melakukan autentikasi ke akun Member Pengguna
    public function auth()
    {
        $session = session();
        $modeluser = new RegisterUserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $modeluser->where('email', $email)->first();
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
                    "alamat"   => $data['alamat'],
                );
                $token = JWT::encode($payload, $key, 'HS256');
            	$ses_data = [
                    'token'    => $token,
                    'logged_in'=> TRUE
                ];
            	$session->set($ses_data);
            	return redirect()->to(base_url('/user/menu'));
            }else{
                $session->setFlashdata('msg', 'Salah Password');
                return redirect()->to(base_url('/user/signin'));
            }
        }else{
            $session->setFlashdata('msg', 'Email tidak ditemukan');
            return redirect()->to(base_url('/user/signin'));
        }
    }
 
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }
} 