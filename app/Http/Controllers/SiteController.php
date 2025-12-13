<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $site = Site::first();
        return view('site.index', [
            'site' => $site,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Site $site)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('site', 'name')->ignore($site->uuid, "uuid")],
            'deskripsi' => ['required', 'string', 'max:255'],
            'tentang' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            "gambar" => ["nullable","image","mimes:jpeg,png,jpg,gif,svg","max:512000"]
        ]);

        if ($request->hasFile('gambar')) {
            $filename = uniqid() . '.' . $request->file('gambar')->getClientOriginalExtension();
            $path = $request->file('gambar')->storeAs('site', $filename, 'public');
             if (!empty($site->gambar) && Storage::disk('public')->exists($site->gambar)) {
                Storage::disk('public')->delete($site->gambar);
            }
            $validate["gambar"] = $path;
        }
        $site->update($validate);
        return Redirect::route('site.index')->with('success', 'Data berhasil di update');
    }


}
