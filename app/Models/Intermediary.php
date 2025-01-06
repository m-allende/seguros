<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Intermediary extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'intermediaries';

    protected $fillable = [
        'identification',
        'name',
        'type_id',
        'intermediate_id',
        'last_name',
        'mother_last_name',
        'full_name',
        'abbreviation',
        'birthdate',
        'profesion',
        'marital_status_id',
        'gender_id',
    ];

    public function type()
    {
        return $this->belongsTo(Code::class);
    }

    public function marital_status()
    {
        return $this->belongsTo(Code::class, 'marital_status_id');
    }

    public function gender()
    {
        return $this->belongsTo(Code::class, 'gender_id');
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
}
