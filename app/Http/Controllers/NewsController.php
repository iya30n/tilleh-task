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
            $thumbnailPath = Storage::disk("s3")->put("news", $request->file("thumbnail"), "public");
            $createdNews = News::create(array_merge(
                $request->validated(), ["thumbnail" => $thumbnailPath]
            ));
        } catch (Exception $e) {
            Storage::disk("s3")->delete($thumbnailPath);
            Log::error($e->getMessage());
            return response()->json(["message" => "Server error!"]);
        }

        return response()->json(["data" => $createdNews]);
    }

    public function show(News $news)
    {
        $news->load("comments");

        return response()->json(["data" => $news]);
    }
}
