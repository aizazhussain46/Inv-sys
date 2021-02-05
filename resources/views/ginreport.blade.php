<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>GIN Report</title>
        <style>
            .main-box {
                max-width: 900px;
                margin: auto;
                padding: 20px;
                font-size: 14px;
                line-height: 24px;
                font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            }
            .main-table{
                width:100%;
            }
            .secondary-table{
                width:100%;
                min-width:100%;
                border-spacing: 0px;
            }
            .secondary-table tr th, .secondary-table tr td{
                border: 1px solid;
                padding: 6px;
                font-size: 14px;
            }
            .text-right{
                text-align: right;
            }
            .text-center{
                text-align: center;
            }
            .font-12{
                font-size: 12px;
            }
            .title-bar{
                background-color:gray;
                line-height: 5px;

            }
            .pd-20{
                padding-top:20px;
            }
        </style>    
    </head>
    <body>
    <div class="main-box">
        <table cellpadding="0" cellspacing="0" class="main-table">
            <tr>
                <td style="width:60%;">
                <img src="{{ asset('images/efu-logo.png') }}" style="width:100%; max-width:100px;">
                </td>
                <td style="width:40%;">
                    <p class="font-12"><b>Date/Time:</b><u> {{ date('Y-m-d H:i:s', strtotime($gin->created_at)) }}</u></p>
                    <p class="font-12"><b>User:</b><u> {{ Auth::user()->name }}</u></p>
                    <p class="font-12"><b>Date Range:</b><u> {{ date('Y-m-d', strtotime($range['from'])) }} To {{ date('Y-m-d', strtotime($range['to'])) }}</u></p>
                </td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0" style="margin-top:50px; width:100%;">    
            <tr style="height:60px;">
            <td></td>
            </tr>
            <tr class="title-bar">
                <td class="text-center" colspan="2">
                    <p style="color:white;"><b><u>GOOD ISSUING NOTE</u></b></p>
                </td>
            </tr>
            <tr style="height:20px;">
            <td></td>
            </tr>
            <tr style="height:20px;">
            <td><p class="font-12"><b>No:</b><u> GIN#{{ $gin->gin_no }}</u></p></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="secondary-table">
                    <tr>
                        <th>S#</th>
                        <th>Sub Category</th>
                        <th>Product S#</th>
                        <th>Other Accessories</th>
                        <!-- <th>Good Condition</th>
                        <th>Purpose</th> -->
                        <th>Remarks</th>
                    </tr>
                    <?php $i = 1; ?>
                    @foreach($inventories as $inv)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $inv->category_id?$inv->category->category_name:'' }}</td>
                        <td>{{ $inv->product_sn }}</td>
                        <td>{{ $inv->other_accessories }}</td>
                        <!-- <td>{{ $inv->good_condition }}</td>
                        <td>{{ $inv->purpose }}</td> -->
                        <td>{{ $inv->remarks }}</td>
                    </tr>
                    <?php $vendor = $inv->vendor_id?$inv->vendor->vendor_name:''; ?>
                    @endforeach
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width:60%;">
                    <!-- <p class="font-12"><b>Handed Over By:</b></p>
                    <p class="font-12"><b>Name:</b><u> {{ $vendor }}</u></p>
                    <p class="font-12 pd-20"><b>Department/Company:</b> ----------------------------</p>
                    <p class="font-12 pd-20"><b>Signature with Date:</b> ----------------------------</p> -->
                </td>
                <td style="width:40%;">
                    <table>
                        <tr>
                            <td>
                                <p class="font-12"><b>Issued To:</b></p>
                                <p class="font-12"><b>Name:</b><u> {{ $employee->name }}</u></p>
                                <p class="font-12 pd-20"><b>Department/Company:</b><u> {{ $employee->department }}</u></p>
                                <p class="font-12 pd-20"><b>Signature with Date:</b> ----------------------------</p>
                            </td>
                        </tr>    
                    <table>
                </td>
            </tr>
        </table> 
    </div>       
    </body>
</html>    