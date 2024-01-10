<?php

class CenaProduktu{
    public $cena_agrosik;
    public $cena_plus_transport;
    public $cena_plus_transport_i_marza;
    public $cena_puls_transport_i_marza_euro;
    public $cena_puls_transport_i_marza_euro_zaokraglone;

    public function __construct($wartosc) {
        $this->cena_agrosik=$wartosc;
        $this->cena_plus_transport=$this->cena_agrosik+2.3;
        $this->cena_plus_transport_i_marza=$this->cena_plus_transport+$this->cena_plus_transport*0.3;
        $this->cena_puls_transport_i_marza_euro=$this->cena_plus_transport_i_marza/4.3;
        $this->cena_puls_transport_i_marza_euro_zaokraglone = round($this->cena_puls_transport_i_marza_euro,2);
      }
}