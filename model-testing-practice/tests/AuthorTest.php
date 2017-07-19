<?php

class AuthorTest extends TestCase
{
    use ModelHelpers;

    public function testIsInvalidWithoutAName()
    {
        $author = Factory::author(['name' => null]);
        $this->assertNotValid($author);
    }

    public function testIsInvalidWithoutAEmail()
    {
        $author = Factory::author(['email' => 'foo']);
        $this->assertNotValid($author);
    }

    public function testIsInvalidWithoutUniqueEmail()
    {
        $author = Factory::create('author', ['email' => 'joe@example.com']);

        // Now try to insert a new author with the same email.
        $author = Factory::author(['email' => 'joe@example.com']);

        $this->assertNotValid($author);
    }
}
