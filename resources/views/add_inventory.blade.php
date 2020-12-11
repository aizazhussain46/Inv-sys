@extends("master")

@section("content")
<div id="layoutSidenav_content">
                <main>
                    <div class="container">
                    <div class="row mt-4"> 
                        <div class="col-md-10 col-lg-10">
                            <h1 class="">Add Inventory</h1>
                        </div>
                        <div class="col-md-2 col-lg-2 text-right">
                            <a href="{{ url('inventory') }}" class="btn btn-success">View List</a>
                        </div>
                    </div>
                    <hr />
                    @if (session('msg'))
                        <div class="alert alert-success">
                            {{ session('msg') }}
                        </div>
                    @endif
                    <div class="row">
                    
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="card border-0 rounded-lg mt-3">
                                    <div class="card-body">
                                        <form  method="POST" action="{{ url('inventory') }}">
                                        @csrf
                                
                                        <div class="form-row">
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="small mb-1" for="category">Category</label>
                                                <select class="custom-select" id="category" name="category_id">
                                                    <option value=0>Select Category here</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="small text-danger">{{ $errors->first('category_id') }}</span>
                                            </div>
                                            </div>
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="small mb-1" for="location">Location</label>
                                                <select class="custom-select" id="location" name="location_id">
                                                    <option value=0>Select Location here</option>
                                                    @foreach ($locations as $location)
                                                    <option value="{{ $location->id }}">{{ $location->location }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="small text-danger">{{ $errors->first('location_id') }}</span>
                                            </div>
                                            </div>
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="small mb-1" for="department">Department</label>
                                                <select class="custom-select" id="department" name="department_id">
                                                    <option value=0>Select Department here</option>
                                                    @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="small text-danger">{{ $errors->first('department_id') }}</span>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="branch">Branch</label>
                                                <select class="custom-select" id="branch" name="branch_id">
                                                    <option value=0>Select Branch here</option>
                                                    @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="small text-danger">{{ $errors->first('branch_id') }}</span>
                                            </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="store">Store</label>
                                                <select class="custom-select" id="store" name="store_id">
                                                    <option value=0>Select Store here</option>
                                                    @foreach ($stores as $store)
                                                    <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="small text-danger">{{ $errors->first('store_id') }}</span>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                        <label class="small mb-1" for="pro">Product S/N</label>
                                                        <input class="form-control py-2" id="pro" name="product_sn" type="text" placeholder="Enter product s/n here" />
                                                        <span class="small text-danger">{{ $errors->first('product_sn') }}</span>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="small mb-1" for="model">Model</label>
                                                <select class="custom-select" id="model" name="model_id">
                                                    <option value=0>Select Model here</option>
                                                    @foreach ($models as $model)
                                                    <option value="{{ $model->id }}">{{ $model->model_name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="small text-danger">{{ $errors->first('model_id') }}</span>
                                            </div>
                                            </div>
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="small mb-1" for="make">Make</label>
                                                <select class="custom-select" id="make" name="make_id">
                                                    <option value=0>Select Make here</option>
                                                    @foreach ($makes as $make)
                                                    <option value="{{ $make->id }}">{{ $make->make_name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="small text-danger">{{ $errors->first('make_id') }}</span>
                                            </div>
                                            </div>
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="small mb-1" for="vendor">Vendor</label>
                                                <select class="custom-select" id="vendor" name="vendor_id">
                                                    <option value=0>Select Vendor here</option>
                                                    @foreach ($vendors as $vendor)
                                                    <option value="{{ $vendor->id }}">{{ $vendor->vendor_name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="small text-danger">{{ $errors->first('vendor_id') }}</span>
                                            </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="small mb-1" for="type">Device Type</label>
                                                <select class="custom-select" id="type" name="device_type">
                                                    <option value=0>Select Device Type here</option>
                                                    <option value="type1">Type One</option>
                                                    <option value="type2">Type Two</option>
                                                </select>
                                                <span class="small text-danger">{{ $errors->first('device_type') }}</span>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="nature">Item Nature</label>
                                                <select class="custom-select" id="nature" name="item_nature">
                                                    <option value=0>Select Item Nature here</option>
                                                    <option value="nature1">Nature One</option>
                                                    <option value="nature2">Nature Two</option>
                                                </select>
                                                <span class="small text-danger">{{ $errors->first('item_nature') }}</span>
                                            </div>
                                            <div class="form-group">
                                                    <label class="small mb-1" for="p_date">Purchase Date</label>
                                                    <input class="form-control py-2" id="p_date" name="purchase_date" type="date" placeholder="Enter purchase date here" />
                                                    <span class="small text-danger">{{ $errors->first('purchase_date') }}</span>
                                            </div>
                                            
                                            </div>
                                            <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="remarks">Remarks</label>
                                                        <textarea class="form-control" id="remarks" name="remarks" rows="8" placeholder="Enter Remarks here"></textarea>
                                                        <span class="small text-danger">{{ $errors->first('remarks') }}</span>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="price">Item Price</label>
                                                    <input class="form-control py-2" id="price" name="item_price" type="number" placeholder="Enter Item Price here" />
                                                    <span class="small text-danger">{{ $errors->first('item_price') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="challan">Delivery Challan</label>
                                                    <input class="form-control py-2" id="challan" name="delivery_challan" type="text" placeholder="Enter Delivery Challan here" />
                                                    <span class="small text-danger">{{ $errors->first('delivery_challan') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="challan_date">Delivery Challan Date</label>
                                                    <input class="form-control py-2" id="challan_date" name="delivery_challan_date" type="date" placeholder="Enter Delivery Challan Date here" />
                                                    <span class="small text-danger">{{ $errors->first('delivery_challan_date') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="invoice">Invoice Number</label>
                                                    <input class="form-control py-2" id="invoice" name="invoice_number" type="text" placeholder="Enter Invoice Number here" />
                                                    <span class="small text-danger">{{ $errors->first('invoice_number') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="invoice_date">Invoice Date</label>
                                                    <input class="form-control py-2" id="invoice_date" name="invoice_date" type="date" placeholder="Enter Invoice Date here" />
                                                    <span class="small text-danger">{{ $errors->first('invoice_date') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="form-row mt-5">
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="other">Other Accessories</label>
                                                        <textarea class="form-control" id="other" name="other_accessories" rows="3" placeholder="Enter Other Accessories here"></textarea>
                                                        <span class="small text-danger">{{ $errors->first('other_accessories') }}</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="good_condition">Good Condition</label>
                                                        <select class="custom-select" id="good_condition" name="good_condition">
                                                            <option value="yes">Yes</option>
                                                            <option value="no">No</option>
                                                        </select>
                                                        <span class="small text-danger">{{ $errors->first('good_condition') }}</span>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="verification" name="verification">
                                                        <label class="form-check-label" for="verification">Verification</label>
                                                        <span class="small text-danger">{{ $errors->first('verification') }}</span>
                                                    </div>
                                            </div>
                                            <!-- <div class="col-md-1">
                                            </div> -->
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="purpose">Purpose</label>
                                                        <textarea class="form-control" id="purpose" name="purpose" rows="3" placeholder="Enter Purpose here"></textarea>
                                                        <span class="small text-danger">{{ $errors->first('purpose') }}</span>
                                                    </div>
                                            </div>
                                        </div>
                                            <div class="form-group mt-4 mb-0">
                                            <input type="submit" name="add_inventory" value="Add Inventory" class="btn btn-primary btn-block">
                                            </div>
                                        </form>
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