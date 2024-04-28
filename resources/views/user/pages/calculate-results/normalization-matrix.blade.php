<table class="table align-items-center mb-0">
    <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Kode Alternatif
            </th>
            @foreach ($criterias as $criteria)
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-2">
                    {{ $criteria->criteria_code }}
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>
