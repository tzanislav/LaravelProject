<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Status;
use App\Models\Category;
use App\Models\Company;

use Illuminate\Http\Request;

class execute extends Controller
{
    //
    function execute()
    {
        $statuses = [
            "неизбрано" => "rgb(204, 204, 204)",
            "чакаме оферта" => "rgb(136, 135, 135)",
            "потвърдено Adimari" => "rgb(245, 94, 24)",
            "потвърдено клиент" => "rgb(241, 154, 113)",
            "за поръчка" => "rgb(218, 0, 0)",
            "поръчано" => "rgb(248, 163, 34)",
            "налично" => "rgb(136, 221, 147)",
            "доставено" => "rgb(37, 104, 46)",
            "за корекция" => "rgb(63, 110, 148)"
        ];

        foreach ($statuses as $name => $color) {
            $id = 0;
            $status = new Status([
                "uuid" => $id++,
                'name' => $name,
                'image' => $color,
                
            ]);
            echo $status . "<------- Status \n";
            $status->save();

        }

        $categories = Product::select('category')->distinct()->get()->toArray();

        foreach ($categories as $category) {
            $newCategory = new Category([
                "uuid" => $id++,
                'name' => $category['category'],
            ]);
            echo $newCategory . "<---- Category \n";
            $newCategory->save();
        }

        
        $companies = Product::select('company')->distinct()->get()->toArray();

        foreach ($companies as $company) {
            $newCompany = new Company([
                "uuid" => $id++,
                'name' => $company['company'],
            ]);
            echo $newCompany . " <---- Company \n";
            $newCompany->save();
        }
    }
}

/*
[
            "Корпусна мебел",
            "Осветление",
            "Ел. Уреди",
            "Мебели",
            "Аксесоари",
            "Аксесоари за баня",
            "Смесител",
            "Сифон",
            "Облицовка Стени",
            "Камина",
        ];
*/
