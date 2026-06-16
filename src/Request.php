<?php

class Request
{
  
  /**
   * @var boolean
   */
  protected bool $isPost = false;

  /**
   * @var array
   */
  protected array $request = array();

  /**
   * Construct Request
   */
  public function __construct()
  {
    $this->isPost = $_SERVER['REQUEST_METHOD'] === "POST";
    $this->request = $_POST ?? array();
  }

  /**
   * @return bool
   */
  public function isPost(): bool
  {
    return $this->isPost;
  }

  /**
   * @param $keyname
   *
   * @return bool
   */
  public function has($keyname): bool
  {
    return array_key_exists($keyname, $this->request);
  }

  /**
   * @param string $keyname
   * @param $default
   *
   * @return mixed
   */
  public function get(string $keyname, $default = null): mixed
  {
    return $this->has($keyname) ? $this->request[$keyname] : $default;
  }

}