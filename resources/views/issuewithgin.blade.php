@extends("master")

@section("content")

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    
                    @if (session('msg'))
                        <div class="alert alert-success mt-4">
                            {{ session('msg') }}
                        </div>
                    @endif
                    <form  method="POST" action="{{ url('submit_gin') }}">
                    @csrf
                    <div class="row justify-content-center"> 
                    
                        <div class="col-md-8 col-lg-8">
                            <div class="card mt-3">
                            <div class="card-header bg-primary text-white">
                            Issue with GIN
                            </div>
                                <div class="card-body">
                                <div class="form-group">
                                    
                                    <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="emp_no">Employee Code</label>
                                                        <input class="form-control" id="emp_no" name="employee_code" type="text" placeholder="Enter Employee Code here" autofocus />
                                                        <span class="small text-danger">{{ $errors->first('employee_code') }}</span>
                                                        @if (session('emp_code'))
                                                        <span class="small text-danger">{{ session('emp_code') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="name">Name</label>
                                                        <input class="form-control" id="name" name="name" type="text" placeholder="Enter name here" readonly />
                                                        <span class="small text-danger">{{ $errors->first('name') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="designation">Designation</label>
                                                        <input class="form-control" id="designation" name="designation" type="text" placeholder="Enter Designation here" readonly />
                                                        <span class="small text-danger">{{ $errors->first('designation') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="department">Department</label>
                                                        <input class="form-control" id="department" name="department" type="text" placeholder="Enter Department here" readonly />
                                                        <span class="small text-danger">{{ $errors->first('department') }}</span>

                                                        <input name="dept_id" id="dept_id" type="hidden" value='' />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="location">Location</label>
                                                        <input class="form-control location" id="location" name="location" type="text" placeholder="Enter Location here" readonly />
                                                        <span class="small text-danger">{{ $errors->first('location') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="hod">HOD Name</label>
                                                        <input class="form-control" id="hod" name="hod" type="text" placeholder="Enter HOD name here" readonly />
                                                        <span class="small text-danger">{{ $errors->first('hod') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="email">Email Address</label>
                                                        <input class="form-control" id="email" name="email" type="text" placeholder="Enter Email here" readonly />
                                                        <span class="small text-danger">{{ $errors->first('email') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="status">Status</label>
                                                        <input class="form-control" id="status" name="status" type="text" placeholder="Enter Status here" readonly />
                                                        <span class="small text-danger">{{ $errors->first('status') }}</span>
                                                    </div>
                                                </div>
                                            </div>
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
                                                <th>Sub Category</th>
                                                <th>Price</th>
                                                <th>Dollar Rate</th>
                                                <th>Created at</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($inventories as $inventory)
                                            <tr>
                                                <td>
                                                <div class="form-check">
                                                <input type="radio" class="form-check-input invid" id="exampleCheck1" name='inv_id[]' value="{{ $inventory->id }}">
                                                    <label class="form-check-label" for="exampleCheck1">{{ $i++ }}</label>
                                                </div>
                                                </td>
                                                <td>{{ $inventory->product_sn }}</td>
                                                <td>{{ $inventory->make_id?$inventory->make->make_name:'' }}</td>
                                                <td>{{ $inventory->model_id?$inventory->model->model_name:'' }}</td>
                                                <td>{{ date('Y-m-d' ,strtotime($inventory->purchase_date)) }}</td>
                                                <td>{{ $inventory->category_id?$inventory->category->category_name:'' }}</td>
                                                <td>{{ $inventory->subcategory_id?$inventory->subcategory->sub_cat_name:'' }}</td>
                                                <td class='text-align-right'>{{ number_format($inventory->item_price,2) }}</td>
                                                <td class='text-align-right'>{{ number_format($inventory->dollar_rate,2) }}</td>
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
                    
                    <div class="col-md-12 col-lg-12">
                    <div class="form-group">
                        <!-- <label class="small mb-1" for="year">Year</label> -->
                        <select class="custom-select issue_year" id="year" name="year_id" required>
                        <option value="">Select Year here</option>
                        @foreach ($years as $year)
                        <option value="{{ $year->id }}">{{ $year->year }}</option>
                        @endforeach
                        </select>
                        <span class="small text-danger">{{ $errors->first('year_id') }}</span>
                    </div>
                    </div>

                    <div class="card mb-4 mt-3 budget_items">
                            <div class="card-body">
                            <span class="text-danger">{{ $errors->first('budget_id') }}</span>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Type</th>
                                                <th>Item</th>
                                                <th>Dept</th>
                                                <th>Desc</th>
                                                <th>Qty</th>
                                                <th>Price Unit $</th>
                                                <th>Price Unit Rs</th>
                                                <th>Price Total $</th>
                                                <th>Price Total Rs</th>
                                                <th>Consumed</th>
                                                <th>Rem</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody class="items_list">
                                        </tbody>
                                        
                                    </table>
                                </div>
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