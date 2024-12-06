<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HistorialController extends BaseController
{
    protected $actualizacionModel;
    protected $session;
    
    public function __construct()
    {
        $this->actualizacionModel = new \App\Models\ActualizacionModel();
        $this->session = session();
    }

    public function index()
    {
        $data = [
            'actualizaciones' => $this->actualizacionModel->getHistorialGlobal(),
            'user_role' => $this->session->get('rol_id')
        ];
        return view('shared/Historial/index', $data);
    }
}