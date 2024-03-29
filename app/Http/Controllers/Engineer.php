<?php

namespace App\Http\Controllers;

use App\Models\ClientsModel;
use App\Models\Products;
use App\Models\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Engineer extends Controller
{
    //

    public function home(Request $request)
    {

        $clientsModel     = ClientsModel::join('categories' ,'categories.id' , '=' , 'clients.category');        
        $clientsModel->join('neighborhoods' , 'neighborhoods.id' , '=' , 'clients.neighborhood');        
        $clientsModel->where(['send_to_engineer' => 1 , 'approved' => 0]);        
                
        $clients = $clientsModel->paginate(10 , ['clients.*' , 'categories.name AS category_name' , 'neighborhoods.name AS neighborhood_name']);
        

        return view('engineer.index' , compact('clients'));

    }

    public function details(Request $request)
    {

        if($request->has('id')){
        
            if($request->isMethod('post')){
                
                $data = ClientsModel::find($request->id);

                if($request->has('compelte')){                    
                    $data->approved = 1;
                }else{
                    $data->approved = 2;
                }

                if($data->update()){
                    return redirect()->route('engineer.home');
                }


            }

            $clientsModel     = ClientsModel::join('categories' ,'categories.id' , '=' , 'clients.category');        
            $clientsModel->join('neighborhoods' , 'neighborhoods.id' , '=' , 'clients.neighborhood');        
            // $clientsModel->join('section' , 'section.id' , '=' , 'clients.section');        
            // $clientsModel->join('services' , 'services.id' , '=' , 'clients.service');        
            $clientsModel->where(['clients.id' => $request->id]);        
                    
            $details = $clientsModel->first(['clients.*' , 'categories.name AS category_name' , 'neighborhoods.name AS neighborhood_name']);// , 'services.name AS service_name' , 'section.name AS section_name']);
            
            $data = ClientsModel::find($request->id);
            $data->is_visited = 1;
            $data->update();    
            
            return view('engineer.details' , compact('details'));
        
        }else{
            
            abort(Response::HTTP_NOT_FOUND);

        }
        
    }

    public function price_offer(Request $request)
    {
        if($request->isMethod('post')){
           // var_dump($request->input('products'));
        }


        $customer     = ClientsModel::where(['id' => $request->client_id])->first();
        $products         = ProductsModel::get();

        return view('engineer.price_offer' , compact('customer' , 'products'));
    }

    public function completed(Request $request)
    {
        $clientsModel     = ClientsModel::join('categories' ,'categories.id' , '=' , 'clients.category');        
        $clientsModel->join('neighborhoods' , 'neighborhoods.id' , '=' , 'clients.neighborhood');        
        $clientsModel->where(['send_to_engineer' => 1 , 'approved' => 1]);        
                
        $clients = $clientsModel->paginate(10 , ['clients.*' , 'categories.name AS category_name' , 'neighborhoods.name AS neighborhood_name']);
        

        return view('engineer.index' , compact('clients'));
    }

    public function uncompleted(Request $request)
    {
        $clientsModel     = ClientsModel::join('categories' ,'categories.id' , '=' , 'clients.category');        
        $clientsModel->join('neighborhoods' , 'neighborhoods.id' , '=' , 'clients.neighborhood');        
        $clientsModel->where(['send_to_engineer' => 1 , 'approved' => 2]);        
                
        $clients = $clientsModel->paginate(10 , ['clients.*' , 'categories.name AS category_name' , 'neighborhoods.name AS neighborhood_name']);
        

        return view('engineer.index' , compact('clients'));
    }


    public function logout(Request $request) 
    {
        Auth::logout();
        return redirect('/');
    }

}
