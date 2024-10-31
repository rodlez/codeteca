<?php

namespace App\Exports;

use App\Models\CodeEntry;

use Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

use App\Services\CodeService;
// styles
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Color;

class CodeExport implements FromCollection, WithHeadings, WithMapping, WithEvents, WithStyles
{
    private $listIds;

    // Dependency Injection CodeService to get the Types Categories and Tags
    private CodeService $codeService;

    public function __construct(array $listIds, CodeService $codeService)
    {
        $this->listIds = $listIds;
        $this->codeService = $codeService;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->listIds === []) {
            return CodeEntry::all();
        } else {
            return CodeEntry::select('id', 'user_id', 'type_id', 'category_id', 'title', 'url', 'info', 'code', 'created_at')
                ->get()
                ->whereIn('id', $this->listIds);
        }
    }

    public function map($row): array
    {
        $tags = implode("\n", $this->codeService->entryTagsNames($row));

        $files = $this->codeService->numberFiles($row);

        $urls = implode("\n", json_decode($row->url));

        return [$row->id, $row->user->name, $row->type->name, $row->category->name, $row->title, date_format($row->created_at, 'd-m-Y'), $tags, $files, $urls, $row->info, $row->code];
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ['ID', 'USER', 'TYPE', 'CATEGORY', 'TITLE', 'CREATED', 'TAGS', 'FILES', 'URLS', 'INFO', 'CODE'];
    }

    /**
     * Write code on Method
     *
     * @return response()
     */

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $totalRows = count($this->listIds);

                /* $event->sheet->getDelegate()->getStyle('A1:K1')
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('16a34a'); */
                /* $event->sheet->getStyle('A2:K8')
                        ->getAlignment()
                        ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP); */

                        // Default Row height and width
                        $event->sheet->getRowDimension('1')->setRowHeight(50);
                        $event->sheet->getDefaultColumnDimension()->setWidth(20);

                        // Except for Title and Files
                        $event->sheet->getColumnDimension('H')->setWidth(10);
                        $event->sheet->getColumnDimension('E')->setWidth(30);
                        //$event->sheet->getColumnDimension('J')->setVisible(false);
                        //$event->sheet->getColumnDimension('H')->setVisible(false);
                        
                        $event->sheet->getStyle('A2:K' . $totalRows + 1)
                        ->getAlignment()
                        ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                        ->setWrapText(false);

                        $event->sheet->getStyle('E2:E' . $totalRows + 1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT)
                        ->setWrapText(true);

                        $event->sheet->getStyle('G2:G' . $totalRows + 1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT)
                        ->setWrapText(true);    
                        
                        $event->sheet->getStyle('I2:I' . $totalRows + 1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT)
                        ->setWrapText(true); 

                        $event->sheet->getStyle('J2:J' . $totalRows + 1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

                        $event->sheet->getStyle('K2:K' . $totalRows + 1)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                

                // Loop through each row and apply conditional formatting
                for ($row = 2; $row <= $totalRows + 1; $row++) {
                    $cellValueCat = $event->sheet->getCell('D' . $row)->getValue();
                    $cellFile = $event->sheet->getCell('H' . $row)->getValue();
                    $cellInfo = $event->sheet->getCell('J' . $row)->getValue();
                    $cellCode = $event->sheet->getCell('K' . $row)->getValue();

                    if ($cellValueCat == 'PHP') {
                        $event->sheet
                            ->getStyle('D' . $row)
                            ->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()
                            ->setARGB('7c3aed');
                    }

                    if (empty($cellFile)) {
                        $event->sheet
                            ->getStyle('H' . $row)
                            ->getFont()
                            ->getColor()
                            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

                        $event->sheet->setCellValue('H' . $row, '0');
                    }

                    if (empty($cellInfo)) {
                        $event->sheet->getStyle('J' . $row)
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('e5e7eb');
                    }

                    if (empty($cellCode)) {
                        $event->sheet->getStyle('K' . $row)
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('e5e7eb');
                    }
                }
            },
        ];
    }

    /* public function defaultStyles(Style $defaultStyle)
    {
        // Configure the default styles
        //return $defaultStyle->getFill()->setFillType(Fill::FILL_SOLID);

        // Or return the styles array
        return [
            'font' => [
                'name' => 'Arial',
                'bold' => true,
                'italic' => false,
                'strikethrough' => false,
                'color' => [
                    'rgb' => 'd1d5db',
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                'wrapText' => true,
            ],
        ];
    } */

    public function styles(Worksheet $sheet)
    {
        $totalRows = count($this->listIds);
        return [
            // Style the first row as bold text.
            1 => [
                'font' => [
                    'name' => 'Arial',
                    'bold' => true,
                    'italic' => false,
                    'strikethrough' => false,
                    'color' => [
                        'rgb' => 'FFFFFF',
                    ],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                    'rotation' => 90,
                    'startColor' => [
                        'argb' => '16a34a',
                    ],
                    'endColor' => [
                        'argb' => '16a34a',
                    ],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'wrapText' => false,
                ]
            ],
            /* 'A2:K' . $totalRows + 1 => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                    'wrapText' => false,
                ],
            ], */
        ];
        
    }
}
