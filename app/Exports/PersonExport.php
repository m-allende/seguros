<?php

namespace App\Exports;

use App\Models\Person;
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


class PersonExport implements FromQuery, WithEvents, WithHeadings, WithColumnFormatting, WithMapping
{
    use Exportable, RegistersEventListeners;

    public function query()
    {
        return Person::query();
    }

    public function headings(): array
    {
        return [
            '#',
            'RUT',
            'Nombre / Razón Social',
            'Ap. Paterno',
            'Ap. Materno',
            'Abreviación',
            'Fecha Nacimiento',
            'Estado Civil',
            'Género',
            'Fecha Creacion',
            'Fecha Modificacion',
        ];
    }

    public function map($invoice): array
    {
        return [
            $invoice->id,
            $invoice->identification,
            $invoice->name,
            $invoice->last_name,
            $invoice->mother_last_name,
            $invoice->abreviation,
            $invoice->birthdate,
            ($invoice->marital_status != null?$invoice->marital_status->name:""),
            ($invoice->gender != null?$invoice->gender->name:""),
            Date::dateTimeToExcel($invoice->created_at),
            Date::dateTimeToExcel($invoice->updated_at),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'J' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'K' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}

