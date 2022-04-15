<?php

namespace App\Domain\Repository;

interface QuestionRepositoryInterface
{

    public function findAll(): array|null;

    public function findBy( $tagged, $todate = null, $fromdate = null ): array|null;

}
