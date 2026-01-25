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
use App\Models\BelanjaItem;
use App\Models\Akun;


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
            $currentHeaderId = null;
            $currentAkunId = null;

            foreach ($rows as $row) {

                $kode = trim($row['A'] ?? '');
                $nama_uraian = trim($row['D'] ?? '');

                // Cek apakah ini item belanja (kolom A kosong, kolom D dimulai dengan "-")
                $isItem = $kode === '' && str_starts_with($nama_uraian, '-');

                if ($kode === '' && !$isItem) {
                    continue;
                }

                if ($nama_uraian === '') {
                    continue;
                }

                // Jika item, hapus prefix "-" dari nama
                if ($isItem) {
                    $nama_uraian = trim(ltrim($nama_uraian, '-'));
                }

                $level = $isItem ? 'item' : $this->detectLevel($kode);

                /**
                 * PROGRAM → lookup ke tabel programs
                 */
                if ($level === 'program') {
                    $program = Program::where('kode_kegiatan', $kode)->firstOrFail();
                    $current['program_id'] = $program->id;
                    $current['nama_uraian'] = $nama_uraian;
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

                    $header = BelanjaHeader::create([
                        'program_id' => $current['program_id'],
                        'kro_id' => $current['kro_id'],
                        'ro_id' => $current['ro_id'],
                        'nama_uraian' => $current['nama_uraian'],
                        'komponen_id' => $current['komponen_id'],
                        'kode_subkomponen' => $kode,
                        'nama_subkomponen' => $nama_uraian,
                    ]);
                
                    $currentHeaderId = $header->id;

                }
                /**
                 * AKUN → track akun_id untuk item di bawahnya
                 */
                elseif ($level === 'akun') {
                    $akun = Akun::where('kode_akun', $kode)->first();

                    if (!$akun) {
                        $akun = Akun::create([
                            'kode_akun' => $kode,
                            'nama_akun' => $nama_uraian
                        ]);
                    }
                    $currentAkunId = $akun->id;
                    $this->info("Akun: {$kode} - {$nama_uraian}");
                }

                /**
                 * ITEM BELANJA → kolom A kosong, kolom B/C = "-"
                 */
                elseif ($level === 'item' && $currentHeaderId && $currentAkunId) {
                    $namaItem = $row['E'] ?? '';
                    // Kolom G berisi "1.0 THN" → explode untuk jumlah dan satuan
                    $volumeRaw = trim($row['G'] ?? '');
                    $volumeParts = preg_split('/\s+/', $volumeRaw, 2);
                    $jumlah = (float) ($volumeParts[0] ?? 1);
                    $satuan = $volumeParts[1] ?? '';
                    
                    // Kolom H berisi harga
                    $harga = (float) ($row['H'] ?? 0);

                    BelanjaItem::create([
                        'belanja_header_id' => $currentHeaderId,
                        'akun_id' => $currentAkunId,
                        'nama_item' => $namaItem,
                        'jumlah' => $jumlah,
                        'satuan' => $satuan,
                        'harga' => $harga,
                    ]);

                    $this->info("  Item: {$nama_uraian} | {$jumlah} {$satuan} @ Rp " . number_format($harga, 0, ',', '.'));
                }

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
        if (preg_match('/^\d{6}$/', $kode)) return 'akun';
        if ($kode === '-') return 'item';

        return 'unknown';
    }
}
