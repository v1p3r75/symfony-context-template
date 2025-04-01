# Symfony Bounded Context Template

This repository provides a Symfony project template structured around the **Bounded Context** concept, offering a modular organization without strict adherence to Clean Architecture. The project structure allows better separation of business logic while still leveraging Symfony's built-in Doctrine entities, repositories, and other components.

## 🚀 Features

- **Bounded Context Architecture** for better modularity
- **Domain logic organized by context**
- **UseCase directory** in each domain to encapsulate business logic and related DTOs
- **Infrastructure layer for controllers, commands, and external integrations**

## 📂 Project Structure

```
project-root/
│── src/
│   ├── Domain/
│   │   ├── Shared/        # Shared domain logic (Value Objects, Domain Events, etc.)
│   │   ├── User/          # User context
│   │   │   ├── Entity/    # Doctrine entities
│   │   │   ├── Repository/ # Doctrine repositories
│   │   │   ├── Service/
│   │   │   ├── UseCase/   # Business use cases and DTOs
│   │   ├── Order/         # Order context
│   │   │   ├── Entity/
│   │   │   ├── Repository/
│   │   │   ├── Service/
│   │   │   ├── UseCase/   # Business use cases and DTOs
│   ├── Infrastructure/    # Controllers, Commands, and external services
│── config/
│── migrations/
│── tests/
│── composer.json
│── .env
```

## 🛠️ Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/v1p3r75/symfony-context-template.git
   cd symfony-context-template
   ```

2. **Install dependencies:**
   ```bash
   composer install
   ```

3. **Configure the environment:**
   ```bash
   cp .env.example .env
   ```

4. **Run database migrations:**
   ```bash
   php bin/console doctrine:migrations:migrate
   ```

5. **Start the Symfony server:**
   ```bash
   symfony serve
   ```

## 📌 Usage Guidelines

- Define your **Bounded Contexts** within the `Domain/` directory.
- Use the `Shared/` subdirectory to store reusable domain logic.
- Implement Doctrine entities and repositories within each domain context.
- Encapsulate business logic within the `UseCase/` directory in each domain.
- Keep controllers, commands, and external services inside the `Infrastructure/` folder.

### ✨ Contributions

Contributions are welcome! Feel free to submit issues or pull requests to improve this template.

---

🔹 **Author:** Fortunatus KIDJE (v1p3r75) 

🔹 **GitHub:** https://github.com/v1p3r75

