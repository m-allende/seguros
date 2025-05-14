<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Company extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'identification',
        'short_name',
        'abbreviation',
        'website',
        'type_id',
    ];

    public function type()
    {
        return $this->belongsTo(Code::class);
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, "parent");
    }

    public function emails()
    {
        return $this->morphMany(Email::class, "parent");
    }

    public function phones()
    {
        return $this->morphMany(Phone::class, "parent");
    }

    public function photo()
    {
        return $this->morphOne(Photo::class, "parent");
    }

    public function ramos()
    {
        return $this->belongsToMany(Ramo::class, 'company_ramo')
                    ->withTimestamps()
                    ->withPivot('deleted_at')
                    ->wherePivotNull('deleted_at')
                    ->whereNull('ramos.deleted_at'); // opcional: evita ramos eliminados
    }

}
