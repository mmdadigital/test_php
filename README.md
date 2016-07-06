# Instalação

1- Mova a pasta do projeto para /var/www ou algum outro diretório em conjunto a um vhost.

2- Rode o arquivo testes1e2.sql em seu banco MySQL para criar as tabelas necessárias.

3- Entre no diretório do projeto via command line e rode composer install. Isto irá baixar as dependências do projeto.

4- Edite o arquivo src/core/Database.php, método getSettings com a sua configuração do MySQL.


# TESTE DE PHP

Neste teste, para vaga de programador **PHP Pleno/Sênior**, Espera-se que o candidato tenha conhecimento de Orientação a Objeto e MVC, tenha boa lógica para fazer código sucinto e reusável, e que mantenha os códigos organizados e documentados.

Com base nisso, crie uma página em PHP, atendendo as duas questões abaixo, fazendo da melhor maneira possível **(Organização de Pastas e Códigos, Comentários, etc), usando MVC e Orientação a Objetos**. É desejável que o seu arquivo index.php seja utilizado apenas para dar bootstrap (Inicializar) a aplicação.

Faça o teste com calma, é preferível que demore um pouco mais para entregar do que mandar de qualquer jeito. **A qualidade do seu código será um ponto muito importante!**

**Para enviar o teste, faça um pull request nesse repositório.**

**OBS: Pode ser utilizado algum Microframework (Ex: Slim, Silex etc), algum Sistema de templates e alguma ferramenta de testes (Explique por que utilizou). Caso utilize deve vir especificado os passos de instalação em um README.md e deve ser utilizado o composer para instalação. Ambos testes deverão ser entregues no mesmo pacote.**


## Teste nº 1

A partir do array abaixo, gerar um menu em HTML, exibindo todos os níveis hierárquicos existentes no array. O menu pode vir em formato de lista, usando UL, OL, não sendo obrigatório esconder os submenus.

**Obs.:** Este menu poderá **ser alterado**, removendo ou adicionando **itens e níveis.** Portando, construa ele de forma que funcione sem necessidade de editar o código. Tente fazer o código menor possível.

Para obter o array do teste, entre no arquivo **menu_array.php**


## Teste nº 2

Um cliente deseja construir um portal para sua imobiliária. Ele deseja poder cadastrar seus imóveis.

**No cadastro do imóvel ele deseja poder adicionar as seguintes informações:**
  * Tipo do imóvel (Uma lista. Ex: Apartamento, Casa, etc...)
  * Ele deseja ter como cadastrar e editar os Tipos de imóvel.
  * Fotos (Ele gostaria que **não tenha** um limite de cadastro fotos)
  * Rua
  * Número
  * Cidade (Pode ser um campo livre)
  * Estado (Deve exibir um alista)
  * Descrição

Ele também informou que, para cada imóvel, ele precisa informar um Responsável, que normalmente o dono do imóvel que esta a venda ou para locação.

Para isso ele gostaria de ter a opção de adicionar contatos, que não precisam ter acesso via login no site.

Ele disse que não gostaria de ter que cadastrar esses contatos toda vez que adicionar um imóvel, pois segundo ele, pode acontecer de um mesmo contato estar presente em vários imoveis. Também um mesmo imóvel pode apresentar mais de um contato.

Sendo assim ele gostaria de poder usar o mesmo contato em mais de um imóvel.

**Para o contato ele gostaria de poder cadastrar os seguintes dados:**
  * Nome
  * Telefones (Ele poderá por quantos números desejar)
  * E-mails (Ele poderá por quantos e-mails desejar)

Na página do imóvel deve conter as fotos do imóvel, o tipo de imóvel, rua, numero, cidade, descrição e contato(s).

Abaixo dessa pagina, apos esses dados do imóvel, deve ser exibido outros 3 imóveis aleatórios que estejam na mesma cidade. Esses 3 imóveis devem ter 1 única foto, o nome e um dos telefones do contato (o primeiro).

**OBS.:** Assume-se que os imóveis sempre terão ao menos um contato cadastrado e todos os campos de todas entidades estão preenchidos.

**O que deve ser feito:**
Construa o Banco de dados com as tabelas que armazenará todos os dados descritos (Imóvel e Contato), bem como todas as tabelas auxiliares que forem necessárias.

Construa uma página que exiba um imóvel, conforme os dados que foram pedidos, e mais outros 3 imóveis da mesma cidade.

**Instruções:**
Para essa questão deve ser entregue um dump do banco (.sql).
