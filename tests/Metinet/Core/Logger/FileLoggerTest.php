<?php

namespace Metinet\Core\Logger;

use PHPUnit\Framework\TestCase;

class FileLoggerTest extends TestCase
{
    public function testFileLoggerProperlyLogMessagesInAFile(): void
    {
        $message = 'Lorem ipsum dolor sid amet';

        $formatter = $this
            ->getMockBuilder(Formatter::class)
            ->getMock();

        $formatter
                ->method('format')
                ->withAnyParameters()
                ->willReturn($message)
        ;

        $path = tempnam(sys_get_temp_dir(), 'metinet');
        $logger = new FileLogger($path, $formatter);
        $logger->log($message);
        $this->assertEquals($message, file_get_contents($path));
    }
}
