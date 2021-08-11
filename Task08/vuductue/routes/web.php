<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;
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
    return view('tasks');
});

/***
 * show Task Dashboard
 */
Route::get('/',function (){
    //
});

/***
 * Add new Task
 */

Route::post('/task',function (Request $request) {

    $validator = Validator::make($request->all(), [
        'name' => 'requited|max:255',
    ]);

    if ($validator->fails()){
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect();
});
/***
 * Delete Task
 */

Route::delete('task/{task}',function (){
    //
});
