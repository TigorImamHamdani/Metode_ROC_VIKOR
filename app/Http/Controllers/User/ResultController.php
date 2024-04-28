<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Alternative;
use App\Models\AlternativeValue;
use App\Models\Criteria;
use App\Models\Ranking;
use App\Models\Result;
use Illuminate\Http\Request;


class ResultController extends Controller
{
    // public function index()
    // {
    //     $criterias = Criteria::all();
    //     $alternatives = Alternative::all();
    //     $alternative_values = AlternativeValue::all();
    //     return view('user.pages.calculate-results.normalization-matrix', compact('criterias', 'alternatives', 'alternative_values'));
    // }

    public function value_result()
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

        return view('user.pages.calculate-results.value-result', compact('criterias', 'weightValue', 'alternatives'));
    }

    public function normalization_weight()
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
        return view('user.pages.calculate-results.normalization-weight', compact('criterias', 'weightValue', 'alternatives'));
    }


    public function index()
    {
        $criterias = Criteria::all();
        $alternatives = Alternative::all();
        $alternative_values = AlternativeValue::all();
        $rankings = Ranking::all();

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

        return view('user.pages.calculate-results.index', compact('criterias', 'alternatives', 'alternative_values', 'weightValue', 'rankings'));
    }
}
