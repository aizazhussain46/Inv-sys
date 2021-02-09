<!DOCTYPE html>
<html>
<head>
	<title>{{ $category }} report</title>
    <style>
    .secondary-table{
        width:100%;
        border-spacing: 0px;
    }
    .secondary-table tr th, .secondary-table tr td{
        border: 1px solid;
        font-size: 14px;
    }
    .text-center{
                text-align: center;
            }
    </style>
</head>
<body>

        <?php
 $grand_u_d = 0; 
 $grand_u_p = 0; 
 $grand_t_d = 0; 
 $grand_t_p = 0; 
 $grand_c = 0; 
 $grand_r = 0;
 $grand_qty = 0;
 ?> 
 <div class="text-center">
<h2 style="padding:0; margin:0;"><u>{{ $category }} Report</u></h2>
                    <p style="padding:0; margin:0;" class="font-14"><b>EFU Life Assurance Ltd.</b></p>
                    <p style="padding:0; margin:0;" class="font-14"><b>Proposed IT Budget - {{ $year }}</b></p>
</div>
@foreach($types as $type)   
<div class="card mb-4 mt-3">
                            <div class="card-body">
                            
                            <div class="card-body">
                            <div class="text-center" style="border:1px solid; margin-top:10px;">
                            <h2>{{ $type->type }}</h2>
                            </div>
                            <span class="text-danger">{{ $errors->first('inv_id') }}</span>
                                <div class="table-responsive">
                                    <table class="secondary-table">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Item</th>
                                                <th>Dept</th>
                                                <th>Desc</th>
                                                <th>Qty</th>
                                                <th>Price Unit $</th>
                                                <th>Price Unit Rs</th>
                                                <th>Price Total $</th>
                                                <th>Price Total Rs</th>
                                                <th>Consumed</th>
                                                <th>Rem</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php 
                                        $i = 1; 
                                        $unit_b_d = 0;
                                        $unit_b_p = 0;
                                        $total_b_d = 0;
                                        $total_b_p = 0;
                                        $qty = 0;
                                        $t_consume = 0;
                                        $t_rem = 0;
                                        ?>
                                        @foreach ($type->budgets as $budget)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $budget->subcategory_id?$budget->subcategory->sub_cat_name:'' }}</td>
                                                <td>{{ $budget->department }}</td>
                                                <td>{{ $budget->description }}</td>
                                                <td>{{ $budget->qty }}</td>
                                                <td>{{ number_format($budget->unit_price_dollar,2) }}</td>
                                                <td>{{ number_format($budget->unit_price_pkr,2) }}</td>
                                                <td>{{ number_format($budget->unit_price_dollar*$budget->qty,2) }}</td>
                                                <td>{{ number_format($budget->unit_price_pkr*$budget->qty,2) }}</td>
                                                <td>{{ $budget->consumed }}</td>
                                                <td>{{ $budget->remaining }}</td>
                                                <td>{{ $budget->remarks }}</td>
                                                
                                            </tr>
                                            <?php
                                            $unit_b_d += $budget->unit_price_dollar;
                                            $unit_b_p += $budget->unit_price_pkr;
                                            $total_b_d += $budget->unit_price_dollar*$budget->qty;
                                            $total_b_p += $budget->unit_price_pkr*$budget->qty;
                                            $qty += $budget->qty;
                                            $t_consume += $budget->consumed;
                                            $t_rem += $budget->remaining;
                                            ?>
                                        @endforeach 
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan='4' style="text-align:right;">Total</th>
                                                <td>{{ $qty }}</td>
                                                <td>{{ number_format($unit_b_d,2) }}</td>
                                                <td>{{ number_format($unit_b_p,2) }}</td>
                                                <td>{{ number_format($total_b_d,2) }}</td>
                                                <td>{{ number_format($total_b_p,2) }}</td>
                                                <td>{{ $t_consume }}</td>
                                                <td>{{ $t_rem }}</td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                        <?php
$grand_u_d += $unit_b_d; 
$grand_u_p += $unit_b_p; 
$grand_t_d += $total_b_d; 
$grand_t_p += $total_b_p; 
$grand_c += $t_consume; 
$grand_r += $t_rem;
$grand_qty += $qty;
 ?> 
 @if($type->type == 'Opex')
                                         <tfoot>
                                        <tr>
                                                <th colspan="4" class="text-center">Grand Total</th>
                                                <td>{{ $grand_qty }}</td>
                                                <td>{{ number_format($grand_u_d,2) }}</td>
                                                <td>{{ number_format($grand_u_p,2) }}</td>
                                                <td>{{ number_format($grand_t_d,2) }}</td>
                                                <td>{{ number_format($grand_t_p,2) }}</td>
                                                <td>{{ $grand_c }}</td>
                                                <td>{{ $grand_r }}</td> 
                                                <td></td>
                                                </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div> 
 @endif
                    @endforeach
                         
</body>
</html>