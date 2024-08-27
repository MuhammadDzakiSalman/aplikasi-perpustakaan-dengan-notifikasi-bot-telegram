<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

@include('partials.head')

<body>
    <div class="d-flex" id="wrapper">
        @include('partials.sidebar')
        <div id="page-content-wrapper" class="px-1 px-md-3">
            @include('partials.navbar')
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
