<?php

namespace Tests\Unit\Helpers;

use App\Helpers\FormatHelper;
use Tests\TestCase;

class FormatHelperTest extends TestCase
{
    public function testShouldReturnOnlyNumericalValues()
    {
        $cpfWithMask = '591.530.527-06';
        $cpfWithoutMask = '59153052706';
        $cpfSanitized = FormatHelper::sanitize($cpfWithMask);
        $this->assertEquals($cpfWithoutMask, $cpfSanitized);
    }

    public function testShouldReturnEmptyStringWhenValueIsNonNumeric()
    {
        $nonNumericCharacters = 'A!@#/.-,K)*+=';
        $valueSanitized = FormatHelper::sanitize($nonNumericCharacters);
        $this->assertEmpty($valueSanitized);
    }

    public function testShouldReturnEmptyStringWhenValueIsNull()
    {
        $valueSanitized = FormatHelper::sanitize(null);
        $this->assertEmpty($valueSanitized);
    }
}
