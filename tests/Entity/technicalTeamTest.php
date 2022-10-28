<?php

namespace App\tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\TechnicalTeam;

/**
 * @covers TeachnicalTeam
 */
class technicalTeamTest extends TestCase
{
    // Sans test- au début de la fonction, phpunit retourne un warning en disant
    // " No tests found in class "App\Tests\Entity\technicalTeamTest" "
    public function test_technicalTeamIsValid()
    {
        $technicalTeam = new TechnicalTeam();
        $technicalTeam
            ->setEmail('technicalteam@exemple.fr')
            ->setPassword('ascttg15')
            ->setFirstname('technical')
            ->setLastname('team');

        $this->assertTrue($technicalTeam->getEmail() === 'technicalteam@exemple.fr');
        $this->assertTrue($technicalTeam->getPassword() === 'ascttg15');
        $this->assertTrue($technicalTeam->getFirstname() === 'technical');
        $this->assertTrue($technicalTeam->getLastname() === 'team');
    }

    public function test_technicalTeamIsUnvalid()
    {
        $technicalTeam = new TechnicalTeam();
        $technicalTeam
            ->setEmail('technicalteam@exemple.fr')
            ->setPassword('ascttg15')
            ->setFirstname('technical')
            ->setLastname('team');


        $this->assertFalse($technicalTeam->getEmail() === 'technical@exemple.fr');
        $this->assertFalse($technicalTeam->getPassword() === 'ascttg');
        $this->assertFalse($technicalTeam->getFirstname() === 'team');
        $this->assertFalse($technicalTeam->getLastname() === 'technical');

    }
}