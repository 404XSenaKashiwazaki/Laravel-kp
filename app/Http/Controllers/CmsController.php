<?php

namespace App\Http\Controllers;

use App\Models\Cms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Cms::query();

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $cms = $query->paginate(10);

        return view('cms.index', [
            'cms' => $cms,
        ]);
    }

     public function showAll(Request $request)
    {
        $query = Cms::query();

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $cms = $query->paginate(10);

        return view('cms.show', [
           "artikels" => $cms
        ]);
    }

    public function showById(Cms $cms)
    {
        return view('cms.detail',["data" => $cms]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            "title" => ["required","max:255","unique:cms,title"],
            "deskripsi" => ["required","max:255"],
            "isi" => ["required","max:1000"],
            "gambar" => ["required","image","mimes:jpeg,png,jpg,gif,svg","max:512000"],
            "pdf" => ["required","mimes:pdf","max:204800"]
        ]);
        if ($request->hasFile('gambar')) {
            $filename = uniqid() . '.' . $request->file('gambar')->getClientOriginalExtension();
            $path = $request->file('gambar')->storeAs('cms', $filename, 'public');
            $validate["gambar"] = $path;
        }
        if ($request->hasFile('pdf')) {
            $filename = uniqid() . '.' . $request->file('pdf')->getClientOriginalExtension();
            $path = $request->file('pdf')->storeAs('cms-files', $filename, 'public');
            $validate["pdf"] = $path;
        }
        Cms::create($validate);
        return Redirect::route('cms.index')->with('success', 'Data berhasil di tambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cms $cms)
    {
        return view('cms.form', ["cms" => $cms]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cms $cms)
    {
        $validate = $request->validate([
            "title" => ["required","max:255",Rule::unique('cms', 'title')->ignore($cms->uuid,"uuid")],
            "deskripsi" => ["required","max:255"],
            "isi" => ["required","max:1000"],
            "gambar" => ["nullable","image","mimes:jpeg,png,jpg,gif,svg","max:512000"],
            "pdf" => ["nullable","mimes:pdf","max:204800"]
        ]);
        if ($request->hasFile('gambar')) {
            $filename = uniqid() . '.' . $request->file('gambar')->getClientOriginalExtension();
            $path = $request->file('gambar')->storeAs('cms', $filename, 'public');
            Storage::disk('public')->delete($cms->gambar);
            $validate["gambar"] = $path;
        }
        if ($request->hasFile('pdf')) {
            $filename = uniqid() . '.' . $request->file('pdf')->getClientOriginalExtension();
            $path = $request->file('pdf')->storeAs('cms-files', $filename, 'public');
            if (!empty($cms->pdf) && Storage::disk('public')->exists($cms->pdf)) {
                Storage::disk('public')->delete($cms->pdf);
            }
            $validate["pdf"] = $path;
        }
        $cms->update($validate);
        return Redirect::route('cms.index')->with('success', 'Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cms $cms)
    {
        $gambar = $cms->gambar;
        $pdf = $cms->pdf;
        $cms->delete();
        if ($gambar) {
            Storage::disk('public')->delete($gambar);
        }
        if($pdf) Storage::disk('public')->delete($pdf);
        return Redirect::route('cms.index')->with('success', 'Data berhasil di hapus');
    }
}
