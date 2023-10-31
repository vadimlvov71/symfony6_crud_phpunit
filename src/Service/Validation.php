<?php

namespace App\Service;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;

class Validation
{
    public static function getConstrains($condition = "all"): Collection
    {
        if ($condition == "current_salary") {
            $constraints = new Assert\Collection([
                'employee[current_salary]' => [
                    new Assert\Type('int'),
                    new Assert\GreaterThan(99)
                ]
            ]);
        } else {
            $constraints = new Assert\Collection([
                'employee[name]' => [
                    new Assert\NotBlank()
                ],
                'employee[lastName]' => [
                    new Assert\NotBlank()
                ],
                'employee[email]' => [
                    new Assert\NotBlank(),
                    new Assert\Email()
                ],
                'employee[current_salary]' => [
                    new Assert\Type('int'),
                    new Assert\GreaterThan(99)
                ],
                'employee[date_to_be_hired]' => [
                    new Assert\NotBlank(),
                    new Assert\GreaterThanOrEqual('today')
                ],
            ]);
        }
        return  $constraints;
    }
}