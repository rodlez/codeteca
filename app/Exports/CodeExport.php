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
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CodeExport implements FromCollection, WithHeadings, WithMapping, WithStyles
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
        $tags = implode(" ",$this->codeService->entryTagsNames($row));

        $files = $this->codeService->numberFiles($row);

        $urls = implode("\n",json_decode($row->url));
       
        return [$row->id, $row->user->name, $row->type->name, $row->category->name, $row->title, date_format($row->created_at, 'd-m-Y'), $tags, $files, $urls, $row->info, $row->code];
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ['ID', 'USER', 'TYPE', 'CATEGORY', 'TITLE', 'CREATED', 'TAGS', 'FILES', 'URL', 'INFO', 'CODE'];
    }


    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true, 'color' => ['rgb' => 'C70039']]],

            /* // Styling a specific cell by coordinate.
            'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            'C'  => ['font' => ['size' => 16]], */
        ];
    }


}
