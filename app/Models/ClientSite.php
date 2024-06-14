<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientSite extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'client_sites';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'domain',
        'client_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function clientSiteClientSiteTokens()
    {
        return $this->hasMany(ClientSiteToken::class, 'client_site_id', 'id');
    }

    public function siteTransactionxes()
    {
        return $this->hasMany(Transactionx::class, 'site_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function payment_methods()
    {
        return $this->belongsToMany(PaymentMethod::class);
    }
}
