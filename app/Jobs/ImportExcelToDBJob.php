<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ImportExcelToDBJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private const BATCH_SIZE = 500;
    private $tableName;
    private $data;

    /**
     * Create a new job instance.
     */
    public function __construct($tableName, $data)
    {
        $this->tableName = $tableName;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $headers = array_shift($this->data);

        if (Schema::hasTable($this->tableName)) {
            /*пакетами по BATCH_SIZE-штук*/
            $counter = 0;
            foreach ($this->data as $row) {
                foreach ($row as $key => $value) {
                    if (Str::contains($headers[$key], 'date')) {
                        $rowData[$headers[$key]] = Carbon::createFromFormat('d.m.Y H:i:s', $value)->format('Y-m-d H:i:s');
                    } else {
                        $rowData[$headers[$key]] = $value;
                    }
                }
                $rows[] = $rowData;

                if (++$counter % self::BATCH_SIZE === 0) {
                    DB::table($this->tableName)->insert($rows);
                    $rows = [];
                }
            }

            if (!empty($rows)) {
                DB::table($this->tableName)->insert($rows);
            }
        }
    }
}
