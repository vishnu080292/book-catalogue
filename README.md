# 📚 Book Catalogue API

A Dockerized PHP + MySQL REST API with a simple frontend UI for managing books.

Built as a multi-container application using Docker Compose.

---

## 🚀 Features

- Add new books
- View all books
- Delete books
- Persistent MySQL storage
- Dockerized architecture
- RESTful API design
- Clean UI with dynamic rendering

---

## 🏗 Architecture

Browser
↓
Apache (PHP Container)
↓
MySQL Container
↓
Docker Volume (Persistent Storage)


### Containers

- `app` → PHP 8.3 + Apache
- `db` → MySQL 8.0
- `db_data` → Named Docker volume

---

## 🐳 Docker Setup

### Build and Run

```bash
docker compose up --build


Access app:

http://localhost:8080/home.html

Stop Containers
docker compose down

Stop and Remove Database Data
docker compose down -v

📦 API Endpoints
Health Check
GET /health


Response:

{ "status": "ok" }

Get All Books
GET /books

Add Book
POST /books


Body:

{
  "title": "Clean Code",
  "author": "Robert C. Martin"
}

Delete Book
DELETE /books/{id}

💾 Persistence

Database data is stored using a Docker named volume:

db_data
