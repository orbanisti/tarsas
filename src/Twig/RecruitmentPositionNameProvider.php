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
            new TwigFilter('getPositionNameByType', [$this, 'getPositionNameByType']),
        ];
    }

    public function getPositionNameByType(string $type): string
    {
        if ($type === RecruitmentPositionEnum::TYPE_ACCOUNTANT) {
            return 'Könyvelő';
        }
        if ($type === RecruitmentPositionEnum::TYPE_ACCOUNT_MANAGER) {
            return 'Sales Account Manager';
        }
        if ($type === RecruitmentPositionEnum::TYPE_JUNIOR_FULL_STACK_DEVELOPER) {
            return 'junior full-stack fejlesztő';
        }
        if ($type === RecruitmentPositionEnum::TYPE_JUNIOR_BACKEND_STACK_DEVELOPER) {
            return 'junior backend fejlesztő';
        }

        if ($type === RecruitmentPositionEnum::TYPE_SENIOR_FULL_STACK_DEVELOPER) {
            return 'senior full-stack fejlesztő';
        }
        if ($type === RecruitmentPositionEnum::TYPE_SENIOR_BACKEND_STACK_DEVELOPER) {
            return 'senior backend fejlesztő';
        }

        return $type;
    }


}
