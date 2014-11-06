@extends('layouts.master')

@section('head')
    @parent
    <title>Change Password Page</title>
@stop

@section('content')
<section class="form">
    <header>
        <h1>
            Change Password Form
        </h1>
    </header>
    <article>   
        <div>
            @if($errors->has())    
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
        </div>
        <div>
            {{ Form::open(['url' => '/account/edit_password']) }} 
                <div>
                    {{ Form::label('old_password', 'Old Password: ') }}
                    {{ Form::password('old_password') }} *
                </div>
                <div>
                    {{ Form::label('new_password', 'New Password: ') }}
                    {{ Form::password('new_password') }} *
                </div>
                <div>
                    {{ Form::label('confirm_password', 'Confirm Password: ') }}
                    {{ Form::password('confirm_password') }} *
                </div>
                <div>
                    {{ Form::submit('Change')}}
                </div>
            {{ Form::close()}} 
        </div>
    </article>
</section>
@stop