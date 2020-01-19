<?php

namespace Vivalaz\OdbApiConnector\Services;

use Vivalaz\OpenDataBotApiConnector\Exceptions\ODBException;

class TransportService extends BaseService
{

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Getting a list of vehicles
     * Отримання переліку транспортних засобів
     * @param string|null $vehicleNumber - Номер транспортного засобу
     * @param int|null $offset - Зміщення відносно початку результатів пошуку
     * @param int|null $limit - Кількість записів
     * @return
     * @throws ODBException
     */
    public function getListOfTransports(string $vehicleNumber = null, int $offset = null, int $limit = null)
    {
        return $this->openDataBotRequest("/transport", [
            'start' => $offset,
            'limit' => $limit,
            'number' => $vehicleNumber
        ]);
    }

    /**
     * Obtaining vehicle registration information
     * Отримання інформації по реєстрації транспортного засобу
     * @param string|null $vehicleId - внутрішній id, який отримали при пошуку транспортних засобів
     * @return
     * @throws ODBException
     */
    public function getInfoByTransportId(string $vehicleId = null)
    {
        return $this->openDataBotRequest("/transport/${vehicleId}");
    }

    /**
     * List of transport licenses
     * Перелік ліцензій транспортних засобів
     * @param string $transportNumber - Номер транспортного засобу
     * @param string $companyCode - Код компанії або ІНН ФОП
     * @param int|null $offset - Зміщення відносно початку результатів пошуку
     * @param int|null $limit - Кількість записів
     * @param string|null $ownerHash - Внутрішній id власника
     * @return mixed
     * @throws ODBException
     */
    public function getTransportLicenses(string $transportNumber = '', string $companyCode = '', int $offset = null, int $limit = null, string $ownerHash = null)
    {
        return $this->openDataBotRequest("/transport-licenses", [
            'offset' => $offset,
            'limit' => $limit,
            'number' => $transportNumber,
            'code' => $companyCode,
            'owner_hash' => $ownerHash
        ]);
    }

    /**
     * Obtaining transport license information
     * Отримання інформації про ліцензію транспортного засобу
     * @param string|null $licenseId - внутрішній id, який отримали при пошуку ліцензій транспортних засобів
     * @return
     * @throws ODBException
     */
    public function getInfoByTransportLicenseId(string $licenseId = null)
    {
        return $this->openDataBotRequest("/transport-licenses/${$licenseId}");
    }

    /**
     * Obtaining information on checking the car registration certificate (technical passport)
     * Отримання інформації щодо перевірки свідоцтва про реєстрацію авто (техпаспорт)
     * @param string|null $transportPassportNumber - номер свідоцтва
     * @return
     * @throws ODBException
     */
    public function getInfoByTransportPassportNumber(string $transportPassportNumber = null)
    {
        return $this->openDataBotRequest("/transport-passports/${transportPassportNumber}");
    }

    /**
     * Obtaining information on checking the car registration certificate (technical passport)
     * Отримання інформації щодо перевірки свідоцтва про реєстрацію авто (техпаспорт)
     * @param string|null $transportNumber - номер автомобіля
     * @param string|null $vin - VIN-код
     * @param null $dateOfReg - дата реєстрації
     * @return mixed
     * @throws ODBException
     */
    public function getTransportPassports(string $transportNumber = null, string $vin = null, $dateOfReg = null)
    {
        return $this->openDataBotRequest("/transport-passports", [
            'number' => $transportNumber,
            'date_reg' => $dateOfReg,
            'vin' => $vin
        ]);
    }

}
