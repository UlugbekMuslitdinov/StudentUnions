<?php
namespace App\Http\Controllers\Catering;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryController extends Controller 
{

    public function getImages(){
        
        return response()->json([
            'success' => true,
            'images' => [
                [
                    'original' => 'http://lorempixel.com/1000/600/nature/1/',
                    'thumbnail' => 'http://lorempixel.com/250/150/nature/1/'
                ],
                [
                    'original' => 'http://lorempixel.com/1000/600/nature/2/',
                    'thumbnail' => 'http://lorempixel.com/250/150/nature/2/'
                ],
                [
                    'original' => 'http://lorempixel.com/1000/600/nature/3/',
                    'thumbnail' => 'http://lorempixel.com/250/150/nature/3/'
                ]
            ]
        ], 200);
    }
}