<?php

namespace App\Console\Commands;

use App\Anggota;
use App\UserinfoOld;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixUserInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emasa:fixuserinfo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix userinfo after resync';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // 1. get data from userinfo_old
        $oldUsers = UserinfoOld::all();

        foreach ($oldUsers as $oldUser) {
            $mapUser = Anggota::where("badgenumber", $oldUser->badgenumber)->first();

            if ($mapUser) {
                echo "Badge Number: " . $oldUser->badgenumber . "\n";

                DB::transaction(function () use ($oldUser, $mapUser) {

                    DB::update('update att2000_mohr.checkinout set userid = ' . $mapUser->userid . ' where userid = ?', [$oldUser->userid]);

                    DB::update('update anggota_shift set anggota_id = ' . $mapUser->userid . ' where anggota_id = ?', [$oldUser->userid]);

                    DB::update('update final_attendances set anggota_id = ' . $mapUser->userid . ' where anggota_id = ?', [$oldUser->userid]);

                    DB::update('update flow_anggota set anggota_id = ' . $mapUser->userid . ' where anggota_id = ?', [$oldUser->userid]);

                    DB::update('update kelewatan set anggota_id = ' . $mapUser->userid . ' where anggota_id = ?', [$oldUser->userid]);

                    DB::update('update pegawai_penilai set anggota_id = ' . $mapUser->userid . ' where anggota_id = ?', [$oldUser->userid]);

                    DB::update('update pegawai_penilai set pegawai_id = ' . $mapUser->userid . ' where pegawai_id = ?', [$oldUser->userid]);

                    DB::update('update pegawai_penilai set anggota_id = ' . $mapUser->userid . ' where anggota_id = ?', [$oldUser->userid]);
                });
            }
        }
        // 2. grab batchnumber
        // 3. map with userinfo original
        // 4. update anggota_shift, final_attendances, flow_anggota, kelewatan, pegawai_penilai (p), users
    }
}
