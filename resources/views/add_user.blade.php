@extends("master")

@section("content")
<div id="layoutSidenav_content">
                <main>
                    <div class="container">
                    <div class="row mt-4"> 
                        <div class="col-md-10 col-lg-10">
                            <h1 class="">Add User</h1>
                        </div>
                        <div class="col-md-2 col-lg-2 text-right">
                            <a href="{{ url('user') }}" class="btn btn-success">View List</a>
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
                                        <form  method="POST" action="{{ url('user') }}">
                                        @csrf
                                        <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="emp_no">Employee Code</label>
                                                        <input class="form-control" id="emp_no" name="emp_no" type="text" placeholder="Enter employee code here" />
                                                        <span class="small text-danger">{{ $errors->first('emp_no') }}</span>
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
                                                        <input class="form-control" id="hod" name="hdd" type="text" placeholder="Enter HOD name here" readonly />
                                                        <span class="small text-danger">{{ $errors->first('hdd') }}</span>
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

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="password">Password</label>
                                                        <input class="form-control" id="password" type="password" name="password" placeholder="Enter password here" />
                                                        <span class="small text-danger">{{ $errors->first('password') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="confirmpassword">Confirm Password</label>
                                                        <input class="form-control" id="confirmpassword" type="password" name="confirm_password" placeholder="Confirm password here" />
                                                        <span class="small text-danger">{{ $errors->first('confirm_password') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="role">Role</label>
                                                <select class="custom-select" id="role" name="role_id">
                                                    <option value=null>Select Role here</option>
                                                    @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="small text-danger">{{ $errors->first('role_id') }}</span>
                                            </div>
                                            <div class="form-group mt-4 mb-0">
                                            <input type="submit" name="add_user" value="Add User" class="btn btn-primary btn-block">
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