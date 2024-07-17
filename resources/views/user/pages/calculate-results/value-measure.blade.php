@php
    $userId = Auth::id(); // Get the logged-in user's ID

// Retrieve the rankings associated with the logged-in user
$rankings = \App\Models\Ranking::where('id_user', $userId)->get();

// Calculate utility and regret measures for each alternative
foreach ($alternatives as $alternative) {
    $utilityMeasure = 0;
    $regretMeasure = 0;

    foreach ($criterias as $criteria) {
        $alternative_value = $alternative
            ->alternative_values()
            ->where('criteria_id', $criteria->id)
            ->first();

        if ($alternative_value) {
            $maxValue = \App\Models\AlternativeValue::where('criteria_id', $criteria->id)->max('value');
            $minValue = \App\Models\AlternativeValue::where('criteria_id', $criteria->id)->min('value');

            if ($maxValue - $minValue == 0) {
                $totalValue = 0;
            } else {
                $totalValue = floatval(($maxValue - $alternative_value->value) / ($maxValue - $minValue));
            }

            $result = $weightValue[$criteria->id] * $totalValue;

            if ($result > $regretMeasure) {
                $regretMeasure = $result;
            }

            $utilityMeasure += $result;
        }
    }

    // Create or update the ranking entry for the current alternative and user
    $ranking = $rankings->where('alternative_id', $alternative->id)->first();
        if (!$ranking) {
            $ranking = new \App\Models\Ranking();
            $ranking->alternative_id = $alternative->id;
            $ranking->id_user = $userId;
        }

        $ranking->utility_measure = $utilityMeasure;
        $ranking->regret_measure = $regretMeasure;
        $ranking->save();
    }

@endphp
