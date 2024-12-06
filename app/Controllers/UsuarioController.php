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
        return view('auth/login');
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
        return view('auth/signup');
    }

    public function register()
    {
        // Si viene de la vista staff, usará el rol_id del formulario
        // Si no, será rol_id = 3 (Amigo)
        $isStaffRegistration = $this->request->getPost('is_staff_registration');
        
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'apellidos' => $this->request->getPost('apellidos'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'rol_id' => $isStaffRegistration ? $this->request->getPost('rol_id') : 3,
            'telefono' => $this->request->getPost('telefono'),
            'direccion' => $this->request->getPost('direccion'),
            'pais' => $this->request->getPost('pais')
        ];

        if (!$this->usuarioModel->save($data)) {
            return redirect()->back()->withInput()->with('errors', $this->usuarioModel->errors());
        }

        // Si es registro de staff, redirigir al listado de staff
        if ($isStaffRegistration) {
            return redirect()->to('/admin/staff')->with('message', 'Usuario staff creado exitosamente');
        }

        // Si es registro normal, redirigir al login
        return redirect()->to('/login')->with('message', 'Registro exitoso. Por favor, inicie sesión.');
    }

    public function staffList()
    {
        if ($this->session->get('rol_id') != 1) {
            return redirect()->to('/dashboard');
        }

        $data = [
            'usuarios' => $this->usuarioModel->where('rol_id !=', 3)->findAll(),
            'current_user_id' => $this->session->get('user_id')
        ];
        
        return view('admin/staff/list', $data);
    }

    public function createStaff()
    {
        if ($this->session->get('rol_id') != 1) {
            return redirect()->to('/dashboard');
        }
        return view('admin/staff/create');
    }
    
    
    public function deleteStaff($id)
    {
        if ($this->session->get('rol_id') != 1 || $id == $this->session->get('user_id')) {
            return redirect()->to('/admin/staff');
        }

        $usuario = $this->usuarioModel->find($id);
        if ($usuario && $usuario['rol_id'] != 3) {
            $this->usuarioModel->delete($id);
        }

        return redirect()->to('/admin/staff')->with('message', 'Usuario eliminado exitosamente');
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