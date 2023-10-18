@extends('layouts.admin')
@section('header', 'Book')
@section('css')
    
@endsection

@section('content')
<div id="controller">
    <div class="container">
        <div class="row">
            <div class="col-md-5 offset-md-3">
                <form action="simple-results.html">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control" autocomplete="off" placeholder="Search From Title" v-model="search">
                    </div>
                </form>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" @click="addData()">Create New Book</button>
            </div>
        </div>
    
        <hr>
        
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12" v-for="book in filteredList">
                <div class="info-box" v-on:click="editData(book)">
                  <div class="info-box-content">
                    <span class="info-box-text h5">@{{ book.title }} (@{{ book.qty }})</span>
                    <span class="info-box-number">Rp. @{{ numberWithSpaces(book.price) }} ,-</span>
                  </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
              <div class="modal-content">
                <form :action="actionUrl" method="POST" autocomplete="off">
                  <div class="modal-header">
                    <h4 class="modal-title">Book</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @csrf

                    <input type="hidden" name="_method" value="PUT" v-if="editStatus">

                    <div class="form-group">
                      <label for="isbn">ISBN</label>
                      <input type="number" name="isbn" class="form-control" id="isbn" placeholder="Nomor ISBN" :value="book.isbn" required>
                    </div>

                    <div class="form-group">
                      <label for="title">Title</label>
                      <input type="text" name="title" class="form-control" id="title" placeholder="Judul Buku" :value="book.title" required>
                    </div>

                    <div class="form-group">
                      <label for="year">Year</label>
                      <input type="number" name="year" class="form-control" id="year" placeholder="Tahun Terbit" :value="book.year" required>
                    </div>

                    <div class="form-group">
                        <label for="publisher">Publisher</label>
                        <select name="publisher_id" class="form-control">
                            @foreach ($publishers as $publisher)
                                <option value="{{ $publisher->id }}" :selected="book.publisher_id == {{ $publisher->id }}">{{ $publisher->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="author">Author</label>
                        <select name="author_id" class="form-control">
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}" :selected="book.author_id == {{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="catalog">Catalog</label>
                        <select name="catalog_id" class="form-control">
                            @foreach ($catalogs as $catalog)
                                <option value="{{ $catalog->id }}" :selected="book.catalog_id == {{ $catalog->id }}">{{ $catalog->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                      <label for="qty">Jumlah Buku</label>
                      <input type="number" name="qty" class="form-control" id="qty" placeholder="Jumlah Buku" :value="book.qty" required>
                    </div>

                    <div class="form-group">
                        <label for="price">Harga Pinjam</label>
                        <input type="number" name="price" class="form-control" id="price" placeholder="Harga Pinjam" :value="book.price" required>
                      </div>

                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-danger" v-if="editStatus" v-on:click="deleteData(book.id)">Delete</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

    </div>
</div>
@endsection

@section('js')
<script>
    var actionUrl = '{{ url('books') }}';
    var apiUrl = '{{ url('api/books') }}';

    var controller = new Vue({
        el: '#controller',
        data: {
            books: [],
            search: '',
            book: {}, 
            actionUrl,
            apiUrl,
            editStatus: false,
        },
        mounted: function(){
            this.get_books();
        },
        methods: {
            get_books() {
                const  _this = this;
                $.ajax({
                    url: apiUrl,
                    method: 'GET',
                    success: function (data) {
                        _this.books = JSON.parse(data);
                    },
                    error: function (error){
                        console.log(error);
                    }
                });
            },
            numberWithSpaces(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            },
            addData(){
                this.book = {};
                this.actionUrl = '{{ url('books') }}';
                this.editStatus = false;
                $('#modal-default').modal();
            },
            editData(book){
                this.book = book;
                this.actionUrl = '{{ url('books') }}'+'/'+book.id;
                this.editStatus = true;
                $('#modal-default').modal();
            },
            deleteData(id){
                this.actionUrl = '{{ url('books') }}'+'/'+id;
                if(confirm("Are you sure ?")){
                    axios.post(this.actionUrl, {_method: 'DELETE'}).then(response => {
                        location.reload();
                    });
                }
            },
        },
        computed: {
            filteredList() {
                return this.books.filter(book => {
                    return book.title.toLowerCase().includes(this.search.toLowerCase());
                });
            }
        }
    });
</script>
@endsection