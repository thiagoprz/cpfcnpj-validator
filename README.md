**CPF/CNPJ Validator**
==
A Laravel package to validate CPF and CNPJ requested on the same input.


[![Tests](https://github.com/thiagoprz/cpfcnpj-validator/actions/workflows/tests.yml/badge.svg?branch=main)](https://github.com/thiagoprz/cpfcnpj-validator/actions/workflows/tests.yml)

#### CPF
CPF is an individual taxpayer identification number given to people living in Brazil, both native Brazilians and resident foreigners.

#### CNPJ
CNPJ is the National Registry of Legal Entities in Brazil.

Installation
--

`` composer require thiagoprz/cpfcnpj-validator ``

Usage
--
```
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CnpjController extends Controller
{
    ...
    /**
     * Store action
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'cnpj_cnpj' => 'required|string|cpfcnpj',
            ...
        ]);
        ...
    }
    ...
}
```
