<?php
    class Configuration{
        public $host = 'localhost:3306';
        public $dbname = 'vuv_medical';
        public $username = 'root';
        public $password = '';
    }

    class Osoba
    {
        public $ime = 'n/a';
        public $prezime = 'n/a';
    }

    class Pacijent extends Osoba 
    {
        public $id = 'n/a';
        public $doktor = 'n/a';
        public $uloga = 'n/a';

        public function __construct($sIme=null, $sPrezime=null, $nId=null, $nDoktor=null, $sUloga=null){
            if($sIme) $this->ime=$sIme;
            if($sPrezime) $this->prezime=$sPrezime;
            if($nId) $this->id=$nId;
            if($nDoktor) $this->doktor=$nDoktor;
            if($sUloga) $this->uloga=$sUloga;
        }
    }

    class Doktor extends Osoba 
    {
        public $id = 'n/a';
        public $uloga = 'n/a';
        public $oib = 'n/a';

        public function __construct($sIme=null, $sPrezime=null, $nId=null, $sUloga=null, $sOib=null){
            if($sIme) $this->ime=$sIme;
            if($sPrezime) $this->prezime=$sPrezime;
            if($nId) $this->id=$nId;
            if($sUloga) $this->uloga=$sUloga;  
            if($sOib) $this->oib=$sOib;
        }
    }

    class Pregled  
    {
        public $id = 'n/a';
        public $oib = 'n/a';
        public $razlog = 'n/a';
        public $opis= 'n/a';
        public $termin ='n/a';
        public $status = 'n/a';
        public $doktor = 'n/a';

        public function __construct($nId = null, $sOib = null, $sRazlog = null, $sOpis=null, $sTermin = null, $sStatus = null, $sDoktor=null)
        {
            if($nId) $this->id=$nId;
            if($sOib) $this->$oib=$sOib;
            if($sRazlog) $this->razlog=$sRazlog;
            if($sOpis) $this->opis=$sOpis;
            if($sTermin) $this->termin=$sTermin;
            if($sStatus) $this->status=$sStatus;
            if($sDoktor) $this->doktor=$sDoktor;
        }
    }

    class Uputnica  
    {
        public $id = 'n/a';
        public $oib = 'n/a';
        public $specijalist = 'n/a';
        public $opis= 'n/a';
        public $status = 'n/a';
        public $doktor = 'n/a';

        public function __construct($nId = null, $sOib = null, $sSpecijalist = null, $sOpis=null, $sStatus = null, $sDoktor=null)
        {
            if($nId) $this->id=$nId;
            if($sOib) $this->$oib=$sOib;
            if($sSpecijalist) $this->specijalist=$sSpecijalist;
            if($sOpis) $this->opis=$sOpis;
            if($sStatus) $this->status=$sStatus;
            if($sDoktor) $this->doktor=$sDoktor;
        }
    }

    class Lijek
    {
        public $id = 'n/a';
        public $oib = 'n/a';
        public $vrsta = 'n/a';
        public $status = 'n/a';
        public $doktor = 'n/a';

        public function __construct($nId=null, $sOib=null, $sVrsta=null, $sStatus=null, $sDoktor=null){
            if($nId) $this->id_=$nId;
            if($sOib) $this->oib=$sOib;
            if($sVrsta) $this->vrsta=$sVrsta;
            if($sStatus) $this->status=$sStatus;
            if($sDoktor) $this->doktor=$sDoktor;
        }
    }

    class Poruka
    {
        public $id_poruke = 'n/a';
        public $doktor = 'n/a';
        public $pacijent = 'n/a';
        public $tekst = 'n/a';

        public function __construct($nId_poruke=null, $sDoktor=null, $sPacijent=null, $sTekst=null){
            if($nId_poruke) $this->id_poruke=$nId_poruke;
            if($sDoktor) $this->doktor=$sDoktor;
            if($sPacijent) $this->pacijent=$sPacijent;
            if($sTekst) $this->tekst=$sTekst;
        }
    }

    
?>