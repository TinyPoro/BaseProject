<?php
/**
 * Created by PhpStorm.
 * User: TinyPoro
 * Date: 1/16/20
 * Time: 3:50 PM
 */

namespace App\Services;

use App\Repositories\TestRepositoryInterface;
use Illuminate\Support\Facades\Log;

class TestService implements TestServiceInterface
{
    private $testRepository;

    public function __construct(
        TestRepositoryInterface $testRepository
    ) {
        $this->testRepository = $testRepository;
    }

    public function test()
    {
        try {
            $this->testRepository->test();
        } catch (\Exception $e) {
            Log::error("Error at test: {$e->getMessage()}");

            throw $e;
        }
    }
}