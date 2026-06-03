<div align="center">

# Student — CRUD de Estudantes

**Sistema de gestão de estudantes construído com Laravel 13**

[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)
[![SQLite](https://img.shields.io/badge/SQLite-003B57?style=for-the-badge&logo=sqlite&logoColor=white)](https://sqlite.org)

<br/>

> Aplicação web completa para **criar, visualizar, editar e eliminar** registos de estudantes,
> com interface dark moderna, modais interactivos e validação de dados.

</div>

---

## Visão Geral

O **StudentHub** é uma aplicação CRUD completa desenvolvida em **Laravel 13** que permite gerir registos de estudantes de forma simples e eficiente. A interface foi desenhada com foco em usabilidade, utilizando um tema dark moderno com Bootstrap 5 e ícones intuitivos.

O projecto segue a arquitectura **MVC** do Laravel, com rotas RESTful, validação robusta e paginação integrada.

---

## Funcionalidades

| Funcionalidade | Descrição |
|---|---|
|  **Adicionar Estudante** | Modal inline na página de listagem, sem redireccionar |
|  **Ver Detalhes** | Modal com informação completa do estudante |
|  **Editar Estudante** | Formulário dedicado com dados pré-preenchidos |
|  **Eliminar Estudante** | Confirmação via modal antes de eliminar |
|  **Validação** | Validação server-side com mensagens de erro inline |
|  **Paginação** | 7 registos por página com navegação |
|  **Notificações** | Alertas de sucesso após cada operação |
|  **Responsivo** | Layout adaptado para mobile e desktop |

---

## Tecnologias

### Back-end
- **[Laravel 13](https://laravel.com/docs/13.x)** — Framework PHP
- **PHP 8.2+** — Linguagem principal
- **[Eloquent ORM](https://laravel.com/docs/13.x/eloquent)** — Mapeamento objecto-relacional
- **SQLite** — Base de dados (configurável para MySQL/PostgreSQL)

### Front-end
- **[Bootstrap 5.3](https://getbootstrap.com)** — Framework CSS
- **[Bootstrap Icons 1.11](https://icons.getbootstrap.com)** — Biblioteca de ícones
- **[Google Fonts — Inter](https://fonts.google.com/specimen/Inter)** — Tipografia
- **JavaScript Vanilla** — Lógica dos modais e interacções
- **CSS Variables** — Sistema de temas personalizado

### Ferramentas
- **[Vite](https://vitejs.dev)** — Bundler de assets
- **[Composer](https://getcomposer.org)** — Gestor de dependências PHP
- **[npm](https://npmjs.com)** — Gestor de pacotes Node

---

## Pré-requisitos

Certifica-te que tens os seguintes softwares instalados:

- **PHP** `>= 8.2` com extensões: `pdo`, `pdo_sqlite`, `mbstring`, `openssl`, `tokenizer`, `xml`
- **Composer** `>= 2.x`
- **Node.js** `>= 18.x` e **npm** `>= 9.x`
- **Git**

---

## Instalação

### 1. Clonar o repositório

```bash
git clone https://github.com/teu-utilizador/studenthub.git
cd studenthub
```

### 2. Instalar dependências PHP

```bash
composer install
```

### 3. Instalar dependências Node

```bash
npm install
```

### 4. Configurar o ambiente

```bash
# Copiar o ficheiro de ambiente
cp .env.example .env

# Gerar a chave da aplicação
php artisan key:generate
```

### 5. Configurar a base de dados

O projecto usa **SQLite** por padrão. O ficheiro já está em `database/database.sqlite`.

```bash
# Executar as migrações
php artisan migrate
```

> **Opcional — MySQL/PostgreSQL:** Edita o `.env` e define `DB_CONNECTION`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME` e `DB_PASSWORD` com os teus dados.

### 6. Iniciar o servidor

```bash
# Terminal 1 — Servidor Laravel
php artisan serve

# Terminal 2 — Compilar assets (desenvolvimento)
npm run dev
```

Acede à aplicação em: **[http://localhost:8000/students](http://localhost:8000/students)**

---

## Estrutura do Projecto

```
studenthub/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── StudentsController.php   # Controlador principal CRUD
│   └── Models/
│       └── Student.php                  # Modelo Eloquent
│
├── database/
│   ├── migrations/
│   │   └── ..._create_students_table.php
│   └── database.sqlite                  # Base de dados SQLite
│
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php            # Layout principal
│   │   └── students/
│   │       ├── index.blade.php          # Lista + modais (criar, ver, eliminar)
│   │       ├── edit.blade.php           # Formulário de edição
│   │       └── show.blade.php           # Detalhes (vista standalone)
│   ├── css/
│   │   └── app.css
│   └── js/
│       └── app.js
│
└── routes/
    └── web.php                          # Definição de rotas
```

---

## Rotas da Aplicação

| Método | URI | Acção | Descrição |
|--------|-----|-------|-----------|
| `GET` | `/students` | `index` | Lista todos os estudantes |
| `GET` | `/students/create` | `create` | Formulário de criação (redireccionado para modal) |
| `POST` | `/students` | `store` | Guarda um novo estudante |
| `GET` | `/students/{id}` | `show` | Detalhes de um estudante |
| `GET` | `/students/{id}/edit` | `edit` | Formulário de edição |
| `PUT` | `/students/{id}` | `update` | Actualiza um estudante |
| `DELETE` | `/students/{id}` | `destroy` | Elimina um estudante |

---

## Modelo de Dados

### Tabela `students`

| Coluna | Tipo | Restrições |
|--------|------|------------|
| `id` | `BIGINT UNSIGNED` | PK, Auto-increment |
| `name` | `VARCHAR(255)` | Obrigatório, único |
| `email` | `VARCHAR(255)` | Obrigatório, único, formato email |
| `phone` | `VARCHAR(255)` | Obrigatório, único, 9 dígitos |
| `created_at` | `TIMESTAMP` | Automático |
| `updated_at` | `TIMESTAMP` | Automático |

### Regras de validação

```php
'name'  => 'required|string|min:2|max:255'
'email' => 'required|email|unique:students,email'
'phone' => 'required|digits:9|unique:students,phone'
```

---

## Contribuição

Contribuições são bem-vindas! Para contribuir:

1. Faz um **fork** do repositório
2. Cria um **branch** para a tua funcionalidade: `git checkout -b feature/nova-funcionalidade`
3. Faz **commit** das tuas alterações: `git commit -m 'feat: adiciona nova funcionalidade'`
4. Faz **push** para o branch: `git push origin feature/nova-funcionalidade`
5. Abre um **Pull Request**


---

