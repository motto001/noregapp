<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InfoController extends Controller
{
     function getUserData(){

return response()->json(Auth::user());

     }

   public function index(Request $request)
    {

    $data=["kk"=>"hello",'err'=>'llllllll'];
 /*   
$response = response()->json($data);
$response->header('Content-Type', 'application/json');
$response->header('charset', 'utf-8');
*/
return response()
    ->json($data,200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

}
