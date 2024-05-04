{{-- Input Berdasarkan Alternatif --}}
<div class="modal fade" id="addMatrikModal" tabindex="-1" role="dialog" aria-labelledby="addMatrikModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMatrikModalLabel">Input/Edit Nilai Alternatif</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-uppercase text-xs font-weight-bolder">Panduan Pengisian</p>
                <p class=" text-secondary text-xs font-weight-bolder opacity-7">
                    Skala Penilaian 1 - 5 :<br>
                    Keterangan :
                    <br> 5 = Sangat Baik <br> 4 = Baik <br> 3 = Cukup <br> 2 = Kurang <br> 1 = Sangat Kurang
                </p>
                <form action="{{ route('user.alternative-values.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="criteria" class="form-label">Kriteria</label>
                        <select name="criteria" id="criteria" class="form-control" required>
                            <option value="">Pilih Alternatif</option>
                            @foreach ($alternatives as $alternative)
                                <option value="{{ $alternative->id }}">{{ $alternative->alternative_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @foreach ($criterias as $criteria)
                        <div class="mb-3">
                            <label for="value{{ $criteria->id }}"
                                class="form-label">{{ $criteria->criteria_name }}</label>
                            <select name="values[{{ $criteria->id }}]" id="value{{ $criteria->id }}" class="form-select"
                                required>
                                <option value="">Pilih Nilai</option>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            @error('values.' . $criteria->id)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    @endforeach

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
