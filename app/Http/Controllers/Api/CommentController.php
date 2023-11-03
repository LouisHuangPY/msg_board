<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    /**
     * 目前Controller為了處理CRUD操作顯得有些臃腫，
     * 若要改善這點，我的想法是可能將api response的部分，
     * 放到一個名為ApiController的父類別，
     * (或者也能將api response的部分寫成trait，我會再研究優缺點)
     * 或可將商業邏輯操作轉至Service層，並考慮Singleton單例模式的實作
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::factory()->count(3)->make();

        // Resource會由JSON轉化為Http reseponse傳出
        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
        // 灌注假資料
        $comment = Comment::factory()->make([
            'name' => $request->name,
            'message' => $request->message,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return (new CommentResource($comment))
            ->response()
            ->setStatusCode(201); //HTTP_CREATED
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 無資料庫，先不做id相關的處理

        // 灌注假資料
        $comment = Comment::factory()->make([
            'id' => $id,
        ]);
        return (new CommentResource($comment))
            ->response()
            ->setStatusCode(200); //HTTP_OK
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, $id)
    {
        // 無資料庫，先不做id相關的處理

        // 灌注假資料
        $comment = Comment::factory()->make([
            'id' => $id,
            'message' => $request->message,
            'updated_at' => now(),
        ]);
        return (new CommentResource($comment))
            ->response()
            ->setStatusCode(201); //HTTP_CREATED
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 無資料庫，先不做id相關的處理
        return response()->noContent(); //HTTP_NO_CONTENT 204

    }
}
