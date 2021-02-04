<!DOCTYPE html>
<html>
<head>
	<title>summary report</title>
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
                    <h2><u>Budget Summary Report</u></h2>
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
                                                <th>Category</th>
                                                <th>Price Unit $</th>
                                                <th>Price Unit PKR</th>
                                                <th>Price Total $</th>
                                                <th>Price Total PKR</th>
                                                <th>Consumed</th>
                                                <th>Remaining</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php 
                                        $i = 1;
                                        $unit_b_d = 0;
                                        $unit_b_p = 0;
                                        $total_b_d = 0;
                                        $total_b_p = 0;
                                        $total_c = 0;
                                        $total_r = 0;
                                        ?>
                                        @foreach ($type->categories as $budget)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $budget->category_name }}</td>
                                                <td>{{ number_format($budget->unit_price_dollar,2) }}$</td>
                                                <td>Rs{{ number_format($budget->unit_price_pkr,2) }}</td>
                                                <td>{{ number_format($budget->total_price_dollar,2) }}$</td>
                                                <td>Rs{{ number_format($budget->total_price_pkr,2) }}</td>
                                                <td>{{ $budget->consumed }}</td>
                                                <td>{{ $budget->remaining }}</td>
                                            </tr>
                                            <?php
                                            $unit_b_d += $budget->unit_price_dollar;
                                            $unit_b_p += $budget->unit_price_pkr;
                                            $total_b_d += $budget->total_price_dollar;
                                            $total_b_p += $budget->total_price_pkr;
                                            $total_c += $budget->consumed;
                                            $total_r += $budget->remaining;
                                            ?>
                                        @endforeach 
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan='2' style="text-align:right;">Total</th>
                                                <td>{{ number_format($unit_b_d,2) }}$</td>
                                                <td>Rs{{ number_format($unit_b_p,2) }}</td>
                                                <td>{{ number_format($total_b_d,2) }}$</td>
                                                <td>Rs{{ number_format($total_b_p,2) }}</td>
                                                <td>{{ $total_c }}</td>
                                                <td>{{ $total_r }}</td>
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
$grand_c += $total_c; 
$grand_r += $total_r;
 ?>     
                    @endforeach
        <table class="secondary-table" style="margin-top:30px;">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Grand Total</th>
                <th>Price Unit $</th>
                <th>Price Unit PKR</th>
                <th>Price Total $</th>
                <th>Price Total PKR</th>
                <th>Consumed</th>
                <th>Remaining</th>
            </tr>
        </thead>
            <tr>
                <td></td>
                <th class="text-center">
                    Grand Total
                </th>
                <td>{{ number_format($grand_u_d,2) }}$</td>
                <td>Rs{{ number_format($grand_u_p,2) }}</td>
                <td>{{ number_format($grand_t_d,2) }}$</td>
                <td>Rs{{ number_format($grand_t_p,2) }}</td>
                <td>{{ $grand_c }}</td>
                <td>{{ $grand_r }}</td>
            </tr>
        </table>                    
</body>
</html>