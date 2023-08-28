@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        @if(auth()->user()->role === 'user')
            <h1>Dashboard</h1>
            <p class="lead">Only authenticated users with the "user" role can access this section.</p>
            
            <a class="btn btn-lg btn-primary" href="https://abishek-portfolio.vercel.app" role="button">View more tutorials here &raquo;</a>
        @endif
    @endauth    

        @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{$error}}</div>
                @endforeach
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif

            @if (session()->has('success'))
                <div class="alert alert-sucess">{{session('success')}}</div>
            @endif
        @endguest
    </div>
@endsection