<?php

// Controller namespacing.
namespace App\Http\Controllers\Admin\Modules;
use App\Http\Controllers\Controller;

// Facades.

// Models.
use App\Models\Post;

// Traits
use App\Traits\HasRightsTrait;

class DashboardController extends Controller
{
    /**
    * Traits
    *
    */
    use HasRightsTrait;

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        // Init view.
        return view('admin.modules.dashboard.index');
    }
}
