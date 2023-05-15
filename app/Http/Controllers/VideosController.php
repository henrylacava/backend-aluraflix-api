<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideosRequest;
use App\Http\Requests\UpdateVideosRequest;
use App\Models\Videos;

class VideosController extends Controller
{
    public function index()
    {
        $search = request('search');
        if ($search) {
            $videos = Videos::where('title', 'LIKE', '%'.$search.'%')->paginate();
        } else {
            $videos = Videos::paginate();
        }
        return response()->json($videos);
    }

    public function store(StoreVideosRequest $request)
    {
        $videosData = new Videos($request->all());
        $videosData->save();
        return response()->json($videosData);
    }

    public function show(int $id)
    {
        if (Videos::where('id',$id)->exists()) {
            $video = Videos::find($id);
            return response()->json($video);
        } else {
            return response()->json('Não encontrado', 404);
        }
    }

    public function update(Videos $video, UpdateVideosRequest $request)
    {
        $video->fill($request->all());
        $video->save();
        return response()->json($video);
    }

    public function destroy(int $id)
    {
        if (Videos::where('id',$id)->exists()) {
            Videos::find($id)->delete();
            return response()->json('Sucesso', 202);
        } else {
            return response()->json('Vídeo não encontrado', 404);
        }
    }

    public function indexFree()
    {
        $videosFree = Videos::limit(5)->get();
        return response()->json($videosFree);
    }
}
