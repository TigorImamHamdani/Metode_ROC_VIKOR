@foreach ($alternatives as $alternative)
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
                // Menghitung total value dengan menggunakan floatval() untuk mengonversi string menjadi desimal
                $totalValue = floatval(
                    ($maxValue - $alternative_value->value) /
                        ($maxValue - $alternative_value->value - ($minValue - $alternative_value->value)),
                );
            @endphp
            {{-- <h6 class="text-xs font-weight-bold mb-0">{{ number_format($totalValue, 3) }}</h6> --}}
        @else
            {{-- <h6 class="text-xs font-weight-bold mb-0">-</h6> --}}
        @endif
    @endforeach
@endforeach
