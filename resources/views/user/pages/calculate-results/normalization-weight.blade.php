@foreach ($alternatives as $alternative)
    @foreach ($criterias as $criteria)
        <td>
            @php
                $alternativeValue = $alternative
                    ->alternative_values()
                    ->where('criteria_id', $criteria->id)
                    ->first();

                if ($alternativeValue) {
                    $maxValue = \App\Models\AlternativeValue::where('criteria_id', $criteria->id)->max('value');
                    $minValue = \App\Models\AlternativeValue::where('criteria_id', $criteria->id)->min('value');

                    // Check if the denominator is zero to avoid division by zero error
                    if ($maxValue - $minValue != 0) {
                        $totalValue = floatval(($maxValue - $alternativeValue->value) / ($maxValue - $minValue));
                    } else {
                        $totalValue = 0;
                    }

                    // Calculate the result using the weight value from the controller
                    $result = $weightValue[$criteria->id] * $totalValue;
                } else {
                    $result = '-';
                }
            @endphp
            {{-- <h6 class="text-xs font-weight-bold mb-0">{{ $result }}</h6> --}}
        </td>
    @endforeach
    </tr>
@endforeach
</tbody>
</table>
