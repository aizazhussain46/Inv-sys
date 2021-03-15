@extends("master")

@section("content")
<div id="layoutSidenav_content">
                <main>
                    <div class="container">
                    <div class="row mt-4"> 
                        <div class="col-md-10 col-lg-10">
                            <h1 class="">Edit User</h1>
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
                                        <form  method="POST" action="{{ url('user/'.$user->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <!-- <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="emp_no">Employee No</label>
                                                        <input class="form-control" id="emp_no" name="emp_no" type="text" value="{{ $user->emp_no }}" placeholder="Enter employee no here" />
                                                        <span class="small text-danger">{{ $errors->first('emp_no') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="name">Name</label>
                                                        <input class="form-control" id="name" name="name" type="text" value="{{ $user->name }}" placeholder="Enter name here" />
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
                                                        <option value="branch1" {{ $user->branch == 'branch1'? 'selected':''}}>Branch 1</option>
                                                        <option value="branch2" {{ $user->branch == 'branch2'? 'selected':''}}>Branch 2</option>
                                                        <option value="branch3" {{ $user->branch == 'branch3'? 'selected':''}}>Branch 3</option>
                                                    </select>
                                                    <span class="small text-danger">{{ $errors->first('branch') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="email">Email</label>
                                                <input class="form-control" id="email" type="email" name="email" value="{{ $user->email }}" aria-describedby="emailHelp" placeholder="Enter email here" />
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
                                                        <option value="location1" {{ $user->location == 'location1'? 'selected':''}}>Location 1</option>
                                                        <option value="location2" {{ $user->location == 'location2'? 'selected':''}}>Location 2</option>
                                                        <option value="location3" {{ $user->location == 'location3'? 'selected':''}}>Location 3</option>
                                                    </select>
                                                    <span class="small text-danger">{{ $errors->first('location') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="contact">Contact No</label>
                                                        <input class="form-control" id="contact" name="contact" type="text" value="{{ $user->contact }}" placeholder="Enter contact no here" />
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
                                                        <option value="department1" {{ $user->department == 'department1'? 'selected':''}}>Department 1</option>
                                                        <option value="department2" {{ $user->department == 'department2'? 'selected':''}}>Department 2</option>
                                                        <option value="department3" {{ $user->department == 'department3'? 'selected':''}}>Department 3</option>
                                                    </select>
                                                    <span class="small text-danger">{{ $errors->first('department') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="cell">Cell No</label>
                                                        <input class="form-control" id="cell" name="cell" type="text" value="{{ $user->cell }}" placeholder="Enter cell no here" />
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
                                                        <option value="designation1" {{ $user->designation == 'designation1'? 'selected':''}}>Designation 1</option>
                                                        <option value="designation2" {{ $user->designation == 'designation2'? 'selected':''}}>Designation 2</option>
                                                        <option value="designation3" {{ $user->designation == 'designation3'? 'selected':''}}>Designation 3</option>
                                                    </select>
                                                    <span class="small text-danger">{{ $errors->first('designation') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="extention">Extention No</label>
                                                        <input class="form-control" id="extention" name="extention" type="text" value="{{ $user->extention }}" placeholder="Enter extention no here" />
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
                                                        <option value="hdd1" {{ $user->hdd == 'hdd1'? 'selected':''}}>HDD 1</option>
                                                        <option value="hdd2" {{ $user->hdd == 'hdd2'? 'selected':''}}>HDD 2</option>
                                                        <option value="hdd3" {{ $user->hdd == 'hdd3'? 'selected':''}}>HDD 3</option>
                                                    </select>
                                                    <span class="small text-danger">{{ $errors->first('hdd') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="status">Status</label>
                                                        <select class="custom-select" id="status" name="status">
                                                            <option value=null>Select Status here</option>
                                                            <option value="1" {{ $user->status == '1'? 'selected':''}}>Active</option>
                                                            <option value="0" {{ $user->status == '0'? 'selected':''}}>Inactive</option>
                                                        </select>
                                                        <span class="small text-danger">{{ $errors->first('status') }}</span>
                                                    </div>
                                                </div>
                                            </div> -->
                                            
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="password">Password</label>
                                                        <input class="form-control" id="password" type="password" name="password" placeholder="Enter password here" />
                                                        <span class="small text-danger">{{ $errors->first('password') }}</span>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="confirmpassword">Confirm Password</label>
                                                        <input class="form-control" id="confirmpassword" type="password" name="confirm_password" placeholder="Confirm password here" />
                                                        <span class="small text-danger">{{ $errors->first('confirm_password') }}</span>
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="role">Role</label>
                                                <select class="custom-select" id="role" name="role_id">
                                                    <option value=0>Select Role here</option>
                                                    @foreach ($roles as $role)
                                                    @if($role->id == $user->role_id)
                                                    <option value="{{ $role->id }}" selected>{{ $role->role }}</option>
                                                    @else
                                                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                <span class="small text-danger">{{ $errors->first('role_id') }}</span>
                                            </div>
                                            <div class="form-group mt-4 mb-0">
                                            <input type="submit" name="update_user" value="Update User" class="btn btn-primary btn-block">
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