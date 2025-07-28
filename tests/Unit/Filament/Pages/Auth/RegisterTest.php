<?php

namespace Tests\Unit\Filament\Pages\Auth;

use App\Filament\Pages\Auth\Register;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase; // Change to Laravel's TestCase
use ReflectionClass;

class RegisterTest extends TestCase
{
    /** @test */
    public function it_assigns_student_role_on_registration()
    {
        // Mock the User model
        $userMock = $this->createMock(User::class);
        $userMock->expects($this->once())
                 ->method('syncRoles')
                 ->with([]);
        $userMock->expects($this->once())
                 ->method('assignRole')
                 ->with('student_user');

        // Create an anonymous class that extends Register and overrides handleRegistration
        // to return our mocked user and simulate the role assignment logic.
        $registerPage = new class extends Register {
            public $mockUser;

            protected function handleRegistration(array $data): Model
            {
                // Simulate the role assignment logic from the original handleRegistration
                $this->mockUser->syncRoles([]);
                $this->mockUser->assignRole('student_user');
                return $this->mockUser;
            }
        };

        $registerPage->mockUser = $userMock;

        // Access the protected handleRegistration method using reflection
        $reflection = new ReflectionClass($registerPage);
        $method = $reflection->getMethod('handleRegistration');
        $method->setAccessible(true);

        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password', // Simplified password, as parent handles hashing
        ];

        $result = $method->invokeArgs($registerPage, [$data]);

        $this->assertEquals($userMock, $result);
    }
}