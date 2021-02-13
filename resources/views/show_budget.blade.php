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
                    <div class="col-md-2 col-lg-2">
                    @if(isset($filter))
                    @if($filter->locked == 1)
                    <a class="btn btn-success mt-3 text-white">Budget Locked</a>
                    <!-- <h3><span class="badge badge-success mt-3">Budget Locked</span></h3> -->
                    @else
                    <a class="btn btn-danger mt-3" href="{{ url('lock_budget/'.$filter->id) }}"><i class="fa fa-lock" aria-hidden="true"></i> Lock Budget</a>
                    @endif
                    @endif
                    </div>
                    <div class="col-md-8 col-lg-8">
                       
                            <div class="card mt-3">
                            <div class="card-header bg-primary text-white">
                            Select budget year
                            </div>
                                <div class="card-body">
                                <table class="table table-borderless">
                                        <tbody>                                     
                                            <tr>
                                            <form method="GET" action="{{ url('budget_by_year') }}">
                                            @csrf
                                                <td>
                                                    <select class="custom-select" name="category_id" required>
                                                    <option value=0>Select Category here</option>
                                                    @foreach ($categories as $category)
                                                    @if($category->id == $filters->catid)
                                                    <option value="{{ $category->id }}" selected>{{ $category->category_name }}</option>
                                                    @else
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                    @endif
                                                    @endforeach
                                                    </select>
                                                    <span class="small text-danger">{{ $errors->first('category_id') }}</span>
                                                </td>
                                                <td>
                                                    <select class="custom-select" name="year_id" required>
                                                    <option value=0>Select Year here</option>
                                                    @foreach ($years as $year)
                                                    @if($year->id == $filters->yearid)
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
                    </div>    
                        <div class="card mb-4 mt-3">
                            <div class="card-body">
                            @if(empty($budgets))
                            @else
                            <a class="btn btn-danger mb-1 float-right" href="{{ url('itemexport/'.json_encode($filters)) }}">Print <i class="fa fa-download" aria-hidden="true"></i></a>
                            @endif
                            <span class="text-danger">{{ $errors->first('inv_id') }}</span>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Type</th>
                                                <th>Item</th>
                                                <th>Dept</th>
                                                <th>Desc</th>
                                                <th>Qty</th>
                                                <th>Price Unit $</th>
                                                <th>Price Unit Rs</th>
                                                <th>Price Total $</th>
                                                <th>Price Total Rs</th>
                                                <th>Consumed</th>
                                                <th>Rem</th>
                                                <th>Remarks</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php 
                                        $i = 1; 
                                        $unit_b_d = 0;
                                        $unit_b_p = 0;
                                        $total_b_d = 0;
                                        $total_b_p = 0;
                                        $qty = 0;
                                        $t_consume = 0;
                                        $t_rem = 0;
                                        ?>
                                        @foreach ($budgets as $budget)
                                            <tr>
                                                <td class='text-align-right'>{{ $i++ }}</td>
                                                <td>{{ $budget->type_id?$budget->type->type:'' }}</td>
                                                <td>{{ $budget->subcategory_id?$budget->subcategory->sub_cat_name:'' }}</td>
                                                <td>{{ $budget->department }}</td>
                                                <td>{{ $budget->description }}</td>
                                                <td class='text-align-right'>{{ $budget->qty }}</td>
                                                <td>{{ number_format($budget->unit_price_dollar,2) }}</td>
                                                <td>{{ number_format($budget->unit_price_pkr,2) }}</td>
                                                <td>{{ number_format($budget->unit_price_dollar*$budget->qty,2) }}</td>
                                                <td>{{ number_format($budget->unit_price_pkr*$budget->qty,2) }}</td>
                                                
                                                <td class='text-align-right'>{{ $budget->consumed }}</td>
                                                <td class='text-align-right'>{{ $budget->remaining }}</td>
                                                <td>{{ $budget->remarks }}</td>
                                                <td class="text-center">
                                                @if(isset($filter) && $filter->locked != 1)
                                                <a href="{{ url('budget/'.$budget->id) }}" class="btn btn-sm btn-success">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
</svg>
                                                </a>
                                                <form method="POST" action="{{ url('budget/'.$budget->id) }}" class="d-inline-block">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg>
                                                </button>
                                                </form>
                                                @endif
                                                </td>
                                            </tr>
                                            <?php
                                            $unit_b_d += $budget->unit_price_dollar;
                                            $unit_b_p += $budget->unit_price_pkr;
                                            $total_b_d += $budget->unit_price_dollar*$budget->qty;
                                            $total_b_p += $budget->unit_price_pkr*$budget->qty;
                                            $qty += $budget->qty;
                                            $t_consume += $budget->consumed;
                                            $t_rem += $budget->remaining;
                                            ?>
                                        @endforeach 
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan='5' style="text-align:right;">Total</th>
                                                <td class='text-align-right'>{{ $qty }}</td>
                                                <td>{{ number_format($unit_b_d,2) }}</td>
                                                <td>{{ number_format($unit_b_p,2) }}</td>
                                                <td>{{ number_format($total_b_d,2) }}</td>
                                                <td>{{ number_format($total_b_p,2) }}</td>
                                                <td class='text-align-right'>{{ $t_consume }}</td>
                                                <td class='text-align-right'>{{ $t_rem }}</td>
                                                <td></td>
                                                <td></td>
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