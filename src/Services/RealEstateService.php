<?php

namespace Vivalaz\OdbApiConnector\Services;

use Vivalaz\OpenDataBotApiConnector\Exceptions\ODBException;

class RealEstateService extends BaseService
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all subject roles
     * @return array
     */
    public function getSubjectRoles()
    {
        return [
            ['key' => 3, 'description' => 'Обтяжувач'],
            ['key' => 4, 'description' => ' Особа, майно/права якої обтяжуються'],
            ['key' => 6, 'description' => 'Іпотекодержатель'],
            ['key' => 7, 'description' => 'Майновий поручитель'],
            ['key' => 8, 'description' => 'Іпотекодавець'],
            ['key' => 9, 'description' => 'Боржник'],
            ['key' => 10, 'description' => 'Особа, в інтересах якої встановлено обтяження'],
            ['key' => 12, 'description' => 'Правонабувач'],
            ['key' => 13, 'description' => 'Правокористувач'],
            ['key' => 14, 'description' => 'Землевласник'],
            ['key' => 15, 'description' => 'Землеволоділець'],
            ['key' => 16, 'description' => 'Інший'],
            ['key' => 17, 'description' => 'Наймач'],
            ['key' => 18, 'description' => 'Орендар'],
            ['key' => 19, 'description' => 'Наймодавець'],
            ['key' => 20, 'description' => 'Орендодавець'],
            ['key' => 21, 'description' => 'Управитель'],
            ['key' => 22, 'description' => 'Вигодонабувач'],
            ['key' => 23, 'description' => 'Установник']
        ];
    }

    /**
     * Отримати інформацію щодо всіх об’єктів нерухомості, земельних ділянок або обтяжень по компанії або фізичній особі
     * @param string $companyCode - код ЄДРПОУ або ІПН
     * @param int|null $roleId - ID роль суб’єкта
     * @param string|null $timeout - Кількість секунд очікування відповіді від реєстру майнових прав
     * @param int|null $offset - Зміщення відносно початку результатів пошуку
     * @param int|null $limit - Кількість записів
     * @return mixed
     * @throws ODBException
     */
    public function getRealty(string $companyCode, int $roleId = null, string $timeout = null, int $offset = null, int $limit = null)
    {
        return $this->openDataBotRequest("/realty", [
            'code' => $companyCode,
            'offset' => $offset,
            'limit' => $limit,
            'timeout' => $timeout,
            'role' => $roleId
        ]);
    }

    /**
     * Замовити витяг з докладною інформацією по об’єкту нерухомості або земельній ділянці
     * @param int $reportResultId - Ідентифікатор групи адресів суб'єкта
     * @param int $id - Ідентифікатор об'єкта групи reportResultId
     * @return mixed
     * @throws ODBException
     */
    public function getRealtyReportById(int $reportResultId, int $id)
    {
        return $this->openDataBotRequest("/realty/${reportResultId}/${id}");
    }

    /**
     * Замовити витяг з докладною інформацією по об’єкту нерухомості або земельній ділянці
     * @param int $resultId - Ідентифікатор пошуку за результатом витягу
     * @return mixed
     * @throws ODBException
     */
    public function getRealtyResultById(int $resultId)
    {
        return $this->openDataBotRequest("/realty-result", [
            'resultId' => $resultId
        ]);
    }

}
