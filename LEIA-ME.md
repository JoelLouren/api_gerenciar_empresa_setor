

###################################
## SISTEMA AVALIATIVO "Sua Empresa"
###################################


PHP 8.2.0 +
Laravel 10
MySQL
Sistema operacional Windows


"Sua Empresa" foi desenvolvido com base em dois (2) pequenos projetos, um para o back-end e outro para o front-end.

Back-end: PHP Laravel.
Front-end: Html, css, bootstrap, javascript, Ajax e jQuery.
Interface: API Rest full.



*****************
## HAMBIENTE DEV
*****************

Virtal Hosts serão configurados para uso de links e variaveis globais (BASE_URL e BASE_URL_API).

CONFIGURAR VHOSTS WINDOWS:

Adicionar no arquivo [hosts], encontrado no caminho:
C:\Windows\System32\drivers\etc
Os hosts:
127.0.0.1 suaempresa.com
127.0.0.1 apigerenciar.com

suaempresa.com é o host do front-end.
apigerenciar.com é o host do back-end.


CONFIGURAR VHOSTS APACHE:

Também adicione os hosts em seu servidor apache. No desenvolvimento usou-se do xampp com PHP 8.2.0.

Se o xampp foi instalado na raiz do sistema, o arquivo [httpd-vhosts.conf] se encontra no caminho:
C:\xampp\apache\conf\extra

O modelo de configuração é este para a adição do host, e pode ter que ser adaptado dependendo da versão instalada:

<VirtualHost *:80>
    ServerAdmin emailficticio@gmail.com
    DocumentRoot "C:\Users\user\Desktop\gerenciar\app"
    ServerName suaempresa.com
    <Directory "C:\Users\user\Desktop\gerenciar\app">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

<VirtualHost *:80>
    ServerAdmin emailficticio@gmail.com
    DocumentRoot "C:\Users\user\Desktop\gerenciar\api_gerenciar_empresas\public"
    ServerName apigerenciar.com
    <Directory "C:\Users\user\Desktop\gerenciar\api_gerenciar_empresas\public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

ServerName é o host e DocumentRoot o caminho do projeto.
Agora é só abrir seu navegador e acessar: <suaempresa.com>



*****************
## BASE DE DADOS
*****************

Subir a base de dados através da MIGRATION do Laravel:
No terminal do prompt de comando do windows, aberto dentro do diretório do projeto "api_gerenciar_empresa",
ou com o projeto aberto em um editor de texto que tenha a ferramenta de abrir um terminal de linha de comando
como o Visual Studio Code, você pode executar o comando "php artisan migrate" para criar o banco de dados e suas tabelas.

Caso queira popular as tabelas com alguns registros, há Seeders para cada uma delas e você pode fazer isso
rodando o comando "php artisan db:seed --class='Nome_da_classe_da_seeder'" para cada tabela. Por exemplo rodar a seeder da tabela "empresa":
php artisan db:seed --class=EmpresaSeeder

CLASSES SEEDERS:

EmpresaSeeder
SetorSeeder
EmpresaSetorSeeder

Obs: "EmpresaSetorSeeder" deve rodar por ultimo, dependência de relacionamentos.



*****************
## TELAS E CRUDS
*****************

No sidebar temos o bloco de "INTERFACE" contendo as caixas: Empresa, Setor e Relatório.
Na "Empresa" temos as telas: listar empresas e cadastrar empresa.
No "Setor" temos as telas: listar setores e cadastrar setor.
Na "Relatório" temos a tela: Relatório empresa/setor.

Telas de cadastros: cadastros, podem ser acessados pela sidebar ou pelo botão de adicionar registro acima da grid de listagem da
respectiva entidade.

Tela Listar Empresas:
DataGrid com lista de registros de empresas. A grid pode ser filtrada por qualquer termo no input "search" da datagrid, assim como ordenada
por qualquer coluna, de forma crescente ou decrescente, bem como ser configurada a quantidade de registros por paginação da grid.
Na ultima coluna da direita, temos os botões de editar, excluir, e adicionar um setor para a empresa. 
Ao excluir uma empresa, quaquer registro que houver na tabela intermediaria atrelado a esta empresa será excluido em modo cascata.
A tela que adiciona um setor para empresa traz os setores que ainda não foram atrelados a empresa em questão para que não induza o usuário
a tentar adicionar um setor que já faz parte da empresa,bem como se a empresa já estiver relacionamento com todos os setores do banco de dados,
uma modal irá informar a situação.

Tela Listar Setores:
Mesma coisa que a tela de listar empresas, mas com apenas os botões de editar e excluir. Ao excluir um setor, quaquer registro
que houver na tabela intermediaria relacionado a este setor será excluido em modo cascata.

Tela Relatório empresa/setor:
DataGrid com a relação de empresas e seus setores. Assim como na grid anterior qualquer filtro pode ser aplicado, como empresa, setor, o 'id' de algum
deles. Basta digitar no campo 'search' da grid. O mesmo é valido para a ordenação de colunas na ordem crescente ou decrescente e a configuração
de quantidade de registros por paginação da grid.
Na ultima coluna da direita temos os botões de editar e excluir. 
Na tela de edição só teremos os setores que ainda não faz parte da empresa em questão para que não induza o usuário a tentar atualizar para um setor que já faz parte da empresa, e caso todos os setores do banco de dados
já estiverem atrelados a esta empresa, uma modal irá informar a situação.

