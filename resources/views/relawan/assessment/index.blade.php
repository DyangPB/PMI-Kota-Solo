@extends('layouts-relawan.default')

@section('content')

<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Laporan Assessment</h4>
            <p class="card-description">
              Daftar laporan assessment yang telah diunggah
            </p>
            <div class="home-tab">
              <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                <div class="btn-wrapper ms-auto">
                  <a href="{{ route('create-assessment') }}" class="btn btn-primary text-white me-0">
                    <i class="icon-download"></i> Tambah Data
                  </a>
                </div>
              </div>
            </div>
            <div>
              <div class="table-responsive pt-3">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Jenis Kejadian</th>
                      <th>Lokasi</th>
                      <th>Waktu Kejadian</th>
                      <th>Terakhir Update</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($assessments as $assessment)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>
                        @if ($assessment->jenisKejadian)
                          {{ $assessment->jenisKejadian->nama_kejadian }}
                        @else
                          Nama tidak ditemukan
                        @endif</td>
                      <td>{{ $assessment->lokasi }}</td>
                      <td>{{ $assessment->waktu_kejadian }}</td>
                      <td>{{ $assessment->update_terakhir }}</td>
                      <td>
                        @if($assessment->status == 'Terkonfirmasi')
                        <p class="btn btn-success btn-sm">{{ $assessment->status }}</p>
                        @elseif($assessment->status == 'Belum Terkonfirmasi')
                        <p class="btn btn-warning btn-sm">{{ $assessment->status }}</p>
                        @endif
                      </td>
                      <td>
                        <a href="" class="btn btn-info btn-sm"><i class="menu-icon mdi mdi-information"></i></a>
                        <a href=""></i></a>
                        <form action="" method="POST" style="display: inline-block;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm"><i class="menu-icon mdi mdi-delete"></i></button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
@endsection
