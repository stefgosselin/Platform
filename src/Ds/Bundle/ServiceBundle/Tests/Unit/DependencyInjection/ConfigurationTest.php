<?php

namespace Ds\Bundle\ServiceBundle\Tests\Unit\DependencyInjection;

use PHPUnit_Framework_TestCase;
use Ds\Bundle\ServiceBundle\DependencyInjection\Configuration;

/**
 * Class ConfigurationTest
 */
class ConfigurationTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test config tree builder
     */
    public function testGetConfigTreeBuilder()
    {
        $configuration = new Configuration;
        $builder = $configuration->getConfigTreeBuilder();
        $this->assertInstanceOf('Symfony\Component\Config\Definition\Builder\TreeBuilder', $builder);

        $root = $builder->buildTree();
        $this->assertInstanceOf('Symfony\Component\Config\Definition\ArrayNode', $root);
        $this->assertEquals('ds_service', $root->getName());
    }
}
