<?php

use App\General;
use App\User;
use App\ProductShipment;
use App\MemberExtra;
use App\Coin;
use App\CoinTransaction;
use App\Commission;

function send_email($to, $subject, $name, $message){
        $general = General::first();
    if ($general->email_nfy == 1){
        $headers = "From: ".$general->web_title." <".$general->esender."> \r\n";
        $headers .= "Reply-To: ".$general->web_title." <".$general->esender."> \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $template = $general->emessage;
        $mm = str_replace("{{name}}",$name,$template);
        $message = str_replace("{{message}}",$message,$mm);
         mail($to, $subject, $message, $headers);
        }else {
        return;
    }
}

if (! function_exists('send_sms')){
    function send_sms( $to, $message){
        $gnl = General::first();
        if($gnl->sms_nfy == 1) {
            $sendtext = urlencode("$message");
            $appi = $gnl->smsapi;
            $appi = str_replace("{{number}}",$to,$appi);
            $appi = str_replace("{{message}}",$sendtext,$appi);
            $result = file_get_contents($appi);
          }
          return;
    }
}


function updateDepositBV($id='', $deposit_amount)
{
    while($id!="" || $id!="0") {
        if(isMemberExists($id))
        {
            $posid=getParentId($id);
            if($posid=="0")
                break;
            $position=getPositionParent($id);
            $currentBV = MemberExtra::where('user_id', $posid)->first();

            if($position=="L") {
                $new_lbv=$currentBV->left_bv+$deposit_amount;
                $new_rbv=$currentBV->right_bv;
            }
            else {
                $new_lbv=$currentBV->left_bv;
                $new_rbv=$currentBV->right_bv +$deposit_amount;
            }

            MemberExtra::where('user_id', $posid)
                ->update([
                   'left_bv' => $new_lbv,
                   'right_bv' => $new_rbv,
                ]);
            $id =$posid;

        } else {
            break;
        }

    }//while
    return 0;

}



function updatePaid($id){
    while($id!=""||$id!="0"){
        if(isMemberExists($id)) {
            $posid=getParentId($id);
            if($posid=="0")
                break;
            $position=getPositionParent($id);

            $currentCount = MemberExtra::where('user_id',$posid )->first();

            $new_lpaid = $currentCount->left_paid;
            $new_rpaid = $currentCount->right_paid;
            $new_lfree = $currentCount->left_free;
            $new_rfree = $currentCount->right_free;

            if($position=="L") {
                $new_lfree = $new_lfree-1;
                $new_lpaid = $new_lpaid+1;
            }else {
                $new_rfree = $new_rfree-1;
                $new_rpaid = $new_rpaid+1;
            }

            MemberExtra::where('user_id', $posid)
                ->update([
                   'left_paid' => $new_lpaid,
                   'right_paid' => $new_rpaid,
                   'left_free' => $new_lfree,
                   'right_free' => $new_rfree,
                ]);
            $id =$posid;

        } else {
            break;
        }
    }
    return 0;
}






function treeeee($id='', $uid=''){
    while($id!=""||$id!="0") {
        if(isMemberExists($id)){
            $posid=getParentId($id);
            if($posid=="0")
                break;
            if($posid==$uid){
                return true;
            }
            $id =$posid;
        } else {
            break;
        }
    }//while
    return 0;
}

function printBV($id){
    $cbv = MemberExtra::where('user_id', $id)->first();
    $rid = User::whereId($id)->first();
    if($rid->referrer_id == NULL){
        $referrer_id = 1;
    }else{
        $referrer_id = $rid->referrer_id;
    }
    $rnm = User::where('id', $referrer_id)->first();
    $p = ProductShipment::where('user_id', $id)->whereIn('status', [1,2])->count();
    echo "<b>Product Buy:</b> $p <br>";
    echo "<b>Referred By:</b> $rnm->username <br>";
    echo "<b>Current BV:</b> L-$cbv->left_bv | R-$cbv->right_bv <br>";
}

function printBelowMember($id){
    $bmbr = MemberExtra::where('user_id', $id)->first() ;
    echo "<b>Paid Member Below:</b> L-$bmbr->left_paid | R-$bmbr->right_paid <br>";
    echo "<b>Free Member Below:</b> L-$bmbr->left_free | R-$bmbr->right_free <br>";
}

function updateMemberBelow($id='', $type=''){
    while($id!=""||$id!="0") {
        if(isMemberExists($id)) {
            $posid=getParentId($id);
            if($posid=="0")
                break;
            $position=getPositionParent($id);
            $currentCount = MemberExtra::where('user_id', $posid)->first() ;

            $new_lpaid = $currentCount->left_paid;
            $new_rpaid = $currentCount->right_paid;
            $new_lfree = $currentCount->left_free;
            $new_rfree = $currentCount->right_free;

            if($position=="L") {
                if($type=='FREE'){
                    $new_lfree = $new_lfree+1;
                }else{
                    $new_lpaid = $new_lpaid+1;
                }
            }else {
                if($type=='FREE'){
                    $new_rfree = $new_rfree+1;
                }else{
                    $new_rpaid = $new_rpaid+1;
                }
            }
            MemberExtra::where('user_id',$posid)
                ->update([
                   'left_paid' => $new_lpaid,
                   'right_paid' => $new_rpaid,
                   'left_free' => $new_lfree,
                   'right_free' => $new_rfree,
                ]);
            $id =$posid;
        } else{
            break;
        }
    }
    return 0;
}

function getParentId($id =""){
    $count = User::whereId($id)->count() ;
    $posid = User::whereId($id)->first();
    if ($count == 1){
        return $posid->posid;
    }else{
        return 0;
    }
}


function getPositionParent($id =""){
    $count = User::whereId($id)->count();
    $position = User::whereId($id)->first() ;
    if ($count == 1){
        return $position->position;
    }else{
        return 0;
    }
}


function getLastChildOfLR($parentid="",$position=''){
    $childid= getTreeChildId($parentid, $position);
    if($childid!="-1"){
        $id=$childid;
    } else {
        $id=$parentid;
    }
    while($id!=""||$id!="0") {
        if(isMemberExists($id)) {
            $nextchildid= getTreeChildId($id, $position);
            if($nextchildid=="-1"){
                break;
            }else{
                $id = $nextchildid;
            }
        }else break;
    }
    return $id;
}
function getTreeChildId($parentid="",$position=""){
    $cou = User::where('posid', $parentid)->where('position', $position)->count();
    $cid = User::where('posid', $parentid)->where('position', $position)->first();
    if ($cou == 1){
        return $cid->id;
    }else{
        return -1;
    }
}

function isMemberExists($id='0'){
    $count = User::where('id', $id)->count();
    if ($count == 1){
        return true;
    }else{
        return false;
    }
}

function Short_Text($data,$length){
    $first_part = explode(" ",$data);
    $main_part = strip_tags(implode(' ',array_splice($first_part,0, $length)));
    return $main_part ."...." ;
}

function ImageCheck($ext){
    if($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png' && $ext != 'gif' && $ext != 'bnp'){
        $ext = "";
    }
    return $ext;
}

function NewFile($name, $data){
    $fh = fopen($name, "w");
    fwrite($fh,$data);
    fclose($fh);
}

function ViewFile($name){
    $fh = fopen($name, "r");
    $data = fread($fh,filesize($name));
    fclose($fh);
    return $data;
}

function Find_fist_int($string){
    preg_match_all('!\d+!', $string, $matches);
    if($matches[0] != ""){
        foreach($matches[0] as $key => $value){
            $url = $value;
            return $url;
            break;
        }
    }
}

function Replace($data) {
    $data = str_replace("'", "", $data);
    $data = str_replace("!", "", $data);
    $data = str_replace("@", "", $data);
    $data = str_replace("#", "", $data);
    $data = str_replace("$", "", $data);
    $data = str_replace("%", "", $data);
    $data = str_replace("^", "", $data);
    $data = str_replace("&", "", $data);
    $data = str_replace("*", "", $data);
    $data = str_replace("(", "", $data);
    $data = str_replace(")", "", $data);
    $data = str_replace("+", "", $data);
    $data = str_replace("=", "", $data);
    $data = str_replace(",", "", $data);
    $data = str_replace(":", "", $data);
    $data = str_replace(";", "", $data);
    $data = str_replace("|", "", $data);
    $data = str_replace("'", "", $data);
    $data = str_replace('"', "", $data);
    $data = str_replace("?", "", $data);
    $data = str_replace("  ", "_", $data);
    $data = str_replace("'", "", $data);
    $data = str_replace(".", "-", $data);
    $data = strtolower(str_replace("  ", "-", $data));
    $data = strtolower(str_replace(" ", "-", $data));
    $data = strtolower(str_replace(" ", "-", $data));
    $data = strtolower(str_replace("__", "-", $data));
    return str_replace("_", "-", $data);
}

function referralCommission($referrer_id, $user_id, $order_id) {

    static $counter = 0;
    ++$counter;

    if($referrer_id == NULL){
        return true;
    }else{

        $referrer = User::findOrFail($referrer_id);
        $alxa_coin_rate = Coin::where('id', 1)->value('rate');
        $vista_coin_rate = Coin::where('id', 2)->value('rate');

        if($counter == 1){
            $comm = 300;
            $referrerNewBalance = $referrer->balance + $comm;
            $no_of_coins_alxa = 3;
            $no_of_coins_vista = 3;
            $total_alxa = $no_of_coins_alxa * $alxa_coin_rate;
            $total_vista = $no_of_coins_vista * $vista_coin_rate;
        }
        elseif($counter > 1 && $counter <= 3){
            $comm = 50;
            $referrerNewBalance = $referrer->balance + $comm;
            $no_of_coins_alxa = 2;
            $no_of_coins_vista = 2;
            $total_alxa = $no_of_coins_alxa * $alxa_coin_rate;
            $total_vista = $no_of_coins_vista * $vista_coin_rate;
        }else{
            $comm = 2;
            $referrerNewBalance = $referrer->balance + $comm;
            $no_of_coins_alxa = 1;
            $no_of_coins_vista = 1;
            $total_alxa = $no_of_coins_alxa * $alxa_coin_rate;
            $total_vista = $no_of_coins_vista * $vista_coin_rate;
        }
        
        User::whereId($referrer->id)
                    ->update([
                        'balance' => $referrerNewBalance
                    ]); 

        alxaCoin($no_of_coins_alxa, $alxa_coin_rate, $total_alxa, $referrer->id);

        vistaCoin($no_of_coins_vista, $vista_coin_rate, $total_vista, $referrer->id); 

        commission($referrer->id, $user_id, $order_id, $comm, $no_of_coins_alxa, $no_of_coins_vista);
 
        return referralCommission($referrer->referrer_id, $user_id, $order_id);
    } 
}

function alxaCoin($no_of_coins_alxa, $alxa_coin_rate, $total_alxa, $referrer_id) {

    CoinTransaction::create([
            'coin_id' => 1,
            'number_of_coins' => $no_of_coins_alxa,
            'rate' => $alxa_coin_rate,
            'amount' => $total_alxa,
            'status' => 1,
            'transaction_id' => 'CN'.rand(),
            'user_id' => $referrer_id,
        ]);

    return true;

}

function vistaCoin($no_of_coins_vista, $vista_coin_rate, $total_vista, $referrer_id) {

    CoinTransaction::create([
            'coin_id' => 2,
            'number_of_coins' => $no_of_coins_vista,
            'rate' => $vista_coin_rate,
            'amount' => $total_vista,
            'status' => 1,
            'transaction_id' => 'CN'.rand(),
            'user_id' => $referrer_id,
        ]);

    return true;

}

function commission($referrer_id, $user_id, $order_id, $comm, $no_of_coins_alxa, $no_of_coins_vista) {

    Commission::create([
            'user_id' => $user_id,
            'referrer_id' => $referrer_id,
            'order_id' => $order_id,
            'money_comm' => $comm,
            'alxa_coin_comm' => $no_of_coins_alxa,
            'vista_coin_comm' => $no_of_coins_vista,
            'description' => 'You get referral commission on buying product Vista Mini Miner'  
        ]);

    return true;

}

function chartsDate() {

    
}

