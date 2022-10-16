<?php
require_once __DIR__ . '/../config/Database.php';

class Post
{
  private $conn;
  private $posts_table = 'posts';

  public function __construct()
  {
    $this->conn = (new Database())->connect();
  }

  public function get_all()
  {
    $query = "SELECT * FROM $this->posts_table";

    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function create(
    $title,
    $body,
    $user_id
  ) {
    $query = "INSERT INTO $this->posts_table SET
      title = :title,
      body = :body,
      user_id = :user_id
    ";

    $stmt = $this->conn->prepare($query);

    try {
      $stmt->execute([
        ':title' => htmlentities($title),
        ':body' => htmlentities($body),
        ':user_id' => $user_id,
      ]);

      return [
        'message' => 'The post has successfully been created',
        'success' => true
      ];
    } catch (Exception $e) {
      return ['message' => $e->getMessage()];
    }
  }

  public function delete(
    $post_id
  ) {
    $query = "DELETE FROM $this->posts_table WHERE id = :post_id";

    $stmt = $this->conn->prepare($query);

    try {
      $stmt->execute([
        ':post_id' => $post_id,
      ]);

      return [
        'message' => 'The post has successfully been created',
        'success' => true
      ];
    } catch (Exception $e) {
      return ['message' => $e->getMessage()];
    }
  }
}