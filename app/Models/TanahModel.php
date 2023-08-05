<?php

namespace App\Models;

use CodeIgniter\Model;

class TanahModel extends Model
{
    protected $table = 'tanah';

    public function getKeyword($keyword){
        helper('form');
        $this->select('*')
        ->like('Lokasi', $keyword)
        ->orLike('Tipe',$keyword)
        ->orLike('No',$keyword)
        ->orLike('KoordinatLokasi',$keyword)
        ->orLike('NadzirWakaf',$keyword)
        ->orLike('polygon',$keyword)
        ->orLike('marker',$keyword)
        ->orLike('googleearth',$keyword);
        return $this->findAll();
    }

    public function getTanah($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['No' => $id]);
        }
    }

    public function getPolygon($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['No' => $id]);
        }
    }


    public function saveTanah($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateTanah($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('No' => $id));
        return $query;
    }

    public function deleteTanah($id)
    {
        $query = $this->db->table($this->table)->delete(array('No' => $id));
        return $query;
    }
}
