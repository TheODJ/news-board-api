<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();
        return $news;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $news = new News();
        $news->title = $request->input('title');
        $news->url = $request->input('url');
        $news->no_upvotes = 0;
        $news->no_comments = 0;
        $news->author_name = $request->input('author_name');
        $news->save();
        return response()->json(
            [
                "data" => [
                    "message" => "Post created",
                    "data" => $news,
                ],
            ],
            200
        );
    }

    /**
     * Upvote a post
     *
     * @return void
     */
    public function upvotePost(Request $request)
    {
        $id = $request->input('id');
        $news = News::find($id);
        $news->no_upvotes++;
        $news->save();
        return response()->json(
            [
                "data" => [
                    "message" => "Post upvoted",
                    "data" => $news,
                ],
            ],
            200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news_item = News::find($id);
        if (is_null($news_item)) {
            return response()->json(
                [
                    "data" => [
                        "message" => "Post does not exist",
                    ],
                ],
                404
            );
        }
        return response()->json(
            [
                "data" => [
                    "message" => "Post found",
                    "data" => $news_item,
                ],
            ],
            200
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $news = News::find($id);
        $news->title = $request->input('title');
        $news->url = $request->input('url');
        $news->author_name = $request->input('author_name');
        $news->save();
        return response()->json(
            [
                "data" => [
                    "message" => "Post updated",
                    "data" => $news,
                ],
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete();
        return response()->json(
            [
                "data" => [
                    "message" => "Post deleted",
                    "data" => $news,
                ],
            ],
            200
        );
    }
}
