<?php 
    namespace App\Controllers;
    use CodeIgniter\Controller;
    use App\Models\LatihanModel;
    class Latihan extends Controller{
        public function index(){
            helper('form');
            $model = new LatihanModel;
            $data['nadzir'] = $model->getNadzir(2009)->getRow();
            echo view ('testview1', $data);
        }

        public function Search(){
            $model = new LatihanModel;
            $keyword = $this->request->getPost('keyword');
            $data['nadzir'] = $model->getKeyword($keyword);
            echo view ('testview',$data);
        }
    }
?>