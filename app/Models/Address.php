<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Address extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'address',
        'latitude',
        'longitude',
        'commune_id',
        'type_id',
    ];
    public function parent()
    {
        return $this->morphTo();
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

}
