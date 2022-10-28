<?php

namespace App\tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\ContactForm;

/**
 * @covers ContactForm
 */
class contactFormTest extends TestCase
{
    public function test_contactFormIsValid()
    {
        $contactForm = new ContactForm();
        $contactForm
            ->setTitle('Nouveau titre')
            ->setContent('Contenu du nouveau message');

            $this->assertTrue($contactForm->getTitle() === 'titre');
            $this->assertTrue($contactForm->getContent() === 'Contenu');
            
    }

    public function test_contactFormIsUnvalid()
    {
        $contactForm = new ContactForm();
        $contactForm
        ->setTitle('SportClub')
        ->setContent('nomdupartenaire@sportclub.fr');


        $this->assertFalse($contactForm->getTitle() === 'SportClu');
        $this->assertFalse($contactForm->getContent() === 'nomdupartenair@sportclub.fr');;
    }
}