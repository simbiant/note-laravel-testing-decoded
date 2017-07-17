<?php

class AuthorTest extends TestCase
{
    public function testIsInvalidWithoutAName()
    {
        $author = new Author;
        $this->assertFalse(
            $author->validate(),
            'Expected validation to fail.'
        );
    }

    public function testIsInvalidWithoutAEmail()
    {
        $author = new Author;
        $author->name = 'Joe';
        $author->email = 'foo';
        $this->assertFalse(
            $author->validate(),
            'Expected validation to fail.'
        );
    }

    public function testIsInvalidWithoutUniqueEmail()
    {
        $author = new Author;
        $author->name = 'Joe';
        $author->email = 'joe@example.com';
        $author->save();

        $author = new Author;
        $author->name = 'Frank';
        $author->email = 'joe@example.com';

        $this->assertFalse(
            $author->validate(),
            'Expected validation to fail.'
        );
    }
}
