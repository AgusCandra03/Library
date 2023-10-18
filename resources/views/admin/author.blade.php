@extends('layouts.admin')
@section('header', 'Author')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
<div id="controller">
  <div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                  <a href="#" class="btn btn-primary" @click="addData()">Create New Author</a>
                </div>
                <div class="card-body">
                  <table id="datatable" class="table table-bordered">
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
                              <a href="#" @click="editData( {{ $author }} )" class="btn btn-warning">Edit</a>
                              <a href="#" @click="deleteData( {{ $author->id }} )" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
            </div>

            <div class="modal fade" id="modal-default">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form :action="actionUrl" method="POST" autocomplete="off">
                    <div class="modal-header">
                      <h4 class="modal-title">Author</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      @csrf

                      <input type="hidden" name="_method" value="PUT" v-if="editStatus">

                      <div class="form-group">
                        <label for="name">Name Publisher</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" :value="data.name" required>
                      </div>
  
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" :value="data.email" required>
                      </div>
  
                      <div class="form-group">
                        <label for="address">Phone Number</label>
                        <input type="number" name="phone_number" class="form-control" id="phone_number" placeholder="Enter Phone Number" :value="data.phone_number" required>
                      </div>
  
                      <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address" :value="data.address" required>
                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

        </div>
    </div>
</div>
</div>
@endsection

@section('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
$(function () {
    $("#datatable").DataTable()
  });

  // var controller = new Vue({
  //   el: '#controller',
  //   data: {
  //     data: {},
  //     actionUrl: '{{ url('authors') }}',
  //     editStatus: false,
  //   },
  //   mounted: function(){

  //   },
  //   methods: {
  //     addData(){
  //       this.data = {};
  //       this.editStatus = false;
  //       this.actionUrl = '{{ url('authors') }}';
  //       $('#modal-default').modal();
  //     },
  //     editData(data){
  //       this.data = data;
  //       this.editStatus = true;
  //       this.actionUrl = '{{ url('authors') }}'+'/'+data.id;
  //       $('#modal-default').modal();
  //     },
  //     deleteData(id){
  //       this.actionUrl = '{{ url('authors') }}'+'/'+id;
  //       if(confirm("Are you sure ?")){
  //         axios.post(this.actionUrl, {_method: 'DELETE'}).then(response => {
  //           location.reload();
  //         });
  //       }
  //     }
  //   }
  // });
</script>
@endsection