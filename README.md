# praha_test

Задача:

Разработать веб-приложение для розыгрыша призов. После аутентификации пользователь может
нажать на кнопку и получить случайный приз. Призы бывают 3х типов: денежный (случайная сумма в
интервале), бонусные баллы (случайная сумма в интервале), физический предмет (случайный предмет из
списка).

Денежный приз может быть перечислен на счет пользователя в банке (HTTP запрос к API банка), баллы
зачислены на счет лояльности в приложении, предмет отправлен по почте (вручную работником).
Денежный приз может конвертироваться в баллы лояльности с учетом коэффициента. От приза можно
отказаться. Деньги и предметы ограничены, баллы лояльности нет. 



Папки и файлы:

/sql/db_structure.txt   - Описание структуры БД
/sql/db_structure.sql   - Исполняемый sql файл для создания структуры БД

/cfg                    - папка должна быть размещена на уровень выше папки проекта: ../cfg
../cfg/db_config.php    - конфигурационный файл для доступа к БД

Структура проекта:

 - tws_functions.php        - все необходимые функции

 - index.php                - Форма авторизации
 - tws_auth.php             - Авторизация

 - tws_registration.php         - Форма регистрации нового пользователя
 - tws_registration_exec.php    - Регистрация нового пользователя

 - tws_get_prize.php        - приглашение получить приз
 - tws_get_prize_exec.php   - выбор случайного приза
 - tws_show_results.php     - показать выигрыш

 - tws_send_good.php        - форма для получение предмета (имя, адрес)
 - tws_send_good_exec.php   - отправка предмета
 - tws_reject_good.php      - отказ от предмета

 - tws_send_money.php       - форма для поучения денег (банковский счет и пр.)
 - tws_send_money_exec.php  - отправка денег. Не сделано
 - tws_reject_money.php     - взять баллы вместо денег

 - tws_send_points.php      - зачисление баллов

 - tws_final_page.php       - финальная страница

Развертывание:

   - Развернуть БД путем запуска '/sql/db_structure.sql'
   - создать папку проекта
   - уровнем выше создать папку 'cfg'
   - в папку ../cfg/ скопировать файл  '/cfg/db_config.php'
   - php файлы скопировать в папку проекта

Доделать:

- перевод денег
- развернуть Докер
- юнит тесты
