<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class UpdateUserAdminStatus extends Command
{
    protected $signature = 'user:update-admin-status {id} {status}';

    protected $description = 'Update the admin status of a user';

    public function handle()
    {
        $userId = $this->argument('id');
        $status = $this->argument('status');

        $user = User::find($userId);

        if ($user) {
            $user->is_admin = $status;
            $user->save();
            $this->info("User's admin status updated successfully.");
        } else {
            $this->error("User not found.");
        }
    }
}
