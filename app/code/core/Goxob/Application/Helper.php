<?php
namespace Goxob\Application;

use DB, Session;

class Helper {

    public static function countVisit()
    {
        if(\Goxob::isAdmin()) return;

        if(!Session::has('visit')){
            Session::put('visit', '1');
        }
        $sid = md5(uniqid(rand(), true));
        DB::insert('insert into visit_counter (sid, `time`, visits) values (?, ?, ?)', array($sid, time(), 1));
    }

    public static function countByRange($range)
    {
        if($range == 'day')
        {
            return DB::table('visit_counter')->whereRaw('date(FROM_UNIXTIME(`time`)) = date(NOW())')->count();
        }
    }

}