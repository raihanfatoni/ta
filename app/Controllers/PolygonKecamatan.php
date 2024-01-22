<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PolygonKecamatanModel;
use App\Models\WakafModel;
use \Dompdf\Dompdf;

class PolygonKecamatan extends Controller
{
    public function index()
    {
        if(session()->has('isLoggedIn')){
            helper('form');
            $model = new PolygonKecamatanModel();
            $data['polygonkecamatan'] = $model->getPolygonKecamatan();
            echo view('polygonkecamatan_view', $data);
        } else {
            return redirect()->to(base_url("login"));
        }
    }

    public function htmlToPDF(){
        helper('url');
        $dompdf = new Dompdf(); 
        $model = new PolygonKecamatanModel();
        $data['polygonkecamatan'] = $model->getPolygonKecamatan();
        $html = view('polygonkecamatanpdf_view',$data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('datanadzir.pdf',array(
            "Attachment" => true,
        ));
    }


    public function add_new()
    {
        echo view('add_polygonkecamatan');
    }

    public function save()
    {
        $model = new PolygonKecamatanModel();
        $data = array(
            'id_polygonkecamatan'  => $this->request->getPost('id_polygonkecamatan'),
            'nama' => $this->request->getPost('nama'),
            'luas' => $this->request->getPost('luas'),
            'akumulasiluastanah' => $this->request->getPost('akumulasiluastanah'),
            'akumulasijumlahpenggarap' => $this->request->getPost('akumulasijumlahpenggarap'),
            'jumlahtanahwakaf' => $this->request->getPost('jumlahtanahwakaf'),
            'polygon' => $this->request->getPost('polygon'),
        );  
        $model->savePolygonKecamatan($data);
        return redirect()->to(base_url("polygonkecamatan"));
    }

    public function edit($id)
    {
        $model = new PolygonKecamatanModel();
        $data['polygonkecamatan'] = $model->getPolygonKecamatan($id)->getRow();
        echo view('edit_polygonkecamatan', $data);
    }

    public function update()
    {
        $model = new PolygonKecamatanModel();
        $id = $this->request->getPost('id_polygonkecamatan');
        $data = array(
            'id_polygonkecamatan'  => $this->request->getPost('id_polygonkecamatan'),
            'nama' => $this->request->getPost('nama'),
            'luas' => $this->request->getPost('luas'),
            'akumulasiluastanah' => $this->request->getPost('akumulasiluastanah'),
            'akumulasijumlahpenggarap' => $this->request->getPost('akumulasijumlahpenggarap'),
            'jumlahtanahwakaf' => $this->request->getPost('jumlahtanahwakaf'),
            'polygon' => $this->request->getPost('polygon'),

        );
        $model->updatePolygonKecamatan($data, $id);
        return redirect()->to(base_url("polygonkecamatan"));
    }

    public function delete($id)
    {
        $model = new PolygonKecamatanModel();
        $data['polygonkecamatan'] = $model->getPolygonKecamatan($id)->getRow();
        $model->deletePolygonKecamatan($id);
        return redirect()->to(base_url("polygonkecamatan"));
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
        $model = new TanahModel();
        // $data['tanah'] = $model->getTanah();
        // echo view('tanah_view', $data);
        $keyword = $this->request->getPost('keyword');
        $data['polygonkecamatan']= $model->getKeyword($keyword);
        console_log($data);
        echo view('polygonkecamatan_view', $data);
    }

    public function formpolygon(){

        function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
        ');';
            if ($with_script_tags) {
                $js_code = '<script>' . $js_code . '</script>';
            }
            echo $js_code;
        }
        if (session()->has('isLoggedIn')) {

            $model = new PolygonKecamatanModel();
            $polygonkecamatan = $model->getPolygonKecamatan();
            
            $models = new WakafModel();
            $wakaf = $models->getWakaf();

            helper('form');

            foreach($polygonkecamatan as $index=>$value)
            {
                if($value['polygon'] != NULL){
                    $polygontanah[] = json_decode($value['polygon']);
                    $id_polygonkecamatan[] = json_decode($value['id_polygonkecamatan']);
                }
            }
            console_log($polygontanah);
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
                    "id_polygonkecamatan"=> $id_polygonkecamatan[$row],
                ];
                $response1[]=$data;
            }
    
            $fileName = "http://localhost/tugasakhir/public/maps/polygonsumedang.geojson";
            $file = file_get_contents($fileName);
            $file = json_decode($file);
            // console_log($file);
            $features = $file->features;
            console_log($features);
    
            foreach($wakaf as $index=>$value)
            {
                if($value['marker'] != NULL){
                    $markertanah[] = json_decode($value['marker']);
                    $id_polygonkecamatan[] = json_decode($value['id_polygonkecamatan']);
                    $wilayah[] = $value['wilayah'];
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
                    "id_polygonkecamatan"=> $id_polygonkecamatan[$row],
                    "wilayah"=> $wilayah[$row],
                    "mandor"=> $mandor[$row],
                    "jumlahpenggarap"=>$jumlahpenggarap[$row],
                    "luas"=> $luas[$row],
                    "setoranpanen"=> $setoranpanen[$row],
                    "googleearth"=> $googleearth[$row],
                ];
                $response[]=$data;
            }
            return view('entry/polygon',[
                'data'=> $features,
                'marker'=>$response,
                'data1' =>$response1,
            ]);
        } else {
            return redirect()->to(base_url("login"));
        }    
    }

    public function formpolygonedit($id){

        function console_log($output, $with_script_tags = true) {
            $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
        ');';
            if ($with_script_tags) {
                $js_code = '<script>' . $js_code . '</script>';
            }
            echo $js_code;
        }

        $model = new PolygonKecamatanModel();
        $polygonkecamatan = $model->getPolygonKecamatan($id)->getRow();
        $polygontanah = $polygonkecamatan->polygon;
        $polygontanah = json_decode($polygontanah);
        helper('form');

		$fileName = "http://localhost/tugasakhir/public/maps/polygonsumedang.geojson";
		$file = file_get_contents($fileName);
		$file = json_decode($file);
        // console_log($file);
		$features = $file->features;
        // $features = json_encode($features);
        console_log($features);


		return view('entry/editpolygon',[
            'polygontanah'=>$polygontanah,
            'polygonkecamatan'=>$polygonkecamatan,
			'data'=> $features,
		]);
    }

    public function analisisLuas(){
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

            $tipeTanah = []; 
            foreach($wakaf as $index=>$value){
                if($value['marker'] != NULL ){
                    $tipeTanah[$value['tipe']] = $value['tipe'];
                }
            }

            $pilihTipe = '';
            if($this->request->getPost('tipe'))
            {
                $pilihTipe = $this->request->getPost('tipe');
                console_log($pilihTipe);
                foreach($wakaf as $index=>$value)
                {
                    if($value['marker'] != NULL && $value['tipe'] == $pilihTipe){ // Assign seluruh row marker yang memenuhi kondisi
                        $markertanah[] = json_decode($value['marker']);  // json_decode disini digunakan untuk mengubah value dari variabel
                        $no[] = json_decode($value['no']);               // menjadi objek
                        $wilayah[] = $value['wilayah'];
                        $tipe[] = $value['tipe'];
                        $mandor[] = $value['mandor'];
                        $jumlahpenggarap[] = json_decode($value['jumlahpenggarap']);
                        $luas[] = json_decode($value['luas']);
                        $setoranpanen[] = json_decode($value['setoranpanen']);
                        $googleearth[] = $value['googleearth'];
                        $id_kecamatan[] = $value['id_polygonkecamatan'];
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
                        "id_polygonkecamatan"=> $id_kecamatan[$row],
        
                    ];
                    $response[]=$data;
                }

                foreach($polygonkecamatan as $index=>$value)
                {
                    if($value['polygon'] != NULL){
                        $polygontanah[] = json_decode($value['polygon']);
                        $id_polygonkecamatan[] = json_decode($value['id_polygonkecamatan']);
                        $nama[] = $value['nama'];
                        $luaskecamatan[] = json_decode($value['luas']);
                        $akumulasiluastanah[] = json_decode($value['akumulasiluastanah']);
                        $akumulasijumlahpenggarap[] = json_decode($value['akumulasijumlahpenggarap']);
                        $jumlahtanahwakaf[] = json_decode($value['jumlahtanahwakaf']);
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
                        $sumluas = 0;
                        foreach($wakaf as $index=>$value){
                            if($id_polygonkecamatan[$row] == $value['id_polygonkecamatan']){
                                $sumluas =  $sumluas + $value['luas'];
                            }
                        }
                        $data['properties'] = [
                            "id_polygonkecamatan"=> $id_polygonkecamatan[$row],
                            "nama"=> $nama[$row],
                            "luaskecamatan"=> $luaskecamatan[$row],
                            "akumulasiluastanah"=> $sumluas,
                            "akumulasijumlahpenggarap"=> $akumulasijumlahpenggarap[$row],
                            "jumlahtanahwakaf"=> $jumlahtanahwakaf[$row]
                        ];
                    }
                    $response1[]=$data;   
                }
                console_log($response1);

                return view('polygon/luas',[
                    'data'=> $features,
                    'data1'=> $response1,
                    'marker'=>$response,
                    'nilaiMax'=>$nilaiMax,
                    'namaTanah' =>$namaTanah,
                    'namaKecamatan'=>$namaKecamatan,
                    'tipeTanah'=>$tipeTanah,
                ]); 
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
                        $id_kecamatan[] = $value['id_polygonkecamatan'];
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
                        "id_polygonkecamatan"=> $id_kecamatan[$row],
        
                    ];
                    $response[]=$data;
                }

                foreach($polygonkecamatan as $index=>$value)
                {
                    if($value['polygon'] != NULL){
                        $polygontanah[] = json_decode($value['polygon']);
                        $id_polygonkecamatan[] = json_decode($value['id_polygonkecamatan']);
                        $nama[] = $value['nama'];
                        $luaskecamatan[] = json_decode($value['luas']);
                        $akumulasiluastanah[] = json_decode($value['akumulasiluastanah']);
                        $akumulasijumlahpenggarap[] = json_decode($value['akumulasijumlahpenggarap']);
                        $jumlahtanahwakaf[] = json_decode($value['jumlahtanahwakaf']);
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
                        $sumluas = 0;
                        foreach($wakaf as $index=>$value){
                            if($id_polygonkecamatan[$row] == $value['id_polygonkecamatan']){
                                $sumluas =  $sumluas + $value['luas'];
                            }
                        }
                        $data['properties'] = [
                            "id_polygonkecamatan"=> $id_polygonkecamatan[$row],
                            "nama"=> $nama[$row],
                            "luaskecamatan"=> $luaskecamatan[$row],
                            "akumulasiluastanah"=> $sumluas,
                            "akumulasijumlahpenggarap"=> $akumulasijumlahpenggarap[$row],
                            "jumlahtanahwakaf"=> $jumlahtanahwakaf[$row]
                        ];
                    }
                    $response1[]=$data;   
                }
                console_log($response1);

                return view('polygon/luas',[
                    'data'=> $features,
                    'data1'=> $response1,
                    'marker'=>$response,
                    'nilaiMax'=>$nilaiMax,
                    'namaTanah' =>$namaTanah,
                    'namaKecamatan'=>$namaKecamatan,
                    'tipeTanah'=>$tipeTanah,
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
                        $id_kecamatan[] = json_decode($value['id_polygonkecamatan']);
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
                        "id_polygonkecamatan"=> $id_kecamatan[$row],
                        
        
                    ];
                    $response[]=$data;
                }

                foreach($polygonkecamatan as $index=>$value)
                {
                    if($value['polygon'] != NULL){
                        $polygontanah[] = json_decode($value['polygon']);
                        $id_polygonkecamatan[] = json_decode($value['id_polygonkecamatan']);
                        $nama[] = $value['nama'];
                        $luaskecamatan[] = json_decode($value['luas']);
                        $akumulasiluastanah[] = json_decode($value['akumulasiluastanah']);
                        $akumulasijumlahpenggarap[] = json_decode($value['akumulasijumlahpenggarap']);
                        $jumlahtanahwakaf[] = json_decode($value['jumlahtanahwakaf']);
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
                        $sumluas = 0;
                        foreach($wakaf as $index=>$value){
                            if($id_polygonkecamatan[$row] == $value['id_polygonkecamatan']){
                                $sumluas =  $sumluas + $value['luas'];
                            }
                        }
                        $data['properties'] = [
                            "id_polygonkecamatan"=> $id_polygonkecamatan[$row],
                            "nama"=> $nama[$row],
                            "luaskecamatan"=> $luaskecamatan[$row],
                            "akumulasiluastanah"=> $sumluas,
                            "akumulasijumlahpenggarap"=> $akumulasijumlahpenggarap[$row],
                            "jumlahtanahwakaf"=> $jumlahtanahwakaf[$row]
                        ];
                    }
                    $response1[]=$data;   
                }

                return view('polygon/luas',[
                    'data'=> $features,
                    'data1'=> $response1,
                    'marker'=>$response,
                    'nilaiMax'=>$nilaiMax,
                    'namaTanah' =>$namaTanah,
                    'namaKecamatan'=>$namaKecamatan,
                    'tipeTanah'=>$tipeTanah,
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
                        $id_kecamatan[] = json_decode($value['id_polygonkecamatan']);
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
                        "id_polygonkecamatan"=> $id_kecamatan[$row],
                    ];
                    $response[]=$data;
                }
                console_log($response);
                foreach($polygonkecamatan as $index=>$value)
                {
                    if($value['polygon'] != NULL){
                        $polygontanah[] = json_decode($value['polygon']);
                        $id_polygonkecamatan[] = json_decode($value['id_polygonkecamatan']);
                        $nama[] = $value['nama'];
                        $luaskecamatan[] = json_decode($value['luas']);
                        $akumulasiluastanah[] = json_decode($value['akumulasiluastanah']);
                        $akumulasijumlahpenggarap[] = json_decode($value['akumulasijumlahpenggarap']);
                        $jumlahtanahwakaf[] = json_decode($value['jumlahtanahwakaf']);
                    }
                }
                foreach($polygontanah as $row=>$val){
                    foreach($polygontanah[$row] as $rows=>$vl){
                        $polygon[$row][$rows] = [$vl->lng, $vl->lat];
                        $data['geometry'] = [
                            "type" => "Polygon",
                            "coordinates" => [$polygon[$row]]
                        ];
                        $data['type'] = "Feature";
                        $sumluas = 0;
                        foreach($wakaf as $index=>$value){
                            if($id_polygonkecamatan[$row] == $value['id_polygonkecamatan']){
                                $sumluas =  $sumluas + $value['luas'];
                            }
                        }
                        $data['properties'] = [
                            "id_polygonkecamatan"=> $id_polygonkecamatan[$row],
                            "nama"=> $nama[$row],
                            "luaskecamatan"=> $luaskecamatan[$row],
                            "akumulasiluastanah"=> $sumluas,
                            "akumulasijumlahpenggarap"=> $akumulasijumlahpenggarap[$row],
                            "jumlahtanahwakaf"=> $jumlahtanahwakaf[$row]
                        ];
                    }
                    $response1[]=$data;   
                }
                console_log($response1);
                return view('polygon/luas',[
                    'data'=> $features,
                    'data1'=> $response1,
                    'marker'=>$response,
                    'nilaiMax'=>$nilaiMax,
                    'namaTanah' =>$namaTanah,
                    'namaKecamatan'=>$namaKecamatan,
                    'tipeTanah'=>$tipeTanah,
                ]); 

            }

    }

    public function analisisjumlahTanah(){
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

            $tipeTanah = []; 
            foreach($wakaf as $index=>$value){
                if($value['marker'] != NULL ){
                    $tipeTanah[$value['tipe']] = $value['tipe'];
                }
            }

            $pilihTipe = '';
            if($this->request->getPost('tipe'))
            {
                $pilihTipe = $this->request->getPost('tipe');
                console_log($pilihTipe);
                foreach($wakaf as $index=>$value)
                {
                    if($value['marker'] != NULL && $value['tipe'] == $pilihTipe){ // Assign seluruh row marker yang memenuhi kondisi
                        $markertanah[] = json_decode($value['marker']);  // json_decode disini digunakan untuk mengubah value dari variabel
                        $no[] = json_decode($value['no']);               // menjadi objek
                        $wilayah[] = $value['wilayah'];
                        $tipe[] = $value['tipe'];
                        $mandor[] = $value['mandor'];
                        $jumlahpenggarap[] = json_decode($value['jumlahpenggarap']);
                        $luas[] = json_decode($value['luas']);
                        $setoranpanen[] = json_decode($value['setoranpanen']);
                        $googleearth[] = $value['googleearth'];
                        $id_kecamatan[] = $value['id_polygonkecamatan'];
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
                        "id_polygonkecamatan"=> $id_kecamatan[$row],
        
                    ];
                    $response[]=$data;
                }

                foreach($polygonkecamatan as $index=>$value)
                {
                    if($value['polygon'] != NULL){
                        $polygontanah[] = json_decode($value['polygon']);
                        $id_polygonkecamatan[] = json_decode($value['id_polygonkecamatan']);
                        $nama[] = $value['nama'];
                        $luaskecamatan[] = json_decode($value['luas']);
                        $akumulasiluastanah[] = json_decode($value['akumulasiluastanah']);
                        $akumulasijumlahpenggarap[] = json_decode($value['akumulasijumlahpenggarap']);
                        $jumlahtanahwakaf[] = json_decode($value['jumlahtanahwakaf']);
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
                        $sumtanah = 0;
                        foreach($wakaf as $index=>$value){
                            if($id_polygonkecamatan[$row] == $value['id_polygonkecamatan']){
                                $sumtanah++;
                            }
                        }
                        $data['properties'] = [
                            "id_polygonkecamatan"=> $id_polygonkecamatan[$row],
                            "nama"=> $nama[$row],
                            "luaskecamatan"=> $luaskecamatan[$row],
                            "akumulasiluastanah"=> $akumulasiluastanah[$row],
                            "akumulasijumlahpenggarap"=> $akumulasijumlahpenggarap[$row],
                            "jumlahtanahwakaf"=> $sumtanah
                        ];
                    }
                    $response1[]=$data;   
                }
                console_log($response1);

                return view('polygon/jumlahtanah',[
                    'data'=> $features,
                    'data1'=> $response1,
                    'marker'=>$response,
                    'nilaiMax'=>$nilaiMax,
                    'namaTanah' =>$namaTanah,
                    'namaKecamatan'=>$namaKecamatan,
                    'tipeTanah'=>$tipeTanah,
                ]); 
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
                        $id_kecamatan[] = $value['id_polygonkecamatan'];
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
                        "id_polygonkecamatan"=> $id_kecamatan[$row],
        
                    ];
                    $response[]=$data;
                }

                foreach($polygonkecamatan as $index=>$value)
                {
                    if($value['polygon'] != NULL){
                        $polygontanah[] = json_decode($value['polygon']);
                        $id_polygonkecamatan[] = json_decode($value['id_polygonkecamatan']);
                        $nama[] = $value['nama'];
                        $luaskecamatan[] = json_decode($value['luas']);
                        $akumulasiluastanah[] = json_decode($value['akumulasiluastanah']);
                        $akumulasijumlahpenggarap[] = json_decode($value['akumulasijumlahpenggarap']);
                        $jumlahtanahwakaf[] = json_decode($value['jumlahtanahwakaf']);
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
                        $sumtanah = 0;
                        foreach($wakaf as $index=>$value){
                            if($id_polygonkecamatan[$row] == $value['id_polygonkecamatan']){
                                $sumtanah++;
                            }
                        }
                        $data['properties'] = [
                            "id_polygonkecamatan"=> $id_polygonkecamatan[$row],
                            "nama"=> $nama[$row],
                            "luaskecamatan"=> $luaskecamatan[$row],
                            "akumulasiluastanah"=> $akumulasiluastanah[$row],
                            "akumulasijumlahpenggarap"=> $akumulasijumlahpenggarap[$row],
                            "jumlahtanahwakaf"=> $sumtanah
                        ];
                    }
                    $response1[]=$data;   
                }
                console_log($response1);

                return view('polygon/jumlahtanah',[
                    'data'=> $features,
                    'data1'=> $response1,
                    'marker'=>$response,
                    'nilaiMax'=>$nilaiMax,
                    'namaTanah' =>$namaTanah,
                    'namaKecamatan'=>$namaKecamatan,
                    'tipeTanah'=>$tipeTanah,
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
                        $id_kecamatan[] = $value['id_polygonkecamatan'];
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
                        "id_polygonkecamatan"=> $id_kecamatan[$row],
        
                    ];
                    $response[]=$data;
                }

                foreach($polygonkecamatan as $index=>$value)
                {
                    if($value['polygon'] != NULL){
                        $polygontanah[] = json_decode($value['polygon']);
                        $id_polygonkecamatan[] = json_decode($value['id_polygonkecamatan']);
                        $nama[] = $value['nama'];
                        $luaskecamatan[] = json_decode($value['luas']);
                        $akumulasiluastanah[] = json_decode($value['akumulasiluastanah']);
                        $akumulasijumlahpenggarap[] = json_decode($value['akumulasijumlahpenggarap']);
                        $jumlahtanahwakaf[] = json_decode($value['jumlahtanahwakaf']);
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
                        $sumtanah = 0;
                        foreach($wakaf as $index=>$value){
                            if($id_polygonkecamatan[$row] == $value['id_polygonkecamatan']){
                                $sumtanah++;
                            }
                        }
                        $data['properties'] = [
                            "id_polygonkecamatan"=> $id_polygonkecamatan[$row],
                            "nama"=> $nama[$row],
                            "luaskecamatan"=> $luaskecamatan[$row],
                            "akumulasiluastanah"=> $akumulasiluastanah[$row],
                            "akumulasijumlahpenggarap"=> $akumulasijumlahpenggarap[$row],
                            "jumlahtanahwakaf"=> $sumtanah
                        ];
                    }
                    $response1[]=$data;   
                }

                return view('polygon/jumlahtanah',[
                    'data'=> $features,
                    'data1'=> $response1,
                    'marker'=>$response,
                    'nilaiMax'=>$nilaiMax,
                    'namaTanah' =>$namaTanah,
                    'namaKecamatan'=>$namaKecamatan,
                    'tipeTanah'=>$tipeTanah,
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
                        $id_kecamatan[] = $value['id_polygonkecamatan'];
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
                        "id_polygonkecamatan"=> $id_kecamatan[$row],
                    ];
                    $response[]=$data;
                }
                foreach($polygonkecamatan as $index=>$value)
                {
                    if($value['polygon'] != NULL){
                        $polygontanah[] = json_decode($value['polygon']);
                        $id_polygonkecamatan[] = json_decode($value['id_polygonkecamatan']);
                        $nama[] = $value['nama'];
                        $luaskecamatan[] = json_decode($value['luas']);
                        $akumulasiluastanah[] = json_decode($value['akumulasiluastanah']);
                        $akumulasijumlahpenggarap[] = json_decode($value['akumulasijumlahpenggarap']);
                        $jumlahtanahwakaf[] = json_decode($value['jumlahtanahwakaf']);
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
                        $sumtanah = 0;
                        foreach($wakaf as $index=>$value){
                            if($id_polygonkecamatan[$row] == $value['id_polygonkecamatan']){
                                $sumtanah++;
                            }
                        }
                        $data['properties'] = [
                            "id_polygonkecamatan"=> $id_polygonkecamatan[$row],
                            "nama"=> $nama[$row],
                            "luaskecamatan"=> $luaskecamatan[$row],
                            "akumulasiluastanah"=> $akumulasiluastanah[$row],
                            "akumulasijumlahpenggarap"=> $akumulasijumlahpenggarap[$row],
                            "jumlahtanahwakaf"=> $sumtanah
                        ];
                    }
                    $response1[]=$data;   
                }
                console_log($response1);
                return view('polygon/jumlahtanah',[
                    'data'=> $features,
                    'data1'=> $response1,
                    'marker'=>$response,
                    'nilaiMax'=>$nilaiMax,
                    'namaTanah' =>$namaTanah,
                    'namaKecamatan'=>$namaKecamatan,
                    'tipeTanah'=>$tipeTanah,
                ]); 

            }

    }


    public function analisisPenggarap(){
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

            $tipeTanah = []; 
            foreach($wakaf as $index=>$value){
                if($value['marker'] != NULL ){
                    $tipeTanah[$value['tipe']] = $value['tipe'];
                }
            }

            $pilihTipe = '';
            if($this->request->getPost('tipe'))
            {
                $pilihTipe = $this->request->getPost('tipe');
                console_log($pilihTipe);
                foreach($wakaf as $index=>$value)
                {
                    if($value['marker'] != NULL && $value['tipe'] == $pilihTipe){ // Assign seluruh row marker yang memenuhi kondisi
                        $markertanah[] = json_decode($value['marker']);  // json_decode disini digunakan untuk mengubah value dari variabel
                        $no[] = json_decode($value['no']);               // menjadi objek
                        $wilayah[] = $value['wilayah'];
                        $tipe[] = $value['tipe'];
                        $mandor[] = $value['mandor'];
                        $jumlahpenggarap[] = json_decode($value['jumlahpenggarap']);
                        $luas[] = json_decode($value['luas']);
                        $setoranpanen[] = json_decode($value['setoranpanen']);
                        $googleearth[] = $value['googleearth'];
                        $id_kecamatan[] = $value['id_polygonkecamatan'];
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
                        "id_polygonkecamatan"=> $id_kecamatan[$row],
        
                    ];
                    $response[]=$data;
                }

                foreach($polygonkecamatan as $index=>$value)
                {
                    if($value['polygon'] != NULL){
                        $polygontanah[] = json_decode($value['polygon']);
                        $id_polygonkecamatan[] = json_decode($value['id_polygonkecamatan']);
                        $nama[] = $value['nama'];
                        $luaskecamatan[] = json_decode($value['luas']);
                        $akumulasiluastanah[] = json_decode($value['akumulasiluastanah']);
                        $akumulasijumlahpenggarap[] = json_decode($value['akumulasijumlahpenggarap']);
                        $jumlahtanahwakaf[] = json_decode($value['jumlahtanahwakaf']);
                        $luaspenggarap[] = $akumulasiluastanah[$index]/$akumulasijumlahpenggarap[$index];
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
                        $sumpenggarap = 0;
                        foreach($wakaf as $index=>$value){
                            if($id_polygonkecamatan[$row] == $value['id_polygonkecamatan']){
                                $sumpenggarap =  $sumpenggarap + $value['jumlahpenggarap'];
                            }
                        }
                        $data['properties'] = [
                            "id_polygonkecamatan"=> $id_polygonkecamatan[$row],
                            "nama"=> $nama[$row],
                            "luaskecamatan"=> $luaskecamatan[$row],
                            "akumulasiluastanah"=> $akumulasiluastanah[$row],
                            "akumulasijumlahpenggarap"=> $sumpenggarap,
                            "jumlahtanahwakaf"=> $jumlahtanahwakaf[$row],
                            "luaspenggarap"=>$luaspenggarap[$row]
                        ];
                    }
                    $response1[]=$data;   
                }
                console_log($response1);

                return view('polygon/penggarap',[
                    'data'=> $features,
                    'data1'=> $response1,
                    'marker'=>$response,
                    'nilaiMax'=>$nilaiMax,
                    'namaTanah' =>$namaTanah,
                    'namaKecamatan'=>$namaKecamatan,
                    'tipeTanah'=>$tipeTanah,
                ]); 
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
                        $id_kecamatan[] = $value['id_polygonkecamatan'];
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
                        "id_polygonkecamatan"=> $id_kecamatan[$row],
        
                    ];
                    $response[]=$data;
                }

                foreach($polygonkecamatan as $index=>$value)
                {
                    if($value['polygon'] != NULL){
                        $polygontanah[] = json_decode($value['polygon']);
                        $id_polygonkecamatan[] = json_decode($value['id_polygonkecamatan']);
                        $nama[] = $value['nama'];
                        $luaskecamatan[] = json_decode($value['luas']);
                        $akumulasiluastanah[] = json_decode($value['akumulasiluastanah']);
                        $akumulasijumlahpenggarap[] = json_decode($value['akumulasijumlahpenggarap']);
                        $jumlahtanahwakaf[] = json_decode($value['jumlahtanahwakaf']);
                        $luaspenggarap[] = $akumulasiluastanah[$index]/$akumulasijumlahpenggarap[$index];
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
                        $sumpenggarap = 0;
                        foreach($wakaf as $index=>$value){
                            if($id_polygonkecamatan[$row] == $value['id_polygonkecamatan']){
                                $sumpenggarap =  $sumpenggarap + $value['jumlahpenggarap'];
                            }
                        }
                        $data['properties'] = [
                            "id_polygonkecamatan"=> $id_polygonkecamatan[$row],
                            "nama"=> $nama[$row],
                            "luaskecamatan"=> $luaskecamatan[$row],
                            "akumulasiluastanah"=> $akumulasiluastanah[$row],
                            "akumulasijumlahpenggarap"=> $sumpenggarap,
                            "jumlahtanahwakaf"=> $jumlahtanahwakaf[$row],
                            "luaspenggarap"=>$luaspenggarap[$row]
                        ];
                    }
                    $response1[]=$data;   
                }
                console_log($response1);

                return view('polygon/penggarap',[
                    'data'=> $features,
                    'data1'=> $response1,
                    'marker'=>$response,
                    'nilaiMax'=>$nilaiMax,
                    'namaTanah' =>$namaTanah,
                    'namaKecamatan'=>$namaKecamatan,
                    'tipeTanah'=>$tipeTanah,
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
                        $id_kecamatan[] = $value['id_polygonkecamatan'];
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
                        "id_polygonkecamatan"=> $id_kecamatan[$row],
        
                    ];
                    $response[]=$data;
                }

                foreach($polygonkecamatan as $index=>$value)
                {
                    if($value['polygon'] != NULL){
                        $polygontanah[] = json_decode($value['polygon']);
                        $id_polygonkecamatan[] = json_decode($value['id_polygonkecamatan']);
                        $nama[] = $value['nama'];
                        $luaskecamatan[] = json_decode($value['luas']);
                        $akumulasiluastanah[] = json_decode($value['akumulasiluastanah']);
                        $akumulasijumlahpenggarap[] = json_decode($value['akumulasijumlahpenggarap']);
                        $jumlahtanahwakaf[] = json_decode($value['jumlahtanahwakaf']);
                        $luaspenggarap[] = round($akumulasiluastanah[$index]/$akumulasijumlahpenggarap[$index],2);
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
                        $sumpenggarap = 0;
                        foreach($wakaf as $index=>$value){
                            if($id_polygonkecamatan[$row] == $value['id_polygonkecamatan']){
                                $sumpenggarap =  $sumpenggarap + $value['jumlahpenggarap'];
                            }
                        }
                        $data['properties'] = [
                            "id_polygonkecamatan"=> $id_polygonkecamatan[$row],
                            "nama"=> $nama[$row],
                            "luaskecamatan"=> $luaskecamatan[$row],
                            "akumulasiluastanah"=> $akumulasiluastanah[$row],
                            "akumulasijumlahpenggarap"=> $sumpenggarap,
                            "jumlahtanahwakaf"=> $jumlahtanahwakaf[$row],
                            "luaspenggarap"=>$luaspenggarap[$row]
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
                    'tipeTanah'=>$tipeTanah,
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
                        $id_kecamatan[] = $value['id_polygonkecamatan'];
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
                        "id_polygonkecamatan"=> $id_kecamatan[$row],
                    ];
                    $response[]=$data;
                }
                foreach($polygonkecamatan as $index=>$value)
                {
                    if($value['polygon'] != NULL){
                        $polygontanah[] = json_decode($value['polygon']);
                        $id_polygonkecamatan[] = json_decode($value['id_polygonkecamatan']);
                        $nama[] = $value['nama'];
                        $luaskecamatan[] = json_decode($value['luas']);
                        $akumulasiluastanah[] = json_decode($value['akumulasiluastanah']);
                        $akumulasijumlahpenggarap[] = json_decode($value['akumulasijumlahpenggarap']);
                        $jumlahtanahwakaf[] = json_decode($value['jumlahtanahwakaf']);
                        $luaspenggarap[] = round($akumulasiluastanah[$index]/$akumulasijumlahpenggarap[$index],2);
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
                        $sumpenggarap = 0;
                        foreach($wakaf as $index=>$value){
                            if($id_polygonkecamatan[$row] == $value['id_polygonkecamatan']){
                                $sumpenggarap =  $sumpenggarap + $value['jumlahpenggarap'];
                            }
                        }
                        $data['properties'] = [
                            "id_polygonkecamatan"=> $id_polygonkecamatan[$row],
                            "nama"=> $nama[$row],
                            "luaskecamatan"=> $luaskecamatan[$row],
                            "akumulasiluastanah"=> $akumulasiluastanah[$row],
                            "akumulasijumlahpenggarap"=> $sumpenggarap,
                            "jumlahtanahwakaf"=> $jumlahtanahwakaf[$row],
                            "luaspenggarap"=>$luaspenggarap[$row]
                        ];
                    }
                    $response1[]=$data;   
                }
                console_log($response1);
                return view('polygon/penggarap',[
                    'data'=> $features,
                    'data1'=> $response1,
                    'marker'=>$response,
                    'nilaiMax'=>$nilaiMax,
                    'namaTanah' =>$namaTanah,
                    'namaKecamatan'=>$namaKecamatan,
                    'tipeTanah'=>$tipeTanah,
                ]); 

            }

    }

    public function viewpolygon($id){

        function console_log($output, $with_script_tags = true) {
            $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
        ');';
            if ($with_script_tags) {
                $js_code = '<script>' . $js_code . '</script>';
            }
            echo $js_code;
        }

        $model = new PolygonKecamatanModel();
        $polygonkecamatan = $model->getPolygonKecamatan($id)->getRow();
        console_log($polygonkecamatan);
        helper('form');
        $polygontanah[] = json_decode($polygonkecamatan->polygon);
        $id_polygonkecamatan[] = json_decode($polygonkecamatan->id_polygonkecamatan);
        $nama[] = $polygonkecamatan->nama;
        $luas[] = json_decode($polygonkecamatan->luas);
        $akumulasiluastanah[] = json_decode($polygonkecamatan->akumulasiluastanah);
        $akumulasijumlahpenggarap[] = json_decode($polygonkecamatan->akumulasijumlahpenggarap);
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

		$fileName = "http://localhost/tugasakhir/public/maps/polygonsumedang.geojson";
		$file = file_get_contents($fileName);
		$file = json_decode($file);
        // console_log($file);
		$features = $file->features;
        // $features = json_encode($features);
        console_log($features);
        console_log($response1);


		return view('entry/viewpolygon',[
            'polygontanah'=>$polygontanah,
            'polygonkecamatan'=>$polygonkecamatan,
			'data'=> $features,
			'data1'=> $response1,

		]);
    }
}
