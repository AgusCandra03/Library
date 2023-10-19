<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Publisher;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_book = count(Book::all());
        $total_member = Member::count();
        $total_publisher = count(Publisher::all());
        $total_transaction = Transaction::whereMonth('date_start', date('m'))->count();

        $data_donut = Book::select(DB::raw("COUNT(publisher_id) as total"))->groupBy('publisher_id')->orderBy('publisher_id', 'asc')->pluck('total');
        $label_donut = Publisher::orderBy('publisher_id', 'asc')->join('books', 'books.publisher_id', '=', 'publishers.id')->groupBy('name')->pluck('name');

        $label_bar = ['Peminjaman', 'Pengembalian'];
        $data_bar = [];

        foreach ($label_bar as $key => $value){
                $data_bar[$key]['label'] = $label_bar[$key];
                $data_bar[$key]['backgroundColor'] = $key == 0 ? 'rgba(60,141,188,0,9)' : 'rgba(210, 214, 222,1)';
                $data_month = [];

                foreach(range(1,12) as $month){
                        if($key == 0){
                                $data_month[] = Transaction::select(DB::raw("COUNT(*) as total"))->whereMonth('date_start', $month)->first()->total;
                        } else {
                                $data_month[] = Transaction::select(DB::raw("COUNT(*) as total"))->whereMonth('date_end', $month)->first()->total;
                        }

                }
                $data_bar[$key]['data'] = $data_month;
        }

        return view('home', compact('total_book', 'total_member', 'total_publisher', 'total_transaction', 'data_donut', 'label_donut', 'data_bar'));
    }

    public function test_spatie()
    {
        // membuat role dan permision

        // $role = Role::create(['name' => 'petugas']);
        // $permission = Permission::create(['name' => 'index peminjaman']);

        // $role->givePermissionTo($permission);
        // $permission->assignRole($role);


        // menampilkan informasi user yang login saat ini

        // $user = auth()->user();
        // return $user;


        // menampilkan informasi user dengan roles

        $user = User::with('roles')->get();
        return $user;


        // membuat roles pada user yang sedang login

        // $user = auth()->user();
        // $user->assignRole('petugas');
        // return $user;


        // membuat roles pada user dengan id
        
        // $user = User::where('id', 2)->first();
        // $user->assignRole('petugas');
        // return $user;


        // menghapus roles pada user yang login

        // $user = auth()->user();
        // $user->removeRole('petugas');


        // menghapus roles pada user yang login

        // $user = User::where('id', 2)->first();
        // $user->removeRole('petugas');

    }
}
