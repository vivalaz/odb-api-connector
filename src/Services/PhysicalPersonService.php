<?php

namespace Vivalaz\OdbApiConnector\Services;

use Vivalaz\OpenDataBotApiConnector\Exceptions\ODBException;

class PhysicalPersonService extends BaseService
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Отримання публічної інформації щодо особи, за її ПІБ: зареєстровані ФОП, директор компанії або директор в минулому,
     * власник компанії або власник в минулому, наявність в розшуку МВС, наявність стороною по справі в адміністративних,
     * кримінальніх та господарських процесах (з лютого 2016), наявність в базі боржників за аліментами
     * @param string $pib - ПІБ особи
     * @param int $offset - Зміщення відносно початку результатів пошуку
     * @param int|null $limit - Кількість записів
     * @return mixed
     * @throws ODBException
     */
    public function getPersonInfo(string $pib, int $offset = null, int $limit = null)
    {
        return $this->openDataBotRequest("/person", [
            'pib' => $pib,
            'start' => $offset,
            'limit' => $limit
        ]);
    }

    /**
     * Отримання публічної інформації щодо особи, наявність в базі боржників за аліментами
     * @param string $pib - ПІБ особи
     * @param string|null $birthday - Фільтр за датою народження в форматі
     * @param int $offset - Зміщення відносно початку результатів пошуку
     * @param int|null $limit - Кількість записів
     * @return mixed
     * @throws ODBException
     */
    public function getPersonAliments(string $pib, string $birthday = null, int $offset = null, int $limit = null)
    {
        return $this->openDataBotRequest("/aliment", [
            'pib' => $pib,
            'birth_date' => $birthday,
            'start' => $offset,
            'limit' => $limit
        ]);
    }

    /**
     * Отримання переліку адвокатів
     * @param string $pib - ПІБ особи
     * @param int $offset - Зміщення відносно початку результатів пошуку
     * @param int|null $limit - Кількість записів
     * @return mixed
     * @throws ODBException
     */
    public function getLawyers(string $pib, int $offset = null, int $limit = null)
    {
        return $this->openDataBotRequest("/lawyers", [
            'name' => $pib,
            'offset' => $offset,
            'limit' => $limit
        ]);
    }

    /**
     * Отримання інформації про Адвоката
     * @param string $id - внутрішній id, який отримали при пошуку адвокатів
     * @return mixed
     * @throws ODBException
     */
    public function getLawyerById(string $id)
    {
        return $this->openDataBotRequest("/lawyers/${id}");
    }

    /**
     * Отримання відомостей про осіб, які вчинили корупційні правопорушення
     * @param string $pib - ПІБ особи
     * @param int $offset - Зміщення відносно початку результатів пошуку
     * @param int|null $limit - Кількість записів
     * @return mixed
     * @throws ODBException
     */
    public function getCorruptOfficialsInfo(string $pib, int $offset = null, int $limit = null)
    {
        return $this->openDataBotRequest("/corrupt-officials", [
            'pib' => $pib,
            'start' => $offset,
            'limit' => $limit
        ]);
    }

    /**
     * Отримання відомостей про осібу, яка вчинила корупційні правопорушення, за внутрішнім id
     * @param string $id - внутрішній id, який отримали при пошуку корупціонерів по ПІБ
     * @return mixed
     * @throws ODBException
     */
    public function getCorruptOfficialsInfoById(string $id)
    {
        return $this->openDataBotRequest("/corrupt-officials/${id}");
    }

    /**
     * Отримання інформації про викрадені/втрачені паспорти громадянина України
     * @param string $passportNumber - Номер паспорту, наприклад CP634742
     * @return mixed
     * @throws ODBException
     */
    public function getLostPassportInfo(string $passportNumber)
    {
        return $this->openDataBotRequest("/passport", [
            'number' => $passportNumber
        ]);
    }

    /**
     * Отримання інформації по базі людей в розшуку
     * @param string $pib - ПІБ особи
     * @param int $offset - Зміщення відносно початку результатів пошуку
     * @param int|null $limit - Кількість записів
     * @return mixed
     * @throws ODBException
     */
    public function getWanted(string $pib, int $offset = null, int $limit = null)
    {
        return $this->openDataBotRequest("/wanted", [
            'pib' => $pib,
            'offset' => $offset,
            'limit' => $limit
        ]);
    }

}
