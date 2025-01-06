<?php

namespace App\Exports;

use App\Models\Intermediary;
use Maatwebsite\Excel\Concerns\FromCollection;

class IntermediaryExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Intermediary::all();
    }
}
