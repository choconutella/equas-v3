@extends('layouts.app')

@section('content')

<form method="POST" action="{{route('admin.login')}}">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="user_id">User ID</label>
        <input type="text" class="form-control" name="user_id" id="user_id">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection