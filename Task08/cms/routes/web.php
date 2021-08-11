<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('profile/{name}','ProfileController@showProfile');

Route::get('home','HomeController@showWelcome');
Route::get('about','AboutController@showDetails');

//Route::get('about', function (){
//    return "about content";
//});

Route::get('about/directions', function (){
    return "Directions go here";
});

Route::any('submit-form', function (){
    return "Process Form";
});

//Route::get('about/{theSubject}', function ($theSubject){
//    return $theSubject. 'connect goes here';
//});

Route::get('about/{theSubject}', 'AboutController@showSubject');

Route::get('about/classes/theSubject', function ($theSubject){
    return "connect on $theSubject";
});

Route::get('about/classes/{theArt}/{thePrice}', function ($theArt, $thePrice){
    return "the product $theArt and $thePrice";
});

Route::get('where', function (){
    return Redirect::to('about/directions');
});

Route::get('/insert',function (){
    DB:: insert ('insert into posts(title,body,is_admin) values (?,?,?)',['PHP with Laravel','Laravel is the best fremework !',0]);
    return 'DONE';
});

Route::get('/read',function (){
    $result = DB::select('select * from posts where id = ?',[1]);
//    return $result;
    foreach ($result as $post){
        return $post->title;
    }
});

Route::get('update',function (){
    $updated = DB:: update('update posts set title = "New Title hihi" where id > ?',[1]);
    return $updated;
});

Route::get('delete',function (){
    $deleted = DB:: delete('delete from posts  where id > ?',[1]);
    return $deleted;
});

Route::get('readAll', function (){
    $posts = Post ::all();
    foreach ($posts as $p){
        echo $p->title. "   \t\t" . $p->body;
        echo "<br>";
    }
});

Route::get('findId', function (){
    $posts = Post::where('id','>=',1)
        ->orderBy('id', 'desc')
        ->take(1)
        ->get();
    foreach ($posts as $p){
        echo $p->title;
        echo "<br>";
    }
});

Route::get('insertORM', function (){
    $p = new Post();
    $p->title = 'insert ORM';
    $p->body = 'INSERTED done ORM';
    $p->is_admin = 1;
    $p->save();
});

Route::get('updatedORM', function (){
    $p = Post::where('id',2)->first();
    $p->title = 'updated ORM';
    $p->body = 'updated done';
    $p->save();
});

Route::get('deleteORM', function (){
    $p = Post::where('id','>=',3)
        ->delete();
});

Route::get('destroyORM', function (){
    $p = Post::destroy(11,17);
});
