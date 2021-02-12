@extends("master")

@section("content")
<style>
.field_size{
    height: 30px; 
    padding: 0px 10px;
}
</style>
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    <div class="row"> 
                    <div class="col-md-3 col-lg-3">
                    </div>
                    <div class="col-md-6 col-lg-6">
                       
                            <div class="card mt-3">
                            <div class="card-header bg-primary text-white">
                            Inventory Edit Logs
                            </div>
                                <div class="card-body">
                                <table class="table table-borderless">
                                        <tbody>  
                                        <form method="GET" action="{{ url('edit_logs') }}">
                                            @csrf                                   
                                            
                                            <tr>  
                                                <td>
                                                    From Date
                                                </td>                  
                                                <td>
                                                    <input class="form-control field_size" name="from_date" type="date" placeholder="Enter date here" />
                                                    <span class="small text-danger">{{ $errors->first('from_date') }}</span>
                                                </td>
                                            </tr>
                                            <tr>  
                                                <td>
                                                    To Date
                                                </td>                  
                                                <td>
                                                    <input class="form-control field_size" name="to_date" type="date" placeholder="Enter date here" />
                                                    <span class="small text-danger">{{ $errors->first('to_date') }}</span>
                                                </td>
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Product SN
                                                </td>                  
                                                <td>
                                                     <select class="custom-select field_size" name="product_sn">
                                                    <option value="">All</option>
                                                    @foreach ($productsns as $productsn)
                                                    <option value="{{ $productsn->product_sn }}">{{ $productsn->product_sn }}</option>
                                                    @endforeach
                                                    </select>
                                                    <span class="small text-danger">{{ $errors->first('product_sn') }}</span>
                                                </td>
                                                
                                            </tr>
                                            
                                            <tr>                    
                                                <td colspan="2" class="text-right"><button type="submit" class="btn btn-primary">Show</button></td>
                                            </tr>    
                                        </form>
                                        </tbody>
                                </table>
                                          
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-3 col-lg-3">
                            
                    </div>  
                    </div>
                        <div class="card mb-4 mt-5">
                            <div class="card-body">
                            @if(empty($inventories))
                            @else
                            <a class="btn btn-danger mb-2 float-right" href="{{ url('editlogsexport/'.json_encode($filters)) }}">Print <i class="fa fa-download" aria-hidden="true"></i></a>
                            @endif
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Item Category</th>
                                                <th>Product S#</th>
                                                <th>Make</th>
                                                <th>Model</th>
                                                <th>Purchase Date</th>
                                                <th>PO Number</th>
                                                <th>Vendor Name</th>
                                                <th>Warranty Period</th>
                                                <th>Remarks</th>
                                                <th>Price</th>
                                                <th>Item Nature</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($inventories as $inventory)
                                            <tr>
                                                <td class='text-align-right'>{{ $i++ }}</td>
                                                <td>{{ $inventory->subcategory_id?$inventory->subcategory->sub_cat_name:'' }}</td>
                                                <td><a href="{{ url('item_detail/'.$inventory->id) }}">{{ $inventory->product_sn }}</a></td>
                                                <td>{{ $inventory->make_id?$inventory->make->make_name:'' }}</td>
                                                <td>{{ $inventory->model_id?$inventory->model->model_name:'' }}</td>
                                                <td>{{ date('Y-m-d' ,strtotime($inventory->purchase_date)) }}</td>
                                                <td>{{ $inventory->po_number }}</td>
                                                <td>{{ empty($inventory->vendor)?'':$inventory->vendor->vendor_name }}</td>
                                                <td>{{ $inventory->warrenty_period }}</td>
                                                <td>{{ $inventory->remarks }}</td>
                                                <td class='text-align-right'>{{ number_format($inventory->item_price,2) }}</td>
                                                <td>{{ empty($inventory->itemnature)?'':$inventory->itemnature->itemnature_name }}</td>
                                            </tr>
                                        @endforeach    
                                        </tbody>
                                    </table>
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