<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\AppBundle\EventListener;

use AppBundle\EventListener\RedirectToPreferredLocaleListener;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Unit test for the event listener
 *
 * See http://symfony.com/doc/current/book/testing.html#unit-tests
 *
 * Execute the application tests using this command (requires PHPUnit to be installed):
 *
 *     $ cd your-symfony-project/
 *     $ ./vendor/bin/phpunit
 */
class RedirectToPreferredLocaleListenerTest extends \PHPUnit_Framework_TestCase
{
    private $requestProphecy;
    private $urlGeneratorProphecy;
    private $eventProphecy;
    private $listener;

    public function setUp()
    {
        $this->requestProphecy = $this->prophesize(Request::class);
        $this->urlGeneratorProphecy = $this->prophesize(UrlGeneratorInterface::class);
        $this->eventProphecy = $this->prophesize(GetResponseEvent::class);
        $this->listener = new RedirectToPreferredLocaleListener($this->urlGeneratorProphecy->reveal(), 'en|fr|es');
    }

    public function testOnKernelRequestUnexpectedValueException()
    {
        $this->setExpectedException(\UnexpectedValueException::class);

        new RedirectToPreferredLocaleListener($this->urlGeneratorProphecy->reveal(), 'en|fr|es', 'fi');
    }

    public function testOnKernelRequestWhenIsMasterRequest()
    {
        $this->eventProphecy->getRequest()->willReturn($this->requestProphecy->reveal())->shouldBeCalled();
        $this->eventProphecy->isMasterRequest()->willReturn(false)->shouldBeCalled();

        $return = $this->listener->onKernelRequest($this->eventProphecy->reveal());

        $this->assertNull($return);
    }

    public function testOnKernelRequestWhenGetPathInfoIsNotDefault()
    {
        $this->requestProphecy->getPathInfo()->willReturn('/foo');

        $this->eventProphecy->getRequest()->willReturn($this->requestProphecy->reveal())->shouldBeCalled();
        $this->eventProphecy->isMasterRequest()->willReturn(false)->shouldBeCalled();

        $return = $this->listener->onKernelRequest($this->eventProphecy->reveal());

        $this->assertNull($return);
    }

    public function testOnKernelRequestWhenSameHttpHost()
    {
        $request = new Request();
        $request->headers->set('referer', 'http://foo.bar');
        $request->headers->set('HOST', 'foo.bar');

        $this->eventProphecy->getRequest()->willReturn($request)->shouldBeCalled();
        $this->eventProphecy->isMasterRequest()->willReturn(true)->shouldBeCalled();

        $return = $this->listener->onKernelRequest($this->eventProphecy->reveal());

        $this->assertNull($return);
    }

    public function testOnKernelRequestWhenPreferredLanguageNotSame()
    {
        $request = new Request();
        $request->headers->set('referer', 'http://foo.bar');
        $request->headers->set('HOST', 'bar.fo');
        $request->headers->set('Accept-Language', 'fr');

        $httpKernelProphecy = $this->prophesize(HttpKernelInterface::class);
        $event = new GetResponseEvent($httpKernelProphecy->reveal(), $request, HttpKernelInterface::MASTER_REQUEST);

        $this->urlGeneratorProphecy->generate("homepage", ["_locale" => "fr"])->willReturn('http://foo.sf');

        $this->listener->onKernelRequest($event);

        $this->assertInstanceOf(RedirectResponse::class, $event->getResponse());
    }
}
