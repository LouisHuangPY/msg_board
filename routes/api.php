<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 新增API路由並做URL-based versioning(先不做資料夾方面的versioning)
Route::namespace('App\Http\Controllers\Api')->prefix('v1')->group(function () {

	// 以resource controller的方式處理model，簡潔且便利
	Route::apiResource('comments', 'CommentController');

	/**
	 * GET /comments index comments.index
	 * GET /comments/{comment} show comments.show
	 * POST /comments store comments.store
	 * PUT/PATCH /comments/{comment} update comments.update
	 * DELETE /comments/{comment} destroy comments.destroy
	 * 要注意POST和PUT有做validate，至少需要'message'的input
	 */
});


