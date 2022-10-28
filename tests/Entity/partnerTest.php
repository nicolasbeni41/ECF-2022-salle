<?php

namespace App\tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Partner;

/**
 * @covers Partner
 */
class partnerTest extends TestCase
{
    public function test_partnerIsValid()
    {
        $partner = new Partner();
        $partner
            ->setName('SportClub')
            ->setEmail('nomdupartenaire@sportclub.fr')
            ->setPassword('jdocnbg65')
            ->setAddress('1 rue de la font 123456 Lasueur')
            ->setDescription('Lorem ipsum sit adec')
            ->setActive(true)
            ->setSellFood(true)
            ->setSellDrink(true)
            ->setSendNewsletter(true)
            ->setScheduleManagement(true)
            ->setPrivateLesson(true);

            $this->assertTrue($partner->getName() === 'SportClub');
            $this->assertTrue($partner->getEmail() === 'nomdupartenaire@sportclub.fr');
            $this->assertTrue($partner->getPassword() === 'jdocnbg65');
            $this->assertTrue($partner->getAddress() === '1 rue de la font 123456 Lasueur');
            $this->assertTrue($partner->getDescription() === 'Lorem ipsum sit adec');
            $this->assertTrue($partner->isActive() === true);
            $this->assertTrue($partner->isSellFood() === true);
            $this->assertTrue($partner->isSellDrink() === true);
            $this->assertTrue($partner->isSendNewsletter() === true);
            $this->assertTrue($partner->isScheduleManagement() === true);
            $this->assertTrue($partner->isPrivateLesson() === true);
    }

    public function test_partnerIsUnvalid()
    {
        $partner = new Partner();
        $partner
        ->setName('SportClub')
        ->setEmail('nomdupartenaire@sportclub.fr')
        ->setPassword('jdocnbg65')
        ->setAddress('1 rue de la font 123456 Lasueur')
        ->setDescription('Lorem ipsum sit adec')
        ->setActive(true)
        ->setSellFood(true)
        ->setSellDrink(true)
        ->setSendNewsletter(true)
        ->setScheduleManagement(true)
        ->setPrivateLesson(true);


        $this->assertFalse($partner->getName() === 'SportClu');
        $this->assertFalse($partner->getEmail() === 'nomdupartenair@sportclub.fr');
        $this->assertFalse($partner->getPassword() === 'jdocnbg');
        $this->assertFalse($partner->getAddress() === '1 rue de la font');
        $this->assertFalse($partner->getDescription() === 'Lorem ipsum');
        $this->assertFalse($partner->isActive() === false);
        $this->assertFalse($partner->isSellFood() === false);
        $this->assertFalse($partner->isSellDrink() === false);
        $this->assertFalse($partner->isSendNewsletter() === false);
        $this->assertFalse($partner->isScheduleManagement() === false);
        $this->assertFalse($partner->isPrivateLesson() === false);
    }
}