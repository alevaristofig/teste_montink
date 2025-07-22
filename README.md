1 - Docker
É preciso ter o docker e o git instaldo.

Clonar os projetos do repositorios.
Executar o comando docker-compose up -d --build dentro da pasta erp_gerenciamento.

Executar o comando
docker exec -it nome container bash,
composer install
php artisan key:generate
abrir outro console

Na parte do banco pode usar o container ou executar o arquivo banco.sql
docker exec -it laravel-dbmontink bash,

mysql -u root -p
senha: root

dar permissao para o usuario acessar as tabels
GRANT ALL PRIVILEGES ON nome_tabela.* TO 'seu_usuario'@'%' IDENTIFIED BY 'sua_senha';
FLUSH PRIVILEGES;

no terminal do container laravel-montink
php artisan migrate 


no terminal do container laravel-dbmontink bash
criar o usuario
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (1, 'Usuario', 'usuario@email.com.br', NULL, '$2y$12$ylwX5lZozKrYL4F72C75iOnGT0YuWMu4LSrfZUbOSqz9Qpcp.c3q6', NULL, '2025-06-15 16:19:02', '2025-06-15 16:19:04');

2 - Local
Ter o php (qualuqer versão 8, o docker usa o 8.3, wamp ou xamp ), laravel, composer, node e o mariadb instalado na maquina
Clonar os projetos do repositorios.
Entrar no projeto erp_gerenciamento e executar o composer install, php artisan key:generate, php artisan migrate (ou executar o arquivo banco.sql), 
Entrar no projeto erp_gerenciamento_front e executar o npm install



