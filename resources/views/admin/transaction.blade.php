@extends('layouts.admin')
@section('header', 'Transaction')

@section('css')
 <!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">   
@endsection

@section('content')
{{-- @can('index peminjaman') --}}
{{-- @role('petugas') --}}
<div id="controller">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                      <div class="row">
                        <div class="col-md-7">
                            <a href="#" class="btn btn-primary" @click="addData()">Create New Member</a>
                        </div>
                        <div class="col-md-2">
                          <select class="form-control" name="status">
                              <option value="3">Filter Status</option>
                              <option value="1">Belum Dikembalikan</option>
                              <option value="2">Sudah Dikembalikan</option>
                          </select>
                        </div>
                        <div class="input-group date col-md-3" id="reservationdate" data-target-input="nearest">
                          <input type="text" name="date_start" id="date_start" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="Filter Tanggal Pinjam"/>
                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <table id="datatable" class="table table-bordered">
                        <thead>
                          <tr>
                            <th class="text-center">Tanggal Pinjam</th>
                            <th class="text-center">Tanggal kembali</th>
                            <th class="text-center">Nama Peminjam</th>
                            <th class="text-center">Lama Pinjam (hari)</th>
                            <th class="text-center">Status</th>
                            <th style="width: 200px" class="text-center">Action</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @endrole --}}
{{-- @endcan --}}
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
var actionUrl = '{{ url('transactions') }}';
var apiUrl = '{{ url('api/transactions') }}';

var columns = [
  {data: 'date_start', class: 'text-center', orderable: true},
  {data: 'date_end', class: 'text-center', orderable: true},
  {data: 'name', class: 'text-center', orderable: true},
  {data: 'lama_pinjam', class: 'text-center', orderable: true},
  {data: 'status_name', class: 'text-center', orderable: true},
  {render: function (index, row, data, meta){
    return `
      <a href="#" class="btn btn-warning" onclick="controller.editData(event, ${meta.row})">Edit</a>
      <a href="#" class="btn btn-danger" onclick="controller.deleteData(event, ${data.id})">Delete</a>
      `;
  }, orderable: false, width: '200px', class: 'text-center' },
];

var controller = new Vue({
    el: '#controller',
    data: {
      data: {},
      editStatus: false,
    },
    mounted: function(){
      this.datatable();
    },
    methods: {
      datatable(){
          const _this = this;
          _this.table = $('#datatable').DataTable({
              ajax:{
                  url: apiUrl,
                  type: 'GET',
              },
              columns
          }).on('xhr', function(){
              _this.datas = _this.table.ajax.json().data;
          });
      },
    }
});
</script>
<script>
  $('select[name=status]').on('change', function(){
      status = $('select[name=status]').val();
      if(status == '3'){
        controller.table.ajax.url(apiUrl).load();
      } else {
        controller.table.ajax.url(apiUrl+'?status='+status).load();
      }
  })

  //Date picker
  $('#reservationdate').datetimepicker({
      format: 'YYYY-MM-DD',
      onSelect: function(dateText) {
          console.log("Selected date: " + dateText + "; input's current value: " + this.value);
      }
  });

  $('input[name=date_start]').on('change', function(){
      date_start = $('input[name=date_start]').val();
      controller.table.ajax.url(apiUrl+'?date_start='+date_start).load();
  })
</script>
@endsection