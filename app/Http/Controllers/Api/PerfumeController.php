<?php

namespace App\Http\Controllers\Api;


use App\Models\Perfume;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

class PerfumeController extends Controller
{
    public function index(Request $request)
    {
        $categoriaId = $request->query('id_categoria');
        $buscar = $request->query('buscar');

        $query = Perfume::with('categoria');

        if ($categoriaId) {
            $query->where('id_categoria', $categoriaId);
        }

        if ($buscar) {
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%$buscar%")
                  ->orWhere('marca', 'like', "%$buscar%");
            });
        }

        $perfumes = $query->paginate(6);

        return response()->json([
            'success' => true,
            'data' => $perfumes
        ]);
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'nombre' => 'required|string|max:255',
        'marca' => 'required|string|max:255',
        'precio' => 'required|numeric',
        'volumen' => 'required|string|max:100',
        'genero' => 'required|string|max:50',
        'imagen' => 'nullable|string',
        'id_categoria' => 'required|exists:categorias,id',
        'envio_gratis' => 'required|boolean',
        'etiquetas' => 'nullable|string',
        'rating' => 'nullable|numeric|min:0|max:5',
    ]);

    $perfume = Perfume::create($data); // ✅ Esta línea ahora funcionará correctamente

    return response()->json($perfume, 201);
}



    public function show($id)
    {
        $perfume = Perfume::with('categoria')->find($id);

        if (!$perfume) {
            return response()->json(['success' => false, 'message' => 'Perfume no encontrado.'], 404);
        }

        return response()->json(['success' => true, 'data' => $perfume]);
    }

    public function update(Request $request, $id)
    {
        $perfume = Perfume::find($id);

        if (!$perfume) {
            return response()->json(['success' => false, 'message' => 'Perfume no encontrado.'], 404);
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'genero' => 'required|string|max:20',
            'volumen' => 'required|string|max:20',
            'id_categoria' => 'required|exists:categorias,id',
            'imagen' => 'nullable|url',
            'rating' => 'nullable|numeric|min:1|max:5',
            'envio_gratis' => 'nullable|boolean',
            'etiquetas' => 'nullable|string',
        ]);

        $validated['envio_gratis'] = $request->has('envio_gratis');

        $perfume->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Perfume actualizado correctamente.',
            'data' => $perfume
        ]);
    }

    public function destroy($id)
    {
        $perfume = Perfume::find($id);

        if (!$perfume) {
            return response()->json(['success' => false, 'message' => 'Perfume no encontrado.'], 404);
        }

        $perfume->delete();

        return response()->json(['success' => true, 'message' => 'Perfume eliminado.']);
    }
}