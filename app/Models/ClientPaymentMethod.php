<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientPaymentMethod extends Model
{

    use Uuids;

    use SoftDeletes, Auditable, HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    public $table = 'client_payment_methods';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'client_id',
        'payment_method_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }
}
