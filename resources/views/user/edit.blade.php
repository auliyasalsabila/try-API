@extends('layouts.app')

@section('content')
<h4>Edit User</h4>
<form method="POST" action="{{ url()->current() }}">
  {{-- {{ route('users.update', $user['id']) }} --}}
    @method('PUT')
    @csrf
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">First Name</label>
        <input type="text" name="firstName" class="form-control" id="exampleInputPassword1" value="{{ $user['firstName'] }}">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Last Name</label>
        <input type="text" name="lastName" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $user['lastName'] }}">
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email</label>
      <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $user['email'] }}">
    </div>
    <div class="form-group">
      <div class="text-center">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
</form>
@endsection