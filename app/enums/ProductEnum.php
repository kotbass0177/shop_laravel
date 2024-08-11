<?php

namespace App\Enums;

enum ProductEnum: string
{
    case STATUS_PENDING = 'PENDING';
    case STATUS_COMPLETE = 'COMPLETE';
    case ACTIVE = 'ACTIVE';
    case IN_ACTIVE = 'IN ACTIVE';
    case IS_NEW = 'NEW';
    case IS_RECOMMEND = 'RECOMMEND';
    case IS_POPULAR = 'POPULAR';
    case IS_DISCOUNT = 'DISCOUNT';
}
