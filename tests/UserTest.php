<?php

use PHPUnit\Event\Code\Test;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../app/controller/UserController.php';

class UserTest extends TestCase {
    public function testCreateUser() {
        $controller = new UserController();
        $response = $controller->addUser(
            "Juan",
            "juan@example.com",
            "12345678",
            "12345678L",
            "123456789",
            "Calle Juan, 123"
        );
        $this->assertTrue($response);
    }

    public function testLoginSuccess() {
        $email = 'vega@gmail.com';
        $password = '12345678';

        $userMock = $this->createMock(User::class);

        $userMock->expects($this->once())->method('setEmail')->with($email);
        $userMock->expects($this->once())->method('setPassword')->with($password);
        $userMock->expects($this->once())->method('checkUsuario')->willReturn(true);
        $userMock->expects($this->once())->method('getId')->willReturn(2);
        $userMock->expects($this->once())->method('getUsername')->willReturn('Vega');

        $controller = new UserController($userMock);

        $result = $controller->login($email, $password, $userMock);

        $this->assertIsArray($result);
        $this->assertEquals(2, $result['id']);
        $this->assertEquals('Vega', $result['username']);
    }
}
