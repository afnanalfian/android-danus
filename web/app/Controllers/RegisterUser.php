<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\RegisterUserModel;

class RegisterUser extends ResourceController
{
    use ResponseTrait;
 
    //Fungsi menyimpan akun baru yang diregistrasikan
    public function saveaccount()
    {
        helper(['form']);
        $rules = [
            'username'      => 'required|min_length[3]|max_length[20]|is_unique[users.username]',
            'email'         => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
            'nama'          => 'required|min_length[3]|max_length[100]',
            'alamat'        => 'required|min_length[6]|max_length[100]',
            'password'      => 'required|min_length[6]|max_length[200]',
            'confpassword'  => 'matches[password]'
        ];
         
        if($this->validate($rules)){
            $model = new RegisterUserModel();
            $data = [
                'username' => $this->request->getVar('username'),
                'nama'     => $this->request->getVar('nama'),
                'email'    => $this->request->getVar('email'),
                'alamat'   => $this->request->getVar('alamat'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)
            ];
            $model->save($data);
            return redirect()->to(base_url('/user/signin'));
        }else{
            $data['validation'] = $this->validator;
            echo view('SignUpUser', $data);
        }
    }

    //Fungsi untuk masuk ke form update profil akun 
    public function editprofile($id)
    {
        $model = new RegisterUserModel();
        $data['user'] = $model->getUser($id)->getRow();
        return view('EditProfileUser', $data);
    }
 
    //Fungsi untuk memperbarui akun
    public function updateaccount($id)
    {
        helper(['form']);

        $rules = [
            'nama'          => 'required|min_length[6]|max_length[100]',
            'email'         => 'required|min_length[6]|max_length[50]|valid_email',
            'alamat'        => 'required|min_length[6]|max_length[100]',
            'password'      => 'required|min_length[6]|max_length[200]',
            'confpassword'  => 'matches[password]'
        ];
         
        if($this->validate($rules)){
            $model = new RegisterUserModel();
            $data = [
                'nama'     => $this->request->getVar('nama'),
                'email'    => $this->request->getVar('email'),
                'alamat'   => $this->request->getVar('alamat'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)
            ];
            $model->updateUser($data,$id);
            return redirect()->to(base_url('/user/signin'));
        }else{
            $data['validation'] = $this->validator;
            echo view('EditProfileUser', $data);
        }
    }
}