@extends('layouts.admin')
@section('header', 'Edit Publisher')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Publisher</h3>
                </div>
                <form method="POST" action="{{ url('publishers/'.$publisher->id) }}">
                    @csrf
                    {{ method_field('PUT') }}

                  <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name Publisher</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $publisher->name }}" required>
                      </div>
  
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ $publisher->email }}" required>
                      </div>
  
                      <div class="form-group">
                        <label for="address">Phone Number</label>
                        <input type="number" name="phone_number" class="form-control" id="phone_number" value="{{ $publisher->phone_number }}" required>
                      </div>
  
                      <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" id="address" value="{{ $publisher->address }}" required>
                      </div>
                    </div>
                  </div>
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
