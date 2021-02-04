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
                    @csrf
                    <div class="row justify-content-center"> 
                    
                        <div class="col-md-8 col-lg-8">
                            <div class="card mt-3">
                            <div class="card-header bg-primary text-white">
                            GIN
                            </div>
                                <div class="card-body">
                                <form  method="POST" action="{{ url('filter_gin') }}">
                                @csrf
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="from">From</label>
                                                    <input class="form-control" id="from" name="from" type="date" placeholder="Enter date here" required />
                                                    <span class="small text-danger">{{ $errors->first('from') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="to">To</label>
                                                    <input class="form-control" id="to" name="to" type="date" placeholder="Enter date here" required />
                                                    <span class="small text-danger">{{ $errors->first('to') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                <label class="small mb-1" for="to"></label>
                                                <input type="submit" name="range" value="Show" class="form-control btn btn-primary">
                                                </div>
                                            </div>
                                        </div>           
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>   
                    </div>    
                        <div class="card mb-4 mt-3">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>GIN No</th>
                                                <th>Created at</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($gins as $gin)
                                            <tr>
                                                <td class='text-align-right'>{{ $i++ }}</td>
                                                <td class='text-align-right'>
                                                @if(isset($range))
                                                <a href="{{ url('generate-gin/'.$gin->id.'/'.$range['from'].'/'.$range['to']) }}">{{ $gin->gin_no }}</a>
                                                @else
                                                <a href="{{ url('generate-gin/'.$gin->id.'/0/'.date('Y-m-d')) }}">{{ $gin->gin_no }}</a>
                                                @endif
                                                </td>
                                                <td>{{ date('Y-m-d' ,strtotime($gin->created_at)) }}</td>
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