<?php

namespace App\Controllers;

use App\Models\DatasetModel;
use App\Models\UserModel;
use App\Models\VisualModel;

class Dataset extends BaseController
{
    protected $user, $dataset, $visual;
    public function __construct()
    {
        $this->user = new UserModel();
        $this->dataset = new DatasetModel();
        $this->visual = new VisualModel();
    }

    public function index()
    {
        $autor = $this->user->where('id', session()->get('id_user'))->first();

        $b = $this->dataset->builder("table_dataset");
        $b->select('table_dataset.*, nama, nama_keterangan');
        $b->join('table_keterangan', 'table_keterangan.id = table_dataset.id_keterangan', 'inner');
        $b->join('table_user', 'table_user.id = table_dataset.id_user', 'inner');
        if (session()->get('id_user') == 2) {
            $b->where('table_user.id', session()->get('id_user'));
        }
        $dataset = $b->get()->getResultArray();
        
        $data = [
            'title' => 'Dataset',
            'autor' => $autor['nama'],
            'dataset' => $dataset
        ];
        return view('dataset/dataset', $data);
    }

    public function store()
    {
        $autor = $this->user->where('id', session()->get('id_user'))->first();

        if ($this->request->is('post')) {
            $rules = [
                'nama_dataset' => [
                    'rules' => 'required',
                    'label' => 'Nama Dataset',
                    'errors' => [
                        'required' => "{field} ini harus diisi"
                    ]
                ],
                'deskripsi' => [
                    'rules' => 'required',
                    'label' => 'Deskripsi',
                    'errors' => [
                        'required' => "{field} ini harus diisi"
                    ]
                ],
                'file_dataset' => [
                    'label' => 'File Dataset',
                    'rules' => 'uploaded[file_dataset]|max_size[file_dataset,100000]',
                    'errors' => [
                        'uploaded' => "Upload {field} terlebih dahulu",
                        'max_size' => "Ukuran {field} terlalu besar",
                    ]
                ],
            ];
            if (!$this->validate($rules)) {
                return view('dataset/dataset_store', [
                    'title' => 'Dataset',
                    'autor' => $autor['nama'],
                    "validation" => $this->validator,
                ]);
    
            }else{

                $nama =$this->request->getVar('nama_dataset');
                $deskripsi = $this->request->getVar('deskripsi');

                $fileBukti = $this->request->getFile('file_dataset');
                $namaBukti = trim(str_replace(' ','_',$nama)).'_'.$fileBukti->getRandomName();
                $fileBukti->move('dataset', $namaBukti);

                $data = [
                    'nama_dataset' => $nama,
                    'nama_file' => $namaBukti,
                    'deskripsi' => $deskripsi,
                    'id_keterangan' => 1,
                    'id_user' => session()->get('id_user'),
                ];

                
                $cek = $this->dataset->insert($data, false);
                
                $cekvisual = $this->visual->insert([
                    'id_dataset' => $this->dataset->getInsertID(),
                ], false);
                
                if ($cek && $cekvisual){
                    session()->setFlashdata(['type' => 'alert-success', 'pesan' => 'Data Dataset berhasil ditambah']);
                    return redirect()->to(base_url('user/dataset'));
                }else{
                    session()->setFlashdata(['type' => 'alert-danger', 'pesan' => 'Data Dataset gagal ditambah']);
                    return redirect()->to(base_url('user/dataset'));
                }     
            }
        }

        $data = [
            'title' => 'Dataset',
            'autor' => $autor['nama'],
            'validation' => \Config\Services::validation()
        ];
        return view('dataset/dataset_store', $data);
    }

    public function detail($id = null)
    {
        $autor = $this->user->where('id', session()->get('id_user'))->first();

        $builder = $this->dataset->builder("table_dataset");
        $builder->select('*');
        $builder->join('table_keterangan', 'table_keterangan.id = table_dataset.id_keterangan');
        $builder->join('table_user', 'table_user.id = table_dataset.id_user');
        $builder->where('table_dataset.id', $id);
        $dataset = $builder->get()->getResult();


        $data = [
            'title' => 'Dataset',
            'autor' => $autor['nama'],
            'dataset' => $dataset,
            'downlaod' => $id
        ];
        return view('dataset/dataset_detail', $data);
    }

    public function download($id = null)
    {
        $data = $this->dataset->find($id);
        if (($data['id_keterangan'] == 1) && (session()->get('role_id') == 1)) {
            $this->dataset->update($id, ['id_keterangan'=>2]);
        }
        return $this->response->download('dataset/'.$data['nama_file'], null);
    }

    public function edit($id = null)
    {
        $autor = $this->user->where('id', session()->get('id_user'))->first();

        $builder = $this->dataset->builder("table_dataset");
        $builder->select('*');
        $builder->join('table_keterangan', 'table_keterangan.id = table_dataset.id_keterangan');
        $builder->join('table_user', 'table_user.id = table_dataset.id_user');
        $builder->where('table_dataset.id', $id);
        $dataset = $builder->get()->getResult();
        
        $data = [
            'title' => 'Dataset',
            'autor' => $autor['nama'],
            'dataset' => $dataset,
            'id' =>$id, 
            'validation' => \Config\Services::validation()
        ];
        return view('dataset/dataset_edit', $data);
    }

    public function update()
    {
        $autor = $this->user->where('id', session()->get('id_user'))->first();

        $builder = $this->dataset->builder("table_dataset");
        $builder->select('*');
        $builder->join('table_keterangan', 'table_keterangan.id = table_dataset.id_keterangan');
        $builder->join('table_user', 'table_user.id = table_dataset.id_user');
        $builder->where('table_dataset.id', $this->request->getVar('id'));
        $dataset = $builder->get()->getResult();

        if ($this->request->getFile('file_dataset')->getName() == "") {
            $rules = [
                'nama_dataset' => [
                    'rules' => 'required',
                    'label' => 'Nama Dataset',
                    'errors' => [
                        'required' => "{field} ini harus diisi"
                    ]
                ],
                'deskripsi' => [
                    'rules' => 'required',
                    'label' => 'Deskripsi',
                    'errors' => [
                        'required' => "{field} ini harus diisi"
                    ]
                ]
            ];
            if (!$this->validate($rules)) {
                return view('dataset/dataset_edit', [
                    'title' => 'Dataset',
                    'dataset' => $dataset,
                    'id' => $this->request->getVar('id'), 
                    'autor' => $autor['nama'],
                    "validation" => $this->validator,
                ]);
    
            }else{
                $nama =$this->request->getVar('nama_dataset');
                $deskripsi = $this->request->getVar('deskripsi');
                $id = $this->request->getVar('id');
    
                $data = [
                    'nama_dataset' => $nama,
                    'deskripsi'    =>  $deskripsi,
                ];
                
                $cek = $this->dataset->update($id, $data);
                if ($cek){
                    session()->setFlashdata(['type' => 'alert-success', 'pesan' => 'Data Dataset berhasil dirubah']);
                    return redirect()->to(base_url('user/dataset'));
                }else{
                    session()->setFlashdata(['type' => 'alert-danger', 'pesan' => 'Data Dataset gagal dirubah']);
                    return redirect()->to(base_url('user/dataset'));
                }  
            }
        }else{
            $rules = [
                'nama_dataset' => [
                    'rules' => 'required',
                    'label' => 'Nama Dataset',
                    'errors' => [
                        'required' => "{field} ini harus diisi"
                    ]
                ],
                'deskripsi' => [
                    'rules' => 'required',
                    'label' => 'Deskripsi',
                    'errors' => [
                        'required' => "{field} ini harus diisi"
                    ]
                ],
                'file_dataset' => [
                    'label' => 'File Dataset',
                    'rules' => 'uploaded[file_dataset]|max_size[file_dataset,2048]',
                    'errors' => [
                        'uploaded' => "Upload {field} terlebih dahulu",
                        'max_size' => "Ukuran {field} terlalu besar",
                    ]
                ],
            ];
            if (!$this->validate($rules)) {
                return view('dataset/dataset_edit', [
                    'title' => 'Dataset',
                    'dataset' => $dataset,
                    'id' => $this->request->getVar('id'), 
                    'autor' => $autor['nama'],
                    "validation" => $this->validator,
                ]);
    
            }else{
    
                $nama =$this->request->getVar('nama_dataset');
                $deskripsi = $this->request->getVar('deskripsi');
                $id = $this->request->getVar('id');
                $file = $this->request->getVar('file_dataset_lama');
    
                $fileBukti = $this->request->getFile('file_dataset');
                $namaBukti = trim(str_replace(' ','_',$nama)).'_'.$fileBukti->getRandomName();
                $fileBukti->move('dataset', $namaBukti);
                array_map('unlink',glob(FCPATH.'dataset/'.$file));
                
                $data = [
                    'nama_dataset' => $nama,
                    'nama_file' => $namaBukti,
                    'deskripsi' => $deskripsi,
                    'id_keterangan' => 1
                ];
    
                
                $cek = $this->dataset->update($id, $data);

                if ($cek){
                    session()->setFlashdata(['type' => 'alert-success', 'pesan' => 'Data Dataset berhasil dirubah']);
                    return redirect()->to(base_url('user/dataset'));
                }else{
                    session()->setFlashdata(['type' => 'alert-danger', 'pesan' => 'Data Dataset gagal dirubah']);
                    return redirect()->to(base_url('user/dataset'));
                }     
            }
        }

    }

    public function hapus($id = null)
    {
        $data = $this->visual->find($id);
        $cek_visual = $this->visual->delete($data['id']);
        $cek = $this->dataset->delete($id);
        if ($cek && $cek_visual){
            session()->setFlashdata(['type' => 'alert-success', 'pesan' => 'Data Dataset berhasil dihapus']);
            return redirect()->to(base_url('user/dataset'));
        }else{
            session()->setFlashdata(['type' => 'alert-danger', 'pesan' => 'Data Dataset gagal dihapus']);
            return redirect()->to(base_url('user/dataset'));
        } 
    }

}
