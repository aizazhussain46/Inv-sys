@extends("master")

@section("content")
<div id="layoutSidenav_content">
                <main>
                    <div class="container">
                    <div class="row mt-4"> 
                        <div class="col-md-10 col-lg-10">
                            <h1 class="">Assets Repairing</h1>
                        </div>
                    </div>
                    <hr />
                    @if (session('msg'))
                        <div class="alert alert-success">
                            {{ session('msg') }}
                        </div>
                    @endif
                    <div class="row">
                    <div class="col-md-1 col-lg-1"></div>
                            <div class="col-sm-10 col-md-10 col-lg-10">
                                <div class="card border-0 rounded-lg mt-3">
                                    <div class="card-body">
                                        <form  method="POST" action="{{ url('repair_inventory') }}">
                                        @csrf
                                        <div class="form-row">
                                                <div class="col-md-6">
                                                <label class="small mb-1" for="item">Item List</label>
                                                <select class="custom-select" id="item" name="item_id">
                                                    <option value=0>Select Item here</option>
                                                    @foreach ($inventories as $inventory)
                                                    <option value="{{ $inventory->id }}">{{ $inventory->product_sn }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="small text-danger">{{ $errors->first('item_id') }}</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="date">Date</label>
                                                        <input class="form-control py-2" id="date" name="date" type="date" placeholder="Enter date here" />
                                                        <span class="small text-danger">{{ $errors->first('date') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="a_price">Actual Price Value</label>
                                                        <input class="form-control py-2" id="a_price" name="actual_price_value" type="text" placeholder="Enter Actual Price Value here" />
                                                        <span class="small text-danger">{{ $errors->first('actual_price_value') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="price">Price Value</label>
                                                        <input class="form-control py-2" id="price" name="price_value" type="text" placeholder="Enter Price Value here" />
                                                        <span class="small text-danger">{{ $errors->first('price_value') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="remarks">Remarks</label>
                                                        <textarea class="form-control" id="remarks" name="remarks" rows="4" placeholder="Enter Remarks here"></textarea>
                                                        <span class="small text-danger">{{ $errors->first('remarks') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0">
                                            <input type="submit" name="repair_inventory" value="Repair" class="btn btn-primary btn-block">
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