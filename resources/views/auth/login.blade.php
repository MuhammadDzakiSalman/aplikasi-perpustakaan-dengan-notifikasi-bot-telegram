<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

@include('partials.head')

<body
    style="
            background: url('assets/img/5924.jpg') no-repeat;
            background-size: cover;
        ">
    <section class="d-flex position-relative py-4 py-xl-5 vh-100 justify-content-center align-items-center">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col col-12 col-md-8 col-lg-6">
                    <div class="card bg-light bg-opacity-75 px-4">
                        <div class="card-body d-flex flex-column align-items-center">
                            <div class="bs-icon-xl bs-icon-circle bs-icon-primary-light bs-icon my-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-person">
                                    <path
                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z">
                                    </path>
                                </svg>
                            </div>
                            @if (session('error'))
                                <div class="alert alert-danger" id="errorAlert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form class="text-center w-100" method="post" action="{{ url('/login') }}">
                                @csrf
                                <div class="mb-3 d-flex align-items-center">
                                    <i class="far fa-user fs-6 me-2"></i><input
                                        class="bg-light bg-opacity-10 form-control" type="text" name="username"
                                        placeholder="Username" />
                                </div>
                                <div class="mb-3 d-flex align-items-center">
                                    <i class="fas fa-lock fs-6 me-2"></i><input
                                        class="bg-light bg-opacity-10 form-control" type="password" name="password"
                                        placeholder="Password" />
                                </div>
                                <div class="form-check d-flex">
                                    <input type="checkbox" id="flexCheckDefault" class="form-check-input me-2" name="remember" value="1" />
<label class="form-label form-check-label" for="flexCheckDefault">
    Ingat saya
</label>
                                </div>
                                <div class="my-3">
                                    <button class="btn btn-primary d-block w-100" type="submit">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
