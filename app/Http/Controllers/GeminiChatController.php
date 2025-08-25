<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class GeminiChatController extends Controller
{
    public function handleChat(Request $request)
    {
        try {
            $validated = $request->validate([
                'message' => 'required|string|max:2000',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'response' => $e->validator->errors()->first()], 422);
        }

        $apiKey = config('gemini.api_key');
        $model = config('gemini.model');

        if (!$apiKey) {
            Log::error('Gemini API key is not configured. Please check your .env file for GEMINI_API_KEY and run "php artisan config:clear".');
            return response()->json(['status' => 'error', 'response' => 'The AI assistant is currently unavailable due to a server configuration issue.'], 503);
        }

        $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}", [
            'contents' => [
                ['parts' => [['text' => $validated['message']]]]
            ]
        ]);

        if ($response->successful()) {
            $data = $response->json();

            $geminiReply = data_get($data, 'candidates.0.content.parts.0.text', 'No se pudo obtener una respuesta válida de Gemini.');

            return response()->json([
                'status' => 'success',
                'response' => $geminiReply
            ]);
        } else {
            Log::error('Error al conectar con la API de Gemini', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return response()->json([
                'status' => 'error',
                'response' => 'Falló la conexión con la API de Gemini.'
            ], $response->status());
        }
    }
}