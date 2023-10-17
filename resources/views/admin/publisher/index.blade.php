@extends('layouts.admin')
@section('header', 'Publisher')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                  <a href="{{ url('publishers/create') }}" class="btn btn-primary">Create New Publisher</a>
                </div>
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">No.</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Phone Number</th>
                        <th class="text-center">Address</th>
                        <th style="width: 200px" class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($publishers as $key => $publisher)
                        <tr>
                            <td class="text-center">{{ $key+1 }}.</td>
                            <td class="text-center">{{ $publisher->name }}</td>
                            <td class="text-center">{{ $publisher->email }}</td>
                            <td class="text-center">{{ $publisher->phone_number }}</td>
                            <td class="text-center">{{ $publisher->address }}</td>
                            <td class="text-center">
                                <form action=" {{ url('publishers', ['id' => $publisher->id]) }} " method="post">
                                    <a href="{{ url('publishers/'.$publisher->id.'/edit') }}" class="btn btn-warning">Edit</a>
                                    <input class="btn btn-danger" type="submit" value="Delete" onclick="return confirm('Are you sure ?')">
                                @method('delete')
                                @csrf
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection
