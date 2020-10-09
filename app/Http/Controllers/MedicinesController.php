<?php

namespace App\Http\Controllers;

use App\inv_logs;
use App\medicines;
use App\Http\Requests\medicinesStoreRequest;
use App\Http\Requests\medicinesUpdateRequest;
use Illuminate\Http\Request;

class MedicinesController extends Controller
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
            $med = medicines::where('medical_name','LIKE','%' . $query . '%')
                ->orderBy('medical_name','asc')
                -> paginate(10);
            return view('medicines.index', ['medicines'=>$med, 'search'=>$query]);
        }

        //$datashow['medicines'] = medicines::paginate(10);
        //return view('medicines.index',$datashow);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medicines.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(medicinesStoreRequest $request)
    {
        $medicinesData = request()->except('_token');
        medicines::insert($medicinesData);
        return redirect('medicines')->with('alert','REGISTRO AGREGADO!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\medicines  $medicines
     * @return \Illuminate\Http\Response
     */
    public function show(medicines $medicines)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\medicines  $medicines
     * @return \Illuminate\Http\Response
     */
    public function edit($id_medical)
    {
        $medicineCatcher = medicines::findOrFail($id_medical);
        return view('medicines.edit', compact('medicineCatcher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\medicines  $medicines
     * @return \Illuminate\Http\Response
     */
    public function update(medicinesUpdateRequest $request, $id_medical)
    {
        $getData = medicines::findOrFail($id_medical);
        $medicinesDataToUpdate = request()->except(['_token','_method']);
        inv_logs::insert([ 'serial' => $getData['serial'],'item' => $getData['medical_name'],
        'new_amount' => $medicinesDataToUpdate['stock'],'old_amount' => $getData['stock'],'type' => 'Medicamento',
        'operation' => 'Modificacion']);
        medicines::where('id_medical', "=", $id_medical)->update($medicinesDataToUpdate);
        return redirect('medicines')->with('alert','REGISTRO MODIFICADO!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\medicines  $medicines
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_medical)
    {
        $getData = medicines::findOrFail($id_medical);
        inv_logs::insert([ 'serial' => $getData['serial'],'item' => $getData['medical_name'],
        'new_amount' => 0,'old_amount' => $getData['stock'],'type' => 'Medicamento',
        'operation' => 'De Baja']);
        medicines::destroy($id_medical); 
        return redirect('medicines')->with('alert','REGISTRO ELIMINADO!');
    }
}
