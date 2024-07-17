{{-- Modal START --}}
<div class="modal fade" id="addAlternatifModal" tabindex="-1" role="dialog" aria-labelledby="addAlternatifModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAlternatifModalLabel">Tambah Alternatif</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.alternatives.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="alternative_code" class="form-label">Kode Alternatif</label>
                        <input type="text" name="alternative_code" id="alternative_code" class="form-control"
                            placeholder="Masukkan Kode Alternatif" value="{{ old('alternative_code') }}">
                        @error('alternative_code')
                            <div class="alert alert-danger" style="margin-top: 5px">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alternative_name" class="form-label">Nama Alternatif</label>
                        <input type="text" name="alternative_name" id="alternative_name" class="form-control"
                            placeholder="Masukkan Nama Alternatif" value="{{ old('alternative_name') }}">
                        @error('alternative_name')
                            <div class="alert alert-danger" style="margin-top: 5px">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <input type="text" name="description" id="description" class="form-control"
                            placeholder="Masukkan Deskripsi" value="{{ old('description') }}">
                        @error('description')
                            <div class="alert alert-danger" style="margin-top: 5px">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Link Lokasi</label>
                        <input type="text" name="location" id="location" class="form-control"
                            placeholder="Masukkan Link Lokasi" value="{{ old('location') }}">
                        @error('location')
                            <div class="alert alert-danger" style="margin-top: 5px">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Foto</label>
                        <input type="file" id="image" name="image" class="form-control">
                        @error('image')
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
