# Testowy projekt dla Ostendi

### Instalacja
```
composer install
```

```
cp .env.example .env
```

```
./vendor/bin/sail up -d
```

```
./vendor/bin/sail php artisan key:generate
```

```
./vendor/bin/sail php artisan test
```

```
./vendor/bin/sail php artisan migrate:fresh --seed
```

## Informacje
Dokumentację użycia stworzonego, testowego routingu znajdziemy tutaj:
http://localhost/api/documentation#/Goal%20Evaluations

Wymaga on jednak autoryzacji użytkownika.
Seeder tworzy jednego użytkownika w bazie.
By otrzymać klucz Sanctum użyj komendy:
```
./vendor/bin/sail php artisan app:get-admin-token 
```
Następnie wpisz go w nagłowek Authorization: Bearer TUTAJ_TOKEN jeśli korzystasz np z postmana, lub podaj go bezpośrednio w autoryzacji swagger.

#### Główny seeder generuje 10 pracowniów i 30 zadań, co oznacza, że goal_id musi być w zakresie 1-30 a employee_id 1-10

### Uwaga
Możemy stworzyć stworzyć jeden log zapisu postępu pracy dla tego samego goal_id i employee_id. Jeśli zrobimy to drugi raz rekord zostanie nadpisany  i zostanie ustawiny nowy progress.
