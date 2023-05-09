<?php

namespace App\Http\Controllers;

class AdminGenealogyController extends Controller
{
    public function index() {
        return view('admin.genealogy.index');
    }
}
