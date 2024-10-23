# *Instruções para Rodar o Projeto*

Este guia fornece um passo a passo para clonar e configurar o projeto Laravel "WorkDone" utilizando Git Flow.

## *1. Clonar o Projeto do GitHub*

1. **Abrir o Prompt de Comando**: 
   - Abra o terminal no Visual Studio Code ou no CMD.

2. **Executar o Comando**:
   ```bash
   git clone https://github.com/WorkDone-PI/WorkDone.git

### *1.1 Mudando de Branch*
- Por padrão, o Git irá clonar a branch main. Para trabalhar na branch develop, execute:
    ```bash
    git checkout develop
- Verificação: Verifique se os arquivos estão diferentes, especialmente se todas as migrations estão na pasta database/migrations. Na branch main, devem aparecer apenas 4 arquivos, enquanto na branch develop, você verá várias migrations.

## *2. Criar o .env e a pasta vendor*
1. Navegar para a Pasta do Projeto:
   ```
   cd WorkDone
### *2.1. Criar a pasta vendor*
- Execute o comando abaixo para instalar as dependências do projeto:
  ```
  composer install

### *2.2. Criar o Arquivo .env*
- Para criar o arquivo .env, copie o arquivo de exemplo:
  ```
  cp .env.example .env
- Para gerar a chave de aplicação, execute:
  ```
  php artisan key:generate
## *3. Configuração do Banco de Dados*
- Após criar o arquivo .env, configure as credenciais do banco de dados:
1. Inicie o Apache e o MySQL no XAMPP.
2. No arquivo .env, troque o nome do database pelo que você deseja criar, por exemplo, WorkDone.
- Para criar o banco de dados e todas as tabelas, execute:
  ```
  php artisan migrate
- Este comando irá criar todas as tabelas automaticamente conforme definido nas migrations.

## *4. Versionamento*
Ao trabalhar em equipe, é importante evitar conflitos. Siga estas orientações para versionamento:

### *4.1. Atualizar o Repositório*
- Antes de iniciar qualquer nova tarefa, sempre execute o comando abaixo para garantir que você tenha a versão mais recente do repositório:
  ```bash
  git pull

### *4.2. Criar uma Nova Feature*
- Para iniciar uma nova feature, utilize o comando:
  ```bash
  git flow start feature <nome_da_feature>
- Exemplo:
  ```bash
  git flow start feature fix_bug_login
- Fazer Alterações: Realize as alterações necessárias para cumprir o objetivo da feature.

### *4.3. Adicionar e Comitar Alterações*
1. Adicione todos os arquivos alterados:
    ```bash
    git add . 
2. Realize um commit com uma descrição clara das alterações:
    ```bash
    git commit -m "Descrição das alterações"

### *4.4. Versionamento de Releases*
- Para seguir o controle de versões, crie uma versão utilizando o padrão (patch, minor e major):
    ```bash
    git tag -a v1.0.0 -m "Descrição da versão"
- *Importante*: Modifique a versão conforme necessário antes de rodar o comando acima.

### *4.5. Finalizar a Feature*
- Para encerrar a feature e voltar à branch develop, execute:
    ```bash
    git flow finish feature <nome_da_feature>

## *5. Subir as Alterações para o GitHub*
- Após finalizar a feature, envie suas alterações para o GitHub com os comandos:
  ```bash
  git push origin develop
  git push origin develop --tags
