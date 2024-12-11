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
        // Obtenemos los datos base
        $data = $this->prepareBaseData();
        
        // Agregamos las actualizaciones al array de datos
        $data['actualizaciones'] = $this->actualizacionModel->getHistorialGlobal();
        
        // Pasamos todos los datos a la vista
        return view('shared/historial/index', $data);
    }

    protected function prepareBaseData()
    {
        $rol_id = session()->get('rol_id');
        return [
            'isAdmin' => $rol_id == 1,
            'isAmigo' => $rol_id == 3,
            'baseRoute' => $rol_id == 1 ? 'admin' : ($rol_id == 3 ? 'amigo' : 'operador')
        ];
    }
}