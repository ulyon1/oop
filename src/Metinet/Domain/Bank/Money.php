<?php

namespace Metinet\Domain\Bank;

use Metinet\Domain\Bank\Exceptions\UnsupportedCurrencyConversionException;
use Metinet\Domain\Bank\Exceptions\UnsupportedCurrencyException;

class Money
{
    private const SUPPORTED_CURRENCIES = ['€', '$', '£'];

    private $currency;
    private $amountInLowestUnity;

    public function __construct(string $currency, int $amount)
    {
        $this->ensureCurrencyIsSupported($currency);

        $this->currency = $currency;
        $this->amountInLowestUnity = $amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getAmountInLowestUnity(): int
    {
        return $this->amountInLowestUnity;
    }

    public function ensureCurrencyIsSupported(string $currency): void
    {
        if(!in_array($currency, self::SUPPORTED_CURRENCIES))
        {
            throw new UnsupportedCurrencyException($currency);
        }
    }

    public function add(Money $amount): void
    {
        if($this->currency !== $amount->currency) $amount->convert($this->currency);
        $this->amountInLowestUnity += $amount->amountInLowestUnity;
    }

    public function substract(Money $amount): void
    {
        if($this->currency !== $amount->currency) $amount->convert($this->currency);
        $this->amountInLowestUnity -= $amount->amountInLowestUnity;
    }

    public function convert(string $currency): void
    {
        // Object conversion to given currency
        if(1)
        {
            throw new UnsupportedCurrencyConversionException($this->currency, $currency);
        }
    }

    public function getAmountFormatedForCurrency(string $currency): string
    {
        // everything in the name of the function
        return "not supported";
    }
}