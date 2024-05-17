<?php

namespace App\Exports;

use App\Models\Intern;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class InternsExport implements FromCollection, WithHeadings, WithEvents
{
    public function collection()
    {
        return Intern::select(
            'id',
            'firstName',
            'lastName',
            'age',
            'cin',
            'phone',
            'address',
            'school',
            'sector',
            'startDate',
            'endDate'
        )->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Prénom',
            'Nom',
            'Âge',
            'CIN',
            'Téléphone',
            'Adresse',
            'École',
            'Secteur',
            'Date de début',
            'Date de fin',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $dateTime = now()->format('Y-m-d H:i:s');
    
                // Shift the existing content down by three rows
                $event->sheet->insertNewRowBefore(1, 3);
    
                // Set the extraction date and time
                $event->sheet->setCellValue('A1', "Exporter en: $dateTime");
                $event->sheet->mergeCells('A1:K3');
                $event->sheet->getStyle('A1')->getAlignment()->setVertical('center'); // Center vertically
    
                // Align "Exporter en:" to the right
                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal('right');
                $event->sheet->getStyle('A1')->getAlignment()->setIndent(1);

                // Add the image to cell A1 with a defined height and width
                $logoPath = public_path('images/suninternship.png'); // Replace with the correct path to the "suninternship.png" image
                $logoDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $logoDrawing->setPath($logoPath);
                $logoDrawing->setCoordinates('A1');
                $logoDrawing->setHeight(55);
                $logoDrawing->setWorksheet($event->sheet->getDelegate());

                // Set the header labels
                $headerLabels = $this->headings();
                $headerRange = 'A4:K4';
                $columnIndex = 1;
                foreach ($headerLabels as $headerLabel) {
                    $columnLetter = Coordinate::stringFromColumnIndex($columnIndex);
                    $cellCoordinate = $columnLetter . '4';
                    $event->sheet->setCellValue($cellCoordinate, $headerLabel);
                    $columnIndex++;
                }
    
                // Make the header labels bold
                $headerFont = $event->sheet->getStyle($headerRange)->getFont();
                $headerFont->setBold(true);
            },
        ];
    }
    
    

}
