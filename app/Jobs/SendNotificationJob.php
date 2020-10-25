<?php

namespace App\Jobs;

use App\Services\NotificationService;

class SendNotificationJob extends Job
{
    public function handle(NotificationService $notificationService)
    {
        $notificationService->send();
    }
}
