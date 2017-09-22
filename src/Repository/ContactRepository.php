<?php
/**
 * Created by PhpStorm.
 * User: amor3
 * Date: 22/09/17
 * Time: 14:34
 */

namespace App\Repository;


use App\Entity\Contact;
use Doctrine\ORM\EntityRepository;

class ContactRepository extends EntityRepository
{
    public function edit(Contact $contact)
    {
        $this->getEntityManager()->persist($contact);
        $this->getEntityManager()->flush();

        return $contact;
    }

    public function delete(Contact $contact)
    {
        $this->getEntityManager()->remove($contact);
        $this->getEntityManager()->flush();
    }


}