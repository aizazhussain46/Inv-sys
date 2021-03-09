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
                            Asset Repairing
                            </div>
                                <div class="card-body">
                                <table class="table table-borderless">
                                        <tbody>  
                                        <form method="GET" action="{{ url('asset_repairing') }}">
                                            @csrf                                   
                                            <tr>
                                                <td>
                                                    Item Category
                                                </td>                    
                                                <td>
                                                    <select class="custom-select field_size subcategory" name="subcategory_id">
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
                                                    Product SN      
                                                </td>                   
                                                <td>
                                                <select class="custom-select field_size repair_item" name="item_id">
                                                    <option value="">All</option>
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
                            @if(empty($repairs))
                            @else
                            <a class="btn btn-danger mb-2 float-right" href="{{ url('repairingexport/'.json_encode($filters)) }}">Print <i class="fa fa-download" aria-hidden="true"></i></a>
                            @endif
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Item Category</th>
                                                <th>Product SN</th>
                                                <th>Make</th>
                                                <th>Model</th>
                                                <th>Remarks</th>
                                                <th>Actual Price</th>
                                                <th>Entered Amount</th>
                                                <th>Total Amount</th>
                                                <th>Action Date</th>
                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($repairs as $repair)
                                        <?php
                                        $total = $repair->actual_price_value+$repair->price_value;
                                        ?>
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ empty($repair->subcategory)?'':$repair->subcategory->sub_cat_name }}</td>
                                                <td>{{ empty($repair->item)?'':$repair->item->product_sn }}</td>
                                                <td>{{ empty($repair->item->make)?'':$repair->item->make->make_name }}</td>
                                                <td>{{ empty($repair->item->model)?'':$repair->item->model->model_name }}</td>
                                                <td>{{ $repair->remarks }}</td>
                                                <td class='text-align-right'>{{ number_format($repair->actual_price_value,2) }}</td>
                                                <td class='text-align-right'>{{ number_format($repair->price_value,2) }}</td>
                                                <td class='text-align-right'>{{ number_format($total,2) }}</td>
                                                <td>{{ date('Y-m-d' ,strtotime($repair->date)) }}</td>
                                                
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