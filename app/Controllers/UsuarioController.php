<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class UsuarioController extends BaseController
{
    protected $usuarioModel;
    protected $session;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
        $this->session = session();
    }

    public function login()
    {
        if ($this->session->has('user_id')) {
            return $this->redirectBasedOnRole();
        }
        return view('login'); // Cambiado de 'auth/login' a 'login'
    }

    public function authenticate()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        $user = $this->usuarioModel->findByEmail($email);
        
        if ($user && $this->usuarioModel->verifyPassword($password, $user['password'])) {
            $this->session->set([
                'user_id' => $user['id'],
                'rol_id' => $user['rol_id'],
                'nombre' => $user['nombre'],
                'isLoggedIn' => true
            ]);
            
            return $this->redirectBasedOnRole();
        }
        
        return redirect()->to('/login')->with('error', 'Credenciales inválidas');
    }

    public function signup()
    {
        if ($this->session->has('user_id')) {
            return $this->redirectBasedOnRole();
        }
        return view('signup'); // Cambiado de 'auth/signup' a 'signup'
    }

    public function register()
    {
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'apellidos' => $this->request->getPost('apellidos'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'rol_id' => 3,
            'telefono' => $this->request->getPost('telefono'),
            'direccion' => $this->request->getPost('direccion'),
            'pais' => $this->request->getPost('pais')
        ];

        if (!$this->usuarioModel->save($data)) {
            return redirect()->back()->withInput()->with('errors', $this->usuarioModel->errors());
        }

        return redirect()->to('/login')->with('message', 'Registro exitoso. Por favor, inicie sesión.');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }

    protected function redirectBasedOnRole()
    {
        switch ($this->session->get('rol_id')) {
            case 1:
                return redirect()->to('/admin/dashboard');
            case 2:
                return redirect()->to('/operador/dashboard');
            case 3:
                return redirect()->to('/amigo/dashboard');
            default:
                return redirect()->to('/login');
        }
    }
}