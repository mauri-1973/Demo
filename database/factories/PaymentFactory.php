<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $idinitial = Client::select('*')->limit(1)->inRandomOrder()->first();
        $paystatus = rand(0,1);
        $uuid = Str::uuid(36);
        switch($paystatus)
        {
            //estado pago pendiente
            case 0:
                $fechainicial = $this->faker->dateTimeBetween('-2 days', now())->format('Y-m-d');
                $paystatus = rand(800,999);
                return [
                    'uuid' => $uuid,
                    'expires_at' => $this->faker->dateTimeBetween(now(), '+5 days')->format('Y-m-d'),
                    'status' => "pending",
                    'client_id' => $idinitial->id,
                    'clp_usd' => $paystatus,
                ];
            break;
            //estado pago pagado
            case 1:
                $fechainicial = $this->faker->dateTimeBetween('-2 days', now())->format('Y-m-d');
                $paystatus = rand(800,999);
                return [
                    'uuid' => $uuid,
                    'payment_date' => $this->faker->dateTimeBetween('-4 days', now())->format('Y-m-d'),
                    'expires_at' => $this->faker->dateTimeBetween(now(), '+5 days')->format('Y-m-d'),
                    'status' => "pay",
                    'client_id' => $idinitial->id,
                    'clp_usd' => rand(800,999),
                    'usd_clp' => rand(800,999),
                ];
            break;
        }
    }
}
