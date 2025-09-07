<?php

use App\Http\Controllers\TaskCtrl;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(["prefix" => "tasks"], function () {
    Route::get("getTasks", [TaskCtrl::class, "getTasks"]);
    Route::get("getTaskById/{id}", [TaskCtrl::class, "getTaskById"]);
    Route::post("createTask", [TaskCtrl::class, "createTask"]);
    Route::put("updateTask/{id}", [TaskCtrl::class, "updateTask"]);
    Route::delete("deleteTask/{id}", [TaskCtrl::class, "deleteTask"]);
});