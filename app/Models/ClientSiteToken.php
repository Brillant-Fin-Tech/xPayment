<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientSiteToken extends Model
{
    use Uuids;

    use SoftDeletes, Auditable, HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    public $table = 'client_site_tokens';

    public const IS_ACTIVE_SELECT = [
        '1' => 'Active',
        '0' => 'Passive',
    ];

    protected $dates = [
        'expires_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'token',
        'expires_at',
        'is_active',
        'client_site_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getExpiresAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setExpiresAtAttribute($value)
    {
        $this->attributes['expires_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function client_site()
    {
        return $this->belongsTo(ClientSite::class, 'client_site_id');
    }
}
