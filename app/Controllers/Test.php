<?php 
namespace App\Controllers;

use App\Models\TestModel;
use CodeIgniter\Controller;
class Test extends Controller {
    public function index(){
        return view('test_view');
    }
}
?>