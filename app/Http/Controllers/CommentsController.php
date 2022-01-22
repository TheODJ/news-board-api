<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\News;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comments::all();
        return $comments;
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
        $comment = new Comments();
        $comment->post_id = $request->input('post_id');
        $comment->author_name = $request->input('author_name');
        $comment->content = $request->input('content');
        $comment->save();
        $news = News::find($comment->post_id);
        $news->no_comments++;
        $news->save();
        return response()->json(
            [
                "data" => [
                    "message" => "Comment added",
                    "data" => $comment,
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
        $comment = Comments::find($id);
        if (is_null($comment)) {
            return response()->json(
                [
                    "data" => [
                        "message" => "Comment not found",
                    ],
                ],
                404
            );
        }
        return response()->json(
            [
                "data" => [
                    "message" => "Comment found",
                    "data" => $comment,
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
        $comment = Comments::find($id);
        $comment->post_id = $request->input('post_id');
        $comment->author_name = $request->input('author_name');
        $comment->content = $request->input('content');
        $comment->save();
        return response()->json(
            [
                "data" => [
                    "message" => "Comment updated",
                    "data" => $comment,
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
        $comment = Comments::find($id);
        $comment->delete();
        return response()->json(
            [
                "data" => [
                    "message" => "Comment deleted",
                    "data" => $comment,
                ],
            ],
            200
        );
    }
}
