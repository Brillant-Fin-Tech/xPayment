<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayerSite extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'payer_sites';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'currency_code',
        'wallet_address',
        'base_currency_code',
        'email',
        'phone',
        'customer_kyc',
        'external_customer',
        'response_url',
        'payer_id',
        'site_id',
        'payment_method_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function payer()
    {
        return $this->belongsTo(Payer::class, 'payer_id');
    }

    public function site()
    {
        return $this->belongsTo(ClientSite::class, 'site_id');
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }
}
