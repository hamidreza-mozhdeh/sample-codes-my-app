<?php

namespace App\Jobs;

use App\Exports\ClientsExport;
use App\Models\Admin;
use App\Notifications\ReportClientsViaEmailNotification;
use App\Repository\ClientRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SendClientListViaEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::table('admins')->chunk(100, function($admins)
        {
            foreach ($admins as $admin)
            {
                $filePath = "reports/clients-{$admin->id}.xlsx";
                (new ClientsExport($admin))->store($filePath);
                $admin->notify(new ReportClientsViaEmailNotification($filePath));
            }
        });
    }
}
