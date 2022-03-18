@extends('layouts.app')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>CRUD BASE API</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create</a>
            </div>
        </div>
    </div>
    <br>
    <table class="table table-bordered">
        <thead style="text-align: center;">
            <tr>
                <th>No</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Action</th>
            </tr>
        </thead>    
        <tbody style="text-align: center;">
            @php
                $number = 1;
            @endphp
            @forelse($users['data'] as $user)
            <tr>
                <td>{{ $number++ }}</td>
                <td>{{ $user['firstName'] }}</td>
                <td>{{ $user['lastName'] }}</td>
                <td align="center">
                    <form method="POST" action="{{ 'users/'.$user['id'] }}">
                        @method('DELETE')
                        @csrf

                        <a href="{{ 'users/'.$user['id'] }}" class="text-primary"><i class="fa fa-fw fa-edit"></i> Edit</a>
                        <button type="submit" class="text-danger btn btn-link" onClick="return confirm('Are you sure to delete this user?');"><i class="fa fa-fw fa-trash"></i>Delete</button>
                    </form>
                </td>

            </tr>
            @empty
                <tr><td colspan="6" align="center">No Record(s) Found!</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
