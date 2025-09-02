<?php
class SessionManager
{
   public function __construct()
   {
      if (session_status() === PHP_SESSION_NONE) {
         session_start();
      }
   }

   /**
    * Starts a Guest session
    * @return void
    */
   public function startGuest()
   {
      $_SESSION['user_id'] = 0;
      $_SESSION['username'] = "Viewer";
      $_SESSION['role'] = 3;
   }

   /**
    * Logs in a User. Stores the minimal data in $_SESSION
    * @param int $user_id
    * @param string $username
    * @param int $role_id
    * @return void
    */
   public function login(int $user_id, string $username, int $role_id)
   {
      session_regenerate_id(true); //prevent session fixation
      $_SESSION['user_id'] = $user_id;
      $_SESSION['username'] = $username;
      $_SESSION['role'] = $role_id;
   }
   /**
    * Log out and destroy the session completely
    */
   public function logout()
   {
      //remove all data in $_SESSION
      $_SESSION = [];

      //delete cookie
      // if (ini_get("session.use_cookies")) {
      //    $params = session_get_cookie_params();
      //    setcookie(
      //       session_name(),
      //       '',
      //       time() - 42000,
      //       $params["path"],
      //       $params["domain"],
      //       $params["secure"],
      //       $params["httponly"]
      //    );
      // }

      //destroy_session
      session_destroy();
   }

   /**
    * Checks if a user is logged in.
    * @return bool
    */
   public function isLoggedIn()
   {
      //var_dump($_SESSION['user_id']);
      return isset($_SESSION['user_id']) && $_SESSION['user_id'] != 0;
   }

   /**
    * Validates the user checking against the database, if user does not match it loggs out. if user matches it updates the last_acces property.
    * @param User $logged_user
    * @return bool
    */
   public function validate(User $logged_user)
   {
      if (!$this->isLoggedIn()) {
         //nothing to validate.
         return false;
      }


      //if data stored in session matches database
      if (
         $logged_user->getUsername() == $_SESSION['username'] &&
         $logged_user->getRoleId() == $_SESSION['role']
      ) {
         //updates last acces and verifies user.
         $logged_user->setLastAccess(date('Y-m-d H:i:s'));
         $logged_user->updateSelf();
         return true;
      } else {
         //revokes session
         $this->logout();
         return false;
      }
   }

   /**
    * Get session data safely.
    * @param string $key The key to get
    * @param mixed $default The default value if the stored value is empty.
    */
   public function get(string $key, $default = null)
   {
      return $_SESSION[$key] ?? $default;
   }
}
?>