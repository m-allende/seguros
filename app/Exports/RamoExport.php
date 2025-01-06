<?php

namespace App\Exports;

use App\Models\Ramo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Foundation\Bus\PendingDispatch;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use App\Events\ExportDone;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;


class RamoExport implements FromQuery, WithEvents, WithHeadings, WithColumnFormatting, WithMapping
{
    use Exportable, RegistersEventListeners;

    public function query()
    {
        return Ramo::query();
    }

    public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'Abreviacion',
            'Tipo',
            'Fecha Creacion',
            'Fecha Modificacion',
        ];
    }

    public function map($invoice): array
    {
        return [
            $invoice->id,
            $invoice->name,
            $invoice->abbreviation,
            ($invoice->type==1?"No Vehiculo":($invoice->type==2?"Vehiculo":"Vida")),
            Date::dateTimeToExcel($invoice->created_at),
            Date::dateTimeToExcel($invoice->updated_at),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
