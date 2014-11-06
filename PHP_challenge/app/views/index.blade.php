@extends('layouts.master')

@section('head')
    @parent
    <title>Home Page</title>
@stop

@section('content')
<section>
    <article class="home">
        @if(!Auth::check())
            <h2>Hello, what do you want to do? </h2>
            <br />
            {{ HTML::Link('/account/create', 'Sign Up') }} or {{ HTML::Link('/account/login', 'Sign In') }}                     
        @else            
            <h2>Hello, {{$auth->name}} {{$auth->family}}</h2>
            <br />
            {{ HTML::Link("/account/edit_password", 'Change Your Password') }}             
        @endif
    </article>
</section>

@stop