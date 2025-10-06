<?php

namespace App\Enums;

enum PaymentStatusEnum: int
{
    case SUCCESS = 1;
    case FAILED = 2;
    case REFUNDED = 3;
}