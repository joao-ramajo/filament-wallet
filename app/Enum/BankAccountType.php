<?php

namespace App\Enum;

enum BankAccountType: string
{
    case Checking = 'checking';
    case Savings = 'savings';
    case Credit = 'credit';

    public function label(): string
    {
        return match ($this) {
            self::Checking => 'Checking Account',
            self::Savings => 'Savings Account',
            self::Credit => 'Credit Card',
        };
    }
}
