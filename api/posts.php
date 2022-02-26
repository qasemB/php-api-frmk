<?php

if ($method == 'GET') {
    
    if ($id) {
        $data = DB::query("SELECT * FROM $tableName WHERE id=:id",[':id'=>$id]);
    }else{
        $data = DB::query("SELECT * FROM $tableName");
    }
    if ($data != null) echo json_encode(['data'=>$data, 'message'=>'data received successfully']);
    else echo json_encode(['message'=>'there are no posts']);

}elseif ($method == 'GET') {
    # code...
}elseif ($id) {
    # code...
}else{

}
