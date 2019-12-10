@include('layouts.header')
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">@yield('title')</h4> </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                <h3 class="box-title">@yield('sub-title')</h3> 
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
<footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by themedesigner.in </footer>
</div>
<!-- ============================================================== -->
<!-- End Page Content -->
<!-- ============================================================== -->
</div>
<!-- /#wrapper -->
@include('layouts.footer')