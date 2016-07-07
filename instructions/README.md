# Como testar:

**Configurar um virtual host apontando para a raiz do diretório teste_php**

## Teste 1

1. Instalar as dependências via composer. Entre no diretório **teste1** e rode o comando ``composer update``;

2. Acesse a URL criada no virtual host e clique no link Teste 1.

## Teste 2

1. Usar o dump do banco de dados, encontrado no diretório **teste2/backup**;

2. Configurações do banco de dados e URL podem ser feitas no arquivo **teste2/app/app.php**;

3. Instalar as dependências via composer. Entre no diretório **teste2** e rode o comando ``composer update``;

4. Instalar as dependências para o frontend. Entre no diretório **teste2/app/assets** e rode o comando ``npm install``

5. É necessário ter as gemas **sass**, **bourbon**, **neat** e **bitters**. Caso não estejam instaladas, use o comando ``gem install [nomedagema]``;

6. É tambem necessário ter o Grunt CLI instalado globalmente no sistema. Para tal, e se necessário, use o comando ``npm install -g grunt-cli``.

7. Acesse a URL criada no virtual host e clique no link Teste 2.

8. Dados de acesso ao cadastro de imóveis:

  - usuário: admin
  - senha:   foo
