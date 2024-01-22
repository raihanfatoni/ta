<?php 
namespace App\Models;
use CodeIgniter\Model;
class TestModel extends Model{
    protected $table = 'nadzir';
    public function getTest($id = false){
        if($id == false){
            return $this->findAll();
        } else {
            return $this->getWhere(['NadzirWakaf'=> $id]);
        }
    }
} 
?>