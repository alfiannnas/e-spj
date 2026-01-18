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
            $current = [
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
                    $program = Program::where('kode_kegiatan', $kode)->firstOrFail();
                    $current['program_id'] = $program->id;
                }
                

                /**
                 * KRO → lookup ke tabel kros
                 */
                elseif ($level === 'kro') {
                    $kodeKro = explode('.', $kode)[1];
                    $kro = Kro::where('kode_kro', $kodeKro)->firstOrFail();
                    $current['kro_id'] = $kro->id;
                }
                
                

                /**
                 * RO
                 */
                elseif ($level === 'ro') {
                    $kodeRo = explode('.', $kode)[2];
                    $ro = Ro::where('kode_ro', $kodeRo)->firstOrFail();
                    $current['ro_id'] = $ro->id;
                }
                
                

                /**
                 * KOMPONEN
                 */
                elseif ($level === 'komponen') {
                    $komponen = Komponen::where('kode_komponen', $kode)->firstOrFail();
                    $current['komponen_id'] = $komponen->id;
                }
                
                

                /**
                 * SUB KOMPONEN
                 */
                elseif ($level === 'sub_komponen') {
                    BelanjaHeader::create([
                        'program_id' => $current['program_id'],
                        'kro_id' => $current['kro_id'],
                        'ro_id' => $current['ro_id'],
                        'nama_uraian' => $nama,
                        'komponen_id' => $current['komponen_id'],
                        'kode_subkomponen' => $kode,
                        'nama_subkomponen' => $nama,
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
