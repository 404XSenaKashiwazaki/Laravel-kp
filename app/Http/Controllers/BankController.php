<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Bank::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $banks = $query->latest()->paginate(10);

        return view('bank.index', [
            'banks' => $banks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bank.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "name" => ["required","max:255","unique:bank,name"],
            "nomor" => ["required","max:255"],
            "note" => ["required","max:255"],
        ]);
        Bank::create($validate);
        return Redirect::route('bank.index')->with('success', 'Data berhasil di tambahkan');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bank $bank)
    {
        return view('bank.form',["bank" => $bank]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bank $bank)
    {
        $validate = $request->validate([
            "name" => ["required","max:255",Rule::unique('bank', 'name')->ignore($bank->uuid,"uuid")],
            "nomor" => ["required","max:255"],
            "note" => ["required","max:255"],
        ]);
        $bank->update($validate);
        return Redirect::route('bank.index')->with('success', 'Data berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bank $bank)
    {
        $bank->delete();
        return Redirect::route('bank.index')->with('success', 'Data berhasil di hapus');
    }
}
