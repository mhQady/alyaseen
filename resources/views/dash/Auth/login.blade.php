@extends('dash.layout.app-headless')
@section('title', __('main.login'))
@section('content')
<main class="main-content  mt-0">
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">

                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <span>{{ $errors->first() }}</span>
                        </div>
                        @endif
                        <div class="card">
                            <div class="card-header pb-0 text-center">
                                <h4 class="font-weight-bolder">@lang('main.login')</h4>
                            </div>
                            <div class="card-body">
                                <form role="form" method="post" action="{{ route('dash.login') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <input value="{{ old('email','admin@alyaseen.com') }}" name="email" type="email"
                                            class="form-control form-control-lg" placeholder="@lang('main.email')"
                                            aria-label="Email">
                                    </div>
                                    <div class="mb-3">
                                        <input value="{{ old('password','password') }}" name="password" type="password"
                                            class="form-control form-control-lg" placeholder="@lang('main.password')"
                                            aria-label="Password">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit"
                                            class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">@lang('main.login')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div
                        class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                        <div
                            class="position-relative btn-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center">
                            <img src="{{ asset('dashboard/img/shapes/pattern-lines.svg') }}" alt="pattern-lines"
                                class="position-absolute start-0">
                            <div class="position-relative">
                                <img src="https://cdn.prod.website-files.com/660d9b419dece1094885598b/660d9b419dece10948855b89_download%20(2).svg"
                                    class="navbar-brand-img" alt="main_logo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection