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
                <form action="#" method="POST">
                    @csrf
                    

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
