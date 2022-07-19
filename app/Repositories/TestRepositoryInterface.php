<?php
/**
 * Created by PhpStorm.
 * User: TinyPoro
 * Date: 1/16/20
 * Time: 3:50 PM
 */

namespace App\Repositories;


interface TestRepositoryInterface extends RepositoryInterface
{
    const TYPE_A = 'A';
    const TYPE_B = 'B';

    public function test();
}