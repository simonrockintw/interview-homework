<?php

namespace App\Http\Controllers;

use App\Services\NewsService;
use Exception;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function showIndexForm(Request $request)
    {
        $result = ['status' => 200];

        try {
            $filters = array_merge([
                'before' => null,
                'after' => null,
            ], $request->only('before', 'after'));

            $result['data'] = $this->newsService->getAllByDates($filters)->toArray();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function index()
    {
        return view('news.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'title',
            'authorName',
            'content',
            'publishedAt',
            'display',
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->newsService->savePostData($data);
        } catch (Exception $e) {
            return back()
                ->with('failed', $e->getMessage())
                ->withInput();
//            $result = [
//                'status' => 500,
//                'error' => $e->getMessage(),
//            ];
        }
        return back()->with('success', '提交成功!');
//        return response()->json($result, $result['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param  id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $news = $this->newsService->getById($id);
        } catch (Exception $e) {
            return view('404');
        }
        return view('news.edit', compact('news'));
    }

    /**
     * Update news.
     *
     * @param id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only([
            'title',
            'authorName',
            'content',
            'publishedAt',
            'display',
        ]);

        try {
            $result['data'] = $this->newsService->updateNews($data, $id);
        } catch (Exception $e) {
            return back()
                ->with('failed', $e->getMessage())
                ->withInput();
        }

        return redirect()->route('news.index');
    }

    /**
     * Update news.
     *
     * @param id
     *
     * @return \Illuminate\Http\Response
     */
    public function changeDisplay(Request $request, $id)
    {
        $result = ['status' => 200];

        $data = $request->only([
            'display',
        ]);

        try {
            $result['data'] = $this->newsService->updateNews($data, $id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }

        return response()->json($result, $result['status']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->newsService->deleteById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }

        return response()->json($result, $result['status']);
    }
}
