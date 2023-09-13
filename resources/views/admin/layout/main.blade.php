@include('admin.layout.header')
<div class="d-flex" id="wrapper">
    @include('admin.layout.sidebar')
    <!-- Page content wrapper-->
    <div id="page-content-wrapper">
       @include('admin.layout.navbar')
        <!-- Page content-->
        <div class="container-fluid p-2 p-md-5">
            @yield('contents')
        </div>
    </div>

</div>
@include('admin.layout.footer')
