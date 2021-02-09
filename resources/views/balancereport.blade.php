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
                            Balance Report
                            </div>
                                <div class="card-body">
                                <table class="table table-borderless">
                                        <tbody>  
                                        <form method="GET" action="{{ url('balance_report') }}">
                                            @csrf                                   
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
                            @if(empty($subcategories))
                            @else
                            <a class="btn btn-danger mb-2 float-right" href="{{ url('balanceexport/'.json_encode($filters)) }}">Print <i class="fa fa-download" aria-hidden="true"></i></a>
                            @endif
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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