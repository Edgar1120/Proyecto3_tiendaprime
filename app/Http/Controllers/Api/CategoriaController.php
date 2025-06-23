<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Http\Controllers\Controller; 

class CategoriaController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Categoria::all()
        ]);
    }
// ca
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $categoria = Categoria::create($request->only('nombre'));

        return response()->json([
            'success' => true,
            'message' => 'Categoría creada correctamente.',
            'data' => $categoria
        ], 201);
    }

    public function show($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['success' => false, 'message' => 'Categoría no encontrada.'], 404);
        }

        return response()->json(['success' => true, 'data' => $categoria]);
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['success' => false, 'message' => 'Categoría no encontrada.'], 404);
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $categoria->update($request->only('nombre'));

        return response()->json(['success' => true, 'message' => 'Categoría actualizada.', 'data' => $categoria]);
    }

    public function destroy($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['success' => false, 'message' => 'Categoría no encontrada.'], 404);
        }

        $categoria->delete();

        return response()->json(['success' => true, 'message' => 'Categoría eliminada.']);
    }
}