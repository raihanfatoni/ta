<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\TanahModel;
use App\Models\KecamatanModel;
use App\Models\NadzirModel;

class Tanah extends Controller
{
    public function index()
    {
        if(session()->has('isLoggedIn')){
            helper('form');
            $model = new TanahModel();
            $data['tanah'] = $model->getTanah();
            echo view('tanah_view', $data);
        } else {
            return redirect()->to(base_url("login"));
        }
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
            $model = new TanahModel();
            $tanah = $model->getTanah();
            helper('form');
    
            foreach($tanah as $index=>$value)
            {
                if($value['polygon'] != NULL){
                    $polygontanah[] = json_decode($value['polygon']);
                    $no[] = json_decode($value['No']);
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
                    "No"=> $no[$row],
                ];
                $response1[]=$data;
                
            }
    
            $fileName = "http://localhost/tugasakhir/public/maps/polygonsumedang.geojson";
            $file = file_get_contents($fileName);
            $file = json_decode($file);
            // console_log($file);
            $features = $file->features;
            console_log($features);
    
            foreach($tanah as $index=>$value)
            {
                if($value['marker'] != NULL){
                    $markertanah[] = json_decode($value['marker']);
                    $no[] = json_decode($value['No']);
                    $lokasi[] = $value['Lokasi'];
                    $status[] = $value['KoordinatLokasi'];
                    $tipe[] = $value['Tipe'];
                    $luasdahulu[] = json_decode($value['LuasDahulu']);
                    $luasbau[] = json_decode($value['LuasDalamBau']);
                    $luasmeter[] = json_decode($value['LuasDalamMeterPersegi']);
                    $luastumbak[] = json_decode($value['LuasDalamTumbak']);
                    $luassekarang[] = json_decode($value['LuasSekarang']);
                    $nadzirwakaf[] = $value['NadzirWakaf'];
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
                    "No"=> $no[$row],
                    "Lokasi"=> $lokasi[$row],
                    "Status"=> $status[$row],
                    "Tipe"=>$tipe[$row],
                    "LuasDahulu"=> $luasdahulu[$row],
                    "LuasBau"=> $luasbau[$row],
                    "LuasMeter"=> $luasmeter[$row],
                    "LuasTumbak"=> $luastumbak[$row],
                    "LuasSekarang"=> $luassekarang[$row],
                    "NadzirWakaf"=> $nadzirwakaf[$row],
                    "GoogleEarth"=> $googleearth[$row],
    
                ];
                $response[]=$data;
            }
            return view('form/index',[
                'data'=> $features,
                'marker'=>$response,
                'data1'=>$response1,
            ]);
        } else {
            return redirect()->to(base_url("login"));
        }    
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
            $model = new TanahModel();
            $tanah = $model->getTanah();
            helper('form');
    
            foreach($tanah as $index=>$value)
            {
                if($value['polygon'] != NULL){
                    $polygontanah[] = json_decode($value['polygon']);
                    $no[] = json_decode($value['No']);
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
                    "No"=> $no[$row],
                ];
                $response1[]=$data;        
            }
    
            $fileName = "http://localhost/tugasakhir/public/maps/polygonsumedang.geojson";
            $file = file_get_contents($fileName);
            $file = json_decode($file);
            $features = $file->features;
            console_log($features);
    
            foreach($tanah as $index=>$value)
            {
                if($value['marker'] != NULL){
                    $markertanah[] = json_decode($value['marker']);
                    $no[] = json_decode($value['No']);
                    $lokasi[] = $value['Lokasi'];
                    $status[] = $value['KoordinatLokasi'];
                    $tipe[] = $value['Tipe'];
                    $luasdahulu[] = json_decode($value['LuasDahulu']);
                    $luasbau[] = json_decode($value['LuasDalamBau']);
                    $luasmeter[] = json_decode($value['LuasDalamMeterPersegi']);
                    $luastumbak[] = json_decode($value['LuasDalamTumbak']);
                    $luassekarang[] = json_decode($value['LuasSekarang']);
                    $nadzirwakaf[] = $value['NadzirWakaf'];
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
                    "No"=> $no[$row],
                    "Lokasi"=> $lokasi[$row],
                    "Status"=> $status[$row],
                    "Tipe"=>$tipe[$row],
                    "LuasDahulu"=> $luasdahulu[$row],
                    "LuasBau"=> $luasbau[$row],
                    "LuasMeter"=> $luasmeter[$row],
                    "LuasTumbak"=> $luastumbak[$row],
                    "LuasSekarang"=> $luassekarang[$row],
                    "NadzirWakaf"=> $nadzirwakaf[$row],
                    "GoogleEarth"=> $googleearth[$row],
    
                ];
                $response[]=$data;
            }
            return view('form/marker',[
                'marker'=>$response,
                'data'=> $features,
                'data1' => $response1,
            ]);
        } else {
            return redirect()->to(base_url("login"));
        }
    }
    public function polygontanahwakaf(){

        function console_log($output, $with_script_tags = true) {
            $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
        ');';
            if ($with_script_tags) {
                $js_code = '<script>' . $js_code . '</script>';
            }
            echo $js_code;
        }

        $model = new TanahModel();
        $tanah = $model->getTanah();

        $modelKecamatan = new KecamatanModel();
        $kecamatan =  $modelKecamatan->getKecamatan();

		foreach($tanah as $index=>$value)
		{
            if($value['polygon'] != NULL){
                $polygontanah[] = json_decode($value['polygon']);
                $no[] = json_decode($value['No']);
                $lokasi[] = $value['Lokasi'];
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
                "No"=> $no[$row],
                "Lokasi"=> $lokasi[$row],

            ];
            $response[]=$data;  //  $polygon[] = [$polygontanah[$row][$row]->lat, $polygontanah[$row][$row]->lng];
            
        }
        foreach($response as $index=>$feature){
            $no = $feature['properties']['No'];
            $data = $modelKecamatan->where('id_kecamatan', $no)
                    ->first();
            if($data)
            {
                $response[$index]['properties']['luas'] = $data['luas'];
                $response[$index]['properties']['jumlahtanahwakaf'] = $data['jumlahtanah'];
            }  
        }
        console_log($response);
        helper('form');

		$fileName = "http://localhost/tugasakhir/public/maps/polygonsumedang.geojson";
		$file = file_get_contents($fileName);
		$file = json_decode($file);
        // console_log($file);
		$features = $file->features;
        console_log($features);

		$nilaiMax = 123;
		return view('tanahwakaf/index',[
            'data'=> $response,
            'data1'=> $features,
			'nilaiMax'=>$nilaiMax,
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
            $model = new TanahModel();
            $tanah = $model->getTanah();
            console_log($tanah);
        
            $modelKecamatan = new KecamatanModel;
            $kecamatan = $modelKecamatan->getKecamatan();
            console_log($kecamatan);
    
            $modelNadzir = new NadzirModel;
            $nadzir = $modelNadzir->getNadzir();
            console_log($nadzir);
            $nilaiMax = 10697;
    
            // Loop untuk memuat konten dropdown yang berperan sebagai filter untuk penampilan data
            $tipeTanah = []; 
            foreach($tanah as $index=>$value){
                if($value['marker'] != NULL ){
                    $tipeTanah[$value['Tipe']] = $value['Tipe'];
                }
            }
            $namaTanah = [];
            foreach($tanah as $index=>$value){
                if($value['marker'] != NULL){
                    $namaTanah[$value['Lokasi']] = $value['Lokasi']; 
                }
            }
            $namaKecamatan = [];
            foreach($kecamatan as $index=>$value){
                $namaKecamatan[$value['id_kecamatan']] = $value['nama'];
            }

            // Logic untuk menampilkan marker berdasarkan kecamatan pada peta digital
            $pilihKecamatan = '';
            if($this->request->getPost('kecamatan'))
            {
                $pilihKecamatan = $this->request->getPost('kecamatan');
                console_log($pilihKecamatan);
                foreach($tanah as $index=>$value)
                {
                    if($value['marker'] != NULL && $value['id_kecamatan'] == $pilihKecamatan){ // Assign seluruh row marker yang memenuhi kondisi
                        $markertanah[] = json_decode($value['marker']);  // json_decode disini digunakan untuk mengubah value dari variabel
                        $no[] = json_decode($value['No']);               // menjadi objek
                        $lokasi[] = $value['Lokasi'];
                        $status[] = $value['KoordinatLokasi'];
                        $tipe[] = $value['Tipe'];
                        $luasdahulu[] = json_decode($value['LuasDahulu']);
                        $luasbau[] = json_decode($value['LuasDalamBau']);
                        $luasmeter[] = json_decode($value['LuasDalamMeterPersegi']);
                        $luastumbak[] = json_decode($value['LuasDalamTumbak']);
                        $luassekarang[] = json_decode($value['LuasSekarang']);
                        $nadzirwakaf[] = $value['NadzirWakaf'];
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
                        "No"=> $no[$row],
                        "Lokasi"=> $lokasi[$row],
                        "Status"=> $status[$row],
                        "Tipe"=>$tipe[$row],
                        "LuasDahulu"=> $luasdahulu[$row],
                        "LuasBau"=> $luasbau[$row],
                        "LuasMeter"=> $luasmeter[$row],
                        "LuasTumbak"=> $luastumbak[$row],
                        "LuasSekarang"=> $luassekarang[$row],
                        "NadzirWakaf"=> $nadzirwakaf[$row],
                        "GoogleEarth"=> $googleearth[$row],
        
                    ];
                    $response[]=$data;
                }
                foreach($response as $index=>$feature){
                    $NadzirWakaf = $feature['properties']['NadzirWakaf'];
                    console_log($NadzirWakaf);
                    $data = $modelNadzir->where('NadzirWakaf', $NadzirWakaf)
                            ->first();
                    if($data)
                    {
                        $response[$index]['properties']['nadzir'] = $data['nama'];
                        $response[$index]['properties']['jabatan'] = $data['jabatan'];
                        $response[$index]['properties']['tupoksi'] = $data['tupoksi'];
                        $response[$index]['properties']['alamat'] = $data['alamat'];
                        $response[$index]['properties']['sk'] = $data['sk'];
                        $response[$index]['properties']['statusNadzir'] = $data['status'];
    
                    }
                    
                }
                foreach($tanah as $index=>$value)
                {
                    if($value['polygon'] != NULL){
                        $polygontanah[] = json_decode($value['polygon']);
                        $nomor[] = json_decode($value['No']);
                        $kelurahan[] = $value['Lokasi'];
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
                            "No"=> $nomor[$row],
                            "Lokasi"=> $kelurahan[$row]
                        ];
                    }
                
                    $response1[]=$data;   
                }
                foreach($response1 as $index=>$feature){
                    $no = $feature['properties']['No'];
                    console_log($no);
                    $data = $modelKecamatan->where('id_kecamatan', $no)
                            ->first();
                    if($data)
                    {
                        $response1[$index]['properties']['luas'] = $data['luas'];
                        $response1[$index]['properties']['jumlahtanahwakaf'] = $data['jumlahtanah'];
                    }  
                }
                return view('polygon/index',[
                    'data'=> $features,
                    'data1'=> $response1,
                    'marker'=>$response,
                    'nilaiMax'=>$nilaiMax,
                    'tipeTanah' =>$tipeTanah,
                    'namaTanah' =>$namaTanah,
                    'namaKecamatan'=>$namaKecamatan,
                ]); 
            }
    
            // Logic untuk menampilkan marker berdasarkan lokasi pada peta digital
            $pilihTanah = '';
            if($this->request->getPost('tanah')) // Kondisi ini akan dieksekusi jika user melakukan POST pada dropdown dengan name ='tanah'
            {
                $pilihTanah = $this->request->getPost('tanah');
                console_log($pilihTanah);
                foreach($tanah as $index=>$value)
                {
                    if($value['marker'] != NULL && $value['Lokasi'] == $pilihTanah){ // Assign seluruh row marker yang memenuhi kondisi
                        $markertanah[] = json_decode($value['marker']);  // json_decode disini digunakan untuk mengubah value dari variabel
                        $no[] = json_decode($value['No']);               // menjadi objek
                        $lokasi[] = $value['Lokasi'];
                        $status[] = $value['KoordinatLokasi'];
                        $tipe[] = $value['Tipe'];
                        $luasdahulu[] = json_decode($value['LuasDahulu']);
                        $luasbau[] = json_decode($value['LuasDalamBau']);
                        $luasmeter[] = json_decode($value['LuasDalamMeterPersegi']);
                        $luastumbak[] = json_decode($value['LuasDalamTumbak']);
                        $luassekarang[] = json_decode($value['LuasSekarang']);
                        $nadzirwakaf[] = $value['NadzirWakaf'];
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
                        "No"=> $no[$row],
                        "Lokasi"=> $lokasi[$row],
                        "Status"=> $status[$row],
                        "Tipe"=>$tipe[$row],
                        "LuasDahulu"=> $luasdahulu[$row],
                        "LuasBau"=> $luasbau[$row],
                        "LuasMeter"=> $luasmeter[$row],
                        "LuasTumbak"=> $luastumbak[$row],
                        "LuasSekarang"=> $luassekarang[$row],
                        "NadzirWakaf"=> $nadzirwakaf[$row],
                        "GoogleEarth"=> $googleearth[$row],
        
                    ];
                    $response[]=$data;
                }
                foreach($response as $index=>$feature){
                    $NadzirWakaf = $feature['properties']['NadzirWakaf'];
                    $data = $modelNadzir->where('NadzirWakaf', $NadzirWakaf)
                    ->first();
                    if($data)
                    {
                        $response[$index]['properties']['nadzir'] = $data['nama'];
                        $response[$index]['properties']['jabatan'] = $data['jabatan'];
                        $response[$index]['properties']['tupoksi'] = $data['tupoksi'];
                        $response[$index]['properties']['alamat'] = $data['alamat'];
                        $response[$index]['properties']['sk'] = $data['sk'];
                        $response[$index]['properties']['statusNadzir'] = $data['status'];
                        
                    }   
                }
                foreach($tanah as $index=>$value)
                {
                    if($value['polygon'] != NULL){
                        $polygontanah[] = json_decode($value['polygon']);
                        $nomor[] = json_decode($value['No']);
                        $kelurahan[] = $value['Lokasi'];
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
                            "No"=> $nomor[$row],
                            "Lokasi"=> $kelurahan[$row]
                        ];
                    }
                    $response1[]=$data; 
                }
                foreach($response1 as $index=>$feature){
                    $no = $feature['properties']['No'];
                    console_log($no);
                    $data = $modelKecamatan->where('id_kecamatan', $no)
                            ->first();
                    if($data)
                    {
                        $response1[$index]['properties']['luas'] = $data['luas'];
                        $response1[$index]['properties']['jumlahtanahwakaf'] = $data['jumlahtanah'];
                    }
                }
                return view('polygon/index',[
                    'data'=> $features,
                    'data1'=> $response1,
                    'marker'=>$response,
                    'nilaiMax'=>$nilaiMax,
                    'tipeTanah' =>$tipeTanah,
                    'namaTanah' =>$namaTanah,
                    'namaKecamatan'=>$namaKecamatan,
                ]); 
            }

            // Logic untuk menampilkan marker berdasarkan tipe tanah pada peta digital
            $pilihTipe = '';
            if($this->request->getPost('tipe')) // Kondisi ini akan dieksekusi jika user melakukan POST pada dropdown dengan name = 'tipe'
            {
                $pilihTipe = $this->request->getPost('tipe');
                console_log($pilihTipe);
                foreach($tanah as $index=>$value)
                {
                    if($value['marker'] != NULL && $value['Tipe'] == $pilihTipe){ // Assign seluruh row marker yang memenuhi kondisi
                        $markertanah[] = json_decode($value['marker']);  // json_decode disini digunakan untuk mengubah value dari variabel
                        $no[] = json_decode($value['No']);               // menjadi objek
                        $lokasi[] = $value['Lokasi'];
                        $status[] = $value['KoordinatLokasi'];
                        $tipe[] = $value['Tipe'];
                        $luasdahulu[] = json_decode($value['LuasDahulu']);
                        $luasbau[] = json_decode($value['LuasDalamBau']);
                        $luasmeter[] = json_decode($value['LuasDalamMeterPersegi']);
                        $luastumbak[] = json_decode($value['LuasDalamTumbak']);
                        $luassekarang[] = json_decode($value['LuasSekarang']);
                        $nadzirwakaf[] = $value['NadzirWakaf'];
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
                        "No"=> $no[$row],
                        "Lokasi"=> $lokasi[$row],
                        "Status"=> $status[$row],
                        "Tipe"=>$tipe[$row],
                        "LuasDahulu"=> $luasdahulu[$row],
                        "LuasBau"=> $luasbau[$row],
                        "LuasMeter"=> $luasmeter[$row],
                        "LuasTumbak"=> $luastumbak[$row],
                        "LuasSekarang"=> $luassekarang[$row],
                        "NadzirWakaf"=> $nadzirwakaf[$row],
                        "GoogleEarth"=> $googleearth[$row],
        
                    ];
                    $response[]=$data;
                }
                foreach($response as $index=>$feature){
                    $NadzirWakaf = $feature['properties']['NadzirWakaf'];
                    $data = $modelNadzir->where('NadzirWakaf', $NadzirWakaf)
                    ->first();
                    if($data)
                    {
                        $response[$index]['properties']['nadzir'] = $data['nama'];
                        $response[$index]['properties']['jabatan'] = $data['jabatan'];
                        $response[$index]['properties']['tupoksi'] = $data['tupoksi'];
                        $response[$index]['properties']['alamat'] = $data['alamat'];
                        $response[$index]['properties']['sk'] = $data['sk'];
                        $response[$index]['properties']['statusNadzir'] = $data['status'];
                        
                    }
                    
                }
                console_log($response);
                console_log($tipeTanah);
                foreach($tanah as $index=>$value)
    
                {
                    if($value['polygon'] != NULL){
                        $polygontanah[] = json_decode($value['polygon']);
                        $nomor[] = json_decode($value['No']);
                        $kelurahan[] = $value['Lokasi'];
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
                            "No"=> $nomor[$row],
                            "Lokasi"=> $kelurahan[$row]
                        ];
                    }
                    $response1[]=$data;  //  $polygon[] = [$polygontanah[$row][$row]->lat, $polygontanah[$row][$row]->lng];
                }
                foreach($response1 as $index=>$feature){
                    $no = $feature['properties']['No'];
                    console_log($no);
                    $data = $modelKecamatan->where('id_kecamatan', $no)
                            ->first();
                    if($data)
                    {
                        $response1[$index]['properties']['luas'] = $data['luas'];
                        $response1[$index]['properties']['jumlahtanahwakaf'] = $data['jumlahtanah'];
                    }
                }
                return view('polygon/index',[
                    'data'=> $features,
                    'data1'=> $response1,
                    'marker'=>$response,
                    'nilaiMax'=>$nilaiMax,
                    'tipeTanah' =>$tipeTanah,
                    'namaTanah' =>$namaTanah,
                    'namaKecamatan'=>$namaKecamatan,
                ]); 
            } else {
                foreach($tanah as $index=>$value)
                {
                    if($value['marker'] != NULL){ // Assign seluruh row marker yang memenuhi kondisi
                        $markertanah[] = json_decode($value['marker']);  // json_decode disini digunakan untuk mengubah value dari variabel
                        $no[] = json_decode($value['No']);               // menjadi objek
                        $lokasi[] = $value['Lokasi'];
                        $status[] = $value['KoordinatLokasi'];
                        $tipe[] = $value['Tipe'];
                        $luasdahulu[] = json_decode($value['LuasDahulu']);
                        $luasbau[] = json_decode($value['LuasDalamBau']);
                        $luasmeter[] = json_decode($value['LuasDalamMeterPersegi']);
                        $luastumbak[] = json_decode($value['LuasDalamTumbak']);
                        $luassekarang[] = json_decode($value['LuasSekarang']);
                        $nadzirwakaf[] = $value['NadzirWakaf'];
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
                        "No"=> $no[$row],
                        "Lokasi"=> $lokasi[$row],
                        "Status"=> $status[$row],
                        "Tipe"=>$tipe[$row],
                        "LuasDahulu"=> $luasdahulu[$row],
                        "LuasBau"=> $luasbau[$row],
                        "LuasMeter"=> $luasmeter[$row],
                        "LuasTumbak"=> $luastumbak[$row],
                        "LuasSekarang"=> $luassekarang[$row],
                        "NadzirWakaf"=> $nadzirwakaf[$row],
                        "GoogleEarth"=> $googleearth[$row],
        
                    ];
                    $response[]=$data;
                }
                foreach($response as $index=>$feature){
                    $NadzirWakaf = $feature['properties']['NadzirWakaf'];
                    $data = $modelNadzir->where('NadzirWakaf', $NadzirWakaf)
                    ->first();
                    if($data)
                    {
                        $response[$index]['properties']['nadzir'] = $data['nama'];
                        $response[$index]['properties']['jabatan'] = $data['jabatan'];
                        $response[$index]['properties']['tupoksi'] = $data['tupoksi'];
                        $response[$index]['properties']['alamat'] = $data['alamat'];
                        $response[$index]['properties']['sk'] = $data['sk'];
                        $response[$index]['properties']['statusNadzir'] = $data['status'];
                        
                    }
                    
                }
                foreach($tanah as $index=>$value)
    
                {
                    if($value['polygon'] != NULL){
                        $polygontanah[] = json_decode($value['polygon']);
                        $nomor[] = json_decode($value['No']);
                        $kelurahan[] = $value['Lokasi'];
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
                            "No"=> $nomor[$row],
                            "Lokasi"=> $kelurahan[$row]
                        ];
                    }
                    $response1[]=$data;
                }
                foreach($response1 as $index=>$feature){
                    $no = $feature['properties']['No'];
                    console_log($no);
                    $data = $modelKecamatan->where('id_kecamatan', $no)
                            ->first();
                    if($data)
                    {
                        $response1[$index]['properties']['luas'] = $data['luas'];
                        $response1[$index]['properties']['jumlahtanahwakaf'] = $data['jumlahtanah'];
                    }
                }
                return view('polygon/index',[
                    'data'=> $features,
                    'data1'=> $response1,
                    'marker'=>$response,
                    'nilaiMax'=>$nilaiMax,
                    'tipeTanah' =>$tipeTanah,
                    'namaTanah' =>$namaTanah,
                    'namaKecamatan'=>$namaKecamatan,
                ]); 
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

        $model = new TanahModel();
        $tanah = $model->getTanah($id)->getRow();
        $polygontanah = $tanah->polygon;
        $polygontanah = json_decode($polygontanah);
        helper('form');

		$fileName = "http://localhost/tugasakhir/public/maps/polygonsumedang.geojson";
		$file = file_get_contents($fileName);
		$file = json_decode($file);
        // console_log($file);
		$features = $file->features;
        // $features = json_encode($features);
        console_log($features);


		return view('form/edit',[
            'polygontanah'=>$polygontanah,
            'tanah'=>$tanah,
			'data'=> $features,
		]);
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

        $model = new TanahModel();
        $tanah = $model->getTanah($id)->getRow();
        $markertanah = $tanah->marker;
        $markertanah = json_decode($markertanah);
        console_log($markertanah);
        console_log($tanah);
        helper('form');

        $tanahPolygon = $model->getTanah();

        foreach($tanahPolygon as $index=>$value)
        {
            if($value['polygon'] != NULL){
                $polygontanah[] = json_decode($value['polygon']);
                $no[] = json_decode($value['No']);
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
                "No"=> $no[$row],
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

        return view('form/editmarker',[
        'markertanah'=>$markertanah,
        'tanah'=>$tanah,
        'data'=> $features,
        'data1'=> $response1,
        ]);
    }

    public function add_new()
    {
        echo view('add_tanah');
    }

    public function save()
    {
        $model = new TanahModel();
        $data = array(
            'No'  => $this->request->getPost('No'),
            'Lokasi' => $this->request->getPost('Lokasi'),
            'Tipe' => $this->request->getPost('Tipe'),
            'LuasDahulu' => $this->request->getPost('LuasDahulu'),
            'LuasSekarang' => $this->request->getPost('LuasSekarang'),
            'LuasDalamBau' => $this->request->getPost('LuasDalamBau'),
            'LuasDalamTumbak' => $this->request->getPost('LuasDalamTumbak'),
            'LuasDalamMeterPersegi' => $this->request->getPost('LuasDalamMeterPersegi'),
            'NadzirWakaf' => $this->request->getPost('NadzirWakaf'),
            'KoordinatLokasi' => $this->request->getPost('KoordinatLokasi'),
            'polygon' => $this->request->getPost('polygon'),
            'marker' => $this->request->getPost('marker'),
            'id_kecamatan' => $this->request->getPost('id_kecamatan'),
            'googleearth' => $this->request->getPost('googleearth'),
        );  
        $model->saveTanah($data);
        return redirect()->to(base_url("tanah"));
    }

    public function edit($id)
    {
        function console_log($output, $with_script_tags = true) {
            $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
        ');';
            if ($with_script_tags) {
                $js_code = '<script>' . $js_code . '</script>';
            }
            echo $js_code;
        }
        $model = new TanahModel();
        $data['tanah'] = $model->getTanah($id)->getRow();
        console_log($data);
        echo view('edit_tanah', $data);
    }

    public function update()
    {
        function console_log($output, $with_script_tags = true) {
            $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
        ');';
            if ($with_script_tags) {
                $js_code = '<script>' . $js_code . '</script>';
            }
            echo $js_code;
        }

        $model = new TanahModel();
        $id = $this->request->getPost('No');
        $data = array(
            'No'  => $this->request->getPost('No'),
            'Lokasi' => $this->request->getPost('Lokasi'),
            'Tipe' => $this->request->getPost('Tipe'),
            'LuasDahulu' => $this->request->getPost('LuasDahulu'),
            'LuasSekarang' => $this->request->getPost('LuasSekarang'),
            'LuasDalamBau' => $this->request->getPost('LuasDalamBau'),
            'LuasDalamTumbak' => $this->request->getPost('LuasDalamTumbak'),
            'LuasDalamMeterPersegi' => $this->request->getPost('LuasDalamMeterPersegi'),
            'KoordinatLokasi' => $this->request->getPost('KoordinatLokasi'),
            'NadzirWakaf' => $this->request->getPost('NadzirWakaf'),
            'polygon' => $this->request->getPost('polygon'),
            'marker' => $this->request->getPost('marker'),
            'id_kecamatan' => $this->request->getPost('id_kecamatan'),
            'googleearth' => $this->request->getPost('googleearth'),
        );
        console_log($data);
        $model->updateTanah($data, $id);
        return redirect()->to(base_url("tanah"));
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
        $data['tanah']= $model->getKeyword($keyword);
        console_log($data);
        echo view('tanah_view', $data);
    }

    public function delete($id)
    {
        $model = new TanahModel();
        $data['tanah'] = $model->getTanah($id)->getRow();
        $model->deleteTanah($id);
        return redirect()->to(base_url("tanah"));
    }
}
