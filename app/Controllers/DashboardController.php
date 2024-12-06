<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $session = session();
        $db = \Config\Database::connect();
        
        // Verificar el rol y mostrar el dashboard correspondiente
        if ($session->get('rol_id') == 1) {
            $stats = [
                'amigos' => $db->table('usuarios')->where('rol_id', 3)->countAllResults(),
                'arboles_disponibles' => $db->table('arboles')->where('estado', 'Disponible')->countAllResults(),
                'arboles_vendidos' => $db->table('arboles')->where('estado', 'Vendido')->countAllResults()
            ];
            return view('admin/dashboard', ['stats' => $stats]);
        } 
        elseif ($session->get('rol_id') == 2) {
            // Estadísticas específicas para operador
            $stats = [
                'amigos' => $db->table('usuarios')->where('rol_id', 3)->countAllResults(),
                'arboles_disponibles' => $db->table('arboles')->where('estado', 'Disponible')->countAllResults()
            ];
            return view('operario/dashboard', ['stats' => $stats]);
        }
        
        return redirect()->to('/unauthorized');
    }
}