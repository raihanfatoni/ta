<?php

namespace App\Models;

use CodeIgniter\Model;

class WakafModel extends Model
{
    protected $table = 'wakaf';

    public function getKeyword($keyword){
        helper('form');
        $this->select('*')
        ->like('wilayah', $keyword)
        ->orLike('tipe',$keyword)
        ->orLike('mandor',$keyword)
        ->orLike('jumlahpenggarap',$keyword)
        ->orLike('luas',$keyword)
        ->orLike('marker',$keyword)
        ->orLike('googleearth',$keyword);
        return $this->findAll();
    }

    public function getWakaf($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['no' => $id]);
        }
    }

    public function saveWakaf($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateWakaf($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('no' => $id));
        return $query;
    }

    public function deleteWakaf($id)
    {
        $query = $this->db->table($this->table)->delete(array('no' => $id));
        return $query;
    }
}
