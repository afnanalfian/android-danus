<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\RegisterUserModel;
use App\Models\OrderModel;
use App\Models\MenuModel;
use Firebase\JWT\JWT;
 
class AndroidUser extends ResourceController
{
    public function login()
    {
    	$response = array("error" => FALSE);
        $modellogin = new RegisterUserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $modellogin->where('email', $email)->first();

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

                $response["error"] = FALSE;
                $response["id"] = $data["id"];
                $response["user"]["username"] = $data["username"];
                $response["user"]["email"] = $data["email"];
                $response["user"]["nama"] = $data["nama"];
                $response["user"]["alamat"] = $data["alamat"];
                echo json_encode($response);
                
            }else{
                $response["error"] = TRUE;
                $response["error_msg"] = "Password salah";
                echo json_encode($response);
            }
        }else{
            $response["error"] = TRUE;
            $response["error_msg"] = "Email tidak ditemukan";
            echo json_encode($response);
        }
    }

	public function register()
    {
        $response = array("error" => FALSE);
    	if(!$this->validate([
            'Nama'                => 'required|min_length[3]|max_length[100]'
        ])){
            $data['validation'] = $this->validator->getErrors();
            $response["error"] = TRUE;
            $response["error_msg"] =$data['validation']['Nama'];
            echo json_encode($response);
        }else if(!$this->validate([
            'Username'            => 'required|min_length[3]|max_length[20]|is_unique[users.username]'
        ])){
            $data['validation'] = $this->validator->getErrors();
            $response["error"] = TRUE;
            $response["error_msg"] =$data['validation']['Username'];
            echo json_encode($response);
        }else if(!$this->validate([
            'Email'               => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]'
        ])){
            $data['validation'] = $this->validator->getErrors();
            $response["error"] = TRUE;
            $response["error_msg"] =$data['validation']['Email'];
            echo json_encode($response);
        }else if(!$this->validate([
            'Alamat'              => 'required|min_length[6]|max_length[100]'
        ])){
            $data['validation'] = $this->validator->getErrors();
            $response["error"] = TRUE;
            $response["error_msg"] =$data['validation']['Alamat'];
            echo json_encode($response);
        }else if(!$this->validate([
            'Password'            => 'required|min_length[6]|max_length[200]'
        ])){
            $data['validation'] = $this->validator->getErrors();
            $response["error"] = TRUE;
            $response["error_msg"] =$data['validation']['Password'];
            echo json_encode($response);
        }else if(!$this->validate([
            'Konfirmasi_Password'  => 'matches[Password]'
        ])){
            $data['validation'] = $this->validator->getErrors();
            $response["error"] = TRUE;
            $response["error_msg"] =$data['validation']['Konfirmasi_Password'];
            echo json_encode($response);
        }else{
            $modelregister = new RegisterUserModel();
            $data = [
                'username' => $this->request->getVar('Username'),
                'nama'     => $this->request->getVar('Nama'),
                'email'    => $this->request->getVar('Email'),
                'alamat'   => $this->request->getVar('Alamat'),
                'password' => password_hash($this->request->getVar('Password'), PASSWORD_BCRYPT)
            ];
            $modelregister->save($data);
            $response["error"] = FALSE;
            $response["user"]["username"] = $data["username"];
            $response["user"]["email"] = $data["email"];
            $response["user"]["nama"] = $data["nama"];
            $response["user"]["alamat"] = $data["alamat"];
            echo json_encode($response);
        }
    }

	public function updateprofile(){
        $response = array("error" => FALSE);
        if(!$this->validate([
            'Email'               => 'required|min_length[6]|max_length[50]|valid_email'
        ])){
            $data['validation'] = $this->validator->getErrors();
            $response["error"] = TRUE;
            $response["error_msg"] =$data['validation']['Email'];
            echo json_encode($response);
        }else if(!$this->validate([
            'Nama'                => 'required|min_length[3]|max_length[100]'
        ])){
            $data['validation'] = $this->validator->getErrors();
            $response["error"] = TRUE;
            $response["error_msg"] =$data['validation']['Nama'];
            echo json_encode($response);
        }else if(!$this->validate([
            'Alamat'              => 'required|min_length[6]|max_length[100]'
        ])){
            $data['validation'] = $this->validator->getErrors();
            $response["error"] = TRUE;
            $response["error_msg"] =$data['validation']['Alamat'];
            echo json_encode($response);
        }else if(!$this->validate([
            'Password'            => 'required|min_length[6]|max_length[200]'
        ])){
            $data['validation'] = $this->validator->getErrors();
            $response["error"] = TRUE;
            $response["error_msg"] =$data['validation']['Password'];
            echo json_encode($response);
        }else if(!$this->validate([
            'Konfirmasi_Password'  => 'matches[Password]'
        ])){
            $data['validation'] = $this->validator->getErrors();
            $response["error"] = TRUE;
            $response["error_msg"] =$data['validation']['Konfirmasi_Password'];
            echo json_encode($response);
        }else{
            $modelupdate = new RegisterUserModel();
            $data = [
                'username' => $this->request->getVar('Username'),
                'nama'     => $this->request->getVar('Nama'),
                'email'    => $this->request->getVar('Email'),
                'alamat'   => $this->request->getVar('Alamat'),
                'password' => password_hash($this->request->getVar('Password'), PASSWORD_BCRYPT)
            ];
            $datamodel = $modelupdate->where('username',$data['username'])->first();
            $modelupdate->updateUser($data, $datamodel['id']);
            $response["error"] = FALSE;
            $response["id"] = $datamodel['id'];
            $response["user"]["username"] = $data["username"];
            $response["user"]["email"] = $data["email"];
            $response["user"]["nama"] = $data["nama"];
            $response["user"]["alamat"] = $data["alamat"];
            echo json_encode($response);
        }
    }

	public function addfood(){
        $modeladdfood = new OrderModel();
        $response = array("error" => FALSE);
        $rules =[
            'Jumlah' => 'required|min_length[1]'
        ];

        if (!$this->validate($rules)){
            $data['validation'] = $this->validator->getErrors();
            $response["error"] = TRUE;
            $response["error_msg"] =$data['validation']['Jumlah'];
            echo json_encode($response);
        } else {
            $data = array(
                'menu_makanan'  => $this->request->getVar('menu_makanan'),
                'harga' => $this->request->getVar('harga')*$this->request->getVar('Jumlah'),
                'username' => $this->request->getVar('username'),
                'jumlah' => $this->request->getVar('Jumlah')
            );
            $modeladdfood->saveMenu($data);
            $response["error"] = FALSE;
            $response["menu"]["username"] = $data["username"];
            $response["menu"]["menu_makanan"] = $data["menu_makanan"];
            $response["menu"]["jumlah"] = $data["jumlah"];
            $response["menu"]["harga"] = $data["harga"];
            echo json_encode($response);
        }
    }

    public function listmenu(){
        $response = array("error" => FALSE);
        $modellist = new MenuModel();
    	$datamenu = $modellist->getMenu();
        $response["error"] = FALSE;	
    	$response["message"] = "data berhasil diperoleh";
    	$response["menu"] = $datamenu;
        echo json_encode($response);
    }

	public function listorder(){
        $response = array("error" => FALSE);
        $modelorder = new OrderModel();
        $datapesan = $modelorder->getOrderUser();
        $response["error"] = FALSE;
        $response["message"] = "data berhasil diperoleh";
        $response["order"] = $datapesan;
        echo json_encode($response);
    }
}