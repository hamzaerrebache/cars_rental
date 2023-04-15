<?php

namespace App\Http\Controllers;

use App\Models\vehicules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehiculesController extends Controller
{
 /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicule =vehicules::all();
        if (count($vehicule) <= 0) {
            return response(["message" => "Il n'a pas trouvé Vehicules"], 200);
        }
        return response()->json(['Vehicules' => $vehicule]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "maked" => ['required', 'string'],
            "model" => ['required', 'string'],
            'year' => 'required|date',
            "color" => ['required', 'string'],
            "mileage" => ['required', 'numeric'],
            "fuel_type" => ['required', 'string'],
            "daily_price" => ['required', 'numeric'],
            "weekly_price" => ['required', 'numeric'],
            "monthly_price" => ['required', 'numeric'],
            "availabilty" => ['required', 'string'],
            "agency_id" => ['required', 'numeric'],
        ]);
        $dataVehicules = vehicules::create([
            "maked" => $validatedData['maked'],
            "model" => $validatedData['model'],
             'year' => $validatedData['year'],
            "color" => $validatedData['color'],
          "mileage" => $validatedData['mileage'],
        "fuel_type" => $validatedData['fuel_type'],
      "daily_price" => $validatedData['daily_price'],
     "weekly_price" => $validatedData['weekly_price'],
    "monthly_price" => $validatedData['monthly_price'],
      "availabilty" => $validatedData['availabilty'],
        "agency_id" => $validatedData['agency_id'],

  ]);
  
  return response()->json(['Vehicules' =>  $dataVehicules, 'message' => 'Vehicules ajoutée']);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Vehicule =DB::table('vehicules')
        ->join('agences','vehicules.agency_id','=','agences.id')
        ->select('vehicules.*','agences.agency_name')
        ->where('vehicules.id','=',$id)
        ->get()
        ->first();
        return $Vehicule;

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            "maked" => ['required', 'string'],
            "model" => ['required', 'string'],
            'year' => 'required|date',
            "color" => ['required', 'string'],
            "mileage" => ['required', 'numeric'],
            "fuel_type" => ['required', 'string'],
            "daily_price" => ['required', 'numeric'],
            "weekly_price" => ['required', 'numeric'],
            "monthly_price" => ['required', 'numeric'],
            "availabilty" => ['required', 'string'],
            "agency_id" => ['required', 'numeric'],
        ]);
        $Vehicule =vehicules::find($id);
        if (!$Vehicule) {
            return response(["message" => "Il n'a pas trouvé Vehicule id $id"], 200);
        }
        if($Vehicule->agency_id != $validatedData["agency_id"]){

          return response(['message'=>'action interdite'],403);
        }
        $Vehicule->update($validatedData);
        return response(['message'=>"Vehicule mise a jour "],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete (Request $request, $id)
    {
        $validatedData = $request->validate([
            "agency_id" => ['required', 'numeric']
        ]);
        $vehicule =vehicules::find($id);

        if (!$vehicule) {
            return response(["message" => "Il n'a pas trouvé vehicules id $id"], 404);
        }
        if($vehicule->agency_id!= $validatedData['agency_id']){
          return response(['message'=>'action interdite'],403);
        }
        $value= vehicules::destroy($id);
        if(boolval($value)==false){
            return response(['message'=>"Il n'a pas trouvé vehicules id $id"],404);
        }
        return response(['message'=>'vehicules a ete supprimer ']);
    }
}
