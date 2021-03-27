@include('homeblog.header')
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div id="hot-post" class="row hot-post">
            @yield('isiblog')
            @include('homeblog.widget')
                        @include('homeblog.gmaps')
        </div>
    </div>
</div>
@include('homeblog.footer')