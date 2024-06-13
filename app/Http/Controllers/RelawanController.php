<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KejadianBencana;
use App\Models\Assessment;
use App\Models\MobilisasiSd;
use App\Models\PersonilNarahubung;
use App\Models\GiatPMI;
use App\Models\Report;
use App\Models\PetugasPosko;
use App\Models\JenisKejadian;

class RelawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // VIEW INDEX RELAWAN
    public function index()
    {
        //
        return view('relawan.dashboard');
    }
    public function index_laporankejadian()
    {
        $reports = Report::all(); 
        return view('relawan.laporankejadian.index', compact('reports'));
    }
    public function index_lapsit()
    {
        return view('relawan.lapsit.index');
    }
    public function index_assessment()
    {
        $assessments = KejadianBencana::all();
        return view('relawan.assessment.index', compact('assessments'));
    }
    /**
     * Show the form for creating a new resource.
     */
    // CREATE, UPDATE, DELETE LAPORAN KEJADIAN
    public function create_laporankejadian()
    {
        $jeniskejadian = JenisKejadian::all();
        return view('relawan.laporankejadian.create', compact('jeniskejadian'));
    }
    public function edit_laporankejadian()
    {
        //
        return view('relawan.laporankejadian.edit');
    }

    public function delete_laporankejadian(string $id)
    {
        $report = Report::findOrFail($id);

        if ($report->status === 'Belum Diverifikasi') {
            $report->delete();
            return redirect('relawan/laporan-kejadian')->with('success', 'Data laporan kejadian berhasil dihapus');
        } else {
            return redirect('relawan/laporan-kejadian')->with('error', 'Hanya laporan kejadian dengan status "Belum Diverifikasi" yang dapat dihapus');
        }
    }
    public function store_laporankejadian(Request $request)
    {
        $validatedData = $request->validate([
            'id_jeniskejadian' => 'required',
            'tanggal_kejadian' => 'required|date',
            'keterangan' => 'required|string',
            'lokasi_longitude' => 'nullable|numeric',
            'lokasi_latitude' => 'nullable|numeric',
            'status' => 'required|in:On_Proses,Selesai,Belum_Diverifikasi',
        ]);

        $laporanKejadian = new Report();
        $laporanKejadian->id_user = 2; 
        $laporanKejadian->id_jeniskejadian = $request->id_jeniskejadian;
        $laporanKejadian->tanggal_kejadian = $request->tanggal_kejadian;
        $laporanKejadian->keterangan = $request->keterangan;
        $laporanKejadian->lokasi_longitude = $request->lokasi_longitude;
        $laporanKejadian->lokasi_latitude = $request->lokasi_latitude;
        $laporanKejadian->status = $request->status;
        $laporanKejadian->save();

        return redirect()->route('relawan-laporankejadian')->with('success', 'Laporan kejadian berhasil ditambahkan.');
    }

    // CREATE, UPDATE, DELETE LAPORAN ASSESSMENT
    public function create_assessment()
    {
        $jeniskejadian = JenisKejadian::all();
        $assess = Assessment::all();
        $mobilisasisd = MobilisasiSd::all();
        $giatpmi = GiatPMI::all();
        $narahubung = PersonilNarahubung::all();
        $petugasposko = PetugasPosko::all();
        return view('relawan.assessment.create', compact('jeniskejadian', 'assess', 'mobilisasisd', 'giatpmi', 'narahubung', 'petugasposko')); //
    }
    public function edit_assessment($id)
    {
        $kejadianBencana = KejadianBencana::findOrFail($id);

        // Dapatkan data terkait yang dibutuhkan untuk dikirim ke view
        $jenisKejadian = $kejadianBencana->jenisKejadian;
        $assessment = $kejadianBencana->assessment;
        $mobilisasiSd = $kejadianBencana->mobilisasiSd;
        $giatPmi = $kejadianBencana->giatPmi;
        $dokumentasi = $kejadianBencana->dokumentasi;
        $narahubung = $kejadianBencana->narahubung;
        $petugasPosko = $kejadianBencana->petugasPosko;

        return view('relawan.assessment.edit', compact('kejadianBencana', 'jenisKejadian', 'assessment', 'mobilisasiSd', 'giatPmi', 'dokumentasi', 'narahubung', 'petugasPosko'));
    }
    public function delete_assessment(string $id)
    {
        KejadianBencana::findOrFail($id)->delete();

        return redirect('relawan/assessment')->with('success', 'Data berhasil dihapus');
    }
    public function store_assessment(Request $request)
    {
        $validatedData = $request->validate([
            'id_jeniskejadian' => 'required|exists:jenis_kejadian,id',
            'tanggal_kejadian' => 'required|date',
            'keterangan' => 'required|string',
            // Tambahkan validasi sesuai kebutuhan
        ]);

        // Simpan data ke database menggunakan model KejadianBencana
        $kejadianBencana = new KejadianBencana();
        $kejadianBencana->id_jeniskejadian = $request->id_jeniskejadian;
        $kejadianBencana->tanggal_kejadian = $request->tanggal_kejadian;
        $kejadianBencana->keterangan = $request->keterangan;
        // Tambahkan field lain sesuai kebutuhan

        $kejadianBencana->save();

        return redirect()->route('index-assessment')->with('success', 'Assessment berhasil ditambahkan.');
    }

    // CREATE, UPDATE, DELETE LAPORAN SITUASI
    public function create_lapsit()
    {
        //
        return view('relawan.lapsit.create');
    }

    public function edit_lapsit($id)
    {
        $kejadianBencana = KejadianBencana::findOrFail($id);
        $jenisKejadians = JenisKejadian::all();

        return view('relawan.lapsit.edit', compact('kejadianBencana', 'jenisKejadians'));
    }

    public function update_lapsit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_jeniskejadian' => 'required|exists:jenis_kejadian,id',
            'tanggal_kejadian' => 'required|date',
            'lokasi' => 'required',
            'update' => 'nullable',
            'dukungan_internasional' => 'nullable',
            'keterangan' => 'nullable',
            'akses_ke_lokasi' => 'nullable',
            'kebutuhan' => 'nullable',
            'giat_pemerintah' => 'nullable',
            'hambatan' => 'nullable',
            'id_assessment' => 'nullable|exists:assessment,id',
            'id_mobilisasi_sd' => 'nullable|exists:mobilisasi_sd,id',
            'id_giat_pmi' => 'nullable|exists:giat_pmi,id',
            'id_dokumentasi' => 'nullable|exists:lampiran_dokumentasi,id',
            'id_narahubung' => 'nullable|exists:personil_narahubung,id',
            'id_petugas_posko' => 'nullable|exists:petugas_posko,id',
            'status' => 'nullable',
        ]);

        $kejadianBencana = KejadianBencana::findOrFail($id);
        $jenisKejadians = JenisKejadian::all();
        $kejadianBencana->update($validatedData);

        return redirect()->route('relawan.lapsit.index')->with('success', 'Laporan situasi berhasil diperbarui.');
    }

    public function detail_lapsit()
    {
        //
        return view('relawan.lapsit.detail');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
