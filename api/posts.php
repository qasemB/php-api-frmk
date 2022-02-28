<?php

if ($method == 'GET') {
    if ($id) {
        $data = DB::query("SELECT * FROM $tableName WHERE id=:id", [':id' => $id]);
        $finalData  = $data[0];
    } else {
        $data = DB::query("SELECT * FROM $tableName");
        $finalData  = $data;
    }
    if ($data != null) echo json_encode(['data' => $finalData, 'message' => 'data received successfully' , 'success'=>true]);
    else echo json_encode(['message' => 'there are no posts' , 'success'=>false]);




} elseif ($method == 'POST') {
    if (true) {
        DB::query("INSERT INTO $tableName (category_id, title, body, author) VALUES(:category_id, :title, :body, :author)", [
            ':category_id' => $_POST['category_id'],
            ':title' => $_POST['title'],
            ':body' => $_POST['body'],
            ':author' => $_POST['author']
        ]);
        $data = DB::query("SELECT * FROM $tableName ORDER BY id DESC LIMIT 1");
        echo json_encode([
            'message' => 'post created successfully',
            'success'=> true,
            'data' => $data[0]
        ]);
    }else{
        echo json_encode([
            'message' => 'please pill in all the credentials',
            'success'=> false,
        ]);
    }






} elseif ($id) {
    $post = DB::query("SELECT * FROM $tableName WHERE id=:id",[':id'=>$id]);
    if ($post != null) {
        if($method == 'PUT')
        {
            $data = json_decode(file_get_contents("php://input"),true);
            DB::query("UPDATE $tableName SET category_id=:category_id, title=:title, body=:body, author=:author WHERE id=:id" , [
                ':category_id' => $data['category_id'],
                ':title' => $data['title'],
                ':body' => $data['body'],
                ':author' => $data['author'],
                ':id' => $id
            ]);
            $lastData = DB::query("SELECT * FROM $tableName WHERE id=:id",[':id'=>$id]);
            echo json_encode([
                'message' => 'post updated successfully',
                'success'=> true,
                'data' => $lastData[0]
            ]);
    
        }elseif ($method == 'DELETE') 
        {
            DB::query("DELETE FROM $tableName WHERE id=:id",[':id'=>$id]);
            echo json_encode([
                'message' => 'post deleted successfully',
                'success'=> true,
            ]);
        }
    }else{
        echo json_encode([
            'message' => 'postnot found',
            'success'=> false,
        ]);
    }
} else {
    echo json_encode([
        'message' => 'please pill in all of the credentials',
        'success'=> false,
    ]);
}
