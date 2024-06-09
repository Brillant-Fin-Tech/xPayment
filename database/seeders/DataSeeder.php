<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\ClientPaymentMethod;
use App\Models\ClientSite;
use App\Models\ClientSitePaymentMethod;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSeeder extends Seeder
{
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");

        PaymentMethod::truncate();

        $paymentMethods = [
            [
                'id' => 1,
                'name' => 'Paybis',
            ],
            [
                'id' => 2,
                'title' => 'Yöntem 2',
            ],
            [
                'id' => 3,
                'title' => 'Yöntem 3',
            ],
        ];

        PaymentMethod::insert($paymentMethods);


        Client::truncate();

        $clients = [
            [
                'id' => 1,
                'name' => 'Client 1',
                'domain' => "abc.com"
            ],
            [
                'id' => 2,
                'name' => 'Client 2',
                'domain' => "xxx.com"
            ],
            [
                'id' => 3,
                'name' => 'Client 3',
                'domain' => "123123.com"
            ],
            [
                'id' => 4,
                'name' => 'Client 4',
                'domain' => "qweqwe.com"
            ],
        ];

        Client::insert($clients);


        ClientPaymentMethod::truncate();

        $datas = [
            [
                'id' => 1,
                'name' => '1',
                'client_id' => 1,
                'payment_method_id' => 1,
            ],
            [
                'id' => 2,
                'name' => '2',
                'client_id' => 1,
                'payment_method_id' => 2,
            ],
            [
                'id' => 3,
                'name' => '3',
                'client_id' => 2,
                'payment_method_id' => 1,
            ],
            [
                'id' => 4,
                'name' => '4',
                'client_id' => 3,
                'payment_method_id' => 3,
            ],
        ];

        ClientPaymentMethod::insert($datas);


        ClientSite::truncate();

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

        ClientSite::insert($ClientSites);


        ClientSitePaymentMethod::truncate();

        $ClientSitePaymentMethods = [
            [
                'id' => 1,
                'client_site_id' => 1,
                'client_payment_method_id' => 1,
            ],
            [
                'id' => 2,
                'client_site_id' => 1,
                'client_payment_method_id' => 2,
            ],
            [
                'id' => 3,
                'client_site_id' => 2,
                'client_payment_method_id' => 1,
            ],
        ];

        ClientSitePaymentMethod::insert($ClientSitePaymentMethods);

        DB::statement("SET foreign_key_checks=1");

    }
}
