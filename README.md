# Teste de PHP

Utilizado o template Bootstrap Grid para facilitar a apresentação do frontend.
Aplicação com padrão MVC desenvolvida inteiramente para o teste.
Na pasta app/config estão os arquivos responsáveis pelo funcionamento da aplicação.


# Antes de executar #
- Alterar $config['base'] no arquivo app/config/config.php
- Alterar o RewriteBase do arquivo .htaccess 

# Banco de Dados #
No arquivo app/config/database.php devem ser inseridos os dados de acesso do banco de dados.

# Rotas #
Devido o curto prazo e não haver necessidade para o teste, as rotas aceitam apenas o terceiro item da uri como parâmetro quando necessário

# MENU #
Os itens do menu podem ser editados no arquivo app/config/menu.php.
A função que gera o html para o menu está no arquivo app/core/controller
