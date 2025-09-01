<?php
namespace App\Services;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class Operations
{
    public static function decriptId($value){
        try {
            $value = Crypt::decrypt($value);
        } catch (DecryptException $e) {
            $value = null;
        }
        // if($value == null) return redirect()->route('home');
        return $value;
    }

    public static function formataData($data, $format = "d/m/Y")
    {
        if(is_null($data)) return '';
        $date=date_create($data);
        return date_format($date,$format);
    }

    public static function diffYearsNow($date1)
    {
        $date1 = date_create($date1);
        $now = date_create(date("Y-m-d"));
        $diff = date_diff($date1, $now);
        return "{$diff->y} anos";
    }

    

    public static function diffDaysNow($date1)
    {
        $date1 = date_create($date1);
        $textColor = '';
        $now = date_create("2000-".date("m-d"));
        $diff = date_diff($date1, $now);
        $count = '';
        if($diff->format("%R") == '-'){
            $textColor = 'text-primary';
            $count = $diff->format("Faltam %a dias");
            if($diff->format("%a") == 1) $count = $diff->format("Falta %a dias");
        } else {
            $count = $diff->format("Passaram %a dias");
            if($diff->format("%a") == 1) $count = $diff->format("Passou %a dias");
            $textColor = 'text-secondary';
            if($diff->format("%R%a") == '+0'){
                $count = '<i class="fas fa-birthday-cake"></i> É hoje, parabéns! <i class="fas fa-birthday-cake"></i>';
                $textColor = 'text-danger';
            }
        }
        return '<p class="text-xs font-weight-bold mb-0 text-center '.$textColor.'">'.$count.'</p>';
    }

    public static function formataCPF($cpf)
    {
        return substr($cpf,0,3).'.'.substr($cpf,3,3).'.'.substr($cpf,6,3).'-'.substr($cpf,9,2);
    }

    public static function formataTelefoneWhatsApp($cpf)
    {
        //https://wa.me/5511999999999
        return substr($cpf,0,3).'.'.substr($cpf,3,3).'.'.substr($cpf,6,3).'-'.substr($cpf,9,2);
    }

    /**
     * Parâmetro deve ser acompanhado o + ou - com a quantidade de mês que vai calcular
     *
     * @param string $momento
     * @return void
     */
    public static function mes($momento = '')
    {
        if(empty($momento)) return date('m');
        return date('m', strtotime("$momento month"));
    }
}
