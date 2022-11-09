<?php

namespace Database\Factories;

use App\Models\Dollar;
use GuzzleHttp\Client;

use Illuminate\Database\Eloquent\Factories\Factory;

class DollarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $client = new Client(); //GuzzleHttp\Client
        $url = "https://mindicador.cl/api/dolar";


        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);
        $responseBody = json_decode($response->getBody());
        foreach($responseBody->serie as $row)
        {
            return[
                'amount_dollar' => round($row->valor, 2),
                'date_dollar' => date("Y-m-d", strtotime($row->fecha)),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
    }
}










