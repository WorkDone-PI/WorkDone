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

        if ($this->containsKeywords($message, ['perfil', 'indentidade', 'perfiu', 'perfio','prfil', 'perfilh', 'perfíl', 'pehrfil', 'perfell', 'perfilo', 'perfill' ])) {
            return $this->handleProfileIssues($message);
        }

        if ($this->containsKeywords($message, ['projeto','progeto', 'projeto', 'projheto', 'projeto', 'proieto', 'projito', 'proeto', 'projto', 'projjeto', 'projtoh'])) {
            return $this->handleProjectIssues();
        }

        switch (true) {
            case $this->containsKeywords($message, ['senha','senhaa', 'cenha','sennha', 'senah', 'seha', 'senh', 'sena', 'senhaa', 'xenha', 'zenha']):
                return $this->handlePasswordIssue();

            case $this->containsKeywords($message, [ 'duvida', 'dúvida', 'duvda', 'duvia', 'duvída', 'duvda','duvidaa', 'dúvidaa','dvuida', 'frequente', 'frequênt', 'frekente', 'frequnte', 'frekquente', 'frequênte','frequent', 'frequeti', 'frequeti', 'freqeunte', 'frekente']):
                $this->awaitingFAQResponse = true;
                return $this->handleFAQ();

            case $this->containsKeywords($message, ['sair', 'saiir', 'sairr', 'sairh', 'sai', 'sairi', 'xair', 'sairrr', 'sairre', 'saer', 'zair']):
                return 'Entendo que deseja sair do suporte. Se precisar de ajuda novamente, estaremos aqui para ajudar! Até logo.';

            case $this->containsKeywords($message, ['vendedor', 'vendedorr', 'vendedorh', 'vendendor', 'venddor', 'vendedo', 'vendador', 'vnededor', 'vendedoor', 'vededor', 'vendeder', 'venddedor'
            ]):                
                return $this->handleContactSeller();

            case $this->containsKeywords($message, ['suporte', 'supote','sopurte', 'suport', 'supprte', 'profissional', 'profisional', 'profissionall', 'profecional', 'profissionall', 'proficional']):
                return $this->handleSupport();

            case $this->containsKeywords($message, ['email', 'emial', 'e-mail', 'emil', 'emaill', 'imeil', 'eimal', 'eimail', 'emeil', 'emaiil']):
                return $this->handleEmailIssue();
                
            case $this->containsKeywords($message, ['seguidores', 'segidores', 'seguidoress', 'seeguidore', 'seeguidores', 'seguindo', 'segindo', 'seguiindo', 'seeguiindo', 'seguiindo']):
                return $this->handleFollowIssue();  

            case $this->containsKeywords($message, [    'numero de contato', 'número de contato', 'numero contato', 'numero d contato', 'numerodecontato', 'telefone', 'telefhone', 'telefoone', 'teelefone', 'telefonee']):
                return $this->handleTelefoneIssue();  

            case $this->containsKeywords($message, [    'publicar', 'publicar', 'publikar', 'publcar', 'publcar', 'postar','postarr', 'pstar', 'posttar', 'posstar']):
                return $this->handlePublicarIssue(); 

            case $this->containsKeywords($message, [    'atualizar', 'atualisar', 'atualizer', 'atualizarr', 'atulizar', 'atulizar']):
                return $this->handleUpdateProjectIssue();  

            case $this->containsKeywords($message, [    'deletar', 'deletarr', 'deletaar', 'delettar', 'deleta', 'apagar', 'apagaar', 'apaggar', 'appagar', 'apagaarr']):
                return $this->handleDeleteProjectIssue();

            case $this->containsKeywords($message, ['excluir', 'escluir', 'exluir', 'exccluir', 'excluirr', 'excluirr']):
                return $this->handleDeleteAccountIssue();

            case $this->containsKeywords($message, [    'visualizar', 'visulizar', 'vizualizar', 'visualisar', 'visalizar', 'ver', 'vee', 'verr', 'veer', 'vver']):
                return $this->handleVisuIssue();  

            case $this->containsKeywords($message, [    'obrigado', 'brigado', 'orbigado', 'obrigadoo', 'obrigaddo', 'origado', 'obridago', 'obriigado', 'obrrigado', 'obrgado']):
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
        return 'Você está enfrentando problemas ao editar seu conteúdo. Certifique-se de que a página está carregada corretamente e sua conexão está estável, verifique se todos os campos estão preenchidos corretamente e espere a página carregar por completo.';
    }
    private function handlePublicarIssue()
    {
        return 'Você está enfrentando problemas ao publicar seu conteúdo. Verifique se todos os campos necessários estão preenchidos, aguarde a página carregar, se o erro persistir, tente novamente mais tarde e verifique sua conexão de internet.';
    }
    private function handleDeleteProjectIssue()
    {
        return 'Você está enfrentando problemas ao deletar seu conteúdo. Ao clicar em deletar, reinicie a página e verifique se deletou, se presistir, tente novamente mais tarde e verifique sua conexão de internet.';
    }
    private function handleDeleteAccountIssue()
    {
        return 'Se está querendo deletar o seu perfil, entre em contato com o e-mail, suporte@workdone.com e mande o moitov pelo qual quer deletar a conta.';
    }
    
    
    private function handleFollowIssue()
    {
        return 'Você está enfrentando problemas ao visualizar seus seguidores/seguindo. Verifique sua conexão com a internet, verifique se a página está completamente carregar e se está na página correta.';
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
        return 'O e-mail de contato está incorreto.Iremos entrar em contato com o profissional para que forneça o e-mail correto.';
    }
    private function handleSupport()
    {
        return 'Para entrar em contato com o suporte profissional, entraremos em contato com você via e-mail com um dos nossos profissionais, aguarde o e-mail suporte@workdone.com.';
    }

    private function handleTelefoneIssue()
    {
        return 'O número de contato está incorreto.Iremos entrar em contato com o profissional para que forneça o número correto.';
    }


    private function handleFAQResponse($message)
    {
        $this->awaitingFAQResponse = false;

        switch (true) {
            case preg_match('/\b(senha)\b/', $message):
                return 'Para redefinir sua senha, acesse a página de perfil e clique em "Alterar senha".';

            case preg_match('/\b(suporte|profissional)\b/', $message):
                return 'Para entrar em contato com o suporte profissional, entraremos em contato com você via e-mail com um dos nossos profissionais, aguarde o e-mail suporte@workdone.com.';

            case preg_match('/\b(projeto)\b/', $message):
                return 'Qual problema você está enfrentando no projeto? Pode ser uma dificuldade para publicar, editar ou visualizar o conteúdo.';

            case preg_match('/\b(editar|editar perfil|dados)\b/', $message):
                return 'Você está enfrentando dificuldades na edição do perfil. Por favor, siga as instruções para corrigir esse problema.';

            case preg_match('/\b(publicar)\b/', $message):
                return 'Você está enfrentando problemas ao publicar seu conteúdo. Verifique se todos os campos necessários estão preenchidos, aguarde a página carregar, se o erro persistir, tente novamente mais tarde e verifique sua conexão de internet.';

            case preg_match('/\b(visualizar projeto)\b/', $message):
                return 'Você está enfrentando problemas ao visualizar seu conteúdo. Tente recarregar a página e verifique a conexão com a internet, verifique se o projeto foi publicado e se encontra nesta aba.';
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
                return 'Você informou que não consegue editar o seu perfil. Por favor, siga os seguintes passos: 1- Reinicie a página. 2- Verifique se a sua conexão com a internet está estável. 3- Aguarde a página carregar por completo. 4- Preencha todos os campos pedidos';
            case 'seguidores':
                return 'Você informou que não consegue ver os seus seguidores/seguindos. Por favor, siga os seguintes passos: 1- Reinicie a página. 2- Verifique sua conexão com a internet. 3- Tente acessar o perfil de outro usuário.';
            case 'excluir':
                return 'Você está enfrentando problemas ao deletar seu perfil. Ao clicar em deletar, reinicie a página e verifique se deletou, se presistir, tente novamente mais tarde e verifique sua conexão de internet.';
            default:
                return 'Escolha inválida. Por favor, digite o número correto.';
        }
    }
}
