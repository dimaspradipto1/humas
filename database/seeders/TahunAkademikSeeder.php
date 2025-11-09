<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TahunAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Define the academic years
        $tahun = [
            '2019-2020 Gasal',
            '2019-2020 Genap',
            '2020-2021 Gasal',
            '2020-2021 Genap',
            '2021-2022 Gasal',
            '2021-2022 Genap',
            '2022-2023 Gasal',
            '2022-2023 Genap',
            '2023-2024 Gasal',
            '2023-2024 Genap',
            '2024-2025 Gasal',
            '2024-2025 Genap',
            '2025-2026 Gasal',
            '2025-2026 Genap'
        ];

        // Insert each academic year into the database
        foreach ($tahun as $tahun_akademik) {
            DB::table('tahun_akademiks')->insert([
                'tahun_akademik' => $tahun_akademik
            ]);
        }
    }
}
