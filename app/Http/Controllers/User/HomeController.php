<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Ranking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
{
    $alternatives = Alternative::all();
    $criterias = Criteria::all();

    $alternative_details = DB::table('alternatives')
        ->leftJoin('alternative_values', 'alternatives.id', '=', 'alternative_values.alternative_id')
        ->leftJoin('criterias', 'alternative_values.criteria_id', '=', 'criterias.id')
        ->select(
            'alternatives.id',
            'alternatives.alternative_code',
            'alternatives.alternative_name',
            'alternatives.description',
            'alternatives.location',
            'alternatives.image'
        )
        ->where(function ($query) {
            $query->whereNull('alternative_values.value')
                ->orWhere('alternative_values.value', '=', '0')
                ->orWhere('alternative_values.value', '=', '');
        })
        ->groupBy(
            'alternatives.id',
            'alternatives.alternative_code',
            'alternatives.alternative_name',
            'alternatives.description',
            'alternatives.location',
            'alternatives.image'
        )
        ->havingRaw('COUNT(alternative_values.id) = (SELECT COUNT(*) FROM criterias)')
        ->get();

    return view('user.pages.home.index', compact('alternatives', 'criterias', 'alternative_details'));
}

    public function checkRankings()
    {
        if (Auth::guest()) {
            // Jika pengguna belum login, tetap arahkan ke halaman dengan modal
            return redirect()->route('user.home.index', ['showModal' => 'true']);
        }

        $userId = Auth::id(); // Ambil ID pengguna yang sedang login

        // Periksa apakah user_id ada di tabel rankings
        $rankingExists = Ranking::where('id_user', $userId)->exists();

        if ($rankingExists) {
            return redirect()->route('user.weight.index');
        } else {
            // Kembalikan tampilan dengan modal
            return redirect()->route('user.home.index', ['showModal' => 'true']);
        }
    }
}
