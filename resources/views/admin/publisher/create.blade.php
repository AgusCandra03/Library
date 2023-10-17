@extends('layouts.admin')
@section('header', 'Create Publisher')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Create New Publisher</h3>
                </div>
                <form method="POST" action="{{ url('publishers') }}">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="name">Name Publisher</label>
                      <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" required>
                    </div>

                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" required>
                    </div>

                    <div class="form-group">
                      <label for="address">Phone Number</label>
                      <input type="number" name="phone_number" class="form-control" id="phone_number" placeholder="Enter Phone Number" required>
                    </div>

                    <div class="form-group">
                      <label for="address">Address</label>
                      <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address" required>
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
