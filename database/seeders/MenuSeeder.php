<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Staff;
use App\Models\Level;
use App\Models\Kelas;
use App\Models\Unit;
use App\Models\Penyakit;
use App\Models\Pengaturan;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::insert([
            // Menu Level 
            [
                'nama_menu' => 'Level',
                'aksi_menu' => 'Lihat',
            ],
            [
                'nama_menu' => 'Level',
                'aksi_menu' => 'Tambah',
            ],
            [
                'nama_menu' => 'Level',
                'aksi_menu' => 'Ubah',
            ],
            [
                'nama_menu' => 'Level',
                'aksi_menu' => 'Hapus',
            ],
            // Menu Master Staff 
            [
                'nama_menu' => 'Staff',
                'aksi_menu' => 'Lihat',
            ],
            [
                'nama_menu' => 'Staff',
                'aksi_menu' => 'Tambah',
            ],
            [
                'nama_menu' => 'Staff',
                'aksi_menu' => 'Ubah',
            ],
            [
                'nama_menu' => 'Staff',
                'aksi_menu' => 'Hapus',
            ],
            // Menu Master Siswa 
            [
                'nama_menu' => 'Siswa',
                'aksi_menu' => 'Lihat',
            ],
            [
                'nama_menu' => 'Siswa',
                'aksi_menu' => 'Tambah',
            ],
            [
                'nama_menu' => 'Siswa',
                'aksi_menu' => 'Ubah',
            ],
            [
                'nama_menu' => 'Siswa',
                'aksi_menu' => 'Hapus',
            ],
            // Menu Master Kelas 
            [
                'nama_menu' => 'Kelas',
                'aksi_menu' => 'Lihat',
            ],
            [
                'nama_menu' => 'Kelas',
                'aksi_menu' => 'Tambah',
            ],
            [
                'nama_menu' => 'Kelas',
                'aksi_menu' => 'Ubah',
            ],
            [
                'nama_menu' => 'Kelas',
                'aksi_menu' => 'Hapus',
            ],
            // Menu Master Unit 
            [
                'nama_menu' => 'Unit',
                'aksi_menu' => 'Lihat',
            ],
            [
                'nama_menu' => 'Unit',
                'aksi_menu' => 'Tambah',
            ],
            [
                'nama_menu' => 'Unit',
                'aksi_menu' => 'Ubah',
            ],
            [
                'nama_menu' => 'Unit',
                'aksi_menu' => 'Hapus',
            ],
            // Menu Master Penyakit 
            [
                'nama_menu' => 'Penyakit',
                'aksi_menu' => 'Lihat',
            ],
            [
                'nama_menu' => 'Penyakit',
                'aksi_menu' => 'Tambah',
            ],
            [
                'nama_menu' => 'Penyakit',
                'aksi_menu' => 'Ubah',
            ],
            [
                'nama_menu' => 'Penyakit',
                'aksi_menu' => 'Hapus',
            ],
            // Menu Master Skrining 
            [
                'nama_menu' => 'Skrining',
                'aksi_menu' => 'Lihat',
            ],
            [
                'nama_menu' => 'Skrining',
                'aksi_menu' => 'Tambah',
            ],
            [
                'nama_menu' => 'Skrining',
                'aksi_menu' => 'Ubah',
            ],
            [
                'nama_menu' => 'Skrining',
                'aksi_menu' => 'Hapus',
            ],
            // Menu Pengaturan 
            [
                'nama_menu' => 'Pengaturan',
                'aksi_menu' => 'Lihat',
            ],
            [
                'nama_menu' => 'Pengaturan',
                'aksi_menu' => 'Ubah',
            ],
            //Laporan
            [
                'nama_menu' => 'Laporan',
                'aksi_menu' => 'Lihat',
            ],
           
        ]);

        $level = Level::create([
            'nama_level' => 'Admin'
        ]);

        for ($i=1; $i <= Menu::all()->count() ; $i++) { 
            $level->Menu()->attach($i);
        }

        $staff = Staff::create([
            'level_id' => $level->id,
            'nama' => 'Admin',
            'no_hp' => '6283153596240',
            'username' => 'admin',
            'password' => Hash::make('admin1234'),
        ]);

        Unit::insert([
            [
                'nama_unit' => 'SD',
            ],
            [
                'nama_unit' => 'SMP',
            ],
            [
                'nama_unit' => 'SMA',
            ]
        ]);

        $kelas = Kelas::create([
            'nama_kelas'=>"A",
            'unit_id'=>1,
        ]);

        Kelas::create([
            'nama_kelas'=>"B",
            'unit_id'=>1,
        ]);

        Kelas::create([
            'nama_kelas'=>"A",
            'unit_id'=>2,
        ]);

        Kelas::create([
            'nama_kelas'=>"B",
            'unit_id'=>2,
        ]);

        Kelas::create([
            'nama_kelas'=>"A",
            'unit_id'=>3,
        ]);

        Kelas::create([
            'nama_kelas'=>"B",
            'unit_id'=>3,
        ]);

        $level = Level::create([
            'nama_level' => 'Siswa'
        ]);

        Siswa::create([
            'level_id' => $level->id,
            'kelas_id' => $kelas->id,
            'nama' => 'siswa',
            'no_hp' => '6283153596240',
            'tgl_lahir' => '2022-10-22',
            'jenis_kelamin' => 'pria',
            'nomor_induk' => '435',
            'password' => Hash::make('siswa'),
        ]);

        $level = Level::create([
            'nama_level' => 'Guru'
        ]);


        // Create Guru
        Staff::insert([
            [
                'level_id' => $level->id,
                'kelas_id' => 1,
                'nama' => 'Guru SD A',
                'no_hp' => '6283153596240',
                'username' => 'guru1',
                'password' => Hash::make('guru'),
            ],
            [
                'level_id' => $level->id,
                'kelas_id' => 2,
                'nama' => 'Guru SD B',
                'no_hp' => '6283153596240',
                'username' => 'guru2',
                'password' => Hash::make('guru'),
            ],
            [
                'level_id' => $level->id,
                'kelas_id' => 3,
                'nama' => 'Guru SMP A',
                'no_hp' => '6283353596240',
                'username' => 'guru3',
                'password' => Hash::make('guru'),
            ],
            [
                'level_id' => $level->id,
                'kelas_id' => 4,
                'nama' => 'Guru SMP B',
                'no_hp' => '6483153596440',
                'username' => 'guru4',
                'password' => Hash::make('guru'),
            ],
            [
                'level_id' => $level->id,
                'kelas_id' => 5,
                'nama' => 'Guru SMA A',
                'no_hp' => '6283553596240',
                'username' => 'guru5',
                'password' => Hash::make('guru'),
            ],
            [
                'level_id' => $level->id,
                'kelas_id' => 6,
                'nama' => 'Guru SMA B',
                'no_hp' => '6683153596640',
                'username' => 'guru6',
                'password' => Hash::make('guru'),
            ],
        ]);

        $level = Level::create([
            'nama_level' => 'Satgas'
        ]);

        // for ($i=25; $i <= 28 ; $i++) { 
        //     $level->Menu()->attach($i);
        // }

        // Create Satgas
        Staff::insert([
            [
                'level_id' => $level->id,
                'unit_id' => 1,
                'nama' => 'Satgas SD',
                'no_hp' => '6283153596240',
                'username' => 'satgas1',
                'password' => Hash::make('satgas'),
            ],
            [
                'level_id' => $level->id,
                'unit_id' => 2,
                'nama' => 'Satgas SMP',
                'no_hp' => '6283153596240',
                'username' => 'satgas2',
                'password' => Hash::make('satgas'),
            ],
            [
                'level_id' => $level->id,
                'unit_id' => 3,
                'nama' => 'Satgas SMA',
                'no_hp' => '6283353596240',
                'username' => 'satgas3',
                'password' => Hash::make('satgas'),
            ],
        ]);

        $level = Level::create([
            'nama_level' => 'Litbang'
        ]);

        // for ($i=25; $i <= 28 ; $i++) { 
        //     $level->Menu()->attach($i);
        // }

        Pengaturan::insert([
            [
                'nama_pengaturan' => 'Berapa Point Yang Menentukan Siswa Sakit (tidak perlu ke sekolah) ?',
                'value' => 100,
            ],
            [
                'nama_pengaturan' => 'Pengisian Data Skrining Setiap Hari Apa ? (Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday,Everyday)',
                'value' => 'Friday',
            ],
            [
                'nama_pengaturan' => 'Pengisian data skrining dimulai dari jam ?',
                'value' => '05:00-07:00',
            ],
            [
                'nama_pengaturan' => 'Setelah mengisi data skrining, tidak dapat mengisi data kembali hingga ... jam berikutnya ?',
                'value' => '2',
            ],
        ]);

        Penyakit::insert([
            [
                'nama_penyakit' => 'Apakah anda mengalami demam dalam seminggu terakhir ?',
                'point' => '20',
            ],
            [
                'nama_penyakit' => 'Apakah anda mengalami flu dalam seminggu terakhir ?',
                'point' => '20',
            ],
            [
                'nama_penyakit' => 'Apakah anda tidak dapat mencium bau dalam seminggu terakhir ?',
                'point' => '30',
            ],
            [
                'nama_penyakit' => 'Apakah anda mengalami gejala sesak nafas ?',
                'point' => '30',
            ],
            [
                'nama_penyakit' => 'Apakah akhir-akhir ini anda sering merasa cepat kelelahan ?',
                'point' => '10',
            ],
            [
                'nama_penyakit' => 'Apakah seminggu terakhir ini anda merasakan gejala batuk dan pilek ?',
                'point' => '25',
            ],
            [
                'nama_penyakit' => 'Apakah anda mengalami diare akhir akhir ini ?',
                'point' => '15',
            ],
            [
                'nama_penyakit' => 'Dalam beberapa hari terakhir, apakah anda kehilangan nafsu makan ?',
                'point' => '15',
            ],
            [
                'nama_penyakit' => 'Apakah beberapa hari terakhir ini anda merasa kurang sehat?',
                'point' => '20',
            ],
        ]);

        Siswa::factory(22)->create();
    }
}
