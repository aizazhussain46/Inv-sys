@extends("master")

@section("content")
<div id="layoutSidenav_content">
                <main>
                    <div class="container">
                    <div class="row mt-4"> 
                        <div class="col-md-10 col-lg-10">
                            <h1 class="">Edit Inventory</h1>
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
                                        <form  method="POST" action="{{ url('inventory/'.$inventory->id) }}">
                                        @method('PUT')
                                        @csrf
                                
                                        <div class="form-row">
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="small mb-1" for="category">Category</label>
                                                <select class="custom-select" id="category" name="category_id">
                                                    <option value=0>Select Category here</option>
                                                    @foreach ($categories as $category)
                                                    @if($category->id == $inventory->category_id)
                                                    <option value="{{ $category->id }}" selected>{{ $category->category_name }}</option>
                                                    @else
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                    @endif
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
                                                    @if($location->id == $inventory->location_id)
                                                    <option value="{{ $location->id }}" selected>{{ $location->location }}</option>
                                                    @else
                                                    <option value="{{ $location->id }}">{{ $location->location }}</option>
                                                    @endif
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
                                                    @if($department->id == $inventory->department_id)
                                                    <option value="{{ $department->id }}" selected>{{ $department->department_name }}</option>
                                                    @else
                                                    <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                                    @endif
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
                                                    @if($branch->id == $inventory->branch_id)
                                                    <option value="{{ $branch->id }}" selected>{{ $branch->branch_name }}</option>
                                                    @else
                                                    <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                                    @endif
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
                                                    @if($store->id == $inventory->store_id)
                                                    <option value="{{ $store->id }}" selected>{{ $store->store_name }}</option>
                                                    @else
                                                    <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                                                    @endif
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
                                                        <input class="form-control py-2" id="pro" name="product_sn" type="text" value="{{ $inventory->product_sn }}" placeholder="Enter product s/n here" />
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
                                                    @if($model->id == $inventory->model_id)
                                                    <option value="{{ $model->id }}" selected>{{ $model->model_name }}</option>
                                                    @else
                                                    <option value="{{ $model->id }}">{{ $model->model_name }}</option>
                                                    @endif
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
                                                    @if($make->id == $inventory->make_id)
                                                    <option value="{{ $make->id }}" selected>{{ $make->make_name }}</option>
                                                    @else
                                                    <option value="{{ $make->id }}">{{ $make->make_name }}</option>
                                                    @endif
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
                                                    @if($vendor->id == $inventory->vendor_id)
                                                    <option value="{{ $vendor->id }}" selected>{{ $vendor->vendor_name }}</option>
                                                    @else
                                                    <option value="{{ $vendor->id }}">{{ $vendor->vendor_name }}</option>
                                                    @endif
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
                                                    <option value="type1" {{ $inventory->device_type == 'type1'? 'selected':''}}>Type One</option>
                                                    <option value="type2" {{ $inventory->device_type == 'type2'? 'selected':''}}>Type Two</option>
                                                </select>
                                                <span class="small text-danger">{{ $errors->first('device_type') }}</span>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="nature">Item Nature</label>
                                                <select class="custom-select" id="nature" name="item_nature">
                                                    <option value=0>Select Item Nature here</option>
                                                    <option value="nature1" {{ $inventory->item_nature == 'nature1'? 'selected':''}}>Nature One</option>
                                                    <option value="nature2" {{ $inventory->item_nature == 'nature2'? 'selected':''}}>Nature Two</option>
                                                </select>
                                                <span class="small text-danger">{{ $errors->first('item_nature') }}</span>
                                            </div>
                                            <div class="form-group">
                                                    <label class="small mb-1" for="p_date">Purchase Date</label>
                                                    <input class="form-control py-2" id="p_date" name="purchase_date" type="date" value="{{ $inventory->purchase_date }}" placeholder="Enter purchase date here" />
                                                    <span class="small text-danger">{{ $errors->first('purchase_date') }}</span>
                                            </div>
                                            
                                            </div>
                                            <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="remarks">Remarks</label>
                                                        <textarea class="form-control" id="remarks" name="remarks" rows="8" placeholder="Enter Remarks here">{{ $inventory->remarks }}</textarea>
                                                        <span class="small text-danger">{{ $errors->first('remarks') }}</span>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="price">Item Price</label>
                                                    <input class="form-control py-2" id="price" name="item_price" type="number" value="{{ $inventory->item_price }}" placeholder="Enter Item Price here" />
                                                    <span class="small text-danger">{{ $errors->first('item_price') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="challan">Delivery Challan</label>
                                                    <input class="form-control py-2" id="challan" name="delivery_challan" type="text" value="{{ $inventory->delivery_challan }}" placeholder="Enter Delivery Challan here" />
                                                    <span class="small text-danger">{{ $errors->first('delivery_challan') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="challan_date">Delivery Challan Date</label>
                                                    <input class="form-control py-2" id="challan_date" name="delivery_challan_date" type="date" value="{{ $inventory->delivery_challan_date }}" placeholder="Enter Delivery Challan Date here" />
                                                    <span class="small text-danger">{{ $errors->first('delivery_challan_date') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="invoice">Invoice Number</label>
                                                    <input class="form-control py-2" id="invoice" name="invoice_number" type="text" value="{{ $inventory->invoice_number }}" placeholder="Enter Invoice Number here" />
                                                    <span class="small text-danger">{{ $errors->first('invoice_number') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="invoice_date">Invoice Date</label>
                                                    <input class="form-control py-2" id="invoice_date" name="invoice_date" type="date" value="{{ $inventory->invoice_date }}" placeholder="Enter Invoice Date here" />
                                                    <span class="small text-danger">{{ $errors->first('invoice_date') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="form-row mt-5">
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="other">Other Accessories</label>
                                                        <textarea class="form-control" id="other" name="other_accessories" rows="3" placeholder="Enter Other Accessories here">{{ $inventory->other_accessories }}</textarea>
                                                        <span class="small text-danger">{{ $errors->first('other_accessories') }}</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="good_condition">Good Condition</label>
                                                        <select class="custom-select" id="good_condition" name="good_condition">
                                                            <option value="yes" {{ $inventory->good_condition == 'yes'? 'selected':''}}>Yes</option>
                                                            <option value="no" {{ $inventory->good_condition == 'no'? 'selected':''}}>No</option>
                                                        </select>
                                                        <span class="small text-danger">{{ $errors->first('good_condition') }}</span>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="verification" name="verification" {{ $inventory->verification? 'checked':''}}>
                                                        <label class="form-check-label" for="verification">Verification</label>
                                                        <span class="small text-danger">{{ $errors->first('verification') }}</span>
                                                    </div>
                                            </div>
                                            <!-- <div class="col-md-1">
                                            </div> -->
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="purpose">Purpose</label>
                                                        <textarea class="form-control" id="purpose" name="purpose" rows="3" placeholder="Enter Purpose here">{{ $inventory->purpose }}</textarea>
                                                        <span class="small text-danger">{{ $errors->first('purpose') }}</span>
                                                    </div>
                                            </div>
                                        </div>
                                            <div class="form-group mt-4 mb-0">
                                            <input type="submit" name="update_inventory" value="Update Inventory" class="btn btn-primary btn-block">
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