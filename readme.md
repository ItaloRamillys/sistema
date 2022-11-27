#Sistema Escolar

Resumo da aplicação: Sistema Escolar. O sistema Sistema Escolar foi pensado para que as escolas possam administrar uma página web e gerenciar a escola em um único sistema. Com nosso painel de controle o administrador pode alterar praticamente tudo da página inicial(Imagens do slide, descrição da escola, textos do slide, imagem principal), além de administrar os conteúdo, acontecimentos e desempenho da escola.

**EXECUTANDO O PROJETO**

Basta ter instalado algum ambiente de simulação de servidor, como o XAMPP, WAMP ou EASYPHP. Habilitar o Apache e o MySQL. Mover a pasta "sistema" para a pasta que o ambiente reconhece como localhost. No caso do XAMPP é a pasta htdocs, do EASYPHP e do WAMP é a www.

**BANCO DE DADOS**

O banco de dados está no arquivo system.sql, na pasta sistema
Basta importar ele por meio do mySql no phpMyAdmin

**INFORMAÇÕES ADICIONAIS**

- MVC
Seguindo um padrão de projeto aprendido na UDEMY, utilizamos o padrão MVC. As views se comunicam com os controllers, que por sua vez envia a requisição e os dados para o model(service) e este retorna um valor booleano mais uma mensagem para finalizar a requisição. A model realiza a criação dos objetos seguindo a estrutura das entidades no Banco de Dados. As classes Service são as responsáveis pela interação com o banco de dados.

- AJAX
Todas as requisições são feitas via AJAX:
View->Ajax.js->Controller->Service->Controller->Ajax.js->View

- Componentes
Todas as views do painel de controle (adm, aluno, professor) são componentes que são chamados por meio da index.php.

- IMAGENS
As imagens estão na pasta img com subpastas (que classificam o tipo da imagem e organiza em outras subpastas por ano/mês): noticia, padrao, sistema, usuario
