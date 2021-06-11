<?php


namespace App\Services;


use App\Entity\Recruitment;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class RecruitmentFactory
{


    private const UPLOADS_BASE_DIR = '../uploads/';

    /** @var SluggerInterface */
    private $slugger;


    /**
     * RecruitmentFactory constructor.
     *
     * @param   SluggerInterface  $slugger
     */
    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger         = $slugger;
    }



    /**
     * @param   Recruitment   $recruitment
     * @param   UploadedFile  $cvFile
     */
    public function uploadCv(Recruitment $recruitment, UploadedFile $cvFile)
    {
        $id = $recruitment->getId();
        if ( ! is_dir(self::UPLOADS_BASE_DIR) && ! mkdir($concurrentDirectory = self::UPLOADS_BASE_DIR, 0755) && ! is_dir($concurrentDirectory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
        }
        $targetDir = self::UPLOADS_BASE_DIR.$id.'/';
        if ( ! mkdir($concurrentDirectory = $targetDir, 0755) && ! is_dir($concurrentDirectory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
        }
        if ($cvFile) {
            $safeFilename = $this->slugger->slug($recruitment->getName());
            $newFilename  = $safeFilename.'.'.$cvFile->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $cvFile->move(
                    $targetDir,
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
        }
    }

}
