<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Alternative;
use App\Models\Criteria;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class WeightController extends Controller
{
    public function index()
    {
        // Ambil semua kriteria dari database
        $criterias = Criteria::all();

        // Hitung jumlah kriteria
        $totalCriteria = count($criterias);

        if ($totalCriteria == 0) {
            return view('user.pages.input-weight.index', compact('criterias'));
        }

        // Inisialisasi array untuk menyimpan hasil perhitungan bobot ROC
        $weightValue = [];

        // Hitung bobot ROC untuk setiap kriteria
        foreach ($criterias as $criteria) {
            // Hitung peringkat prioritas
            $weightRangking = 1;
            foreach ($criterias as $otherCriteria) {
                if ($criteria->weight < $otherCriteria->weight) {
                    $weightRangking++;
                }
            }

            // Hitung bobot ROC berdasarkan peringkat prioritas
            $weightROC = 0;
            for ($i = 1; $i <= $totalCriteria; $i++) {
                if ($weightRangking <= $i) {
                    $weightROC += 1 / $i;
                }
            }

            // Simpan bobot ROC ke dalam array $results
            $weightValue[$criteria->id] = $weightROC / $totalCriteria;
        }

        // Ambil semua data alternatif dari database
        $alternatives = Alternative::all();

        // Kirim data kriteria dan hasil perhitungan bobot ROC ke view
        return view('user.pages.input-weight.index', compact('criterias', 'weightValue', 'alternatives'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'criteria_id' => 'required', // Updated validation rule
            'weight' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $criteria = Criteria::find($request->criteria_id);

        if (!$criteria) {
            return redirect()->back()->with('error', 'Kriteria tidak ditemukan.');
        }

        $criteria->weight = $request->weight;
        $criteria->save();

        return redirect()->route('user.weight.index')->with('success', 'Bobot berhasil diperbarui.');
    }

    public function edit($criteria_id) {
        $criteria = Criteria::findOrFail($criteria_id);
        return view('user.pages.input-weight.edit', compact('criteria'));
    }

    public function update(Request $request, $criteria_id) {
        // Validate the request
        $request->validate([
            'weight' => 'required|numeric', // Add any additional validation rules here
        ]);

        // Find the criteria by ID
        $criteria = Criteria::findOrFail($criteria_id);

        // Update the weight
        $criteria->update([
            'weight' => $request->weight,
        ]);

        // Redirect back with success message
        return redirect()->route('user.weight.index')->with('success', 'Weight updated successfully.');
    }

    public function destroy(Criteria $criteria)
    {
        $criteria->delete();
        return redirect()->route('user.weight.index')->with('success', 'Data kriteria berhasil dihapus.');
    }
}
