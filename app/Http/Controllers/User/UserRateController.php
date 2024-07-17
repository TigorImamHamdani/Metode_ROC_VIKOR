<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use App\Models\Alternative;
use App\Models\AlternativeValue;
use App\Models\UserRate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class UserRateController extends Controller
{
    public function edit($alternative_id)
    {
        $criterias = Criteria::all();
        $alternatives = Alternative::findOrFail($alternative_id);
        $user_rates = UserRate::all();
        return view('user.pages.input-matrix.edit', compact('criterias', 'alternatives', 'user_rates'));
    }

    public function update(Request $request, $alternative_id)
    {
        // Validasi data permintaan
        $validator = Validator::make($request->all(), [
            'values' => 'required|array',
            'values.*' => 'required|numeric',
        ]);

        // Jika validasi gagal, arahkan kembali dengan kesalahan
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Dapatkan ID pengguna saat ini
        $userId = Auth::id();

        // Ulangi setiap nilai dan perbarui atau buat nilai alternatif
        foreach ($request->values as $criteria_id => $value) {
            UserRate::updateOrCreate(
                [
                    'alternative_id' => $alternative_id,
                    'criteria_id' => $criteria_id,
                    'user_id' => $userId,
                ],
                [
                    'value' => $value
                ]
            );
        }

        // Hitung dan simpan nilai rata-rata
        $this->calculateAndStoreAverage($alternative_id);

        return redirect()->route('user.home.index')->with('success', 'Data nilai alternatif berhasil diperbarui');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'criteria' => 'required|exists:alternatives,id',
            'values.*' => 'required|numeric',
        ]);

        $alternativeId = $request->criteria;

        // Dapatkan ID pengguna saat ini
        $userId = Auth::id();

        foreach ($request->values as $criteriaId => $value) {
            $existingData = UserRate::where('alternative_id', $alternativeId)
                ->where('criteria_id', $criteriaId)
                ->where('user_id', $userId)
                ->first();

            if ($existingData) {
                $existingData->update(['value' => $value]);
            } else {
                UserRate::create([
                    'alternative_id' => $alternativeId,
                    'criteria_id' => $criteriaId,
                    'user_id' => $userId,
                    'value' => $value,
                ]);
            }
        }

        // Hitung dan simpan nilai rata-rata
        $this->calculateAndStoreAverage($alternativeId);

        return redirect()->route('user.home.index')->with('success', 'Data nilai alternatif berhasil disimpan');
    }

    private function calculateAndStoreAverage($alternativeId)
    {
        // Hitung nilai rata-rata yang dikelompokkan berdasarkan id_alternatif dan id_kriteria
        $averageValues = UserRate::select('criteria_id', DB::raw('AVG(value) as avg_value'))
            ->where('alternative_id', $alternativeId)
            ->groupBy('criteria_id')
            ->get();

        // Simpan atau perbarui nilai rata-rata dalam tabel AlternativeValue
        foreach ($averageValues as $avgValue) {
            AlternativeValue::updateOrCreate(
                [
                    'alternative_id' => $alternativeId,
                    'criteria_id' => $avgValue->criteria_id,
                ],
                [
                    'value' => $avgValue->avg_value,
                ]
            );
        }
    }
}
