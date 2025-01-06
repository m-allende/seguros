<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Cobertura extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'coberturas';

    protected $fillable = [
        'name',
        'abbreviation',
        'code',
        'type_id',
        'tax',
        'expressed_in_id',
        'ramo_id'
    ];

    public function ramo()
    {
        return $this->belongsTo(Ramo::class);
    }

    public function type()
    {
        return $this->belongsTo(Code::class);
    }

    public function expressed_in()
    {
        return $this->belongsTo(Code::class);
    }
}
