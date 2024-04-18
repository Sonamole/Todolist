@extends('todo.layouts.app')
@section('page', 'inner-page')
@section('content')
<section class="gradient-custom login">
<main class="login-form ">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Login</h3>
                    <div class="card-body">
                        <form method="POST" action="{{ route('auth_login') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email" class="form-control" name="email" required autofocus>
                            </div>

                            <div class="form-group mb-3">
                                <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                                @if ($errors->has('emailPassword'))
                                <span class="text-danger">{{ $errors->first('emailPassword') }}</span>
                                @endif
                            </div>



                            <div class="d-grid mx-auto ">
                                <button type="submit" class="btn btn-dark btn-block">Signin</button>
                              <a href="{{route('auth_register')}}"> <p>Register</p> </a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</section>
@endsection