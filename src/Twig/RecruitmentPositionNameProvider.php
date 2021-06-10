<?php

namespace App\Twig;

use App\Enum\RecruitmentPositionEnum;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class RecruitmentPositionNameProvider extends AbstractExtension
{


    public function getFilters()
    {
        return [
            new TwigFilter('getPositionName', [$this, 'getPositionName']),
        ];
    }

    public function getPositionName(string $position): string
    {
        if ($position === RecruitmentPositionEnum::TYPE_ACCOUNTANT) {
            return 'Könyvelő';
        }
        if ($position === RecruitmentPositionEnum::TYPE_ACCOUNT_MANAGER) {
            return 'Sales Account Manager';
        }
        if ($position === RecruitmentPositionEnum::TYPE_JUNIOR_FULL_STACK_DEVELOPER) {
            return 'junior full-stack fejlesztő';
        }
        if ($position === RecruitmentPositionEnum::TYPE_JUNIOR_BACKEND_STACK_DEVELOPER) {
            return 'junior backend fejlesztő';
        }

        if ($position === RecruitmentPositionEnum::TYPE_SENIOR_FULL_STACK_DEVELOPER) {
            return 'senior full-stack fejlesztő';
        }
        if ($position === RecruitmentPositionEnum::TYPE_SENIOR_BACKEND_STACK_DEVELOPER) {
            return 'senior backend fejlesztő';
        }
        if ($position === RecruitmentPositionEnum::TYPE_PROJECT_COORDINATOR) {
            return 'Projekt koordinátor';
        }

        return $position;
    }


}
