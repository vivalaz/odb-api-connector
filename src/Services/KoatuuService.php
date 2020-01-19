<?php

namespace Vivalaz\OdbApiConnector\Services;

use Vivalaz\OpenDataBotApiConnector\Exceptions\ODBException;

class KoatuuService extends BaseService
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Отримати список всіх областей України
     * @return mixed
     * @throws ODBException
     */
    public function getRegions()
    {
        return $this->openDataBotRequest("/koatuu/regions");
    }

    /**
     * Отримати область України по КОАТУУ коду
     * @param int $regionKoatuu - КОАТУУ код (10 цифр)
     * @return mixed
     * @throws ODBException
     */
    public function getRegionByCode(int $regionKoatuu)
    {
        return $this->openDataBotRequest("/koatuu/regions/${regionKoatuu}");
    }

    /**
     * Отримання відомостей про номери рахунків для сплати податків
     * @param string $regionKoatuu - КОАТУУ код (10 цифр)
     * @param string|null $taxCode - Код класифікації доходів бюджету
     * @param int|null $offset - Зміщення відносно початку результатів пошуку
     * @param int|null $limit - Кількість записів
     * @return mixed
     * @throws ODBException
     */
    public function getTaxPaymentAccounts(string $regionKoatuu, string $taxCode = null, int $offset = null, int $limit = null)
    {
        return $this->openDataBotRequest("/tax-payment-accounts", [
            'koatuu' => $regionKoatuu,
            'tax_code' => $taxCode,
            'offset' => $offset,
            'limit' => $limit
        ]);
    }

}
