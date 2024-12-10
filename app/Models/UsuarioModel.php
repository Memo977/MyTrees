<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nombre', 'apellidos', 'email', 'password', 'rol_id', 'telefono', 'direccion', 'pais'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Reglas base para validación
    protected $validationRules = [
        'nombre' => 'required|min_length[3]|max_length[50]',
        'apellidos' => 'required|max_length[100]',
        'email' => 'required|valid_email|max_length[100]|is_unique[usuarios.email,id,{id}]',
        'telefono' => 'permit_empty|max_length[20]',
        'direccion' => 'permit_empty',
        'pais' => 'permit_empty|max_length[100]',
    ];

    // Mensajes de validación personalizados
    protected $validationMessages = [
        'nombre' => [
            'required' => 'El nombre es requerido',
            'min_length' => 'El nombre debe tener al menos 3 caracteres',
            'max_length' => 'El nombre no puede exceder los 50 caracteres'
        ],
        'apellidos' => [
            'required' => 'Los apellidos son requeridos',
            'max_length' => 'Los apellidos no pueden exceder los 100 caracteres'
        ],
        'email' => [
            'required' => 'El email es requerido',
            'valid_email' => 'Por favor ingrese un email válido',
            'max_length' => 'El email no puede exceder los 100 caracteres',
            'is_unique' => 'Este email ya está registrado'
        ],
        'telefono' => [
            'max_length' => 'El teléfono no puede exceder los 20 caracteres'
        ],
        'pais' => [
            'max_length' => 'El país no puede exceder los 100 caracteres'
        ]
    ];

    protected $beforeInsert = ['hashPassword', 'setValidationRulesForInsert'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    // Establece reglas adicionales solo para la inserción
    protected function setValidationRulesForInsert(array $data)
    {
        $this->validationRules['password'] = 'required|min_length[6]';
        $this->validationRules['rol_id'] = 'required|integer|in_list[1,2,3]';
        return $data;
    }

    public function findByEmail(string $email)
    {
        return $this->where('email', $email)->first();
    }

    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    public function updateUser($id, $data)
    {
        // Obtener usuario actual
        $currentUser = $this->find($id);

        // Verificar si el email ha cambiado
        if (isset($data['email']) && $data['email'] === $currentUser['email']) {
            // Si el email es el mismo, lo removemos de los datos a actualizar
            unset($data['email']);
            // También removemos la validación del email
            unset($this->validationRules['email']);
        }

        // Determinar si necesitamos validar el password
        if (empty($data['password'])) {
            unset($this->validationRules['password']);
        }

        // Determinar si necesitamos validar el rol_id
        if (!isset($data['rol_id'])) {
            unset($this->validationRules['rol_id']);
        }

        // Hacer los campos no esenciales opcionales para actualizaciones
        $this->validationRules['telefono'] = 'permit_empty|max_length[20]';
        $this->validationRules['direccion'] = 'permit_empty';
        $this->validationRules['pais'] = 'permit_empty|max_length[100]';

        // Intentar actualizar
        return $this->update($id, $data);
    }

    public function updatePerfil($id, $data)
    {
        // Obtener usuario actual
        $currentUser = $this->find($id);

        // Asegurarnos que no se pueda modificar el rol
        if (isset($data['rol_id'])) {
            unset($data['rol_id']);
        }

        // Verificar si el email ha cambiado
        if (isset($data['email']) && $data['email'] === $currentUser['email']) {
            // Si el email es el mismo, lo removemos de los datos a actualizar
            unset($data['email']);
            // También removemos la validación del email
            unset($this->validationRules['email']);
        }

        // Establecer reglas de validación específicas para perfil
        $this->validationRules = [
            'nombre' => 'required|min_length[3]|max_length[50]',
            'apellidos' => 'required|max_length[100]',
            'telefono' => 'permit_empty|max_length[20]',
            'direccion' => 'permit_empty',
            'pais' => 'permit_empty|max_length[100]'
        ];

        // Si hay un nuevo email, agregar su validación
        if (isset($data['email'])) {
            $this->validationRules['email'] = 'required|valid_email|max_length[100]|is_unique[usuarios.email,id,{id}]';
        }

        // Si hay nueva contraseña, agregar su validación
        if (!empty($data['password'])) {
            $this->validationRules['password'] = 'min_length[6]';
        } else {
            unset($data['password']);
        }

        // Intentar actualizar
        return $this->update($id, $data);
    }
}