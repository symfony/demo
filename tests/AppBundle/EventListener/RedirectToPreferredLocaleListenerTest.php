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
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Unit test for the event listener.
 *
 * See http://symfony.com/doc/current/book/testing.html#unit-tests
 *
 * Execute the application tests using this command (requires PHPUnit to be installed):
 *
 *     $ cd your-symfony-project/
 *     $ ./vendor/bin/phpunit
 *
 * @author Michael COULLERET <michael.coulleret@gmail.com>
 */
class RedirectToPreferredLocaleListenerTest extends \PHPUnit_Framework_TestCase
{
    private $request;
    private $urlGenerator;
    private $event;
    private $listener;

    public function setUp()
    {
        $this->request = $this->prophesize(Request::class);
        $this->urlGenerator = $this->prophesize(UrlGeneratorInterface::class);
        $this->event = $this->prophesize(GetResponseEvent::class);
        $this->listener = new RedirectToPreferredLocaleListener($this->urlGenerator->reveal(), 'en|fr|es');
    }

    public function testListenerOnKernelRequestUnexpectedValueException()
    {
        $this->setExpectedException(\UnexpectedValueException::class);

        new RedirectToPreferredLocaleListener($this->urlGenerator->reveal(), 'en|fr|es', 'fi');
    }

    public function testListenerOnKernelRequestWhenIsMasterRequest()
    {
        $this->event->getRequest()->willReturn($this->request->reveal())->shouldBeCalled();
        $this->event->isMasterRequest()->willReturn(false)->shouldBeCalled();

        $this->listener->onKernelRequest($this->event->reveal());
    }

    public function testListenerOnKernelRequestWhenGetPathInfoIsNotDefault()
    {
        $this->request->getPathInfo()->willReturn('/foo');

        $this->event->getRequest()->willReturn($this->request->reveal())->shouldBeCalled();
        $this->event->isMasterRequest()->willReturn(false)->shouldBeCalled();

        $this->listener->onKernelRequest($this->event->reveal());
    }

    public function testListenerOnKernelRequestWhenSameHttpHost()
    {
        $request = new Request();
        $request->headers->set('referer', 'https://foo.sf');
        $request->headers->set('HOST', 'foo.sf');

        $this->event->getRequest()->willReturn($request)->shouldBeCalled();
        $this->event->isMasterRequest()->willReturn(true)->shouldBeCalled();

        $this->listener->onKernelRequest($this->event->reveal());
    }

    public function testListenerOnKernelRequestWhenPreferredLanguageNotSame()
    {
        $request = new Request();
        $request->headers->set('referer', 'https://foo.sf');
        $request->headers->set('HOST', 'bar.sf');
        $request->headers->set('Accept-Language', 'fr');

        $httpKernel = $this->prophesize(HttpKernelInterface::class);
        $event = new GetResponseEvent($httpKernel->reveal(), $request, HttpKernelInterface::MASTER_REQUEST);

        $this->urlGenerator->generate('homepage', ['_locale' => 'fr'])->willReturn('https://foo.sf');

        $this->listener->onKernelRequest($event);

        $this->assertInstanceOf(RedirectResponse::class, $event->getResponse());
    }
}
