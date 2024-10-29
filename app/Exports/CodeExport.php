<?php
  
namespace App\Exports;
    
use App\Models\CodeEntry;

use Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CodeExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CodeEntry::select("user_id", "type_id", "category_id", "title", "url", "info", "code")->get();
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["user_id", "type_id", "category_id", "title", "url", "info", "code"];
    }
}