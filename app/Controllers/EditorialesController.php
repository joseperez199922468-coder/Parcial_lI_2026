<?php

namespace App\Controllers;

use App\Models\EditorialesModel;

class EditorialesController extends BaseController
{
    protected $helpers = ['form', 'url'];

    private const REGLAS_VALIDACION = [
        'nombre'    => 'required|max_length[150]',
        'direccion' => 'required|max_length[255]',
        'telefono'  => 'required|max_length[30]',
        'email'     => 'required|valid_email|max_length[150]',
        'url'       => 'required|valid_url|max_length[255]',
    ];

    public function index(): string
    {
        $editoriales = new EditorialesModel();
        return view('editoriales', [
            'editoriales' => $editoriales->findAll(),
        ]);
    }

    public function nueva(): string
    {
        return view('editorial_form', [
            'titulo'     => 'Agregar editorial',
            'accion'     => site_url('editoriales/crear'),
            'editorial'  => [],
            'esNuevo'    => true,
            'validation' => null,
        ]);
    }

    public function crear()
    {
        $reglas = array_merge(
            ['id' => 'required|is_natural_no_zero|is_unique[editoriales.id]'],
            self::REGLAS_VALIDACION
        );

        if (! $this->validate($reglas)) {
            return view('editorial_form', [
                'titulo'     => 'Agregar editorial',
                'accion'     => site_url('editoriales/crear'),
                'editorial'  => $this->request->getPost(),
                'esNuevo'    => true,
                'validation' => $this->validator,
            ]);
        }

        $editoriales = new EditorialesModel();
        $editoriales->insert(array_merge(
            ['id' => $this->request->getPost('id')],
            $this->datosDelFormulario()
        ));

        return redirect()->to(site_url('editoriales'))->with('success', 'Editorial agregada correctamente.');
    }

    public function editar(int $id): string
    {
        $editorial = $this->buscarEditorial($id);

        return view('editorial_form', [
            'titulo'     => 'Editar editorial',
            'accion'     => site_url('editoriales/actualizar/' . $id),
            'editorial'  => $editorial,
            'esNuevo'    => false,
            'validation' => null,
        ]);
    }

    public function actualizar(int $id)
    {
        $this->buscarEditorial($id);

        if (! $this->validate(self::REGLAS_VALIDACION)) {
            return view('editorial_form', [
                'titulo'     => 'Editar editorial',
                'accion'     => site_url('editoriales/actualizar/' . $id),
                'editorial'  => array_merge($this->buscarEditorial($id), $this->request->getPost()),
                'esNuevo'    => false,
                'validation' => $this->validator,
            ]);
        }

        $editoriales = new EditorialesModel();
        $editoriales->update($id, $this->datosDelFormulario());

        return redirect()->to(site_url('editoriales'))->with('success', 'Editorial actualizada correctamente.');
    }

    public function eliminar(int $id)
    {
        $this->buscarEditorial($id);

        $editoriales = new EditorialesModel();
        $editoriales->delete($id);

        return redirect()->to(site_url('editoriales'))->with('success', 'Editorial eliminada correctamente.');
    }

    private function buscarEditorial(int $id): array
    {
        $editorial = (new EditorialesModel())->find($id);

        if ($editorial === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('No se encontró la editorial solicitada.');
        }

        return $editorial;
    }

    private function datosDelFormulario(): array
    {
        return $this->request->getPost(['nombre', 'direccion', 'telefono', 'email', 'url']);
    }
}
