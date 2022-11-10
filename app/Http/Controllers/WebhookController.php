<?php

namespace App\Http\Controllers;

use App\Jobs\WebhookEngine;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    /**
     * Distribute the request to the different environments
     *
     * @param Request $request
     * @return array
     */
    public function distribute(Request $request) {
        Log::info("New request received", [$request]);

        WebhookEngine::dispatch($request);

        return response()->json([
            "message" => "Webhook received"
        ], Response::HTTP_OK);
    }
}
