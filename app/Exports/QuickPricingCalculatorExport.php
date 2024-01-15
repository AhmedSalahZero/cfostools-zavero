<?php

namespace App\Exports;

use App\Models\QuickPricingCalculator;
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

class QuickPricingCalculatorExport implements
    FromCollection,
    Responsable,
    WithHeadings,
    WithMapping,
    ShouldAutoSize,
    WithEvents,
    WithTitle

{
    use Exportable, RegistersEventListeners;
    private Collection $quickPricingCalculators;

    /**
     * @param Collection $products
     */

    public function __construct(Collection $quickPricingCalculators, Request $request)
    {
        $this->writerType = $request->get('format');
        $this->fileName = QuickPricingCalculator::getFileName() . '.' . getFileExtension($request->get('format'));
        $this->quickPricingCalculators = $quickPricingCalculators;
    }

    public function collection()
    {

        return $this->quickPricingCalculators;
    }

    public function toResponse($request)
    {
    }

    public function headings(): array
    {
        return [
            [
                getCurrentCompany()->getName(),
                QuickPricingCalculator::exportViewName(),
                getExportDateTime(),
                getExportUserName()

            ], [
                '',
                '',
                '',
                ''

            ], [
                __('Id'),
                __('Revenue Business Line Name'),
                __('Service Category Name'),
                __('Service Item Name'),
                __('Delivery Days'),
                __('Total Recommend Price Without Vat'),
                __('Total Recommend Price With Vat'),
                __('Total Net Profit After Taxes'),
            ]
        ];
    }

    public function map($row): array
    {


        return [
            $row->getId(),
            $row->getRevenueBusinessLineName(),
            $row->getServiceCategoryName(),
            $row->getServiceItemName(),
            $row->getDeliveryDays(),
            $row->getTotalRecommendPriceWithoutVatFormatted(),
            $row->getTotalRecommendPriceWithVatFormatted(),
            $row->getTotalNetProfitAfterTaxesFormatted(),

        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $afterSheet) {
                $afterSheet->sheet->getStyle('A1:Z2')->applyFromArray([
                    'font' => [
                        'bold' => true
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
