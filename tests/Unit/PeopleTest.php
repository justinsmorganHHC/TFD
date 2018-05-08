<?php

use App\People;
use App\MissingFieldException;
use PHPUnit\Framework\TestCase;

class PeopleTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->peoplePath = "tests" . DIRECTORY_SEPARATOR . "people.json";
        $this->people = new People($this->peoplePath);

        $this->bob = (object) [
            'FName' => 'Bob',
            'LName' => 'Rasputin',
            'Age' => 25,
        ];
        $this->larry = (object) [
            'FName' => 'Larry',
            'LName' => 'polanski',
            'Age' => 25,
        ];
        $this->max = (object) [
            'FName' => 'Max',
            'LName' => 'Xzavier',
            'Age' => 29,
        ];
    }

    /** @test */
    public function canBeSortedByFieldInAscendingOrder()
    {
        $expected = [
            $this->bob,
            $this->larry,
            $this->max,
        ];

        $this->assertEquals($expected, $this->people->sortBy('FName', People::SORT_ORDER_ASCENDING));
    }

    /** @test */
    public function canBeSortedByFieldInDescendingOrder()
    {
        $expected = [
            $this->max,
            $this->larry,
            $this->bob,
        ];

        $this->assertEquals($expected, $this->people->sortBy('FName', People::SORT_ORDER_DESCENDING));
    }

    /** @test */
    public function mixedCaseResultsSortedSeparately()
    {
        $expected = [
            $this->bob,
            $this->max,
            $this->larry,
        ];

        $this->assertEquals($expected, $this->people->sortBy('LName', People::SORT_ORDER_ASCENDING));
    }

    /** @test */
    public function sortByMissingFieldThrowsMissingFieldException()
    {
        $this->expectException(MissingFieldException::class);

        $this->people->sortBy('MissingField', People::SORT_ORDER_ASCENDING);
    }

    /** @test */
    public function canGetFieldNames()
    {
        $expected = ['FName', 'LName', 'Age'];

        $this->assertEquals($expected, $this->people->getFieldNames());
    }
}
