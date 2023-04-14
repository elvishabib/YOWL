<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
$users="users";
Route::middleware('auth.api')->group(function(){

$users="users";
Route::post($users.'/mailVerification',[UserController::class,'confirmEmailWithCode']);
Route::post($users.'/updatePassword/{token}', [UserController::class,'updatePassword']);
Route::get($users.'/myProfil/{token}',[UserController::class,'showMyPofil']);
Route::post($users.'/mailForResetPassword',[UserController::class,'verifyMailForResetPassword']);
Route::post($users.'/resetPassword',[UserController::class,'resetPassword']);
Route::post($users.'/verifyUsername/{username}',[UserController::class,'verifyUsername']);
Route::post($users.'/updateMyProfil/{token}',[UserController::class,'updateMyProfil']);
Route::get($users.'/allUsers',[UserController::class,'allUser']);
Route::post('logout/{token}', [AuthController::class, 'logout']);
Route::get($users.'/verifyUserToken/{token}',[UserController::class,'verifyUserToken']);


$admin="admin";
Route::post($admin.'/createAdmin',[UserController::class,'createAdmin']);
Route::get($admin.'/allUserAdmin',[UserController::class,'allUserAdmin']);
Route::post($admin.'/deleteUser/{id}/{token}',[UserController::class,'deleteUser']);
Route::post($admin.'/deleteAdmin/{id}/{token}',[UserController::class,'deleteAdmin']);
Route::post($admin.'/updateUserByAdminSys/{id}/{token}',[UserController::class,'updateUserByAdminSysteme']);
Route::post($admin.'/updateUserByAdmin/{id}/{token}',[UserController::class,'updateUserByAdmin']);
Route::get($admin.'/countUser',[UserController::class,'countUser']);
Route::get($admin.'/countAdmin',[UserController::class,'countAdmin']);
Route::get($admin.'/showUserProfil/{id}',[UserController::class,'showUserProfil']);



$posts="posts";
Route::post($posts.'/create',[PostController::class,'create']);
Route::post($posts.'/delete/{id}',[PostController::class, 'delete']);
Route::post($posts.'/edit/{id}',[PostController::class, 'update']);
Route::post($posts.'/like/{id}',[LikeController::class, 'likes']);
// Route::post($posts.'/unlikes/{id}',[PostController::class, 'unlikes']);
Route::post($posts.'/show_posts',[PostController::class, 'show_from_user']);
Route::get($posts.'/post_count',[PostController::class, 'count']);


$comments="comments";
Route::post($comments.'/addcomment/{id}',[CommentController::class, 'addcomment']);
Route::post($comments.'/edit/{id}',[CommentController::class, 'update']);
// Route::post($comments.'/likes/{id}',[CommentController::class, 'likes']);
// Route::post($comments.'/unlikes/{id}',[CommentController::class, 'unlikes']);
Route::post($comments.'/delete/{id}',[CommentController::class, 'delete']);

Route::post($comments.'/show_comments',[CommentController::class, 'show_from_user']);
Route::get($comments.'/comment_count',[CommentController::class, 'count']);

//$likes="likes";
//Route::post('posts/{post:id}/likes',[LikeController::class, 'likes']);
//Route::post('posts/{post:id/unlikes',[LikeController::class, 'unlikes']);

});

Route::post('login', [AuthController::class, 'login']);
Route::post($users.'/register',[UserController::class,'register']);

$posts="posts";
Route::get($posts.'/allposts',[PostController::class,'index']);
Route::get($posts.'/post/{id}',[PostController::class, 'show']);
Route::get($posts.'/search',[PostController::class, 'search']);
$comments="comments";
Route::get($comments.'/comment/{id}',[CommentController::class, 'show']);