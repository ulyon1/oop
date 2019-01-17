<?php

namespace Metinet\Core\Logger;

use PHPUnit\Framework\TestCase;

class SimpleFormatterTest extends TestCase
{

    /**
     * @dataProvider getExpectedFormatterData
     */
    public function testSimpleFormatterProperlyFormatMessageWithAGivenFormat(string $format, string $expectedMessage, string $actualMessage): void
    {
        $context = [];
        $simpleFormatter = new SimpleFormatter($format);
        $formattedMessage = $simpleFormatter->format($actualMessage, $context);
        $this->assertEquals($expectedMessage, $formattedMessage);
    }

    public function getExpectedFormatterData(): array
    {
        return [
            'With no format provided' => [
                '',
                '',
                'Lorem ipsum dolor sid amet'
            ],
            'With a simple `{message}` format' => [
               '{message}',
                'Lorem ipsum dolor sid amet',
                'Lorem ipsum dolor sid amet'
            ],
            'With a complex `[{message}]` format' => [
                '[{message}]',
                '[Lorem ipsum dolor sid amet]',
                'Lorem ipsum dolor sid amet',
            ]
        ];
    }

}
