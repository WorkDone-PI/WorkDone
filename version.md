
# Controle de Versões

## [1.0.0] - 2024-09-27
- Versão inicial do projeto. Projeto já estruturado com algumas funcionalidades e estruturas.

## [1.1.0] - 2024-09-27
- Foi adicionado a lógica dos produtos/projetos do site. Criando os Models e Migrations necessárias para fazer a lógica funcionar, como por exemplo, a implementação da exibição dos projetos, que estão cadastrados no banco de dados, ao entrar na tela de home, funcionalidade que também foi implementada nesta versão.

## [1.2.0] - 2024-09-27
- Nesta versão, foi criado a categoria. Começando com a criação dos Modles e Migrations, relacionamos com a tabela de produtos, podendo agora, diferenciar as categorias dos produtos. Também foi atualizado na tela home, para que todos os posts exibam a categoria em que estão cadastrados.

## [1.3.0] - 2024-09-27
- Já nesta versão, foi adicionado o relacionamento entre as tabelas de usuários e produtos, que já estavam criadas. Agora podemos destinguir cada produto por cada usuário, exibindo também na tela home, onde cada post agora tem o nome do desenvolvedor dono do projeto. Também foi corrigido algumas tabelas nos migrations, excluindo colunas desnecessárias. 

## [1.4.0] - 2024-09-29
- Foram feitas diversas alterações, consistindo em mudanças tanto no front-end quanto no back-end. 
Alterações front-end:
 - Alinhar botões da, tela de login e cadastro, ao centro do formulário;
 - Fluxo de nacegação, pelo header, nas telas de login e cadastro;
 - Ocultado a barra de rolagem, tela de home;.
Alterações back-end:
 - Na tela de perfil, estão sendo listados o sprojetos que foram desenvolvidos pelo usuário em questão;
 - Correção do nome na tela home, agora exibe o nome do usuário que esta autenticado.