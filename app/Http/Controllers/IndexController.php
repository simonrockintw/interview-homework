<?php

namespace App\Http\Controllers;

use App\Services\NewsService;
use Exception;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index()
    {
        try {
            $news = $this->newsService->getAllPublished();
        } catch (Exception $e) {
            abort(500);
        }

//                dd($news);

        return view('index', compact('news'));
    }

    public function show($id)
    {
        try {
            $news = $this->newsService->getPublishedById($id);
            if (!$news) {
                abort(404);
            }
        } catch (Exception $e) {
            abort(500);
        }
//        dd($news);

        return view('detail', compact('news'));
    }
}

