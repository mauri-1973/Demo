<?php

namespace App\Jobs;

use App\Models\Dollar;
use App\Models\Payment;
use App\Models\Clients;
use Illuminate\Bus\Queueable;
use App\Jobs\SendEmailJob;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use GuzzleHttp\Client;

class DollarValidate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $apiActionName;
    protected $paydate;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($apiActionName, $paydate)
    {
        $this->apiActionName = $apiActionName;
        $this->paydate = $paydate;
    }

    /**
     * Execute the job.
     * Busca si la fecha que viene como parámetro se encuentra el la tabla de valores del dollar
     * Si no la encuentra utiliza la api para actualizar la tabla
     * Si la encuentra rescata el valor para la fecha correspondiente
     * @return void
     */
    public function handle()
    {
        $fecha = date("Y-m-d", strtotime($this->paydate));
        $fecha2 = date("d-m-Y", strtotime($this->paydate));
        $valdollar = 0;
        $val = Dollar::select('*')->whereDate('date_dollar', '=', $fecha)->count();
        switch (true) {
            case ($val  == 0):
                $client = new Client(); //GuzzleHttp\Client
                $url = "https://mindicador.cl/api/dolar/".$fecha2;
                $response = $client->request('GET', $url, [
                    'verify'  => false,
                ]);
                $responseBody = json_decode($response->getBody());
                foreach($responseBody->serie as $row)
                {
                    $valdollar = round($row->valor, 2);
                    Dollar::insert([
                        'amount_dollar' => round($row->valor, 2),
                        'date_dollar' => date("Y-m-d", strtotime($row->fecha)),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
                $this->enterpayment($this->apiActionName, $valdollar);
            break;
            
            default:
                $val = Dollar::select('*')->whereDate('date_dollar', '=', $fecha)->first();
                $this->enterpayment($this->apiActionName, $val->amount_dollar);
            break;
        }
    }
    /**
     * Funcion para actualizar la tabla de pagos de clientes.
     *
     * @return void
     */
    private function enterpayment($object = null, $cash = null)
    {
        $object = $object;
        $cash = $cash;
        $val = Payment::where('uuid', $object["idpay"])->update(['payment_date' => $object["paydate"], "usd_clp" => $cash, "status" => "pay"]);
        $email = Clients::select('email')->where("id", $object["idcli"])->first();
        $details['email'] = $email->email;
        dispatch(new SendEmailJob($details));
        return response()->json(['message'=>'Mail Send Successfully!!']);
    }
}
