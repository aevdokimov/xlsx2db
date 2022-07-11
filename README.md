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

## Задание:
Laravel (Docker, Laravel echo, redis, mariadb)
Развернуть laravel в docker с установкой laravel cron и сервером очередей rabbitmq
1. Реализовать контроллер с валидацией и загрузкой excel файла
2. Загруженный файл через jobs поэтапно (по 1000 строк) парсить в бд (таблица rows)
3. Прогресс парсинга файла хранить в redis (уникальный ключ + количество обработанных строк)
4. Поля excel: 
   * id
   * name
   * date (d.m.Y)
5. Для парсинга excel можете использовать maatwebsite/excel
6. Реализовать контроллер для вывода данных (rows) с группировкой по date - двумерный массив
7. Будет плюсом если вы реализуете через laravel echo передачу event-а на создание записи в rows
8. Написать тесты

Пример файла: https://disk.yandex.ru/i/J_1cCAwLNuX4uA
