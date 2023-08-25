@extends('layouts.auth-master')

@section('content')
    <form method="post" action="#">
        
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <img class="mb-4" src="{!! url('https://media.licdn.com/dms/image/C560BAQGzp3m--4VBMA/company-logo_200_200/0/1669807661558?e=2147483647&v=beta&t=rypRQ1CpP1dvrbVr7e_4zLWFLFYqhuThlXTUrmA-Y1Q') !!}" alt="" width="72" height="57">
        
        <h1 class="h3 mb-3 fw-normal">Login</h1>

        @include('layouts.partials.messages')

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required="required" autofocus>
            <label for="floatingName">Email or Username</label>
            @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
            @endif
        </div>
        

        <button class="w-100 btn btn-lg btn-primary" type="submit">Send Forgot Password Link</button>
        
        @include('auth.partials.copy')
    </form>
@endsection