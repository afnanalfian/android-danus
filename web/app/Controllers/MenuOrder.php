<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\MenuModel;
use App\Models\OrderModel;
use App\Models\RegisterAdminModel;
 
class MenuOrder extends ResourceController
{
    use ResponseTrait;

    //Fungsi menampilkan Profil Admin
    public function profilAdmin()
    {
        $modelmenu = new MenuModel();
        $modeladmin = new RegisterAdminModel();
        $data['menu'] = $modelmenu->getMenu();
        $data['admin'] = $modeladmin->getAdmin();
        return view('Admin',$data);
    }

    //Fungsi menampilkan Profil Member Pengguna
    public function profilUser()
    {
        $modelmenu = new MenuModel();
        $modelorder = new OrderModel();
        $data['menu'] = $modelmenu->getMenu();
        $data['order'] = $modelorder->getOrderUser();
        return view('User',$data);
    }

    //Fungsi untuk menyimpan menu baru
    public function savemenu()
    {
        $model = new MenuModel();
        $data = array(
            'menu_makanan'  => $this->request->getPost('makanan'),
            'harga' => $this->request->getPost('harga') 
        );
        $model->saveMenu($data);
        return redirect()->to(base_url('/admin/menu'));
    }

    //Fungsi untuk mengedit data menu berdasarkan nilai id dan diarahakan ke form di UpdateMenu.php
    public function editmenu($id)
    {
        $model = new MenuModel();
        $data['menu'] = $model->getMenu($id)->getRow();
        return view('UpdateMenu', $data);
    }
 
    //Fungsi untuk memperbarui menu yang dipilih
    public function updatemenu()
    {
        $model = new MenuModel();
        $id = $this->request->getPost('id');
        $data = array(
            'menu_makanan'  => $this->request->getPost('makanan'),
            'harga' => $this->request->getPost('harga')
        );
        $model->updateMenu($data, $id);
        return redirect()->to(base_url('/admin/menu'));
    }

    //Fungsi untuk menghapus menu tertentu
    public function deletemenu($id)
    {
        $model = new MenuModel();
        $model->deleteMenu($id);
        return redirect()->to(base_url('/admin/menu'));
    }

    //Fungsi menampilkan daftar menu pada tampilan Admin
    public function orderAdmin()
    {
        $model = new OrderModel();
        $data['list'] = $model->getOrderAdmin();
        return view('FoodOrderAdmin', $data);
    }

    //Fungsi menampilkan daftar menu pada tampilan Member Pengguna
    public function orderUser($id)
    {
        $model = new MenuModel();
        $session = session();
        $data = $model->where('id', $id)->First();
        $ses_data = [
            'menu_makanan' => $data['menu_makanan'],
            'harga' => $data['harga']
        ];
        $session->set($ses_data);
        return view('FoodOrderUser');
    }

    //Fungsi yang digunakan dalam mendaftarkan menu pesanan oleh Member Pengguna
    public function saveorder()
    {
        $model = new OrderModel();
        $session = session();
        $rules =[
            'jumlah' => 'required|min_length[1]'
        ];

        if (!$this->validate($rules)){
            $data['validation'] = $this->validator;
            echo view('FoodOrderUser', $data);
        } else {
            $data = array(
                'menu_makanan'  => $this->request->getPost('menu_makanan'),
                'harga' => $this->request->getPost('harga')*$this->request->getPost('jumlah'),
                'username' => $session->get('username'),
                'jumlah' => $this->request->getPost('jumlah')
            );
            $model->saveMenu($data);
            return redirect()->to(base_url('/user/menu'));
        }
    }

    //Fungsi untuk menghapus daftar pesanan dari Member Pengguna
    public function deleteorder($id)
    {
        $model = new OrderModel();
        $model->deleteOrder($id);
        return redirect()->to(base_url('/admin/order'));
    }
}

?>