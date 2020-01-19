<?php


namespace Vivalaz\OdbApiConnector\Services;

use Vivalaz\OdbApiConnector\Exceptions\ODBException;

class BusinessMonitoringService extends BaseService
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all monitoring types with description
     * @return array
     */
    public function getMonitoringTypes()
    {
        return [
            [
                'key' => 'company',
                'description' => 'зміни по компанії'
            ],
            [
                'key' => 'court',
                'description' => 'зміни по судовим рішенням'
            ],
            [
                'key' => 'fop',
                'description' => 'зміни по ФОП за ПІБ'
            ],
            [
                'key' => 'fopinn',
                'description' => 'зміни по ФОП за ІПН'
            ],
            [
                'key' => 'involved',
                'description' => 'зміни по судовим засіданням'
            ],
            [
                'key' => 'realty',
                'description' => 'зміни по об\'єкту нерухомості у реєстрі речових прав'
            ],
            [
                'key' => 'innSubscribe',
                'description' => 'зміни виконавчих проваджень та нерухомості по ІПН'
            ],
            [
                'key' => 'full_penalty_secret',
                'description' => 'зміни по документам у виконавчому провадженні'
            ]
        ];
    }

    /**
     * Get all lists types
     * @return array
     */
    public function getListsTypes()
    {
        return [
            [
                'key' => 'legal'
            ],
            [
                'key' => 'court'
            ],
            [
                'key' => 'involved'
            ],
            [
                'key' => 'realty'
            ],
            [
                'key' => 'innSubscribe'
            ],
            [
                'key' => 'fullPenaltySecret'
            ]
        ];
    }

    /**
     * Get all timeline types
     * @return array
     */
    public function getTimelineTypes()
    {
        return [
            [
                'key' => 'change_status_borrower',
                'description' => 'зміна статусу виконавчого провадження у якості боржника'
            ],
            [
                'key' => 'change_status_creditor',
                'description' => 'зміна статусу виконавчого провадження у якості стягувача'
            ],
            [
                'key' => 'new_penalty_borrower',
                'description' => 'нове виконавче провадження у якості боржника'
            ],
            [
                'key' => 'new_penalty_creditor',
                'description' => 'нове виконавче провадження у якості стягувача'
            ],
            [
                'key' => 'penalty',
                'description' => 'нове виконавче провадження в реєстрі боржників'
            ],
            [
                'key' => 'realty',
                'description' => 'зміна об\'єктів нерухомості у реєстрі речових прав'
            ],
            [
                'key' => 'wagedebt',
                'description' => 'нова заборгованість по виплаті заробітної плати'
            ],
            [
                'key' => 'inspections',
                'description' => 'нова перевірка контролюючими органами'
            ],
            [
                'key' => 'new_court_defendant',
                'description' => 'новий судовий процес у якості відповідача'
            ],
            [
                'key' => 'add_court_defendant',
                'description' => 'додано нового відповідача по вже існуючій справі'
            ],
            [
                'key' => 'new_court_plaintiff',
                'description' => 'новий судовий процес у якості позивача'
            ],
            [
                'key' => 'add_court_plaintiff',
                'description' => 'додано нового позивача по вже існуючій справі'
            ],
            [
                'key' => 'new_court_third_person',
                'description' => 'новий судовий процес у якості третьої сторони'
            ],
            [
                'key' => 'add_court_third_person',
                'description' => 'додано третю сторону по вже існуючій справі'
            ],
            [
                'key' => 'new_decision',
                'description' => 'новий документ за судовою справою'
            ],
            [
                'key' => 'new_schedule',
                'description' => 'нове засідання у судовій справі'
            ]
        ];
    }

    /**
     * Підписка на моніторинг Компанії (за кодом ЄДРПОУ в параметрі code), Фоп (ідентифікаційний код в параметрі code),
     * судових рішень (за пошуковим запитом в параметрі term ), Судових засідань (по пошуковому запиту в параметрі term),
     * Документів по виконавчим впровадженням (за номером виконавчого провадження і секретним ключем, передаючи його
     * в параметрі secret).
     * @param string $monitoringType - Тип мониторинга
     * @param string|null $companyCode - код ЄДРПОУ|ідентифікаційний код/Номер виконавчого провадження
     * @param string|null $term - Пошуковий запит
     * @param string|null $secretKey - Секретний ключ для моніторингу документів по виконавчим провадженням
     * @return mixed
     * @throws ODBException
     */
    public function subscribe(string $monitoringType, string $companyCode = null, string $term = null, string $secretKey = null)
    {
        return $this->openDataBotRequest("/subscribe", [
            'type' => $monitoringType,
            'code' => $companyCode,
            'term' => $term,
            'secret' => $secretKey
        ]);
    }

    /**
     * Відписка від моніторингу Компанії, Фоп, судових рішень, судових засідань за ідентифікатором підписки
     * отриманим через запит /lists
     * @param string $monitoringType - Тип мониторинга
     * @param int|null $id - ідентифікатор підписки отриманий через запит /lists
     * @return mixed
     * @throws ODBException
     */
    public function unsubscribe(string $monitoringType, int $id)
    {
        return $this->openDataBotRequest("/unsubscribe", [
            'type' => $monitoringType,
            'code' => $id
        ]);
    }

    /**
     * Отримання інформації про підписках, розподілених за типами
     * @param string|null $type - list type
     * @return mixed
     * @throws ODBException
     */
    public function getListsInfo(string $type = null)
    {
        return $this->openDataBotRequest("/lists", [
            'type' => $type
        ]);
    }

    /**
     * Отримання історії змін по підписках
     * @param string|null $fromId - Початковий notification_id пошуку
     * @param bool $debug - Режим тестування
     * @param int|null $offset - Зміщення відносно початку результатів пошуку
     * @param int|null $limit - Кількість записів
     * @return mixed
     * @throws ODBException
     */
    public function getHistory(string $fromId = null, bool $debug = false, int $offset = null, int $limit = null)
    {
        return $this->openDataBotRequest("/history", [
            'from_id' => $fromId,
            'offset' => $offset,
            'limit' => $limit,
            'debug' => $debug
        ]);
    }

    /**
     * Установка webhook, для отримання нотифікацій в форматі JSON raw body на адрусу вказаний в параметрі url
     * @param string $url - Url адреса webhook. Для видалення вебхука потрібно відправити пустим
     * @param string|null $token - Обов'язкове поле для батьківського аккаунта. Формується з url webhook + сіль вашого аккаунту ($url . '-' . $salt)
     * @return mixed
     * @throws ODBException
     */
    public function setWebhook(string $url, string $token = null)
    {
        return $this->openDataBotRequest("/set-webhook", [
            'url' => $url,
            'token' => $token
        ]);
    }

    /**
     * Відправка нотифікації на адресу webhook
     * @param int $notificationId - ідентифікатор повідомленя
     * @return mixed
     * @throws ODBException
     */
    public function sendWebhook(int $notificationId)
    {
        return $this->openDataBotRequest("/send-webhook", [
            'notification_id' => $notificationId
        ]);
    }

    /**
     * Інформація про webhook
     * @param string $url - url вебхука
     * @return mixed
     * @throws ODBException
     */
    public function getWebhook(string $url = null)
    {
        return $this->openDataBotRequest("/get-webhook", [
            'url' => $url
        ]);
    }

    /**
     * Отримання стрічки змін за реєстрами
     * @param string $companyCode - код ЄДРПОУ
     * @param string|null $fromId - Початковий id пошуку
     * @param string|null $timeLineType
     * @param string|null $dateStart - Фільтр за початком події (Y-m-d)
     * @param string|null $dateEnd - Фільтр кінцевою датою події (Y-m-d)
     * @param int|null $offset - Зміщення відносно початку результатів пошуку
     * @param int|null $limit - Кількість записів
     * @param string|null $order - Порядок сортування (asc|desc)
     * @param string|null $orderField - Порядок сортування (id | created_at | event_date)
     * @return mixed
     * @throws ODBException
     */
    public function getTimeline(
        string $companyCode,
        string $fromId = null,
        string $timeLineType = null,
        string $dateStart = null,
        string $dateEnd = null,
        int $offset = null,
        int $limit = null,
        string $order = null,
        string $orderField = null
    )
    {
        return $this->openDataBotRequest("/timeline", [
            'code' => $companyCode,
            'from_id' => $fromId,
            'type' => $timeLineType,
            'date_start' => $dateStart,
            'date_end' => $dateEnd,
            'offset' => $offset,
            'limit' => $limit,
            'order' => $order,
            'order_field' => $orderField
        ]);
    }

}
