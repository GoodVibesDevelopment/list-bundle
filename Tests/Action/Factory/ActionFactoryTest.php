<?php
/**
 * Created by PhpStorm.
 * User: Szymon Kunowski <szymon.kunowski@gmail.com>
 * Date: 23.11.15
 * Time: 11:02
 */

namespace Vardius\Bundle\ListBundle\Tests\Action\Factory;

use PHPUnit_Framework_TestCase;
use Vardius\Bundle\ListBundle\Action\Factory\ActionFactory;
use Vardius\Bundle\ListBundle\Action\Action;

class CalculatorTest extends PHPUnit_Framework_TestCase
{
    public function testGetProperValues()
    {
        $actionFactory = new ActionFactory();
        $result = $actionFactory->get("path", "name", "icon", []);
        $this->assertInstanceOf('Vardius\Bundle\ListBundle\Action\Action', $result);
    }

    public function testGetPathNull()
    {
        $actionFactory = new ActionFactory();
        $result = $actionFactory->get(null, "name", "icon", []);
        $this->assertInstanceOf('Vardius\Bundle\ListBundle\Action\Action', $result);
    }

    public function testGetNameNull()
    {
        $actionFactory = new ActionFactory();
        $result = $actionFactory->get("path", null, "icon", []);
        $this->assertInstanceOf('Vardius\Bundle\ListBundle\Action\Action', $result);
    }

    public function testGetIconNull()
    {
        $actionFactory = new ActionFactory();
        $result = $actionFactory->get("path", "name", null, []);
        $this->assertInstanceOf('Vardius\Bundle\ListBundle\Action\Action', $result);
    }

    public function testGetParametersNotArray()
    {
        $actionFactory = new ActionFactory();
        $this->setExpectedException('InvalidArgumentException');
        $actionFactory->get("path", "name", "icon", null);
    }

    public function testGetNameAndIconNull()
    {
        $actionFactory = new ActionFactory();
        $this->setExpectedException('InvalidArgumentException');
        $actionFactory->get("path", null, null, []);
    }
}
