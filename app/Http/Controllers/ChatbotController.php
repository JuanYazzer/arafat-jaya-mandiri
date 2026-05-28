<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ChatbotService;

class ChatbotController extends Controller
{
    protected $chatbotService;
    
    public function __construct(ChatbotService $chatbotService)
    {
        $this->chatbotService = $chatbotService;
    }
    
    public function chat(Request $request)
    {
        $user = $request->user();

        $userMessage = trim($request->input('message', ''));

        try {
            $response = $this->chatbotService->processMessage(
                $userMessage,
                $user
            );
            
            return response()->json([
                'reply' => $response,
                'success' => true
            ]);
        } catch (\Exception $e) {
            \Log::error('Chatbot error', ['exception' => $e]);

            $debugMessage = config('app.debug') ? $e->getMessage() : 'Maaf, terjadi kesalahan. Coba lagi.';

            return response()->json([
                'reply' => $debugMessage,
                'success' => false
            ], 500);
        }
    }
}