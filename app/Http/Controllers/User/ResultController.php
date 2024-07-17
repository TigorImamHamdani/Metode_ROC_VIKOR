<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Alternative;
use App\Models\AlternativeValue;
use App\Models\Criteria;
use App\Models\Ranking;
use App\Models\WeightValue;
use Illuminate\Support\Facades\Auth;
use App\Models\Result;
use Illuminate\Http\Request;


class ResultController extends Controller
{
    public function value_result()
    {
        // Dapatkan pengguna yang masuk
        $user = Auth::user();

        // Dapatkan semua kriteria dari database
        $criterias = Criteria::all();

        // Dapatkan nilai bobot spesifik pengguna dari database
        $userWeights = WeightValue::where('user_id', $user->id)->pluck('weight', 'criteria_id');

        // Inisialisasi array untuk menyimpan bobot ROC

        $weightValue = []; // Inisialisasi array nilai bobot

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

            //Hitung bobot ROC berdasarkan peringkat prioritas
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

        return view('user.pages.calculate-results.value-result', compact('criterias', 'weightValue', 'alternatives'));
    }

    public function normalization_weight()
    {
        // Dapatkan pengguna yang masuk
        $user = Auth::user();

        // Dapatkan semua kriteria dari database
        $criterias = Criteria::all();

        // Dapatkan nilai bobot spesifik pengguna dari database
        $userWeights = WeightValue::where('user_id', $user->id)->pluck('weight', 'criteria_id');

        // Inisialisasi array untuk menyimpan bobot ROC
        $weightValue = []; // Inisialisasi array nilai bobot

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

        // Kirim data kriteria dan hasil perhitungan bobot ROC ke view
        return view('user.pages.calculate-results.normalization-weight', compact('criterias', 'weightValue', 'alternatives'));
    }


    public function index()
    {
        $criterias = Criteria::all();
        $alternatives = Alternative::all();
        $alternative_values = AlternativeValue::all();
        $rankings = Ranking::all();

        $user = Auth::user();

        // Dapatkan nilai bobot spesifik pengguna dari database
        $userWeights = WeightValue::where('user_id', $user->id)->pluck('weight', 'criteria_id');


        $totalCriteria = count($criterias);

        if ($totalCriteria == 0) {
            return view('admin.pages.criterias.index', compact('criterias'));
        }

        // Inisialisasi array untuk menyimpan hasil perhitungan bobot ROC

        $weightValue = []; // Inisialisasi array nilai bobot

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

            // Simpan bobot ROC ke dalam array $results
            $weightValue[$criteria->id] = $weightROC / count($criterias);
        }
        return view('user.pages.calculate-results.index', compact('criterias', 'alternatives', 'alternative_values', 'weightValue', 'rankings'));
    }
}
