<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alternative;
use App\Models\Criteria;

class HomeController extends Controller
{
    public function index()
    {
        $alternatives = Alternative::all();
        $criterias = Criteria::all();
        return view('user.pages.home.index', compact('alternatives', 'criterias'));
    }
}
