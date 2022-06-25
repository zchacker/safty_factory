<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Category extends Controller
{
    
    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        $categories = CategoryModel::paginate(5);
        return view("categories.home" , compact('categories'));
    }


    public function add(Request $request)
    {
        $message = "";
        $error_message = "";

        if($request->isMethod('post')){

            $category = new CategoryModel();
            $category->name = $request->name;

            if($category->save()){
                $message = "تمت الاضافة بنجاح";
            }else{
                $error_message = "حدث خطأ ما لم تتم الاضافة";
                back()->withInput($request->all());// this to back with saved data
            }

        }

        return view("categories.add" , compact( 'message' , 'error_message' ));
    }

    public function edit(Request $request)
    {

        $message = "";
        $error_message = "";

        if($request->has('id')){

            if($request->isMethod('post'))
            {
                $data = CategoryModel::find($request->id);
                $data->name = $request->name;
                if($data->update())
                {
                    $message = "تم التحديث بنجاح";
                }else{
                    $error_message = "حدث خطأ ما لم يتم التحديث بنجاح";
                }
            }

            $category = CategoryModel::find($request->id);

            if($category == NULL)
            {
                abort(Response::HTTP_NOT_FOUND);
                return;
            }

            $category = $category->first();

            return view("categories.edit" , compact('category', 'message' , 'error_message'));
        
        }

        abort(Response::HTTP_NOT_FOUND);
        
    }

}
