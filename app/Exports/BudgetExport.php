<?php

namespace App\Exports;

use App\Budgetitem as Budget;
use App\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class BudgetExport implements FromCollection, WithHeadings
{
    public $year;
    public function __construct($data)
    {
        $this->year = $data;
    }

    public function headings(): array
    {
        return [
            'Name',
            'unit_price_dollar',
            'unit_price_pkr',
            'total_price_dollar',
            'total_price_pkr',
            'consumed',
            'remaining'
        ];
    }

    public function collection()
    {
        $grandupd = 0;
        $grandupp = 0;
        $grandtpd = 0;
        $grandtpp = 0;
        $grandc = 0;
        $grandr = 0;
        $category = Category::where('status',1)->select('id','category_name')->get();
            foreach($category as $cat){
                $cat['unit_price_dollar'] = Budget::where('category_id', $cat->id)->where('year_id', $this->year)->sum('unit_price_dollar');
                $cat['unit_price_pkr'] = Budget::where('category_id', $cat->id)->where('year_id', $this->year)->sum('unit_price_pkr');
                $cat['total_price_dollar'] = Budget::where('category_id', $cat->id)->where('year_id', $this->year)->sum('total_price_dollar');
                $cat['total_price_pkr'] = Budget::where('category_id', $cat->id)->where('year_id', $this->year)->sum('total_price_pkr');
                $cat['consumed'] = Budget::where('category_id', $cat->id)->where('year_id', $this->year)->sum('consumed');
                $cat['remaining'] = Budget::where('category_id', $cat->id)->where('year_id', $this->year)->sum('remaining');
            }
            foreach($category as $cat){
                unset($cat->id); 
                $grandupd += $cat->unit_price_dollar;
                $grandupp += $cat->unit_price_pkr;
                $grandtpd += $cat->total_price_dollar;
                $grandtpp += $cat->total_price_pkr;
                $grandc += $cat->consumed;
                $grandr += $cat->remaining;

                $cat->unit_price_dollar .= '$';
                $cat->unit_price_pkr = 'Rs'.$cat->unit_price_pkr;
                $cat->total_price_dollar .= '$';
                $cat->total_price_pkr = 'Rs'.$cat->total_price_pkr;
            }
            $category[] = (object)['Grand Total',$grandupd.'$','Rs'.$grandupp,$grandtpd.'$','Rs'.$grandtpp,$grandc,$grandr];    
        return $category;
    }
}
