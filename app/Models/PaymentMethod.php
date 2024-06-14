<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use Uuids;

    use SoftDeletes, Auditable, HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    public $table = 'payment_methods';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function paymentMethodClientPaymentMethods()
    {
        return $this->hasMany(ClientPaymentMethod::class, 'payment_method_id', 'id');
    }

    public function paymentMethodTransactionxes()
    {
        return $this->hasMany(Transactionx::class, 'payment_method_id', 'id');
    }

    public function paymentMethodClientSites()
    {
        return $this->belongsToMany(ClientSite::class);
    }
}
