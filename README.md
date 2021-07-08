**CPF/CNPJ Validator**
==
A Laravel package to work with CNPJ validation.

CPF is an individual taxpayer identification number given to people living in Brazil, both native Brazilians and resident foreigners.

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
            'cnpj' => 'cpfcnpj', // CPF/CNPJ validation
            ...
        ]);
        ...
    }
    ...
}
```
