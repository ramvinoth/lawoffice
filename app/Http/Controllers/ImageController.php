<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Response;

class ImageController extends Controller{

	public function getImage($path){
        $path_arr = explode("/", $path);
        $length = count($path_arr)-1;
        $file = $path_arr[$length];
        
        $path = storage_path("app/public/") . $path;
        if(!File::exists($path)) abort(404);

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
	}
}
?>
