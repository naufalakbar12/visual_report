<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    protected $user;
    public function __construct()
    {
        $this->user = new UserModel();
    }

    public function index()
    {
        $autor = $this->user->where('id', session()->get('id_user'))->first();
        $builder = $this->user->builder("table_user");
        $builder->select('*');
        $builder->join('table_role', 'table_role.id = table_user.id_role');
        $user = $builder->get()->getResultArray();

        $data = [
            'title' => 'user',
            'autor' => $autor['nama'],
            'user' => $user,
        ];
        return view('admin/user', $data);
    }
}
