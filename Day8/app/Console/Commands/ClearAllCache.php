<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearAllCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-all-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Xóa toàn bộ cache (view, route, config, optimize)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
         $this->call('view:clear');
        $this->call('route:clear');
        $this->call('config:clear');
        $this->call('cache:clear');
        $this->call('optimize:clear');

        $this->info('Đã xóa toàn bộ cache!');
        return self::SUCCESS;
    }
}
