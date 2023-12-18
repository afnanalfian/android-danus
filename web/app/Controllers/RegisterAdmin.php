<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\RegisterAdminModel;

class RegisterAdmin extends ResourceController
{
    use ResponseTrait;
    // public function index()
    // {
    //     //include helper form
    //     helper(['form']);
    //     $data = [];
    //     echo view('SignUpAdmin', $data);
    // }
 
    //Fungsi untuk menyimpan akun baru 
    public function saveaccount()
    {
        //include helper form
        helper(['form']);
        //set rules validation form
        $rules = [
            'username'      => 'required|min_length[3]|max_length[20]|is_unique[admins.username]',
            'email'         => 'required|min_length[6]|max_length[50]|valid_email|is_unique[admins.email]',
            'nama'          => 'required|min_length[3]|max_length[100]',
            'jabatan'       => 'required|min_length[5]|max_length[50]',
            'password'      => 'required|min_length[6]|max_length[200]',
            'confpassword'  => 'matches[password]'
        ];
         
        if($this->validate($rules)){
            $model = new RegisterAdminModel();
            $data = [
                'username' => $this->request->getVar('username'),
                'nama'     => $this->request->getVar('nama'),
                'email'    => $this->request->getVar('email'),
                'jabatan'  => $this->request->getVar('jabatan'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)
            ];
            $model->save($data);
            return redirect()->to(base_url('/admin/menu'));
        }else {
            $data['validation'] = $this->validator;
            echo view('SignUpAdmin', $data);
        }
    }

    //Fungsi untuk masuk ke form update profil akun 
    public function editprofile($id)
    {
        $model = new RegisterAdminModel();
        $data['user'] = $model->getAdmin($id)->getRow();
        return view('EditProfileAdmin', $data);
    }
 
    //Fungsi untuk memperbarui akun
    public function updateaccount($id)
    {
        helper(['form']);

        $rules = [
            'nama'         => 'required|min_length[5]|max_length[100]',
            'email'         => 'required|min_length[6]|max_length[50]|valid_email',
            'jabatan'        => 'required|min_length[5]|max_length[100]',
            'password'      => 'required|min_length[6]|max_length[200]',
            'confpassword'  => 'matches[password]'
        ];
         
        if($this->validate($rules)){
            $model = new RegisterAdminModel();
            $data = [
                'nama'     => $this->request->getVar('nama'),
                'email'    => $this->request->getVar('email'),
                'jabatan'  => $this->request->getVar('jabatan'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)
            ];
            $model->updateAdmin($data,$id);
            return redirect()->to(base_url('/admin/signin'));
        }else{
            $data['validation'] = $this->validator;
            echo view('EditProfileAdmin', $data);
        }
    }
}