<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArbolModel;
use App\Models\EspecieModel;
use App\Models\ActualizacionModel;
use App\Models\UsuarioModel;

class ArbolesController extends BaseController
{
    protected $arbolModel;
    protected $especieModel;
    protected $usuarioModel;
    protected $actualizacionModel;
    protected $session;

    public function __construct()
    {
        $this->arbolModel = new ArbolModel();
        $this->especieModel = new EspecieModel();
        $this->usuarioModel = new UsuarioModel();
        $this->actualizacionModel = new ActualizacionModel();
        $this->session = session();
        helper(['form']);
    }

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

        // Obtener los parámetros de la URL
        $from = $this->request->getGet('from');
        $usuario_id = $this->request->getGet('usuario_id');

        // Crea la URL de redirección
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

            // Eliminar foto anterior
            $oldTree = $this->arbolModel->find($id);
            if ($oldTree && !empty($oldTree['foto_url'])) {
                $oldPhotoPath = ROOTPATH . 'public/uploads/arboles/' . $oldTree['foto_url'];
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }
        }

        if ($this->arbolModel->update($id, $data)) {
            // Obtiene la URL de redirección del formulario
            $redirect_to = $this->request->getPost('redirect_to') ?? 'admin/arboles';
            return redirect()->to($redirect_to)->with('success', 'Árbol actualizado exitosamente');
        }

        return redirect()->back()->withInput()->with('error', 'Error al actualizar el árbol');
    }

    public function delete($id = null)
    {
        $tree = $this->arbolModel->find($id);
        if ($tree) {
            // Verificamos si el árbol tiene un usuario asociado
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


    public function misArboles()
    {
        $usuario_id = $this->session->get('user_id');

        $data = [
            'trees' => $this->arbolModel->select('arboles.*, especies.nombre_comercial')
                ->join('especies', 'especies.id = arboles.especie_id')
                ->where('arboles.usuario_id', $usuario_id)
                ->where('arboles.estado', 'Vendido')
                ->findAll()
        ];

        return view('amigo/arboles/index', $data);
    }

    public function detalle($id = null)
    {
        $usuario_id = $this->session->get('user_id');

        $arbol = $this->arbolModel->select('arboles.*, especies.nombre_comercial, especies.nombre_cientifico')
            ->join('especies', 'especies.id = arboles.especie_id')
            ->where('arboles.id', $id)
            ->where('arboles.usuario_id', $usuario_id)
            ->first();

        if (!$arbol) {
            return redirect()->to('amigo/arboles')
                ->with('error', 'Árbol no encontrado o no tienes permiso para verlo');
        }

        $historial = $this->actualizacionModel->where('arbol_id', $id)
            ->orderBy('fecha_actualizacion', 'DESC')
            ->findAll();

        $data = [
            'arbol' => $arbol,
            'historial' => $historial
        ];

        return view('amigo/arboles/detalle', $data);
    }
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

        $defaultPath = ROOTPATH . 'public/assets/img/arbolDefault.jpg';
        $mime = mime_content_type($defaultPath);
        header('Content-Type: ' . $mime);
        header('Content-Length: ' . filesize($defaultPath));
        readfile($defaultPath);
        exit;
    }

    // Método para mostrar árboles disponibles para compra
    public function disponibles()
    {
        $data = [
            'trees' => $this->arbolModel->select('arboles.*, especies.nombre_comercial, especies.nombre_cientifico')
                ->join('especies', 'especies.id = arboles.especie_id')
                ->where('arboles.estado', 'Disponible')
                ->where('arboles.usuario_id IS NULL')
                ->findAll()
        ];

        return view('amigo/arboles/disponibles', $data);
    }

    // Método para mostrar formulario de compra
    public function comprar($id = null)
    {
        $arbol = $this->arbolModel->select('arboles.*, especies.nombre_comercial, especies.nombre_cientifico')
            ->join('especies', 'especies.id = arboles.especie_id')
            ->where('arboles.id', $id)
            ->where('arboles.estado', 'Disponible')
            ->where('arboles.usuario_id IS NULL')
            ->first();

        if (!$arbol) {
            return redirect()->to('amigo/arboles/disponibles')
                ->with('error', 'Árbol no disponible para compra');
        }

        $data = [
            'arbol' => $arbol
        ];

        return view('amigo/arboles/comprar', $data);
    }

    public function confirmarCompra()
    {
        $arbol_id = $this->request->getPost('arbol_id');
        $usuario_id = $this->session->get('user_id');

        $arbol = $this->arbolModel->select('*')
            ->where('id', $arbol_id)
            ->where('estado', 'Disponible')
            ->where('usuario_id IS NULL')
            ->first();

        if (!$arbol) {
            return redirect()->to('amigo/arboles/disponibles')
                ->with('error', 'El árbol ya no está disponible para compra');
        }

        $this->arbolModel->update($arbol_id, [
            'estado' => 'Vendido',
            'usuario_id' => $usuario_id,
            'fecha_venta' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('amigo/arboles')
            ->with('success', 'Árbol comprado exitosamente');
    }
}