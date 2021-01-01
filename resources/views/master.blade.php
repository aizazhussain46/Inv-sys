<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Inventory System</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            
            <!-- Navbar-->
            <ul class="navbar-nav d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <form method="POST" action="{{ route('logout') }}">
                    @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>    
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <!-- Inventories -->
                            <!-- <div class="sb-sidenav-menu-heading">Interface</div> -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inventories" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Inventories
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="inventories" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ url('add_inventory') }}">Add</a>
                                    <a class="nav-link" href="{{ url('add_with_grn') }}">Add with GRN</a>
                                    <a class="nav-link" href="{{ url('pendings') }}">Pending GRNs</a>
                                    <a class="nav-link" href="{{ url('inventory') }}">All Inventories</a>
                                    <a class="nav-link" href="{{ url('issue_inventory') }}">Issue Inventory</a>
                                    <a class="nav-link" href="{{ url('issue_with_gin') }}">Issue with GIN</a>
                                    <a class="nav-link" href="{{ url('pending_gins') }}">Pending GINs</a>
                                    <a class="nav-link" href="{{ url('transfer_inventory') }}">Transfer Inventory</a>
                                    <a class="nav-link" href="{{ url('return_inventory') }}">Return Inventory</a>
                                    <a class="nav-link" href="{{ url('repair') }}">Asset Repairing</a>
                                </nav>
                            </div>

                            <!-- Reports -->
                            <!-- <div class="sb-sidenav-menu-heading">Interface</div> -->
                            <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#reports" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Reports
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="reports" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                                </nav>
                            </div> -->

                            <!-- User Management -->
                            <!-- <div class="sb-sidenav-menu-heading">Interface</div> -->
                            @if(Auth::user()->role_id == 1)
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                User Management
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <!-- Category -->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categories" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Categories
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="categories" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{ url('add_category') }}">Add Category</a>
                                            <a class="nav-link" href="{{ url('category') }}">List Category</a>
                                        </nav>
                                    </div>
                                    <!-- Users -->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#users" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Users
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="users" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{ url('add_user') }}">Add User</a>
                                            <a class="nav-link" href="{{ url('user') }}">List Users</a>
                                        </nav>
                                    </div>
                                    <!-- Employees -->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#emp" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Employees
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="emp" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{ url('add_employee') }}">Add Employee</a>
                                            <a class="nav-link" href="{{ url('employee') }}">List Employees</a>
                                        </nav>
                                    </div>
                                    <!-- Branch -->
                                    <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#branch" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Branch
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="branch" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{ url('add_branch') }}">Add Branch</a>
                                            <a class="nav-link" href="{{ url('branch') }}">List Branch</a>
                                        </nav>
                                    </div> -->
                                    <!-- Department -->
                                    <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#department" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Department
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="department" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{ url('add_department') }}">Add Department</a>
                                            <a class="nav-link" href="{{ url('department') }}">List Department</a>
                                        </nav>
                                    </div> -->
                                    <!-- Location -->
                                    <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#location" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Location
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="location" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{ url('add_location') }}">Add Location</a>
                                            <a class="nav-link" href="{{ url('location') }}">List Location</a>
                                        </nav>
                                    </div> -->
                                    <!-- Model -->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#model" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Model
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="model" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{ url('add_model') }}">Add Model</a>
                                            <a class="nav-link" href="{{ url('model') }}">List Model</a>
                                        </nav>
                                    </div>
                                    <!-- Make -->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#make" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Make
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="make" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{ url('add_make') }}">Add Make</a>
                                            <a class="nav-link" href="{{ url('make') }}">List Makes</a>
                                        </nav>
                                    </div>
                                    <!-- Role -->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#role" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Role
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="role" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{ url('add_role') }}">Add Role</a>
                                            <a class="nav-link" href="{{ url('role') }}">List Role</a>
                                        </nav>
                                    </div>
                                    <!-- Store -->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#store" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Store
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="store" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{ url('add_store') }}">Add Store</a>
                                            <a class="nav-link" href="{{ url('store') }}">List Store</a>
                                        </nav>
                                    </div>
                                    <!-- Vendor -->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#vendor" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Vendor
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="vendor" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{ url('add_vendor') }}">Add Vendor</a>
                                            <a class="nav-link" href="{{ url('vendor') }}">List Vendors</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{ Auth::user()->name }}
                    </div>
                </nav>
            </div>
            @yield("content")
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/assets/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('assets/assets/demo/chart-bar-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/assets/demo/datatables-demo.js') }}"></script>
    </body>
</html>

<script type="text/javascript">
$(document).ready(function(){
    $("#show").click(function(){
        $("#form").attr({method:'GET', action:'{{ url("filter_inventory") }}'})
        $("#form").submit();
    });
    $("#transfer").click(function(){
        $("#form").attr({method:'POST', action:'{{ url("transfer") }}'})
        $("#form").submit();
    });

    $("#rshow").click(function(){
        $("#rform").attr({method:'GET', action:'{{ url("filter_return") }}'})
        $("#rform").submit();
    });
    $("#return").click(function(){
        $("#rform").attr({method:'POST', action:'{{ url("return") }}'})
        $("#rform").submit();
    });
    

    $('#emp_code').keydown(function(e) {
        var code = e.keyCode || e.which;
        if (code === 9 || code === 13) {  
            e.preventDefault();
            var emp_code = $('#emp_code').val();
            
            var settings = {
            "url": "https://cloud.efulife.com:8080/devinv/empdata.php?uid="+emp_code,
            "method": "GET",
            "timeout": 0,
            };
            $.ajax(settings).done(function (response) {
                if(response.Login != null){
                    var res = response.Login[0];
                    console.log(response);
                    $('#name').val(res.EMPLOYEE_NAME);
                    $('#designation').val(res.DESIGNATION);
                    $('#department').val(res.DEPARTMENT);
                    $('#dept_id').val(res.DEPARTMENT_ID);
                    $('#location').val(res.LOCATION);
                    $('#hod').val(res.HOD_NAME);
                    $('#email').val(res.EMPLOYEE_EMAIL);
                    $('#status').val(res.EMPLOYEE_STATUS);
                }
                else{
                    alert('Entered employee code does not exists!');
                }
            });
        }
    });


    var settings = {
            "url": "https://cloud.efulife.com:8080/devinv/branchdata.php?uid=1",
            "method": "GET",
            "timeout": 0,
            };
            $.ajax(settings).done(function (response) {
                if(response.Login != null){
                    var res = response.Login;
                    var branch = $('#branches');
                    $.each( res, function(index, value){
                        branch.append(
                            $('<option></option>').val(value.BRANCH_ID).html(value.BRANCH_NAME)
                        );
                    });
                }
            });

    $('#branches').change(function(){
        $('#branch').val($("#branches option:selected" ).text());   
    });        
});
</script> 
