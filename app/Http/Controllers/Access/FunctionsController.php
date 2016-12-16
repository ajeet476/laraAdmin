<?php

namespace App\Http\Controllers\Access;

use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class FunctionsController extends Controller
{
    //
    public function index(){
        $routeCollection = Route::getRoutes();
        $routes = [];
        foreach ($routeCollection as $route){
            if($route->getName()==null){
                continue;
            }
            $routes[$route->getName()] = $route->getName();
        }
        $func_list = Permission::all();
        foreach ($func_list as $fun){
            if(isset($routes[$fun->name])){
                unset($routes[$fun->name]);
            }
        }
        return view('access.functions.list')->with(['unRegisteredRoutesCount'=>count($routes), 'functions'=>$func_list]);
    }
    public function register(){

    }
}
