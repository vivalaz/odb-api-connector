<?php

namespace Vivalaz\OdbApiConnector\Services;

use Vivalaz\OpenDataBotApiConnector\Exceptions\ODBException;

class CourtService extends BaseService
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all court stages.
     * @return array
     */
    public function getCourtStages()
    {
        return [
            [
                'key' => 'first'
            ],
            [
                'key' => 'appeal'
            ],
            [
                'key' => 'cassation'
            ]
        ];
    }

    /**
     * Get all court search criteria
     * @return array
     */
    public function getCourtSearchCriteria()
    {
        return [
            [
                'key' => 'words_in_a_row',
                'description' => 'Слова повинні йти один за одним'
            ]
        ];
    }

    /**
     * Get filter settings for date field
     * @return array
     */
    public function getDateFilterSettings()
    {
        return [
            [
                'key' => 'gte',
                'description' => 'більше або дорівнює',
            ],
            [
                'key' => 'lte',
                'description' => 'менше або дорівнює'
            ]
        ];
    }

    /**
     * Отримання судових рішень
     * @param int|null $judgment - Внутрішній код Форми судочинства
     * @param int|null $justice - Внутрішній код Типу процесуального документа
     * @param string|null $text - Пошук в тексті рішення
     * @param string|null $stage - Тип інстанциї (for get all types need to call getCourtStages function)
     * @param string|null $textIntro - Пошук в вступній частині рішення
     * @param string|null $textResolution - Пошук в резолютивній частині рішення
     * @param string|null $number - Номер справи
     * @param string|null $dateFrom - Зміщення від дати ухвали рішення
     * @param string|null $dateTo - Зміщення до дати ухвали рішення
     * @param string|null $searchCriteria - Критерій пошуку значення параметру text в тексті судового рішення.(for get all types need to call getCourtSearchCriteria function)
     * @param int|null $offset - Зміщення відносно початку результатів пошуку
     * @param int|null $limit - Кількість записів
     * @return mixed
     * @throws ODBException
     */
    public function getCourts(
        int $judgment = null,
        int $justice = null,
        string $text = null,
        string $stage = null,
        string $textIntro = null,
        string $textResolution = null,
        string $number = null,
        string $dateFrom = null,
        string $dateTo = null,
        string $searchCriteria = null,
        int $offset = null,
        int $limit = null
    )
    {
        return $this->openDataBotRequest("/court", [
            'judgment' => $judgment,
            'justice' => $justice,
            'text' => $text,
            'stage' => $stage,
            'text_intro' => $textIntro,
            'text_resolution' => $textResolution,
            'offset' => $offset,
            'limit' => $limit,
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'number' => $number,
            'search_criteria' => $searchCriteria
        ]);
    }

    /**
     * Отримання судового документа
     * @param int $id - id судового документа
     * @return mixed
     * @throws ODBException
     */
    public function getCourtById(int $id)
    {
        return $this->openDataBotRequest("/court/${id}");
    }

    /**
     * Пошук в судовому розкладі
     * @param string|null $textInvolved - Пошук в тексті
     * @param string|null $textDescription - Пошук в описі
     * @param string|null $date - Пошук по даті
     * @param string|null $courtId - Пошук по courtId
     * @param string|null $judgmentCode - Внутрішній код Форми судочинства
     * @param string|null $number - Пошук по номеру справи
     * @param int|null $offset - Зміщення відносно початку результатів пошуку
     * @param int|null $limit - Кількість записів
     * @return mixed
     * @throws ODBException
     */
    public function findBySchedule(
        string $textInvolved = null,
        string $textDescription = null,
        string $date = null,
        string $courtId = null,
        string $judgmentCode = null,
        string $number = null,
        int $offset = null,
        int $limit = null
    )
    {
        return $this->openDataBotRequest("/schedule", [
            'text_involved' => $textInvolved,
            'text_description' => $textDescription,
            'date' => $date,
            'courtId' => $courtId,
            'offset' => $offset,
            'limit' => $limit,
            'judgment_code' => $judgmentCode,
            'number' => $number
        ]);
    }

    /**
     * Отримання кількості судових справ за видами судочинства, де компанія є стороною
     * @param string $companyCode - код ЄДРПОУ компанії
     * @return mixed
     * @throws ODBException
     */
    public function getCompanyCourts(string $companyCode)
    {
        return $this->openDataBotRequest("/company-courts", [
            'code' => $companyCode
        ]);
    }

    /**
     * Отримання переліка судових справ за видами судочинства, де компанія є стороною
     * @param string $type - Тип судочинства
     * @param string $companyCode - код ЄДРПОУ компанії
     * @param string|null $sortField - поле по якому відбувається сортування результату
     * @param string|null $sortType - порядок сортування (DESC - по зменшенню; ASC -по зростанню)
     * @param string|null $dateFrom - фільтр по даті першого засідання або документа у справі
     * @param string|null $dateFromSettings - напрямок фільтра за датою (for get all types need to call getDateFilterSettings function)
     * @param int|null $offset - Зміщення відносно початку результатів пошуку
     * @param int|null $limit - Кількість записів
     * @return mixed
     * @throws ODBException
     */
    public function getCompanyCourtsByType(
        string $type,
        string $companyCode,
        string $sortField = null,
        string $sortType = null,
        string $dateFrom = null,
        string $dateFromSettings = null,
        int $offset = null,
        int $limit = null
    )
    {
        return $this->openDataBotRequest("/company-courts/${type}", [
            'code' => $companyCode,
            'sort_field' => $sortField,
            'sort_type' => $sortType,
            'date_start' => $dateFrom,
            'date_start_filter' => $dateFromSettings,
            'offset' => $offset,
            'limit' => $limit
        ]);
    }

    /**
     * Отримання переліка інстанцій, рішень, позивачів, відповідачів, засідань за судовою справою. Отримання результату в кожній інстанції.
     * @param string $courtNumber - Номер судової справи
     * @param int|null $judgmentCode - Вид судочинства. Якщо параметр не зазначений, а результат пошуку більше однієї справи з різним типом судочинства, то виникне помилка неунікальності судової справи. При зазначені типу судочинства, результат стає унікальним та у відповіді відображається лише одна справа
     * @return mixed
     * @throws ODBException
     */
    public function getCourtCasesByNumber(string $courtNumber, int $judgmentCode = null)
    {
        return $this->openDataBotRequest("/court-cases/${courtNumber}", [
            'judgment_code' => $judgmentCode
        ]);
    }

}
