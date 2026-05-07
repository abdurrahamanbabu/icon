<?php 
namespace AbdurRahaman\Icon\Http\Controllers;

use AbdurRahaman\Icon\Models\Icon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;    

class IconController extends Controller
{
    public function get(Request $request)
    {
        try{
            if(!$request->has('icon')) {
                $icons = Icon::take(100)->get(['icon']);
                return response()->json($icons,200);    
            }
            $icon = $request->query('icon');
            $icons = Icon::where('icon','like',"%$icon%")->get(['icon']);
            return response()->json($icons,200);    
        }catch(Exception $e){
            return response()->json([],503);
        }
    }
}