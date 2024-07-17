<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\WeightValue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class WeightValueController extends Controller
{
    public function index()
    {
        // Dapatkan pengguna yang masuk
        $user = Auth::user();

        // Dapatkan semua kriteria dari database
        $criterias = Criteria::all();

        // Dapatkan nilai bobot spesifik pengguna dari database
        $userWeights = WeightValue::where('user_id', $user->id)->pluck('weight', 'criteria_id');

        // Inisialisasi array untuk menyimpan bobot ROC
        $weightValue = [];

        // Hitung bobot ROC untuk setiap kriteria
        foreach ($criterias as $criteria) {
            // Dapatkan bobot khusus pengguna atau default pada bobot kriteria
            $criteriaWeight = $userWeights->get($criteria->id, $criteria->weight);

            // Hitung peringkat prioritas
            $weightRanking = 1;
            foreach ($criterias as $otherCriteria) {
                $otherCriteriaWeight = $userWeights->get($otherCriteria->id, $otherCriteria->weight);
                if ($criteriaWeight < $otherCriteriaWeight) {
                    $weightRanking++;
                }
            }

            // Hitung bobot ROC berdasarkan peringkat prioritas
            $weightROC = 0;
            for ($i = 1; $i <= count($criterias); $i++) {
                if ($weightRanking <= $i) {
                    $weightROC += 1 / $i;
                }
            }

            // Simpan bobot ROC dalam array
            $weightValue[$criteria->id] = $weightROC / count($criterias);
        }

        // Dapatkan semua alternatif dari database
        $alternatives = Alternative::all();

        // Kirim kriteria dan penghitungan bobot ROC ke tampilan
        return view('user.pages.input-weight.index', compact('criterias', 'weightValue', 'alternatives'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'values' => 'required|array',
            'values.*' => 'required|numeric|min:1|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = auth()->user();

        foreach ($request->values as $criteria_id => $weight) {
            WeightValue::updateOrCreate(
                ['user_id' => $user->id, 'criteria_id' => $criteria_id],
                ['weight' => $weight]
            );
        }

        return redirect()->route('user.result.index')->with('success', 'Bobot berhasil diperbarui.');
    }

    // Perbarui fungsi untuk memperbarui nilai bobot tertentu
    public function update(Request $request, $criteria_id)
    {
        $request->validate([
            'weight' => 'required|numeric|min:1|max:100',
        ]);

        $user = auth()->user();

        WeightValue::updateOrCreate(
            ['user_id' => $user->id, 'criteria_id' => $criteria_id],
            ['weight' => $request->weight]
        );

        return redirect()->route('user.result.index')->with('success', 'Data kriteria berhasil disimpan.');
    }

    // Edit berfungsi untuk menampilkan form untuk mengedit nilai bobot tertentu
    public function edit($criteria_id)
    {
        $user = auth()->user();
        $criteria = Criteria::findOrFail($criteria_id);
        $weightValue = WeightValue::where('user_id', $user->id)->where('criteria_id', $criteria_id)->firstOrFail();

        return view('user.pages.input-weight.edit', compact('criteria', 'weightValue'));
    }

    // Hancurkan fungsi untuk menghapus nilai bobot tertentu
    public function destroy($criteria_id)
    {
        $user = auth()->user();
        $weightValue = WeightValue::where('user_id', $user->id)->where('criteria_id', $criteria_id)->firstOrFail();

        $weightValue->delete();

        return redirect()->route('user.weight.index')->with('success', 'Data bobot berhasil dihapus.');
    }
}
