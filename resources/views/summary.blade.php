@extends("master")

@section("content")

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    
                    @if (session('msg'))
                        <div class="alert alert-success mt-4">
                            {{ session('msg') }}
                        </div>
                    @endif
        
                    <div class="row justify-content-center"> 
                    
                    <div class="col-md-6 col-lg-6">
                       
                            <div class="card mt-3">
                            <div class="card-header bg-primary text-white">
                            Select budget year
                            </div>
                                <div class="card-body">
                                <table class="table table-borderless">
                                        <tbody>                                     
                                            <tr>
                                            <form method="POST" action="{{ url('summary_by_year') }}">
                                            @csrf
                    
                                                <td>
                                                    <select class="custom-select" name="year_id" required>
                                                    <option value=0>Select Year here</option>
                                                    @foreach ($years as $year)
                                                    <option value="{{ $year->id }}">{{ $year->year }}</option>
                                                    @endforeach
                                                    </select>
                                                    <span class="small text-danger">{{ $errors->first('year_id') }}</span>
                                                </td>
                                                <td><button type="submit" name="show" class="btn btn-primary">Show</button></td>
                                                </form>
                                            </tr>
                                        </tbody>
                                </table>
                                          
                                </div>
                            </div>
                        </div>   
                    </div>   
                        <div class="card mb-4 mt-3">
                            <div class="card-body">
                            <span class="text-danger">{{ $errors->first('inv_id') }}</span>
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Category</th>
                                                <th>Price Unit $</th>
                                                <th>Price Unit PKR</th>
                                                <th>Price Total $</th>
                                                <th>Price Total PKR</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php 
                                        $i = 1;
                                        $unit_b_d = 0;
                                        $unit_b_p = 0;
                                        $total_b_d = 0;
                                        $total_b_p = 0;
                                        ?>
                                        @foreach ($categories as $budget)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $budget->category_name }}</td>
                                                <td>{{ $budget->unit_price_dollar }}$</td>
                                                <td>Rs{{ $budget->unit_price_pkr }}</td>
                                                <td>{{ $budget->total_price_dollar }}$</td>
                                                <td>Rs{{ $budget->total_price_pkr }}</td>
                                            </tr>
                                            <?php
                                            $unit_b_d += $budget->unit_price_dollar;
                                            $unit_b_p += $budget->unit_price_pkr;
                                            $total_b_d += $budget->total_price_dollar;
                                            $total_b_p += $budget->total_price_pkr;
                                            ?>
                                        @endforeach 
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan='2' style="text-align:right;">Grand Total</th>
                                                <td>{{ $unit_b_d }}$</td>
                                                <td>Rs{{ $unit_b_p }}</td>
                                                <td>{{ $total_b_d }}$</td>
                                                <td>Rs{{ $total_b_p }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
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