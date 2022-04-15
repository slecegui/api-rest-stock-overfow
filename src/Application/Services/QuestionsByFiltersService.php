<?php

namespace App\Application\Services;

use App\Domain\Repository\QuestionRepositoryInterface;

class QuestionsByFiltersService
{
    private QuestionRepositoryInterface $discussionRepository;

    public function __construct( QuestionRepositoryInterface $discussionRepository )
    {
       $this->discussionRepository = $discussionRepository;

    }

    public function findBy(string $tagged, string $fromdate = null, string $todate = null): array|null
    {
        return $this->discussionRepository->findBy($tagged, $fromdate, $todate);
    }

}