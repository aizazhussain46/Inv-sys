@extends("master")

@section("content")

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    <div class="row mt-4"> 
                        <div class="col-md-10 col-lg-10">
                            <h1 class="">Pending GRNs</h1>
                        </div>
                    </div>
                        <hr />
                    @if (session('msg'))
                        <div class="alert alert-success">
                            {{ session('msg') }}
                        </div>
                    @endif
                    <form  method="POST" action="{{ url('process_to_grn') }}">
                    @csrf   
                        <div class="card mb-4 mt-3">
                            <div class="card-body">
                            <span class="text-danger">{{ $errors->first('inventory_check') }}</span>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Product S#</th>
                                                <th>Make</th>
                                                <th>Model</th>
                                                <th>Purchase Date</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th>Dollar Rate</th>
                                                <th>Created at</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($inventories as $inventory)
                                            <tr>
                                                <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name='inventory_check[]' value="{{ $inventory->id }}">
                                                    <label class="form-check-label" for="exampleCheck1">{{ $i++ }}</label>
                                                </div>
                                                </td>
                                                <td>{{ $inventory->product_sn }}</td>
                                                <td>{{ $inventory->make_id?$inventory->make->make_name:'' }}</td>
                                                <td>{{ $inventory->model_id?$inventory->model->model_name:'' }}</td>
                                                <td>{{ date('Y-m-d' ,strtotime($inventory->purchase_date)) }}</td>
                                                <td>{{ $inventory->category_id?$inventory->category->category_name:'' }}</td>
                                                <td class='text-align-right'>{{ number_format($inventory->item_price,2) }}</td>
                                                <td class='text-align-right'>{{ number_format($inventory->dollar_rate,2) }}</td>
                                                <td>{{ date('Y-m-d' ,strtotime($inventory->created_at)) }}</td>
                                            </tr>
                                        @endforeach    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <div class="form-group mt-4 mb-0">
                        <input type="submit" name="process" value="Process to GRN" class="btn btn-success btn-block">
                        </div>
                </form>
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