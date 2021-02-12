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
                            Inventory OUT
                            </div>
                                <div class="card-body">
                                <table class="table table-borderless">
                                        <tbody>  
                                        <form method="GET" action="{{ url('inventory_out') }}">
                                            @csrf
                                            <!-- <tr>  
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
                                            </tr>    -->
                                            
                                            <tr>  
                                                <td>
                                                    From Issuance
                                                </td>                  
                                                <td>
                                                    <input class="form-control field_size" name="from_issuance" type="date" placeholder="Enter date here" />
                                                    <span class="small text-danger">{{ $errors->first('from_issuance') }}</span>
                                                </td>
                                            </tr>
                                            <tr>  
                                                <td>
                                                    To Issuance
                                                </td>                  
                                                <td>
                                                    <input class="form-control field_size" name="to_issuance" type="date" placeholder="Enter date here" />
                                                    <span class="small text-danger">{{ $errors->first('to_issuance') }}</span>
                                                </td>
                                            </tr>                                
                                            <tr>
                                                <td>
                                                    Item Category
                                                </td>                    
                                                <td>
                                                <select class="custom-select field_size" name="subcategory_id">
                                                    <option value="">All</option>
                                                    @foreach ($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}">{{ $subcategory->sub_cat_name }}</option>
                                                    @endforeach
                                                    </select>
                                                    <span class="small text-danger">{{ $errors->first('subcategory_id') }}</span>
                                                </td>
                                                
                                            </tr>

                                            <tr>  
                                                <td>
                                                    Location
                                                </td>                   
                                                <td>
                                                    <select class="custom-select field_size" name="location_id">
                                                    <option value="">All</option>
                                                    @foreach ($locations as $location)
                                                    <option value="{{ $location->id }}">{{ $location->location }}</option>
                                                    @endforeach
                                                    </select>
                                                    <span class="small text-danger">{{ $errors->first('location_id') }}</span>
                                                </td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Inventory Type
                                                </td>                  
                                                <td>
                                                     <select class="custom-select field_size" name="inventorytype_id">
                                                    <option value="">All</option>
                                                    @foreach ($invtypes as $invtype)
                                                    <option value="{{ $invtype->id }}">{{ $invtype->inventorytype_name }}</option>
                                                    @endforeach
                                                    </select>
                                                    <span class="small text-danger">{{ $errors->first('inventorytype_id') }}</span>
                                                </td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Make
                                                </td>                  
                                                <td>
                                                    <select class="custom-select make field_size" id="make" name="make_id">
                                                        <option value="">All</option>
                                                        @foreach ($makes as $make)
                                                        <option value="{{ $make->id }}">{{ $make->make_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="small text-danger">{{ $errors->first('make_id') }}</span>
                                                </td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Model
                                                </td>                  
                                                <td>
                                                    <select class="custom-select model field_size" id="model" name="model_id">
                                                        <option value="">All</option>
                                                        
                                                    </select>
                                                    <span class="small text-danger">{{ $errors->first('model_id') }}</span>
                                                </td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Store
                                                </td>                  
                                                <td>
                                                <select class="custom-select field_size" id="store" name="store_id">
                                                    <option value="">All</option>
                                                    @foreach ($stores as $store)
                                                    <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="small text-danger">{{ $errors->first('store_id') }}</span>
                                                </td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Item Nature
                                                </td>                  
                                                <td>
                                                <select class="custom-select field_size" id="nature" name="item_nature_id">
                                                    <option value="">All</option>
                                                    @foreach ($itemnatures as $itemnature)
                                                    <option value="{{ $itemnature->id }}">{{ $itemnature->itemnature_name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="small text-danger">{{ $errors->first('item_nature') }}</span>
                                                </td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Vendor
                                                </td>                  
                                                <td>
                                                <select class="custom-select field_size" id="vendor" name="vendor_id">
                                                    <option value="">All</option>
                                                    @foreach ($vendors as $vendor)
                                                    <option value="{{ $vendor->id }}">{{ $vendor->vendor_name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="small text-danger">{{ $errors->first('vendor_id') }}</span>
                                                </td>
                                                
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Purchase Date
                                                </td>                  
                                                <td>
                                                <input class="form-control field_size" id="p_date" name="purchase_date" type="date" placeholder="Enter purchase date here" />
                                                    <span class="small text-danger">{{ $errors->first('purchase_date') }}</span>
                                                </td>
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Warranty Check
                                                </td>                  
                                                <td>
                                                <input class="form-control field_size" id="warrentycheck" name="warrenty_check" type="text" placeholder="Enter Warrenty Check here" />
                                                    <span class="small text-danger">{{ $errors->first('warrenty_check') }}</span>
                                                </td>
                                            </tr>
                                            <tr>  
                                                <td>
                                                    Users
                                                </td>                  
                                                <td>
                                                <select class="custom-select field_size" id="emp" name="issued_to">
                                                    <option value="">All</option>
                                                    @foreach ($employees as $employee)
                                                    <option value="{{ $employee->emp_code }}">{{ $employee->emp_code.' - '.$employee->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="small text-danger">{{ $errors->first('issued_to') }}</span>
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
                            <a class="btn btn-danger mb-2 float-right" href="{{ url('inventoryoutexport/'.json_encode($filters)) }}">Print <i class="fa fa-download" aria-hidden="true"></i></a>
                            @endif
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                                <td class='text-align-right'>{{ $i++ }}</td>
                                                <td>{{ $inventory->subcategory_id?$inventory->subcategory->sub_cat_name:'' }}</td>
                                                <td><a href="{{ url('item_detail/'.$inventory->id) }}">{{ $inventory->product_sn }}</a></td>
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