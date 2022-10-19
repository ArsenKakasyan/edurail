# fluent
<h1 align="center">Приложение работает так:</h1>

<h2>Структура:</h2>
<b>Приложение представляет собой кастомный фреймворк по модели MVC, состоящий из директорий:>/b>
 
<ul>
 <li>/controllers (загрузчики статики привязанные к основному контроллеру из core директории)</li>
<li>/core (мозг фреймворка и ядро приложения, содержит основные классы и методы e.g db, app, controller)</li>
<li>/models (представляет собой набор моделей (те же классы) для работы с базой данных mysql.</li>
<li>/views (статика, используется шаблон bootstrapmade)</li>
<li>/public (картинки и прочее для статики, загрузчик приложения)</li>
<li>/thirdparty (в дальнейшем используется для плагинов и интеграции платежных систем)</li>
 </ul>
(model - class подключающийся к бд для упрощения запросов/view - видимая часть страницы/controller - php backend)
каждая таблица бд должна иметь модель и каждая веб-страница должна иметь контроллер.

Для старта нового проекта на данном фреймворке не нужно писать все с нуля, можно использовать наработки (core директория), 
файлы в остальных директориях придется переписывать под новую статику и логику, а также соответствующие бд таблицы.

Последовательность загрузки приложения:
Старт с fluent/public/index.php -> переход в core/init.php загружает остальные модули -> приложение запущено
 -> контроллеры загружают остальные страницы -> все красиво работает

(Технологии)
/объектно-ориентированный php
/ajax и json
/mysql CRUD
/xampp (среда для работы сервера)
/bootstrap template for design
/Шаблон проектирования MVC 

(Функционал)
/система регистрации / входа в систему
/управление пользователями и доступом
/панель администратора
/базовая система безопасности
/система обмена сообщениями 
/рейтинговая система
/загрузка видео
/управление контентом
/корзина
/платежная система

(Страницы)
/домашняя
/регистрация
/логин
/просмотр курсов по категориям
/поиск курсов
/просмотр страницы курса
/проигрыватель видео
/рейтинг курса
/мессенджер
/мои курсы(инструктор)
/мои курсы(студент)
/корзина
/список желаний
/оплата
/загрузить курс
/панель инструктора
/профиль
/настройки аккаунта
/публичный профиль инструктора

(Страницы админа)
/все курсы
/все пользователи
/все инструкторы
/подтверждение курсов
/управление рекламой курсов
/управление ролями пользователей
