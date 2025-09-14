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