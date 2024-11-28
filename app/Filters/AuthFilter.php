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
        
        if (!$session->has('isLoggedIn')) {
            return redirect()->to('/login');
        }

        if (!empty($arguments)) {
            $rolId = $session->get('rol_id');
            if (!in_array($rolId, $arguments)) {
                return redirect()->to('/unauthorized');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
       
    }
}