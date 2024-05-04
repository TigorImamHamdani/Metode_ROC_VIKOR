<table class="table align-items-center mb-0">
    <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Kode Alternatif</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Nama Alternatif</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                Hasil</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                Peringkat</th>
        </tr>
    </thead>
    <tbody>

        @php
            $sortedRankings = $rankings->sortBy('result_cal');
            $rank = 0;
        @endphp

        @foreach ($sortedRankings as $ranking)
            @php
                if ($ranking->utility_measure == 0 && $ranking->regret_measure == 0) {
                    $Qi = 0;
                } else {
                    $Qi =
                        (0.5 * ($ranking->utility_measure - $sortedRankings->max('utility_measure'))) /
                            ($sortedRankings->min('utility_measure') - $sortedRankings->max('utility_measure')) +
                        ((1 - 0.5) * ($ranking->regret_measure - $sortedRankings->max('regret_measure'))) /
                            ($sortedRankings->min('regret_measure') - $sortedRankings->max('regret_measure'));
                }

                $ranking->result_cal = $Qi;
                $ranking->save();

            @endphp
            <tr>
                <td>
                    @foreach ($alternatives as $alternative)
                        @if ($alternative->id == $ranking->alternative_id)
                            <div class="d-flex px-3 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="text-sm font-weight-bold mb-0">
                                        {{ $alternative->alternative_code }}</h6>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </td>

                <td>
                    @foreach ($alternatives as $alternative)
                        @if ($alternative->id == $ranking->alternative_id)
                            <div class="d-flex px-3 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="text-xs font-weight-bold mb-0">
                                        {{ $alternative->alternative_name }}</h6>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </td>

                <td>
                    <div class="d-flex px-1 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="text-xs font-weight-bold mb-0">
                                {{ number_format($Qi, 3) }}</h6>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex px-1 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="text-xs font-weight-bold mb-0">{{ $rank + 1 }}</h6>
                        </div>
                    </div>
                </td>
            </tr>
            @php
                $rank++;
                $ranking->result_rank = $rank;
                $ranking->save();
            @endphp
        @endforeach
    </tbody>
</table>
