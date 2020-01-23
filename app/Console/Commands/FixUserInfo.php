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

                    $data = DB::table('att2000_mohr.checkinout')
                        ->where('userid', $oldUser->userid)
                        ->update(['userid' => $mapUser->userid]);

                    DB::table('anggota_shift')
                        ->where('anggota_id', $oldUser->userid)
                        ->update(['anggota_id' => $mapUser->userid]);

                    DB::table('final_attendances')
                        ->where('anggota_id', $oldUser->userid)
                        ->update(['anggota_id' => $mapUser->userid]);

                    DB::table('flow_anggota')
                        ->where('anggota_id', $oldUser->userid)
                        ->update(['anggota_id' => $mapUser->userid]);

                    DB::table('kelewatan')
                        ->where('anggota_id', $oldUser->userid)
                        ->update(['anggota_id' => $mapUser->userid]);

                    DB::table('pegawai_penilai')
                        ->where('anggota_id', $oldUser->userid)
                        ->update(['anggota_id' => $mapUser->userid]);

                    DB::table('pegawai_penilai')
                        ->where('pegawai_id', $oldUser->userid)
                        ->update(['pegawai_id' => $mapUser->userid]);

                    DB::table('users')
                        ->where('anggota_id', $oldUser->userid)
                        ->update(['anggota_id' => $mapUser->userid]);
                });
            }
        }
        // 2. grab batchnumber
        // 3. map with userinfo original
        // 4. update anggota_shift, final_attendances, flow_anggota, kelewatan, pegawai_penilai (p), users
    }
}
