<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\WakafModel;
use App\Models\PolygonKecamatanModel;
use \Dompdf\Dompdf;

class Wakaf extends Controller
{
    public function index()
    {
        function console_log($output, $with_script_tags = true) {
            $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
        ');';
            if ($with_script_tags) {
                $js_code = '<script>' . $js_code . '</script>';
            }
            echo $js_code;
        }
        if(session()->has('isLoggedIn')){
            helper('form');
            $model = new WakafModel();
            $data['wakaf'] = $model->getWakaf();
            console_log($data);
            echo view('wakaf_view', $data);
        } else {
            return redirect()->to(base_url("login"));
        }
    }

    public function htmlToPDF(){
        helper('url');
        $dompdf = new Dompdf(); 
        $model = new WakafModel();
        $data['wakaf'] = $model->getWakaf();
        $html = view('wakafpdf_view',$data);
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
        echo view('add_wakaf');
    }

    public function save()
    {
        $model = new WakafModel();
        $data = array(
            'no'  => $this->request->getPost('no'),
            'wilayah' => $this->request->getPost('wilayah'),
            'tipe'  => $this->request->getPost('tipe'),
            'mandor' => $this->request->getPost('mandor'),
            'jumlahpenggarap' => $this->request->getPost('jumlahpenggarap'),
            'luas' => $this->request->getPost('luas'),
            'setoranpanen' => $this->request->getPost('setoranpanen'),
            'marker' => $this->request->getPost('marker'),
            'googleearth' => $this->request->getPost('googleearth'),
            'id_polygonkecamatan' => $this->request->getPost('id_polygonkecamatan'),
        );  
        $model->saveWakaf($data);
        return redirect()->to(base_url("wakaf"));
    }

    public function edit($id)
    {
        $model = new WakafModel();
        $data['wakaf'] = $model->getWakaf($id)->getRow();
        echo view('edit_wakaf', $data);
    }

    public function update()
    {
        $model = new WakafModel();
        $id = $this->request->getPost('no');
        $data = array(
            'no'  => $this->request->getPost('no'),
            'wilayah' => $this->request->getPost('wilayah'),
            'tipe'  => $this->request->getPost('tipe'),
            'mandor' => $this->request->getPost('mandor'),
            'jumlahpenggarap' => $this->request->getPost('jumlahpenggarap'),
            'luas' => $this->request->getPost('luas'),
            'setoranpanen' => $this->request->getPost('setoranpanen'),
            'marker' => $this->request->getPost('marker'),
            'googleearth' => $this->request->getPost('googleearth'),
            'id_polygonkecamatan' => $this->request->getPost('id_polygonkecamatan'),
        );
        $model->updateWakaf($data, $id);
        return redirect()->to(base_url("wakaf"));
    }

    public function delete($id)
    {
        $model = new WakafModel();
        $data['wakaf'] = $model->getWakaf($id)->getRow();
        $model->deleteWakaf($id);
        return redirect()->to(base_url("wakaf"));
    }

    public function Search()
    {
        function console_log($output, $with_script_tags = true) {
            $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
        ');';
            if ($with_script_tags) {
                $js_code = '<script>' . $js_code . '</script>';
            }
            echo $js_code;
        }

        helper('form');
        $model = new WakafModel();
        // $data['tanah'] = $model->getTanah();
        // echo view('tanah_view', $data);
        $keyword = $this->request->getPost('keyword');
        $data['wakaf']= $model->getKeyword($keyword);
        console_log($data);
        echo view('wakaf_view', $data);
    }

    public function formmarker(){

        function console_log($output, $with_script_tags = true) {
            $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
        ');';
            if ($with_script_tags) {
                $js_code = '<script>' . $js_code . '</script>';
            }
            echo $js_code;
        }

        if(session()->has('isLoggedIn')){
            $model = new WakafModel();
            $wakaf = $model->getWakaf();
            helper('form');
        
            $fileName = "http://localhost/tugasakhir/public/maps/polygonsumedang.geojson";
            $file = file_get_contents($fileName);
            $file = json_decode($file);
            $features = $file->features;
            console_log($features);
        
            foreach($wakaf as $index=>$value)
            {
                if($value['marker'] != NULL){
                    $markertanah[] = json_decode($value['marker']);
                    $no[] = json_decode($value['no']);
                    $wilayah[] = $value['wilayah'];
                    $tipe[] = $value['tipe'];
                    $mandor[] = $value['mandor'];
                    $jumlahpenggarap[] = json_decode($value['jumlahpenggarap']);
                    $luas[] = json_decode($value['luas']);
                    $setoranpanen[] = json_decode($value['setoranpanen']);
                    $googleearth[] = $value['googleearth'];
                } 
            }
            foreach($markertanah as $row=>$val){
                $marker[$row] = [$val->lat, $val->lng];
                $data = NULL;
                $data['type'] = "Feature";
                $data['geometry'] = [
                    "type" => "Marker",
                    "coordinates" => $marker[$row]
                ];
                $data['properties'] = [
                    "no"=> $no[$row],
                    "wilayah"=> $wilayah[$row],
                    "tipe"=> $tipe[$row],
                    "mandor"=> $mandor[$row],
                    "jumlahpenggarap"=>$jumlahpenggarap[$row],
                    "luas"=> $luas[$row],
                    "setoranpanen"=> $setoranpanen[$row],
                    "googleearth"=> $googleearth[$row],
                ];
                $response[]=$data;
            }
            console_log($response);
            return view('entry/marker',[
                'data'=> $features,
                'marker'=>$response,
    
            ]);
        } else {
            return redirect()->to(base_url("login"));
        }
    }

    public function formmarkeredit($id){

        function console_log($output, $with_script_tags = true) {
            $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
        ');';
            if ($with_script_tags) {
                $js_code = '<script>' . $js_code . '</script>';
            }
            echo $js_code;
        }
        $model = new WakafModel();
        $wakaf = $model->getWakaf($id)->getRow();
        $markertanah = $wakaf->marker;
        $markertanah = json_decode($markertanah);
        console_log($markertanah);
        console_log($wakaf);
        $models = new PolygonKecamatanModel();
        $polygonkecamatan = $models->getPolygonKecamatan();
        helper('form');

        foreach($polygonkecamatan as $index=>$value)
        {
            if($value['polygon'] != NULL){
                $polygontanah[] = json_decode($value['polygon']);
                $no[] = json_decode($value['id_polygonkecamatan']);
            }
        }
        $data = NULL;
        foreach($polygontanah as $row=>$val){
            foreach($polygontanah[$row] as $rows=>$vl){
                $polygon[$row][$rows] = [$vl->lng, $vl->lat];
                $data['geometry'] = [
                    "type" => "Polygon",
                    "coordinates" => [$polygon[$row]]
                ];
            }
            $data['type'] = "Feature";
            $data['properties'] = [
                "no"=> $no[$row],
            ];
            $response1[]=$data;        
        }
        console_log($response1);

        $fileName = "http://localhost/tugasakhir/public/maps/polygonsumedang.geojson";
		$file = file_get_contents($fileName);
		$file = json_decode($file);
        // console_log($file);
		$features = $file->features;
        console_log($features);

        return view('entry/editmarker',[
        'markertanah'=>$markertanah,
        'wakaf'=>$wakaf,
        'data'=> $features,
        'data1'=> $response1,
        ]);
    }

    public function polygonsumedang(){
        // Fungsi console_log untuk membantu tracking proses pengembangan khususnya mengenai aliran dan bentuk data
        function console_log($output, $with_script_tags = true) {
            $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
            ');';
            if ($with_script_tags) {
                $js_code = '<script>' . $js_code . '</script>';
            }
            echo $js_code;
        }       
            // Import file GeoJSON untuk menampilkan peta Sumedang 
            $fileName = "http://localhost/tugasakhir/public/maps/polygonsumedang.geojson";
            $file = file_get_contents($fileName);
            $file = json_decode($file);
            $features = $file->features;
            console_log($features);
            
            helper('form');

            // Deklarasi model yang akan digunakan
            $model = new WakafModel();
            $wakaf = $model->getWakaf();
            console_log($wakaf);
        
            $modelKecamatan = new PolygonKecamatanModel;
            $polygonkecamatan = $modelKecamatan->getPolygonKecamatan();
            console_log($polygonkecamatan);

            $nilaiMax = 10697;

            // Loop untuk memuat konten dropdown yang berperan sebagai filter untuk penampilan data
            $namaTanah = [];
            foreach($wakaf as $index=>$value){
                if($value['marker'] != NULL){
                    $namaTanah[$value['wilayah']] = $value['wilayah']; 
                    console_log($namaTanah);
                }
            }
            $namaKecamatan = [];
            foreach($polygonkecamatan as $index=>$value){
                $namaKecamatan[$value['id_polygonkecamatan']] = $value['nama'];
                console_log($namaKecamatan);
            }

            $pilihKecamatan = '';
            if($this->request->getPost('kecamatan'))
            {
                $pilihKecamatan = $this->request->getPost('kecamatan');
                console_log($pilihKecamatan);
                foreach($wakaf as $index=>$value)
                {
                    if($value['marker'] != NULL && $value['id_polygonkecamatan'] == $pilihKecamatan){ // Assign seluruh row marker yang memenuhi kondisi
                        $markertanah[] = json_decode($value['marker']);  // json_decode disini digunakan untuk mengubah value dari variabel
                        $no[] = json_decode($value['no']);               // menjadi objek
                        $wilayah[] = $value['wilayah'];
                        $tipe[] = $value['tipe'];
                        $mandor[] = $value['mandor'];
                        $jumlahpenggarap[] = json_decode($value['jumlahpenggarap']);
                        $luas[] = json_decode($value['luas']);
                        $setoranpanen[] = json_decode($value['setoranpanen']);
                        $googleearth[] = $value['googleearth'];
                    } 
                }
                foreach($markertanah as $row=>$val){ // Loop ini bertujuan untuk mengubah format return data menjadi bentuk geoJSON
                    $marker[$row] = [$val->lat, $val->lng];
        
                    $data = NULL;
                    $data['type'] = "Feature";
                    $data['geometry'] = [
                        "type" => "Marker",
                        "coordinates" => $marker[$row]
                    ];
                    $data['properties'] = [
                        "no"=> $no[$row],
                        "wilayah"=> $wilayah[$row],
                        "tipe"=> $tipe[$row],
                        "mandor"=> $mandor[$row],
                        "jumlahpenggarap"=>$jumlahpenggarap[$row],
                        "luas"=> $luas[$row],
                        "setoranpanen"=> $setoranpanen[$row],
                        "googleearth"=> $googleearth[$row],
        
                    ];
                    $response[]=$data;
                }

                foreach($polygonkecamatan as $index=>$value)
                {
                    if($value['polygon'] != NULL){
                        $polygontanah[] = json_decode($value['polygon']);
                        $id_polygonkecamatan[] = json_decode($value['id_polygonkecamatan']);
                        $nama[] = $value['nama'];
                        $luas[] = json_decode($value['luas']);
                        $akumulasiluastanah[] = json_decode($value['akumulasiluastanah']);
                        $akumulasijumlahpenggarap[] = json_decode($value['akumulasijumlahpenggarap']);
                    }
                }
                $data = NULL;
                foreach($polygontanah as $row=>$val){
                    foreach($polygontanah[$row] as $rows=>$vl){
                        $polygon[$row][$rows] = [$vl->lng, $vl->lat];
                        $data['geometry'] = [
                            "type" => "Polygon",
                            "coordinates" => [$polygon[$row]]
                        ];
                        $data['type'] = "Feature";
                        $data['properties'] = [
                            "id_polygonkecamatan"=> $id_polygonkecamatan[$row],
                            "nama"=> $nama[$row],
                            "luas"=> $luas[$row],
                            "akumulasiluastanah"=> $akumulasiluastanah[$row],
                            "akumulasijumlahpenggarap"=> $akumulasijumlahpenggarap[$row]
                        ];
                    }
                    $response1[]=$data;   
                }

                return view('polygon/penggarap',[
                    'data'=> $features,
                    'data1'=> $response1,
                    'marker'=>$response,
                    'nilaiMax'=>$nilaiMax,
                    'namaTanah' =>$namaTanah,
                    'namaKecamatan'=>$namaKecamatan,
                ]); 
            } 

            $pilihTanah = '';
            if($this->request->getPost('tanah'))
            {
                $pilihTanah = $this->request->getPost('tanah');
                console_log($pilihTanah);
                foreach($wakaf as $index=>$value)
                {
                    if($value['marker'] != NULL && $value['wilayah'] == $pilihTanah){ // Assign seluruh row marker yang memenuhi kondisi
                        $markertanah[] = json_decode($value['marker']);  // json_decode disini digunakan untuk mengubah value dari variabel
                        $no[] = json_decode($value['no']);               // menjadi objek
                        $wilayah[] = $value['wilayah'];
                        $tipe[] = $value['tipe'];
                        $mandor[] = $value['mandor'];
                        $jumlahpenggarap[] = json_decode($value['jumlahpenggarap']);
                        $luas[] = json_decode($value['luas']);
                        $setoranpanen[] = json_decode($value['setoranpanen']);
                        $googleearth[] = $value['googleearth'];
                    } 
                }
                foreach($markertanah as $row=>$val){ // Loop ini bertujuan untuk mengubah format return data menjadi bentuk geoJSON
                    $marker[$row] = [$val->lat, $val->lng];
        
                    $data = NULL;
                    $data['type'] = "Feature";
                    $data['geometry'] = [
                        "type" => "Marker",
                        "coordinates" => $marker[$row]
                    ];
                    $data['properties'] = [
                        "no"=> $no[$row],
                        "wilayah"=> $wilayah[$row],
                        "tipe"=> $tipe[$row],
                        "mandor"=> $mandor[$row],
                        "jumlahpenggarap"=>$jumlahpenggarap[$row],
                        "luas"=> $luas[$row],
                        "setoranpanen"=> $setoranpanen[$row],
                        "googleearth"=> $googleearth[$row],
        
                    ];
                    $response[]=$data;
                }

                foreach($polygonkecamatan as $index=>$value)
                {
                    if($value['polygon'] != NULL){
                        $polygontanah[] = json_decode($value['polygon']);
                        $id_polygonkecamatan[] = json_decode($value['id_polygonkecamatan']);
                        $nama[] = $value['nama'];
                        $luas[] = json_decode($value['luas']);
                        $akumulasiluastanah[] = json_decode($value['akumulasiluastanah']);
                        $akumulasijumlahpenggarap[] = json_decode($value['akumulasijumlahpenggarap']);
                    }
                }
                $data = NULL;
                foreach($polygontanah as $row=>$val){
                    foreach($polygontanah[$row] as $rows=>$vl){
                        $polygon[$row][$rows] = [$vl->lng, $vl->lat];
                        $data['geometry'] = [
                            "type" => "Polygon",
                            "coordinates" => [$polygon[$row]]
                        ];
                        $data['type'] = "Feature";
                        $data['properties'] = [
                            "id_polygonkecamatan"=> $id_polygonkecamatan[$row],
                            "nama"=> $nama[$row],
                            "luas"=> $luas[$row],
                            "akumulasiluastanah"=> $akumulasiluastanah[$row],
                            "akumulasijumlahpenggarap"=> $akumulasijumlahpenggarap[$row]
                        ];
                    }
                    $response1[]=$data;   
                }

                return view('polygon/penggarap',[
                    'data'=> $features,
                    'data1'=> $response1,
                    'marker'=>$response,
                    'nilaiMax'=>$nilaiMax,
                    'namaTanah' =>$namaTanah,
                    'namaKecamatan'=>$namaKecamatan,
                ]); 
            } else {
                foreach($wakaf as $index=>$value)
                {
                    if($value['marker'] != NULL){ // Assign seluruh row marker yang memenuhi kondisi
                        $markertanah[] = json_decode($value['marker']);  // json_decode disini digunakan untuk mengubah value dari variabel
                        $no[] = json_decode($value['no']);               // menjadi objek
                        $wilayah[] = $value['wilayah'];
                        $tipe[] = $value['tipe'];
                        $mandor[] = $value['mandor'];
                        $jumlahpenggarap[] = json_decode($value['jumlahpenggarap']);
                        $luas[] = json_decode($value['luas']);
                        $setoranpanen[] = json_decode($value['setoranpanen']);
                        $googleearth[] = $value['googleearth'];
                    } 
                }
                foreach($markertanah as $row=>$val){ // Loop ini bertujuan untuk mengubah format return data menjadi bentuk geoJSON
                    $marker[$row] = [$val->lat, $val->lng];
        
                    $data = NULL;
                    $data['type'] = "Feature";
                    $data['geometry'] = [
                        "type" => "Marker",
                        "coordinates" => $marker[$row]
                    ];
                    $data['properties'] = [
                        "no"=> $no[$row],
                        "wilayah"=> $wilayah[$row],
                        "tipe"=> $tipe[$row],
                        "mandor"=> $mandor[$row],
                        "jumlahpenggarap"=>$jumlahpenggarap[$row],
                        "luas"=> $luas[$row],
                        "setoranpanen"=> $setoranpanen[$row],
                        "googleearth"=> $googleearth[$row],
                    ];
                    $response[]=$data;
                }
                foreach($polygonkecamatan as $index=>$value)
                {
                    if($value['polygon'] != NULL){
                        $polygontanah[] = json_decode($value['polygon']);
                        $id_polygonkecamatan[] = json_decode($value['id_polygonkecamatan']);
                        $nama[] = $value['nama'];
                        $luas[] = json_decode($value['luas']);
                        $akumulasiluastanah[] = json_decode($value['akumulasiluastanah']);
                        $akumulasijumlahpenggarap[] = json_decode($value['akumulasijumlahpenggarap']);
                    }
                }
                $data = NULL;
                foreach($polygontanah as $row=>$val){
                    foreach($polygontanah[$row] as $rows=>$vl){
                        $polygon[$row][$rows] = [$vl->lng, $vl->lat];
                        $data['geometry'] = [
                            "type" => "Polygon",
                            "coordinates" => [$polygon[$row]]
                        ];
                        $data['type'] = "Feature";
                        $data['properties'] = [
                            "id_polygonkecamatan"=> $id_polygonkecamatan[$row],
                            "nama"=> $nama[$row],
                            "luas"=> $luas[$row],
                            "akumulasiluastanah"=> $akumulasiluastanah[$row],
                            "akumulasijumlahpenggarap"=> $akumulasijumlahpenggarap[$row]
    
                        ];
                    }
                    $response1[]=$data; 
                }
                return view('polygon/penggarap',[
                    'data'=> $features,
                    'data1'=> $response1,
                    'marker'=>$response,
                    'nilaiMax'=>$nilaiMax,
                    'namaTanah' =>$namaTanah,
                    'namaKecamatan'=>$namaKecamatan,
                ]); 

            }

    }


    public function viewmarker($id){
        function console_log($output, $with_script_tags = true) {
            $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
        ');';
            if ($with_script_tags) {
                $js_code = '<script>' . $js_code . '</script>';
            }
            echo $js_code;
        }
        $model = new WakafModel();
        $wakaf = $model->getWakaf($id)->getRow();
        // Assign Atribut Tanah Wakaf
        $markertanah = $wakaf->marker;
        $markertanah = json_decode($markertanah);
        $jumlahpenggarap = $wakaf->jumlahpenggarap;
        $jumlahpenggarap = json_decode($jumlahpenggarap);
        $luas = $wakaf->luas;
        $luas = json_decode($luas);
        $setoranpanen = $wakaf->setoranpanen;
        $setoranpanen = json_decode($setoranpanen);
        $wilayah = $wakaf->wilayah;
        $tipe = $wakaf->tipe;
        $mandor = $wakaf->mandor;
        $no = $wakaf->no;
        $no = json_decode($no);
        $googleearth = $wakaf->googleearth;

        $models = new PolygonKecamatanModel();
        $polygonkecamatan = $models->getPolygonKecamatan();
        helper('form');

        foreach($polygonkecamatan as $index=>$value)
        {
            if($value['polygon'] != NULL){
                $polygontanah[] = json_decode($value['polygon']);
                $number[] = json_decode($value['id_polygonkecamatan']);
            }
        }
        $data = NULL;
        foreach($polygontanah as $row=>$val){
            foreach($polygontanah[$row] as $rows=>$vl){
                $polygon[$row][$rows] = [$vl->lng, $vl->lat];
                $data['geometry'] = [
                    "type" => "Polygon",
                    "coordinates" => [$polygon[$row]]
                ];
            }
            $data['type'] = "Feature";
            $data['properties'] = [
                "no"=> $number[$row],
            ];
            $response1[]=$data;        
        }
        console_log($response1);

        $fileName = "http://localhost/tugasakhir/public/maps/polygonsumedang.geojson";
		$file = file_get_contents($fileName);
		$file = json_decode($file);
        // console_log($file);
		$features = $file->features;
        console_log($features);
        console_log($tipe);

        return view('entry/viewmarker',[
        'markertanah'=>$markertanah,
        'jumlahpenggarap'=>$jumlahpenggarap,
        'luas'=>$luas,
        'setoranpanen'=>$setoranpanen,
        'wilayah'=>$wilayah,
        'tipe'=>$tipe,
        'mandor'=>$mandor,
        'googleearth'=>$googleearth,
        'no'=>$no,
        'wakaf'=>$wakaf,
        'data'=> $features,
        'data1'=> $response1,
        ]);
    }
}
