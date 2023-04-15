<?php

namespace App\Http\Controllers;

use App\Models\clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ClientsController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients=Clients::all();
        if (count($clients) <= 0) {
            return response(["message" => "Il n'a pas trouvé Clients"], 200);
        }
        return response()->json(['Clients' => $clients]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'First_name_client'=>['required','string'],
            'Last_name_client'=>['required','string'],
            'email_client'=>['email','required','unique'],
            'password_client'=>['required','string'],
            'adress_client'=>['required','string'],
            'Code_postal_client'=>['required','numeric'],
            'city_client'=>['required','string'],
            'country_client'=>['required','string'],
            'pays_client'=>['required','string'],
        ]);

        $dataClients = Clients::create([
            'First_name_client'=>$validatedData['First_name_client'],
            'Last_name_client'=>$validatedData['Last_name_client'],
            'email_client'=>$validatedData['email_client'],
            'password_client'=>$validatedData['password_client'],
            'adress_client'=>$validatedData['adress_client'],
            'Code_postal_client'=>$validatedData['Code_postal_client'],
            'city_client'=>$validatedData['city_client'],
            'country_client'=>$validatedData['country_client'],
            'pays_client'=>$validatedData['pays_client'],
        ]);
        return response()->json(['Clients' =>  $dataClients, 'message' => 'Clients ajoutée']);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $client =DB::table('bookings')
        ->join('clients','bookings.Client_id','=','clients.id')
        ->select('clients.*','bookings.pickup_date','bookings.pickup_location','bookings.return_location')
        ->where('bookings.id','=',$id)
        ->get()
        ->first();
        return  $client;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'First_name_client'=>['required','string'],
            'Last_name_client'=>['required','string'],
            'email_client'=>['email','required'],
            'password_client'=>['required','string'],
            'adress_client'=>['required','string'],
            'Code_postal_client'=>['required','numeric'],
            'city_client'=>['required','string'],
            'country_client'=>['required','string'],
            'pays_client'=>['required','string'],
        ]);
        $Client =Clients::find($id);
        if (!$Client) {
            return response(["message" => "Il n'a pas trouvé Client id $id"], 200);
        }
        $Client->update($validatedData);
        return response(['message'=>"Client mise a jour "],201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $Client =Clients::find($id);

        if (!$Client) {
            return response(["message" => "Il n'a pas trouvé Client id $id"], 404);
        }
        $value= Clients::destroy($id);
        if(boolval($value)==false){
            return response(['message'=>"Il n'a pas trouvé Clients id $id"],404);
        }
        return response(['message'=>'Clients a ete supprimer ']);
    }
}
