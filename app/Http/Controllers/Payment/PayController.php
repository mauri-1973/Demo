<?php

namespace App\Http\Controllers\Payment;

use App\Http\Resources\PayResourse;
use App\Models\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Jobs\DollarValidate;
use DataTables;

class PayController extends Controller
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
            $products = PayResourse::collection(Payment::select("*")->where("client_id", $request["iduser"])->get());
            foreach ($products as $key => $property)
            {
                $datepayment = "";
                if($property->payment_date != null)
                {
                   $datepayment =  date("Y-m-d", strtotime($property->payment_date->toDateTimeString())); 
                }
                $dateexpires = "";
                if($property->expires_at != null)
                {
                   $dateexpires =  date("Y-m-d", strtotime($property->expires_at->toDateTimeString())); 
                }
                array_push($arreglo, array("uuid" => $property->uuid, "payment_date" => $datepayment, "expires_at" => $dateexpires, "status" => $property->status, "client_id" => $property->client_id, "clp_usd" => $property->clp_usd, "usd_clp" => $property->usd_clp, "total" => "$ ".number_format(($property->clp_usd * $property->usd_clp), 0, '.', '')));
            }
            return Datatables::of($arreglo)->addIndexColumn()
                ->addColumn('action', function($row){
                    $dol = $row["usd_clp"];
                    if($row["usd_clp"] == "" || $row["usd_clp"] == null)
                    {
                        $dol = 0;
                    }
                    if($row["status"] == "pay")
                    {
                        $btn = '<button onclick="initial()" class="btn btn-primary btn-sm btn-block">Back</button>';
                    }
                    else
                    {
                        $btn = '<button onclick="initial()" class="btn btn-primary btn-sm btn-block">Back</button>&nbsp;<button onclick="addpay(\''.$row["uuid"].'\', \''.$row["payment_date"].'\', \''.$row["expires_at"].'\', \''.$row["status"].'\', '.$row["client_id"].', '.$row["clp_usd"].', '.$dol.')" class="btn btn-success btn-sm btn-block">Add Pay</button>';
                    }
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
        
        $this->validate($request,[
            'idpay'=>'required',
            'paydate'=>'required',
            'expdate'=>'required',
            'status'=>'required',
            'idcli'=>'required',
            'pay'=>'required',
            'idpay'=>'required',
            'dolvalue'=>'required',
         ]);
         DollarValidate::dispatchNow($request->all(), $request->paydate);
         return redirect()->route('home')->with('success', "El registro fue actualizado correctamente");
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
