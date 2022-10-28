<?php

namespace App\tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Structure;

/**
 * @covers Structure
 */
class structureTest extends TestCase
{
    public function test_structureIsValid()
    {
        $structure = new Structure();
        $structure
            ->setName('SportClub')
            ->setmanagerFirstname('John')
            ->setmanagerLastname('Doe')
            ->setEmail('johndoe@sportclub.fr')
            ->setPassword('ghdsec12')
            ->setAddress('1 rue de la font 123456 Lasueur')
            ->setActive(true)
            ->setSellFood(true)
            ->setSellDrink(true)
            ->setSendNewsletter(true)
            ->setScheduleManagement(true)
            ->setPrivateLesson(true);

            $this->assertTrue($structure->getName() === 'SportClub');
            $this->assertTrue($structure->getmanagerFirstname() === 'John');
            $this->assertTrue($structure->getmanagerLastname() === 'Doe');
            $this->assertTrue($structure->getEmail() === 'johndoe@sportclub.fr');
            $this->assertTrue($structure->getPassword() === 'ghdsec12');
            $this->assertTrue($structure->getAddress() === '1 rue de la font 123456 Lasueur');
            $this->assertTrue($structure->isActive() === true);
            $this->assertTrue($structure->isSellFood() === true);
            $this->assertTrue($structure->isSellDrink() === true);
            $this->assertTrue($structure->isSendNewsletter() === true);
            $this->assertTrue($structure->isScheduleManagement() === true);
            $this->assertTrue($structure->isPrivateLesson() === true);
    }

    public function test_structureIsUnvalid()
    {
        $structure = new Structure();
        $structure
            ->setName('SportClub')
            ->setmanagerFirstname('John')
            ->setmanagerLastname('Doe')
            ->setEmail('johndoe@sportclub.fr')
            ->setPassword('ghdsec12')
            ->setAddress('1 rue de la font 123456 Lasueur')
            ->setActive(true)
            ->setSellFood(true)
            ->setSellDrink(true)
            ->setSendNewsletter(true)
            ->setScheduleManagement(true)
            ->setPrivateLesson(true);


        $this->assertFalse($structure->getName() === 'SportClu');
        $this->assertFalse($structure->getmanagerFirstname() === 'Jon');
        $this->assertfalse($structure->getmanagerLastname() === 'Done');
        $this->assertFalse($structure->getEmail() === 'jondone@sportclub.fr');
        $this->assertFalse($structure->getPassword() === 'jdocnbg');
        $this->assertFalse($structure->getAddress() === '1 rue de la font');
        $this->assertFalse($structure->isActive() === false);
        $this->assertFalse($structure->isSellFood() === false);
        $this->assertFalse($structure->isSellDrink() === false);
        $this->assertFalse($structure->isSendNewsletter() === false);
        $this->assertFalse($structure->isScheduleManagement() === false);
        $this->assertFalse($structure->isPrivateLesson() === false);
    }
}