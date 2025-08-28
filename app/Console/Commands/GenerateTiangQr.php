<?php

namespace App\Console\Commands;

use App\Models\Tiang;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GenerateTiangQr extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tiang:generate-qr';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate QR Code untuk semua Tiang';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mulai generate QR Code untuk semua Tiang...');

        $tiangs = Tiang::select('id', 'kode')->get();

        foreach ($tiangs as $tiang) {
            $expectedSlug = \Illuminate\Support\Str::slug($tiang->kode);
            $url = 'https://aplaranja.mataramkota.go.id/detail/'.$tiang->id.'-'.$expectedSlug;

            $fileName = "qrcode/tiang-{$tiang->kode}.png";

            // generate QR dan simpan ke storage/app/public/qr/
            $qr = QrCode::format('png')->size(300)->generate($url);
            Storage::disk('public')->put($fileName, $qr);

            // update kolom qr_code di database
            $tiang->qr_code = $fileName;
            $tiang->save();

            $this->info("QR untuk Tiang ID {$tiang->id} berhasil dibuat: storage/app/public/{$fileName}");
        }

        $this->info('Semua QR Code berhasil digenerate!');
    }
}
