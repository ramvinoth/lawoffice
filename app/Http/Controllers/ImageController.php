<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Response;

class ImageController extends Controller{

	public function getImage($path,$file){
        if($file){
            $url = $path."/".$file;
        }else{
            $url = $path;
        }
        $path = storage_path("app/public/") . $url;
        if(!File::exists($path)) abort(404);

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
	}
}
?>
