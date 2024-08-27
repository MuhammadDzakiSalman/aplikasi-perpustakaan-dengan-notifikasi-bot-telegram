<nav class="navbar navbar-expand-lg navbar-light border-bottom">
    <div class="container-fluid">
        <button class="btn btn-primary" id="sidebarToggle"><i class="fas fa-bars"></i></button>
        <div class="d-flex justify-content-end">
            <p class="m-0 me-3 py-2">Hai, <span id="username">{{ Auth::user()->username }}</span></p>
            <!-- Logout Form -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-primary py-2" type="submit">Logout</button>
            </form>
        </div>
    </div>
</nav>
