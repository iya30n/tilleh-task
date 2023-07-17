<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Services\NewsService;
use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Resources\News\NewsListResource;

class NewsController extends Controller
{
    public function index()
    {
        return NewsListResource::collection(News::paginate());
    }

    public function store(StoreNewsRequest $request, NewsService $newsService)
    {
        return $newsService->store($request);
    }

    public function show(News $news)
    {
        $news->load("comments");

        return response()->json(["data" => $news]);
    }
}
