<?php

namespace App\Http\Controllers\Client;

use App\Models\Client;
use App\Http\Resources\ClientResourse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $arreglo = array();
            $products = ClientResourse::collection(Client::all());
            foreach ($products as $key => $property)
            {
                array_push($arreglo, array("id" => $property->id, "email" => $property->email, "join_date" => date("d-m-Y", strtotime($property->join_date->toDateTimeString()))));
            }
            $data = Client::select('id','email','join_date')->get();
            return Datatables::of($arreglo)->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<button onclick="viewhistory('.$row["id"].')" class="btn btn-primary btn-sm">View History</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
