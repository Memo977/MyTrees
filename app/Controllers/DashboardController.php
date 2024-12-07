<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    protected function prepareBaseData()
    {
        $rol_id = session()->get('rol_id');
        return [
            'isAdmin' => $rol_id == 1,
            'isAmigo' => $rol_id == 3,
            'baseRoute' => $rol_id == 1 ? 'admin' : ($rol_id == 3 ? 'amigo' : 'operador')
        ];
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $data = $this->prepareBaseData();
        $user_id = session()->get('user_id');

        if ($data['isAmigo']) {
            try {
                // Estadísticas para amigos
                $arboles_propios = $db->table('arboles')
                    ->where('usuario_id', $user_id)
                    ->countAllResults();

                $arboles_disponibles = $db->table('arboles')
                    ->where('estado', 'Disponible')
                    ->countAllResults();

                // Obtener última actualización de los árboles del usuario
                $ultima_actualizacion = $db->table('actualizaciones_arboles')
                    ->select('actualizaciones_arboles.fecha_actualizacion')
                    ->join('arboles', 'arboles.id = actualizaciones_arboles.arbol_id')
                    ->where('arboles.usuario_id', $user_id)
                    ->orderBy('actualizaciones_arboles.fecha_actualizacion', 'DESC')
                    ->limit(1)
                    ->get()
                    ->getRow('fecha_actualizacion');

                $data['stats'] = [
                    'arboles_propios' => $arboles_propios,
                    'arboles_disponibles' => $arboles_disponibles,
                    'ultima_actualizacion' => $ultima_actualizacion
                ];

            } catch (\Exception $e) {
                log_message('error', 'Error al obtener estadísticas: ' . $e->getMessage());
                $data['stats'] = [
                    'arboles_propios' => 0,
                    'arboles_disponibles' => 0,
                    'ultima_actualizacion' => null
                ];
            }
        } else {
            // Estadísticas para admin y operador
            $data['stats'] = [
                'amigos' => $db->table('usuarios')->where('rol_id', 3)->countAllResults(),
                'arboles_disponibles' => $db->table('arboles')->where('estado', 'Disponible')->countAllResults()
            ];

            if ($data['isAdmin']) {
                $data['stats']['arboles_vendidos'] = $db->table('arboles')->where('estado', 'Vendido')->countAllResults();
            }
        }

        return view('shared/dashboard', $data);
    }
}