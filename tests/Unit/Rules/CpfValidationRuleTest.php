<?php

namespace Tests\Unit\Rules;

use App\Rules\CpfValidationRule;
use Faker\Factory;
use Faker\Provider\pt_BR\Person;
use Illuminate\Support\Str;
use Tests\TestCase;

class CpfValidationRuleTest extends TestCase
{
    const ATTRIBUTE_NAME = 'cpf';

    private $cpfValidationRule;

    private $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->cpfValidationRule = new CpfValidationRule();
        $this->faker = Factory::create();
        $this->faker->addProvider(new Person($this->faker));
    }

    public function testShouldReturnTrueWhenCpfHasNoMaskAndIsValid()
    {
        $cpfWithoutMask = $this->faker->cpf(false);
        $isValid = $this->cpfValidationRule->passes(self::ATTRIBUTE_NAME, $cpfWithoutMask);
        $this->assertTrue($isValid);
    }

    public function testShouldReturnTrueWhenCpfHasAMaskAndIsValid()
    {
        $cpfWithMask = $this->faker->cpf;
        $isValid = $this->cpfValidationRule->passes(self::ATTRIBUTE_NAME, $cpfWithMask);
        $this->assertTrue($isValid);
    }

    public function testShouldReturnTrueWhenCpfHasSpacesInRight()
    {
        $cpfWithRightSpaces = Str::padRight($this->faker->cpf(false), 15);
        $isValid = $this->cpfValidationRule->passes(self::ATTRIBUTE_NAME, $cpfWithRightSpaces);
        $this->assertTrue($isValid);
    }

    public function testShouldReturnTrueWhenCpfHasSpacesInLeft()
    {
        $cpfWithLeftSpaces = Str::padLeft($this->faker->cpf(false), 15);
        $isValid = $this->cpfValidationRule->passes(self::ATTRIBUTE_NAME, $cpfWithLeftSpaces);
        $this->assertTrue($isValid);
    }

    public function testShouldReturnFalseWhenCpfIsLessThanElevenCharacters()
    {
        $cpfLessThanEleven = Str::substr($this->faker->cpf(false), 0, 10);
        $isValid = $this->cpfValidationRule->passes(self::ATTRIBUTE_NAME, $cpfLessThanEleven);
        $this->assertFalse($isValid);
    }

    public function testShouldReturnFalseWhenCpfIsGreaterThanElevenCharacters()
    {
        $cpfGreaterThanEleven = Str::padRight($this->faker->cpf(false), 15, 0);
        $isValid = $this->cpfValidationRule->passes(self::ATTRIBUTE_NAME, $cpfGreaterThanEleven);
        $this->assertFalse($isValid);
    }

    public function testShouldReturnFalseWhenCpfIsFormedBySequentialNumbers()
    {
        $isValid = $this->cpfValidationRule->passes(self::ATTRIBUTE_NAME, 00000000000);
        $this->assertFalse($isValid);
    }

    public function testShouldReturnFalseWhenCpfIsBlank()
    {
        $isValid = $this->cpfValidationRule->passes(self::ATTRIBUTE_NAME, '');
        $this->assertFalse($isValid);
    }

    public function testShouldReturnFalseWhenCpfIsNull()
    {
        $isValid = $this->cpfValidationRule->passes(self::ATTRIBUTE_NAME, null);
        $this->assertFalse($isValid);
    }
}
