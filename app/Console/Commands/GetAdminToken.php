<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GetAdminToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-admin-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /**
         * @var User $user
         */
        $user = User::find(1)->first();

        $token = $user->createToken('admin-token')->plainTextToken;

        $this->info("Admin token: $token");
    }
}
