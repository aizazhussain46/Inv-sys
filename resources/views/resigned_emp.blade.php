@extends("master")

@section("content")
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    <div class="row mt-4"> 
                        <div class="col-md-10 col-lg-10">
                            <h1 class="">Resigned Employees</h1>
                        </div>
                    </div>
                        <hr />
                    @if (session('msg'))
                        <div class="alert alert-success">
                            {{ session('msg') }}
                        </div>
                    @endif
                        <div class="card mb-4 mt-5">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Emp Code</th>
                                                <th>Resign Date</th>
                                                <th>Effective From</th>
                                                <th>Done Date</th>
                                                <th>Remarks</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($resigned as $res)
                                            <tr style="font-weight:<?php echo $res->status == 0?500:300; ?>">
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $res->emp_code }}</td>
                                                <td>{{ date('Y-m-d' ,strtotime($res->resign_date)) }}</td>
                                                <td>{{ date('Y-m-d' ,strtotime($res->effective_from)) }}</td>
                                                <td>{{ date('Y-m-d' ,strtotime($res->done_date)) }}</td>
                                                <td>{{ $res->remarks }}</td>
                                                <td>{{ $res->status == 1?'Taken':'Revoke' }}</td>
                                                <td class="text-center">
                                                @if($res->status == 0)
                                                <a href="{{ url('resignedemployee/'.$res->id) }}" class="btn btn-sm btn-success">Revoke</a>
                                                @endif
                                                </td>
                                            </tr>
                                        @endforeach    
                                        </tbody>
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