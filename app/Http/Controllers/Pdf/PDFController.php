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

        $dataToPdf["user_name"] = $entry->user->name;
        $dataToPdf["type_name"] = $entry->type->name;
        $dataToPdf["category_name"] = $entry->category->name;
        $dataToPdf["tag_names"] = implode("| ",$tags);        

        $pdf = PDF::loadView('pdf.myPDF', $dataToPdf);

        $documentName = 'entry_' . $entry->id . '.pdf';

        return $pdf->download($documentName);
    }
}
