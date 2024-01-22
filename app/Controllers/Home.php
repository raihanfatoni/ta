<?php namespace App\Controllers;
use App\Models\NadzirModel;
class Home extends BaseController
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

		$modelNadzir = new NadzirModel;
		$nadzir = $modelNadzir->getNadzir();
		console_log($nadzir);
		$struktur = ['Struktur Pengurus YNWPS', 'Struktur Nadzir Wakaf Yayasan Pangeran Sumedang'];
		console_log($struktur[0]);
		console_log($struktur[1]);
		helper('form');
		$pilihStruktur = 0;
		if($this->request->getPost('strukturorg')){
			$pilihStruktur = $this->request->getPost('strukturorg');
			console_log($pilihStruktur);
		}
		return view ('main',[
			'nadzir'=>$nadzir,
			'struktur'=>$struktur,
			'pilihStruktur'=>$pilihStruktur,
		]);
	}

	public function Admin()
	{
		return view('tanah_view');
	}

	public function Login()
	{
		return view('login');
	}



	//--------------------------------------------------------------------

}
