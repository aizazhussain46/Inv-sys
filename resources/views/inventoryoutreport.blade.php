<!DOCTYPE html>
<html>
<head>
	<title>inventory report</title>
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
                    <h2><u>Inventory Report</u></h2>
                    <p class="font-14"><b>EFU Life Assurance Ltd.</b></p>
                    
                </td>
            </tr>
        </table>  
                                    <table class="secondary-table">
                                    <thead>
                                            <tr>
                                            <th>S.No</th>
                                                <th>Item Category</th>
                                                <th>Product S#</th>
                                                <th>PO Number</th>
                                                <th>Make</th>
                                                <th>Model</th>
                                                <th>Price</th>
                                                <th>Purchase Date</th>
                                                <th>Enter By</th>
                                                <th>Issue By</th>
                                                <th>Issue Date</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($inventories as $inventory)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $inventory->subcategory_id?$inventory->subcategory->sub_cat_name:'' }}</td>
                                                <td>{{ $inventory->product_sn }}</td>
                                                <td>{{ $inventory->po_number }}</td>
                                                <td>{{ $inventory->make_id?$inventory->make->make_name:'' }}</td>
                                                <td>{{ $inventory->model_id?$inventory->model->model_name:'' }}</td>
                                                <td class='text-align-right'>{{ number_format($inventory->item_price,2) }}</td>
                                                <td>{{ date('Y-m-d' ,strtotime($inventory->purchase_date)) }}</td>
                                                <td>{{ empty($inventory->added_by)?'':$inventory->added_by->name }}</td>
                                                <td>{{ empty($inventory->issued_by)?'':$inventory->issued_by->name }}</td>
                                                <td>{{ empty($inventory->issue_date)?'':date('Y-m-d' ,strtotime($inventory->issue_date->created_at)) }}</td>
                                                <td>{{ $inventory->remarks }}</td>
                                            </tr>
                                        @endforeach 
                                        </tbody>
                                    </table>
</body>
</html>