<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use App\Models\Alternative;
use App\Models\AlternativeValue;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $criterias = Criteria::count();
        $alternatives = Alternative::count();
        return view('admin.pages.dashboard.index', compact('criterias', 'alternatives'));
    }
}
