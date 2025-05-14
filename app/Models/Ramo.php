<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Ramo extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'abbreviation',
        'type_id',
    ];

    public function type()
    {
        return $this->belongsTo(Code::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_ramo')
                    ->withTimestamps()
                    ->withPivot('deleted_at')
                    ->wherePivotNull('deleted_at')
                    ->whereNull('companies.deleted_at'); // opcional: evita compañias eliminadas
    }

}
