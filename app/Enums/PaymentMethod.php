<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case CreditCard = 'credit_card';
    case DebitCard = 'debit_card';
    case PayPal = 'paypal';
    case Stripe = 'stripe';
    case Cash = 'cash';
    case COD = 'cod'; // Cash on Delivery


}