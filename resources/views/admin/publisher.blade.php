@extends('layouts.admin')
@section('header', 'Publisher')
@section('css')
    
@endsection

@section('content')
<div id="controller">
  <div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                  <a href="#" class="btn btn-primary" @click="addData()">Create New Publisher</a>
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
                              <a href="#" @click="editData( {{ $publisher }} )" class="btn btn-warning">Edit</a>
                              <a href="#" @click="deleteData( {{ $publisher->id }} )" class="btn btn-danger">Delete</a>
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
                      <h4 class="modal-title">Publisher</h4>
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
<script>
  var controller = new Vue({
    el: '#controller',
    data: {
      data: {},
      actionUrl: '{{ url('publishers') }}',
      editStatus: false,
    },
    mounted: function(){

    },
    methods: {
      addData(){
        this.data = {};
        this.editStatus = false;
        this.actionUrl = '{{ url('publishers') }}';
        $('#modal-default').modal();
      },
      editData(data){
        this.data = data;
        this.editStatus = true;
        this.actionUrl = '{{ url('publishers') }}'+'/'+data.id;
        $('#modal-default').modal();
      },
      deleteData(id){
        this.actionUrl = '{{ url('publishers') }}'+'/'+id;
        if(confirm("Are you sure ?")){
          axios.post(this.actionUrl, {_method: 'DELETE'}).then(response => {
            location.reload();
          });
        }
      }
    }
  });
</script>
@endsection