<?php
class conexao {
    
    private $user = 'usr_lg';
    private $pass = 'lg2023';
    private $dbh;
 
    public function conectar(){
        $this->dbh = new PDO('mysql:host=localhost;dbname=tela_login', $this->user, $this->pass); 
        return $this->dbh;
    }
}






/* try {
        $dbh = new PDO('mysql:host=localhost;dbname=tela_login', $user, $pass);
        foreach($dbh->query('SELECT * from tb_usuario') as $row) {
            print_r($row);
        }
        $dbh = null;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    } 

  */  
    

?>


