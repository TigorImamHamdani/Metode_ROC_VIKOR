<style>
    .container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 16px;
        width: 300px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .card-body {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .card-img-top {
        width: 100%;
        height: auto;
        border-radius: 8px 8px 0 0;
        object-fit: cover;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
        margin-top: 15px;
    }

    .card-text {
        font-size: 1rem;
        margin: 5px 0;
    }
</style>


<div class="container">
    @php
    $userId = Auth::id(); // Get the logged-in user's ID

    // Retrieve the rankings associated with the logged-in user
    $rankings = \App\Models\Ranking::where('id_user', $userId)->get();

    // Sort the rankings by result_cal
    $sortedRankings = $rankings->sortBy('result_cal');
    $rank = 0;
    @endphp

    @foreach ($sortedRankings as $ranking)
        @php
            $alternative = $alternatives->where('id', $ranking->alternative_id)->first();
        @endphp

        @if ($alternative)
            <div class="card">
                <div class="card-body d-flex flex-column">
                    <h3 class="card-title">{{ $rank + 1 }}</h3>
                    <img src="{{ asset('storage/' . $alternative->image) }}" alt="{{ $alternative->alternative_name }}" class="card-img-top">
                    <h5 class="card-title">{{ $alternative->alternative_name }}</h5>
                    <div class="mt-auto">
                        <a href="{{ $alternative->location }}" class="btn btn-primary btn-sm">Lihat Lokasi</a>
                    </div>
                </div>
            </div>
            @php $rank++; @endphp
        @endif

        @php
            // Calculate Qi
            $utilityMeasure = $sortedRankings->min('utility_measure') - $sortedRankings->max('utility_measure');
            $regretMeasure = $sortedRankings->min('regret_measure') - $sortedRankings->max('regret_measure');

            if ($utilityMeasure == 0 || $regretMeasure == 0) {
                $Qi = 0;
            } else {
                $Qi =
                    (0.5 * ($ranking->utility_measure - $sortedRankings->max('utility_measure'))) / $utilityMeasure +
                    ((1 - 0.5) * ($ranking->regret_measure - $sortedRankings->max('regret_measure'))) / $regretMeasure;
            }

            $ranking->result_cal = $Qi;
            $ranking->result_rank = $rank; // Update result_rank
            $ranking->save();
        @endphp
    @endforeach
</div>

