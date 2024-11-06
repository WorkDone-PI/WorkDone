<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatbotController extends Controller
{

    public function showChat()
    {
        return view('chatbot');
    }


    public function respond(Request $request)
    {
        $userMessage = $request->input('message');
        $botResponse = $this->generateResponse($userMessage);
        
        // Armazenar mensagem e resposta no banco
        \DB::table('messages')->insert([
            'user_message' => $userMessage,
            'bot_response' => $botResponse,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['response' => $botResponse]);
    }

    private function generateResponse($message)
    {
        // Lógica simples de resposta
        if (strpos($message, 'oi') !== false) {
            return 'Olá! Como posso ajudar?';
        }
        return 'Desculpe, não entendi sua mensagem.';
    }
}
