# Laravel Modular – Command Interfaces for domain-driven-design DDD

`ammardaana/laravel-domain-driven-design` provides **command interfaces and handlers** to organize your Laravel applications using **Domain-Driven Design (DDD)** and a **modular architecture**.

## Installation

```bash
  composer require ammardaana/laravel-domain-driven-design
```

## Features

* ✅ Command & CommandHandler interfaces
* ✅ Clear separation of concerns in your domain layer
* ✅ Works seamlessly with Laravel service container & command bus
* ✅ Designed for modular and DDD-based applications
* ✅ Lightweight and framework-friendly

## Available Commands

This package provides the following artisan commands to generate domain-driven components:

### Domain Management
```bash
php artisan make:domain {--name=}
```

### Core Components
```bash
# Generate a Service class
php artisan make:service {--domain=} {--name=}

# Generate an Action class
php artisan make:action {--domain=} {--name=}

# Generate a DTO (Data Transfer Object) class
php artisan make:dto {--domain=} {--name=}

# Generate an Enum class
php artisan make:enum {--domain=} {--name=}

# Generate a Model class
php artisan make:model {--domain=} {--name=} {--with-resources=}
```

### HTTP Layer
```bash
# Generate a Controller class
php artisan make:controller {--domain=} {--name=}

# Generate a Request class
php artisan make:request {--domain=} {--name=}

# Generate a Resource class
php artisan make:resource {--domain=} {--name=}

# Generate a Middleware class
php artisan make:middleware {--domain=} {--name=}
```

### Business Logic & Validation
```bash
# Generate a Rule class
php artisan make:rule {--domain=} {--name=}

# Generate a Facade class
php artisan make:facade {--domain=} {--name=}
```

### Events & Jobs
```bash
# Generate an Event class
php artisan make:event {--domain=} {--name=}

# Generate a Listener class
php artisan make:listener {--domain=} {--name=}

# Generate a Console Job class
php artisan make:console-job {--domain=} {--name=}
```

All commands support optional `--domain` and `--name` flags. If not provided, you'll be prompted interactively.

## Usage

### 1. Create a Command

```php
class GenerateActionCommand extends Command
{
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
        $this->namespacePostfix = 'Actions';
        $this->type = 'Action';
    }
}
```

## Output Structure

```
app/
 └── Domain/
      ├── Authentication/
      │    ├── Actions/
      │    │     └── LoginAction.php
      │    ├── Enums/
      │    │     └── UserStatusEnum.php
      │    └── Http/
      │          └── Controllers
      │          └── Requests
      │          └── Resources
      │          └── Models
      │          └── Services
      |
      └── PurchaseFlow/
```

---

## Integration Ideas

* Use with **Laravel Bus** for async handling
* Plug into **CQRS** setups for separation of reads & writes
* Add **middlewares** for validation, logging, or transactions

---

## License

This package is released under the [MIT License](LICENSE).

---