<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EspecieModel;

class EspeciesController extends BaseController
{
    protected $especieModel;
    protected $session;

    public function __construct()
    {
        $this->especieModel = new EspecieModel();
        $this->session = session();
        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Gestión de Especies',
            'especies' => $this->especieModel->findAll()
        ];
        
        return view('admin/especies/index', $data);
    }

    public function create()
    {
        return view('admin/especies/create', ['title' => 'Nueva Especie']);
    }

    public function store()
    {
        if (!$this->validate($this->especieModel->validationRules, $this->especieModel->validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nombre_comercial' => $this->request->getPost('nombre_comercial'),
            'nombre_cientifico' => $this->request->getPost('nombre_cientifico')
        ];

        if ($this->especieModel->insert($data)) {
            return redirect()->to('/admin/especies')->with('success', 'Especie creada exitosamente');
        }

        return redirect()->back()->withInput()->with('error', 'Error al crear la especie');
    }

    public function edit($id = null)
    {
        $especie = $this->especieModel->find($id);
        if (!$especie) {
            return redirect()->to('/admin/especies')->with('error', 'Especie no encontrada');
        }

        $data = [
            'title' => 'Editar Especie',
            'especie' => $especie
        ];

        return view('admin/especies/edit', $data);
    }

    public function update($id = null)
    {
        if (!$this->validate($this->especieModel->validationRules, $this->especieModel->validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nombre_comercial' => $this->request->getPost('nombre_comercial'),
            'nombre_cientifico' => $this->request->getPost('nombre_cientifico')
        ];

        if ($this->especieModel->update($id, $data)) {
            return redirect()->to('/admin/especies')->with('success', 'Especie actualizada exitosamente');
        }

        return redirect()->back()->withInput()->with('error', 'Error al actualizar la especie');
    }

    public function delete($id = null)
    {
        if ($this->especieModel->delete($id)) {
            return redirect()->to('/admin/especies')->with('success', 'Especie eliminada exitosamente');
        }

        return redirect()->to('/admin/especies')->with('error', 'Error al eliminar la especie');
    }
}