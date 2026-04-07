<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bidang;

class BidangSeeder extends Seeder
{
    public function run(): void
    {
        Bidang::query()->delete();

        Bidang::create(['nama_bidang' => 'TIK']);
        Bidang::create(['nama_bidang' => 'IKP']);
        Bidang::create(['nama_bidang' => 'Sekretariat']);
    }
}