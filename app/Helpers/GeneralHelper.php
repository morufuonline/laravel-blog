<?php

namespace App\Helpers;
use DateTime;
use App\Models\RoleManagement;

class GeneralHelper{

    public static function sub_date($data){
    return (strtotime($data) > 0)?self::custom_date($data, "l F jS, Y"):"";
    }
    
    public static function min_sub_date($data){
    return (strtotime($data) > 0)?self::custom_date($data, "d/m/Y"):"";
    }

    public static function full_date($data){
    return (strtotime($data) > 0)?self::custom_date($data, "l F jS, Y h:i:s A"):"";
    }

    public static function min_full_date($data){
    return (strtotime($data) > 0)?self::custom_date($data, "d/m/Y h:i:s A"):"";
    }

    public static function custom_date($data, $format){
    return (strtotime($data) > 0)?date_format(date_create($data), $format):"";   
    }

    public static function check_inputted($data = "", $sub_data = "")
	{
		if (!empty(old($data))) {
			return old($data);
		} else {
			return (!empty(request($data))) ? request($data) : $sub_data;
		}
	}
    
	public static function check_checked($data = "", $sub_data = "", $main_data = "")
	{
		if (!empty(old($data)) && old($data) == $sub_data) {
			return " checked";
		} else {
			return ((!empty(request($data)) && request($data) == $sub_data) or (empty(request($data)) && $main_data == $sub_data)) ? " checked" : "";
		}
	}

	public static function check_selected($data = "", $sub_data = "", $main_data = "")
	{
		if (!empty(old($data)) && old($data) == $sub_data) {
			return " selected";
		} else {
			return ((!empty(request($data)) && request($data) == $sub_data) or (empty(request($data)) && $main_data == $sub_data)) ? " selected" : "";
		}
	}

    public static function search($page, $req_data, $store = 0)
	{
		if (!empty($store)) {
			foreach ($req_data as $value) {
				session([$page . "-" . $value => request($value)]);
			}
		} else {
			foreach ($req_data as $value) {
				$result[$value] = session($page . "-" . $value);
			}
			return $result;
		}
	}

    public static function special_date($data){
        $result = "";
        $datetime1 = new DateTime($data);
        $datetime2 = new DateTime(date("Y-m-d H:i:s"));
        $difference = $datetime1->diff($datetime2);
        $year = self::custom_date($data, "Y");
        $if_yesterday = self::custom_date($data, "d");
        
        $dat2 = date_create (date("Y-m-d H:i:s"));
        date_add ($dat2, date_interval_create_from_date_string("-1 days"));
        $yesterday = date_format($dat2, "d");
        
        if($year != date("Y")){
        $result = self::custom_date($data, "M j, Y") . " at " . self::custom_date($data, "h:i A");
        }else if($difference->days > 29 ){
        $calc_month = round($difference->days / 30, 0);
        $result = "About {$calc_month} month";
        $result .= ($calc_month > 1) ? "s ago": " ago";
        }else if($difference->days > 0){
        $result = $difference->days . " day";
        $result .= ($difference->days > 1) ? "s ago": " ago";
        }else if($difference->h > 0){
        $result = $difference->h . " hour";
        $result .= ($difference->h > 1)?"s ago":" ago";
        }else if($difference->i > 0){
        $result = $difference->i . " minute";
        $result .= ($difference->i > 1)?"s ago":" ago";
        }else if($difference->i == 0){
        $result = "Now";
        }
        
        return $result;
    }

    public static function check_privillege($role_col){
        return auth()->user()->controller ? 1 : RoleManagement::where('id', auth()->user()->role)->value($role_col);
    }

}