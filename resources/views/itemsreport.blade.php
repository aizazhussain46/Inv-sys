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
        padding: 6px;
        font-size: 14px;
    }
    .text-center{
                text-align: center;
            }
    </style>
</head>
<body>
<table cellpadding="0" cellspacing="0" style="width:100%;">
            <tr class="text-center">
                <td class="text-center">
                    <h2><u>{{ $category }} Report</u></h2>
                    <p class="font-14"><b>EFU Life Assurance Ltd.</b></p>
                    <p class="font-14"><b>Proposed IT Budget - {{ $year }}</b></p>
                </td>
            </tr>
        </table>
        <?php
 $grand_u_d = 0; 
 $grand_u_p = 0; 
 $grand_t_d = 0; 
 $grand_t_p = 0; 
 $grand_c = 0; 
 $grand_r = 0;
 $grand_qty = 0;
 ?> 
@foreach($types as $type)   
<div class="card mb-4 mt-3">
                            <div class="card-body">
                            <h3><u>{{ $type->type }}</u></h3>
                            <span class="text-danger">{{ $errors->first('inv_id') }}</span>
                                <div class="table-responsive">
                                    <table class="secondary-table">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Date</th>
                                                <th>Category</th>
                                                <th>Item</th>
                                                <th>Type</th>
                                                <th>Dept</th>
                                                <th>Remarks</th>
                                                <th>Price Unit</th>
                                                <th>Qty</th>
                                                <th>Price Total</th>
                                                <th>Consumed</th>
                                                <th>Rem</th>
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
                                                <td>{{ date('Y-m-d' ,strtotime($budget->created_at)) }}</td>
                                                <td>{{ $budget->category_id?$budget->category->category_name:'' }}</td>
                                                <td>{{ $budget->subcategory_id?$budget->subcategory->sub_cat_name:'' }}</td>
                                                <td>{{ $budget->type_id?$budget->type->type:'' }}</td>
                                                <td>{{ $budget->department }}</td>
                                                <td>{{ $budget->remarks }}</td>
                                                <td>{{ $budget->unit_price_dollar }}$/<br>Rs{{ $budget->unit_price_pkr }}</td>
                                                <td>{{ $budget->qty }}</td>
                                                <td>{{ $budget->unit_price_dollar*$budget->qty }}$/<br>Rs{{ $budget->unit_price_pkr*$budget->qty }}</td>
                                                
                                                <td>{{ $budget->consumed }}</td>
                                                <td>{{ $budget->remaining }}</td>
                                                
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
                                                <th colspan='7' style="text-align:right;">Total</th>
                                                <td>{{ $unit_b_d }}$/<br>Rs{{ $unit_b_p }}</td>
                                                <td>{{ $qty }}</td>
                                                <td>{{ $total_b_d }}$/<br>Rs{{ $total_b_p }}</td>
                                                <td>{{ $t_consume }}</td>
                                                <td>{{ $t_rem }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div> 
<?php
$grand_u_d += $unit_b_d; 
$grand_u_p += $unit_b_p; 
$grand_t_d += $total_b_d; 
$grand_t_p += $total_b_p; 
$grand_c += $t_consume; 
$grand_r += $t_rem;
$grand_qty = $qty;
 ?>  
                    @endforeach
                    <table class="secondary-table" style="margin-top:30px;">
                                        <thead>
                                            <tr>
                                                <th>Grand Total</th>
                                                <th>Price Unit</th>
                                                <th>Qty</th>
                                                <th>Price Total</th>
                                                <th>Consumed</th>
                                                <th>Rem</th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                                <tr>
                                                <th class="text-center">Grand Total</th>
                                                <td>{{ $grand_u_d }}$/<br>Rs{{ $grand_u_p }}</td>
                                                <td>{{ $grand_qty }}</td>
                                                <td>{{ $grand_t_d }}$/<br>Rs{{ $grand_t_p }}</td>
                                                <td>{{ $grand_c }}</td>
                                                <td>{{ $grand_r }}</td> 
                                                </tr>
                                        </tbody>   
                    </table>            
</body>
</html>