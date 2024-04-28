<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternative;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    public function index()
    {
        $alternatives = Alternative::all();
        return view('admin.pages.alternatives.index', compact('alternatives'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alternative_code' => 'required',
            'alternative_name' => 'required',
            'description' => 'required',
            'image' => 'required|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imagePath = $request->file('image')->store('images', 'public');

        Alternative::create([
            'alternative_code' => $request->alternative_code,
            'alternative_name' => $request->alternative_name,
            'description' => $request->description,
            'utility_measure' => 0,
            'regret_measure' => 0,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.alternatives.index')->with('success', 'Data alternatif berhasil ditambahkan.');
    }

    public function destroy(Alternative $alternative)
    {
        $alternative->delete();
        return redirect()->route('admin.alternatives.index')->with('success', 'Data alternatif berhasil dihapus.');
    }
}
