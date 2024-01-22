<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Login extends BaseController
{
    public function index()
    {

        $data = [];
        helper(['form']);
        helper('cookie');

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[8]|max_length[255]|validateAdmin[email,password]',
            ];
            $errors = [
                'password' => [
                    'validateAdmin' => 'Email or Password don\'t match'
                ]
            ];
            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new AdminModel();
                $admin = $model->where('email', $this->request->getVar('email'))->first();
                $this->setAdminSession($admin);
                return redirect()->to(base_url("dashboard"));
            }
        }
        return view('login', $data);
    }

    private function setAdminSession($admin)
    {
        $data = [
            'email' => $admin['email'],
            'isLoggedIn' => true
        ];
        session()->set($data);
        return true;
    }
    public function register()
    {
        if(session()->has('isLoggedIn')){
            $data = [];
            helper(['form']);
            if ($this->request->getMethod() == 'post') {
                $rules = [
                    'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[admin.email]',
                    'password' => 'required|min_length[8]|max_length[255]',
                    'password_confirm' => 'matches[password]',
                ];
                if (!$this->validate($rules)) {
                    $data['validation'] = $this->validator;
                } else {
                    $model = new AdminModel();
                    $newData = [
                        'email' => $this->request->getVar('email'),
                        'password' => $this->request->getVar('password'),
                    ];
                    $model->save($newData);
                    $session = session();
                    $session->setFlashdata('success', 'Admin Baru Berhasil Ditambahkan');
                    // return redirect()->to(base_url("dashboard"));
                }
            }
            return view('register', $data);
        } else {
            return redirect()->to(base_url("login"));
        }
    }
    public function logout()
    {
        helper('cookie');
        session()->destroy();
        setcookie('remember', '', time() - 3600);
        // delete_cookie('remember');
        return redirect()->to(base_url("/"));
    }

    //--------------------------------------------------------------------

}
