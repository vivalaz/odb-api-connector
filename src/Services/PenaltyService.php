<?php


namespace Vivalaz\OdbApiConnector\Services;

use Vivalaz\OpenDataBotApiConnector\Exceptions\ODBException;

class PenaltyService extends BaseService
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get penalty performer types
     * @return array
     */
    public function getPerformerTypes()
    {
        return [
            ['key' => 'private', 'description' => 'Приватна виконавча служба'],
            ['key' => 'government', 'description' => 'Державна виконавча служба']
        ];
    }

    /**
     * Отримання інформації про історію виконавчих проваджень компанії або приватної особи за номером провадження
     * @param string $number - Номер виконавчого провадження
     * @param string|null $source - Джерело з якого виконується витяг інформації по виконавчим провадженням (opendatabot)
     * @return mixed
     * @throws ODBException
     */
    public function getFullPenaltyByNumber(string $number, string $source = null)
    {
        return $this->openDataBotRequest("/full-penalty/${number}", [
            'source' => $source
        ]);
    }

    /**
     * Отримання інформації про історію виконавчих проваджень компанії або приватної особи за номером провадження та ідентифікатором доступу
     * @param string $number - Номер виконавчого провадження
     * @param string $secret - Ідентифікатор доступу
     * @return mixed
     * @throws ODBException
     */
    public function getPenaltyByNumberAndSecret(string $number, string $secret)
    {
        return $this->openDataBotRequest("/full-penalty-doc/${number}", [
            'secret' => $secret
        ]);
    }

    /**
     * Отримання інформації про історію виконавчих проваджень компанії або приватної особи за стороною провадження
     * @param string|null $borrowerCode - код ЄДРПОУ боржника
     * @param string|null $creditorCode - код ЄДРПОУ стягувача
     * @param string|null $borrowerFirstName - Ім'я боржника
     * @param string|null $borrowerLastName - Прізвище боржника
     * @param string|null $borrowerMiddleName - По-батькові боржника
     * @param string|null $borrowerBirthday - Дата народження боржника
     * @param int $offset - Зміщення відносно початку результатів пошуку
     * @param int|null $limit - Кількість записів
     * @param string|null $source - Джерело з якого виконується витяг інформації по виконавчим провадженням (opendatabot)
     * @return mixed
     * @throws ODBException
     */
    public function getFullPenalty(
        string $borrowerCode = null,
        string $creditorCode = null,
        string $borrowerFirstName = null,
        string $borrowerLastName = null,
        string $borrowerMiddleName = null,
        string $borrowerBirthday = null,
        int $offset = null,
        int $limit = null,
        string $source = null
    )
    {
        return $this->openDataBotRequest("/full-penalty", [
            'borrower_code' => $borrowerCode,
            'creditor_code' => $creditorCode,
            'borrower_first_name' => $borrowerFirstName,
            'borrower_last_name' => $borrowerLastName,
            'borrower_middle_name' => $borrowerMiddleName,
            'borrower_birth_date' => $borrowerBirthday,
            'offset' => $offset,
            'limit' => $limit,
            'source' => $source
        ]);
    }

    /**
     * Отримання інформації про державні та приватні виконавчі служби
     * @param string|null $name - Назва або ПІБ виконавчої служби
     * @param string|null $performerType
     * @param int|null $regionId - Код регіону для пошуку
     * @param int $offset - Зміщення відносно початку результатів пошуку
     * @param int|null $limit - Кількість записів
     * @return mixed
     * @throws ODBException
     */
    public function getPerformerInfo(
        string $name = null,
        string $performerType = null,
        int $regionId = null,
        int $offset = null,
        int $limit = null
    )
    {
        return $this->openDataBotRequest("/performer", [
            'name' => $name,
            'region_id' => $regionId,
            'type' => $performerType,
            'offset' => $offset,
            'limit' => $limit
        ]);
    }

    /**
     * Отримання інформації про актуальні виконавчі провадження компанії або приватної особи за кодом боржника
     * @param string $companyCode - код ЄДРПОУ
     * @param int $offset - Зміщення відносно початку результатів пошуку
     * @param int|null $limit - Кількість записів
     * @return mixed
     * @throws ODBException
     */
    public function getPenaltiesByCode(string $companyCode, int $offset = null, int $limit = null)
    {
        return $this->openDataBotRequest("/penalties/${companyCode}", [
            'offset' => $offset,
            'limit' => $limit
        ]);
    }

    /**
     * Отримання інформації про історію виконавчих проваджень компанії або приватної особи за номером провадження
     * @param string $number - Виконавчий номер
     * @return mixed
     * @throws ODBException
     */
    public function getPenaltyByNumber(string $number)
    {
        return $this->openDataBotRequest("/penalty/${number}");
    }

    /**
     * Отримання інформації про актуальні виконавчі провадження приватної особи за ПІБ
     * @param string $firstName - Ім’я боржника
     * @param string $lastName - Прізвище боржника
     * @param string $birthday - Дата народження у форматі YYYY-MM-DD
     * @param string|null $middleName - По-батькові боржника
     * @return mixed
     * @throws ODBException
     */
    public function getPenaltiesByPerson(string $firstName, string $lastName, string $birthday, string $middleName = null)
    {
        return $this->openDataBotRequest("/penalties", [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'birth_date' => $birthday,
            'middle_name' => $middleName
        ]);
    }

}
