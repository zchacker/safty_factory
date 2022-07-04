<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ClientsModel;
use App\Models\NeighborhoodsModel;
use App\Models\SectionModel;
use App\Models\ServicesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Client extends Controller
{
    
    public function __construct()
    {
        
    }

    public function index(Request $request)
    {


        $clientsModel  = ClientsModel::join('categories' ,'categories.id' , '=' , 'clients.category');        
        $clientsModel->join('neighborhoods' , 'neighborhoods.id' , '=' , 'clients.neighborhood');        
        // $clientsModel->join('section' , 'section.id' , '=' , 'clients.section');        
        // $clientsModel->join('services' , 'services.id' , '=' , 'clients.service');        
        

        if ($request->has('neighborhood') && strlen($request->neighborhood) > 0) {
            $clientsModel->where(['neighborhood' => $request->neighborhood]);
        }

        if ($request->has('category') && strlen($request->category) > 0) {
            $clientsModel->where(['category' => $request->category]);
        }

        if ($request->has('service') && strlen($request->service) > 0) {
            $clientsModel->where(['service' => $request->service]);
        }

        if ($request->has('section') && strlen($request->section) > 0) {
            $clientsModel->where(['section' => $request->section]);
        }

        if ($request->has('phone') && strlen($request->phone) > 0) {
            $clientsModel->where(['phone' => $request->phone]);
        }
        
        if ($request->has('company_name') && strlen($request->company_name) > 0) {
            $clientsModel->where(['company_name' => $request->company_name]);
        }
                
        $clientsModel->orderBy('created_at', 'desc');
        $clientsModel->where('approved' ,'=', 0 );
        $clientsModel->orWhere('approved' ,'=', 1 );

        $clients        = $clientsModel->paginate(10 , ['clients.*' , 'categories.name AS category_name' , 'neighborhoods.name AS neighborhood_name' ]);
        $categories     = CategoryModel::get();
        $neighborhoods  = NeighborhoodsModel::get();
        $services       = ServicesModel::get();
        $sections       = SectionModel::get();

        return view('client.index' , compact('clients', 'categories', 'neighborhoods', 'services' , 'sections'));

    }

    public function addClient(Request $request)
    {

        $message        = "";
        $error_message  = "";

        if($request->isMethod('post')){
           

            $services = implode(",",$request->input('service'));
            $sections = implode(",",$request->input('section'));

            $client               = new ClientsModel();
            $client->name         = $request->first_name.' '.$request->last_name;
            $client->phone        = $request->phone;
            $client->company_name = $request->company_name;
            $client->city         = "المدينة المنورة";
            $client->neighborhood = $request->neighborhood;
            $client->category     = $request->category;
            $client->section      = $sections;
            $client->service      = $services;
            $client->note         = $request->note;
            $client->latitude     = $request->latitude;
            $client->longitude    = $request->longitude;

            if($client->save()){
                $message = "تم الحفظ بنجاح";
            }else{
                $error_message  = "حدث خطأ ما لم يتم الحفظ بنجاح, حاول مرة أخرى";
            }
        }

        $categories     = CategoryModel::get();
        $neighborhoods  = NeighborhoodsModel::get();
        $services       = ServicesModel::get();
        $sections       = SectionModel::get();

        return view('client.add' , compact('message' , 'error_message' , 'categories' , 'neighborhoods' , 'services' , 'sections'));

    }

    public function rejected(Request $request)
    {

        $clientsModel     = ClientsModel::join('categories' ,'categories.id' , '=' , 'clients.category');        
        $clientsModel->join('neighborhoods' , 'neighborhoods.id' , '=' , 'clients.neighborhood');        
        // $clientsModel->join('section' , 'section.id' , '=' , 'clients.section');        
        // $clientsModel->join('services' , 'services.id' , '=' , 'clients.service');  

        if ($request->has('neighborhood') && strlen($request->neighborhood) > 0) {
            $clientsModel->where(['neighborhood' => $request->neighborhood]);
        }

        if ($request->has('category') && strlen($request->category) > 0) {
            $clientsModel->where(['category' => $request->category]);
        }

        if ($request->has('phone') && strlen($request->phone) > 0) {
            $clientsModel->where(['phone' => $request->phone]);
        }
        
        if ($request->has('company_name') && strlen($request->company_name) > 0) {
            $clientsModel->where(['company_name' => $request->company_name]);
        }
                
        $clientsModel->orderBy('created_at', 'desc');
        $clientsModel->where('approved' ,'=', 2);        

        $clients = $clientsModel->paginate(10 , ['clients.*' , 'categories.name AS category_name' , 'neighborhoods.name AS neighborhood_name' ]);//, 'services.name AS service_name' , 'section.name AS section_name']);
        $categories     = CategoryModel::get();
        $neighborhoods  = NeighborhoodsModel::get();

        $services       = ServicesModel::get();
        $sections       = SectionModel::get();

        return view('client.index' , compact('clients', 'categories', 'neighborhoods', 'services' , 'sections'));

    }

    public function accepted(Request $request)
    {

        $clientsModel     = ClientsModel::join('categories' ,'categories.id' , '=' , 'clients.category');        
        $clientsModel->join('neighborhoods' , 'neighborhoods.id' , '=' , 'clients.neighborhood');        
        // $clientsModel->join('section' , 'section.id' , '=' , 'clients.section');        
        // $clientsModel->join('services' , 'services.id' , '=' , 'clients.service');  

        if ($request->has('neighborhood') && strlen($request->neighborhood) > 0) {
            $clientsModel->where(['neighborhood' => $request->neighborhood]);
        }

        if ($request->has('category') && strlen($request->category) > 0) {
            $clientsModel->where(['category' => $request->category]);
        }

        if ($request->has('phone') && strlen($request->phone) > 0) {
            $clientsModel->where(['phone' => $request->phone]);
        }
        
        if ($request->has('company_name') && strlen($request->company_name) > 0) {
            $clientsModel->where(['company_name' => $request->company_name]);
        }
                
        $clientsModel->orderBy('created_at', 'desc');
        $clientsModel->where('approved' ,'=', 1);        

        $clients = $clientsModel->paginate(10 , ['clients.*' , 'categories.name AS category_name' , 'neighborhoods.name AS neighborhood_name']);// , 'services.name AS service_name' , 'section.name AS section_name']);
        $categories     = CategoryModel::get();
        $neighborhoods  = NeighborhoodsModel::get();

        $services       = ServicesModel::get();
        $sections       = SectionModel::get();

        return view('client.index' , compact('clients', 'categories', 'neighborhoods', 'services' , 'sections'));


    }

    public function editClient(Request $request)
    {
        $message        = "";
        $error_message  = "";

        if($request->has('id')){

            if ($request->isMethod('post')) {

                $services = implode(",",$request->input('service'));
                $sections = implode(",",$request->input('section'));

                $client = ClientsModel::find($request->id);
                $client->name = $request->first_name . ' ' . $request->last_name;
                $client->phone = $request->phone;
                $client->company_name = $request->company_name;
                $client->city = "المدينة المنورة";
                $client->neighborhood = $request->neighborhood;
                $client->category = $request->category;
                $client->section      = $sections;
                $client->service      = $services;
                $client->note = $request->note;
                $client->latitude = $request->latitude;
                $client->longitude = $request->longitude;

                if ($client->update()) {
                    $message = "تم الحفظ بنجاح";
                } else {
                    $error_message  = "حدث خطأ ما لم يتم الحفظ بنجاح, حاول مرة أخرى";
                }
            }

            $categories     = CategoryModel::get();
            $neighborhoods  = NeighborhoodsModel::get();
            $services       = ServicesModel::get();
            $sections       = SectionModel::get();

            $client = ClientsModel::where(['id' => $request->id])->first();

            return view('client.edit', compact('client', 'message', 'error_message', 'categories', 'neighborhoods', 'services' , 'sections'));
        
        } else {

            abort(Response::HTTP_NOT_FOUND);
        }
    }

    public function deleteClient(Request $request)
    {
        ClientsModel::find($request->id)->delete();
        return redirect()->back();
    }    

    public function sendToEngineer(Request $request)
    {
        if($request->isMethod('post')){
            
            $client = ClientsModel::find($request->id);
            
            if($client != null){
                $data = $client;//->first();                
                
                if($data->send_to_engineer == 0){
                    $client->send_to_engineer = 1;
                }else{
                    $client->send_to_engineer = 0;
                }

                if($client->update()){
                    return "updated";
                }else{
                    return "error";
                }

            }else{

                return "error";

            }
            
            
            

        }
    }


    public function logout(Request $request) 
    {
        Auth::logout();
        return redirect('/');
    }


}

?>