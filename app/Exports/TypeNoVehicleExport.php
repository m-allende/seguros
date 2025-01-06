<?php

namespace App\Exports;

use App\Models\TypeNoVehicle;
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

class TypeNoVehicleExport implements FromQuery, WithEvents, WithHeadings, WithColumnFormatting, WithMapping
{
    use Exportable, RegistersEventListeners;

    public function query()
    {
        return TypeNoVehicle::query();
    }

    public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'Abreviacion',
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
            Date::dateTimeToExcel($invoice->created_at),
            Date::dateTimeToExcel($invoice->updated_at),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
