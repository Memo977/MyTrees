<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // Verificar si el usuario está logueado
        if (!$session->get('isLoggedIn')) {
            return redirect()
                ->to(base_url('login'))
                ->with('error', 'Por favor, inicie sesión para acceder a esta sección.');
        }

        // Verificar los roles si se proporcionan argumentos
        if (!empty($arguments)) {
            $rolId = (int)$session->get('rol_id');
            
            // Convertir los argumentos a enteros para comparación
            $allowedRoles = array_map('intval', $arguments);
            
            if (!in_array($rolId, $allowedRoles, true)) {
                return redirect()
                    ->to(base_url('dashboard'))
                    ->with('error', 'No tiene permisos para acceder a esta sección.');
            }
        }

        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No necesitamos realizar ninguna acción después de la solicitud
        return $response;
    }
}