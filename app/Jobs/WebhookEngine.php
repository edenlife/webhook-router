<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebhookEngine implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $environment;
    private $requestBody;

    /**
     * Create a new job instance.
     *
     * @param string $environment
     * @param object $requestBody
     * @return void
     */
    public function __construct($environment, $request)
    {
        $this->environment = $environment;
        $this->requestBody = json_decode($request->getContent(),true);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Http::post($this->environment, $this->requestBody);

        Log::info("Called ". $this->environment. " with body ", $this->requestBody);
    }
}
