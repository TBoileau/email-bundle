<?php

/*
 * (c) Thomas Boileau <t-boileau@email.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TBoileau\Bundle\EmailBundle\Tests\Builder;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use TBoileau\Bundle\EmailBundle\Builder\MessageBuilder;
use TBoileau\Bundle\EmailBundle\Builder\MessageBuilderInterface;

/**
 * Class MessageBuilderTest
 *
 * @package TBoileau\Bundle\EmailBundle\Tests\Builder
 * @author Thomas Boileau <t-boileau@email.com>
 */
class MessageBuilderTest extends TestCase
{
    /**
     * @var MessageBuilderInterface
     */
    private $builder;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->builder = new MessageBuilder();
    }

    /**
     * @inheritdoc
     */
    protected function tearDown()
    {
        $this->builder = null;
    }

    public function testSuccessfulBuildMessage()
    {
        $this->assertInstanceOf(\Swift_Message::class, $this->builder->getMessage());

        $this->assertInstanceOf(\Swift_Message::class, $this->builder->setFrom("email@email.com"));
    }

    public function testFailedBuildMessage()
    {
        $this->expectException(\BadMethodCallException::class);

        $this->assertEquals($this->builder, $this->builder->fail());
    }
}
