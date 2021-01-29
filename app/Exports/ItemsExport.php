<?php

namespace App\Exports;

use App\Category;
use App\Subcategory;
use App\User;
use App\Year;
use App\Dollar;
use App\Type;
use App\Budgetitem as Budget;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ItemsExport implements FromCollection, WithHeadings
{
    public $filters;
    public function __construct($data)
    {
        $this->filters = $data;
    }

    public function headings(): array
    {
        return [
            'Item',
            'Type',
            'Department',
            'Year',
            'Remarks',
            'Unit price $',
            'Unit price PKR',
            'Qty',
            'Consumed',
            'Remaining',
            'Total price $',
            'Total price PKR'
        ];
    }

    public function collection()
    {
        $filters = json_decode($this->filters);
        $items = Budget::where('year_id', $filters->yearid)->where('category_id',$filters->catid)
        ->select('subcategory_id','type_id','department','year_id','remarks','unit_price_dollar','unit_price_pkr','qty','consumed','remaining','total_price_dollar','total_price_pkr')
        ->get();
        $unit_b_d = 0;
        $unit_b_p = 0;
        $total_b_d = 0;
        $total_b_p = 0;
        $qty = 0;
        $t_consume = 0;
        $t_rem = 0;
        foreach($items as $item){
            $itype = Type::where('id',$item->type_id)->select('type')->first();
            $isubcategory = Subcategory::where('id',$item->subcategory_id)->select('sub_cat_name')->first();
            $iyear = Year::where('id',$item->year_id)->select('year')->first();
            $item->type_id = $itype->type;
            $item->subcategory_id = $isubcategory->sub_cat_name;
            $item->year_id = $iyear->year;
            unset($item->type,$item->subcategory,$item->category,$item->year);
            $unit_b_d += $item->unit_price_dollar;
            $unit_b_p += $item->unit_price_pkr;
            $total_b_d += $item->total_price_dollar;
            $total_b_p += $item->total_price_pkr;
            $qty += $item->qty;
            $t_consume += $item->consumed;
            $t_rem += $item->remaining;  
            
            $item->unit_price_dollar .= '$';
            $item->unit_price_pkr = 'Rs'.$item->unit_price_pkr;
            $item->total_price_dollar .= '$';
            $item->total_price_pkr = 'Rs'.$item->total_price_pkr;
        }
        $items[] = (object)[
            '',
            '',
            '',
            '',
            'Grand Total',
            $unit_b_d.'$',
            'Rs'.$unit_b_p,
            $qty,
            $t_consume,
            $t_rem,
            $total_b_d.'$',
            'Rs'.$total_b_p
        ];    
        return $items;
    }
}
