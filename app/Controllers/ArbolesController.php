<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArbolModel;
use App\Models\EspecieModel;
use App\Models\UsuarioModel;

class ArbolesController extends BaseController
{
    protected $arbolModel;
    protected $especieModel;
    protected $usuarioModel;
    protected $session;

    public function __construct()
    {
        $this->arbolModel = new ArbolModel();
        $this->especieModel = new EspecieModel();
        $this->usuarioModel = new UsuarioModel();
        $this->session = session();
        helper(['form']);
    }

    // Métodos para Admin
    public function index()
    {
        $data = [
            'trees' => $this->arbolModel->getAllTrees(),
            'species' => $this->especieModel->findAll()
        ];
        return view('admin/arboles/index', $data);
    }

    public function create()
    {
        $data = [
            'species' => $this->especieModel->findAll()
        ];
        return view('admin/arboles/create', $data);
    }

    public function store()
    {
        $rules = $this->arbolModel->validationRules;
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $foto_url = null;
        $photo = $this->request->getFile('photo');
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $newName = $photo->getRandomName();
            $photo->move(ROOTPATH . 'public/uploads/arboles', $newName);
            $foto_url = $newName;
        }

        $data = [
            'especie_id' => $this->request->getPost('especie_id'),
            'ubicacion_geografica' => $this->request->getPost('ubicacion_geografica'),
            'estado' => $this->request->getPost('estado'),
            'precio' => $this->request->getPost('precio'),
            'tamanio' => 0,
            'foto_url' => $foto_url
        ];

        if ($this->arbolModel->insert($data)) {
            return redirect()->to('admin/arboles')->with('success', 'Árbol creado exitosamente');
        }

        return redirect()->back()->withInput()->with('error', 'Error al crear el árbol');
    }

    public function edit($id = null)
    {
        $tree = $this->arbolModel->getTree($id);
        if (!$tree) {
            return redirect()->to('admin/arboles')->with('error', 'Árbol no encontrado');
        }

        $from = $this->request->getGet('from');
        $usuario_id = $this->request->getGet('usuario_id');

        $redirect_to = 'admin/arboles';
        if ($from === 'amigos' && $usuario_id) {
            $redirect_to = "admin/amigos/arboles/{$usuario_id}";
        }

        $data = [
            'tree' => $tree,
            'species' => $this->especieModel->findAll(),
            'redirect_to' => $redirect_to
        ];

        return view('admin/arboles/edit', $data);
    }

    public function update($id = null)
    {
        $rules = $this->arbolModel->validationRules;
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'especie_id' => $this->request->getPost('especie_id'),
            'ubicacion_geografica' => $this->request->getPost('ubicacion_geografica'),
            'estado' => $this->request->getPost('estado'),
            'precio' => $this->request->getPost('precio')
        ];

        $photo = $this->request->getFile('photo');
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $newName = $photo->getRandomName();
            $photo->move(ROOTPATH . 'public/uploads/arboles', $newName);
            $data['foto_url'] = $newName;

            $oldTree = $this->arbolModel->find($id);
            if ($oldTree && !empty($oldTree['foto_url'])) {
                $oldPhotoPath = ROOTPATH . 'public/uploads/arboles/' . $oldTree['foto_url'];
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }
        }

        if ($this->arbolModel->update($id, $data)) {
            $redirect_to = $this->request->getPost('redirect_to') ?? 'admin/arboles';
            return redirect()->to($redirect_to)->with('success', 'Árbol actualizado exitosamente');
        }

        return redirect()->back()->withInput()->with('error', 'Error al actualizar el árbol');
    }

    public function delete($id = null)
    {
        $tree = $this->arbolModel->find($id);
        if ($tree) {
            $usuario = $this->usuarioModel->where('id', $tree['usuario_id'])->first();
            if ($usuario) {
                return redirect()->to('admin/arboles')->with('error', 'No se puede eliminar el árbol porque tiene un usuario asociado.');
            }

            if (!empty($tree['foto_url'])) {
                $photoPath = ROOTPATH . 'public/uploads/arboles/' . $tree['foto_url'];
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
            }

            if ($this->arbolModel->delete($id)) {
                return redirect()->to('admin/arboles')->with('success', 'Árbol eliminado exitosamente');
            }
        }

        return redirect()->to('admin/arboles')->with('error', 'Error al eliminar el árbol');
    }

    // Métodos para Amigo
    public function misArboles()
    {
        $usuario_id = $this->session->get('user_id');
        
        $data = [
            'trees' => $this->arbolModel->getTreesByUser($usuario_id),
            'species' => $this->especieModel->findAll()
        ];
        
        return view('amigo/arboles/index', $data);
    }

    public function disponibles()
    {
        $data = [
            'trees' => $this->arbolModel->where('estado', 'Disponible')
                                      ->where('usuario_id IS NULL')
                                      ->findAll(),
            'species' => $this->especieModel->findAll()
        ];
        
        return view('amigo/arboles/disponibles', $data);
    }

    public function detalle($id)
    {
        $usuario_id = $this->session->get('user_id');
        $tree = $this->arbolModel->getTree($id);
        
        if (!$tree) {
            return redirect()->back()->with('error', 'Árbol no encontrado');
        }

        // Verificar que el árbol pertenezca al usuario o esté disponible
        if ($tree['usuario_id'] != $usuario_id && $tree['estado'] != 'Disponible') {
            return redirect()->back()->with('error', 'No tiene acceso a este árbol');
        }

        $data = [
            'tree' => $tree,
            'species' => $this->especieModel->findAll(),
            'historial' => $this->arbolModel->getTreeHistory($id)
        ];

        return view('amigo/arboles/detalle', $data);
    }

    public function comprar($id)
    {
        $tree = $this->arbolModel->find($id);
        
        if (!$tree || $tree['estado'] !== 'Disponible' || !empty($tree['usuario_id'])) {
            return redirect()->back()->with('error', 'Este árbol no está disponible para compra');
        }

        $data = [
            'tree' => $tree,
            'especie' => $this->especieModel->find($tree['especie_id'])
        ];

        return view('amigo/arboles/comprar', $data);
    }

    public function confirmarCompra()
    {
        $arbol_id = $this->request->getPost('arbol_id');
        $usuario_id = $this->session->get('user_id');

        $tree = $this->arbolModel->find($arbol_id);
        
        if (!$tree || $tree['estado'] !== 'Disponible' || !empty($tree['usuario_id'])) {
            return redirect()->back()->with('error', 'Este árbol no está disponible para compra');
        }

        $data = [
            'estado' => 'Vendido',
            'usuario_id' => $usuario_id,
            'fecha_venta' => date('Y-m-d H:i:s')
        ];

        if ($this->arbolModel->update($arbol_id, $data)) {
            // Registrar la compra en el historial
            $this->arbolModel->registrarHistorial($arbol_id, 'Compra', 'Árbol adquirido por el usuario');
            return redirect()->to('amigo/arboles')->with('success', 'Árbol comprado exitosamente');
        }

        return redirect()->back()->with('error', 'Error al procesar la compra');
    }

    // Método compartido para obtener imágenes de árboles
    public function getImage($filename)
    {
        if (!empty($filename)) {
            $path = ROOTPATH . 'public/uploads/arboles/' . $filename;
            if (file_exists($path)) {
                $mime = mime_content_type($path);
                header('Content-Type: ' . $mime);
                header('Content-Length: ' . filesize($path));
                readfile($path);
                exit;
            }
        }
        
        // Imagen por defecto si no se encuentra la solicitada
        $defaultPath = ROOTPATH . 'public/assets/img/tree-default.jpg';
        $mime = mime_content_type($defaultPath);
        header('Content-Type: ' . $mime);
        header('Content-Length: ' . filesize($defaultPath));
        readfile($defaultPath);
        exit;
    }
}