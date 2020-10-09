<?php

namespace App\Http\Controllers;

use App\pets;
use Illuminate\Http\Request;
use App\Http\Requests\petsStoreRequest;
use App\Http\Requests\petsUpdateRequest;
use PhpParser\Node\Expr\Cast\String_;

class PetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request){
            $query = trim($request->get('search'));
            $pet = pets::where('nickname','LIKE','%' . $query . '%')
                ->orderBy('nickname','asc')
                -> paginate(10);
            return view('pets.index', ['pets'=>$pet, 'search'=>$query]);
        }
       
       // $datashow['pets'] = pets::paginate(10);
       // return view('pets.index',$datashow);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pets.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     /*public function generateUniqueCode(String $x,int $y)
     {
        if($x == "Canino")
        {
            $x = "CAN-".$y;
        }elseif($x == "Felino")
		{
			$x = "FEL-".$y;
		}

        return $x; 
     }*/
    public function store(petsStoreRequest $request)
    {
        $petsData = request()->except('_token');
        if($petsData['species'] == "Canino")
        {
            $petsData['unique_code'] = "CAN-".$petsData['unique_code'];
        }elseif($petsData['species'] == "Felino")
		{
			$petsData['unique_code'] = "FEL-".$petsData['unique_code'];
		}
        pets::insert($petsData);
        return redirect('pets')->with('message','REGISTRO AGREGADO!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\pets  $pets
     * @return \Illuminate\Http\Response
     */
    public function show(pets $pets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\pets  $pets
     * @return \Illuminate\Http\Response
     */
    public function edit($id_pet)
    {
        $petCatcher = pets::findOrFail($id_pet);
        return view('pets.edit', compact('petCatcher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pets  $pets
     * @return \Illuminate\Http\Response
     */
    public function update(petsUpdateRequest $request, $id_pet)
    {
        $petsDataToUpdate = request()->except(['_token','_method']);
        pets::where('id_pet', "=", $id_pet)->update($petsDataToUpdate);
        return redirect('pets')->with('message','REGISTRO MODIFICADO!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\pets  $pets
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_pet)
    {
        pets::destroy($id_pet); 
        return redirect('pets')->with('message','REGISTRO ELIMINADO!');
    }
}
