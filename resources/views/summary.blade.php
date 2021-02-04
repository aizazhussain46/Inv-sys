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
        
                    <div class="row"> 
                    <div class="col-md-3 col-lg-3">
                    </div>
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
                                                    @if($year->id == $filter)
                                                    <option value="{{ $year->id }}" selected>{{ $year->year }}</option>
                                                    @else
                                                    <option value="{{ $year->id }}">{{ $year->year }}</option>
                                                    @endif
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
                        <div class="col-md-3 col-lg-3">
                            @if(empty($types))
                            @else
                            <a class="btn btn-danger mt-3 mb-1 float-right" href="{{ url('budgetexport/'.$filter) }}">Print <i class="fa fa-download" aria-hidden="true"></i></a>
                            @endif
                    </div>  
                    </div>
                    @if(empty($types))
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
                                                <th>Consumed</th>
                                                <th>Remaining</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>    
                    </div>                    
                    @else
                    @foreach($types as $type)   
                        <div class="card mb-4 mt-3">
                            <div class="card-body">
                            <h3><u>{{ $type->type }}</u></h3>
                            
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
                                                <th>Consumed</th>
                                                <th>Remaining</th>
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
                                        @foreach ($type->categories as $budget)
                                            <tr>
                                                <td class='text-align-right'>{{ $i++ }}</td>
                                                <td>{{ $budget->category_name }}</td>
                                                <td class='text-align-right'>{{ $budget->unit_price_dollar }}$</td>
                                                <td class='text-align-right'>Rs{{ $budget->unit_price_pkr }}</td>
                                                <td class='text-align-right'>{{ $budget->total_price_dollar }}$</td>
                                                <td class='text-align-right'>Rs{{ $budget->total_price_pkr }}</td>
                                                <td class='text-align-right'>{{ $budget->consumed }}</td>
                                                <td class='text-align-right'>{{ $budget->remaining }}</td>
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
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div> 
                    @endforeach 
                    @endif   
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