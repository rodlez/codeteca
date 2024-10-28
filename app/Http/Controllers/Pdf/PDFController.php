<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\CodeEntry;

use App\Services\CodeService;
use App\Services\CodeFileService;

class PDFController extends Controller
{

// Service Injection
public function __construct(
    private CodeService $codeService,
    private CodeFileService $codeFileService,
) {}


    public function generatePDF(CodeEntry $entry)
    {       

        $dataToPdf = clone $entry;
        $dataToPdf = $dataToPdf->toArray();
        
        $tags = $this->codeService->displayEntryTags($entry);

        $files = $this->codeService->getFiles($entry);

        if ($files != null && $files != '[]')
        {
            $dataToPdf["files"] = [];
            foreach ($files as $key => $file)
            {
                $dataToPdf["files"][$key] = $file->toArray();
            }
        }        
        

        // URL decode JSON 
        if ($entry->url != null && $entry->url != '[]')
        {
            $dataToPdf["urls"] = [];
                    foreach (json_decode($entry->url) as $key => $url)
                    {
                        $dataToPdf["urls"][$key] = $url;
                    }
        }


        $dataToPdf["date"] = date_format($entry->created_at, 'd-m-Y'); 
        $dataToPdf["user_name"] = $entry->user->name;
        $dataToPdf["type_name"] = $entry->type->name;
        $dataToPdf["category_name"] = $entry->category->name;                
        $dataToPdf["tag_names"] = $tags;        

        //$dataToPdf["tag_names"] = implode("| ",$tags);        -> to show as string

        //dd($dataToPdf);

        $pdf = PDF::loadView('pdf.myPDF', $dataToPdf);

        $documentName = 'codeentry_' . $entry->id . '.pdf';

        return $pdf->download($documentName);
    }
}
