<?php

namespace App\Http\Livewire;

use App\Models\Belanja;
use App\Models\Produk;
use Livewire\Component;
// Native PHP
use Kavist\RajaOngkir\RajaOngkir;
use Illuminate\Support\Facades\Auth;

class TambahOngkir extends Component
{
    public $belanja;
    public $provinsi_id, $kota_id, $nama_jasa, $daftarProvinsi, $daftarKota, $jasa;
    public $result = [];
    public function mount($id)
    {
        if(!Auth::user()){
            return redirect()->to('login');
        }
        $this->belanja = Belanja::find($id);

        if($this->belanja->user_id !== Auth::user()->id) {
            return redirect()->to('');
        }
    }

    public function getOngkir()
    {
        // valisadi
        if(!$this->provinsi_id || !$this->kota_id || !$this->jasa) {
            return;
        }

        // get data product
        $produk = Produk::find($this->belanja->produk_id);

        // get ongkir fee
        $rajaOngkir = new RajaOngkir(env('API_KEY'));

        $cost = $rajaOngkir->ongkosKirim([
            'origin' => 489,
            'destination' => $this->kota_id,
            'weight' => $produk->berat,
            'courier' => $this->jasa
        ])->get();

        // nama jasa
        $this->nama_jasa = $cost[0]['name'];
        
        foreach($cost[0]['costs'] as $row) {
            $this->result[] = array(
                'description' => $row['description'],
                'biaya' => $row['cost'][0]['value'],
                'etd' => $row['cost'][0]['etd']
            );
        }
    }

    public function saveOngkir($biaya_pengiriman)
    {
        $this->belanja->total_harga += $biaya_pengiriman;
        $this->belanja->status = 1;
        $this->belanja->update();

        // redirect
        return redirect()->to('belanja-user');
    }

    public function render()
    {
        $rajaOngkir = new RajaOngkir(env('API_KEY'));
        $this->daftarProvinsi = $rajaOngkir->provinsi()->all();

        if($this->provinsi_id) {
            $this->daftarKota = $rajaOngkir->kota()->dariProvinsi($this->provinsi_id)->get();
        }
        
        return view('livewire.tambah-ongkir')
        ->extends('layouts.app')->section('content');
    }
}