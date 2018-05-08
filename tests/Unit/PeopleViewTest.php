<?php

use App\People;
use App\PeopleView;
use App\MissingFieldException;
use PHPUnit\Framework\TestCase;

class PeopleViewTest extends TestCase
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
    public function expectedDataForViewIsReturned()
    {
        $request = [
            'sort_by' => 'FName',
            'sort_order' => 'ASC'
        ];

        $peopleView = new PeopleView($request, $this->peoplePath, 'FName', 'ASC');

        $expected = [
            'errors' => [],
            'selectedSortOrder' => 'ASC',
            'selectedSortBy' => 'FName',
            'availableFields' => [
                'FName',
                'LName',
                'Age',
            ],
            'people' => [
                $this->bob,
                $this->larry,
                $this->max,
            ],
        ];

        $this->assertEquals($expected, $peopleView->getData());
    }

    /** @test */
    public function viewDataHasInvalidSortOrderError()
    {
        $request = [
            'sort_order' => 'foo',
        ];

        $peopleView = new PeopleView($request, $this->peoplePath, 'FName', 'ASC');

        $this->assertContains('order', $peopleView->getData()['errors'][0]);
    }

    /** @test */
    public function viewDataHasInvalidSortByError()
    {
        $request = [
            'sort_by' => 'foo',
        ];

        $peopleView = new PeopleView($request, $this->peoplePath, 'FName', 'ASC');

        $this->assertContains('field', $peopleView->getData()['errors'][0]);
    }
}
