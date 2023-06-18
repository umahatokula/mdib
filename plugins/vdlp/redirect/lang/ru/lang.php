<?php

declare(strict_types=1);

return [
    'plugin' => [
        'name' => 'Редиректы',
        'description' => 'Удобное управление редиректами',
    ],
    'permission' => [
        'access_redirects' => [
            'label' => 'Редиректы',
            'tab' => 'Редиректы',
        ],
    ],
    'navigation' => [
        'menu_label' => 'Редиректы',
        'menu_description' => 'Управление редиректами',
    ],
    'settings' => [
        'menu_label' => 'Редиректы',
        'menu_description' => 'Управление настройками для Редиректов.',
        'logging_enabled_label' => 'Журнал событий перенаправлений',
        'logging_enabled_comment' => 'Хранить события перенаправления в базе данных.',
        'statistics_enabled_label' => 'Собирать статистику',
        'statistics_enabled_comment' => 'Соберите статистику перенаправленных запросов, чтобы получить больше информации.',
        'test_lab_enabled_label' => 'TestLab (beta)',
        'test_lab_enabled_comment' => 'TestLab позволяет вам массово протестировать ваши редиректы.',
        'caching_enabled_label' => 'Кэширование редиректов (продвинутый)',
        'caching_enabled_comment' => 'Улучшает механизм перенаправления при большом количестве перенаправлений. '
            . 'ВНИМАНИЕ: Драйвер кэша `file` и `database` НЕ поддерживаются. '
            . 'Рекомендуемым драйвером является `memcached` или аналогичный драйвер "in-memory" для кеширования в памяти.',
        'relative_paths_enabled_label' => 'Use relative paths', // TODO
        'relative_paths_enabled_command' => 'The redirect engine will generate relative paths instead of absolute paths.', // TODO
    ],
    'redirect' => [
        'redirect' => 'Редиректы',
        'from_url' => 'Исходный путь',
        'from_url_placeholder' => '/source/path',
        'from_url_comment' => 'Исходный путь относительно корня сайта.',
        'from_scheme' => 'Source scheme', // TODO
        'from_scheme_comment' => 'Force match on scheme. If HTTP is selected <u>http://domain.com/path</u> will ' // TODO
            . 'match and <u>https://domain.com/path</u> does not match.', // TODO
        'to_url' => 'Путь редиректа или URL',
        'to_url_placeholder' => '/absolute/path, relative/path или http://target.url',
        'to_url_comment' => 'Абсолютный путь, относительный путь или URL для перенаправления.',
        'to_url_required_if' => 'Исходный путь или URL обязателен для заполнения',
        'to_scheme' => 'Target scheme', // TODO
        'to_scheme_comment' => 'Target scheme will be forced to HTTP or HTTPS ' // TODO
            . 'or choose AUTOMATIC to use the default scheme of the website.', // TODO
        'scheme_auto' => 'Automatic', // TODO
        'cms_page_required_if' => 'Пожалуйста, выберите страницу CMS для перенаправления',
        'static_page_required_if' => 'Пожалуйста, пропишите статическую страницу для перенаправления',
        'match_type' => 'Тип соответствия',
        'exact' => 'Точный',
        'placeholders' => 'По меткам',
        'regex' => 'Регулярное выражение',
        'target_type' => 'Тип цели редиректа',
        'target_type_none' => 'Неприменимый',
        'target_type_path_or_url' => 'Путь или URL',
        'target_type_cms_page' => 'Страница CMS',
        'target_type_static_page' => 'Статическая страница',
        'status_code' => 'Код HTTP-статуса',
        'sort_order' => 'Порядок сортировки',
        'requirements' => 'Параметры меток',
        'requirements_comment' => 'Добавьте параметры для каждого условия.',
        'placeholder' => 'Метка',
        'placeholder_comment' => 'Имя метки (включая фигурные скобки) проставленной в поле \'Исходный путь\'. '
            . 'Например: {category} или {id}',
        'requirement' => 'Параметры',
        'requirement_comment' => 'Пропишите параметры с помощью регулярных выражений. Например, [0-9]+ или [a-zA-Z]+.',
        'requirements_prompt' => 'Добавить новый параметр',
        'replacement' => 'Замена',
        'replacement_comment' => 'Пропишите (опционально) замену для текущей метки. В целевом URL метка будет заменена на это значение.',
        'permanent' => '301 - перемещено навсегда',
        'temporary' => '302 - перемещено временно',
        'see_other' => '303 - смотреть другое',
        'not_found' => '404 - не найдено',
        'gone' => '410 - удалено',
        'enabled' => 'Включено',
        'none' => 'none', // TODO
        'enabled_comment' => 'Установите флажок для включения этого редиректа.',
        'priority' => 'Приоритет',
        'hits' => 'Переходы',
        'return_to_redirects' => 'Вернуться к списку редиректов',
        'return_to_categories' => 'Вернуться к списку категорий',
        'delete_confirm' => 'Вы уверены?',
        'created_at' => 'Создано в',
        'modified_at' => 'Изменено в',
        'system_tip' => 'Системный редирект',
        'user_tip' => 'Пользовательский редирект',
        'type' => 'Тип',
        'and_delete_log_item' => 'И удалить выбранные элементы лога',
        'category' => 'Категория',
        'categories' => 'Категории',
        'description' => 'Описание',
        'name' => 'Имя',
        'date_time' => 'Дата и время',
        'date' => 'Дата',
        'truncate_confirm' => 'Вы уверены, что хотите удалить ВСЕ записи?',
        'truncating' => 'Удаление...',
        'warning' => 'Предупреждение',
        'cache_warning' => 'Вы включили кэширование, но ваш драйвер кэширования не поддерживается. '
            . 'Перенаправления не будут кэшироваться.',
        'general_confirm' => 'Вы уверены, что хотите это сделать?',
        'sparkline_30d' => 'Хиты (30дн)',
        'has_hits' => 'Хиты',
        'minimum_hits' => 'Минимум # хитов',
        'ignore_query_parameters' => 'Игнорировать параметры запроса (рекомендуется).',
        'ignore_query_parameters_comment' => 'Движок будет игнорировать все параметры запроса из исходного пути.',
        'ignore_case' => 'Ignore case', // TODO
        'ignore_case_comment' => 'The redirect engine will do case-insensitive matching.', // TODO
        'ignore_trailing_slash' => 'Ignore trailing slash', // TODO
        'ignore_trailing_slash_comment' => 'The redirect engine will ignore trailing slashes.', // TODO
        'last_used_at' => 'Последний хит',
        'updated_at' => 'Обновлено',
        'invalid_regex' => 'Неправильное регулярное выражение.',
    ],
    'list' => [
        'no_records' => 'В этом списке нет редиректов.',
        'switch_is_enabled' => 'Включено',
        'switch_system' => 'Системные редиректы',
    ],
    'scheduling' => [
        'from_date' => 'Дата включения',
        'from_date_comment' => 'Дата, с которой редирект будет активен. Необязательное поле.',
        'to_date' => 'Дата выключения',
        'to_date_comment' => 'Дата до которой редирект будет активен. Необязательное поле.',
        'scheduling_comment' => 'Здесь вы можете задать период, в течении которого редирект будет активен. Возможны любые комбинации дат.',
        'not_active_warning' => 'Редирект больше не доступен, пожалуйста, проверьте вкладку \'Расписание\'.',
    ],
    'test' => [
        'test_comment' => 'Пожалуйста, проверьте редирект перед сохранением.',
        'input_path' => 'Введите путь',
        'input_path_comment' => 'Путь для тестирования. Например, /old-blog/category/123',
        'input_path_placeholder' => '/input/path',
        'input_scheme' => 'Input scheme', // TODO
        'test_date' => 'Выберите дату',
        'test_date_comment' => 'Если вы запланировали редирект по расписанию, вы можете проверить его работу для конкретной даты.',
        'testing' => 'Проверка...',
        'run_test' => 'Начать проверку',
        'no_match_label' => 'Извините, совпадения не найдены!',
        'no_match' => 'Совпадений не найдено!',
        'match_success_label' => 'Есть совпадение!',
    ],
    'test_lab' => [
        'section_test_lab_comment' => 'TestLab позволяет вам массово протестировать ваши перенаправления.',
        'test_lab_label' => 'Включить в TestLab',
        'test_lab_enable' => 'Включите этот переключатель, чтобы разрешить тестирование этого редиректа в TestLab.',
        'test_lab_path_label' => 'Test Path', // TODO
        'test_lab_path_comment' => 'This path will be used when performing tests. '
            . 'Replace placeholders with real values.', // TODO
        'start_tests' => 'Запустить тесты',
        'start_tests_description' => 'Нажмите кнопку \'Запустить тесты\' чтобы начать.',
        'edit' => 'Редактировать',
        'exclude' => 'Исключить',
        'exclude_confirm' => 'Вы действительно хотите исключить этот редирект из TestLab?',
        'exclude_indicator' => 'Excluding redirect from TestLab', // TODO
        're_run' => 'Re-run', // TODO
        're_run_indicator' => 'Запуск тестов, подождите...',
        'loop' => 'Loop', // TODO
        'match' => 'Match', // TODO
        'response_http_code' => 'Response HTTP code', // TODO
        'response_http_code_should_be' => 'Response HTTP code should be one of:', // TODO
        'redirect_count' => 'Redirect count', // TODO
        'final_destination' => 'Final Destination', // TODO
        'no_redirects' => 'Нет отмеченных редиректов с включенным TestLab. '
            . 'Пожалуйста, включите опцию \'Включить в TestLab\' в редактировании редиректа.',
        'test_error' => 'Произошла ошибка при тестировании этого редиректа.',
        'flash_test_executed' => 'Тест был выполнен.',
        'flash_redirect_excluded' => 'Перенаправление было исключено из TestLab и не будет отображаться при следующем запуске теста.',
        'result_request_failed' => 'Не удалось выполнить запрос.',
        'redirects_followed' => 'Number of redirects followed: :count (limited to :limit)', // TODO
        'not_determinate_destination_url' => 'Could not determine final destination URL.', // TODO
        'no_destination_url' => 'No final destination URL.', // TODO
        'final_destination_is' => 'Final destination is: :destination', // TODO
        'possible_loop' => 'Possible redirect loop!', // TODO
        'no_loop' => 'No redirect loop detected.', // TODO
        'not_match_redirect' => 'Не соответствует ни одному редиректу.',
        'matched' => 'Matched', // TODO
        'redirect' => 'redirect', // TODO
        'matched_not_http_code' => 'Matched redirect, but response HTTP code did not match! '
            . 'Expected :expected but received :received.', // TODO
        'matched_http_code' => 'Matched redirect, response HTTP code :code.', // TODO
        'executing_tests' => 'Выполнение тестов...',
    ],
    'statistics' => [
        'hits_per_day' => 'Хиты перенаправлений за день',
        'click_on_chart' => 'Нажмите на график, чтобы включить масштабирование и перетаскивание.',
        'requests_redirected' => 'Запросы перенаправлений',
        'all_time' => 'всё время',
        'active_redirects' => 'Активных редиректов',
        'redirects_this_month' => 'Перенаправлений в этом месяце',
        'previous_month' => 'Прошлый месяц',
        'latest_redirected_requests' => 'Последний перенаправленный запрос',
        'redirects_per_month' => 'Перенаправления за месяц',
        'no_data' => 'Нет данных',
        'top_crawlers_this_month' => 'Топ :top crawlers в этом месяце',
        'top_redirects_this_month' => 'Топ :top редиректов в этом месяце',
        'activity_last_three_months' => 'Activity last 3 months', // TODO
    ],
    'title' => [
        'import' => 'Импорт',
        'export' => 'Экспорт',
        'redirects' => 'Управление редиректами',
        'create_redirect' => 'Создать редирект',
        'edit_redirect' => 'Редактировать редирект',
        'categories' => 'Управление категориями',
        'create_category' => 'Создать категорию',
        'edit_category' => 'Редактировать категорию',
        'view_redirect_log' => 'Смотреть лог редиректов',
        'statistics' => 'Статистика',
        'test_lab' => 'TestLab (beta)',
    ],
    'buttons' => [
        'add' => 'Добавить',
        'from_request_log' => 'Из лога запросов',
        'new_redirect' => 'Новый редирект',
        'create_redirects' => 'Создание редиректов',
        'create_redirect' => 'Создать редирект',
        'create_and_new' => 'Создать и новый',
        'delete' => 'Удалить',
        'enable' => 'Включить',
        'disable' => 'Отключить',
        'reorder_redirects' => 'Упорядочить',
        'export' => 'Экспорт',
        'import' => 'Импорт',
        'settings' => 'Настройки',
        'categories' => 'Категории',
        'extensions' => 'Extensions', // TODO
        'new_category' => 'Новая категория',
        'reset_statistics' => 'Сбросить статистику',
        'logs' => 'Лог редиректов',
        'empty_redirect_log' => 'Очистить лог',
        'clear_cache' => 'Очистить кэш',
        'stop' => 'Стоп',
        'reset_all' => 'Сброс статистики для всех редиректов',
        'all_redirects' => 'все редиректы',
        'bulk_actions' => 'Массовые действия',
    ],
    'tab' => [
        'tab_general' => 'Основные',
        'tab_requirements' => 'Параметры меток',
        'tab_test' => 'Проверка',
        'tab_scheduling' => 'Расписание',
        'tab_test_lab' => 'TestLab',
        'tab_advanced' => 'Продвинутый',
        'tab_logs' => 'Event log', // TODO
    ],
    'flash' => [
        'success_created_redirects' => 'Успешно создано :count редирект(ов)',
        'static_page_redirect_not_supported' => 'Этот редирект нельзя изменить. Необходим плагин RainLab.Pages.',
        'truncate_success' => 'Все записи успешно удалены',
        'delete_selected_success' => 'Выбранные записи успешно удалены',
        'cache_cleared_success' => 'Кэш редиректа успешно очищен',
        'statistics_reset_success' => 'Вся статистика была успешно сброшена',
        'enabled_all_redirects_success' => 'Все перенаправления были успешно включены',
        'disabled_all_redirects_success' => 'Все перенаправления были успешно выключены',
        'deleted_all_redirects_success' => 'Все перенаправления были успешно удалены',
    ],
    'import_export' => [
        'match_type' => 'Match Type [match_type] (Допустимые значения: exact, placeholders, regex)',
        'category_id' => 'Категория [category_id]',
        'target_type' => 'Target Type [target_type] (Допустимые значения: path_or_url, cms_page, static_page, none)',
        'from_url' => 'Source path [from_url]',
        'from_scheme' => 'Source scheme [from_scheme] (Допустимые значения: http, https, auto [default])',
        'to_url' => 'Target path [to_url]',
        'to_scheme' => 'Target scheme [to_scheme] (Допустимые значения: http, https, auto [default])',
        'test_url' => 'Test URL [test_url]',
        'cms_page' => 'CMS страница [cms_page] (Имя файла без .htm расширения)',
        'static_page' => 'Static Page [static_page] (Имя файла без .htm расширения)',
        'requirements' => 'Placeholder requirements [requirements]',
        'status_code' => 'HTTP status code [status_code] (Возможные значения: 301, 302, 303, 404, 410)',
        'hits' => 'Хиты редиректа [hits]',
        'from_date' => 'Запланированная дата от [from_date] (YYYY-MM-DD или пустой)',
        'to_date' => 'Запланированная дата до [to_date] (YYYY-MM-DD или пустой)',
        'sort_order' => 'Приоритет [sort_order]',
        'is_enabled' => 'Включен [is_enabled] (1 = редирект включен, 0 = редирект отключен [default])',
        'ignore_query_parameters' => 'Ignore Query Parameters [ignore_query_parameters] (1 = ignore query parameters, 0 = include query parameters [default])',
        'ignore_case' => 'Ignore Case [ignore_case] (1 = yes, 0 = no [default])', // TODO
        'ignore_trailing_slash' => 'Ignore Trailing Slashes [ignore_trailing_slash] (1 = yes, 0 = no [default])', // TODO
        'test_lab' => 'TestLab [test_lab] (1 = TestLab включен, 0 = TestLab выключен [default])',
        'test_lab_path' => 'TestLab path [test_lab_path] (требуется, если match_type = placeholders)',
        'system' => 'System [system] (1 = система сгенерировала редирект, 0 = пользователь создал редирект [default])',
        'description' => 'Описание [description]',
        'last_used_at' => 'Последнее применение [last_used_at] (YYYY-MM-DD HH:MM:SS или пустой)',
        'created_at' => 'Создан [created_at] (YYYY-MM-DD HH:MM:SS или пустой)',
        'updated_at' => 'Обновлен [updated_at] (YYYY-MM-DD HH:MM:SS или пустой)',
    ],
];