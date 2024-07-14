@extends('layouts.main')

@section('main')
    <section class="vh-80">
        <div class="container-fluid h-custom">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="{{ asset('sign.png') }}" class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
              <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                  <p class="lead fw-normal mb-10 me-3 fs-1">Sign in</p>
                </div>

                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control form-control-lg" id="email" name="email" value="{{ old('email') }}" placeholder="Enter a valid email address">
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter password">
                </div>

                <div class="d-flex justify-content-between align-items-center">
                  <!-- Checkbox -->
                  <div class="form-check mb-0">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                    <label class="form-check-label" for="form2Example3">
                      Remember me
                    </label>
                  </div>
                  <a href="{{ route('password.request') }}" class="link-primary">Forget Password?</a>
                </div>

                <div class="text-center text-lg-start mt-4 pt-2">
                  <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem; background-color: #FFD966;">Login</button>
                  <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{ route('register') }}" class="link-primary">Register</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
@endsection
