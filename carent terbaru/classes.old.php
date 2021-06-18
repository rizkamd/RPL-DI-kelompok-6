
<?php

class IniClass
{
  private $test = "halo";
  
  function ok() {
    return $this->test;
  }
}

$va = new IniClass();
echo $va->ok(); 