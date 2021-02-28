<?php

namespace App\Exports;

use App\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;	

class ItemsExport implements ShouldAutoSize, WithHeadings, FromCollection, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $items;

    	function __construct($items){
    		$this->items = $items;
    	}

      public function headings(): array
    {
        $this_year = date("Y");

        return [
            ['HEDRIC STORE'],
            ['P-2 PLAZA ST., BRGY. MAGOSILOM, CANTILAN S.D.S'],
            [],
            ['SUMMAY OF STOCK INVENTORY FOR THE YEAR'],
            ['Ended December 31, '.$this_year],

            [
            'PRODUCT INVENTORY CODE',
            'ITEM DESCRIPTION',
            'LOCATION (NOTE 1)',
            'INVENTORY EVALUATION METHOD (NOTE 2)',
            ],

            [
            '',
            '',
            'ADDRESS',
            'CODE',
            'REMARKS',
           
            ],
        ];
    }
    public function registerEvents():array 
    {
        // return [
        //     BeforeWriting::class=>function(BeforeWriting $event){
        //         $event->writer->getDefaultStyle()->getAlignment()->setHorizontal('center');
        //     }
        // ];
    	return[
    		AfterSheet::class=>function(AfterSheet $event){

    	$header_style_array = [
    		'font'=>['bold'=>true]
    	];

    	$style_array = [
    		'font'=>['bold'=>true]
    	];
    			$event->sheet->getStyle('A1:V1200')->getAlignment()->setHorizontal('center');
                // $event->sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

                $event->sheet->mergeCells('A1:K1');
                $event->sheet->mergeCells('A2:K2');
                $event->sheet->mergeCells('A3:K3');
                $event->sheet->mergeCells('A4:K4');
                $event->sheet->mergeCells('A5:K5');
                // header merging
                $event->sheet->mergeCells('C6:E6');
                $event->sheet->mergeCells('A6:A7');
                $event->sheet->mergeCells('B6:B7');
                $event->sheet->mergeCells('F6:F7');
                $event->sheet->mergeCells('G6:G7');
                $event->sheet->mergeCells('H6:H7');
                $event->sheet->mergeCells('J6:J7');
                $event->sheet->mergeCells('K6:K7');

                // add values to header row.
                // reason: i cant insert it using row so im using setcellvalue
                $event->sheet->setCellValue('F6','INVENTORY EVALUATION METHOD (NOTE 2)');
                $event->sheet->setCellValue('G6','UNIT PRICE');
                $event->sheet->setCellValue('H6','QUANTITY IN STOCKS');
                $event->sheet->setCellValue('I6','UNIT OF MEASUREMENT (In weight or volume');
                $event->sheet->setCellValue('I7','e.g. Kilos, grams, liters etc.');
                $event->sheet->setCellValue('J6','TOTAL WEIGHT VOLUME');
                $event->sheet->setCellValue('K6','TOTAL COST');

                // border
                // $event->sheet->setBorder('A6:K28','thin');

    			$event->sheet->getStyle('A1')->applyFromArray($header_style_array);
                $event->sheet->getStyle('A4')->applyFromArray($header_style_array);


    	
    	}];
    }


    public function collection()
    {
    	$items = Item::all();

    	$items = $items->map(function($item) use ($items){
    		return collect([
    			'id'=>$item->id,
    			'product_name'=>$item->name,
    			'address'=>'Cantilan, SDS',
    			'code'=>'CO',
    			'remarks'=>'Supplier',
    			'inventory_evaluation_method'=>'Fifo',
    			'unit_price'=>$item->unit_price,
    			'quantity_in_stocks'=>$item->stock,
    			'unit_of_measurement'=>'N/a',
    			'total_weight_volume'=>'N/a',
    			'total_cost'=>$item->stock*$item->unit_price
    		]);
    	});
        return $items;
        // return view('pages.export',[
        // 	'users'=> User::all();
        // ]);
    }
  
}
