<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if(auth()->user()->can('index peminjaman')){
        //     return view('admin.transaction');
        // } else {
        //     return abort('403');
        // }
        return view('admin.transaction');
    }

    public function api(Request $request)
    {
        if($request->status){
            $transactions = Transaction::where('status',$request->status);
        }else {
            $transactions = Transaction::query();
        }

        if($request->date_start){
            $transactions = Transaction::whereDate('date_start', $request->date_start);
        }

        $transactions
            // ->with(['transactionDetail.book'])
            ->join('members', 'members.id', 'transactions.member_id')
            ->selectRaw('datediff(date_end, date_start) as lama_pinjam, transactions.*, members.name')
            ->get();
        
        $datatables = datatables()->of($transactions)
        ->addColumn('status_name', function ($transaction) {
            if($transaction->status == 1){
                return 'Belum Dikembalikan';
            } elseif($transaction->status == 2) {
                return 'Sudah Dikembalikan';
            }
        })
        ->addIndexColumn();

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
