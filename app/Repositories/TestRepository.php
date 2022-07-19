<?php
/**
 * Created by PhpStorm.
 * User: TinyPoro
 * Date: 1/16/20
 * Time: 3:50 PM
 */

namespace App\Repositories;

use App\Models\User;

class TestRepository extends AbstractRepository implements TestRepositoryInterface
{
    public function model()
    {
        return User::class;
    }

    public function test()
    {
    }
}