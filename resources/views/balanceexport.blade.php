<!DOCTYPE html>
<html>
<head>
	<title>balance report</title>
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
                    <h2><u>Balance Report</u><span class="font-14"><b> - <u>EFU Life Assurance Ltd.</u></b></span></h2>
                </td>
            </tr>
        </table>  <br> 
                                    <table class="secondary-table">
                                    <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Item Category</th>
                                                <th>IN</th>
                                                <th>OUT</th>
                                                <th>BALANCE</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($subcategories as $subcat)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $subcat->sub_cat_name }}</td>
                                                <td>{{ ($subcat->rem+$subcat->out) }}</td>
                                                <td>{{ $subcat->out }}</td>
                                                <td>{{ $subcat->rem }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
</body>
</html>