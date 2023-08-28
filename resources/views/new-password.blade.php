@extends('layouts.auth-master')

@section('content')

{{-- @if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{$error}}</div>
    @endforeach
@endif

@if (session()->has('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
@endif

@if (session()->has('success'))
    <div class="alert alert-sucess">{{session('success')}}</div>
@endif --}}
    <form method="post" action="{{route('resetPassword.post')}}">
        @csrf
        {{-- <input type="hidden" name="_token" value="{{$token}}" /> --}}
        <img class="mb-4" src="{!! url('https://media.licdn.com/dms/image/C560BAQGzp3m--4VBMA/company-logo_200_200/0/1669807661558?e=2147483647&v=beta&t=rypRQ1CpP1dvrbVr7e_4zLWFLFYqhuThlXTUrmA-Y1Q') !!}" alt="" width="72" height="57">
        
        <h1 class="h3 mb-3 fw-normal">Reset Password</h1>

        @include('layouts.partials.messages')

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="email" placeholder="email" required="required" autofocus>
            <label for="floatingName">Email</label>
            @if ($errors->has('email'))
                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password"  placeholder="Password" required="required" autofocus>
            <label for="floatingName">Enter New Password</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required="required" autofocus>
            <label for="floatingName">Confirm Password</label>
            @if ($errors->has('confirm_password'))
                <span class="text-danger text-left">{{ $errors->first('confirm_password') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="otp" class="form-control" name="otp" placeholder="OTP" required="required" autofocus>
            <label for="floatingName">OTP</label>
            @if ($errors->has('otp'))
                <span class="text-danger text-left">{{ $errors->first('otp') }}</span>
            @endif
        </div>
        

        <button class="w-100 btn btn-lg btn-primary" type="submit">Reset Password</button>
        
        @include('auth.partials.copy')
    </form>
@endsection