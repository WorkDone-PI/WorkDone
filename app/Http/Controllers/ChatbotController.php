<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatbotController extends Controller
{
    private $awaitingUrl = false;
    private $awaitingFAQResponse = false;

    public function showChat()
    {
        return view('chatbot');
    }

    public function respond(Request $request)
    {
        $userMessage = $request->input('message');
        $processedMessage = $this->preprocessMessage($userMessage);
        $botResponse = $this->generateResponse($processedMessage);

        DB::table('messages')->insert([
            'user_message' => $userMessage,
            'bot_response' => $botResponse,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['response' => $botResponse]);
    }

    private function preprocessMessage($message)
    {
        $message = mb_strtolower($message);
        $message = preg_replace('/[áàãâä]/u', 'a', $message);
        $message = preg_replace('/[éèêë]/u', 'e', $message);
        $message = preg_replace('/[íìîï]/u', 'i', $message);
        $message = preg_replace('/[óòõôö]/u', 'o', $message);
        $message = preg_replace('/[úùûü]/u', 'u', $message);
        $message = preg_replace('/[^\w\s]/u', '', $message);

        return $message;
    }

    private function generateResponse($message)
    {
        if ($this->awaitingUrl) {
            return $this->handleAwaitingUrl($message);
        }

        if ($this->awaitingFAQResponse) {
            return $this->handleFAQResponse($message);
        }

        if ($this->containsKeywords($message, ['perfil'])) {
            return $this->handleProfileIssues($message);
        }

        if ($this->containsKeywords($message, ['projeto'])) {
            return $this->handleProjectIssues();
        }

        switch (true) {
            case $this->containsKeywords($message, ['senha']):
                return $this->handlePasswordIssue();

            case $this->containsKeywords($message, ['duvida', 'frequente']):
                $this->awaitingFAQResponse = true;
                return $this->handleFAQ();

            case $this->containsKeywords($message, ['sair']):
                return 'Entendo que deseja sair do suporte. Se precisar de ajuda novamente, estaremos aqui para ajudar! Até logo.';

            case $this->containsKeywords($message, ['vendedor']):
                return $this->handleContactSeller();

            case $this->containsKeywords($message, ['suporte','profissional']):
                return $this->handleSupport();

            case $this->containsKeywords($message, ['email']):
                return $this->handleEmailIssue();
                
            case $this->containsKeywords($message, ['seguidores','seguindo']):
                return $this->handleFollowIssue();  

            case $this->containsKeywords($message, ['numero de contato', 'telefone']):
                return $this->handleTelefoneIssue();  

            case $this->containsKeywords($message, ['publicar', 'postar']):
                return $this->handlePublicarIssue(); 

            case $this->containsKeywords($message, ['atualizar']):
                return $this->handleUpdateProjectIssue();  

            case $this->containsKeywords($message, ['deletar','apagar']):
                return $this->handleDeleteProjectIssue();

            case $this->containsKeywords($message, ['excluir']):
                return $this->handleDeleteAccountIssue();

            case $this->containsKeywords($message, ['visualizar','ver']):
                return $this->handleVisuIssue();  

            case $this->containsKeywords($message, ['obrigado']):
                return $this->handleThanksIssue();

            default:
                return 'Desculpe, não entendi sua mensagem. Pode reformular?';
        }
    }

    private function containsKeywords($message, $keywords)
    {
        foreach ($keywords as $keyword) {
            if (strpos($message, $keyword) !== false) {
                return true;
            }
        }
        return false;
    }

    private function handlePasswordIssue()
    {
        return 'Para redefinir sua senha, acesse a página de perfil e clique em "Alterar senha".';
    }

    private function handleThanksIssue()
    {
        return 'Espero ter ajudado, volte mais vezes se tiver outras dúvidas.';
    }

    private function handleVisuIssue()
    {
        return 'Você está enfrentando problemas ao visualizar seu conteúdo. Tente recarregar a página e verifique a conexão com a internet.';
    }

    private function handleProjectIssues()
    {
        return 'Qual problema você está enfrentando no projeto? Você pode estar com dificuldades para publicar, deletar ou visualizar o projeto.';
    }
    private function handleUpdateProjectIssue()
    {
        return 'Você está enfrentando problemas ao editar seu conteúdo. Certifique-se de que a página está carregada corretamente e sua conexão está estável.';
    }
    private function handlePublicarIssue()
    {
        return 'Você está enfrentando problemas ao publicar seu conteúdo. Tente novamente mais tarde e verifique sua conexão de internet.';
    }
    private function handleDeleteProjectIssue()
    {
        return 'Você está enfrentando problemas ao deletar seu conteúdo. Tente novamente mais tarde e verifique sua conexão de internet.';
    }
    private function handleDeleteAccountIssue()
    {
        return 'Você está enfrentando problemas ao deletar seu perfil. Tente novamente mais tarde e verifique sua conexão de internet.';
    }
    
    
    private function handleFollowIssue()
    {
        return 'Você está enfrentando problemas ao visualizar seus seguidores/seguindo. Verifique sua conexão e tente novamente.';
    }

    private function handleProfileIssues($message)
    {
        if ($this->containsKeywords($message, ['editar', 'editar dados'])) {
            return $this->handleProfileIssueDetails('editar');
        } elseif ($this->containsKeywords($message, ['seguidores', 'seguindo'])) {
            return $this->handleProfileIssueDetails('seguidores');
        } elseif ($this->containsKeywords($message, ['excluir perfil', 'excluir'])) {
            return $this->handleProfileIssueDetails('excluir');
        } else {
            return 'Qual problema você está enfrentando no perfil? Você pode ter dificuldades para editar perfil, ver seus seguidores ou excluir o perfil.';
        }
    }

    private function handleContactSeller()
    {
        return "Você está enfrentando um problema para contatar o vendedor? Pode nos informar se o número de contato está incorreto ou se o e-mail de contato está errado.";
    }

    private function handleFAQ()
    {
        return "Posso te ajudar com dúvidas frequentes! Alguns tópicos comuns são: redefinir senha ou contato com o suporte profissional. Por favor, me diga qual é sua dúvida.";
    }

    private function handleEmailIssue()
    {
        return 'O e-mail de contato está incorreto. Por favor, forneça o e-mail correto.';
    }
    private function handleSupport()
    {
        return 'Para entrar em contato com o suporte profissional, entraremos em contato com você via email com um dos nossos profissionais.';
    }

    private function handleTelefoneIssue()
    {
        return 'O número de contato está incorreto. Por favor, forneça o número correto.';
    }


    private function handleFAQResponse($message)
    {
        $this->awaitingFAQResponse = false;

        switch (true) {
            case preg_match('/\b(senha)\b/', $message):
                return 'Para redefinir sua senha, acesse a página de perfil e clique em "Alterar senha".';

            case preg_match('/\b(suporte|profissional)\b/', $message):
                return 'Para entrar em contato com o suporte profissional, entraremos em contato com você via email com um dos nossos profissionais.';

            case preg_match('/\b(projeto)\b/', $message):
                return 'Qual problema você está enfrentando no projeto? Pode ser uma dificuldade para publicar, editar ou visualizar o conteúdo.';

            case preg_match('/\b(editar|editar perfil|dados)\b/', $message):
                return 'Você está enfrentando dificuldades na edição do perfil. Por favor, siga as instruções para corrigir esse problema.';

            case preg_match('/\b(publicar)\b/', $message):
                return 'Você está enfrentando problemas ao publicar seu conteúdo. Tente novamente mais tarde e verifique sua conexão de internet.';

            case preg_match('/\b(visualizar projeto)\b/', $message):
                return 'Você está enfrentando problemas ao visualizar seu conteúdo. Tente recarregar a página e verifique a conexão com a internet.';
        }
    }

    private function handleAwaitingUrl($message)
    {
        if (filter_var($message, FILTER_VALIDATE_URL)) {
            $this->awaitingUrl = false;
            return 'Obrigado pela URL! Estamos processando sua solicitação.';
        } else {
            return 'A URL fornecida não é válida. Por favor, envie uma URL válida.';
        }
    }

    private function handleProfileIssueDetails($option)
    {
        switch ($option) {
            case 'editar':
                return 'Você informou que não consegue editar o seu perfil. Por favor, siga os seguintes passos: 1- Reinicie a página. 2- Verifique se a sua conexão com a internet está estável. 3- Aguarde a página carregar por completo.';
            case 'seguidores':
                return 'Você informou que não consegue ver os seus seguidores/seguindos. Por favor, siga os seguintes passos: 1- Reinicie a página. 2- Verifique sua conexão com a internet. 3- Tente acessar o perfil de outro usuário.';
            case 'excluir':
                return 'Você informou que as suas informações não estão atualizadas corretamente. Por favor, siga os seguintes passos: 1- Atualize suas informações manualmente. 2- Caso o problema persista, entre em contato com o suporte.';
            default:
                return 'Escolha inválida. Por favor, digite o número correto.';
        }
    }
}
