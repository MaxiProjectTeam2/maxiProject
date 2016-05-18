<?php
	class MySQLDatabase{
		
        private $conn;

        function __construct(){
            $this->open_connection();
        }

		public function open_connection(){
           	$dbhost = "";
        	$dbuser = "";
            $dbpass = "";
            $dbname = "";

            $this->conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
            if($this->conn->connect_error){
                die("Database connection failed: " . $this->conn->connect_error .
                	" (" . $this->conn->connect_errno. ")");

            }
		}
		
		
		// closes a conenction
        public function close_connection(){
            if(isset($this->conn)){              // isset / unset ???
                mysqli_close($this->conn);
            	unset($this->conn);
        	}
        }

        private function confirm_query($result){
            if(!$result){
                die("Database query failed.");
            }
        }

        // use this to query the db
        public function query($sql){
            $result = mysqli_query($this->conn, $sql);
            $this->confirm_query($result);
        	return $result;
        }
        
        public function insert($sql){
        	mysqli_query($this->conn,$sql);
        }

        public function escape_value($string){
        	$escaped_string = 
        		mysqli_real_escape_string($this->conn, $string);
            return $escaped_string;
        }

        public function fetch_assoc($result){
            return mysqli_fetch_assoc($result);
        }

        // implement num_rows, insert_id, affected_rows

        public function prepare($stmt){
            return mysqli_prepare($this->conn,$stmt);
        }
	
	}

	$db = new MySQLDatabase ();

?>
