<?php

namespace Vivalaz\OdbApiConnector\Services;

use Vivalaz\OpenDataBotApiConnector\Exceptions\ODBException;

class CompanyService extends BaseService
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Отримання повної інформаціі за кодом ЄДРПОУ
     * @param string|null $code - code of company
     * @param bool $edr - Показати додаткову інформцію з ЄДР.
     * @return mixed
     * @throws ODBException
     * @throws ODBException
     */
    public function getFullCompanyData(string $code = null, bool $edr = false)
    {
        return $this->openDataBotRequest("/fullcompany/${code}", [
            'edr' => $edr
        ]);
    }

    /**
     * Отримання реєстраційної інформації ФОП (ПІБ, адреса, види діяльності, статус) за індівідуальним кодом платника податків (ІПН), статус платника ПДВ
     * @param string|null $code - код компанії
     * @return mixed
     * @throws ODBException
     * @throws ODBException
     */
    public function getFopData(string $code = null)
    {
        return $this->openDataBotRequest("/fop/${code}");
    }

    /**
     * Отримання реєстраційної інформації за кодом ЄДРПОУ. Можливо отримати запит за декількома компаніями
     * @param array $companiesCodes - массив ЕДРПОУ компаний
     * @return mixed
     * @throws ODBException
     * @throws ODBException
     */
    public function getCompaniesData(array $companiesCodes = [])
    {
        $codes = implode(',', $companiesCodes);
        return $this->openDataBotRequest("/company/${codes}");
    }

    /**
     * Отримання переліку змін реєстраційної інформації (зміна директора, адреси, статусу, види діяльності, назви, власників).
     * @param array $companiesCodes - массив ЕДРПОУ компаний
     * @param string|null $from - дата, з якої показати зміни
     * @return mixed
     * @throws ODBException
     * @throws ODBException
     */
    public function getCompaniesChanges(array $companiesCodes = [], string $from = null)
    {
        $codes = implode(',', $companiesCodes);
        return $this->openDataBotRequest("/changes/${codes}", [
            'from' => $from
        ]);
    }

    /**
     * Отримання публічної інформації щодо компанії, наявність в базі боржників по заробітній платі
     * @param string|null $code - код компанії
     * @return mixed
     * @throws ODBException
     * @throws ODBException
     */
    public function getCompanyWagedebt(string $code = null)
    {
        return $this->openDataBotRequest("/wagedebt/${code}");
    }

    /**
     * Отримання публічної інформації щодо проведення планових перевірок
     * @param string|null $code - код компанії
     * @param string|null $pib - ПИБ
     * @param int|null $offset - Зміщення відносно початку результатів пошуку
     * @param int|null $limit - Кількість записів
     * @return mixed
     * @throws ODBException
     * @throws ODBException
     */
    public function getAudit(string $code = null, string $pib = null, int $limit = null, int $offset = null)
    {
        return $this->openDataBotRequest("/audit", [
            'code' => $code,
            'pib' => $pib,
            'limit' => $limit,
            'offset' => $offset
        ]);
    }

    /**
     * Отримання публічної інформації щодо проведення планових перевірок
     * @param string|null $id - audit ID
     * @return mixed
     * @throws ODBException
     * @throws ODBException
     */
    public function getAuditById(string $id = null)
    {
        return $this->openDataBotRequest("/audit/${id}");
    }

    /**
     * Отримання переліку нових компаній та ФОПів
     * @param string $type - юридична (company) або фізична (fop) особа
     * @param int|null $offset - Зміщення відносно початку результатів пошуку
     * @param int|null $limit - Кількість записів
     * @param string|null $regDateFrom - пошук за датою з YYYY-MM-DD
     * @param string|null $regDateTo - пошук за датою з YYYY-MM-DD
     * @param array $activities - сортування за видами діяльності
     * @param array $locations - массив адерсов
     * @param bool $isPhone - Фільтр по наявності телефону
     * @param bool $isEmail - Фільтр по наявності email
     * @param string $sort - спосіб сортувааня (за зростанням 'ASC' або спаданням'DESC')
     * @return
     * @throws ODBException
     * @throws ODBException
     */
    public function getNewRegistrations(
        string $type = 'company',
        int $offset = null,
        int $limit = null,
        string $regDateFrom = null,
        string $regDateTo = null,
        array $activities = [],
        array $locations = [],
        bool $isPhone = false,
        bool $isEmail = false,
        string $sort = 'ASC'
    )
    {
        return $this->openDataBotRequest("/registrations", [
            'offset' => $offset,
            'limit' => $limit,
            'type' => $type,
            'reg_date_from' => $regDateFrom,
            'reg_date_to' => $regDateTo,
            'activities' => implode(' OR ', $activities),
            'location' => implode(' OR ', $locations),
            'is_phone' => $isPhone,
            'is_email' => $isEmail,
            'sort' => $sort
        ]);
    }

    /**
     * Отримання реєстраційної інформації за внутрішнім id
     * @param string|null $id - registration ID
     * @return mixed
     * @throws ODBException
     * @throws ODBException
     */
    public function getRegistrationById(string $id = null)
    {
        return $this->openDataBotRequest("/registrations/${id}");
    }

    /**
     * Генерування pdf документа з повною інформацією за кодом ЄДРПОУ
     * @param string|null $code - company code
     * @return mixed
     * @throws ODBException
     * @throws ODBException
     */
    public function generatePDFByCode(string $code = null)
    {
        return $this->openDataBotRequest("/pdf/${code}");
    }

    /**
     * Отримати інформацію щодо ліцензій компанії
     * @param string|null $code - код компанії
     * @param int|null $active - статус лицензии (1 or 0)
     * @return mixed
     * @throws ODBException
     * @throws ODBException
     */
    public function getCompanyLicenses(string $code = null, int $active = null)
    {
        return $this->openDataBotRequest("/permits", [
            'code' => $code,
            'active' => $active
        ]);
    }

    /**
     * Отримати найближчі до точки ліцензійний заправні станції
     * @param float $lat (REQUIRED) - широта точки
     * @param float $lng (REQUIRED) - долгота точки
     * @param int $radius (REQUIRED) - радиус поиска в МЕТРАХ
     * @param int|null $offset - Зміщення відносно початку результатів пошуку
     * @param int|null $limit - Кількість записів
     * @return mixed
     * @throws ODBException
     * @throws ODBException
     */
    public function getGasStations(float $lat, float $lng, int $radius, int $offset = null, int $limit = null)
    {
        return $this->openDataBotRequest("/gas-stations", [
            'lat' => $lat,
            'lng' => $lng,
            'radius' => $radius,
            'offset' => $offset,
            'limit' => $limit
        ]);
    }

    /**
     * Отримати інформацію щодо єдиного податку компанії
     * @param string|null $code - код ЄДРПОУ або ІПН
     * @param string|null $pib - ПІБ людини
     * @param string|null $fopHash - Хеш фізичної особи
     * @return mixed
     * @throws ODBException
     * @throws ODBException
     */
    public function getSingletax(string $code = null, string $pib = null, string $fopHash = null)
    {
        return $this->openDataBotRequest("/singletax", [
            'code' => $code,
            'pib' => $pib,
            'fophash' => $fopHash
        ]);
    }

    /**
     * Отримання інформації по коду платника ПДВ
     * @param string|null $pdvCode - Код ПДВ
     * @return mixed
     * @throws ODBException
     * @throws ODBException
     */
    public function getVat(string $pdvCode = null)
    {
        return $this->openDataBotRequest("/vat", [
            'code' => $pdvCode
        ]);
    }

    /**
     * Перевірка існування ФОП або компанії за кодом
     * @param string $companyCode - код ФОП або компанії
     * @return mixed
     * @throws ODBException
     */
    public function checkCompanyExistence(string $companyCode)
    {
        return $this->openDataBotRequest("/check/${companyCode}");
    }

}
