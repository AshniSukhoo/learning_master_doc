<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Genus;
use Doctrine\ORM\EntityRepository;

class GenusNoteRepository extends EntityRepository
{
    /**
     * @param Genus $genus
     * @return GenusNote[]
     */
    public function findAllRecentNotesForGenus(Genus $genus)
    {
        //SELECT * FROM genus_note WHERE genus_id = some number
        return $this->createQueryBuilder('genus_note')
                    ->andWhere('genus_note.genus = :genus') //andWhere() is done on the genus property not id
                    ->setParameter('genus', $genus)
                    ->andWhere('genus_note.createdAt > :recentDate')
                    ->setParameter('recentDate', new \DateTime('-3 months'))
                    ->getQuery()
                    ->execute();
    }
}
