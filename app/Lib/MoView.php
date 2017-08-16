<?php

namespace App\Lib;
//use Illuminate\Http\Request;

class MoView
{
    /*
  public  $request;

function __construct(Request $request) {
    $this->request=$request;

}*/
   static public function view( $view,$data,$dataname,$cors=true)
    {
        $$dataname=$data;
      //  $req=$this->request->url();
       // echo $req;
       // return view('admin.users.index', compact('users'));
      // return response()->json($data,200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
       
        if ($cors) {

            return response()->json($data,200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
        else{

            return view($view, compact('users'));
        }
        
    }
}