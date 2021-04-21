<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>IMS - EFU Life</title>
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        .text-align-right{
            text-align:right;
        }
    </style>
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
                            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
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
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#reports" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Reports
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="reports" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ url('get_grns') }}">GRN</a>
                                    <a class="nav-link" href="{{ url('get_gins') }}">GIN</a>
                                    <a class="nav-link" href="{{ url('show_inventory_list') }}">Inventory report</a>
                                    <a class="nav-link" href="{{ url('edit_logs') }}">Inventory Edit Logs</a>
                                    <a class="nav-link" href="{{ url('inventory_in') }}">Inventory In</a>
                                    <a class="nav-link" href="{{ url('inventory_out') }}">Inventory Out</a>
                                    <a class="nav-link" href="{{ url('balance_report') }}">Balance report</a>
                                    <a class="nav-link" href="{{ url('bin_card') }}">Bin Card report</a>
                                    <a class="nav-link" href="{{ url('asset_repairing') }}">Asset Repairing report</a>
                                    <a class="nav-link" href="{{ url('disposal') }}">Type/Disposal report</a>
                                    <a class="nav-link" href="{{ url('vendor_buying') }}">Average Vendor Buying</a>
                                </nav>
                            </div>
                            @endif
                            @if(Auth::user()->role_id == 1)
                            <!-- User Management -->
                            
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Setup
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
                                    <!-- Sub Category -->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#subcategories" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Sub Categories
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="subcategories" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{ url('add_subcategory') }}">Add Sub Category</a>
                                            <a class="nav-link" href="{{ url('sub_category') }}">List Sub Category</a>
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
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#location" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Location
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="location" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{ url('add_location') }}">Add Location</a>
                                            <a class="nav-link" href="{{ url('location') }}">List Location</a>
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
                                    <!-- Device Type -->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dtype" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Device Type
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="dtype" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{ url('add_devicetype') }}">Add Device Type</a>
                                            <a class="nav-link" href="{{ url('devicetype') }}">List Device Types</a>
                                        </nav>
                                    </div>
                                    <!-- Item Nature -->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#nature" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Item Nature
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="nature" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{ url('add_itemnature') }}">Add Item Nature</a>
                                            <a class="nav-link" href="{{ url('itemnature') }}">List Item Natures</a>
                                        </nav>
                                    </div>
                                    <!-- Inventory Type -->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#invtype" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Inventory Type
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="invtype" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{ url('add_inventorytype') }}">Add Inventory Type</a>
                                            <a class="nav-link" href="{{ url('inventorytype') }}">List Inventory Types</a>
                                        </nav>
                                    </div>
                                    <!-- Role -->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#role" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Role
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="role" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <!-- <a class="nav-link" href="{{ url('add_role') }}">Add Role</a> -->
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
                            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
                            <!-- Budget System -->
                            <!-- <div class="sb-sidenav-menu-heading">Interface</div> -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#budget" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Budget System
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="budget" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                
                                    <a class="nav-link" href="{{ url('add_budget') }}">Add Budget</a>
                                    <a class="nav-link" href="{{ url('show_budget') }}">Show Budget</a>
                                    <a class="nav-link" href="{{ url('summary') }}">Summary</a>
                                    <!-- Type -->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Type" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Type
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="Type" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{ url('add_type') }}">Add Type</a>
                                            <a class="nav-link" href="{{ url('types') }}">List types</a>
                                        </nav>
                                    </div>
                                    <!-- Year -->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Year" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Year
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="Year" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{ url('add_year') }}">Add Year</a>
                                            <a class="nav-link" href="{{ url('years') }}">List Years</a>
                                        </nav>
                                    </div>
                                    <!-- Dollar -->
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dollar" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Dollar Price
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="dollar" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{ url('add_dollar_price') }}">Add Price</a>
                                            <a class="nav-link" href="{{ url('dollars') }}">List Prices</a>
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

    let link = '<?php echo \DB::table('links')->get()[0]->url;?>';

    // "url": "https://devinv.efulife.com/branchdataall.php?uid=1",
    // "url": "https://cloud.efulife.com:8080/devinv/empdata.php?uid="+emp_code,
    // "url": "https://devinv.efulife.com/deptdataall.php?uid=1",

    
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
                
            "url": link + "empdata.php?uid="+emp_code,
            "method": "GET",
            "timeout": 0,
            };
            $.ajax(settings).done(function (response) {
                if(response.Login != null){
                    var res = response.Login[0];
                    $('#name').val(res.EMPLOYEE_NAME);
                    $('#designation').val(res.DESIGNATION);
                    $('#department').val(res.DEPARTMENT);
                    $('#dept_id').val(res.DEPARTMENT_ID);
                    $('.location').val(res.LOCATION);
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


    $('#emp_no').keydown(function(e) {
        var code = e.keyCode || e.which;
        if (code === 9 || code === 13) {  
            e.preventDefault();
            var emp_no = $('#emp_no').val();
            var settings = {
            "url": "{{ url('get_employee') }}/"+emp_no,
            "method": "GET",
            "timeout": 0,
            };
            $.ajax(settings).done(function (response) {
                if(response != 0){
                    var res = response;
                    $('#name').val(res.name);
                    $('#designation').val(res.designation);
                    $('#department').val(res.department);
                    $('#dept_id').val(res.dept_id);
                    $('.location').val(res.location);
                    $('#hod').val(res.hod);
                    $('#email').val(res.email);
                    $('#status').val(res.status);
                }
                else{
                    alert('Entered employee code does not exists!');
                }
            });
        }
    });    

    var settings = {
            "url": link + "branchdataall.php?uid=1",
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

    $(".make").on("change",function(){
        var id = $(this).val();
        $.get("{{ url('model_by_make') }}/"+id, function(data){
            
            var model = $('.model');
            model.empty();
            model.append('<option value=0 class="o1">Select Model here</option>');
                    $.each( data, function(index, value){
                        model.append(
                            $('<option></option>').val(value.id).html(value.model_name)
                        );
                    });
        });    
    }); 
    $(".category").on("change",function(){
        var id = $(this).val();
        $.get("{{ url('subcat_by_category') }}/"+id, function(data){
            
            var subcategory = $('.subcategory');
            subcategory.empty();
            subcategory.append('<option value=0 class="o1">Select Sub Category here</option>');
                    $.each( data, function(index, value){
                        subcategory.append(
                            $('<option></option>').val(value.id).html(value.sub_cat_name)
                        );
                    });
        });    
    });


    var settings = {
            "url": link + "deptdataall.php?uid=1",
            "method": "GET",
            "timeout": 0,
            };
            $.ajax(settings).done(function (response) {
                if(response.Login != null){
                    var res = response.Login;
                    var dept_id = $('#dept_id');
                    $.each( res, function(index, value){
                        dept_id.append(
                            $('<option></option>').val(value.DEPARTMENT_ID).html(value.DEPARTMENT)
                        );
                    });
                }
            });
    $('#dept_id').change(function(){
        $('#dept').val($("#dept_id option:selected" ).text());   
    });  


    $("#year").on("change",function(){
        var id = $(this).val();
        $.get("{{ url('pkr_by_year') }}/"+id, function(data){
            var value = data.pkr_val;
            $('#pkr').val(value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });    
    });

    $('#qty').keyup(function(){
          var qty = $(this).val();
          var d = $('#u_dollar').val();
          var p = $('#pkr').val();
          var dollar = d.replace(",", "");
          var pkr = p.replace(",", "");

          var total_dollar = dollar*qty;
          var total_pkr = total_dollar*pkr;
        //   console.log(qty);
        //   console.log(dollar);
        //   console.log(pkr);
        //   console.log(total_dollar);
        //   console.log(total_pkr);
          $('#t_dollar').val(total_dollar.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
          $('#t_pkr').val(total_pkr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    }); 

    $('.pro').keydown(function(e) {
        var code = e.keyCode || e.which;
        if (code === 9 || code === 13) {  
            e.preventDefault();

            var product = $(this).val();
            $.get("{{ url('check_product') }}/"+product, function(data){
                if(data == 1){
                    $(".pro_msg").text('Already exists!');
                }
                else{
                    $(".pro_msg").text('');
                }
                //console.log(data);
            });    
        }
    });  

    $(".repair_item").on("change",function(){
        var id = $(this).val();
        $.get("{{ url('get_price') }}/"+id, function(data){
            $('.a_price').val(data);
        });    
    });

    $(".subcategory").on("change",function(){
        var id = $(this).val();
        var repair_item = $('.repair_item');
        repair_item.empty();
        repair_item.append('<option value=0 class="o1">Select Item here</option>');
        $.get("{{ url('get_inv_items') }}/"+id, function(data){
            console.log(data);
            $.each( data, function(index, value){
                repair_item.append(
                    $('<option></option>').val(value.id).html(value.product_sn)
                );
            });    
        });    
    });  

    $(".t_seperator").focusout(function(){
        var value = $(this).val();

        var num_parts = value.toString().split(".");
        num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $(this).val(num_parts.join("."));
        //alert(num_parts.join("."));
    });
    
$(".budget_items").hide();    
    $(".issue_year").on("change",function(){
        var year_id = $(this).val();
        var inv_id = $('.invid').val();
        var dept_id = $('#dept_id').val();
        $.get("{{ url('get_budget_items') }}/"+year_id+"/"+inv_id+"/"+dept_id, function(data){
            $(".items_list").empty();
            if(data == "0"){
                $(".items_list").append(`
                <tr>
                <td style='text-align: center;' colspan='13'>
                Budget not available for selected inventory!
                </td>
                </tr>
                `);
            }
            else{
            var i = 1;
            $.each( data, function( key, value ) {
                $(".items_list").append(`
                <tr>
                <td class='text-align-right'>
                <input type="radio" class="form-check-input" id="budget_id" name='budget_id[]' value="`+value.id+`">
                <label class="form-check-label" for="budget_id">`+i+`</label></td>
                <td>`+value.type.type+`</td>
                <td>`+value.subcategory.sub_cat_name+`</td>
                <td>`+value.department+`</td>
                <td>`+value.description+`</td>
                <td class='text-align-right'>`+value.qty+`</td>
                <td>`+value.unit_price_dollar+`</td>
                <td>`+value.unit_price_pkr+`</td>
                <td>`+(value.unit_price_dollar*value.qty)+`</td>
                <td>`+(value.unit_price_pkr*value.qty)+`</td>
                <td class='text-align-right'>`+value.consumed+`</td>
                <td class='text-align-right'>`+value.remaining+`</td>
                <td>`+value.remarks+`</td>
                </tr>
                `); 
                i++;
            });  
            }
            $(".budget_items").show();
        });    
    });      

});
</script> 
