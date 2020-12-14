@extends("master")

@section("content")

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    
                    @if (session('msg'))
                        <div class="alert alert-success">
                            {{ session('msg') }}
                        </div>
                    @endif
                    
                    <form id="rform" method="" action="">
                    @csrf
                    
                    <div class="row justify-content-center"> 
                    
                        <div class="col-md-6 col-lg-6">
                            <div class="card mt-3">
                            <div class="card-header bg-primary text-white">
                            Return Inventory
                            </div>
                                <div class="card-body">
                                <table class="table table-borderless">
                                        <tbody>
                                                  
                                            <tr>
                                                <td>
                                                    <input class="form-control" id="employee_code" name="employee_code" type="text" value="{{ isset($emp_code)?$emp_code->id:null }}" placeholder="Enter Employee Code here" />
                                                    <span class="small text-danger">{{ $errors->first('employee_code') }}</span>
                                                    @if (session('emp_code'))
                                                    <span class="small text-danger">{{ session('emp_code') }}</span>
                                                    @endif
                                                
                                                </td>
                                                <td><button type="button" id="rshow" name="show" class="btn btn-primary">Show</button></td>
                                            </tr>
                                        </tbody>
                                </table>            
                                </div>
                            </div>
                        </div>   
                    </div>    
                        <div class="card mb-4 mt-3">
                            <div class="card-body">
                            <span class="text-danger">{{ $errors->first('inv_id') }}</span>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Product S#</th>
                                                <th>Make</th>
                                                <th>Model</th>
                                                <th>Purchase Date</th>
                                                <th>Category</th>
                                                <th>Employee Code</th>
                                                <th>Employee Name</th>
                                                <th>Price</th>
                                                <th>Created at</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($inventories as $inventory)
                                            <tr>
                                                <td>
                                                @if(isset($filter))
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="inv{{ $inventory->id }}" name="inv_id[]" value="{{ $inventory->id }}">
                                                    <label class="form-check-label" for="inv{{ $inventory->id }}">{{ $i++ }}</label>
                                                </div>
                                                @else
                                                {{ $i++ }}
                                                @endif
                                                </td>
                                                <td>{{ $inventory->product_sn }}</td>
                                                <td>{{ $inventory->make_id?$inventory->make->make_name:'' }}</td>
                                                <td>{{ $inventory->model_id?$inventory->model->model_name:'' }}</td>
                                                <td>{{ date('Y-m-d' ,strtotime($inventory->purchase_date)) }}</td>
                                                <td>{{ $inventory->category_id?$inventory->category->category_name:'' }}</td>
                                                <td>{{ $inventory->user->id }}</td>
                                                <td>{{ $inventory->user->name }}</td>
                                                <td>{{ $inventory->item_price }}</td>
                                                <td>{{ date('Y-m-d' ,strtotime($inventory->created_at)) }}</td>
                                            </tr>
                                        @endforeach    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @if(isset($filter))
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group">
                        <textarea class="form-control" id="remarks" name="remarks" rows="4" placeholder="Enter Remarks here"></textarea>
                        <span class="small text-danger">{{ $errors->first('remarks') }}</span>
                        </div>    
                    </div>
                 
                    <div class="form-group mt-4 mb-0">
                        <button type="button" name="return_inventory" class="btn btn-primary btn-block" id="return">Return Inventory</button>
                        </div>  
                        @endif             
                </form>
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