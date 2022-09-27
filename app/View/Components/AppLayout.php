<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        if (Auth::user()->role == 'superadmin')
            return view('superadmin.layouts.app');
        else if (Auth::user()->role == 'admin')
            return view('admin.layouts.app');
        else
            abort(403);
    }
}
