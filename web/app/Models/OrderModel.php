<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'produk_pesanan';
    protected $allowFields = ['jumlah'];
    public function saveMenu($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function getOrderUser($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['id' => $id]);
        }
    }

    public function getOrderAdmin($menu_makanan = false)
    {
        if($menu_makanan === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['menu_makanan' => $menu_makanan]);
        }
    }

    public function deleteOrder($id)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    } 
}