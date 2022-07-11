<?php

namespace App\Http\Controllers;

use App\Models\SectionModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Section extends Controller
{
    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        $sections = SectionModel::paginate(10);
        return view("sections.home" , compact('sections'));
    }


    public function add(Request $request)
    {
        $message = "";
        $error_message = "";

        if($request->isMethod('post')){

            $section = new SectionModel();
            $section->name = $request->name;

            if($section->save()){
                $message = "تمت الاضافة بنجاح";
            }else{
                $error_message = "حدث خطأ ما لم تتم الاضافة";
                back()->withInput($request->all());// this to back with saved data
            }

        }

        return view("sections.add" , compact( 'message' , 'error_message' ));
    }

    public function edit(Request $request)
    {

        $message = "";
        $error_message = "";

        if($request->has('id')){

            if($request->isMethod('post'))
            {
                $data = SectionModel::find($request->id);
                $data->name = $request->name;
                if($data->update())
                {
                    $message = "تم التحديث بنجاح";
                }else{
                    $error_message = "حدث خطأ ما لم يتم التحديث بنجاح";
                }
            }

            $section = SectionModel::find($request->id);

            if($section == NULL)
            {
                abort(Response::HTTP_NOT_FOUND);
                return;
            }

            $section = $section->first();

            return view("sections.edit" , compact('section', 'message' , 'error_message'));
        
        }

        abort(Response::HTTP_NOT_FOUND);
        
    }

    public function delete(Request $request)
    {

        SectionModel::find($request->id)->delete();
        return redirect()->back();

    }


}
