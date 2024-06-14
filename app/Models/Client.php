<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use Uuids;

    use SoftDeletes, Auditable, HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    public $table = 'clients';

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

    public function clientClientPaymentMethods()
    {
        return $this->hasMany(ClientPaymentMethod::class, 'client_id', 'id');
    }

    public function clientClientSites()
    {
        return $this->hasMany(ClientSite::class, 'client_id', 'id');
    }

    public function clientUsers()
    {
        return $this->hasMany(User::class, 'client_id', 'id');
    }

    public function clientTransactionxes()
    {
        return $this->hasMany(Transactionx::class, 'client_id', 'id');
    }
}
