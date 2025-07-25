<?php

namespace App\Services;

use App\Models\Application;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

class ApplicationStatusService
{
    public function accept(Application $application): void
    {
        $application->update([
            'status' => 'accepted',
            'rejection_note' => null
        ]);
    }

    public function reject(Application $application, string $note): void
    {
        $application->update([
            'status' => 'rejected',
            'rejection_note' => $note
        ]);
    }

    public function admit(Application $application, $amount): void
    {
        DB::transaction(function () use ($application, $amount) {
            $application->update([
                'status' => 'admitted',
                'amount_paid' => $amount,
                'payment_date' => now()->format('Y-m-d'),
            ]);
            // e.g., Move data to students table
        });
    }
}
