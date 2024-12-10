<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PerfilController extends BaseController
{
    protected $usuarioModel;
    protected $actualizacionModel;
    protected $db;
    protected $session;

    public function __construct()
    {
        $this->usuarioModel = new \App\Models\UsuarioModel();
        $this->actualizacionModel = new \App\Models\ActualizacionModel();
        $this->db = \Config\Database::connect();
        $this->session = session();
    }

    public function index()
    {
        if (!$this->session->has('user_id')) {
            return redirect()->to('/login');
        }

        $userId = $this->session->get('user_id');

        // Obtener información del perfil del usuario Amigo
        $profile = $this->db->table('usuarios')
            ->select('usuarios.*, roles.nombre as rol_nombre')
            ->join('roles', 'roles.id = usuarios.rol_id')
            ->where('usuarios.id', $userId)
            ->get()
            ->getRow();

        if (!$profile) {
            return redirect()->to('/login')
                ->with('error_message', 'Usuario no encontrado');
        }

        // Contar árboles del usuario
        $arboles_propios = $this->db->table('arboles')
            ->where('usuario_id', $userId)
            ->countAllResults();

        // Obtener última actualización
        $ultima_actualizacion = $this->db->table('actualizaciones_arboles as act')
            ->select('act.created_at')
            ->join('arboles as a', 'a.id = act.arbol_id')
            ->where('a.usuario_id', $userId)
            ->orderBy('act.created_at', 'DESC')
            ->limit(1)
            ->get()
            ->getRow();

        $data = [
            'profile' => $profile,
            'stats' => [
                'arboles_propios' => $arboles_propios,
                'ultima_actualizacion' => $ultima_actualizacion ? $ultima_actualizacion->created_at : null
            ]
        ];

        return view('amigo/perfil', $data);
    }

    public function update()
    {
        if (!$this->session->has('user_id')) {
            return redirect()->to('/login');
        }

        $userId = $this->session->get('user_id');

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'apellidos' => $this->request->getPost('apellidos'),
            'email' => $this->request->getPost('email'),
            'telefono' => $this->request->getPost('telefono'),
            'direccion' => $this->request->getPost('direccion'),
            'pais' => $this->request->getPost('pais')
        ];

        if ($this->request->getPost('new_password')) {
            $data['password'] = $this->request->getPost('new_password');
        }

        try {
            if (!$this->usuarioModel->updatePerfil($userId, $data)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error_message', 'Error al actualizar el perfil: ' . implode(', ', $this->usuarioModel->errors()));
            }

            return redirect()->to('/amigo/perfil')
                ->with('success_message', 'Perfil actualizado exitosamente');
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            return redirect()->back()
                ->withInput()
                ->with('error_message', 'Ocurrió un error al actualizar el perfil');
        }
    }
}