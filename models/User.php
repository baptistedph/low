<?php
require_once __DIR__ . '/../config/Database.php';

class User
{
  private $conn;
  private $users_table = 'users';

  public function __construct()
  {
    $this->conn = (new Database())->connect();
  }

  public function get_all()
  {
    $query = "SELECT * FROM $this->users_table";

    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function sign_up(
    $username,
    $password,
  ) {
    $query = "INSERT INTO $this->users_table SET
      is_admin = 0,
      username = :username,
      password = :password
    ";

    $stmt = $this->conn->prepare($query);

    try {
      $stmt->execute([
        ':username' => htmlentities($username),
        ':password' => password_hash(htmlspecialchars($password), PASSWORD_BCRYPT, ['cost' => 12])
      ]);

      $this->log_in($username, $password);

      return [
        'message' => 'The user has successfully been created.',
        'success' => true
      ];
    } catch (Exception $e) {
      if ($e->getCode() === '23000') {
        return [
          'message' => 'The username is already taken.',
        ];
      }

      return ['message' => $e->getMessage()];
    }
  }

  public function log_in($username, $password) {
    $query = "SELECT * FROM $this->users_table WHERE username = :username";

    $stmt = $this->conn->prepare($query);

    try {
      $stmt->execute([
        ':username' => htmlentities($username),
      ]);

      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$user) {
        return ['message' => "This account doesn't exist."];
      }

      if (password_verify(htmlspecialchars($password), $user['password']) || $password === $user['password']) {
        session_start();

        $_SESSION['user'] = $user;

        return [
          'message' => 'The user has successfully been logged in.', 
          'success' => true
        ];
      }

      return ['message' => "The password doesn't match."];
    } catch (Exception $e) {
      return json_encode(['message' => $e->getMessage()]);
    }
  }

  public function log_out() {
    session_start();
    session_unset();
    session_destroy();

    return json_encode(['message' => 'The user has successfully been logged out.']);
  }
}