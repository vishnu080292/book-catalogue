# 📚 Book Catalogue API

A Dockerized PHP + MySQL application with a simple frontend UI for managing books.

This project demonstrates:
- Dockerfile usage
- Docker Compose multi-container setup
- Persistent MySQL volume
- REST API design
- Frontend + Backend integration

---

# 🖥 Prerequisites

You must have:

- Git
- Docker
- Docker Compose (included with modern Docker)

---

# 🐳 Install Docker

## Ubuntu

```bash
sudo apt update
sudo apt install docker.io -y
sudo systemctl start docker
sudo systemctl enable docker

## **Verify installation:**

docker --version

docker compose version

## **If not available:**

sudo apt install docker-compose -y

📥 Clone the Repository
git clone https://github.com/vishnu080292/book-catalogue.git
cd book-catalogue

## 🚀 Build and Run the Application

## From inside the project directory:

docker compose up --build

## 🌐 Access the Application
http://localhost:8080/home.html

🔁 Rebuild After Code Changes

##If you modify:

## Dockerfile
##PHP files
##HTML files

##Run:

docker compose down
docker compose up --build

#Docker Image (Manual Build)
docker build -t book-catalogue .
##Run container manually
docker run -p 8080:80 book-catalogue
📂 Project Structure
book-catalogue/
│
├── Dockerfile
├── docker-compose.yml
├── index.php
├── db.php
├── home.html
├── .htaccess
├── .gitignore
└── README.md

