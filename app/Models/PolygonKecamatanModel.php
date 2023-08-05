<?php

namespace App\Models;

use CodeIgniter\Model;

class PolygonKecamatanModel extends Model
{
    protected $table = 'polygonkecamatan';

    public function getPolygonKecamatan($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_polygonkecamatan' => $id]);
        }
    }

    public function getPolygon($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_polygonkecamatan' => $id]);
        }
    }


    public function savePolygonKecamatan($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updatePolygonKecamatan($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id_polygonkecamatan' => $id));
        return $query;
    }

    public function deletePolygonKecamatan($id)
    {
        $query = $this->db->table($this->table)->delete(array('id_polygonkecamatan' => $id));
        return $query;
    }
}
