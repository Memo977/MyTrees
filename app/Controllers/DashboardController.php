<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $session = session();
        $db = \Config\Database::connect();
        
        // Verificar si el usuario está autorizado
        if (!in_array($session->get('rol_id'), [1, 2])) {
            return redirect()->to('/unauthorized');
        }

        // Estadísticas base (comunes para ambos roles)
        $stats = [
            'amigos' => $db->table('usuarios')->where('rol_id', 3)->countAllResults(),
            'arboles_disponibles' => $db->table('arboles')->where('estado', 'Disponible')->countAllResults()
        ];

        // Agregar estadísticas adicionales para admin
        if ($session->get('rol_id') == 1) {
            $stats['arboles_vendidos'] = $db->table('arboles')->where('estado', 'Vendido')->countAllResults();
        }

        // Usar una única vista compartida
        return view('shared/dashboard', ['stats' => $stats]);
    }
}