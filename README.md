# 🛍️ Colecione Brinquedos — API

API REST de um e-commerce de brinquedos educativos infantis, desenvolvida como projeto de portfólio.

> "Diversão que ensina"

---

## 🚀 Tecnologias

- Laravel 13 (PHP)
- MySQL
- Laravel Sanctum

---

## ✨ Funcionalidades

- Autenticação com token (register, login, logout)
- CRUD de categorias e subcategorias
- CRUD de produtos com slug automático
- Gerenciamento de endereços por usuário
- Criação e listagem de pedidos
- Rotas públicas e protegidas

---

## 🔧 Como rodar localmente

```bash
git clone https://github.com/carolinerener/colecione-brinquedos-api.git
cd colecione-brinquedos-api
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

> Configure o `.env` com seu banco de dados MySQL e defina `DB_DATABASE=colecione_brinquedos`

---

## 🔗 Front-end

 [colecione-brinquedos-front](https://github.com/carolinerener/colecione-brinquedos-front)
