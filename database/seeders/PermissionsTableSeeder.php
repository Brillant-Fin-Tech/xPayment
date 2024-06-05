<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 21,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 22,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 23,
                'title' => 'payer_create',
            ],
            [
                'id'    => 24,
                'title' => 'payer_edit',
            ],
            [
                'id'    => 25,
                'title' => 'payer_show',
            ],
            [
                'id'    => 26,
                'title' => 'payer_delete',
            ],
            [
                'id'    => 27,
                'title' => 'payer_access',
            ],
            [
                'id'    => 28,
                'title' => 'payment_method_create',
            ],
            [
                'id'    => 29,
                'title' => 'payment_method_edit',
            ],
            [
                'id'    => 30,
                'title' => 'payment_method_show',
            ],
            [
                'id'    => 31,
                'title' => 'payment_method_delete',
            ],
            [
                'id'    => 32,
                'title' => 'payment_method_access',
            ],
            [
                'id'    => 33,
                'title' => 'client_create',
            ],
            [
                'id'    => 34,
                'title' => 'client_edit',
            ],
            [
                'id'    => 35,
                'title' => 'client_show',
            ],
            [
                'id'    => 36,
                'title' => 'client_delete',
            ],
            [
                'id'    => 37,
                'title' => 'client_access',
            ],
            [
                'id'    => 38,
                'title' => 'client_management_access',
            ],
            [
                'id'    => 39,
                'title' => 'client_payment_method_create',
            ],
            [
                'id'    => 40,
                'title' => 'client_payment_method_edit',
            ],
            [
                'id'    => 41,
                'title' => 'client_payment_method_show',
            ],
            [
                'id'    => 42,
                'title' => 'client_payment_method_delete',
            ],
            [
                'id'    => 43,
                'title' => 'client_payment_method_access',
            ],
            [
                'id'    => 44,
                'title' => 'client_site_create',
            ],
            [
                'id'    => 45,
                'title' => 'client_site_edit',
            ],
            [
                'id'    => 46,
                'title' => 'client_site_show',
            ],
            [
                'id'    => 47,
                'title' => 'client_site_delete',
            ],
            [
                'id'    => 48,
                'title' => 'client_site_access',
            ],
            [
                'id'    => 49,
                'title' => 'client_site_token_create',
            ],
            [
                'id'    => 50,
                'title' => 'client_site_token_edit',
            ],
            [
                'id'    => 51,
                'title' => 'client_site_token_show',
            ],
            [
                'id'    => 52,
                'title' => 'client_site_token_delete',
            ],
            [
                'id'    => 53,
                'title' => 'client_site_token_access',
            ],
            [
                'id'    => 54,
                'title' => 'client_site_payment_method_create',
            ],
            [
                'id'    => 55,
                'title' => 'client_site_payment_method_edit',
            ],
            [
                'id'    => 56,
                'title' => 'client_site_payment_method_show',
            ],
            [
                'id'    => 57,
                'title' => 'client_site_payment_method_delete',
            ],
            [
                'id'    => 58,
                'title' => 'client_site_payment_method_access',
            ],
            [
                'id'    => 59,
                'title' => 'payer_management_access',
            ],
            [
                'id'    => 60,
                'title' => 'transaction_create',
            ],
            [
                'id'    => 61,
                'title' => 'transaction_edit',
            ],
            [
                'id'    => 62,
                'title' => 'transaction_show',
            ],
            [
                'id'    => 63,
                'title' => 'transaction_delete',
            ],
            [
                'id'    => 64,
                'title' => 'transaction_access',
            ],
            [
                'id'    => 65,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
