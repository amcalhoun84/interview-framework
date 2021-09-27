<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;


class ExampleModel
{

  public function get(int $id): array
  {

    $sql = DB::select('select id, created_at, code, description from master_example where id = ?', [$id]);

    return $sql;
  }


  public function create(string $created, string $code, string $description): int
  {

    $id = DB::insert('insert into master_example (created_at, code, description) values (?, ?, ?, ?)', [$created, $code, $description]);

    return $id;
  }
}