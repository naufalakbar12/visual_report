<?php

namespace App\Controllers;

use App\Models\UserModel;

class About extends BaseController
{
    public function index()
    {
        $user = new UserModel();
        $autor = $user->where('id', session()->get('id_user'))->first();

        $data = [
            'title' => 'Tentang Kami',
            'autor' => $autor['nama']
        ];
        return view('about/about', $data);
    }
}
