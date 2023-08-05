<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PolygonKecamatanModel;
use App\Models\WakafModel;

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
                        "mandor"=> $mandor[$row],
                        "jumlahpenggarap"=>$jumlahpenggarap[$row],
                        "luas"=> $luas[$row],
                        "setoranpanen"=> $setoranpanen[$row],
                        "googleearth"=> $googleearth[$row],
        
                    ];
                    $response[]=$data;
                }

                // foreach($response as $index=>$feature){
                //     $NadzirWakaf = $feature['properties']['NadzirWakaf'];
                //     console_log($NadzirWakaf);
                //     $data = $modelNadzir->where('NadzirWakaf', $NadzirWakaf)
                //             ->first();
                //     if($data)
                //     {
                //         $response[$index]['properties']['nadzir'] = $data['nama'];
                //         $response[$index]['properties']['jabatan'] = $data['jabatan'];
                //         $response[$index]['properties']['tupoksi'] = $data['tupoksi'];
                //         $response[$index]['properties']['alamat'] = $data['alamat'];
                //         $response[$index]['properties']['sk'] = $data['sk'];
                //         $response[$index]['properties']['statusNadzir'] = $data['status'];
    
                //     }
                    
                // }

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

                // foreach($response1 as $index=>$feature){
                //     $no = $feature['properties']['No'];
                //     console_log($no);
                //     $data = $modelKecamatan->where('id_kecamatan', $no)
                //             ->first();
                //     if($data)
                //     {
                //         $response1[$index]['properties']['luas'] = $data['luas'];
                //         $response1[$index]['properties']['jumlahtanahwakaf'] = $data['jumlahtanah'];
                //     }  
                // }

                return view('polygon/luas',[
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
                        "mandor"=> $mandor[$row],
                        "jumlahpenggarap"=>$jumlahpenggarap[$row],
                        "luas"=> $luas[$row],
                        "setoranpanen"=> $setoranpanen[$row],
                        "googleearth"=> $googleearth[$row],
        
                    ];
                    $response[]=$data;
                }

                // foreach($response as $index=>$feature){
                //     $NadzirWakaf = $feature['properties']['NadzirWakaf'];
                //     console_log($NadzirWakaf);
                //     $data = $modelNadzir->where('NadzirWakaf', $NadzirWakaf)
                //             ->first();
                //     if($data)
                //     {
                //         $response[$index]['properties']['nadzir'] = $data['nama'];
                //         $response[$index]['properties']['jabatan'] = $data['jabatan'];
                //         $response[$index]['properties']['tupoksi'] = $data['tupoksi'];
                //         $response[$index]['properties']['alamat'] = $data['alamat'];
                //         $response[$index]['properties']['sk'] = $data['sk'];
                //         $response[$index]['properties']['statusNadzir'] = $data['status'];
    
                //     }
                    
                // }

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

                // foreach($response1 as $index=>$feature){
                //     $no = $feature['properties']['No'];
                //     console_log($no);
                //     $data = $modelKecamatan->where('id_kecamatan', $no)
                //             ->first();
                //     if($data)
                //     {
                //         $response1[$index]['properties']['luas'] = $data['luas'];
                //         $response1[$index]['properties']['jumlahtanahwakaf'] = $data['jumlahtanah'];
                //     }  
                // }

                return view('polygon/luas',[
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
                return view('polygon/luas',[
                    'data'=> $features,
                    'data1'=> $response1,
                    'marker'=>$response,
                    'nilaiMax'=>$nilaiMax,
                    'namaTanah' =>$namaTanah,
                    'namaKecamatan'=>$namaKecamatan,
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
