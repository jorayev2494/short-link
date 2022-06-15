<?php

namespace App\Jobs;

use App\Models\Url;
use App\Repositories\UrlRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IncrementUrlVisitJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private string $sortUrl,
        private UrlRepository $urlRepository
    )
    {
        // $this->connection = 'rabbitmq';
        

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        // $this->model->increment('visited_count');
        
        $foundVisitedUrl = $this->urlRepository->findByShortUrl($this->sortUrl);

        if ($foundVisitedUrl) {
            $foundVisitedUrl->increment('visited_count');
        }
    }
}
