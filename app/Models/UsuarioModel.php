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
    protected $validationRules = [
        'nombre' => 'required|min_length[3]|max_length[50]',
        'apellidos' => 'required|max_length[100]',
        'email' => 'required|valid_email|is_unique[usuarios.email,id,{id}]',
        'password' => 'required|min_length[6]',
        'rol_id' => 'required|integer|in_list[1,2,3]',
        'telefono' => 'required|max_length[20]',
        'direccion' => 'required',
        'pais' => 'required|max_length[100]',
    ];

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
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
}