@extends('layouts-admin.default')

@section('content')

<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Laporan Kejadian</h4>
            <p class="card-description">
              Daftar laporan kejadian
            </p>
            <div class="table-responsive pt-3">
              <table class="table table-bordered">
                <thead>
                  <th>No</th>
                  <th>Kategori Kejadian</th>
                  <th>Lokasi Longitude</th>
                  <th>Lokasi Latitude</th>
                  <th>Tanggal Kejadian</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                @php
                  $reports = $reports->where('status', 'On_Proses');
                @endphp

                @forelse($reports as $report)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                      @if ($report->jeniskejadian)
                        {{ $report->jeniskejadian->nama_kejadian }}
                      @else
                        Nama tidak ditemukan
                      @endif
                    </td>
                    <td>{{ $report->lokasi_longitude }}</td>
                    <td>{{ $report->lokasi_latitude }}</td>
                    <td>{{ \Carbon\Carbon::parse($report->tanggal_kejadian)->format('d-m-Y') }}</td>
                    <td>
                      @if($report->status == 'On_Proses')
                        <button class="btn btn-warning btn-sm text-white" disabled>On Proses</button>
                      @elseif($report->status == 'Selesai')
                        <button class="btn btn-success btn-sm text-white" disabled>Selesai</button>
                      @elseif($report->status == 'Dalam_Penanganan')
                        <button class="btn btn-info btn-sm text-white" disabled>Dalam Penanganan</button>
                      @endif
                    </td>
                    <td>
                      <button class="btn btn-primary btn-sm btn-detail" 
                                data-bs-toggle="modal" 
                                data-bs-target="#detailModal"
                                data-document-id="{{ $report->id }}">
                          <i class="menu-icon mdi mdi-information"></i> 
                        </button>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="7">Belum ada laporan kejadian.</td>
                  </tr>
                @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->

  <!-- Modal -->
  <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="detailModalLabel">Laporan Kejadian</h3>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-sample">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label" for="incidentType">Kategori Kejadian</label>
                  <div class="col-sm-9">
                  <input type="text" class="form-control" id="id_kategorikejadian" readonly
                  value="{{ $report->jeniskejadian ? $report->jeniskejadian->nama_kejadian : 'Nama tidak ditemukan' }}">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Lokasi Longitude</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="incidentLongitude" readonly
                    value="{{ $report->lokasi_longitude }}">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Lokasi Latitude</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="incidentLatitude" readonly
                    value="{{ $report->lokasi_latitude }}">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Tanggal Kejadian</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="incidentDate" readonly
                    value="{{ \Carbon\Carbon::parse($report->tanggal_kejadian)->format('d-m-Y') }}">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
              <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Keterangan</label>
                  <div class="col-sm-9">
                      <textarea class="form-control" id="incidentDetail" readonly rows="5" cols="50">{{ $report->keterangan }}</textarea>
                  </div>
              </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary btn-verify">Verify</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.querySelectorAll('.btn-detail').forEach(button => {
      button.addEventListener('click', function (event) {
        event.preventDefault();
        const documentId = this.getAttribute('data-document-id');
        fillModalWithData(documentId);
      });
    });

    document.querySelectorAll('.btn-verify').forEach(button => {
      button.addEventListener('click', function (event) {
        event.preventDefault();
        const documentId = this.getAttribute('data-document-id');
        console.log('Verifying document with ID:', documentId);
      });
    });

   
  </script>

@endsection
