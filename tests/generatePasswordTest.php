<?php

use PHPUnit\Framework\TestCase;

/**
 * @covers Password
 * 
 */
class IndexPassTest extends TestCase
{
    public function testPassword()
    {
        $allowedCharacters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password = array();
        $allowedCharactersLen = strlen($allowedCharacters) - 1;
        for ($i = 0; $i < 12; $i++) {
            $n = rand(0, $allowedCharactersLen);
            $password[] = $allowedCharacters[$n];
        }
        
        $this->assertIsArray($password);
    }
}