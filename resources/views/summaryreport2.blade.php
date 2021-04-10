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
        font-size: 14px;
        border-spacing: 0px;
        border-collapse: collapse;
    }
    .inner-table{
        width:100%;
        border-spacing: 0px;
        border: none;
    }
    .inner-table tr th, .inner-table tr td{
        width:33%;
    }
    .text-center{
                text-align: center;
            }
            .text-right{
                text-align: right;
            }
    </style>
</head>
<body>

 <?php
 $grand_t_d = 0; 
 $grand_t_p = 0; 
 $grand_qty = 0;
 $grand_c_d = 0; 
 $grand_c_p = 0; 
 $grand_c_qty = 0;
 $grand_r_d = 0; 
 $grand_r_p = 0; 
 $grand_r_qty = 0;
 ?>       
<div class="text-center">
<h2 style="padding:0; margin:0;"><u>Budget Summary Report</u></h2>
                    <p style="padding:0; margin:0;" class="font-14"><b>EFU Life Assurance Ltd.</b></p>
                    <p style="padding:0; margin:0;" class="font-14"><b>Proposed IT Budget - {{ $year }}</b></p>
</div>

@foreach($types as $key=>$type)   
                        <div class="card mb-4 mt-3">
                            <div class="card-body">
                            <div class="text-center" style="border:1px solid; margin-top:10px;">
                            <h2>{{ $type->type }}</h2>
                            </div>
                            <span class="text-danger">{{ $errors->first('inv_id') }}</span>
                                <div class="table-responsive">
                                    <table class="secondary-table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th>Total Budget</th>
                                                <th>Consumed</th>
                                                <th>Remaining</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Category</th>
                                                <th>
                                                    <table class="inner-table">
                                                        <tr>
                                                        <th>Dollar</th>
                                                        <th>PKR</th>
                                                        <th>Quantity</th>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th>
                                                    <table class="inner-table">
                                                        <tr>
                                                        <th>Dollar</th>
                                                        <th>PKR</th>
                                                        <th>Quantity</th>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th>
                                                    <table class="inner-table">
                                                        <tr>
                                                        <th>Dollar</th>
                                                        <th>PKR</th>
                                                        <th>Quantity</th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        <?php 
                                        $i = 1;
                                        $total_b_d = 0;
                                        $total_b_p = 0;
                                        $total_qty = 0;

                                        $c_b_d = 0;
                                        $c_b_p = 0;
                                        $c_qty = 0;

                                        $r_b_d = 0;
                                        $r_b_p = 0;
                                        $r_qty = 0;
                                        ?>
                                        @foreach ($type->categories as $budget)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $budget->category_name }}</td>
                                                <td>
                                                    <table class="inner-table">
                                                        <tr>
                                                        <td class="text-right">{{ number_format($budget->total_price_dollar,2) }}</td>
                                                        <td class="text-right">{{ number_format($budget->total_price_pkr,2)}}</td>
                                                        <td class="text-right">{{ $budget->qty }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table class="inner-table">
                                                        <tr>
                                                        <td class="text-right">{{ number_format(($budget->consumed_price_dollar),2) }}</td>
                                                        <td class="text-right">{{ number_format(($budget->consumed_price_pkr),2) }}</td>
                                                        <td class="text-right">{{ $budget->consumed }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table class="inner-table">
                                                        <tr>
                                                        <td class="text-right">{{ number_format(($budget->remaining_price_dollar),2) }}</td>
                                                        <td class="text-right">{{ number_format(($budget->remaining_price_pkr),2) }}</td>
                                                        <td class="text-right">{{ $budget->remaining }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <?php
                                            $total_b_d += $budget->total_price_dollar;
                                            $total_b_p += $budget->total_price_pkr;
                                            $total_qty += $budget->qty;
                                            $c_b_d += $budget->consumed_price_dollar;
                                            $c_b_p += $budget->consumed_price_pkr;
                                            $c_qty += $budget->consumed;
                                            $r_b_d += $budget->remaining_price_dollar;
                                            $r_b_p += $budget->remaining_price_pkr;
                                            $r_qty += $budget->remaining;
                                            ?>
                                        @endforeach 
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan='2' style="text-align:right;">Total</th>
                                                <td>
                                                    <table class="inner-table">
                                                        <tr>
                                                        <td class="text-right">{{ number_format($total_b_d,2) }}</td>
                                                        <td class="text-right">{{ number_format($total_b_p,2) }}</td>
                                                        <td class="text-right">{{ $total_qty }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table class="inner-table">
                                                        <tr>
                                                        <td class="text-right">{{ number_format($c_b_d,2) }}</td>
                                                        <td class="text-right">{{ number_format($c_b_p,2) }}</td>
                                                        <td class="text-right">{{ $c_qty }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table class="inner-table">
                                                        <tr>
                                                        <td class="text-right">{{ number_format($r_b_d,2) }}</td>
                                                        <td class="text-right">{{ number_format($r_b_p,2) }}</td>
                                                        <td class="text-right">{{ $r_qty }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tfoot>
<?php
$grand_t_d += $total_b_d; 
$grand_t_p += $total_b_p; 
$grand_qty += $total_qty;
$grand_c_d += $c_b_d; 
$grand_c_p += $c_b_p; 
$grand_c_qty += $c_qty;
$grand_r_d += $r_b_d; 
$grand_r_p += $r_b_p; 
$grand_r_qty += $r_qty;
 ?> 
 @if($key == 1)
 <tfoot>
 <tr>
                                                <th colspan='2' class="text-right">Grand Total</th>
                                                <td>
                                                    <table class="inner-table">
                                                        <tr>
                                                        <td class="text-right">{{ number_format($grand_t_d,2) }}</td>
                                                        <td class="text-right">{{ number_format($grand_t_p,2) }}</td>
                                                        <td class="text-right">{{ $grand_qty }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table class="inner-table">
                                                        <tr>
                                                        <td class="text-right">{{ number_format($grand_c_d,2) }}</td>
                                                        <td class="text-right">{{ number_format($grand_c_p,2) }}</td>
                                                        <td class="text-right">{{ $grand_c_qty }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table class="inner-table">
                                                        <tr>
                                                        <td class="text-right">{{ number_format($grand_r_d,2) }}</td>
                                                        <td class="text-right">{{ number_format($grand_r_p,2) }}</td>
                                                        <td class="text-right">{{ $grand_r_qty }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tfoot>
                                            @endif
                                    </table>
                                </div>
                            </div>
                        </div> 
    
                    @endforeach
        
</body>
</html>