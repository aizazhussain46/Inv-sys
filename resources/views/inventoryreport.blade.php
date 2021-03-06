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
        font-size: 14px;
    }
    .text-center{
                text-align: center;
            }
    .font-14{
        font-size: 14px;
    } 
    </style>
</head>
<body>
<table cellpadding="0" cellspacing="0" style="width:100%;">
            <tr class="text-center">
                <td class="text-center">
                    <h2><u>Inventory Report</u><span class="font-14"><b> - <u>EFU Life Assurance Ltd.</u></b></span></h2>
                </td>
            </tr>
        </table>  <br> 
                                    <table class="secondary-table">
                                    <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Sub Category</th>
                                                <th>Product S#</th>
                                                <th>Make</th>
                                                <th>Model</th>
                                                <th>Item</th>
                                                <th>Purchase Date</th>
                                                <th>Location</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($inventories as $inventory)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $inventory->subcategory->sub_cat_name }}</td>
                                                <td>{{ $inventory->product_sn }}</td>
                                                <td>{{ $inventory->make_id?$inventory->make->make_name:'' }}</td>
                                                <td>{{ $inventory->model_id?$inventory->model->model_name:'' }}</td>
                                                <td>{{ $inventory->subcategory_id?$inventory->subcategory->sub_cat_name:'' }}</td>
                                                <td>{{ date('Y-m-d' ,strtotime($inventory->purchase_date)) }}</td>
                                                <td>{{ empty($inventory->location)?'':$inventory->location->location }}</td>
                                                <td>{{ date('Y-m-d' ,strtotime($inventory->created_at)) }}</td>
                                            </tr>
                                        @endforeach 
                                        </tbody>
                                    </table>
</body>
</html>