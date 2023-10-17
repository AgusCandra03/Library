@extends('layouts.admin')
@section('header', 'Edit Catalog')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Catalog</h3>
                </div>
                <form method="POST" action="{{ url('catalogs/'.$catalog->id) }}">
                    @csrf
                    {{ method_field('PUT') }}

                  <div class="card-body">
                    <div class="form-group">
                      <label for="name">Name Catalog</label>
                      <input type="text" name="name" class="form-control" id="name" value="{{ $catalog->name }}" placeholder="Enter email" required>
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
