<?php


namespace App\Services;


use App\Entity\Recruitment;
use App\Enum\EmailEnum;
use App\Enum\RecruitmentTypeEnum;

class RecruitmentMailDestinationProvider
{

    /**
     * @param   Recruitment  $recruitment
     *
     * @return string
     * @throws \Exception
     */
    public function getTo(Recruitment $recruitment)
    {
        if ($recruitment->getType() === RecruitmentTypeEnum::TYPE_CONTACT) {
            return EmailEnum::EMAIL_INFO;
        }
        if ($recruitment->getType() === RecruitmentTypeEnum::TYPE_CARREER) {
            return $recruitment->getEmail();
        }
        throw new \Exception('No destination address for this email type');
    }

    /**
     * @param   Recruitment  $recruitment
     *
     * @return string
     * @throws \Exception
     */
    public function getCC(Recruitment $recruitment)
    {
        if ($recruitment->getType() === RecruitmentTypeEnum::TYPE_CONTACT) {
            return EmailEnum::EMAIL_TOTH_ANDRAS;
        }
        if ($recruitment->getType() === RecruitmentTypeEnum::TYPE_CARREER) {
            return EmailEnum::EMAIL_JOBS;
        }

        return null;
    }

}
