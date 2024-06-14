<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transactionx extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'transactionxes';

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const TYPE_SELECT = [
        '1' => 'Yeni',
        '2' => 'Onaylandı',
        '3' => 'Reddedildi',
    ];

    protected $fillable = [
        'type',
        'amount',
        'commission_rate',
        'commission',
        'amount_net',
        'date',
        'payer_id',
        'payment_method_id',
        'site_id',
        'client_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function payer()
    {
        return $this->belongsTo(Payer::class, 'payer_id');
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function site()
    {
        return $this->belongsTo(ClientSite::class, 'site_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
