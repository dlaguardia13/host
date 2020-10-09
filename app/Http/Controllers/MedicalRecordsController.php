<?php

namespace App\Http\Controllers;

use App\medical_records;
use App\Http\Requests\medicalRecordsStoreRequest;
use App\Http\Requests\medicalRecordsUpdateRequest;
use Illuminate\Http\Request;

class MedicalRecordsController extends Controller
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
            $ow = medical_records::where('owner','LIKE','%' . $query . '%')
                ->orderBy('owner','asc')
                -> paginate(10);
            return view('medical_records.index', ['medical_records'=>$ow, 'search'=>$query]);
        }

        //$datashow['medical_records'] = medical_records::paginate(10);
        //return view('medical_records.index',$datashow);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medical_records.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(medicalRecordsStoreRequest $request)
    {
        $medical_recordsData = request()->except('_token');
        medical_records::insert($medical_recordsData);
        return redirect('medical_records')->with('alert','REGISTRO AGREGADO!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\medical_records  $medical_records
     * @return \Illuminate\Http\Response
     */
    public function show(medical_records $medical_records)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\medical_records  $medical_records
     * @return \Illuminate\Http\Response
     */
    public function edit($id_medical_record)
    {
        $medicalRecordCatcher = medical_records::findOrFail($id_medical_record);
        return view('medical_records.edit', compact('medicalRecordCatcher'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\medical_records  $medical_records
     * @return \Illuminate\Http\Response
     */
    public function update(medicalRecordsUpdateRequest $request, $id_medical_record)
    {
        $medicalRecordsDataToUpdate = request()->except(['_token','_method']);
        medical_records::where('id_medical_record', "=", $id_medical_record)->update($medicalRecordsDataToUpdate);
        return redirect('medical_records')->with('alert','REGISTRO MODIFICADO!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\medical_records  $medical_records
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_medical_record)
    {
        medical_records::destroy($id_medical_record);
        return redirect('medical_records')->with('alert','REGISTRO ELIMINADO!');
    }
}
