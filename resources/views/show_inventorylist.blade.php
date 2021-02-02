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
                            Inventories
                            </div>
                                <div class="card-body">
                                <table class="table table-borderless">
                                        <tbody>  
                                        <form method="GET" action="{{ url('show_inventory_list') }}">
                                            @csrf                                   
                                            <tr>
                                                <td>
                                                    Item Category
                                                </td>                    
                                                <td>
                                                    <select class="custom-select field_size" name="category_id">
                                                    <option value="">All</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                    @endforeach
                                                    </select>
                                                    <span class="small text-danger">{{ $errors->first('category_id') }}</span>
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
                                                <td colspan="2" class="text-right"><button type="submit" class="btn btn-primary">Show</button></td>
                                            </tr>    
                                        </form>
                                        </tbody>
                                </table>
                                          
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-3 col-lg-3">
                            @if(empty($inventories))
                            @else
                            <a class="btn btn-danger mt-3 mb-1 float-right" href="{{ url('inventoryexport/'.json_encode($filters)) }}">Print <i class="fa fa-download" aria-hidden="true"></i></a>
                            @endif
                    </div>  
                    </div>
                        <div class="card mb-4 mt-5">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Product S#</th>
                                                <th>Make</th>
                                                <th>Model</th>
                                                <th>Category</th>
                                                <th>Item</th>
                                                <th>Price</th>
                                                <th>Created at</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($inventories as $inventory)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $inventory->product_sn }}</td>
                                                <td>{{ $inventory->make_id?$inventory->make->make_name:'' }}</td>
                                                <td>{{ $inventory->model_id?$inventory->model->model_name:'' }}</td>
                                                <td>{{ $inventory->category_id?$inventory->category->category_name:'' }}</td>
                                                <td>{{ $inventory->subcategory_id?$inventory->subcategory->sub_cat_name:'' }}</td>
                                                <td>{{ $inventory->item_price }}</td>
                                                <td>{{ date('Y-m-d' ,strtotime($inventory->created_at)) }}</td>
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