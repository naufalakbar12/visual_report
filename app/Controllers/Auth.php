<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $user;
    public function __construct()
    {
        $this->user = new UserModel();
    }
    public function login()
    {   
        if ($this->request->is('post')) {
            $rules = [
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => "{field} ini harus diisi"
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => "{field} ini harus diisi"
                    ]
                ],
            ];
            if (!$this->validate($rules)) {
                return view('auth/login', [
                    'title' => 'Login',
                    "validation" => $this->validator,
                ]);
    
            }else{
                $username = $this->request->getVar('username');
                $password = $this->request->getVar('password');
                $cek = $this->user->where('username', $username)->first();
                
                if ($cek == null){
                    session()->setFlashdata(['type' => 'alert-danger', 'pesan' => 'Akun belum terdaftar']);
                    return redirect()->to(base_url('login'));
                }

                if (!password_verify($password, $cek['password'])){
                    session()->setFlashdata(['type' => 'alert-danger', 'pesan' => 'Password Salah']);
                    return redirect()->to(base_url('login'));
                }

                $data = [
                    'id_user' => $cek['id'],
                    'role_id' => $cek['id_role'],
                    'isLoggedIn' => true,
                ];
                session()->set($data);
                if ($cek['id_role'] == 1) {
                    return redirect()->to(base_url('admin/user'));
                }else{
                    return redirect()->to(base_url('user/about'));
                }             
            }
        }
        $data = [
            'title' => "Login",
            'validation' => \Config\Services::validation()
        ];
        return view('auth/login', $data);
    }
    public function register()
    {
        if ($this->request->is('post')) {
            $rules = [
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|is_unique[table_user.username]',
                    'errors' => [
                        'required' => "{field} ini harus diisi",
                        'is_unique' => "{field} ini sudah terdaftar"
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required|matches[password_repeat]',
                    'errors' => [
                        'required' => "{field} ini harus diisi",
                        'matches' => "{field} ini harus sama"
                    ]
                ],
                'password_repeat' => [
                    'label' => 'Ulangi Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => "{field} ini harus diisi"
                    ]
                ],
                'nama' => [
                    'label' => 'Nama Pengguna',
                    'rules' => 'required',
                    'errors' => [
                        'required' => "{field} ini harus diisi"
                    ]
                ],
            ];
            if (!$this->validate($rules)) {
                return view('auth/register', [
                    'title' => 'Daftar',
                    "validation" => $this->validator,
                ]);
    
            }else{
                $cek = $this->user->save([
                    'nama' => $this->request->getVar('nama'),
                    'username' => $this->request->getVar('username'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'id_role' => 2,
                ]);
                if ($cek) {
                    session()->setFlashdata(['type' => 'alert-success', 'pesan' => 'Akun berhasil dibuat']);
                    return redirect()->to(base_url('login'));
                }else{
                    session()->setFlashdata(['type' => 'alert-danger', 'pesan' => 'Gagal dalam membuat akun']);
                    return redirect()->to(base_url('register'));
                }
            }
        }

        $data = [
            'title' => 'Daftar',
            'validation' => \Config\Services::validation()
        ];
        return view('auth/register', $data);
    }
    public function dashboard()
    {   
        $data = [
            'title' => 'dashboard'
        ];
        return view('auth/dashboard', $data);
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
