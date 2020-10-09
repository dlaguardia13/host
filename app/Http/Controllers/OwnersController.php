<?php

namespace App\Http\Controllers;

use App\owners;
use Illuminate\Http\Request;
use App\Http\Requests\ownersStoreRequest;
use App\Http\Requests\ownersUpdateRequest;

class OwnersController extends Controller
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
            $ow = owners::where('owner_name','LIKE','%' . $query . '%')
                ->orderBy('owner_name','asc')
                -> paginate(10);
            return view('owners.index', ['owners'=>$ow, 'search'=>$query]);
        }

        //$datashow['owners'] = owners::paginate(10);
        //return view('owners.index',$datashow);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owners.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ownersStoreRequest $request)
    {
        $ownersData = request()->except('_token');
        owners::insert($ownersData);
        return redirect('owners')->with('alert','REGISTRO AGREGADO!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\owners  $owners
     * @return \Illuminate\Http\Response
     */
    public function show(owners $owners)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\owners  $owners
     * @return \Illuminate\Http\Response
     */
    public function edit($id_owner)
    {
        $ownerCatcher = owners::findOrFail($id_owner);
        return view('owners.form_edit', compact('ownerCatcher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\owners  $owners
     * @return \Illuminate\Http\Response
     */
    public function update(ownersUpdateRequest $request, $id_owner)
    {
        $ownersDataToUpdate = request()->except(['_token','_method']);
        owners::where('id_owner', "=", $id_owner)->update($ownersDataToUpdate);
        return redirect('owners')->with('alert','REGISTRO MODIFICADO!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\owners  $owners
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_owner)
    {
        owners::destroy($id_owner); 
        return redirect('owners')->with('alert','REGISTRO ELIMINADO!');
    }
}
