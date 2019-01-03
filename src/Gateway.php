<?php

namespace Omnipay\Coinpay;

use Omnipay\Coinpay\Requests\CoinpayCompletePurchaseRequest;
use Omnipay\Coinpay\Requests\CoinpayPurchaseRequest;
use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{

    public function getDefaultParameters()
    {
        return [];
    }
    
    public function getName()
    {
        return 'Coinpay Gateway';
    }

    public function purchase(array $parameters = [])
    {
        return $this->createRequest(CoinpayPurchaseRequest::class, $parameters);
    }

    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest(CoinpayCompletePurchaseRequest::class, $parameters);
    }

    public function refund(array $parameters = [])
    {
    }

    public function completeRefund(array $parameters = [])
    {
    }

    public function query(array $parameters = [])
    {
    }
    
    public function getKey()
    {
        return $this->getParameter('key');
    }
    
    public function setKey($value)
    {
        return $this->setParameter('key', $value);
    }
    
    public function getEndpoint()
    {
        return $this->getParameter('endpoint');
    }
    
    public function setEndpoint($value)
    {
        return $this->setParameter('endpoint', $value);
    }
}
