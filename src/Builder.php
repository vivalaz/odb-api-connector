<?php

namespace Vivalaz\OdbApiConnector;

use Vivalaz\OpenDataBotApiConnector\Exceptions\ODBException;
use Vivalaz\OpenDataBotApiConnector\Services\BusinessMonitoringService;
use Vivalaz\OpenDataBotApiConnector\Services\CompanyService;
use Vivalaz\OpenDataBotApiConnector\Services\CourtService;
use Vivalaz\OpenDataBotApiConnector\Services\KoatuuService;
use Vivalaz\OpenDataBotApiConnector\Services\PenaltyService;
use Vivalaz\OpenDataBotApiConnector\Services\PhysicalPersonService;
use Vivalaz\OpenDataBotApiConnector\Services\RealEstateService;
use Vivalaz\OpenDataBotApiConnector\Services\TransportService;

/**
 * Class Builder
 * @package Vivalaz\OpenDataBotApiConnector
 *
 * Class TransportService
 * @method setArgs(string $apiKey)
 * @method getApiUsageStatistics() - BaseService
 * @method getListOfTransports(string $vehicleNumber = null, int $offset = null, int $limit = null)
 * @method getInfoByTransportId(string $vehicleId = null)
 * @method getTransportLicenses(string $transportNumber = '', string $companyCode = '', int $offset = null, int $limit = null, string $ownerHash = null) - TransportService
 * @method getInfoByTransportLicenseId(string $licenseId = null)
 * @method getInfoByTransportPassportNumber(string $transportPassportNumber = null)
 * @method getTransportPassports(string $transportNumber = null, string $vin = null, $dateOfReg = null)
 *
 * Class CompanyService
 * @method getFullCompanyData(string $code = null, bool $edr = false)
 * @method getFopData(string $code = null)
 * @method getCompaniesData(array $companiesCodes = [])
 * @method getCompaniesChanges(array $companiesCodes = [], string $from = null)
 * @method getCompanyWagedebt(string $code = null)
 * @method getAudit(string $code = null, string $pib = null, int $limit = null, int $offset = null)
 * @method getAuditById(string $id = null)
 * @method getNewRegistrations(string $type = 'company', int $offset = null, int $limit = null, string $regDateFrom = null, string $regDateTo = null, array $activities = [], array $locations = [], bool $isPhone = false, bool $isEmail = false, string $sort = 'ASC')
 * @method getRegistrationById(string $id = null)
 * @method generatePDFByCode(string $code = null)
 * @method getCompanyLicenses(string $code = null, int $active = null)
 * @method getGasStations(float $lat, float $lng, int $radius, int $offset = null, int $limit = null)
 * @method getSingletax(string $code = null, string $pib = null, string $fopHash = null)
 * @method getVat(string $pdvCode = null)
 * @method checkCompanyExistence(string $companyCode)
 *
 * Class CourtService
 * @method getCourtStages()
 * @method getCourtSearchCriteria()
 * @method getDateFilterSettings()
 * @method getCourts(int $judgment = null, int $justice = null, string $text = null, string $stage = null, string $textIntro = null, string $textResolution = null, string $number = null, string $dateFrom = null, string $dateTo = null, string $searchCriteria = null, int $offset = null, int $limit = null)
 * @method getCourtById(int $id)
 * @method findBySchedule(string $textInvolved = null, string $textDescription = null, string $date = null, string $courtId = null, string $judgmentCode = null, string $number = null, int $offset = null, int $limit = null)
 * @method getCompanyCourts(string $companyCode)
 * @method getCompanyCourtsByType(string $type, string $companyCode, string $sortField = null, string $sortType = null, string $dateFrom = null, string $dateFromSettings = null, int $offset = null, int $limit = null)
 * @method getCourtCasesByNumber(string $courtNumber, int $judgmentCode = null)
 *
 * Class BusinessMonitoringService
 * @method getMonitoringTypes()
 * @method getListsTypes()
 * @method getTimelineTypes()
 * @method subscribe(string $monitoringType, string $companyCode = null, string $term = null, string $secretKey = null)
 * @method unsubscribe(string $monitoringType, int $id)
 * @method getListsInfo(string $type = null)
 * @method getHistory(string $fromId = null, bool $debug = false, int $offset = null, int $limit = null)
 * @method setWebhook(string $url, string $token = null)
 * @method sendWebhook(int $notificationId)
 * @method getWebhook(string $url = null)
 * @method getTimeline(string $companyCode, string $fromId = null, string $timeLineType = null, string $dateStart = null, string $dateEnd = null, int $offset = null, int $limit = null, string $order = null, string $orderField = null)
 *
 * Class KoatuuService
 *
 * @method getRegions()
 * @method getRegionByCode(int $regionKoatuu)
 * @method getTaxPaymentAccounts(string $regionKoatuu, string $taxCode = null, int $offset = null, int $limit = null)
 *
 * Class PenaltyService
 *
 * @method getPerformerTypes()
 * @method getFullPenaltyByNumber(string $number, string $source = null)
 * @method getPenaltyByNumberAndSecret(string $number, string $secret)
 * @method getFullPenalty(string $borrowerCode = null, string $creditorCode = null, string $borrowerFirstName = null, string $borrowerLastName = null, string $borrowerMiddleName = null, string $borrowerBirthday = null, int $offset = null, int $limit = null, string $source = null)
 * @method getPerformerInfo(string $name = null, string $performerType = null, int $regionId = null, int $offset = null, int $limit = null)
 * @method getPenaltiesByCode(string $companyCode, int $offset = null, int $limit = null)
 * @method getPenaltyByNumber(string $number)
 * @method getPenaltiesByPerson(string $firstName, string $lastName, string $birthday, string $middleName = null)
 *
 * Class PhysicalPersonService
 *
 * @method getPersonInfo(string $pib, int $offset = null, int $limit = null)
 * @method getPersonAliments(string $pib, string $birthday = null, int $offset = null, int $limit = null)
 * @method getLawyers(string $pib, int $offset = null, int $limit = null)
 * @method getLawyerById(string $id)
 * @method getCorruptOfficialsInfo(string $pib, int $offset = null, int $limit = null)
 * @method getCorruptOfficialsInfoById(string $id)
 * @method getLostPassportInfo(string $passportNumber)
 * @method getWanted(string $pib, int $offset = null, int $limit = null)
 *
 * Class RealEstateService
 *
 * @method getSubjectRoles()
 * @method getRealty(string $companyCode, int $roleId = null, string $timeout = null, int $offset = null, int $limit = null)
 * @method getRealtyReportById(int $reportResultId, int $id)
 * @method getRealtyResultById(int $resultId)
 */
class Builder
{

    private $serviceClasses = [
        TransportService::class,
        CompanyService::class,
        CourtService::class,
        BusinessMonitoringService::class,
        KoatuuService::class,
        PenaltyService::class,
        PhysicalPersonService::class,
        RealEstateService::class
    ];

    private $services = [];

    public function __construct()
    {
        foreach ($this->serviceClasses as $service) {
            $this->services[] = new $service;
        }
    }

    public function __call($name, $arguments)
    {
        foreach ($this->services as $service) {
            if (method_exists($service, $name)) {
                return $service->{$name}(...$arguments);
            }
        }

        throw ODBException::methodNotFound();
    }

}
