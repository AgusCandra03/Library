@extends('layouts.admin')
@section('header', 'Catalog')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Bordered Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">No.</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Total Book</th>
                        <th class="text-center">Created at</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($catalogs as $key => $catalog)
                        <tr>
                            <td class="text-center">{{ $key+1 }}.</td>
                            <td class="text-center">{{ $catalog->name }}</td>
                            <td class="text-center">{{ count($catalog->books) }} Book</td>
                            <td class="text-center">{{ date('d M Y - H:i:s', strtotime($catalog->created_at)) }}</td>
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
