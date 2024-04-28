<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternative;
use App\Models\Criteria;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function index()
    {
        // Ambil semua kriteria dari database
        $criterias = Criteria::all();

        // Hitung jumlah kriteria
        $totalCriteria = count($criterias);

        if ($totalCriteria == 0) {
            return view('admin.pages.criterias.index', compact('criterias'));
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
        return view('admin.pages.criterias.index', compact('criterias', 'weightValue', 'alternatives'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'criteria_code' => 'required',
            'criteria_name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Buat record baru dalam tabel kriteria
        Criteria::create([
            'criteria_code' => $request->criteria_code,
            'criteria_name' => $request->criteria_name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.criterias.index')->with('success', 'Data kriteria berhasil ditambahkan.');
    }

    public function destroy(Criteria $criteria)
    {
        $criteria->delete();
        return redirect()->route('admin.criterias.index')->with('success', 'Data kriteria berhasil dihapus.');
    }
}
