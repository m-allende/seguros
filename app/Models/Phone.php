<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Phone extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $fillable = ["phone", "id", "parent_type", "created_at"];

    public function parent()
    {
        return $this->morphTo();
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
