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
        
        if (!$session->get('isLoggedIn')) {
            return redirect()
                ->to(base_url('login'))
                ->with('error', 'Por favor, inicie sesión para acceder a esta sección.');
        }
    
        $currentPath = $request->getUri()->getPath();
        $rolId = (int)$session->get('rol_id');
    
        // Bloquear acceso cruzado de rutas admin/operador
        if (strpos($currentPath, 'operador/') === 0 && $rolId === 1) {
            return redirect()->to(base_url('shared/unauthorized/index'));
        }
        
        if (strpos($currentPath, 'admin/') === 0 && $rolId === 2) {
            return redirect()->to(base_url('shared/unauthorized/index'));
        }
    
        if (!empty($arguments)) {
            $allowedRoles = array_map('intval', $arguments);
            if (!in_array($rolId, $allowedRoles, true)) {
                return redirect()->to(base_url('shared/unauthorized/index'));
            }
        }
    
        return $request;
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return $response;
    }
}