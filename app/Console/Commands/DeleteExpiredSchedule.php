<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\jadwal;
use Carbon\Carbon;

class DeleteExpiredSchedule extends Command
{
    protected $signature = 'schedule:delete-expired';
    protected $description = 'Delete expired schedules';

    public function handle()
    {
        // Ambil tanggal hari ini menggunakan Carbon
        $today = Carbon::today();

        // Hapus data jadwal yang tanggal selesainya lebih kecil dari tanggal hari ini
        jadwal::whereDate('waktu_selesai', '<', $today)->delete();

        $this->info('Expired schedules deleted successfully.');
    }
}
