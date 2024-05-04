<table class="table align-items-center mb-0">
    <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Kode Alternatif</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Nama Alternatif</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                Nilai S</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                Nilai R</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($alternatives as $alternative)
            <tr>
                <td>
                    <div class="d-flex px-3 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">
                                {{ $alternative->alternative_code }}
                            </h6>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex px-3 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="text-xs font-weight-bold mb-0">
                                {{ $alternative->alternative_name }}
                            </h6>
                        </div>
                    </div>
                </td>
                @php
                    $utilityMeasure = 0;
                    $regretMeasure = 0;
                @endphp

                @foreach ($criterias as $criteria)
                    @php
                        $alternative_value = $alternative
                            ->alternative_values()
                            ->where('criteria_id', $criteria->id)
                            ->first();
                    @endphp
                    @if ($alternative_value)
                        @php
                            $maxValue = \App\Models\AlternativeValue::where('criteria_id', $criteria->id)->max('value');
                            $minValue = \App\Models\AlternativeValue::where('criteria_id', $criteria->id)->min('value');

                            $totalValue = floatval(
                                ($maxValue - $alternative_value->value) /
                                    ($maxValue - $alternative_value->value - ($minValue - $alternative_value->value)),
                            );
                            $result = $weightValue[$criteria->id] * $totalValue;

                            if ($result > $regretMeasure) {
                                $regretMeasure = $result;
                            }

                            $utilityMeasure += $result;
                        @endphp
                    @endif
                @endforeach

                @php
                    $rankings = \App\Models\Ranking::where('alternative_id', $alternative->id)->firstOrCreate([
                        'alternative_id' => $alternative->id,
                    ]);

                    $rankings->utility_measure = $utilityMeasure;
                    $rankings->regret_measure = $regretMeasure;
                    $rankings->save();
                @endphp

                <td>
                    <h6 class="text-xs font-weight-bold mb-0">{{ number_format($utilityMeasure, 3) }}</h6>
                </td>
                <td>
                    <h6 class="text-xs font-weight-bold mb-0">{{ number_format($regretMeasure, 3) }}</h6>
                </td>

            </tr>
        @endforeach

        <td>
            <div class="d-flex px-3 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Nilai Maksimal</h6>
                </div>
            </div>
        </td>
        <td>
            <h6 class="text-xs font-weight-bold mb-0">
            </h6>
        </td>
        <td>
            <h6 class="text-xs font-weight-bold mb-0">
                {{ number_format($rankings->max('utility_measure'), 3) }}</h6>
        </td>
        <td>
            <h6 class="text-xs font-weight-bold mb-0">
                {{ number_format($rankings->max('regret_measure'), 3) }}</h6>
        </td>
        <tr>
            <td>
                <div class="d-flex px-3 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Nilai Minimal</h6>
                    </div>
                </div>
            </td>
            <td>
                <h6 class="text-xs font-weight-bold mb-0">
                </h6>
            </td>
            <td>
                <h6 class="text-xs font-weight-bold mb-0">
                    {{ number_format($rankings->min('utility_measure'), 3) }}</h6>
            </td>
            <td>
                <h6 class="text-xs font-weight-bold mb-0">
                    {{ number_format($rankings->min('regret_measure'), 3) }}</h6>
            </td>
        </tr>
    </tbody>
</table>
