<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use App\Models\Alternative;
use App\Models\AlternativeValue;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AlternativeValueController extends Controller
{
    public function index()
    {
        $criterias = Criteria::all();
        $alternatives = Alternative::all();
        $alternative_values = AlternativeValue::all();
        return view('user.pages.input-matrix.index', compact('criterias', 'alternatives', 'alternative_values'));
    }

    public function edit($alternative_id)
    {
        $criterias = Criteria::all();
        $alternatives = Alternative::findOrFail($alternative_id);
        $alternative_values = AlternativeValue::all();
        return view('user.pages.input-matrix.edit', compact('criterias', 'alternatives', 'alternative_values'));
    }


    public function update(Request $request, $alternative_id)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'values' => 'required|array',
            'values.*' => 'required|numeric',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Loop through each value and update or create alternative value
        foreach ($request->values as $criteria_id => $value) {
            $alternativeValue = AlternativeValue::updateOrCreate(
                ['alternative_id' => $alternative_id, 'criteria_id' => $criteria_id],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Data nilai alternatif berhasil diperbarui');
    }


    // Input Berdasarkan Alternatif
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'criteria' => 'required|exists:alternatives,id',
            'values.*' => 'required|numeric',
        ]);

        $alternativeId = $request->criteria;

        foreach ($request->values as $criteriaId => $value) {
            // Cek apakah data sudah ada di tabel
            $existingData = AlternativeValue::where('alternative_id', $alternativeId)
                ->where('criteria_id', $criteriaId)
                ->first();

            if ($existingData) {
                // Jika sudah ada, perbarui nilainya
                $existingData->update(['value' => $value]);
            } else {
                // Jika belum ada, buat data baru
                AlternativeValue::create([
                    'alternative_id' => $alternativeId,
                    'criteria_id' => $criteriaId,
                    'value' => $value,
                ]);
            }
        }
        return redirect()->back()->with('success', 'Data nilai alternatif berhasil disimpan');
    }

    public function destroy($alternative_id)
    {
        // Cari semua alternative_values dengan alternative_id yang sesuai
        $alternative_values = AlternativeValue::where('alternative_id', $alternative_id)->get();

        // Hapus semua alternative_values yang ditemukan
        foreach ($alternative_values as $alternative_value) {
            $alternative_value->delete();
        }

        return redirect()->back()->with('success', 'Data nilai alternatif berhasil dihapus');
    }
}
