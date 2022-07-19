<?php
/**
 * Created by PhpStorm.
 * User: TinyPoro
 * Date: 1/16/20
 * Time: 3:50 PM
 */

namespace App\Services;


interface TestServiceInterface
{
    const TYPE_A = 'A';
    const TYPE_B = 'B';

    public function test();
}