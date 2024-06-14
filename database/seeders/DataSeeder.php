<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\ClientPaymentMethod;
use App\Models\ClientSite;
use App\Models\ClientSitePaymentMethod;
use App\Models\ClientSiteToken;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DataSeeder extends Seeder
{
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");

        PaymentMethod::truncate();

        $paymentMethods = [
            [
                'name' => 'Paybis',
            ],
            [
                'name' => 'Yöntem 2',
            ],
            [
                'name' => 'Yöntem 3',
            ],
        ];

        foreach ($paymentMethods as $paymentMethod) {
            PaymentMethod::create($paymentMethod);
        }


        Client::truncate();
        ClientPaymentMethod::truncate();
        User::truncate();
        $users =
            [
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ];

        $user = User::create($users);
        $user->roles()->attach(1);
        $clients = [
            [
                'name' => 'Client 1',
                'email' => 'client1@client.com',
            ],
            [
                'name' => 'Client 2',
                'email' => 'client2@client.com',
            ],
            [
                'name' => 'Client 3',
                'email' => 'client3@client.com',
            ],
            [
                'name' => 'Client 4',
                'email' => 'client4@client.com',
            ],
        ];
        foreach ($clients as $client) {
            $added = Client::create([
                "name" => $client['name'],
            ]);

            User::create([
                'name'=>$client["name"],
                'email'=>$client["email"],
                'password'=>bcrypt('password'),
                'client_id'=>$added->id,
            ]);

            $paymentMethod = PaymentMethod::inRandomOrder()->first();
            $added->clientClientPaymentMethods()->create([
                "name"=>$paymentMethod->name,
                'payment_method_id'=>$paymentMethod->id,
            ]);
        }




/*
        ClientSite::truncate();
        ClientSiteToken::truncate();

        $ClientSites = [
            [
                'id' => 1,
                'domain' => 'abc1.com',
                'client_id' => 1,
            ],
            [
                'id' => 2,
                'domain' => 'abc2.com',
                'client_id' => 1,
            ],
            [
                'id' => 3,
                'domain' => 'abc3.com',
                'client_id' => 1,
            ],
            [
                'id' => 4,
                'domain' => 'xxx.com',
                'client_id' => 2,
            ],
            [
                'id' => 5,
                'domain' => '123123.com',
                'client_id' => 3,
            ],
            [
                'id' => 6,
                'domain' => 'qweqwe.com',
                'client_id' => 4,
            ],
        ];
        foreach ($ClientSites as $ClientSite) {
            $added = ClientSite::create($ClientSite);
            $added->payment_methods()->sync(ClientPaymentMethod::where("client_id", $added->client_id)->pluck("payment_method_id"));
            $added->clientSiteClientSiteTokens()->create([
                'token'=>Str::random(60),
                'expires_at'=>"2030-01-01 00:00:00",
                'is_active'=>1
            ]);
        }*/


        DB::statement("SET foreign_key_checks=1");

    }
}
