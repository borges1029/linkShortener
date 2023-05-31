<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Links;
use Illuminate\Http\Request;

class LinksController extends Controller
{

    public function create(Request $request)
    {

        try {
            $request->validate([
                'url' => 'required|url',
                'slug' => 'unique:links',
            ]);

            $slug = $request->input('slug');
            if (empty($slug)) {
                $slug = $this->generateSlug();
            }

            // Criação de uma nova instância do modelo
            $link = new Links;

            // Preenchimento dos atributos do modelo com os dados recebidos
            $link->url = $request->url;
            $link->slug = $slug;
            $link->clicks = $request->clicks;

            // Salvando o modelo no banco de dados
            $link->save();

            // Retornando uma resposta
            return response()->json(['message' => 'Link encurtado com sucesso'], 200);
        }catch (\Exception $error){
            return response()->json(['error' => 'Erro ao encurtar o link: ' . $error->getMessage()], 500);
        }
    }

    public function retrieve($slug)
    {
        // Recupere o link com base no slug fornecido
        $link = Links::where('slug', $slug)->first();

        if ($link) {
            // Incrementar o contador de acessos
            $link->increment('clicks');
            return response()->json(['url' => $link->url], 200);
        }

        return response()->json(['error' => 'Link not found'], 404);
    }

    public function list()
    {
        // Obtenha todos os links encurtados
        $links = Links::all();

        return response()->json($links, 200);
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'url' => 'required|url',
            'slug' => 'unique:links',
        ]);

        $slug = $request->input('slug');
        if (empty($slug)) {
            $slug = $this->generateSlug();
        }

        $link = Links::find($id);

        if ($link) {
            $link->url = $request->input('url');
            $link->slug = $slug;
            $link->save();

            return response()->json(['message' => 'Link updated successfully'], 200);
        }

        return response()->json(['error' => 'Link not found'], 404);
    }

    public function delete($id)
    {
        $link = Links::find($id);

        if ($link) {
            $link->delete();
            return response()->json(['message' => 'Link deleted successfully'], 200);
        }

        return response()->json(['error' => 'Link not found'], 404);
    }

    private function generateSlug()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $slugLength = rand(6, 8);
        $slug = '';

        $charactersLength = strlen($characters);
        for ($i = 0; $i < $slugLength; $i++) {
            $slug .= $characters[rand(0, $charactersLength - 1)];
        }

        // Verificar se o slug já existe no banco de dados
        $existingSlug = Links::where('slug', $slug)->first();
        if ($existingSlug) {
            // Caso exista, chamar recursivamente a função para gerar um novo slug único
            return generateSlug();
        }

        return $slug;
    }
}
