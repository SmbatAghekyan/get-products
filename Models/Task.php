<?php
class Task extends Model
{

    public function create($username, $email, $text, $image)
    {
        $sql = "INSERT INTO tasks (username, email, text, image, status) VALUES (:username, :email, :text, :image, :status)";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'username' => $username,
            'email' => $email,
            'text' => $text,
            'image' => $image,
            'status' => 0
        ]);
    }

    public function showTask($id)
    {
        $sql = "SELECT * FROM tasks WHERE id =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }

    public function showAllTasks($page = 1, $field = "id", $sort = "asc")
    {
        $offset = ($page - 1)*3;

        $sql = "SELECT * FROM tasks ORDER BY $field $sort LIMIT $offset, 3";

        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function edit($id, $text)
    {
        $sql = "UPDATE tasks SET text = :text WHERE id = :id";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'id' => $id,
            'text' => $text,
        ]);
    }

    //delete task with image
    public function delete($id)
    {
        $sql = "SELECT image FROM tasks WHERE id =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        $imageName = $req->fetch()['image'];
        $sql = 'DELETE FROM tasks WHERE id = ?';
        $req = Database::getBdd()->prepare($sql);
        if($req->execute([$id])){
            if(file_exists(ROOT.'/Storage/images/'.$imageName)){
                unlink(ROOT.'/Storage/images/'.$imageName);
            }
            return true;
        }
        else
            return false;
    }

    public function usernameChecker($username){

        $sql = "SELECT username FROM tasks WHERE username='".$username."'";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        
        return empty($req->fetchAll());
    }

    public static function changeStatus($id, $status){
        $sql = "UPDATE tasks SET status = :status WHERE id = :id";
       
        $status = $status === 'true' ? 1 : 0;

        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'id' => $id,
            'status' => $status,
        ]);
    }

    public static function getTasksCount(){
        $sql = "SELECT count(*) FROM tasks";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        $count = $req->fetchColumn();
        return $count;
    }
}
?>