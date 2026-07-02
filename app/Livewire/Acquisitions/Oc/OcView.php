<?php

namespace App\Livewire\Acquisitions\Oc;

use Livewire\Component;
use App\Models\Oc;
use App\Models\DetOrm;
use Illuminate\Support\Facades\Storage;

class OcView extends Component
{
    public $oc;
    public $ocId;
    public $productos = [];

    public function mount($id)
    {
        $this->ocId = $id;
        $this->loadOc();
        $this->loadProductos();
    }

    public function loadOc()
    {
        $this->oc = Oc::where("oc", $this->ocId)->first();
    }

    // public function loadProductos()
    // {
    //     if ($this->oc && $this->oc->det_orm) {
    //         // Decodificar el JSON de det_orm
    //         $ids = is_array($this->oc->det_orm) 
    //             ? $this->oc->det_orm 
    //             : json_decode($this->oc->det_orm, true);

    //         if (!empty($ids)) {
    //             $this->productos = DetOrm::with('productoRel')
    //                 ->whereIn('id', $ids)
    //                 ->get();
    //         }
    //     }
    // }
    public function loadProductos()
    {
        $this->productos = collect();

        if ($this->oc && $this->oc->det_orm) {
            $rawData = $this->oc->det_orm;
            $ids = [];

            $decoded = json_decode($rawData, true);

            if (is_array($decoded)) {
                $ids = $decoded;
            } else {
                if (strpos($rawData, ',') !== false) {
                    $ids = array_map('trim', explode(',', $rawData));
                } else {
                    $ids = [$rawData];
                }
            }

            $ids = array_filter($ids, function ($id) {
                return !empty($id) && is_numeric($id);
            });
            $ids = array_map('intval', $ids);

            if (!empty($ids)) {
                $this->productos = DetOrm::with('productoRel')
                    ->whereIn('id', $ids)
                    ->get();
            }
        }
    }

    public function getAutorizacionesArrayProperty()
    {
        $autorizaciones = $this->oc ? json_decode($this->oc->autorizaciones, true) : [0, 0, 0];
        return is_array($autorizaciones) ? $autorizaciones : [0, 0, 0];
    }

    public function render()
    {
        return view('livewire.acquisitions.oc.oc-view');
    }
}
