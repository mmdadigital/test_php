<?php
/**
 * Open the connection with the database
 *
 * @author wfraga
 */ 
class dbConn {
	public $conn;
	public function __construct(){

		include $_SERVER['DOCUMENT_ROOT'].'/config.php';
		// Connect to server and select database.
		$this->conn = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $username, $password);
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
};

class loginForm extends dbConn {
        
    /**
     * Check if the user exist in the database
     *
     * @author wfraga
     */ 
    public function checkLogin($myusername, $mypassword) {

            try {
                    $db = new dbConn;
                    $err = '';
            }
            catch (PDOException $e) {
                    $err = "Error: " . $e->getMessage();
            }
            
            $result = $db->conn->prepare("SELECT * FROM members WHERE username = '$myusername'");
            
            try {
                $result->execute();
                // Gets query result
                $result = $result->fetch(PDO::FETCH_ASSOC);
                $success = TRUE;
            } catch (Exception $exc) {
                $success = FALSE;
            }
            
            if($success){
                
                // Checks password entered against db password hash
                if($mypassword == $result['password']){
                    
                    // Register $myusername, $mypassword and return "true"
                    $success = 'true';
                }else {
                    //return the error message
                    $success = "<div class=\"alert alert-danger alert-dismissable\"><a href=\"/\" type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">Voltar</a><br> Wrong Username or Password</div>";
                }
                
            }

            return $success;
    }
};

class imovelOp extends dbConn{
    
    /**
     * Add an estate in the database
     * 
     * @param int $tipo The type of estate
     * @param string $rua The street of estate
     * @param string $numero The number of estate
     * @param string $cidade The city of estate
     * @param string $estado The city of estate
     * 
     * @return boolean If true, the operation was success
     *
     * @author wfraga
     */ 
    public function addImovel($tipo = 0, $rua = '', $numero = '', $cidade = '', $estado = '', $desc = '', $arr_imgs = array(), $id_contato = 0) {
        try {
                $db = new dbConn;
                $err = '';
            }
            catch (PDOException $e) {
                    $err = "Error: " . $e->getMessage();
                    return FALSE;
            }
            
            $result = $db->conn->prepare("INSERT INTO imoveis (tipo, rua, numero, cidade, estado, descricao)"
                    . "VALUES ('$tipo','$rua','$numero','$cidade','$estado','$desc');");
            
            try {
                $result->execute();
                // Gets query result
		$id_imovel = $db->conn->lastInsertId();
                $success = TRUE;
            } catch (Exception $exc) {
                $success = FALSE;
            }
            
            if($success and !empty($arr_imgs)){
                foreach ($arr_imgs as $value) {
                    $result_imgs = $db->conn->prepare("INSERT INTO imagens_imovel (id_imovel, imagem_filename)"
                    . "VALUES ('$id_imovel','$value');");
                    
                    try {
                        $result_imgs->execute();
                        $success = TRUE;
                    } catch (Exception $exc) {
                        $success = FALSE;
                    }
                }
            }
            
            if(!is_null($id_imovel)){
                $success = $this->relImovelContato($id_imovel, $id_contato);
            }
            
            return $success;
    }
    
    /**
     * Add a contact in the database
     * 
     * @param int $nome The type of estate
     * @param string $telefones The street of estate
     * @param string $emails The number of estate
     * 
     * @return boolean If true, the operation was success
     *
     * @author wfraga
     */ 
     public function addContato($nome = '', $telefones = array(), $emails = array()) {
         
         try {
                $db = new dbConn;
                $err = '';
            }
            catch (PDOException $e) {
                    $err = "Error: " . $e->getMessage();
                    return FALSE;
            }
            
            $result = $db->conn->prepare("INSERT INTO contatos (nome)"
                    . "VALUES ('$nome');");
            
            try {
                $result->execute();
                // Gets query result
		$id_contato = $db->conn->lastInsertId();
                $success = TRUE;
            } catch (Exception $exc) {
                $success = FALSE;
            }
            
            if($success){
                
                foreach ($telefones as $value) {
                    
                    $result_tels = $db->conn->prepare("INSERT INTO telefones_contato (id_contato, telefone_numero)"
                    . "VALUES ('$id_contato','$value');");
                    
                    try {
                        $result_tels->execute();
                        $success = TRUE;
                    } catch (Exception $exc) {
                        $success = FALSE;
                    }
                    
                }
                
            }
            
            if($success){
                
                foreach ($emails as $value) {
                    
                    $result_emails = $db->conn->prepare("INSERT INTO emails_contato (id_contato, email_contato)"
                    . "VALUES ('$id_contato','$value');");
                    
                    try {
                        $result_emails->execute();
                        $success = TRUE;
                    } catch (Exception $exc) {
                        $success = FALSE;
                    }
                    
                }
                
            }
            
            return $success;
         
     }
     
     /**
     * Add a type in the database
     * 
     * @param int $nome The name of estate's type
     * 
     * @return boolean If true, the operation was success
     *
     * @author wfraga
     */ 
     public function addTipoImovel($nome = 'sem nome') {
         
         try {
                $db = new dbConn;
                $err = '';
            }
            catch (PDOException $e) {
                    $err = "Error: " . $e->getMessage();
                    return FALSE;
            }
            
            $result = $db->conn->prepare("INSERT INTO tipo_imovel (tipo)"
                    . "VALUES ('$nome');");
            
            try {
                $result->execute();
                $success = TRUE;
            } catch (Exception $exc) {
                $success = FALSE;
            }
            
            return $success;
         
     }
     
     /**
     * It set the relationship of estate with contact
     * 
     * @param int $id_imovel The identifier of estate
     * @param int $id_contato The identifier of contact
     * 
     * @return boolean If true, the operation was success
     *
     * @author wfraga
     */ 
     public function relImovelContato($id_imovel, $id_contato) {
         
        try {
            $db = new dbConn;
            $err = '';
        }
        catch (PDOException $e) {
            $err = "Error: " . $e->getMessage();
            return FALSE;
        }
         
        $result = $db->conn->prepare("INSERT INTO relacao_imovel_contato (id_imovel, id_contato)"
                    . "VALUES ('$id_imovel','$id_contato');");
                    
        try {
            $result->execute();
            $success = TRUE;
        } catch (Exception $exc) {
            $success = FALSE;
        }
        
        return $success;
         
     }
     
     /**
     * Get all contacts from database
     * 
     * @return array $result The array with datas of contacts
     *
     * @author wfraga
     */ 
     public function getAllContatos() {
         
        try {
            $db = new dbConn;
            $err = '';
        }
        catch (PDOException $e) {
            $err = "Error: " . $e->getMessage();
            return FALSE;
        }
         
        $result = $db->conn->prepare("SELECT * FROM contatos");
                    
        try {
            $result->execute();
            // Gets query result
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            $result = NULL;
        }
        
        return $result;
     }
     
     /**
     * Get a especific numbers od estates from database
     * 
      * @param int $nums Numbers of estates for returning
      * 
     * @return array $result The array with datas of estates
     *
     * @author wfraga
     */ 
     public function getImoveis($nums = 10) {
         
        try {
            $db = new dbConn;
            $err = '';
        }
        catch (PDOException $e) {
            $err = "Error: " . $e->getMessage();
            return FALSE;
        }
         
        $result = $db->conn->prepare("SELECT * FROM imoveis "
                . "INNER JOIN imagens_imovel ON imoveis.idimoveis=imagens_imovel.id_imovel "
                . "GROUP BY imagens_imovel.idimagens_imovel "
                . "LIMIT $nums");
        
        try {
            $result->execute();
            // Gets query result
            $result = $result->fetchAll(\PDO::FETCH_GROUP | \PDO::FETCH_ASSOC);
            $result = $this->organizaArrayGroupBy($result);
        } catch (Exception $exc) {
            $result = NULL;
        }
        
        return $result;
         
     }
     
      /**
     * Add a type in the database
     * 
      * @param int $nums Numbers of estates for returning
      * 
     * @return array $result The array with datas of estates
     *
     * @author wfraga
     */ 
     public function getNodeImovel($id_imovel) {
         
        try {
            $db = new dbConn;
            $err = '';
        }
        catch (PDOException $e) {
            $err = "Error: " . $e->getMessage();
            return FALSE;
        }
        
        if(isset($id_imovel) and !empty($id_imovel)){
            
        $result = $db->conn->prepare("SELECT * FROM imoveis "
                . "INNER JOIN imagens_imovel ON imoveis.idimoveis=imagens_imovel.id_imovel "
                . "WHERE imoveis.idimoveis=$id_imovel "
                . "GROUP BY imagens_imovel.idimagens_imovel ");
        
        try {
            $result->execute();
            // Gets query result
            $result = $result->fetchAll(\PDO::FETCH_GROUP | \PDO::FETCH_ASSOC);
            $result = $this->organizaArrayGroupBy($result);
        } catch (Exception $exc) {
            $result = NULL;
        }
            
        }
         
        return $result;
         
     }
     
     /**
     * Get a all types of estates from database
     * 
     * @return array $result The array with datas of estates
     *
     * @author wfraga
     */ 
     public function getAllTiposImoveis() {
         
        try {
            $db = new dbConn;
            $err = '';
        }
        catch (PDOException $e) {
            $err = "Error: " . $e->getMessage();
            return FALSE;
        }
         
        $result = $db->conn->prepare("SELECT * FROM tipo_imovel");
        
        try {
            $result->execute();
            // Gets query result
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            $result = NULL;
        }
        
        return $result;
     }
     
      /**
     * Sets Array of estates in the patterns 
     * 
     * @return array $result The array with datas of estates
     *
     * @author wfraga
     */ 
     public function organizaArrayGroupBy($array) {
         
         $arr_retorno = array();
         
         foreach ($array as $key => $value) {
             $arr_retorno[$key] = $value[0];
             foreach ($value as $sub_item) {
                 $arr_retorno[$key]['imagens'][] = $sub_item['imagem_filename'];
             }
         }
         
         return $arr_retorno;
     }

}
?>
