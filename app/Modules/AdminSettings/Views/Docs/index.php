<?= $this->extend('layouts/main') ?>

<?= $this->section('headerContentModule') ?>
<?= view('partials/headerContent', [
    'title' => '',
    'breadcrumb' => []
]) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-3">
        <div class="card card-outline card-primary sticky-top" style="top: 15px;">
            <div class="card-header">
                <h3 class="card-title">Документация</h3>
            </div>

            <div class="card-body p-2">
                <nav class="nav nav-pills flex-column">
                    <a class="nav-link" href="#overview">1. О проекте</a>
                    <a class="nav-link" href="#architecture">2. Архитектура</a>
                    <a class="nav-link" href="#modules">3. Модули</a>
                    <a class="nav-link" href="#controllers">4. Controllers</a>
                    <a class="nav-link" href="#services">5. Services</a>
                    <a class="nav-link" href="#repositories">6. Repositories</a>
                    <a class="nav-link" href="#attributes">7. Attributes</a>
                    <a class="nav-link" href="#scanners">8. Scanners</a>
                    <a class="nav-link" href="#auth">9. Auth</a>
                    <a class="nav-link" href="#routing">10. Routing</a>
                    <a class="nav-link" href="#htmx">11. HTMX</a>
                    <a class="nav-link" href="#views">12. Views / AdminLTE</a>
                    <a class="nav-link" href="#database">13. Database</a>
                    <a class="nav-link" href="#security">14. Security</a>
                    <a class="nav-link" href="#commands">15. CLI Commands</a>
                    <a class="nav-link" href="#new-module">16. Новый модуль</a>
                    <a class="nav-link" href="#new-feature">17. Новая функция</a>
                    <a class="nav-link" href="#rules">18. Правила разработки</a>
                    <a class="nav-link" href="#roadmap">19. Roadmap</a>
                    <a class="nav-link" href="#future">20. Будущие идеи</a>
                    <a class="nav-link" href="#technical-debt">21. Technical Debt</a>
                    <a class="nav-link" href="#troubleshooting">22. Troubleshooting</a>
                    <a class="nav-link" href="#decisions">23. Архитектурные решения</a>
                </nav>
            </div>
        </div>
    </div>

    <div class="col-lg-9">

        <!-- OVERVIEW -->
        <section id="overview" class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">1. О проекте</h3>
            </div>

            <div class="card-body">
                <h4>EuroCargo ERP</h4>

                <p>
                    EuroCargo — модульная ERP-система для управления логистической
                    компанией, грузами, клиентами, сотрудниками, складом,
                    бухгалтерией, таможенными операциями и документами.
                </p>

                <h5>Технологический стек</h5>

                <ul>
                    <li>PHP</li>
                    <li>CodeIgniter 4</li>
                    <li>MySQL</li>
                    <li>AdminLTE</li>
                    <li>Bootstrap</li>
                    <li>HTMX</li>
                    <li>JavaScript</li>
                </ul>

                <h5>Основной принцип</h5>

                <p>
                    Приложение строится как набор независимых функциональных
                    модулей. Каждый модуль должен быть максимально изолирован
                    и взаимодействовать с другими частями системы через
                    определённые слои.
                </p>
            </div>
        </section>

        <!-- ARCHITECTURE -->
        <section id="architecture" class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">2. Архитектура</h3>
            </div>

            <div class="card-body">

                <h5>Основной поток</h5>

                <pre><code>HTTP Request
     ↓
Route
     ↓
Filter
     ↓
Controller
     ↓
Service
     ↓
Repository
     ↓
Model / Entity
     ↓
Database</code></pre>

                <h5>Ответ</h5>

                <pre><code>Database
    ↓
Repository
    ↓
Service
    ↓
Controller
    ↓
View / HTMX / JSON
    ↓
HTTP Response</code></pre>

                <h5>Ответственность слоёв</h5>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Слой</th>
                                <th>Назначение</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Route</td>
                                <td>Определяет URL и Controller</td>
                            </tr>
                            <tr>
                                <td>Filter</td>
                                <td>Авторизация и предварительные проверки</td>
                            </tr>
                            <tr>
                                <td>Controller</td>
                                <td>HTTP-логика</td>
                            </tr>
                            <tr>
                                <td>Service</td>
                                <td>Бизнес-логика</td>
                            </tr>
                            <tr>
                                <td>Repository</td>
                                <td>Получение и изменение данных</td>
                            </tr>
                            <tr>
                                <td>Model</td>
                                <td>Работа с таблицей/данными</td>
                            </tr>
                            <tr>
                                <td>Entity</td>
                                <td>Объектное представление сущности</td>
                            </tr>
                            <tr>
                                <td>View</td>
                                <td>Пользовательский интерфейс</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="alert alert-warning">
                    <strong>Важно:</strong>
                    Controller не должен содержать бизнес-логику и сложные
                    запросы к базе данных.
                </div>
            </div>
        </section>

        <!-- MODULES -->
        <section id="modules" class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">3. Модули</h3>
            </div>

            <div class="card-body">

                <p>
                    Основная функциональность приложения расположена в
                    <code>app/Modules</code>.
                </p>

                <h5>Текущая концепция</h5>

                <pre><code>app/Modules/
├── Accounting/
├── AdminSettings/
├── Auth/
├── Cargo/
├── Dashboard/
├── Employees/
├── Tests/
└── Users/</code></pre>

                <h5>Типичная структура модуля</h5>

                <pre><code>Module/
├── Config/
│   ├── Routes.php
│   └── Services.php
├── Controllers/
├── Services/
├── Repositories/
├── Models/
├── Entities/
└── Views/</code></pre>

                <h5>Версия модуля</h5>

                <p>
                    Модуль может иметь собственную версию, например:
                </p>

                <pre><code>Accounting
    version: ver1</code></pre>

                <p>
                    Это позволяет развивать отдельные модули независимо
                    и в будущем поддерживать несколько версий функциональности.
                </p>
            </div>
        </section>

        <!-- CONTROLLERS -->
        <section id="controllers" class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">4. Controllers</h3>
            </div>

            <div class="card-body">

                <p>
                    Controller является входной точкой HTTP-запроса.
                </p>

                <h5>Controller должен</h5>

                <ul>
                    <li>получить Request;</li>
                    <li>получить данные формы;</li>
                    <li>провести HTTP-level validation;</li>
                    <li>вызвать Service;</li>
                    <li>вернуть View, HTMX response или JSON.</li>
                </ul>

                <h5>Controller не должен</h5>

                <ul>
                    <li>содержать SQL;</li>
                    <li>непосредственно работать с таблицами;</li>
                    <li>содержать сложную бизнес-логику;</li>
                    <li>самостоятельно управлять несколькими слоями приложения.</li>
                </ul>

                <pre><code>public function create()
{
    $data = $this->request->getPost();

    $this->userService->create($data);

    return redirect()->back();
}</code></pre>
            </div>
        </section>

        <!-- SERVICES -->
        <section id="services" class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">5. Services</h3>
            </div>

            <div class="card-body">

                <p>
                    Service является основным слоем бизнес-логики.
                </p>

                <pre><code>Controller
     ↓
UserService
     ├── UserRepository
     ├── PermissionRepository
     └── RoleService</code></pre>

                <h5>Dependency Injection</h5>

                <pre><code>class UserService
{
    public function __construct(
        private UserRepository $userRepository,
        private PermissionRepository $permissionRepository
    ) {}
}</code></pre>

                <p>
                    Service не должен заниматься отображением HTML.
                    Его задача — выполнить бизнес-операцию и вернуть результат.
                </p>

                <h5>Регистрация Services</h5>

                <p>
                    Каждый модуль может иметь собственный
                    <code>Config/Services.php</code>.
                </p>

                <p>
                    Центральный <code>app/Config/Services.php</code>
                    формируется автоматически сканером.
                </p>
            </div>
        </section>

        <!-- REPOSITORIES -->
        <section id="repositories" class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">6. Repositories</h3>
            </div>

            <div class="card-body">

                <p>
                    Repository отвечает за получение и изменение данных.
                </p>

                <pre><code>UserService
     ↓
UserRepository
     ↓
UserModel
     ↓
users</code></pre>

                <p>
                    Если бизнес-операция требует нескольких источников данных,
                    Service может использовать несколько Repository.
                </p>

                <pre><code>AccountingService
    ├── InvoiceRepository
    ├── CustomerRepository
    └── PaymentRepository</code></pre>

                <div class="alert alert-info">
                    Repository отвечает на вопрос
                    <strong>«как получить данные?»</strong>,
                    а Service — на вопрос
                    <strong>«что сделать с этими данными?»</strong>.
                </div>
            </div>
        </section>

        <!-- ATTRIBUTES -->
        <section id="attributes" class="card card-outline card-warning">
            <div class="card-header">
                <h3 class="card-title">7. PHP Attributes</h3>
            </div>

            <div class="card-body">

                <p>
                    Attributes используются как декларативное описание
                    функциональности приложения.
                </p>

                <pre><code>#[Module('accounting', 'ver1')]
#[Permission('view')]
#[Menu('Бухгалтерия')]
public function index()
{
    //
}</code></pre>

                <h5>Источник истины</h5>

                <pre><code>PHP Code
    ↓
Attributes
    ↓
Scanner
    ↓
Database
    ↓
Application</code></pre>

                <div class="alert alert-danger">
                    Меню, permissions и метаданные модулей не должны
                    вручную поддерживаться в базе как основной источник истины.
                </div>
            </div>
        </section>

        <!-- SCANNERS -->
        <section id="scanners" class="card card-outline card-warning">
            <div class="card-header">
                <h3 class="card-title">8. Scanners</h3>
            </div>

            <div class="card-body">

                <p>
                    Scanner автоматически анализирует структуру приложения
                    и синхронизирует системные данные.
                </p>

                <h5>Планируемая архитектура Scanner</h5>

                <pre><code>Application Scanner
│
├── Module Scanner
├── Controller Scanner
├── Service Scanner
├── Repository Scanner
├── Permission Scanner
├── Menu Scanner
└── Route Scanner</code></pre>

                <h5>Главная идея</h5>

                <pre><code>Developer writes code
        ↓
Attributes
        ↓
Scanner
        ↓
Database metadata
        ↓
Application</code></pre>

                <p>
                    В будущем желательно иметь единую команду:
                </p>

                <pre><code>php spark app:scan</code></pre>
            </div>
        </section>

        <!-- AUTH -->
        <section id="auth" class="card card-outline card-danger">
            <div class="card-header">
                <h3 class="card-title">9. Auth</h3>
            </div>

            <div class="card-body">

                <h5>Основная модель доступа</h5>

                <pre><code>User
  ↓
Role
  ↓
Permissions</code></pre>

                <h5>Проверка разрешения</h5>

                <pre><code>$permissionService->can(
    $userId,
    'cargo.view'
);</code></pre>

                <h5>Super Admin</h5>

                <p>
                    Super Admin имеет полный доступ к системе.
                    Проверка Super Admin выполняется до обычной проверки
                    permissions.
                </p>

                <h5>Текущий подход</h5>

                <p>
                    Один пользователь имеет одну основную роль.
                    Такой подход выбран из-за небольшого количества пользователей
                    в компании и упрощает систему управления доступом.
                </p>
            </div>
        </section>

        <!-- ROUTING -->
        <section id="routing" class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title">10. Routing</h3>
            </div>

            <div class="card-body">

                <p>
                    Маршруты группируются по функциональным разделам и модулям.
                </p>

                <pre><code>$routes->group('admin/settings', [
    'namespace' => 'App\Modules\AdminSettings\Controllers',
    'filter' => 'auth'
], static function ($routes) {
    $routes->get('documentation', 'Documentation::index', [
        'as' => 'admin_settings.documentation'
    ]);
});</code></pre>

                <h5>Правила</h5>

                <ul>
                    <li>использовать именованные routes;</li>
                    <li>использовать route groups;</li>
                    <li>ограничивать административные разделы фильтрами;</li>
                    <li>не смешивать маршруты разных модулей без необходимости.</li>
                </ul>
            </div>
        </section>

        <!-- HTMX -->
        <section id="htmx" class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">11. HTMX</h3>
            </div>

            <div class="card-body">

                <p>
                    HTMX используется для динамического взаимодействия
                    интерфейса с сервером без полной перезагрузки страницы.
                </p>

                <pre><code>&lt;button
    hx-post="/users/create"
    hx-target="#user-message"
    hx-swap="innerHTML"&gt;
    Создать
&lt;/button&gt;</code></pre>

                <h5>Toast</h5>

                <p>
                    Сервер может передавать уведомления через
                    <code>HX-Trigger</code>.
                </p>

                <pre><code>HX-Trigger:
{
    "toast": {
        "type": "success",
        "title": "Готово",
        "message": "Пользователь создан"
    }
}</code></pre>

                <h5>CSRF</h5>

                <p>
                    После HTMX-запросов необходимо поддерживать актуальный
                    CSRF-токен в формах.
                </p>
            </div>
        </section>

        <!-- VIEWS -->
        <section id="views" class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">12. Views / AdminLTE</h3>
            </div>

            <div class="card-body">

                <p>
                    UI построен поверх AdminLTE и Bootstrap.
                </p>

                <pre><code>layouts/main
    ├── header
    ├── sidebar
    ├── content
    └── footer</code></pre>

                <h5>Module View</h5>

                <p>
                    Module Controller использует общий механизм
                    отображения module views.
                </p>

                <pre><code>Controller
    ↓
viewModule()
    ↓
Module View
    ↓
layouts/main</code></pre>
            </div>
        </section>

        <!-- DATABASE -->
        <section id="database" class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">13. Database</h3>
            </div>

            <div class="card-body">

                <p>
                    Основная СУБД проекта — MySQL.
                </p>

                <h5>Принцип доступа</h5>

                <pre><code>Service
    ↓
Repository
    ↓
Model
    ↓
MySQL</code></pre>

                <h5>Правила</h5>

                <ul>
                    <li>структура БД должна быть версионируемой;</li>
                    <li>изменения схемы выполнять через migrations;</li>
                    <li>начальные данные — через seeders или CLI;</li>
                    <li>SQL не должен расползаться по Controllers.</li>
                </ul>
            </div>
        </section>

        <!-- SECURITY -->
        <section id="security" class="card card-outline card-danger">
            <div class="card-header">
                <h3 class="card-title">14. Security</h3>
            </div>

            <div class="card-body">

                <ul>
                    <li>Authentication через Auth.</li>
                    <li>Authorization через Roles и Permissions.</li>
                    <li>CSRF-защита HTTP-форм.</li>
                    <li>Пароли только в виде хеша.</li>
                    <li>Секреты не хранятся в исходном коде.</li>
                    <li>Production должен использовать HTTPS.</li>
                    <li>Административные маршруты должны быть защищены.</li>
                    <li>Проверка permissions должна выполняться на сервере.</li>
                </ul>

                <div class="alert alert-danger">
                    Проверка права доступа только в JavaScript не является
                    защитой. Сервер всегда должен выполнять окончательную проверку.
                </div>
            </div>
        </section>

        <!-- COMMANDS -->
        <section id="commands" class="card card-outline card-dark">
            <div class="card-header">
                <h3 class="card-title">15. CLI Commands</h3>
            </div>

            <div class="card-body">

                <h5>Services Scanner</h5>

                <pre><code>php spark my:services:scan</code></pre>

                <p>
                    Команда сканирует:
                </p>

                <pre><code>app/Modules/*/Config/Services.php</code></pre>

                <p>
                    Находит классы, являющиеся наследниками
                    <code>BaseService</code>, определяет публичные статические
                    методы и генерирует:
                </p>

                <pre><code>app/Config/Services.php</code></pre>

                <h5>Create Super Admin</h5>

                <pre><code>php spark my:create-superadmin</code></pre>

                <p>
                    Команда создаёт первоначальную роль
                    <code>super_admin</code> и пользователя Super Admin.
                </p>

                <h5>Планируемые команды</h5>

                <pre><code>php spark app:scan
php spark modules:scan
php spark permissions:scan
php spark menu:scan
php spark docs:scan</code></pre>

                <div class="alert alert-info">
                    CLI должна постепенно стать основным инструментом
                    обслуживания архитектуры проекта.
                </div>
            </div>
        </section>

        <!-- NEW MODULE -->
        <section id="new-module" class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">16. Создание нового модуля</h3>
            </div>

            <div class="card-body">

                <h5>Шаг 1. Создать Module</h5>

                <pre><code>app/Modules/Warehouse/</code></pre>

                <h5>Шаг 2. Создать структуру</h5>

                <pre><code>Warehouse/
├── Config/
├── Controllers/
├── Services/
├── Repositories/
├── Models/
├── Entities/
└── Views/</code></pre>

                <h5>Шаг 3. Controller</h5>

                <pre><code>WarehouseController</code></pre>

                <h5>Шаг 4. Service</h5>

                <pre><code>WarehouseService</code></pre>

                <h5>Шаг 5. Repository</h5>

                <pre><code>WarehouseRepository</code></pre>

                <h5>Шаг 6. Database</h5>

                <p>
                    Создать migration и необходимые таблицы.
                </p>

                <h5>Шаг 7. Routes</h5>

                <p>
                    Добавить маршруты модуля.
                </p>

                <h5>Шаг 8. Attributes</h5>

                <p>
                    Добавить Module, Permission, Menu и другие необходимые
                    Attributes.
                </p>

                <h5>Шаг 9. Scanner</h5>

                <pre><code>php spark app:scan</code></pre>
            </div>
        </section>

        <!-- NEW FEATURE -->
        <section id="new-feature" class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">17. Создание новой функции</h3>
            </div>

            <div class="card-body">

                <pre><code>1. Database
       ↓
2. Model / Entity
       ↓
3. Repository
       ↓
4. Service
       ↓
5. Controller
       ↓
6. Route
       ↓
7. Permission
       ↓
8. Menu
       ↓
9. View / HTMX</code></pre>

                <p>
                    Новая функциональность должна проходить через соответствующие
                    слои, а не реализовываться целиком внутри Controller.
                </p>
            </div>
        </section>

        <!-- RULES -->
        <section id="rules" class="card card-outline card-warning">
            <div class="card-header">
                <h3 class="card-title">18. Правила разработки</h3>
            </div>

            <div class="card-body">

                <h5>Обязательно</h5>

                <ul>
                    <li>Использовать Dependency Injection.</li>
                    <li>Бизнес-логику держать в Services.</li>
                    <li>Работу с БД держать в Repository.</li>
                    <li>Использовать Attributes для метаданных.</li>
                    <li>Использовать именованные Routes.</li>
                    <li>Проверять Permissions на сервере.</li>
                    <li>Использовать CLI для автоматизации.</li>
                </ul>

                <h5>Не рекомендуется</h5>

                <ul>
                    <li>SQL внутри Controller.</li>
                    <li>Бизнес-логика внутри View.</li>
                    <li>Ручное управление системным меню в БД.</li>
                    <li>Дублирование одной бизнес-логики в разных Controllers.</li>
                    <li>Хранение паролей в открытом виде.</li>
                    <li>Смешивание нескольких архитектурных подходов без причины.</li>
                </ul>
            </div>
        </section>

        <!-- ROADMAP -->
        <section id="roadmap" class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">19. Roadmap</h3>
            </div>

            <div class="card-body">

                <h5>Текущая разработка</h5>

                <ul class="list-group mb-3">
                    <li class="list-group-item">
                        <span class="badge badge-warning mr-2">В работе</span>
                        Модульная архитектура
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-warning mr-2">В работе</span>
                        Auth / Roles / Permissions
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-warning mr-2">В работе</span>
                        Employees
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-warning mr-2">В работе</span>
                        Accounting
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-warning mr-2">В работе</span>
                        Scanner architecture
                    </li>
                </ul>

                <h5>Следующий этап</h5>

                <ul>
                    <li>единый Application Scanner;</li>
                    <li>автоматическая регистрация Modules;</li>
                    <li>автоматическая регистрация Permissions;</li>
                    <li>автоматическое построение Menu;</li>
                    <li>автоматическая документация проекта;</li>
                    <li>архитектурные проверки.</li>
                </ul>
            </div>
        </section>

        <!-- FUTURE -->
        <section id="future" class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">20. Будущие идеи</h3>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">

                        <h5>Backend</h5>

                        <ul>
                            <li>Event system</li>
                            <li>Queue / Jobs</li>
                            <li>Notifications</li>
                            <li>Audit Log</li>
                            <li>API</li>
                            <li>API authentication</li>
                            <li>Webhooks</li>
                            <li>Scheduler</li>
                        </ul>

                    </div>

                    <div class="col-md-6">

                        <h5>Frontend</h5>

                        <ul>
                            <li>HTMX components</li>
                            <li>Reusable modals</li>
                            <li>Global Toast system</li>
                            <li>File manager</li>
                            <li>Drag & Drop uploads</li>
                            <li>Live updates</li>
                            <li>Dashboard widgets</li>
                        </ul>

                    </div>
                </div>

                <h5>Бизнес-функции</h5>

                <ul>
                    <li>полный Audit Trail;</li>
                    <li>история изменений документов;</li>
                    <li>портал клиента;</li>
                    <li>просмотр грузов клиентом;</li>
                    <li>просмотр счетов клиентом;</li>
                    <li>уведомления клиентам;</li>
                    <li>интеграции с внешними системами.</li>
                </ul>
            </div>
        </section>

        <!-- TECHNICAL DEBT -->
        <section id="technical-debt" class="card card-outline card-danger">
            <div class="card-header">
                <h3 class="card-title">21. Technical Debt</h3>
            </div>

            <div class="card-body">

                <p>
                    Здесь фиксируются временные решения, которые допустимы
                    во время разработки, но требуют пересмотра.
                </p>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Проблема</th>
                            <th>Статус</th>
                            <th>Решение</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Разрозненные Scanner-команды</td>
                            <td><span class="badge badge-warning">TODO</span></td>
                            <td>Объединить в Application Scanner</td>
                        </tr>
                        <tr>
                            <td>Статическая документация</td>
                            <td><span class="badge badge-warning">TODO</span></td>
                            <td>Автоматическая генерация</td>
                        </tr>
                        <tr>
                            <td>Ручное добавление некоторых metadata</td>
                            <td><span class="badge badge-warning">TODO</span></td>
                            <td>Перевести на Attributes + Scanner</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- TROUBLESHOOTING -->
        <section id="troubleshooting" class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title">22. Troubleshooting</h3>
            </div>

            <div class="card-body">

                <h5>404 на Controller</h5>

                <ol>
                    <li>Проверить Route.</li>
                    <li>Проверить namespace Controller.</li>
                    <li>Проверить имя метода.</li>
                    <li>Проверить Route Group.</li>
                    <li>Проверить Filter.</li>
                </ol>

                <h5>Too few arguments в Service</h5>

                <ol>
                    <li>Проверить constructor Service.</li>
                    <li>Проверить Config/Services.php.</li>
                    <li>Запустить Services Scanner.</li>
                    <li>Проверить Dependency Injection.</li>
                </ol>

                <pre><code>php spark my:services:scan</code></pre>

                <h5>HTMX 403</h5>

                <ol>
                    <li>Проверить CSRF token.</li>
                    <li>Проверить HTMX headers.</li>
                    <li>Проверить обновление token после запроса.</li>
                    <li>Проверить Filter.</li>
                </ol>

                <h5>Permission denied</h5>

                <ol>
                    <li>Проверить пользователя.</li>
                    <li>Проверить Role.</li>
                    <li>Проверить Permission.</li>
                    <li>Проверить PermissionService.</li>
                    <li>Проверить результат Scanner.</li>
                </ol>
            </div>
        </section>

        <!-- DECISIONS -->
        <section id="decisions" class="card card-outline card-dark">
            <div class="card-header">
                <h3 class="card-title">23. Архитектурные решения</h3>
            </div>

            <div class="card-body">

                <h5>ADR-001 — Модульная архитектура</h5>

                <p>
                    Функциональность системы разделяется на независимые модули.
                </p>

                <p>
                    <strong>Статус:</strong>
                    <span class="badge badge-success">Принято</span>
                </p>

                <hr>

                <h5>ADR-002 — Service является бизнес-слоем</h5>

                <p>
                    Controller не содержит бизнес-логику.
                    Бизнес-операции выполняются Service.
                </p>

                <p>
                    <strong>Статус:</strong>
                    <span class="badge badge-success">Принято</span>
                </p>

                <hr>

                <h5>ADR-003 — Attributes являются источником metadata</h5>

                <p>
                    Menu, Permissions и информация о модулях должны определяться
                    через PHP Attributes и обрабатываться Scanner.
                </p>

                <p>
                    <strong>Статус:</strong>
                    <span class="badge badge-success">Принято</span>
                </p>

                <hr>

                <h5>ADR-004 — Один Role на User</h5>

                <p>
                    На текущем этапе один пользователь имеет одну основную роль.
                    Это соответствует размеру и требованиям компании.
                </p>

                <p>
                    <strong>Статус:</strong>
                    <span class="badge badge-success">Принято</span>
                </p>

                <hr>

                <h5>ADR-005 — CLI как инструмент обслуживания архитектуры</h5>

                <p>
                    Рутинные операции по регистрации Services, Modules,
                    Permissions и документации должны постепенно переноситься
                    в автоматические CLI-команды.
                </p>

                <p>
                    <strong>Статус:</strong>
                    <span class="badge badge-primary">Развивается</span>
                </p>

            </div>
        </section>

        <div class="card card-outline card-success">
            <div class="card-body text-center">
                <h4>EuroCargo Development Documentation</h4>
                <p class="text-muted mb-0">
                    Документация должна развиваться вместе с архитектурой проекта.
                </p>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>