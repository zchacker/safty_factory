<?php

namespace App\Http\Controllers;

use App\Models\NeighborhoodsModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Neighborhood extends Controller
{
    
    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        $neighborhoods = NeighborhoodsModel::paginate(1);
        return view("neighborhoods.home" , compact('neighborhoods'));
    }


    public function add(Request $request)
    {
        $message = "";
        $error_message = "";

        if($request->isMethod('post')){

            $neighborhood = new NeighborhoodsModel();
            $neighborhood->name = $request->name;

            if($neighborhood->save()){
                $message = "تمت الاضافة بنجاح";
            }else{
                $error_message = "حدث خطأ ما لم تتم الاضافة";
                back()->withInput($request->all());// this to back with saved data
            }

        }

        return view("neighborhoods.add" , compact( 'message' , 'error_message' ));
    }

    public function edit(Request $request)
    {

        $message = "";
        $error_message = "";

        if($request->has('id')){

            if($request->isMethod('post'))
            {
                $data = NeighborhoodsModel::find($request->id);
                $data->name = $request->name;
                if($data->update())
                {
                    $message = "تم التحديث بنجاح";
                }else{
                    $error_message = "حدث خطأ ما لم يتم التحديث بنجاح";
                }
            }

            $neighborhood = NeighborhoodsModel::find($request->id);
            
            if($neighborhood == NULL)
            {
                abort(Response::HTTP_NOT_FOUND);                
                return;
            }

            $neighborhood = $neighborhood->first();

            return view("neighborhoods.edit" , compact('neighborhood', 'message' , 'error_message'));
        
        }

        abort(Response::HTTP_NOT_FOUND);
        
    }

}
