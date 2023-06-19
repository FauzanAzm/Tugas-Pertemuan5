<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MenuModel;

class Menu extends Controller
{
    public function index()
    {
        $model = new MenuModel();
        
        $data['menu'] = $model->findAll();
        return view('menu/index', $data);
    }

    public function create()
{
    helper(['form']);
    $model = new MenuModel();

    if ($this->request->getMethod() === 'post' && $this->validate([
        'nama' => 'required',
        'harga' => 'required'
    ])) {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'harga' => $this->request->getPost('harga')
        ];
        $model->insert($data);
        return redirect()->to(base_url('/menu'));
    } else {
        $data['validation'] = $this->validator;
        return view('menu/create', $data);
    }
}



    public function update()
    {
        helper(['form']);

        $model = new MenuModel();
        $id = $this->request->getPost('id');
        $data = [
            'nama' => $this->request->getPost('nama'),
            'harga' => $this->request->getPost('harga'),
        ];
        $model->update($id, $data);
        return redirect()->to(base_url('menu'));
    }

    public function delete($id)
    {
        $model = new MenuModel();
        $model->delete($id);
        return redirect()->to(base_url('menu'));
    }
}
