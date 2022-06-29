<?php

namespace App\Http\Controllers;

use App\Models\ServicesModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Service extends Controller
{
    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        $services = ServicesModel::paginate(10);
        return view("services.home" , compact('services'));
    }


    public function add(Request $request)
    {
        $message = "";
        $error_message = "";

        if($request->isMethod('post')){

            $category = new ServicesModel();
            $category->name = $request->name;

            if($category->save()){
                $message = "تمت الاضافة بنجاح";
            }else{
                $error_message = "حدث خطأ ما لم تتم الاضافة";
                back()->withInput($request->all());// this to back with saved data
            }

        }

        return view("services.add" , compact( 'message' , 'error_message' ));
    }

    public function edit(Request $request)
    {

        $message = "";
        $error_message = "";

        if($request->has('id')){

            if($request->isMethod('post'))
            {
                $data = ServicesModel::find($request->id);
                $data->name = $request->name;
                if($data->update())
                {
                    $message = "تم التحديث بنجاح";
                }else{
                    $error_message = "حدث خطأ ما لم يتم التحديث بنجاح";
                }
            }

            $category = ServicesModel::find($request->id);

            if($category == NULL)
            {
                abort(Response::HTTP_NOT_FOUND);
                return;
            }

            $category = $category->first();

            return view("services.edit" , compact('category', 'message' , 'error_message'));
        
        }

        abort(Response::HTTP_NOT_FOUND);
        
    }
}
