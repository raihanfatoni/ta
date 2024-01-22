<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\NadzirModel;
use \Dompdf\Dompdf;

class Nadzir extends Controller
{
    public function index()
    {
        if(session()->has('isLoggedIn')){
            $model = new NadzirModel();
            $data['nadzir'] = $model->getNadzir();
            echo view('nadzir_view', $data);
        } else {
            return redirect()->to(base_url("login"));
        }
    }

    public function htmlToPDF(){
        helper('url');
        $dompdf = new Dompdf(); 
        $model = new NadzirModel();
        $data['nadzir'] = $model->getNadzir();
        $html = view('nadzirpdf_view',$data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        // $dompdf->stream();
        $dompdf->stream('datanadzir.pdf',array(
            "Attachment" => false,
        ));
    }

    public function add_new()
    {
        echo view('add_nadzir');
    }

    public function save()
    {
        $model = new NadzirModel();
        $data = array(
            'NadzirWakaf'  => $this->request->getPost('NadzirWakaf'),
            'nama' => $this->request->getPost('nama'),
            'jabatan' => $this->request->getPost('jabatan'),
            'tupoksi' => $this->request->getPost('tupoksi'),
            'alamat' => $this->request->getPost('alamat'),
            'sk' => $this->request->getPost('sk'),
            'status' => $this->request->getPost('status'),
        );  
        $model->saveNadzir($data);
        return redirect()->to(base_url("nadzir"));
    }

    public function edit($id)
    {
        $model = new NadzirModel();
        $data['nadzir'] = $model->getNadzir($id)->getRow();
        echo view('edit_nadzir', $data);
    }

    public function update()
    {
        $model = new NadzirModel();
        $id = $this->request->getPost('NadzirWakaf');
        $data = array(
            'NadzirWakaf'  => $this->request->getPost('NadzirWakaf'),
            'nama' => $this->request->getPost('nama'),
            'jabatan' => $this->request->getPost('jabatan'),
            'tupoksi' => $this->request->getPost('tupoksi'),
            'alamat' => $this->request->getPost('alamat'),
            'sk' => $this->request->getPost('sk'),
            'status' => $this->request->getPost('status'),

        );
        $model->updateNadzir($data, $id);
        return redirect()->to(base_url("nadzir"));
    }

    public function delete($id)
    {
        $model = new NadzirModel();
        $model->deleteNadzir($id);
        return redirect()->to(base_url("nadzir"));
    }

}
