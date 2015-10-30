# Introdu��o
Eu criei o meu pr�prio framework MVC apenas para execu��o dos testes. 
Eu escolhi fazer assim para mostrar as minhas habilidades em MVC e programa��o orientada a objetos.

# Configura��o
Abra o arquivo config.php e modifique as constantes para refletir as especificidades da sua instala��o.
Depois disso importe as tabelas do banco de dados usando o conte�do do arquivo test_php.sql 
OBS.: voc� deve fazer a importa��o dentro de um banco existente (dentro do banco indicado pela constante DB_NAME_DEFAULT)
Acesse a url que voc� indicou na constante BASE_URL
Voc� deve ver uma tela com links para executar os testes

# Models
Todos os models ficam dentro da pasta models. Models concretos estendem \Model\Base e implementam funcionalidades espec�ficas.
A classe \Model\Base j� faz todo o trabalho de conex�o com o banco de dados e constru��o de queries de INSERT, UPDATE, DELETE e SELECT b�sico.
Um model por default se conecta a um banco padr�o especificado nas constantes dentro de config.php. 
Uma vez que esta conex�o default � estabelecida, a mesma fica sendo reaproveita por outros models que tamb�m a utilizam.
Mas podem ser usadas outras vari�veis de conex�o para um model espec�fico: basta implementar o m�todo init e sobrescrever as propriedades relevantes.

# Views
N�o foi usado um sistema de template, porque eu pessoalmente acho muito mais simples e at� mesmo mais IDE-friendly fazer cada view sendo uma classe do PHP.
Isso me permite, por exemplo, saber quais variaveis s�o utilizadas pela view bastando escrever $view-> e deixar a IDE sugerir.
Al�m disso eu posso usar as fun��es de formata��o do php e qualquer outro helper criado por mim mesmo na gera��o de HTML.
Uma view no meu sistema � ent�o uma classe que estende \Views\Base e implementa o m�todo "render". Este m�todo deve sempre gerar uma sa�da HTML.
Uma view pode tamb�m fazer consultas ao banco de dados. N�o � necessariamente o controller que tem de passar os dados para a view.
Ent�o voc� vai ver queries de consultas sendo constru�das na pr�pria view, e n�o no controller.

# Controller
O controller, ao meu ver, s� tem o trabalho de processar requisi��es e selecionar a(s) view(s) que devem apresentar o resultado de uma a��o solicitada.

# Depend�ncias
Todas as depend�ncias s�o carregadas explicitamente pelo m�dulo dependente. 
Ao inv�s de usar autoloaders eu carrego as depend�ncias manualmente, por meio de require_once.
A vantagem disso � que uma classe sempre funciona stand-alone, isto �, voc� n�o precisa saber quais as depend�ncias dela nem garantir que um autoloader foi inicializado.
Eu costumo programar os meus c�digos assim de maneira a aumentar a possibilidade de reuso de c�digo.

 