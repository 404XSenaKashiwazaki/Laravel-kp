<?php

namespace App\Http\Controllers;

use App\Models\Cms;
use App\Models\Portofolio;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("profiles.index");
    }

     /**
     * Display a listing of the resource.
     */
    public function legalitas(Request $request)
    {
        $query = Cms::query();

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $cms = $query->latest()->paginate(10);

        return view('cms.show', [
            'artikels' => $cms,
        ]);
    }

     /**
     * Display a listing of the resource.
     */
    public function portofolio(Request $request)
    {
        $query = Portofolio::query();

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $cms = $query->latest()->paginate(10);

      
        return view('portofolio.show', [
            'artikels' => $cms,
        ]);
    }
}
