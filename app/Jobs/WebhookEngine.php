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

    private $requestBody;

    /**
     * Create a new job instance.
     *
     * @param string $environment
     * @param object $requestBody
     * @return void
     */
    public function __construct($request)
    {
        $this->requestBody = json_decode($request->getContent(),true);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $webhookMetaData = $this->requestBody['data']['metadata']['custom_fields'][0];

        $url = $webhookMetaData['host_url'] ?? null;

        if (!$url) {
            Log::info("Cannot find url for data");
            return;
        }

        $fullUrl = $url . config('environments.paystack_endpoint');

        Http::post($fullUrl, $this->requestBody);

        Log::info("Called ". $fullUrl. " with body ");
    }
}
