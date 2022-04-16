<?php

namespace App\Http\Livewire;

use App\Models\Produk;
use Livewire\Component;

class Home extends Component
{
    public $produk = [];
    public function render()
    {
        $this->produk = Produk::all();
        return view('livewire.home')
        ->extends('layouts.app')->section('content');
    }
}