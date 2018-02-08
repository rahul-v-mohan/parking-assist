<?php
require_once("business_layer_core.php");
class query extends query_core
{
    function search_slot($location,$vehicle_type,$date,$start_time,$end_time){
        
       $qry ="SELECT PS.* FROM parking_slots as PS 
                LEFT JOIN (
                SELECT *  FROM `booking_details` WHERE reservation_date ='$date' AND (
                    (reservation_starttime BETWEEN '$start_time' AND '$end_time')
                    OR
                    (reservation_endtime BETWEEN '$start_time' AND '$end_time' )
                    OR
                    (reservation_starttime < '$start_time' AND reservation_endtime > '$end_time' )
                )
                ) as BK ON PS.id = BK.slot_id WHERE BK.id IS NULL AND PS.parking_area_id ='$location'
                    AND PS.vehicle_type ='$vehicle_type' AND PS.status = '1'
                GROUP BY PS.id";
        $res = $this->execute($qry);
        return $res;
    }
}