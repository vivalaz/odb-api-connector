<?php

namespace Vivalaz\OdbApiConnector\Exceptions;

use Exception;

class ODBException extends Exception
{

    /**
     * Throws when API key not specified
     * @return ODBException
     */
    public static function apiKeyNotSpecified()
    {
        return new static('Неверный API ключ!');
    }

    /**
     * Throws when OpenDataBot API unavailable
     * @return ODBException
     */
    public static function serviceUnavailable()
    {
        return new static('OpenDataBot не отвечает!');
    }

    /**
     * Requested data not found
     * @return ODBException
     */
    public static function notFound()
    {
        return new static('Информация по заданым параметрам не найдена!');
    }

    /**
     * Bad request data
     * @param string $responseMsg
     * @return ODBException
     */
    public static function badRequest(string $responseMsg = '')
    {
        return new static($responseMsg);
    }

    /**
     * Payment required for OpenDataBot
     * @return ODBException
     */
    public static function paymentRequired()
    {
        return new static('Достигнут лимит запросов. Для дальнейшего использования сервисом OpenDataBot, пожалуйста, внесите оплату.');
    }

    /**
     * Internal server error
     * @return ODBException
     */
    public static function internalError()
    {
        return new static('Ошибка обработки запроса, пожалуйста, повторите попытку позже!');
    }

    /**
     * Throw when programmer call not existing method
     * @return ODBException
     */
    public static function methodNotFound()
    {
        return new static('Такого метода не существует!');
    }

}
