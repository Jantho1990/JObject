<?php

/**
 *  This is just a generic object template.
 *  It is designed to get and set whatever properties are explicitly
 *  defined on the object. This is useful for data objects.
 */
class JObject {
  private $prop1 = null;
  private $prop2 = null;
  private $prop3 = null;

  public function __construct(){
    $arguments = func_get_args();
    if(!(count($arguments) === 0)){
      $this->__set($arguments);
    }
  }

  public function __set($key, $val=null){
    if(is_array($key)){
      foreach($key as $k=>$kv){
        if(is_numeric($k)){
          $kk = array_keys(get_object_vars($this))[$k];
          $this->$kk = $kv;
        }elseif(property_exists($this, $k)){
          $this->$k = $kv;
        }else{
          trigger_error(
            'Undefined property (' . $k . ')'
          );
        }
      }
    }else{
      if(property_exists($this, $key)){
        $this->$key = $val;
      }else{
        trigger_error(
          'Undefined property (' + $key + ')'
        );
      }
    }
  }

  public function __get($key=null){
    if(is_null($key)){
      return get_object_vars($this);
    }else{
      if(property_exists($this, $key)){
        return $this->$key;
      }else{
        trigger_error(
          'Undefined property (' + $key + ')'
        );
        return null;
      }
    }
  }

  public function __destruct(){

  }
}