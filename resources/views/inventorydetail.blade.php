@extends("master")

@section("content")
<style>
.field_size{
    height: 30px; 
    padding: 0px 10px;
}
.secondary-table tr th, .secondary-table tr td{
    border: 1px solid aquamarine;
    }

    </style>
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    <div class="row"> 
                    <div class="col-md-12 col-lg-12">
                       
                            <div class="card mt-3">
                            <div class="card-header bg-primary text-white">
                            Inventory Item Detail
                            </div>
                                <div class="card-body">
                                
                                <table class="table table-borderless">
                                    <tr>
                                        <td>
                                        <table class="table secondary-table">
                                        <tbody>                                   
                                            <tr>
                                                <td>
                                                    Item Category
                                                </td>                    
                                                <td>{{ empty($inventory->category)?'':$inventory->category->category_name }}</td>
                                                
                                            </tr>
                                            <tr>
                                                <td>
                                                    Sub Category
                                                </td>                    
                                                <td>{{ empty($inventory->subcategory)?'':$inventory->subcategory->sub_cat_name }}</td>
                                                
                                            </tr>

                                            <tr>  
                                                <td>
                                                    Location
                                                </td>                   
                                                <td>{{ empty($inventory->subcategory)?'':$inventory->location->location }}</td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Inventory Type
                                                </td>                  
                                                <td>{{ empty($inventory->subcategory)?'':$inventory->inventorytype->inventorytype_name }}</td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Product SN
                                                </td>                  
                                                <td>{{ $inventory->product_sn }}</td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Make
                                                </td>                  
                                                <td>{{ empty($inventory->make)?'':$inventory->make->make_name }}</td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Model
                                                </td>                  
                                                <td>{{ empty($inventory->model)?'':$inventory->model->model_name }}</td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Store
                                                </td>                  
                                                <td>{{ empty($inventory->store)?'':$inventory->store->store_name }}</td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Item Nature
                                                </td>                  
                                                <td>{{ empty($inventory->itemnature)?'':$inventory->itemnature->itemnature_name }}</td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Vendor
                                                </td>                  
                                                <td>{{ empty($inventory->vendor)?'':$inventory->vendor->vendor_name }}</td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Device Type
                                                </td>                  
                                                <td>{{ empty($inventory->devicetype)?'':$inventory->devicetype->devicetype_name }}</td>
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Purchase Date
                                                </td>                  
                                                <td>{{ date('Y-m-d', strtotime($inventory->purchase_date)) }}</td>
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Warranty Check
                                                </td>                  
                                                <td>{{ $inventory->warrenty_check }}</td>
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Price
                                                </td>                  
                                                <td>{{ number_format($inventory->item_price,2) }}</td>
                                            </tr> 
                                            <tr>  
                                                <td>
                                                    Dollar Rate
                                                </td>                  
                                                <td>{{ number_format($inventory->dollar_rate,2) }}</td>
                                            </tr>

                                            <tr>  
                                                <td>
                                                Insurance
                                                </td>                  
                                                <td>{{ $inventory->insurance }}</td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                Licence Key
                                                </td>                  
                                                <td>{{ $inventory->licence_key }}</td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                SLA
                                                </td>                  
                                                <td>{{ $inventory->sla }}</td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                Operating System
                                                </td>                  
                                                <td>{{ $inventory->operating_system }}</td>
                                            </tr>
                                            <tr>  
                                                <td>
                                                SAP Tag
                                                </td>                  
                                                <td>{{ $inventory->SAP_tag }}</td>
                                            </tr>
                                            <tr>  
                                                <td>
                                                Capacity
                                                </td>                  
                                                <td>{{ $inventory->capacity }}</td>
                                            </tr>  
                                        </tbody>
                                </table>
                                        </td>                    
                                        <td>
                                        <table class="table secondary-table">
                                        <tbody>                                   
                                            <tr>
                                                <td>
                                                    Remarks
                                                </td>                    
                                                <td>{{ $inventory->remarks }}</td>
                                                
                                            </tr>

                                            <tr>  
                                                <td>
                                                    Delivery Challan
                                                </td>                   
                                                <td>{{ $inventory->delivery_challan }}</td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Delivery Challan Date
                                                </td>                  
                                                <td>{{ date('Y-m-d', strtotime($inventory->delivery_challan_date)) }}</td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Invoice Number
                                                </td>                  
                                                <td>{{ $inventory->invoice_number }}</td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Invoice Date
                                                </td>                  
                                                <td>{{ date('Y-m-d', strtotime($inventory->invoice_date)) }}</td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Other Accessories
                                                </td>                  
                                                <td>{{ $inventory->other_accessories }}</td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Purpose
                                                </td>                  
                                                <td>{{ $inventory->purpose }}</td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Good Condition
                                                </td>                  
                                                <td>{{ $inventory->good_condition }}</td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Verification
                                                </td>                  
                                                <td>{{ $inventory->verification }}</td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Issued To
                                                </td>                  
                                                <td>{{ empty($inventory->user)?'':$inventory->user->name }}</td>
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Po Number
                                                </td>                  
                                                <td>{{ $inventory->po_number }}</td>
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Warrenty Period
                                                </td>                  
                                                <td>{{ $inventory->warrenty_period }}</td>
                                            </tr>



                                            <tr>  
                                                <td>
                                                Hard Drive
                                                </td>                  
                                                <td>{{ $inventory->hard_drive }}</td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                Processor
                                                </td>                  
                                                <td>{{ $inventory->processor }}</td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                Process Generation
                                                </td>                  
                                                <td>{{ $inventory->process_generation }}</td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                Display Type
                                                </td>                  
                                                <td>{{ $inventory->display_type }}</td>
                                            </tr>
                                            <tr>  
                                                <td>
                                                DVD Rom
                                                </td>                  
                                                <td>{{ $inventory->DVD_rom }}</td>
                                            </tr>
                                            <tr>  
                                                <td>
                                                RAM
                                                </td>                  
                                                <td>{{ $inventory->RAM }}</td>
                                            </tr>   
                                        </tbody>
                                </table>        
                                        </td>           
                                    </tr>
                                </table>
                                         
                                </div>
                            </div>
                        </div> 
                        
                    </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
@endsection