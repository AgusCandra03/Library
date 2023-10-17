@extends('layouts.admin')
@section('header', 'Author')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                  <a href="{{ url('authors/create') }}" class="btn btn-primary">Create New Author</a>
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
                        @foreach ($authors as $key => $author)
                        <tr>
                            <td class="text-center">{{ $key+1 }}.</td>
                            <td class="text-center">{{ $author->name }}</td>
                            <td class="text-center">{{ $author->email }}</td>
                            <td class="text-center">{{ $author->phone_number }}</td>
                            <td class="text-center">{{ $author->address }}</td>
                            <td class="text-center">
                                <form action=" {{ url('authors', ['id' => $author->id]) }} " method="post">
                                    <a href="{{ url('authors/'.$author->id.'/edit') }}" class="btn btn-warning">Edit</a>
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
