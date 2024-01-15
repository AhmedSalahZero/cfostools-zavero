<?php

namespace App\Interfaces\Models;

interface IShareable
{
        public static function getCrudViewName():string ; 
        public static function getShareableEditViewVars($model):array ; 
}