@extends("master")

@section("content")
<div id="layoutSidenav_content">
                <main>
                    <div class="container">
                    <div class="row mt-4"> 
                        <div class="col-md-10 col-lg-10">
                            <h1 class="">Edit Store</h1>
                        </div>
                        <div class="col-md-2 col-lg-2 text-right">
                            <a href="{{ url('store') }}" class="btn btn-success">View List</a>
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
                                        <form  method="POST" action="{{ url('store/'.$store->id) }}">
                                        @method('PUT')
                                        @csrf
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Store Name</label>
                                                        <input class="form-control" id="inputFirstName" type="text" name="store_name" value="{{ $store->store_name }}" placeholder="Enter store name here" Required="required" />
                                                        <span class="small text-danger">{{ $errors->first('store_name') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="location">Location</label>
                                                        <select class="custom-select" id="location" name="location_id">
                                                    <option value=0>Select Location here</option>
                                                    @foreach ($locations as $location)
                                                    @if($location->id == $store->location_id)
                                                    <option value="{{ $location->id }}" selected>{{ $location->location }}</option>
                                                    @else
                                                    <option value="{{ $location->id }}">{{ $location->location }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                <span class="small text-danger">{{ $errors->first('location_id') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="administrator">Administrator</label>
                                                        <select class="custom-select" id="administrator" name="administrator">
                                                            <option value=null>Select Administrator here</option>
                                                            @foreach ($users as $user)
                                                                @if($store->emp_id == $user->id){
                                                                <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                                                }
                                                                @else{
                                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                                }
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <span class="small text-danger">{{ $errors->first('administrator') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0">
                                            <input type="submit" name="update_store" value="Update Store" class="btn btn-primary btn-block">
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