<?php 
    namespace App\Models;
    use CodeIgniter\Model;
    class LatihanModel extends Model{
        protected $table = 'nadzir';
        public function getNadzir($id = false){
            if($id === false){
                return $this->findAll();
            } else {
                return $this->getWhere(['NadzirWakaf' => $id]);
            }
        }

        public function getKeyword($keyword){
            helper('form');
            $this->select('*')
            ->like('NadzirWakaf', $keyword)
            ->orLike('nama', $keyword)
            ->orLike('jabatan', $keyword)
            ->orLike('tupoksi', $keyword)
            ->orLike('alamat', $keyword)
            ->orLike('sk', $keyword)
            ->orLike('status', $keyword);
            return $this->findAll();
        }
    }
?>