<?php

namespace App\Http\Controllers;

use App\inv_logs;
use App\medical_supplies;
use App\Http\Requests\medicalSuppliesStoreRequest;
use App\Http\Requests\medicalSuppliesUpdateRequest;
use Illuminate\Http\Request;

class MedicalSuppliesController extends Controller
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
            $md = medical_supplies::where('supply_name','LIKE','%' . $query . '%')
                ->orderBy('supply_name','asc')
                -> paginate(10);
            return view('medical_supplies.index', ['medical_supplies'=>$md, 'search'=>$query]);
        }


        //$datashow['medical_supplies'] = medical_supplies::paginate(10);
        //return view('medical_supplies.index',$datashow);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medical_supplies.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(medicalSuppliesStoreRequest $request)
    {
        $medical_suppliesData = request()->except('_token');
        medical_supplies::insert($medical_suppliesData);
        return redirect('medical_supplies')->with('alert','REGISTRO AGREGADO!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\medical_supplies  $medical_supplies
     * @return \Illuminate\Http\Response
     */
    public function show(medical_supplies $medical_supplies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\medical_supplies  $medical_supplies
     * @return \Illuminate\Http\Response
     */
    public function edit($id_medical_supply)
    {
        $medicalSupplyCatcher = medical_supplies::findOrFail($id_medical_supply);
        return view('medical_supplies.edit', compact('medicalSupplyCatcher'));
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\medical_supplies  $medical_supplies
     * @return \Illuminate\Http\Response
     */
    public function update(medicalSuppliesUpdateRequest $request, $id_medical_supply)
    {
        $getData = medical_supplies::findOrFail($id_medical_supply);
        $medical_suppliesDataToUpdate = request()->except(['_token','_method']);
        inv_logs::insert([ 'serial' => $getData['serial'],'item' => $getData['supply_name'],
        'new_amount' => $medical_suppliesDataToUpdate['stock'],'old_amount' => $getData['stock'],'type' => 'Suministro Medico',
        'operation' => 'Modificacion']);
        medical_supplies::where('id_medical_supply', "=", $id_medical_supply)->update($medical_suppliesDataToUpdate);
        return redirect('medical_supplies')->with('alert','REGISTRO MODIFICADO!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\medical_supplies  $medical_supplies
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_medical_supply)
    {
        $getData = medical_supplies::findOrFail($id_medical_supply);
        inv_logs::insert([ 'serial' => $getData['serial'],'item' => $getData['supply_name'],
        'new_amount' => 0,'old_amount' => $getData['stock'],'type' => 'Suministro Medico',
        'operation' => 'De Baja']);
        medical_supplies::destroy($id_medical_supply); 
        return redirect('medical_supplies')->with('alert','REGISTRO ELIMINADO!');
    }
}
