<?php
namespace App\Jobs;


use App\Models\User;
use App\Notifications\ImportReady;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
class NotifyUserOfCompletedImportForUploadSupplierInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $active_job_id;
    public function __construct(User $user,$active_job_id)
    {
        $this->user = $user;
        $this->active_job_id = $active_job_id;
    }

    public function handle()
    {
        // $this->user->notify(new ImportReady());
        DB::delete('delete from active_jobs where id = ?', [$this->active_job_id]);
        toastr('Import Finished!','success');

            return redirect()->back() ;

    }
}
