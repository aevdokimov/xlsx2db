# Тестовое задание: импорт XLSX в БД

Первый запуск:
1. `docker compose up -d`
2. `docker exec import_excel composer install`
2. `docker exec import_excel php artisan migrate`
3. `docker exec -d import_excel cron -f`
4. `docker exec -d import_excel supervisord`

Дальнейший запуск одной коммандой:

`docker compose up -d && docker exec -d import_excel wait-for-it.sh rabbitmq:5672 -- cron -f 
&& docker exec -d import_excel wait-for-it.sh rabbitmq:5672 -- supervisord`