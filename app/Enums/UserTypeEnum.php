<?php

namespace App\Enums;

enum UserTypeEnum: string 
 {
   case HEAD = 'head';
    case ADMIN ='admin';
    case USER ='user';
    case FAMILY ='family';
}