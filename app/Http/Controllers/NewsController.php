<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\News;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Resources\News\NewsListResource;

class NewsController extends Controller
{
    public function index()
    {
        return NewsListResource::collection(News::paginate());
    }

    public function store(StoreNewsRequest $request)
    {
        try {
            $thumbnailPath = Storage::put("news", $request->file("thumbnail"));
            $createdNews = News::create(array_merge(
                $request->validated(), ["thumbnail" => $thumbnailPath]
            ));
        } catch (Exception $e) {
            Storage::delete($thumbnailPath);
            Log::error($e->getMessage());
            return response()->json(["message" => "Server error!"]);
        }

        return response()->json(["data" => $createdNews]);
    }
}
