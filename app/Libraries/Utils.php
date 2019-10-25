<?php 
namespace App\Libraries;
/**
 * Created By Irsal Firdaus
 * 11/14/2017
 */

class Utils
{
    /**
     * summary
     */
    public function __construct()
    {
        
    }

    public static function arraySort($array, $case)
    {
        if(array_key_exists($case,$array)){
            $a[$case] = $array[$case];
            foreach($array as $key=>$val){
                if($case==$key){

                }else{
                    $a[$key] = $array[$key];
                }
            }
        }

        return $a;
    }

    public static function showQueryException($e = null)
    {
        try{
            switch ($e->getCode()) {

                case "42S22":
                    $message = "Invalid parameter";
                    break;
                
                default:
                    $message = "Something went wrong " .$e;
                    break;
            }
        } catch (\Exception $e) {
            $message = "Something went wrong " . $e->getMessage();
        }
        return JsonResponse::badRequest($message/*$e->getMessage()*/);
    }

    public static function deleteFile($file) {
        try {
            if (!empty($file)) {
                unlink($file);
            }
        } catch (\Exception $e) {
            
        }
    }

    public static function parseDate($time) {
        $date = date_create($time);
        $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        return $hari[date_format($date, 'w')].", ".date_format($date, 'j')." ".$bulan[date_format($date, 'n')]." ".date_format($date, 'Y');
    }

    public static function parseDateTime($time) {
        $date = date_create($time);
        $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        return $hari[date_format($date, 'w')].", ".date_format($date, 'j')." ".$bulan[date_format($date, 'n')]." ".date_format($date, 'Y'). " ".date_format($date, 'H:i:s');
    }
}