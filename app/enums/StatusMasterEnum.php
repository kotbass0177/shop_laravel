<?php

namespace App\enums;

enum StatusMasterEnum: string
{
    case PENDING = 'PENDING';
    case COMPLETE = 'COMPLETE';
    case CANCEL = 'CANCEL';
    case REJECT = 'REJECT';
}
