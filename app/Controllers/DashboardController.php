<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        
        $stats = [
            'amigos' => $db->table('usuarios')->where('rol_id', 3)->countAllResults(),
            'arboles_disponibles' => $db->table('arboles')->where('estado', 'Disponible')->countAllResults(),
            'arboles_vendidos' => $db->table('arboles')->where('estado', 'Vendido')->countAllResults()
        ];
        return view('admin/dashboard', ['stats' => $stats]);
    }
}