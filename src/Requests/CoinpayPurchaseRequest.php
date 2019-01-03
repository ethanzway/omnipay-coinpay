<?php

namespace Omnipay\Coinpay\Requests;

use Omnipay\Coinpay\Common\Signer;
use Omnipay\Coinpay\Common\Validator;
use Omnipay\Coinpay\Responses\CoinpayPurchaseResponse;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Class CoinpayPurchaseRequest
 * @package Omnipay\Coinpay\Requests
 */
class CoinpayPurchaseRequest extends AbstractRequest
{
    protected $endpoint;

    protected $key;

    protected $sign_type;

    public function getData()
    {
        $this->validateParams();
        $data = $this->parameters->all();
        $data['sign'] = $this->sign($data['transaction'], $this->getKey());
        return $data;
    }

    protected function validateParams()
    {
        $validator = new Validator();
        $validator->validate(
                        [
                            'transaction.serial_number',
                            'transaction.subject',
                            'transaction.total_fee',
                            'transaction.return_url',
                            'transaction.notify_url',
                        ],
                        $this->parameters->all()
                    );
    }

    public function sendData($data)
    {
        return $this->response = new CoinpayPurchaseResponse($this, $data);
    }

    public function getTransaction()
    {
        return $this->getParameter('transaction');
    }

    public function setTransaction($value)
    {
        return $this->setParameter('transaction', $value);
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setKey($value)
    {
        $this->key = $value;
        return $this;
    }
    
    public function getEndpoint()
    {
        return $this->endpoint;
    }
    
    public function setEndpoint($value)
    {
        $this->endpoint = $value;
        return $this;
    }
    
    protected function sign($params, $key)
    {
        $signer = new Signer($params);
        $sign = $signer->signWithMD5($key);
        return $sign;
    }
}
