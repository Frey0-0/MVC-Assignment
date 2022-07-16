<?php

namespace Enum;

abstract class BookStatus
{
    const issued = 1;
    const available = null;
    const return = -1;
    const request = 0;
    const rejected = 2;
}
