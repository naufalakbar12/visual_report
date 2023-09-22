<?php

namespace App\Controllers;

use App\Models\DatasetModel;
use App\Models\UserModel;
use App\Models\VisualModel;

class Visual extends BaseController
{
    protected $user,$visual,$dataset;
    public function __construct()
    {
        $this->user = new UserModel();
        $this->visual = new VisualModel();
        $this->dataset = new DatasetModel();
    }

    public function index()
    {
        $autor = $this->user->where('id', session()->get('id_user'))->first();

        $builder = $this->visual->builder("table_visual");
        $builder->select('table_visual.*, nama_dataset, nama_keterangan, nama, table_keterangan.id as id_keterangan');
        $builder->join('table_dataset', 'table_dataset.id = table_visual.id_dataset');
        $builder->join('table_keterangan', 'table_keterangan.id = table_dataset.id_keterangan');
        $builder->join('table_user', 'table_user.id = table_visual.id_user', 'left');
        if (session()->get('id_user') == 2) {
            $builder->where('table_dataset.id_user', session()->get('id_user'));
        }
        $visual = $builder->get()->getResultArray();

        $data = [
            'title' => 'Visualisasi Dataset',
            'autor' => $autor['nama'],
            'visual' => $visual
        ];
        return view('visual/visual', $data);
    }

    public function upload($id = null)
    {
        $autor = $this->user->where('id', session()->get('id_user'))->first();

        $builder = $this->visual->builder("table_visual");
        $builder->select('*');
        $builder->join('table_dataset', 'table_dataset.id = table_visual.id_dataset');
        $builder->where('table_visual.id', $id);
        $visual = $builder->get()->getResultObject();

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
                'link_visual' => [
                    'rules' => 'uploaded[file_visual]|max_size[file_visual,2048]',
                    'label' => 'Link Visual Tablue',
                    'errors' => [
                        'uploaded' => "Upload {field} terlebih dahulu",
                        'max_size' => "Ukuran {field} terlalu besar",
                    ]
                ],
                'file_visual' => [
                    'label' => 'Data Visualisasi',
                    'rules' => 'uploaded[file_visual]|max_size[file_visual,2048]',
                    'errors' => [
                        'uploaded' => "Upload {field} terlebih dahulu",
                        'max_size' => "Ukuran {field} terlalu besar",
                    ]
                ],
            ];

            $builder = $this->visual->builder("table_visual");
            $builder->select('*');
            $builder->join('table_dataset', 'table_dataset.id = table_visual.id_dataset');
            $builder->where('table_visual.id', $this->request->getVar('id_visual'));
            $visual = $builder->get()->getResultObject();

            if (!$this->validate($rules)) {
                return view('visual/visual_upload', [
                    'title' => 'Visualisasi Dataset',
                    'autor' => $autor['nama'],
                    'visual' =>  $visual,
                    'visual_id' => $this->request->getVar('id_visual'),
                    "validation" => $this->validator,
                ]);
    
            }else{
                $nama = $this->request->getVar('nama_dataset');
                $deskripsi = $this->request->getVar('deskripsi');
                $link = $this->request->getVar('link_visual');

                $fileBukti = $this->request->getFile('file_visual');
                $namaBukti = trim(str_replace(' ','_',$nama)).'_'.$fileBukti->getRandomName();
                $fileBukti->move('datavisual', $namaBukti);

                $cek = $this->visual->update($this->request->getVar('id_visual'), [
                    'nama_file' => $namaBukti,
                    'link_visual' => $link,
                    'id_user' => session()->get('id_user')
                ]);
                
                $cekdataset = $this->dataset->update($visual[0]->id_dataset, [
                    'deskripsi', $deskripsi,
                    'id_keterangan' => 3
                ]);
                
                if ($cek && $cekdataset){
                    session()->setFlashdata(['type' => 'alert-success', 'pesan' => 'Data visual berhasil diupload']);
                    return redirect()->to(base_url('admin/visual'));
                }else{
                    session()->setFlashdata(['type' => 'alert-danger', 'pesan' => 'Data Dataset gagal diupload']);
                    return redirect()->to(base_url('admin/visual'));
                }     
            }
        }

        $data = [
            'title' => 'Visualisasi Dataset',
            'autor' => $autor['nama'],
            'visual' =>  $visual,
            'visual_id' => $id,
            'validation' => \Config\Services::validation()
        ];
        return view('visual/visual_upload', $data);
    }

    public function download($id = null)
    {
        $data = $this->visual->find($id);
        return $this->response->download('datavisual/'.$data['nama_file'], null);
    }

    public function view($id = null)
    {   
        $view = \Config\Services::request()->uri->getSegment(5);
        $data = $this->visual->find($id);
        if ($view == "pdf") {
            return view('visual/visual_view', ['file' => $data['nama_file']]);
        }else{
            return view('visual/visual_tablue', ['file' => $data['link_visual']]);
        }
    }

    public function edit($id = null)
    {
        $autor = $this->user->where('id', session()->get('id_user'))->first();

        $builder = $this->visual->builder("table_visual");
        $builder->select('*');
        $builder->join('table_dataset', 'table_dataset.id = table_visual.id_dataset');
        $builder->where('table_visual.id', $id);
        $visual = $builder->get()->getResultObject();

        $data = [
            'title' => 'Visualisasi Dataset',
            'autor' => $autor['nama'],
            'visual' =>  $visual,
            'visual_id' => $id,
            'validation' => \Config\Services::validation()
        ];
        return view('visual/visual_edit', $data);
    }

    public function update()
    {
        $autor = $this->user->where('id', session()->get('id_user'))->first();

        $builder = $this->visual->builder("table_visual");
        $builder->select('*');
        $builder->join('table_dataset', 'table_dataset.id = table_visual.id_dataset');
        $builder->where('table_visual.id', $this->request->getVar('id_visual'));
        $visual = $builder->get()->getResultObject();

        if ($this->request->getFile('file_visual')->getName() == "") {
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
                'link_visual' => [
                    'rules' => 'uploaded[file_visual]|max_size[file_visual,2048]',
                    'label' => 'Link Visual Tablue',
                    'errors' => [
                        'uploaded' => "Upload {field} terlebih dahulu",
                        'max_size' => "Ukuran {field} terlalu besar",
                    ]
                ]
            ];
            if (!$this->validate($rules)) {
                return view('visual/visual_edit', [
                    'title' => 'Visualisasi Dataset',
                    'autor' => $autor['nama'],
                    'visual' =>  $visual,
                    'visual_id' => $this->request->getVar('id_visual'),
                    "validation" => $this->validator,
                ]);
    
            }else{
                $link = $this->request->getVar('link_visual');

                $cek = $this->visual->update($this->request->getVar('id_visual'), [
                    'link_visual' => $link,
                    'id_user' => session()->get('id_user')
                ]);

                if ($cek){
                    session()->setFlashdata(['type' => 'alert-success', 'pesan' => 'Data visual berhasil diedit']);
                    return redirect()->to(base_url('admin/visual'));
                }else{
                    session()->setFlashdata(['type' => 'alert-danger', 'pesan' => 'Data Dataset gagal diedit']);
                    return redirect()->to(base_url('admin/visual'));
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
                'link_visual' => [
                    'rules' => 'uploaded[file_visual]|max_size[file_visual,2048]',
                    'label' => 'Link Visual Tablue',
                    'errors' => [
                        'uploaded' => "Upload {field} terlebih dahulu",
                        'max_size' => "Ukuran {field} terlalu besar",
                    ]
                ],
                'file_visual' => [
                    'label' => 'Data Visualisasi',
                    'rules' => 'uploaded[file_visual]|max_size[file_visual,2048]',
                    'errors' => [
                        'uploaded' => "Upload {field} terlebih dahulu",
                        'max_size' => "Ukuran {field} terlalu besar",
                    ]
                ],
            ];
            if (!$this->validate($rules)) {
                return view('visual/visual_edit', [
                    'title' => 'Visualisasi Dataset',
                    'autor' => $autor['nama'],
                    'visual' =>  $visual,
                    'visual_id' => $this->request->getVar('id_visual'),
                    "validation" => $this->validator,
                ]);
    
            }else{
                $link = $this->request->getVar('link_visual');
                $nama = $this->request->getVar('nama_dataset');
                $file = $this->request->getVar('file_visual_lama');

                $fileBukti = $this->request->getFile('file_visual');
                $namaBukti = trim(str_replace(' ','_',$nama)).'_'.$fileBukti->getRandomName();
                $fileBukti->move('datavisual', $namaBukti);
                array_map('unlink',glob(FCPATH.'dataset/'.$file));

                $cek = $this->visual->update($this->request->getVar('id_visual'), [
                    'link_visual' => $link,
                    'nama_file' => $namaBukti,
                    'id_user' => session()->get('id_user')
                ]);

                if ($cek){
                    session()->setFlashdata(['type' => 'alert-success', 'pesan' => 'Data visual berhasil diedit']);
                    return redirect()->to(base_url('admin/visual'));
                }else{
                    session()->setFlashdata(['type' => 'alert-danger', 'pesan' => 'Data Dataset gagal diedit']);
                    return redirect()->to(base_url('admin/visual'));
                }  
            }
        }
    }

    public function hapus($id = null)
    {
        $cek = $this->visual->update($id, [
            'nama_file' => '',
            'link_visual' => '',
            'id_user' => 0
        ]);

        if ($cek){
            session()->setFlashdata(['type' => 'alert-success', 'pesan' => 'Data visual berhasil dihapus']);
            return redirect()->to(base_url('admin/visual'));
        }else{
            session()->setFlashdata(['type' => 'alert-danger', 'pesan' => 'Data Dataset gagal dihapus']);
            return redirect()->to(base_url('admin/visual'));
        }  
    }
}

