<?php
namespace SEI;


use SEI\DbAdapters\DBAdapter;

/**
 * Auth class
 * @author arsenleontijevic
 * @since 29.09.2019
 *
 */
class Auth {


	/**
	 * 
	 * @var \SEI\DbAdapters\DbAdapterInterface
	 */
    private $dbAdapter = null;

    public function __construct(\SEI\DbAdapters\DbAdapterInterface $dbAdapter){
        session_start();
        $this->dbAdapter = $dbAdapter;
	}


    /**
     * Set Db Adapter
     * 
     * @param \SEI\DbAdapters\DbAdapterInterface $db
     */
    protected function setDbAdapter(\SEI\DbAdapters\DbAdapterInterface $dbAdapter)
    {
        if (is_null($this->dbAdapter)) {
            $this->dbAdapter = $dbAdapter;
        }
    	return $this;
    }
    
    /**
     * Get Db Adapter
     * 
     * @param \SEI\DbAdapters\DbAdapterInterface $dbAdapter
     * @return \SEI\DbAdapters\DbAdapterInterface
     */
    protected function getDbAdapter()
    {
    	return $this->dbAdapter;
    }
    	
    
    /**
     * 
     * @return array
     */
    function generateTokens(): array
    {
        $selector = bin2hex(random_bytes(16));
        $validator = bin2hex(random_bytes(32));
        
        return [$selector, $validator, $selector . ':' . $validator];
    }
    
    /**
     * 
     * @param string $token
     * @return array|NULL
     */
    function parseToken(string $token): ?array
    {
        $parts = explode(':', $token);
        
        if ($parts && count($parts) == 2) {
            return [$parts[0], $parts[1]];
        }
        return null;
    }
    
    /**
     * 
     * @param int $user_id
     * @param string $selector
     * @param string $hashed_validator
     * @param string $expiry
     * @return bool
     */
    public function insertUserToken(int $user_id, string $selector, string $hashed_validator, string $expiry): bool{
        
        $sql = 'INSERT INTO usr_tokens(user_id, selector, hashed_validator, expiry)
            VALUES(:user_id, :selector, :hashed_validator, :expiry)';
        
        $statement = $this->getDbAdapter()->prepare($sql);
        $statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':selector', $selector);
        $statement->bindValue(':hashed_validator', $hashed_validator);
        $statement->bindValue(':expiry', $expiry);
        
        return $statement->execute();
    }

    /**
     * 
     * @param string $selector
     * @return unknown
     */
    function findTokenBySelector(string $selector)
    {
        $sql = 'SELECT id, selector, hashed_validator, user_id, expiry
                FROM usr_tokens
                WHERE selector = :selector AND
                    expiry >= now()
                LIMIT 1';
        
        $statement = $this->getDbAdapter()->prepare($sql);
        $statement->bindValue(':selector', $selector);
        
        $statement->execute();
        
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }
    
    /**
     * 
     * @param int $user_id
     * @return bool
     */
    function deleteUserToken(int $user_id): bool
    {
        $sql = 'DELETE FROM usr_tokens WHERE user_id = :user_id';
        $statement = $this->getDbAdapter()->prepare($sql);
        $statement->bindValue(':user_id', $user_id);
        
        return $statement->execute();
    }
    
    
    /**
     * 
     * @param string $token
     * @return NULL|unknown
     */
    function findUserByToken(string $token)
    {
        $tokens = $this->parseToken($token);
        
        if (!$tokens) {
            return null;
        }
        
        $sql = 'SELECT users.id, users.email
            FROM users
            INNER JOIN user_tokens ON user_id = users.id
            WHERE selector = :selector AND
                expiry > now()
            LIMIT 1';
        
        $statement = db()->prepare($sql);
        $statement->bindValue(':selector', $tokens[0]);
        $statement->execute();
        
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }
    
    
    
    /**
     * 
     * @param string $token
     * @return bool
     */
    function tokenIsValid(string $token): bool { 
        // parse the token to get the selector and validator 
        
        [$selector, $validator] = $this->parseToken($token);
        
        $tokens = $this->findUserByToken($selector);
        if (!$tokens) {
            return false;
        }
        
        return password_verify($validator, $tokens['hashed_validator']);
    }
	
    
    /**
     * 
     * @param string $username
     * @param string $password
     * @param bool $remember
     * @return bool
     */
    function login(string $email, string $password, bool $remember = false): bool
    {
        
        $user = $this->findUserByEmail($email);
        
        
        // if user found, check the password
        if ($user && password_verify($password, $user['password'])) {
            
            $this->logUserIn($user);
            
            if ($remember) {
                $this->rememberMe($user['id']);
            }
            
            return true;
        }
        
        return false;
    }
    
    
    /**
     * 
     * @param string $email
     * @return unknown
     */
    public function findUserByEmail(string $email){
        $sql = 'SELECT id, email, password
                FROM users
                WHERE email = :email';
        
        $statement = $this->getDbAdapter()->prepare($sql);
        $statement->bindValue(':email', $email);
        
        $statement->execute();
        
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }
    
    
    /**
     * log a user in
     * @param array $user
     * @return bool
     */
    function logUserIn(array $user): bool
    {
        // prevent session fixation attack
        if (session_regenerate_id()) {
            // set username & id in the session
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_id'] = $user['id'];
            return true;
        }
        
        return false;
    }
    
    
    /**
     * 
     * @param int $user_id
     * @param int $day
     */
    function rememberMe(int $user_id, int $day = 30)
    {
        [$selector, $validator, $token] = $this->generateTokens();
        
        // remove all existing token associated with the user id
        $this->deleteUserToken($user_id);
        
        // set expiration date
        $expired_seconds = time() + 60 * 60 * 24 * $day;
        
        // insert a token to the database
        $hash_validator = password_hash($validator, PASSWORD_DEFAULT);
        $expiry = date('Y-m-d H:i:s', $expired_seconds);
        
        if ($this->insertUserToken($user_id, $selector, $hash_validator, $expiry)) {
            setcookie('remember_me', $token, $expired_seconds);
        }
    }
    
    /**
     * 
     */
    function logout(): bool
    {
        if ($this->isUserLoggedIn()) {
            
            // delete the user token
            $this->deleteUserToken($_SESSION['user_id']);
            
            // delete session
            unset($_SESSION['email'], $_SESSION['user_id`']);
            
            // remove the remember_me cookie
            if (isset($_COOKIE['remember_me'])) {
                unset($_COOKIE['remember_me']);
                setcookie('remember_user', null, -1);
            }
            
            // remove all session data
            session_destroy();
        }
        return true;
    }
    
    /**
     * 
     * @return bool
     */
    function isUserLoggedIn(): bool
    {
        // check the session
        if (isset($_SESSION['email'])) {
            return true;
        }
        
        
        // check the remember_me in cookie
        $token = filter_input(INPUT_COOKIE, 'remember_me', FILTER_SANITIZE_STRING);
        
        if ($token && $this->tokenIsValid($token)) {
            
            $user = $this->findUserByToken($token);
            
            if ($user) {
                return $this->logUserIn($user);
            }
        }
        return false;
    }
}