<?php

namespace App\Http\Controllers;

use App\inv_logs;
use Illuminate\Http\Request;

class InvLogsController extends Controller
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
            $ic = inv_logs::where('item','LIKE','%' . $query . '%')
                ->orderBy('item','asc')
                -> paginate(10);
            return view('inv_logs.index', ['inv_logs'=>$ic, 'search'=>$query]);
        }

       // $datashow['inv_logs'] = inv_logs::paginate(10);
        //return view('inv_logs.index',$datashow);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\inv_logs  $inv_logs
     * @return \Illuminate\Http\Response
     */
    public function show(inv_logs $inv_logs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\inv_logs  $inv_logs
     * @return \Illuminate\Http\Response
     */
    public function edit(inv_logs $inv_logs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\inv_logs  $inv_logs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, inv_logs $inv_logs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\inv_logs  $inv_logs
     * @return \Illuminate\Http\Response
     */
    public function destroy(inv_logs $inv_logs)
    {
        //
    }
}
