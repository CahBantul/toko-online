<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TambahProduk extends Component
{
    public function mount() 
    {
        if(Auth::user()) {
            if(Auth::user()->level !== 1) {
                return redirect()->to('');
            }
        }
    }

    public function store()
    {
        // validasi
    }

    public function render()
    {
        return view('livewire.tambah-produk')
        ->extends('layouts.app')->section('content');
    }
}