<?php

namespace Ds\Bundle\AccountCaseStatusBundle\Tests\Unit\DependencyInjection;

use PHPUnit_Framework_TestCase;
use Ds\Bundle\AccountCaseStatusBundle\DependencyInjection\Configuration;

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
        $this->assertEquals('ds_account_case_status', $root->getName());
    }
}
