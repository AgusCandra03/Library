<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
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
        $members = Member::all();
        return view('admin.member', compact('members'));
    }

    public function api(Request $request)
    {
        if($request->gender){
            $members = Member::where('gender', $request->gender)->get();
        }else {
            $members = Member::all();
        }

        $datatables = datatables()->of($members)
        ->addColumn('jk', function ($member) {
            if($member->gender == 'P'){
                return 'Perempuan';
            } else if($member->gender == 'L'){
                return 'Laki - laki';
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
        $this->validate($request,[
            'name' => ['required'],
            'gender' => ['required'],
            'phone_number' => ['required'],
            'address' => ['required'],
            'email' => ['required'],
        ]);

        Member::create($request->all());

        return redirect('members');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $this->validate($request,[
            'name' => ['required'],
            'gender' => ['required'],
            'phone_number' => ['required'],
            'address' => ['required'],
            'email' => ['required'],
        ]);

        $member->update($request->all());

        return redirect('members');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();
    }
}
