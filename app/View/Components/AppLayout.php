<?php

namespace App\View\Components;

use App\Models\Site;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
         $site = Site::first();
        return view('layouts.app',["site" => $site]);
    }
}
