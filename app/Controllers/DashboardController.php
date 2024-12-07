<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    protected function prepareBaseData()
    {
        return [
            'isAdmin' => session()->get('rol_id') == 1,
            'baseRoute' => session()->get('rol_id') == 1 ? 'admin' : 'operador'
        ];
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $data = $this->prepareBaseData();

        $data['stats'] = [
            'amigos' => $db->table('usuarios')->where('rol_id', 3)->countAllResults(),
            'arboles_disponibles' => $db->table('arboles')->where('estado', 'Disponible')->countAllResults()
        ];

        if ($data['isAdmin']) {
            $data['stats']['arboles_vendidos'] = $db->table('arboles')->where('estado', 'Vendido')->countAllResults();
        }

        return view('shared/dashboard', $data);
    }
}