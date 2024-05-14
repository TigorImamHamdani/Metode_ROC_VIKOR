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
            'location' => 'required',
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
            'location' => $request->location,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.alternatives.index')->with('success', 'Data alternatif berhasil ditambahkan.');
    }

    public function edit(Alternative $alternative)
    {
        return view('admin.pages.alternatives.edit', compact('alternative'));
    }

    public function show(Alternative $alternative)
    {
        return view('admin.pages.alternatives.show', compact('alternative'));
    }

    public function update(Request $request, Alternative $alternative)
    {
        $validator = Validator::make($request->all(), [
            'alternative_code' => 'required',
            'alternative_name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'image' => 'image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $alternative->image = $imagePath;
        }

        $alternative->alternative_code = $request->alternative_code;
        $alternative->alternative_name = $request->alternative_name;
        $alternative->location = $request->location;
        $alternative->description = $request->description;
        $alternative->save();

        return redirect()->route('admin.alternatives.index')->with('success', 'Data alternatif berhasil diperbarui.');
    }


    public function destroy(Alternative $alternative)
    {
        $alternative->delete();
        return redirect()->route('admin.alternatives.index')->with('success', 'Data alternatif berhasil dihapus.');
    }
}
