<?php
  
namespace App\Exports;
    
use App\Models\CodeEntry;

use Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CodeExport implements FromCollection, WithHeadings
{
    
    private $listIds;

    public function __construct(array $listIds) 
    {
        $this->listIds = $listIds;
    }
    
    
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //dd($this->listIds);
        //$listIds = [7,13,11];
        if ($this->listIds === [])
        {
            return CodeEntry::select("id","user_id", "type_id", "category_id", "title", "url", "info", "code", "created_at")->get();
        }
        else{
            return CodeEntry::select("id","user_id", "type_id", "category_id", "title", "url", "info", "code", "created_at")->get()->whereIn('id', $this->listIds);
        }
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["ID","USER_ID", "TYPE_ID", "CATEGORY_ID", "TITLE", "URL", "INFO", "CODE", "CREATED_AT"];
    }
}