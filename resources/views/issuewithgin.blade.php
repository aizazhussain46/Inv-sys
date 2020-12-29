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
                    <form  method="POST" action="{{ url('submit_gin') }}">
                    @csrf
                    <div class="row justify-content-center"> 
                    
                        <div class="col-md-6 col-lg-6">
                            <div class="card mt-3">
                            <div class="card-header bg-primary text-white">
                            Issue with GIN
                            </div>
                                <div class="card-body">
                                <div class="form-group">
                                    <input class="form-control py-4" id="employeecode" name="employee_code" type="text" placeholder="Enter Employee Code here" />
                                    <span class="small text-danger">{{ $errors->first('employee_code') }}</span>
                                    @if (session('emp_code'))
                                    <span class="small text-danger">{{ session('emp_code') }}</span>
                                    @endif
                                </div>
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
                                                <th>Price</th>
                                                <th>Created at</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($inventories as $inventory)
                                            <tr>
                                                <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name='inv_id[]' value="{{ $inventory->id }}">
                                                    <label class="form-check-label" for="exampleCheck1">{{ $i++ }}</label>
                                                </div>
                                                </td>
                                                <td>{{ $inventory->product_sn }}</td>
                                                <td>{{ $inventory->make_id?$inventory->make->make_name:'' }}</td>
                                                <td>{{ $inventory->model_id?$inventory->model->model_name:'' }}</td>
                                                <td>{{ date('Y-m-d' ,strtotime($inventory->purchase_date)) }}</td>
                                                <td>{{ $inventory->category_id?$inventory->category->category_name:'' }}</td>
                                                <td>{{ $inventory->item_price }}</td>
                                                <td>{{ date('Y-m-d' ,strtotime($inventory->created_at)) }}</td>
                                            </tr>
                                        @endforeach    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group">
                        <textarea class="form-control" id="remarks" name="remarks" rows="4" placeholder="Enter Remarks here"></textarea>
                        <span class="small text-danger">{{ $errors->first('remarks') }}</span>
                        </div>    
                    </div>
                    <div class="form-group mt-4 mb-0">
                        <input type="submit" name="issue_inventory" value="Issue with GIN" class="btn btn-primary btn-block">
                        </div>
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