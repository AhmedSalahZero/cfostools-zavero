<?php

namespace App\Exports;

use App\Models\RevenueBusinessLine;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Excel;

class RevenueBusinessLineExport implements
    FromCollection ,
    Responsable ,
    WithHeadings ,
    WithMapping ,
    ShouldAutoSize ,
    WithEvents ,
    WithTitle

{
    use Exportable , RegistersEventListeners;
    private Collection $revenueBusinessLines;

    /**
     * @param Collection $products
     */
   
    public function __construct(Collection $revenueBusinessLines , Request $request)
    {
        $this->writerType = $request->get('format') ;
        $this->fileName = RevenueBusinessLine::getFileName(). '.'.getFileExtension($request->get('format'));
        $this->revenueBusinessLines = $revenueBusinessLines;
    }

    public function collection()
    {

        return $this->revenueBusinessLines ;
    }

    public function toResponse($request)
    {

    }

    public function headings():array
    {
        return [
            [
                getCurrentCompany()->getName(),
                RevenueBusinessLine::exportViewName(),
                getExportDateTime(),
                getExportUserName()
                
            ],[
                '',
                '',
                '',
                ''
                
            ],[
            __('Id') ,
            __('Business Line Name'),
            __('Service Category Name'),
            __('Service Item Name')
            ]
        ];
    }

    public function map($row): array
    {
       return [
           $row->getId(),
           $row->getName() ,
           $row->serviceCategories->pluck('name') ,
           $row->serviceItems->pluck('name') 
        //    $row->getServiceItemName() ,
       ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class=>function(AfterSheet $afterSheet){
            $afterSheet->sheet->getStyle('A1:Z2')->applyFromArray([
                'font'=>[
                    'bold'=>true
                ]
            ]);
            }
        ];
    }


    public function title(): string
    {
        return RevenueBusinessLine::getFileName();
    }
}
