<?php

class Crypter
{
  public function cryptification ($password)
  {
    return md5($password);
  }
}
