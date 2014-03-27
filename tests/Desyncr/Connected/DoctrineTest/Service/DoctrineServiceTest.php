<?php

/**
 * General class.
 *
 * PHP version 5.4
 *
 * @category General
 * @package  Desyncr\Connected\DoctrineTest\Service
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @version  GIT:<>
 * @link     https://github.com/desyncr
 */
namespace Desyncr\Connected\DoctrineTest\Service;

use Desyncr\Connected\Doctrine\Entity\Notification;

/**
 * Class DoctrineServiceTest
 *
 * @category General
 * @package  Desyncr\Connected\DoctrineTest\Service
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @link     https://github.com/desyncr
 */
class DoctrineServiceTest extends DoctrineServiceTestBase
{
    public function testInstance()
    {
        $service = $this->getService();
        $this->assertNotNull($service);
    }

    public function testAddNotification()
    {
        $service = $this->getService();
        $entity = $service->add('test.notification', new Notification());
        $this->assertInstanceOf(
            '\Desyncr\Connected\Doctrine\Entity\EntityInterface',
            $entity
        );

        $this->assertEquals('test.notification', $entity->getId());
        $service->clear();
    }

    public function testDispatch()
    {
        $service = $this->getService();
        $service->dispatch();
    }

    public function testPersist()
    {
        $service = $this->getService();
        $n = new Notification();
        $unique = $n->getUnique();
        $this->assertNotNull($n->getUnique());
        $service->add('test', $n);
        $service->dispatch();

        $em = $this->getEntityManager();

        $notifications = $em->getRepository(
            'Desyncr\Connected\Doctrine\Entity\Notification'
        );

        /** @var \Desyncr\Connected\Doctrine\Entity\Notification $notification */
        $notification = $notifications->findOneBy(array('unique' => $unique));
        $this->assertNotNull($notification);

        $targets = $notification->getTargets();
        $this->assertInstanceOf(
            'Doctrine\ORM\PersistentCollection',
            $targets
        );

        $this->assertEmpty(0, $targets->count());

        $properties = $notification->getProperties();
        $this->assertInstanceOf(
            'Doctrine\ORM\PersistentCollection',
            $properties
        );

        $this->assertEmpty(0, $properties->count());
    }

    public function testPersistWithProperties()
    {
        $n = new Notification();
        $n->addProperty('hello', 'World');
        $unique = $n->getUnique();

        $service = $this->getService();
        $service->add('test', $n);
        $service->dispatch($n);

        /** @var \Desyncr\Connected\Doctrine\Entity\Notification $notification */
        $notification = $this->findNotification(array('unique' => $unique));
        $this->assertNotNull($notification);

        $properties = $notification->getProperties();
        $this->assertNotNull($properties);
        $this->assertNotEquals(0, $properties->count());

        $property_values = array(
            'hello' => 'World'
        );

        /** @var \Desyncr\Connected\Doctrine\Entity\NotificationProperty $property */
        foreach ($properties as $property) {
            $this->assertEquals(
                $property_values[$property->getName()],
                $property->getValue()
            );
        }
    }

    public function testPersistWithTarget()
    {
        $n = new Notification();
        $unique = $n->getUnique();
        $mock = $this->getMock('stdClass', array('getId'));
        $mock->expects($this->any())
            ->method('getId')
            ->will($this->returnValue(1));

        $n->addTarget($mock);

        $service = $this->getService();
        $service->add('test', $n);
        $service->dispatch($n);

        $notification = $this->findNotification(array('unique' => $unique));
        /** @var \Doctrine\ORM\PersistentCollection $targets */
        $targets = $notification->getTargets();
        $this->assertEquals(1, $targets->count());
        /** @var \Desyncr\Connected\Doctrine\Entity\NotificationTarget $target */
        $target = $targets->first();
        $this->assertEquals(1, $target->getId());
        $this->assertEquals(
            'Desyncr\Connected\Doctrine\Entity\NotificationTarget',
            $target->getClass()
        );
    }
    public function testMultipleTargets()
    {
        $n = new Notification();
        $unique = $n->getUnique();
        $mock = $this->getMock('stdClass', array('getId'));
        $mock->expects($this->any())
            ->method('getId')
            ->will($this->returnValue(1));
        $n->addTarget($mock);

        $service = $this->getService();
        $service->add('test.1', $n);

        $n1 = new Notification();
        $unique2 = $n1->getUnique();
        $service->add('test.2', $n1);
        $service->dispatch($n);

        $this->assertNotEquals($unique, $unique2);

        $em = $this->getEntityManager();
        $notifications = $em->getRepository(
            'Desyncr\Connected\Doctrine\Entity\Notification'
        )->findBy(array('unique' => $unique));

        $this->assertEquals(1, count($notifications));
        /** @var \Desyncr\Connected\Doctrine\Entity\Notification $notification */
        $notification = $notifications[0];
        $this->assertInstanceOf(
            '\Desyncr\Connected\Doctrine\Entity\Notification',
            $notification
        );

        $this->assertEquals($unique, $notification->getUnique());
        $this->assertEquals(1, $notification->getId());
        $this->assertEquals(1, $notification->getTargets()->count());

        $notifications = $em->getRepository(
            'Desyncr\Connected\Doctrine\Entity\Notification'
        )->findBy(array('unique' => $unique2));

        $this->assertEquals(1, count($notifications));
        $notification = $notifications[0];
        $this->assertInstanceOf(
            '\Desyncr\Connected\Doctrine\Entity\Notification',
            $notification
        );
        $this->assertEquals(2, $notification->getId());
        $this->assertEquals(0, $notification->getTargets()->count());
    }


    /**
     * WARNING:
     *
     * Run this test as the last one b/c the entity manager is closed
     * with a shitty DBALException.
     *
     * @return mixed
     */
    public function testNotificationUniqueClash()
    {
        $n = new Notification();
        $n1 = new Notification();
        $n1->setUnique($n->getUnique());

        $this->setExpectedException('\Doctrine\DBAL\DBALException');
        $service = $this->getService();
        $service->add('test', $n1);
        $service->add('test', $n);
        $service->dispatch();
    }
}
 