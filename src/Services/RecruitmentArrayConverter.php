<?php


namespace App\Services;


use App\Entity\Recruitment;

class RecruitmentArrayConverter
{

    /**
     * @param   Recruitment  $recruitment
     *
     * @return array
     */
    public function convert(Recruitment $recruitment): array
    {
        return [
            'name'         => $recruitment->getName(),
            'subject'      => $recruitment->getSubject(),
            'position'     => $recruitment->getSelectPosition(),
            'emailAddress' => $recruitment->getEmail(),
            'phone'        => $recruitment->getPhone(),
            'message'      => $recruitment->getMessage(),
        ];
    }

}
