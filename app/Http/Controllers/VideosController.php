<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Database\Eloquent\Model;
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
        if (Video::where('id', $id)->exists()) {
            return Video::findOrFail($id);
        } else {
            $erro = "Não encontrado.";
            return \response()->json($erro);
        }
    }

    //Função para adicionar um novo vídeo.
    public function novoVideo(Request $request)
    {
        $validator = $request->validate([
            'titulo' => 'required|alpha_num',
            'descricao' => 'required',
            'url' => 'required|url'
        ]);

        if ($validator) {
            $video = new Video($validator);
            $video->save();
            return \response()->json([
                'titulo' => $video->titulo,
                'descricao' => $video->descricao,
                'url' => $video->url
            ]);
        } else {
            return \response()->json("Erro ao adicionar novo vídeo.");
        }

    }

    //Função para atualizar um ou mais campos de um vídeo
    public function alterarVideo(Request $request, $id)
    {
            $video = Video::findOrFail($id);

            if($request->titulo) {
                $video->titulo = $request->titulo;
            }

        if($request->descricao) {
            $video->descricao = $request->descricao;
        }

        if($request->url) {
            $video->url = $request->url;
        }

            $video->save();

            return \response()->json([
                'titulo' => $video->titulo,
                'descricao' => $video->descricao,
                'url' => $video->url
            ]);

    }

    //Função para deletar um video com id
    public function deletarVideo($id)
    {

        $video = Video::findOrFail($id);
        $video->delete();

        return \response()->json("Vídeo $id deletado com sucesso.");

    }
}
