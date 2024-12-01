<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class HistorialController extends BaseController
{
    protected $actualizacionModel;
    
    public function __construct()
    {
        $this->actualizacionModel = new \App\Models\ActualizacionModel();
    }

    public function index()
    {
        $data['actualizaciones'] = $this->actualizacionModel->getHistorialGlobal();
        return view('admin/historial/index', $data);
    }
}