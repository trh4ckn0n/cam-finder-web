<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Camera;

class UpdateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the database from the csv file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      $file = Storage::get('cameras.csv');
      $cams = array_slice(explode("\n", $file), 1);
      Camera::truncate();
      foreach($cams as $cam) {
        $cam = explode(',', $cam);
        Camera::create([
          'ip' => $cam[0],
          'port' => $cam[1],
          'count' => $cam[2],
          'source' => $cam[3],
          'city' => $cam[4],
          'country' => $cam[5],
          'code' => $cam[6],
          'lat' => $cam[8],
          'long' => $cam[7] 
        ]);
      }

      return 1;
    }
}
