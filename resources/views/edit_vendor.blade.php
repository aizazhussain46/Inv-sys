@extends("master")

@section("content")
<div id="layoutSidenav_content">
                <main>
                    <div class="container">
                    <div class="row mt-4"> 
                        <div class="col-md-10 col-lg-10">
                            <h1 class="">Edit Vendor</h1>
                        </div>
                        <div class="col-md-2 col-lg-2 text-right">
                            <a href="{{ url('vendor') }}" class="btn btn-success">View List</a>
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
                                        <form  method="POST" action="{{ url('vendor/'.$vendor->id) }}">
                                        @csrf
                                        @method('PUT')
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Vendor Name</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" name="vendor_name" value="{{ $vendor->vendor_name }}" placeholder="Enter vendor name here" Required="required" />
                                                        <span class="small text-danger">{{ $errors->first('vendor_name') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="address">Address</label>
                                                        <input class="form-control" id="address" type="text" name="address" value="{{ $vendor->address }}" placeholder="Enter address here" Required="required" />
                                                        <span class="small text-danger">{{ $errors->first('address') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="telephone">Telephone No</label>
                                                        <input class="form-control" id="telephone" type="text" name="telephone" value="{{ $vendor->telephone }}" placeholder="Enter telephone no here" />
                                                        <span class="small text-danger">{{ $errors->first('telephone') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="contact_person">Contact Person</label>
                                                        <input class="form-control" id="contact_person" type="text" name="contact_person" value="{{ $vendor->contact_person }}" placeholder="Enter contact person here" Required="required" />
                                                        <span class="small text-danger">{{ $errors->first('contact_person') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="email">Email</label>
                                                        <input class="form-control" id="email" type="text" name="email" value="{{ $vendor->email }}" placeholder="Enter email here" Required="required" />
                                                        <span class="small text-danger">{{ $errors->first('email') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="cell">Cell Number</label>
                                                        <input class="form-control" id="cell" type="text" name="cell" value="{{ $vendor->cell }}" placeholder="Enter cell number here" />
                                                        <span class="small text-danger">{{ $errors->first('cell') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0">
                                            <input type="submit" name="update_vendor" value="Update Vendor" class="btn btn-primary btn-block">
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