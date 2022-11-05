<?php

namespace App\Http\Controllers;

use App\Jobs\WebhookEngine;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WebhookController extends Controller
{
    /**
     * Distribute the request to the different environments
     *
     * @param Request $request
     * @return array
     */
    public function distribute(Request $request) {
        $environments = config('environments.defaults');

        foreach($environments as $environment) {
            WebhookEngine::dispatch($environment, $request);
        }

        return response()->json([
            "message" => "Webhook received"
        ], Response::HTTP_OK);
    }
}
