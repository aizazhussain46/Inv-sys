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
                                        ?>
                                        @foreach ($type->categories as $budget)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $budget->category_name }}</td>
                                                <td>{{ $budget->unit_price_dollar }}$</td>
                                                <td>Rs{{ $budget->unit_price_pkr }}</td>
                                                <td>{{ $budget->total_price_dollar }}$</td>
                                                <td>Rs{{ $budget->total_price_pkr }}</td>
                                                <td>{{ $budget->consumed }}</td>
                                                <td>{{ $budget->remaining }}</td>
                                            </tr>
                                            <?php
                                            $unit_b_d += $budget->unit_price_dollar;
                                            $unit_b_p += $budget->unit_price_pkr;
                                            $total_b_d += $budget->total_price_dollar;
                                            $total_b_p += $budget->total_price_pkr;
                                            ?>
                                        @endforeach 
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan='2' style="text-align:right;">Grand Total</th>
                                                <td>{{ $unit_b_d }}$</td>
                                                <td>Rs{{ $unit_b_p }}</td>
                                                <td>{{ $total_b_d }}$</td>
                                                <td>Rs{{ $total_b_p }}</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div> 
                    @endforeach
</body>
</html>