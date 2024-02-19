<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<body>
    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        @include('partials.top_bar')
        <!-- Top Bar End -->

        <!-- ========== Left Sidebar Start ========== -->
        @include('partials.left_sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            @yield('content')
            <!-- content -->

            @include('partials.footer')

        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- jQuery  -->
   @include('partials.javascript')
</body>

</html>