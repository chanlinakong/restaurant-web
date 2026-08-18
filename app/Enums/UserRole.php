<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'Admin';
    case Staff = 'Staff';
    case Customer = 'Customer';
}