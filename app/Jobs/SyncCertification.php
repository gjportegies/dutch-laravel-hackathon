<?php

namespace App\Jobs;

use App\Certificate;
use App\Services\LaravelCertificateValidationService;
use App\User;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncCertification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var User
     */
    private $user;

    /**
     * Create a new job instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @param LaravelCertificateValidationService $laravelCertificateValidationService
     * @return void
     */
    public function handle(LaravelCertificateValidationService $laravelCertificateValidationService): void
    {
        $certificate = $this->user->certificate;

        if ($certificate instanceof Certificate && $certificate->date_of_certification instanceof DateTime) {
            $status = $laravelCertificateValidationService->validateFor(
                $this->user->name,
                $certificate->date_of_certification
            );

            if ($status === true && $this->user->certificate->valid === false) {
                $this->user->certificate->update([
                    'valid' => true,
                ]);

                return;
            }

            $this->user->certificate->update([
                'valid' => false,
            ]);
        }
    }
}
