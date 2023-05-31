<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Links;

class ResetLinkAccess extends Command
{
    protected $signature = 'links:reset-access';

    protected $description = 'Reset link access count on the first day of each month';

    public function handle()
    {
        // Zerar o número de acessos de todos os links
        Links::query()->update(['clicks' => 0]);

        $this->info('Link access count reset completed.');
    }
}
