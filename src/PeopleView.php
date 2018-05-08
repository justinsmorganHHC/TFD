<?php

namespace App;

class PeopleView
{
    private $defaultSortBy;

    private $defaultSortOrder;

    private $errors = [];

    private $jsonFile;

    private $request;

    public function __construct($request, $jsonFile, $sortBy, $sortOrder)
    {
        $this->request = $request;
        $this->jsonFile = $jsonFile;
        $this->defaultSortBy = $sortBy;
        $this->defaultSortOrder = $sortOrder;
    }

    public function getData()
    {
        $this->checkSortOrderIsValid();

        $sortOrder = $this->getSortOrder();
        $people = new People($this->jsonFile);

        try {
            $sortedPeople = $people->sortBy($this->getSortBy(), $sortOrder);
        } catch (MissingFieldException $e) {
            $this->errors[] = $e->getMessage();

            $sortedPeople = $people->sortBy($this->defaultSortBy, $sortOrder);
        }

        return [
            'errors' => $this->errors,
            'people' => $sortedPeople,
            'selectedSortOrder' => $this->request['sort_order'] ?? '',
            'selectedSortBy' => $this->request['sort_by'] ?? '',
            'availableFields' => $people->getFieldNames(),
        ];
    }

    private function checkSortOrderIsValid()
    {
        if (!in_array($this->getSortOrder(), People::SORT_ORDERS)) {
            $this->errors[] = "Please choose a valid sort order.";
        }
    }

    private function getSortOrder()
    {
        return !empty($this->request['sort_order']) ? $this->request['sort_order'] : $this->defaultSortOrder;
    }

    private function getSortBy()
    {
        return !empty($this->request['sort_by']) ? $this->request['sort_by'] : $this->defaultSortBy;
    }
}
