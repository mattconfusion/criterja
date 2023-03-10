<?php declare(strict_types=1);

namespace Criterja\s2j;

interface JiraApiService {

    public function getAcceptanceCriteriaFieldId();
    public function updateIssue();
}