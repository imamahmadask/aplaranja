<?php

use App\Models\Panel;
use App\Models\Tagihan;
use App\Imports\TagihanImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('tagihan can be imported from csv with comma delimiter', function () {
    $panel = Panel::create([
        'kode' => 'TEST-P001',
        'kwh' => '1',
        'idpel' => '441500921782',
        'jaringan' => 'Udara',
        'saklar' => 'Photocell',
        'lat' => '-8.0',
        'long' => '116.0',
        'jalan_id' => 1
    ]);

    $csvContent = "NO,IDPEL,NAMA,ALAMAT,TARIP,DAYA,BLTH,PEMKWH,RPTAG,MATERAI,ADMIN TAGIHAN,TS + ADMIN,TOTAL,REGISTER\n";
    $csvContent .= "1,441500921782,PJU TEST,TEST ADDRESS,P3,2200,202607,100,150000,0,3500,-,153500,-\n";
    
    $filePath = tempnam(sys_get_temp_dir(), 'tagihan_test');
    file_put_contents($filePath, $csvContent);

    Excel::import(new TagihanImport(), $filePath);

    $this->assertDatabaseHas('tagihans', [
        'idpel' => '441500921782',
        'nama' => 'PJU TEST',
        'tarif' => 'P3',
        'daya' => 2200,
        'blth' => '202607',
        'bulan' => 7,
        'tahun' => 2026,
        'pemkwh' => 100,
        'rptag' => 150000.00,
        'materai' => 0.00,
        'admin' => 3500.00,
        'total' => 153500.00,
        'panel_id' => $panel->id
    ]);

    unlink($filePath);
});

test('tagihan can be imported from csv with semicolon delimiter', function () {
    $panel = Panel::create([
        'kode' => 'TEST-P002',
        'kwh' => '1',
        'idpel' => '441503201635',
        'jaringan' => 'Udara',
        'saklar' => 'Photocell',
        'lat' => '-8.0',
        'long' => '116.0',
        'jalan_id' => 1
    ]);

    $csvContent = "NO;IDPEL;NAMA;ALAMAT;TARIP;DAYA;BLTH;PEMKWH;RPTAG;MATERAI;ADMIN TAGIHAN;TS + ADMIN;TOTAL;REGISTER\n";
    $csvContent .= "1;441503201635;PJU TEST 2;TEST ADDRESS 2;P3;4400;202607;200;300000;0;3500;-;303500;-\n";
    
    $filePath = tempnam(sys_get_temp_dir(), 'tagihan_test_semicolon');
    file_put_contents($filePath, $csvContent);

    Excel::import(new TagihanImport(';'), $filePath);

    $this->assertDatabaseHas('tagihans', [
        'idpel' => '441503201635',
        'nama' => 'PJU TEST 2',
        'tarif' => 'P3',
        'daya' => 4400,
        'blth' => '202607',
        'bulan' => 7,
        'tahun' => 2026,
        'pemkwh' => 200,
        'rptag' => 300000.00,
        'materai' => 0.00,
        'admin' => 3500.00,
        'total' => 303500.00,
        'panel_id' => $panel->id
    ]);

    unlink($filePath);
});

test('tagihan can be deleted bulk by month and year', function () {
    Tagihan::create([
        'idpel' => '441500921782',
        'nama' => 'PJU 1',
        'blth' => '202607',
        'bulan' => 7,
        'tahun' => 2026,
        'total' => 100000
    ]);

    Tagihan::create([
        'idpel' => '441503201635',
        'nama' => 'PJU 2',
        'blth' => '202607',
        'bulan' => 7,
        'tahun' => 2026,
        'total' => 150000
    ]);

    Tagihan::create([
        'idpel' => '441503201635',
        'nama' => 'PJU 3',
        'blth' => '202608',
        'bulan' => 8,
        'tahun' => 2026,
        'total' => 200000
    ]);

    expect(Tagihan::count())->toBe(3);

    Tagihan::where('bulan', 7)->where('tahun', 2026)->delete();

    expect(Tagihan::count())->toBe(1);
    $this->assertDatabaseHas('tagihans', [
        'blth' => '202608'
    ]);
    $this->assertDatabaseMissing('tagihans', [
        'blth' => '202607'
    ]);
});
