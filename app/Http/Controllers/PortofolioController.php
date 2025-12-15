<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Portofolio::query();

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $portofolio = $query->latest()->paginate(10);
        return view("portofolio.index",["portofolio" => $portofolio]);
    }

     public function showById(Portofolio $portofolio)
    {
     
        return view('portofolio.detail',["data" => $portofolio]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('portofolio.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "title" => ["required","max:255","unique:portofolio,title"],
            "deskripsi" => ["required","max:255"],
            "isi" => ["required","max:1000"],
            "gambar" => ["required","image","mimes:jpeg,png,jpg,gif,svg","max:512000"],
            "pdf" => ["required","mimes:pdf","max:204800"]
        ]);
        if ($request->hasFile('gambar')) {
            $filename = uniqid() . '.' . $request->file('gambar')->getClientOriginalExtension();
            $path = $request->file('gambar')->storeAs('portofolio', $filename, 'public');
            $validate["gambar"] = $path;
        }
        if ($request->hasFile('pdf')) {
            $filename = uniqid() . '.' . $request->file('pdf')->getClientOriginalExtension();
            $path = $request->file('pdf')->storeAs('portofolio-files', $filename, 'public');
            $validate["pdf"] = $path;
        }
        Portofolio::create($validate);
        return Redirect::route('portofolio.index')->with('success', 'Data berhasil di tambahkan');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portofolio $portofolio)
    {
        return view('portofolio.form', ["portofolio" => $portofolio]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Portofolio $portofolio)
    {
        $validate = $request->validate([
            "title" => ["required","max:255",Rule::unique('portofolio', 'title')->ignore($portofolio->uuid,"uuid")],
            "deskripsi" => ["required","max:255"],
            "isi" => ["required","max:1000"],
            "gambar" => ["nullable","image","mimes:jpeg,png,jpg,gif,svg","max:512000"],
            "pdf" => ["nullable","mimes:pdf","max:204800"]
        ]);
        if ($request->hasFile('gambar')) {
            $filename = uniqid() . '.' . $request->file('gambar')->getClientOriginalExtension();
            $path = $request->file('gambar')->storeAs('portofolio', $filename, 'public');
            Storage::disk('public')->delete($portofolio->gambar);
            $validate["gambar"] = $path;
        }
        if ($request->hasFile('pdf')) {
            $filename = uniqid() . '.' . $request->file('pdf')->getClientOriginalExtension();
            $path = $request->file('pdf')->storeAs('portofolio-files', $filename, 'public');
            if (!empty($portofolio->pdf) && Storage::disk('public')->exists($portofolio->pdf)) {
                Storage::disk('public')->delete($portofolio->pdf);
            }
            $validate["pdf"] = $path;
        }
        $portofolio->update($validate);
        return Redirect::route('portofolio.index')->with('success', 'Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portofolio $portofolio)
    {
        $gambar = $portofolio->gambar;
        $pdf = $portofolio->pdf;
        $portofolio->delete();
        if ($gambar) Storage::disk('public')->delete($gambar);
        if($pdf) Storage::disk('public')->delete($pdf);
        return Redirect::route('portofolio.index')->with('success', 'Data berhasil di hapus');
    }
}
