<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\BelanjaHeader;
use App\Models\Program;
use App\Models\Kro;
use App\Models\Ro;
use App\Models\Komponen;
use Illuminate\Support\Facades\DB;

class RegenerateBelanjaRedesain extends Command
{
    protected $signature = 'app:regenerate-belanja-redesain';
    protected $description = 'Regenerate data belanja header dari Excel';

    public function handle()
    {
        $filePath = resource_path('excel/testing_regen.xlsx');

        if (!file_exists($filePath)) {
            $this->error("File tidak ditemukan: {$filePath}");
            return Command::FAILURE;
        }

        $sheet = IOFactory::load($filePath)->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);

        DB::beginTransaction();

        try {
            $last = [
                'program_id' => null,
                'kro_id' => null,
                'ro_id' => null,
                'komponen_id' => null,
            ];

            foreach ($rows as $row) {

                $kode = trim($row['A'] ?? '');
                $nama = trim($row['D'] ?? '');

                if ($kode === '' || $nama === '') {
                    continue;
                }

                $level = $this->detectLevel($kode);

                /**
                 * PROGRAM → lookup ke tabel programs
                 */
                if ($level === 'program') {

                    $program = Program::where('kode_kegiatan', $kode)->first();

                    if (!$program) {
                        $this->warn("Program tidak ditemukan: {$kode}");
                        continue;
                    }

                    $last['program_id'] = $program->id;
                    $last['kro_id'] = null;
                    $last['ro_id'] = null;
                    $last['komponen_id'] = null;

                    $this->info("Program OK: {$kode}");
                }

                /**
                 * KRO → lookup ke tabel kros
                 */
                elseif ($level === 'kro') {

                    // ambil kode setelah titik (7867.AEC → AEC)
                    $parts = explode('.', $kode);
                    $kodeKro = end($parts);
                
                    $kro = Kro::where('kode_kro', $kodeKro)->first();
                
                    if (!$kro) {
                        $this->warn("KRO tidak ditemukan: {$kodeKro} (from {$kode})");
                        break; // stop karena struktur sudah tidak valid
                    }
                
                    $last['kro_id'] = $kro->id;
                    $last['ro_id'] = null;
                    $last['komponen_id'] = null;
                
                    $this->info("KRO OK: {$kode} → {$kodeKro}");
                }
                

                /**
                 * RO
                 */
                elseif ($level === 'ro') {

                    // ambil kode RO (7867.AEC.002 → 002)
                    $parts = explode('.', $kode);
                    $kodeRo = end($parts);
                
                    $ro = Ro::where('kode_ro', $kodeRo)
                            ->first();

                    if (!$ro) {
                        $this->warn("RO tidak ditemukan: {$kodeRo} (from {$kode})");
                        break; // atau continue sesuai kebijakan
                    }
                
                    // simpan ro_id untuk level di bawah
                    $last['ro_id'] = $ro->id;
                    $last['komponen_id'] = null;
                
                    // optional: simpan header RO (kalau memang perlu)
                    BelanjaHeader::create([
                        'program_id' => $last['program_id'],
                        'kro_id' => $last['kro_id'],
                        'ro_id' => $ro->id,
                        'nama_uraian' => $nama,
                    ]);
                
                    $this->info("RO OK: {$kode} → {$kodeRo}");
                }
                

                /**
                 * KOMPONEN
                 */
                elseif ($level === 'komponen') {


                    // ambil kode Komponen (7867.AEC.002.001 → 001)
                    $parts = explode('.', $kode);
                    $kodeKomponen = end($parts);
                
                    $komponen = Komponen::where('kode_komponen', $kodeKomponen)
                            ->first();

                    if (!$komponen) {
                        $this->warn("Komponen tidak ditemukan: {$kodeKomponen} (from {$kode})");
                        break; // atau continue sesuai kebijakan
                    }
                
                    $model = BelanjaHeader::create([
                        'program_id' => $last['program_id'],
                        'kro_id' => $last['kro_id'],
                        'ro_id' => $last['ro_id'],
                        'komponen_id' => $komponen->id,
                        'nama_uraian' => $nama,
                    ]);
                
                    $this->info("Komponen OK: {$kode}");
                }
                

                /**
                 * SUB KOMPONEN
                 */
                elseif ($level === 'sub_komponen') {
                    BelanjaHeader::create([
                        'program_id' => $last['program_id'],
                        'kro_id' => $last['kro_id'],
                        'ro_id' => $last['ro_id'],
                        'komponen_id' => $last['komponen_id'],
                        'nama_uraian' => $nama,
                        'kode_subkomponen' => $kode,
                        'nama_subkomponen' => $nama,
                        'jumlah' => 1,
                    ]);
                }

                $this->info("Imported: {$kode} - {$nama}");
            }

            DB::commit();
            $this->info('✅ Regenerasi belanja header selesai');
            return Command::SUCCESS;

        } catch (\Throwable $e) {
            DB::rollBack();
            $this->error('❌ Error: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }

    private function detectLevel(string $kode): string
    {
        if (preg_match('/^\d{4}$/', $kode)) return 'program';
        if (preg_match('/^\d{4}\.[A-Z]{3}$/', $kode)) return 'kro';
        if (preg_match('/^\d{4}\.[A-Z]{3}\.\d{3}$/', $kode)) return 'ro';
        if (preg_match('/^\d{3}$/', $kode)) return 'komponen';
        if (preg_match('/^[A-Z]$/', $kode)) return 'sub_komponen';

        return 'unknown';
    }
}
