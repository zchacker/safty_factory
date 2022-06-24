<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ClientsModel;
use App\Models\NeighborhoodsModel;
use Illuminate\Http\Request;

class Client extends Controller
{
    
    public function __construct()
    {
        
    }

    public function index(Request $request)
    {


        $clientsModel     = ClientsModel::join('categories' ,'categories.id' , '=' , 'clients.category');        
        $clientsModel->join('neighborhoods' , 'neighborhoods.id' , '=' , 'clients.neighborhood');        
        

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
                
        $clients = $clientsModel->paginate(10 , ['clients.*' , 'categories.name AS category_name' , 'neighborhoods.name AS neighborhood_name']);
        $categories     = CategoryModel::get();
        $neighborhoods  = NeighborhoodsModel::get();

        return view('client.index' , compact('clients', 'categories', 'neighborhoods'));

    }

    public function addClient(Request $request)
    {

        $message        = "";
        $error_message  = "";

        if($request->isMethod('post')){
            $client = new ClientsModel();
            $client->name = $request->first_name.' '.$request->last_name;
            $client->phone = $request->phone;
            $client->company_name = $request->company_name;
            $client->city = "المدينة المنورة";
            $client->neighborhood = $request->neighborhood;
            $client->category = $request->category;
            $client->note = $request->note;
            $client->latitude = $request->latitude;
            $client->longitude = $request->longitude;

            if($client->save()){
                $message = "تم الحفظ بنجاح";
            }else{
                $error_message  = "حدث خطأ ما لم يتم الحفظ بنجاح, حاول مرة أخرى";
            }
        }

        $categories     = CategoryModel::get();
        $neighborhoods  = NeighborhoodsModel::get();

        return view('client.add' , compact('message' , 'error_message' , 'categories' , 'neighborhoods'));

    }

    public function showClient(Request $request)
    {

    }

    public function editClient(Request $request)
    {

    }

    public function sendToEngineer(Request $request)
    {

    }

}
