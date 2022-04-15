<?php

namespace App\Http\Livewire;

use App\Models\Belanja;
use App\Models\Produk;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public $products =[];

    // atribut filtering
    public $search,$min,$max;

    public function beli($id)
    {
        if(!Auth::user()) {
            return redirect()->route('login');
        }

        // cari produk
        $product = Produk::find($id);
        Belanja::create(
            [
                'user_id' => Auth::user()->id,
                'total_harga' => $product->harga,
                'produk_id' => $product->id,
                'status' => 0
            ]
        );
        return redirect()->to('belanja-user');
    }

    public function render()
    {
        // filter min
        $this->min ? $harga_min = $this->min : $harga_min = 0;
        // filter max
        $this->max ? $harga_max = $this->max : $harga_max = 1000000000000;
        // filter search
        if($this->search) {
            $this->products = Produk::where('nama', 'like', '%'.$this->search.'%')
                                    ->where('harga', '>=', $harga_min)
                                    ->where('harga', '<=', $harga_max)
                                    ->get();
        } else{
            $this->products = Produk::where('harga', '>=', $harga_min)
                                    ->where('harga', '<=', $harga_max)
                                    ->get();
            

        }
        return view('livewire.home')
        ->extends('layouts.app')->section('content');
    }
}