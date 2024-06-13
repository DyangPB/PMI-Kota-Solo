@extends('layouts-relawan.default')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">


                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Laporan Assessment</h4>
                            @php
                                $defaultDateTime = now()->format('Y-m-d');
                            @endphp
                            <form action="{{ route('store-laporankejadian') }}" method="POST" class="forms-sample">
                                <div class="form-group">
                                    <label for="id_jeniskejadian">Jenis Kejadian</label>
                                    <select name="id_jeniskejadian" id="id_jeniskejadian" class="form-control form-control-sm" placeholder="- Pilih Jenis Kejadian -" required>
                                        <option value="">- Pilih Jenis Kejadian -</option>
                                        @foreach ($jeniskejadian as $jenis)
                                        <option value="{{ $jenis-> id_jeniskejadian }}">{{ $jenis-> nama_kejadian }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- $jeniskejadian = JenisKejadian::all();
                                $assess = Assessment::all();
                                $mobilisasisd = MobilisasiSd::all();
                                $giatpmi = GiatPMI::all();
                                $narahubung = PersonilNarahubung::all();
                                $petugasposko = PetuugasPosko::all(); -->
                                <!-- Lokasi -->
                                <div class="form-group">
                                    <label for="lokasi">Lokasi</label>
                                    <input type="email" class="form-control" id="lokasi" placeholder="Lokasi">
                                </div>
                                <!-- Tanggal Kejadian -->
                                <div class="form-group">
                                    <label for="waktu_kejadian">Tanggal Kejadian</label>
                                    <input type="date" class="form-control" id="tanggal_kejadian" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="update">Update</label>
                                    <input type="date" class="form-control" id="update" value="{{ $defaultDateTime }}">
                                </div>
                                {{--  <div class="form-group">
                                    <label>File upload</label>
                                    <input type="file" name="img[]" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                            placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary"
                                                type="button">Upload</button>
                                        </span>
                                    </div>
                                </div>  --}}
                                {{--  <div class="form-group">
                                    <label>Pemerintah membutuhkan Dukungan Internasional</label>
                                    <select class="js-example-basic-single w-100">
                                        <option value="AL">Ya</option>
                                        <option value="WY">Tidak</option>
                                    </select>
                                </div>  --}}

                                <div class="form-group" id="akses_menuju_lokasi">
                                    <label>Keterangan Akses Menuju Lokasi</label>
                                    <select class="js-example-basic-single w-100">
                                        <option value="AL">Aman</option>
                                        <option value="WY">Tidak Aman</option>
                                    </select>
                                </div>
                                {{-- Input Dampak --}}
                                <div class="form-group">
                                    <button type="button" id="dampak" class="btn btn-primary me-2">Input Dampak</button>
                                </div>

                                <div id="form_jumlah_kk" style="display:none;">
                                    <p class="card-description" id="subtitle">
                                        Korban Terdampak
                                    </p>
                                    <div class="form-group">
                                        <label for="jumlah_kk">Jumlah KK</label>
                                        <input type="number" class="form-control" id="jumlah_kk">
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_orang">Jumlah Orang</label>
                                        <input type="number" class="form-control" id="jumlah_orang">
                                    </div>
                                    <div class="form-group">
                                        <label for="luka_berat">Luka Berat</label>
                                        <input type="number" class="form-control" id="luka_berat">
                                    </div>
                                    <div class="form-group">
                                        <label for="meninggal">Meninggal</label>
                                        <input type="number" class="form-control" id="meninggal">
                                    </div>
                                    <div class="form-group">
                                        <label for="hidup">Hidup</label>
                                        <input type="number" class="form-control" id="hidup">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Mengungsi</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>

                                    <p class="card-description" id="subtitle">
                                        Fasilitas/Rumah Terdampak
                                    </p>
                                    <div class="form-group">
                                        <label for="jumlah_kk">Kerusakan Rumah Berat</label>
                                        <input type="number" class="form-control" id="jumlah_kk">
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_orang">Kerusakan Rumah Sedang</label>
                                        <input type="number" class="form-control" id="jumlah_orang">
                                    </div>
                                    <div class="form-group">
                                        <label for="luka_berat">Kerusakan Sekolah</label>
                                        <input type="number" class="form-control" id="luka_berat">
                                    </div>
                                    <div class="form-group">
                                        <label for="meninggal">Kerusakan Tempat Ibadah</label>
                                        <input type="number" class="form-control" id="meninggal">
                                    </div>
                                    <div class="form-group">
                                        <label for="hidup">Kerusakan Rumah Sakit</label>
                                        <input type="number" class="form-control" id="hidup">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Kerusakan Pasar</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Kerusakan Gedung Pemerintahan</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Kerusakan Lain Lain</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>

                                    <div class="form-group">
                                        <label for="mengungsi">Kerusakan Infrastruktur</label>
                                        <input type="text" class="form-control" id="mengungsi">
                                    </div>
                                </div>

                                {{-- Tambah Pengungsian --}}

                                <div class="form-group">
                                    <button type="button" id="tambah_pengungsian" class="btn btn-primary me-2">Tambah
                                        Pengungsian</button>
                                </div>

                                <div id="form_area">
                                    <div id="form_pengungsian" style="display:none;">
                                        <p class="card-description" id="subtitle">Pengungsian</p>
                                        <div class="form-group">
                                            <label for="nama_lokasi">Nama Lokasi</label>
                                            <input type="text" class="form-control" name="nama_lokasi[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_kk">KK</label>
                                            <input type="number" class="form-control" name="jumlah_kk[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_orang">Jiwa</label>
                                            <input type="number" class="form-control" name="jumlah_orang[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="laki_laki">Laki-Laki</label>
                                            <input type="number" class="form-control" name="laki_laki[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="perempuan">Perempuan</label>
                                            <input type="number" class="form-control" name="perempuan[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="kurang_dari_5">Kurang dari 5 Tahun</label>
                                            <input type="number" class="form-control" name="kurang_dari_5[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="antara_5_18">Antara 5-18 Tahun</label>
                                            <input type="number" class="form-control" name="antara_5_18[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="lebih_dari_18">Lebih Dari 18 Tahun</label>
                                            <input type="number" class="form-control" name="lebih_dari_18[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah</label>
                                            <input type="number" class="form-control" name="jumlah[]">
                                        </div>
                                    </div>
                                </div>

                                {{-- Personil --}}
                                {{--  <div class="form-group">
                                    <button type="button" id="personil" class="btn btn-primary me-2">Input
                                        Personil</button>
                                </div>

                                <div id="form_personil" style="display:none;">
                                    <p class="card-description" id="subtitle">
                                        Input Personil
                                    </p>
                                    <div class="form-group">
                                        <label for="jumlah_kk">Pengurus</label>
                                        <input type="number" class="form-control" id="jumlah_kk">
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_orang">Staf Markas Kab/Kota</label>
                                        <input type="number" class="form-control" id="jumlah_orang">
                                    </div>
                                    <div class="form-group">
                                        <label for="luka_berat">Staf Markas Provinsi</label>
                                        <input type="number" class="form-control" id="luka_berat">
                                    </div>
                                    <div class="form-group">
                                        <label for="meninggal">Staf Markas Pusat</label>
                                        <input type="number" class="form-control" id="meninggal">
                                    </div>
                                    <div class="form-group">
                                        <label for="hidup">Relawan PMI Kab/Kota</label>
                                        <input type="number" class="form-control" id="hidup">
                                    </div>
                                    <div class="form-group">
                                        <label for="hidup">Relawan PMI Provinsi</label>
                                        <input type="number" class="form-control" id="hidup">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Relawan Lintas Provinsi</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>

                                    <p class="card-description" id="subtitle">
                                        Spesialis
                                    </p>
                                    <div class="form-group">
                                        <label for="jumlah_kk">Medis</label>
                                        <input type="number" class="form-control" id="jumlah_kk">
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_orang">Paramedis</label>
                                        <input type="number" class="form-control" id="jumlah_orang">
                                    </div>
                                    <div class="form-group">
                                        <label for="luka_berat">Relief</label>
                                        <input type="number" class="form-control" id="luka_berat">
                                    </div>
                                    <div class="form-group">
                                        <label for="meninggal">Logistik</label>
                                        <input type="number" class="form-control" id="meninggal">
                                    </div>
                                    <div class="form-group">
                                        <label for="hidup">Watsan</label>
                                        <input type="number" class="form-control" id="hidup">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">IT Telkom</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Sheltering</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>

                                    <p class="card-description" id="subtitle">
                                        Alat Utama
                                    </p>
                                    <div class="form-group">
                                        <label for="jumlah_kk">Kend Ops</label>
                                        <input type="number" class="form-control" id="jumlah_kk">
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_orang">Truk Angkutan</label>
                                        <input type="number" class="form-control" id="jumlah_orang">
                                    </div>
                                    <div class="form-group">
                                        <label for="luka_berat">Truk Tanki</label>
                                        <input type="number" class="form-control" id="luka_berat">
                                    </div>
                                    <div class="form-group">
                                        <label for="meninggal">Double Cabin</label>
                                        <input type="number" class="form-control" id="meninggal">
                                    </div>
                                    <div class="form-group">
                                        <label for="hidup">Alat DU</label>
                                        <input type="number" class="form-control" id="hidup">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Ambulans</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Alat Watsan</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">RS Lapangan</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Alat PKDD</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Gudang Lapangan</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Posko Aju</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Alat IT/Tel Lapangan</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>
                                </div>  --}}


                                <h4 class="card-title">Evakuasi Korban Luka</h4>
                                <div class="form-group">
                                    <label for="kejadian_musibah">Tempat/Lokasi</label>
                                    <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                                </div>
                                <div>
                                    <p class="card-description">KK/Orang</p>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios1" value="">
                                            KK
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios2" value="option2" checked>
                                            Orang
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="waktu_kejadian">Jumlah</label>
                                    <input type="number" class="form-control" id="waktu_kejadian"
                                        placeholder="Password">
                                </div>
                                {{--  <h4 class="card-title">Distribusi Non-Food Item</h4>
                                <div class="form-group">
                                    <label for="kejadian_musibah">Tempat/Lokasi</label>
                                    <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                                </div>  --}}
                                {{--  <div>
                                    <p class="card-description">KK/Orang</p>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios1" value="">
                                            KK
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios2" value="option2" checked>
                                            Orang
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="waktu_kejadian">Jumlah</label>
                                    <input type="number" class="form-control" id="waktu_kejadian"
                                        placeholder="Password">
                                </div>  --}}
                                <h4 class="card-title">Layanan Kesehatan</h4>
                                <div class="form-group">
                                    <label for="kejadian_musibah">Tempat/Lokasi</label>
                                    <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                                </div>
                                <div>
                                    <p class="card-description">KK/Orang</p>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios1" value="">
                                            KK
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios2" value="option2" checked>
                                            Orang
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="waktu_kejadian">Jumlah</label>
                                    <input type="number" class="form-control" id="waktu_kejadian"
                                        placeholder="Password">
                                </div>
                                <h4 class="card-title">Layanan Air Bersih</h4>
                                <div class="form-group">
                                    <label for="kejadian_musibah">Tempat/Lokasi</label>
                                    <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                                </div>
                                <div>
                                    <p class="card-description">KK/Orang</p>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios1" value="">
                                            KK
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios2" value="option2" checked>
                                            Orang
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="waktu_kejadian">Jumlah</label>
                                    <input type="number" class="form-control" id="waktu_kejadian"
                                        placeholder="Password">
                                </div>
                                <h4 class="card-title">Lain Lain</h4>
                                <div class="form-group">
                                    <label for="kejadian_musibah">Tempat/Lokasi</label>
                                    <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                                </div>
                                <div>
                                    <p class="card-description">KK/Orang</p>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios1" value="">
                                            KK
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios2" value="option2" checked>
                                            Orang
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="waktu_kejadian">Jumlah</label>
                                    <input type="number" class="form-control" id="waktu_kejadian"
                                        placeholder="Password">
                                </div>

                                {{--  <div class="form-group">
                                    <label for="kejadian_musibah">Giat Pemerintahan</label>
                                    <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                                </div>  --}}

                                <div class="form-group">
                                    <label for="kejadian_musibah">Kebutuhan</label>
                                    <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                                </div>

                                {{--  <div class="form-group">
                                    <label for="kejadian_musibah">Hambatan</label>
                                    <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                                </div>  --}}

                                <div class="form-group">
                                    <button type="button" id="tambah_cp" class="btn btn-primary me-2">Tambah
                                        CP Personil</button>
                                </div>

                                <div id="form_area_cp">
                                    <div id="form_cp" style="display:none;">
                                        <p class="card-description" id="subtitle">Personel yang dapat dihubungi</p>
                                        <div class="form-group">
                                            <label for="nama_lokasi">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama_lokasi[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_kk">Posisi</label>
                                            <input type="text" class="form-control" name="jumlah_kk[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_orang">Kontak</label>
                                            <input type="phone" class="form-control" name="jumlah_orang[]">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="button" id="tambah_petugas_posko" class="btn btn-primary me-2">Petugas
                                        Assessment</button>
                                </div>

                                <div id="form_area_petugas">
                                    <div id="form_petugas" style="display:none;">
                                        <p class="card-description" id="subtitle">Personel yang dapat dihubungi</p>
                                        <div class="form-group">
                                            <label for="nama_lokasi">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama_lokasi[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_kk">Posisi</label>
                                            <input type="text" class="form-control" name="jumlah_kk[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_orang">Kontak</label>
                                            <input type="phone" class="form-control" name="jumlah_orang[]">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <button class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endsection


        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                document.getElementById('personil').addEventListener('click', function() {
                    // Dapatkan elemen form
                    var formPersonil = document.getElementById('form_personil');

                    // Toggle display
                    if (formPersonil.style.display === 'none') {
                        formPersonil.style.display = 'block';
                    } else {
                        formPersonil.style.display = 'none';
                    }
                });
            });


            document.addEventListener('DOMContentLoaded', (event) => {
                document.getElementById('dampak').addEventListener('click', function() {
                    // Dapatkan elemen form
                    var formJumlahKK = document.getElementById('form_jumlah_kk');

                    // Toggle display
                    if (formJumlahKK.style.display === 'none') {
                        formJumlahKK.style.display = 'block';
                    } else {
                        formJumlahKK.style.display = 'none';
                    }
                });
            });
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('tambah_pengungsian').addEventListener('click', function() {
                    // Ambil elemen form pengungsian
                    var formPengungsian = document.getElementById('form_pengungsian');
                    // Klon elemen form pengungsian
                    var clone = formPengungsian.cloneNode(true);
                    // Tampilkan form klon
                    clone.style.display = 'block';
                    // Hapus atribut id agar tidak duplikat
                    clone.removeAttribute('id');
                    // Tambahkan form klon ke dalam form area
                    document.getElementById('form_area').appendChild(clone);
                    var cancelBtn = document.createElement('button');
                    cancelBtn.setAttribute('type', 'button');
                    cancelBtn.classList.add('btn', 'btn-danger', 'me-2');
                    cancelBtn.textContent = 'Cancel';
                    // Tambahkan event listener untuk tombol "Cancel"
                    cancelBtn.addEventListener('click', function() {
                        // Hapus form yang baru saja ditambahkan
                        clone.remove();
                        // Hapus tombol "Cancel"
                        cancelBtn.remove();
                        // Tampilkan kembali tombol "Tambah Pengungsian"
                        document.getElementById('tambah_personil').style.display = 'block';
                    });
                    // Sisipkan tombol "Cancel" setelah tombol "Tambah Pengungsian"
                    document.getElementById('form_area').appendChild(cancelBtn);
                    // Sembunyikan tombol "Tambah Pengungsian"
                    document.getElementById('tambah_personil').style.display = 'none';
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('tambah_cp').addEventListener('click', function() {
                    // Ambil elemen form pengungsian
                    var formPengungsian = document.getElementById('form_cp');
                    // Klon elemen form pengungsian
                    var clone = formPengungsian.cloneNode(true);
                    // Tampilkan form klon
                    clone.style.display = 'block';
                    // Hapus atribut id agar tidak duplikat
                    clone.removeAttribute('id');
                    // Tambahkan form klon ke dalam form area
                    document.getElementById('form_area_cp').appendChild(clone);
                    var cancelBtn = document.createElement('button');
                    cancelBtn.setAttribute('type', 'button');
                    cancelBtn.classList.add('btn', 'btn-danger', 'me-2');
                    cancelBtn.textContent = 'Cancel';
                    // Tambahkan event listener untuk tombol "Cancel"
                    cancelBtn.addEventListener('click', function() {
                        // Hapus form yang baru saja ditambahkan
                        clone.remove();
                        // Hapus tombol "Cancel"
                        cancelBtn.remove();
                        // Tampilkan kembali tombol "Tambah Pengungsian"
                        document.getElementById('tambah_cp').style.display = 'block';
                    });
                    // Sisipkan tombol "Cancel" setelah tombol "Tambah Pengungsian"
                    document.getElementById('form_area_cp').appendChild(cancelBtn);
                });
            });
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('tambah_petugas_posko').addEventListener('click', function() {
                    // Ambil elemen form pengungsian
                    var formPengungsian = document.getElementById('form_petugas');
                    // Klon elemen form pengungsian
                    var clone = formPengungsian.cloneNode(true);
                    // Tampilkan form klon
                    clone.style.display = 'block';
                    // Hapus atribut id agar tidak duplikat
                    clone.removeAttribute('id');
                    // Tambahkan form klon ke dalam form area
                    document.getElementById('form_area_petugas').appendChild(clone);
                    var cancelBtn = document.createElement('button');
                    cancelBtn.setAttribute('type', 'button');
                    cancelBtn.classList.add('btn', 'btn-danger', 'me-2');
                    cancelBtn.textContent = 'Cancel';
                    // Tambahkan event listener untuk tombol "Cancel"
                    cancelBtn.addEventListener('click', function() {
                        // Hapus form yang baru saja ditambahkan
                        clone.remove();
                        // Hapus tombol "Cancel"
                        cancelBtn.remove();
                        // Tampilkan kembali tombol "Tambah Pengungsian"
                        document.getElementById('tambah_petugas_posko').style.display = 'block';
                    });
                    // Sisipkan tombol "Cancel" setelah tombol "Tambah Pengungsian"
                    document.getElementById('form_area_petugas').appendChild(cancelBtn);
                });
            });
        </script>
