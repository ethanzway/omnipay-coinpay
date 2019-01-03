<?php

namespace Omnipay\Coinpay\Requests;

use Omnipay\Coinpay\Common\Signer;
use Omnipay\Coinpay\Common\Validator;
use Omnipay\Coinpay\Responses\CoinpayCompletePurchaseResponse;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

class CoinpayCompletePurchaseRequest extends AbstractRequest
{
    protected $endpoint;

    protected $app_id;

    protected $app_key;

    protected $sign;
    
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
                            'transaction.type',
                            'transaction.status',
                        ],
                        $this->parameters->all()
                    );
    }

    public function sendData($data)
    {
        return $this->response = new CoinpayCompletePurchaseResponse($this, $data);
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

    public function getSign()
    {
        return $this->sign;
    }

    public function setSign($value)
    {
        $this->sign = $value;
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
