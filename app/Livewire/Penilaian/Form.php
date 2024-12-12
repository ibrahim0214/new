<?php

namespace App\Livewire\Penilaian;

use App\Models\Dosen;
use App\Models\Periode;
use App\Models\Station;
use Livewire\Component;
use App\Models\Mahasiswa;
use App\Models\Penilaian;
use App\Models\Kompetensi;
use App\Models\Performance;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Form extends Component
{
    public $id;

    public $no_station;
    public $nama_station;
    public $judul;

    #[Validate('numeric', message : 'Tahun harus berupa angka!')]
    public $tahun_penilaian;

    #[Validate('required', message : 'Kolom periode harus diisi!')]
    public $periode;

    #[Validate('required', message : 'Kolom ini harus diisi!')]
    public $tgl_penilaian;

    #[Validate('required', message : 'Kolom ini harus diisi!')]
    public $jenis_penilaian = 'reguler';

    public $perlu_perbaikan = false;

    #[Validate('nullable', message : 'Kolom ini harus diisi!')]
    #[Validate('numeric', message : 'Kolom ini harus berupa angka!')]
    public $perbaikan_ke;

    #[Validate('required', message : 'Kolom ini harus diisi!')]
    public $nik_mhs;

    #[Validate('required', as: 'nama_mhs', message : 'Kolom ini harus diisi!')]
    public $query; //nama_mhs

    #[Validate('required', message : 'Kolom ini harus diisi!')]
    public $nama_dosen;

    #[Validate('nullable', message : 'Kolom ini harus diisi!')]
    public $nik_dosen;

    #[Validate('nullable', message : 'Kolom ini harus diisi!')]
    public $gelar_belakang;

    #[Validate('nullable', message : 'Kolom ini harus diisi!')]
    public $skor_s_komunikasi;

    #[Validate('nullable', message : 'Kolom ini harus diisi!')]
    public $skor_s_pengkajian;

    #[Validate('nullable', message : 'Kolom ini harus diisi!')]
    public $skor_s_diagnosa;

    #[Validate('nullable', message : 'Kolom ini harus diisi!')]
    public $skor_s_implementasi;

    #[Validate('nullable', message : 'Kolom ini harus diisi!')]
    public $skor_s_evaluasi;

    #[Validate('nullable', message : 'Kolom ini harus diisi!')]
    public $skor_s_profesional;

    public $bobot_komunikasi;
    public $bobot_pengkajian;
    public $bobot_diagnosa;
    public $bobot_implementasi;
    public $bobot_evaluasi;
    public $bobot_profesional;

    public $highlightIndex;
    public $search = [];
    public $mahasiswa;

    public $hasil_penilaian;
    public $skorPenilaian = [];
    public $dataPenilaian = [];

    #[Validate('required', message : 'Kolom ini harus diisi!')]
    public $nilai_akhir;

    #[Validate('required', message : 'Kolom ini harus diisi!')]
    public $performance_id;

    #[Validate('nullable')]
    public $catatan;

    public function mount($id)
    {
        try {
            $dec_id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return abort(404);
        }
        $this->id = $dec_id;

        //set tahun
        $date = Carbon::now();
        $tahun = $date->format('Y');
        $this->tahun_penilaian = $tahun;

        //tgl penilaian
        $this->tgl_penilaian = $date->format('Y-m-d');

        //menghitung nilai akhir
        $this->nilai_akhir = $this->hitungNilai();

        //data penguji
        $data_penguji = Auth::user()->userDetails;
        $this->nik_dosen = $data_penguji->nik_dosen ?? Auth::user()->username;
        $this->nama_dosen = $data_penguji->nama_dosen ?? Auth::user()->name;
        $this->gelar_belakang = $data_penguji->gelar_belakang ?? '';
    }

    public function render()
    {
        //membuat data tahun untuk tahun penilaian
        $tahun = Carbon::now()->format('Y');
        $data_tahun = [$tahun - 1, $tahun, $tahun + 1];

        //data periode
        $data_periode = Periode::all();

        //data mahasiswa
        $data_mahasiswa = Mahasiswa::all();

        //data performance
        $data_performance = Performance::all();

        //data station
        $data_station = Station::where('no_station',$this->id)->first();
        if (!$data_station) {
            return abort(404);
        }
        $this->no_station = $data_station->no_station;
        $this->nama_station = $data_station->nama_station;
        $this->judul = $data_station->judul;

        //data bobot tiap kriteria
        foreach($data_station->kriteria as $kriteria) {
            switch ($kriteria->kompetensi_id) {
                case 'k1':
                    $this->bobot_komunikasi = $kriteria->bobot;
                    break;
                case 'k2':
                    $this->bobot_pengkajian = $kriteria->bobot;
                    break;
                case 'k3':
                    $this->bobot_diagnosa = $kriteria->bobot;
                    break;
                case 'k4':
                    $this->bobot_implementasi = $kriteria->bobot;
                    break;
                case 'k5':
                    $this->bobot_evaluasi = $kriteria->bobot;
                    break;
                case 'k6':
                    $this->bobot_profesional = $kriteria->bobot;
                    break;
            }
        }

        return view('livewire.penilaian.form', [
                        'data_mahasiswa' => $data_mahasiswa,
                        'data_tahun' => $data_tahun,
                        'data_periode' => $data_periode,
                        'data_station' => $data_station,
                        'data_performance' => $data_performance
                    ]);
    }

    public function updatedQuery()
    {
        $this->mahasiswa = Mahasiswa::where('nik_mhs', 'like', '%' . $this->query . '%')
            ->orWhere('nama_mhs', 'like', '%' . $this->query . '%')
            ->get()
            ->take(10);
        $this->search = $this->mahasiswa;
    }

    public function updatedJenisPenilaian()
    {
        if($this->jenis_penilaian == 'perbaikan') {
            $this->perlu_perbaikan = true;
        }if($this->jenis_penilaian == 'reguler') {
            $this->perlu_perbaikan = false;
        }
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->mahasiswa) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->mahasiswa) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function selectedMahasiswa($id)
    {
        $data = Mahasiswa::find($id);
        $this->query = $data->nama_mhs;
        $this->nik_mhs = $data->nik_mhs;
        $this->search = [];

        $this->cekPenilaian($this->nik_mhs);
    }

    public function cekPenilaian($nik)
    {
        $penilaian = Penilaian::where('nik_mhs', $nik)
                                ->where('tahun_penilaian', $this->tahun_penilaian)
                                ->where('periode', $this->periode)
                                ->where('no_station', $this->no_station)
                                ->first();
        if ($penilaian) {
            $this->hasil_penilaian = $penilaian->nilai_akhir;
            $this->dispatch('open-modal', 'modalWarning');
        }
    }

    public function simpan()
    {
        $validated = $this->validate();
        foreach ($validated as $key => $value) {
            if ($value != null && in_array($key,['skor_s_komunikasi', 'skor_s_pengkajian', 'skor_s_diagnosa', 'skor_s_implementasi', 'skor_s_evaluasi', 'skor_s_profesional'])) {
                $data_kompetensi = Kompetensi::where('slug_kompetensi', $key)->first();
                $label = $data_kompetensi->label;
                $this->skorPenilaian[$label] = $value;
            }
        }
        $this->skorPenilaian['Nilai Akhir'] = $validated['nilai_akhir'];
        $dataPerformance = Performance::where('performance_id', $validated['performance_id'])->first();
        $validated['performance_name'] = $dataPerformance->getAttributes()['performance_name'];
        $this->skorPenilaian['Performance'] = $dataPerformance->getAttributes()['performance_name'];

        $this->dataPenilaian = $validated;
        $this->dataPenilaian['nama_mhs'] = $this->query;
        $this->dataPenilaian['no_station'] = $this->no_station;
        $this->dataPenilaian['nama_station'] = $this->nama_station;
        $this->dataPenilaian['judul'] = $this->judul;
        $this->dispatch('open-modal', 'modalKonfirmasi');
    }

    public function simpanNilai()
    {
        Penilaian::create(Arr::except($this->dataPenilaian, ['query']));

        $this->dispatch('success', ['message' => 'Penilaian mahasiswa berhasil diinput..']);
        return redirect()->route('nilai');
    }

    public function updated($field)
    {
        if (in_array($field, ['skor_s_komunikasi', 'bobot_komunikasi', 'skor_s_pengkajian', 'bobot_pengkajian', 'skor_s_diagnosa', 'bobot_diagnosa', 'skor_s_implementasi', 'bobot_implementasi', 'skor_s_evaluasi', 'bobot_evaluasi', 'skor_s_profesional', 'bobot_profesional'])) {
            $this->nilai_akhir = $this->hitungNilai();
        }
    }

    private function hitungNilai()
    {
        return (
            ($this->skor_s_komunikasi * $this->bobot_komunikasi) +
            ($this->skor_s_pengkajian * $this->bobot_pengkajian) +
            ($this->skor_s_diagnosa * $this->bobot_diagnosa) +
            ($this->skor_s_implementasi * $this->bobot_implementasi) +
            ($this->skor_s_evaluasi * $this->bobot_evaluasi) +
            ($this->skor_s_profesional * $this->bobot_profesional)
        );
    }

    public function konfirmasiPerbaikan()
    {
        $this->dispatch('close-modal', 'modalWarning');
        $this->jenis_penilaian = 'perbaikan';
        $this->perlu_perbaikan = true;
    }

    public function resetSearch()
    {
        $this->query = '';
        $this->nik_mhs = '';
    }

    public function kembali()
    {
        return redirect()->route('osce');
    }
}
