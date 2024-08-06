<?php
use PHPUnit\Framework\TestCase;
class GetGreetingTest extends TestCase
{
    public function testGetGreeting()
    {
        include 'index.php'; // Assicurati che il file index.php sia incluso
        $this->assertEquals("Hello universe from PHP!", getGreeting());
    }
}
?>