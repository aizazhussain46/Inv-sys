@extends("master")

@section("content")
<div id="layoutSidenav_content">
                <main>
                    <div class="container">
                    <div class="row mt-4"> 
                        <div class="col-md-10 col-lg-10">
                            <h1 class="">Add dollar rate</h1>
                        </div>
                        <div class="col-md-2 col-lg-2 text-right">
                            <a href="{{ url('dollars') }}" class="btn btn-success">View List</a>
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
                                        <form  method="POST" action="{{ url('dollars') }}">
                                        @csrf
                                        
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Dollar Rate</label>
                                                        <input class="form-control t_seperator" id="inputFirstName" type="text" name="pkr_val" placeholder="Enter dollar rate here" Required="required" />
                                                        <span class="small text-danger">{{ $errors->first('pkr_val') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="year">Year</label>
                                                        <select class="custom-select" id="year" name="year_id">
                                                            <option value=null>Select Year here</option>
                                                            @foreach ($years as $year)
                                                            <option value="{{ $year->id }}">{{ $year->year }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="small text-danger">{{ $errors->first('year_id') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0">
                                            <input type="submit" name="add_dollar" value="Add Dollar Rate" class="btn btn-primary btn-block">
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