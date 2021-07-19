<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Validation\ValidatesRequests;

class VideosController extends Controller
{
    public function todosVideos()
    {
        return Video::all();
    }

    public function getOne($id)
    {
        //Validação de vídeo existente na base de dados.
        if(Video::where('id', $id)->exists()) {
            return Video::findOrFail($id);
        } else {
            $erro = "Não encontrado.";
            return \response()->json($erro);
        }
    }
}
