<?php
namespace App\Http\Controllers\Deliverance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Deliverance\Defaults;
use App\Model\Deliverance\Resource;

class ResourceController extends Controller 
{
    public function __construct()
    {
        $this->middleware('suapi');
	}

	public function getHomeImages(){
        $defaults = New Defaults;
        $resourceID_4 = $defaults->getResourceID(4);
        $resourceID_2 = $defaults->getResourceID(2);

        $resource = New Resource;
        $resource_4 = $resource->getResource($resourceID_4);
        $resource_2 = $resource->getResource($resourceID_2);

		return response()->json([
            'success' => true,
            'imgs' => [
                'img_4' => [
                    'filePath' => $resource_4->filePath,
                    'altTxt' => $resource_4->altTxt,
                    'resourceLink' => $resource_4->resourceLink
                ],
                'img_2' => [
                    'filePath' => $resource_2->filePath,
                    'altTxt' => $resource_2->altTxt,
                    'resourceLink' => $resource_2->resourceLink
                ]
            ]
        ], 200);
	}
}