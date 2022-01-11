<?php

require_once '../dbconnect.php';

class UserLogic 
{
  /**
   * ユーザーを登録する
   * @param array $userData
   * @return bool $result
   */
  public static function createUser($userData)
  {
    $result = false;

    $sql = 'INSERT INTO users (name, email, password) VALUES (?, ?, ?)'; 

    // ユーザーデータを配列に入れる
    $arr = [];
    $arr[] = $userData['username'];
    $arr[] = $userData['email'];
    $arr[] = password_hash($userData['password'], PASSWORD_DEFAULT);
    try {
      $stmt = connect()->prepare($sql); //sqlを使う準備
      $result = $stmt->execute($arr); // 実行する // ここで$result = True になる
      return $result; 
    } catch(\Exception $e) {
      return $result;
    }
  }

  /**
   *ログイン処理
   * @param string $email
   * @param string $password
   * @return bool $result
   */
  public static function login($email, $password)
  {
    // 結果
    $result = false;
    // ユーザーをemailから検索して取得
    $user = self::getuserByEmail($email);

    var_dump($user);
  }

  /**
   *emailからユーザを取得
   * @param string $email
   * @return array|bool $user|false
   */
  public static function getuserByEmail($email, $password)
  {
    //SQLの準備
    //SQLの実行
    //SQLの結果を返す
    $sql = 'SELECT * INTO users WHERE email = ?';

    // emailを配列に入れる
    $arr = [];
    $arr[] = $email;
    
    try {
      $stmt = connect()->prepare($sql); //sqlを使う準備
      $result = $stmt->execute($arr); // 実行する // ここで$result = True になる
      // SQLの結果を返す
      $user = $stmt->fetch();
      return $result; 
    } catch(\Exception $e) {
      return false;
    }
  }
}