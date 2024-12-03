<?php

namespace App\Http\Controllers;

use App\Models\Devolucion;
use Illuminate\Http\Request;

class DevolucionController extends Controller
{
    private function successResponse($data, $message = '', $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    private function errorResponse($message, $code = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $code);
    }

    public function index()
    {
        $devoluciones = Devolucion::all();
        return $this->successResponse($devoluciones, 'Listado de devoluciones obtenido con éxito.');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_reserva' => 'required|integer',
            'fecha_devolucion' => 'required|date',
            'estado_devolucion' => 'required|string|max:255',
        ]);

        $devolucion = Devolucion::create($validatedData);

        return $this->successResponse($devolucion, 'Devolución creada con éxito.', 201);
    }

    public function validarUsuario(Request $request)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return $this->errorResponse('Token no proporcionado.', 401);
        }

        if ($token === 'valid_token_example') {
            return $this->successResponse(null, 'Usuario válido.');
        }

        return $this->errorResponse('Token inválido.', 403);
    }

    public function show(string $id)
    {
        $devolucion = Devolucion::find($id);

        if (!$devolucion) {
            return $this->errorResponse('Devolución no encontrada.', 404);
        }

        return $this->successResponse($devolucion, 'Devolución encontrada.');
    }

    public function update(Request $request, string $id)
    {
        $devolucion = Devolucion::find($id);

        if (!$devolucion) {
            return $this->errorResponse('Devolución no encontrada.', 404);
        }

        $validatedData = $request->validate([
            'id_reserva' => 'integer',
            'fecha_devolucion' => 'date',
            'estado_devolucion' => 'string|max:255',
        ]);

        $devolucion->update($validatedData);

        return $this->successResponse($devolucion, 'Devolución actualizada con éxito.');
    }

    public function destroy(string $id)
    {
        $devolucion = Devolucion::find($id);

        if (!$devolucion) {
            return $this->errorResponse('Devolución no encontrada.', 404);
        }

        $devolucion->delete();

        return $this->successResponse(null, 'Devolución eliminada con éxito.');
    }
}