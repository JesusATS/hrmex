<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class GeminiController extends Controller
{
    public function chat(Request $request)
    {
        try {
            $validated = $request->validate([
                'prompt' => 'required|string|max:2000',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()->first()], 422);
        }

        if (! $apiKey = config('gemini.api_key')) {
            Log::error('Gemini API key is not configured. Please check your .env file for GEMINI_API_KEY and run "php artisan config:clear".');
            return response()->json(['error' => 'The AI assistant is currently unavailable due to a server configuration issue.'], 503);
        }

        try {
            $geminiService = new GeminiService($apiKey, config('gemini.model'));
            $text = $geminiService->generateContent($validated['prompt']);
            
            return response()->json(['response' => $text]);

        } catch (RequestException $e) {
            Log::error('Gemini API Request Error: ' . $e->getMessage(), [
                'status' => $e->response?->status(),
                'response' => $e->response?->body(),
            ]);
            return response()->json(['error' => 'Failed to get a response from the AI assistant.'], 502); // 502 Bad Gateway
        } catch (\Throwable $e) {
            Log::critical('Gemini Chat Exception: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['error' => 'An unexpected server error occurred.'], 500);
        }
    }
}
