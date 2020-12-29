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
                                                        <label class="small mb-1" for="emp_no">Employee No</label>
                                                        <input class="form-control" id="emp_no" name="emp_no" type="text" placeholder="Enter employee no here" />
                                                        <span class="small text-danger">{{ $errors->first('emp_no') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="name">Name</label>
                                                        <input class="form-control" id="name" name="name" type="text" placeholder="Enter name here" />
                                                        <span class="small text-danger">{{ $errors->first('name') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="branch">Branch</label>
                                                    <select class="custom-select" id="branch" name="branch">
                                                        <option value=null>Select Branch here</option>
                                                        <option value="branch1">Branch 1</option>
                                                        <option value="branch2">Branch 2</option>
                                                        <option value="branch3">Branch 3</option>
                                                    </select>
                                                    <span class="small text-danger">{{ $errors->first('branch') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="email">Email</label>
                                                    <input class="form-control" id="email" type="email" name="email" aria-describedby="emailHelp" placeholder="Enter email here" />
                                                    <span class="small text-danger">{{ $errors->first('email') }}</span>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="location">Location</label>
                                                    <select class="custom-select" id="location" name="location">
                                                        <option value=null>Select Location here</option>
                                                        <option value="location1">Location 1</option>
                                                        <option value="location2">Location 2</option>
                                                        <option value="location3">Location 3</option>
                                                    </select>
                                                    <span class="small text-danger">{{ $errors->first('location') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="contact">Contact No</label>
                                                        <input class="form-control" id="contact" name="contact" type="text" placeholder="Enter contact no here" />
                                                        <span class="small text-danger">{{ $errors->first('contact') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="department">Department</label>
                                                    <select class="custom-select" id="department" name="department">
                                                        <option value=null>Select Department here</option>
                                                        <option value="department1">Department 1</option>
                                                        <option value="department2">Department 2</option>
                                                        <option value="department3">Department 3</option>
                                                    </select>
                                                    <span class="small text-danger">{{ $errors->first('department') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="cell">Cell No</label>
                                                        <input class="form-control" id="cell" name="cell" type="text" placeholder="Enter cell no here" />
                                                        <span class="small text-danger">{{ $errors->first('cell') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="designation">Designation</label>
                                                    <select class="custom-select" id="designation" name="designation">
                                                        <option value=null>Select Designation here</option>
                                                        <option value="designation1">Designation 1</option>
                                                        <option value="designation2">Designation 2</option>
                                                        <option value="designation3">Designation 3</option>
                                                    </select>
                                                    <span class="small text-danger">{{ $errors->first('designation') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="extention">Extention No</label>
                                                        <input class="form-control" id="extention" name="extention" type="text" placeholder="Enter extention no here" />
                                                        <span class="small text-danger">{{ $errors->first('extention') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="hdd">HDD</label>
                                                    <select class="custom-select" id="hdd" name="hdd">
                                                        <option value=null>Select HDD here</option>
                                                        <option value="hdd1">HDD 1</option>
                                                        <option value="hdd2">HDD 2</option>
                                                        <option value="hdd3">HDD 3</option>
                                                    </select>
                                                    <span class="small text-danger">{{ $errors->first('hdd') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="status">Status</label>
                                                        <select class="custom-select" id="status" name="status">
                                                            <option value=null>Select Status here</option>
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
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