{{-- Modal START --}}
<div class="modal fade" id="addKriteriaModal" tabindex="-1" role="dialog" aria-labelledby="addKriteriaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addKriteriaModalLabel">Tambah Data Kriteria</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-uppercase text-xs font-weight-bolder">Panduan Pengisian</p>
                <p class=" text-secondary text-xs font-weight-bolder opacity-7">
                    Skala Penilaian Bobot 1 sampai 100
                    <br> Nilai bobot yang dimasukkan tidak boleh sama dengan kriteria yang lain.
                </p>
                <form action="#" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="criteria_code" class="form-label">Kode Kriteria</label>
                        <input type="text" name="criteria_code" id="criteria_code" class="form-control" placeholder="Masukkan kode kriteria" value="{{ old('criteria_code') }}">
                        @error('criteria_code')
                            <div class="alert alert-danger" style="margin-top: 5px">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="criteria_name" class="form-label">Nama Kriteria</label>
                        <input type="text" name="criteria_name" id="criteria_name" class="form-control" placeholder="Masukkan nama kriteria" value="{{ old('criteria_name') }}">
                        @error('criteria_name')
                            <div class="alert alert-danger" style="margin-top: 5px">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Jenis Kriteria</label>
                        <input type="text" name="description" id="description" class="form-control" placeholder="Masukkan jenis kriteria" value="{{ old('description') }}">
                        @error('description')
                            <div class="alert alert-danger" style="margin-top: 5px">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Modal END --}}
