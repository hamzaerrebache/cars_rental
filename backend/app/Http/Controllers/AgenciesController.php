<?php

namespace App\Http\Controllers;

use App\Models\agencies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AgenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return  Illuminate\Http\Response
     */
    public function index()
    {
        $agence=agencies::all();
        if (count($agence) <= 0) {
            return response(["message" => "Il n'a pas trouvé d'Agencies"], 200);
        }
        return response()->json(['Agencies' => $agence]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "agency_name" => ['required', 'string'],
            "description" => ['required', 'string'],
            "logo_agence" => ['string', 'min:5'],
            "user_id" => ['required', 'numeric']
        ]);

        $dataAgence = agencies::create([
            'agency_name' => $validatedData['agency_name'],
            'description' => $validatedData['description'],
            'user_id' => $validatedData['user_id']
        ]);
        return response()->json(['Agencies' => $dataAgence, 'message' => 'Agence ajoutée']);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $agence =DB::table('agences')
        ->join('users','agences.user_id','=','users.id')
        ->select('agences.*','users.name','users.email')
        ->where('agences.id','=',$id)
        ->get()
        ->first();
        return $agence;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            "agency_name" => ['required', 'string'],
            "description" => ['required', 'string'],
            "logo_agence" => ['string', 'min:5'],
            "user_id" => ['required', 'numeric']
        ]);

        $agence =agencies::find($id);
        if (!$agence) {
            return response(["message" => "Il n'a pas trouvé d'Agencies id $id"], 200);
        }
        if($agence->user_id != $validatedData["user_id"]){

          return response(['message'=>'action interdite'],403);
        }
        $agence->update($validatedData);
        return response(['message'=>"l'agence mise a jour "],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete (Request $request, $id )
    {
        $validatedData = $request->validate([
            "user_id" => ['required', 'numeric']
        ]);
        $agence =agencies::find($id);

        if (!$agence) {
            return response(["message" => "Il n'a pas trouvé d'Agencies id $id"], 404);
        }
        if($agence->user_id != $validatedData['user_id']){
          return response(['message'=>'action interdite'],403);
        }
        $value= agencies::destroy($id);
        if(boolval($value)==false){
            return response(['message'=>"Il n'a pas trouvé d'Agencies id $id"],404);
        }
        return response(['message'=>'agence a ete supprimer ']);
    
    }
    /**
     * Search the specified resource from storage.
     */
}
