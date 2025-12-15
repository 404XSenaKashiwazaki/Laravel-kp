<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;


class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Gallery::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $gallerys = $query->latest()->paginate(10);

        return view('gallery.index', [
            'gallerys' => $gallerys,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gallery.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "name" => ["required","max:255","unique:gallery,name"],
            "deskripsi" => ["required","max:255"],
            "gambar" => ["required","image","mimes:jpeg,png,jpg,gif,svg","max:512000"]
        ]);
        if ($request->hasFile('gambar')) {
            $filename = uniqid() . '.' . $request->file('gambar')->getClientOriginalExtension();
            $path = $request->file('gambar')->storeAs('gallery', $filename, 'public');
            $validate["gambar"] = $path;
        }
        Gallery::create($validate);
        return Redirect::route('gallery.index')->with('success', 'Data berhasil di tambahkan');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('gallery.form', ["gallery" => $gallery]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validate = $request->validate([
            "name" => ["required","max:255",Rule::unique('gallery', 'name')->ignore($gallery->uuid,"uuid")],
            "deskripsi" => ["required","max:255"],
            "gambar" => ["nullable","image","mimes:jpeg,png,jpg,gif,svg","max:512000"]
        ]);
        if ($request->hasFile('gambar')) {
            $filename = uniqid() . '.' . $request->file('gambar')->getClientOriginalExtension();
            $path = $request->file('gambar')->storeAs('gallery', $filename, 'public');
            Storage::disk('public')->delete($gallery->gambar);
            $validate["gambar"] = $path;
        }

        $gallery->update($validate);
        return Redirect::route('gallery.index')->with('success', 'Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {   $gambar = $gallery->gambar;
        $gallery->delete();
        if ($gambar) {
            Storage::disk('public')->delete($gambar);
        }
        return Redirect::route('gallery.index')->with('success', 'Data berhasil di hapus');
    }
}
