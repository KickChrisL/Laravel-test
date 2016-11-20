<?php
/**
 * Created by PhpStorm.
 * User: Chris
 * Date: 20/11/2016
 * Time: 10:53
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class Rota extends Controller
{
    function init(){

        // Call all staff Ids from the database
        $staff_ids = DB::table('rota_slot_staff')
            ->select('staffid')
            ->whereNotNUll('staffid')
            ->groupBy('staffid')
            ->get();

        // Create arrays that we will populate then return to the view
        $staff = array();
        $hpd = array(
            '0' => 0,
            '1' => 0,
            '2' => 0,
            '3' => 0,
            '4' => 0,
            '5' => 0,
            '6' => 0
        );
        // Loop over the object containing the staff ids
        foreach($staff_ids as $s) {
            // Create a temp array to hold the staff members id and shifts for the week
            $member = array(
                'id' => '',
                'shift' => array()
            );
            // Populate the staff id of the temp array
            $member['id'] = $s->staffid;
            // Select all of the shifts from the database that are attached to the current staff id. Then order them by the day number to ensure that they are in the correct order.
            $rota = DB::table('rota_slot_staff')
                ->select('staffid', 'daynumber', 'slottype', 'starttime', 'endtime', 'workhours', 'roletypeid')
                ->where('staffid', '=', $s->staffid)
                ->orderBy('daynumber', 'asc')
                ->get();
            // Loop over the results of the query
            foreach ($rota as $r) {
                // Populates the temp items shift array with each shift for that staff members week
                $member['shift'][] = array(
                    'day' => $r->daynumber,
                    'start' => $r->starttime,
                    'end' => $r->endtime,
                    'hours' => $r->workhours
                );
                // Tally up each days hours
                $hpd[$r->daynumber] = number_format ( (float)$hpd[$r->daynumber] + (float)$r->workhours, 2);
            }
            // Add the temp member array to the staff return array and convert it to an object at the same time
            $staff[] = (object) $member;
        }
        // Return the arrays to the rota view
        return view('rota', ['rota' => $staff, 'hpd' => $hpd]);
    }

}