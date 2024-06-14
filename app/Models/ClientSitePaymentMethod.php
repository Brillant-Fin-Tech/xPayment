<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientSitePaymentMethod extends Model
{
    use Uuids;

    use SoftDeletes, Auditable, HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    public $table = 'client_site_payment_methods';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'client_payment_method_id',
        'client_site_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function client_payment_method()
    {
        return $this->belongsTo(ClientPaymentMethod::class, 'client_payment_method_id');
    }

    public function client_site()
    {
        return $this->belongsTo(ClientSite::class, 'client_site_id');
    }
}
