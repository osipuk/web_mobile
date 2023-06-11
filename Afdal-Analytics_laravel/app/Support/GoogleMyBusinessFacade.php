<?php
  
namespace App\Support;
  
use Illuminate\Support\Facades\Facade;
  
class GoogleMyBusinessFacade extends Facade{

    protected static function getFacadeAccessor() { 

        return 'GoogleMyBusiness'; 
    }
}


