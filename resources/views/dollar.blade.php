@extends("master")

@section("content")
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                    <div class="row mt-4"> 
                        <div class="col-md-10 col-lg-10">
                            <h1 class="">Dollar Rates</h1>
                        </div>
                        <div class="col-md-2 col-lg-2 text-right">
                            <a href="{{ url('add_dollar_price') }}" class="btn btn-success">Add<svg width="1.8em" height="1.8em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
</svg></a>
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
                                                <th>Dollar Rate</th>
                                                <th>Year</th>
                                                <th>Craeted at</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($dollars as $dollar)
                                            <tr>
                                                <td class='text-align-right'>{{ $i++ }}</td>
                                                <td class='text-align-right'>{{ number_format($dollar->pkr_val,2) }}</td>
                                                <td>{{ $dollar->year->year }}</td>
                                                <td>{{ date('Y-m-d' ,strtotime($dollar->created_at)) }}</td>
                                                <td class="text-center">
                                                <form method="POST" action="{{ url('dollars/'.$dollar->id) }}" class="d-inline-block">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg>
                                                </button>
                                                </form>
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