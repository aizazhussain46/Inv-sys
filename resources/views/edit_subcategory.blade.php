@extends("master")

@section("content")
<div id="layoutSidenav_content">
                <main>
                    <div class="container">
                    <div class="row mt-4"> 
                        <div class="col-md-10 col-lg-10">
                            <h1 class="">Edit Sub Category</h1>
                        </div>
                        <div class="col-md-2 col-lg-2 text-right">
                            <a href="{{ url('sub_category') }}" class="btn btn-success">View List</a>
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
                                        <form  method="POST" action="{{ url('sub_category/'.$subcategory->id) }}">
                                        @method('PUT')
                                        @csrf
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="category">Category</label>
                                                    <select class="custom-select" id="category" name="category_id">
                                                        <option value=0>Select Category here</option>
                                                        @foreach ($categories as $category)
                                                        @if($category->id == $subcategory->category_id)
                                                        <option value="{{ $category->id }}" selected>{{ $category->category_name }}</option>
                                                        @else
                                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    <span class="small text-danger">{{ $errors->first('category_id') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="sub_cat_name">Sub Category Name</label>
                                                        <input class="form-control" id="sub_cat_name" type="text" name="sub_cat_name" value="{{ $subcategory->sub_cat_name }}" placeholder="Enter sub category name here" Required="required" />
                                                        <span class="small text-danger">{{ $errors->first('sub_cat_name') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="threshold">Threshold Value</label>
                                                        <input class="form-control" id="threshold" type="text" name="threshold" value="{{ $subcategory->threshold }}" placeholder="Enter Threshold value here" Required="required" />
                                                        <span class="small text-danger">{{ $errors->first('threshold') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="status">Status</label>
                                                        <select class="custom-select" id="status" name="status">
                                                        <option value="1" {{ $subcategory->status == '1'? 'selected':''}}>Active</option>
                                                            <option value="0" {{ $subcategory->status == '0'? 'selected':''}}>Inactive</option>
                                                        </select>
                                                        <span class="small text-danger">{{ $errors->first('status') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0">
                                            <input type="submit" name="edit_sub_category" value="Edit Sub Category" class="btn btn-primary btn-block">
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