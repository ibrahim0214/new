<div class="py-16">
    <div class="hero bg-base-200 min-h-screen">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <img
                src="{{ asset('asset/images/logo/logo1.png') }}"
                class="max-w-sm rounded-lg" />
            <div>
                <h1 class="text-5xl font-bold">PENILAIAN OSCE BERSTANDAR NASIONAL</h1>
                <p class="py-6">
                    Pelatihan Penguji dan Pelatih Pasien Standar OSCE (Objective Structured Clinical Examination), Metode evaluasi yang digunakan untuk menguji
                    kompetensi klinik mahasiswa atau profesional medis secara objektif.
                    {{-- <ol class="list-decimal list-inside">
                        <li>test</li>
                    </ol>
                    <div class="badge badge-warning">Borderline</div>
                    <div class="badge badge-accent">Borderline</div>
                    <div class="badge badge-success">Borderline</div>
                    <div class="badge badge-error">Borderline</div>
                    <div class="badge badge-info">Borderline</div>
                    <div class="badge badge-primary">Borderline</div>
                    <div class="badge badge-secondary">Borderline</div>
                    <div class="badge badge-secondary">Borderline</div> --}}
                </p>
                <div>
                    <x-app-info-button wire:click="getStarted">Get Started</x-app-info-button>
                </div>
            </div>
        </div>
    </div>
</div>
