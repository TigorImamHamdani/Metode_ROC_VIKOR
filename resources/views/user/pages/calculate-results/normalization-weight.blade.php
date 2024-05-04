<table class="table align-items-center mb-0">
    <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Kode Alternatif
            </th>
            @foreach ($criterias as $criteria)
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                    {{ $criteria->criteria_code }}
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($alternatives as $alternative)
            <tr>
                <td>
                    <div class="d-flex px-3 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $alternative->alternative_code }}</h6>
                        </div>
                    </div>
                </td>
                @php
                    $maxResult = -INF; // Menginisialisasi nilai maksimum sebagai nilai negatif tak terhingga
                @endphp
                @foreach ($criterias as $criteria)
                    <td>
                        @php
                            $alternative_value = $alternative
                                ->alternative_values()
                                ->where('criteria_id', $criteria->id)
                                ->first();
                        @endphp
                        @if ($alternative_value)
                            @php
                                $maxValue = \App\Models\AlternativeValue::where('criteria_id', $criteria->id)->max(
                                    'value',
                                );
                                $minValue = \App\Models\AlternativeValue::where('criteria_id', $criteria->id)->min(
                                    'value',
                                );

                                $totalValue = floatval(
                                    ($maxValue - $alternative_value->value) /
                                        ($maxValue -
                                            $alternative_value->value -
                                            ($minValue - $alternative_value->value)),
                                );

                                // Perhitungan normalisasi bobot
                                $result = $weightValue[$criteria->id] * $totalValue;

                                // Memperbarui nilai maksimum jika $result lebih besar dari nilai maksimum sebelumnya
                                if ($result > $maxResult) {
                                    $maxResult = $result;
                                }
                            @endphp
                            <h6 class="text-xs font-weight-bold mb-0">{{ number_format($result, 3) }}</h6>
                        @else
                            <h6 class="text-xs font-weight-bold mb-0">-</h6>
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
