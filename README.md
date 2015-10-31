# Introdução
Eu criei o meu próprio framework MVC apenas para execução dos testes. 
Eu escolhi fazer assim para mostrar as minhas habilidades em MVC e programação orientada a objetos.

# Configuração
Abra o arquivo config.php e modifique as constantes para refletir as especificidades da sua instalação.
Depois disso importe as tabelas do banco de dados usando o conteúdo do arquivo test_php.sql 
OBS.: você deve fazer a importação dentro de um banco existente (dentro do banco indicado pela constante DB_NAME_DEFAULT)
Acesse a url que você indicou na constante BASE_URL
Você deve ver uma tela com links para executar os testes

# Models
Todos os models ficam dentro da pasta models. Models concretos estendem \Model\Base e implementam funcionalidades específicas.
A classe \Model\Base já faz todo o trabalho de conexão com o banco de dados e construção de queries de INSERT, UPDATE, DELETE e SELECT básico.
Um model por default se conecta a um banco padrão especificado nas constantes dentro de config.php. 
Uma vez que esta conexão default é estabelecida, a mesma fica sendo reaproveita por outros models que também a utilizam.
Mas podem ser usadas outras variáveis de conexão para um model específico: basta implementar o método init e sobrescrever as propriedades relevantes.

# Views
Não foi usado um sistema de template, porque eu pessoalmente acho muito mais simples e até mesmo mais IDE-friendly fazer cada view sendo uma classe do PHP.
Isso me permite, por exemplo, saber quais variaveis são utilizadas pela view bastando escrever $view-> e deixar a IDE sugerir.
Além disso eu posso usar as funções de formatação do php e qualquer outro helper criado por mim mesmo na geração de HTML.
Uma view no meu sistema é então uma classe que estende \Views\Base e implementa o método "render". Este método deve sempre gerar uma saída HTML.
Uma view pode também fazer consultas ao banco de dados. Não é necessariamente o controller que tem de passar os dados para a view.
Então você vai ver queries de consultas sendo construídas na própria view, e não no controller.

# Controller
O controller, ao meu ver, só tem o trabalho de processar requisições e selecionar a(s) view(s) que devem apresentar o resultado de uma ação solicitada.

# Dependências
Todas as dependências são carregadas explicitamente pelo módulo dependente. 
Ao invés de usar autoloaders eu carrego as dependências manualmente, por meio de require_once.
A vantagem disso é que uma classe sempre funciona stand-alone, isto é, você não precisa saber quais as dependências dela nem garantir que um autoloader foi inicializado.
Eu costumo programar os meus códigos assim de maneira a aumentar a possibilidade de reuso de código.

 