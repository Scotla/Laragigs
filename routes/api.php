<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/try', function(){
    return response()->json([
        'planet'=>[
            'name'=>'Earth',
            'race'=>'human',
        'identity' =>[
             'name'=>'pierre',
             'physic'=>[
                'height'=>'short',
                'weight'=>'overweight',
                'eyes'=> [
                    'color'=>'brown'
                ],
                'skin'=>[
                    'color'=>"black"
                ]
            ]
        ],
        
        ]
     ]);
 });