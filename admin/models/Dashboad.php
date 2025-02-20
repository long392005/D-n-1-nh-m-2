<?php
class dashboard
{
public $conn;

public function __construct()
{
  $this->conn = connectDB();
}

}