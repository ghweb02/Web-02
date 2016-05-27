<?php
	
	include_once 'UsuarioModel.class.php';
	include_once 'ExperienciaModel.class.php';

	class ProfessorModel extends UsuarioModel {

		private $email;
		private $senha;
		private $data;

		function setEmail($e) {
			$this->email = $e;
		}
		function getEmail() {
			return $this->email;
		}

		function setSenha($s) {
			$this->senha = $s;
		}
		function getSenha() {
			return $this->senha;
		}

		function setData($dt){
			$this->data = $dt;
		}

		function getDados($p = NULL) {

			if (is_null($p)){
				try {

					$pdo = new PDO('mysql:host=localhost;port=3307; dbname=escola', 'root', 'futeboll');
					$sql = "SELECT * FROM Professor"; // (Nome, Idade, Telefone, Cpf, Graduacao, Email, Senha)"; 
					$professor = $pdo->query($sql);
							
					while ($row = $professor->fetch(PDO::FETCH_OBJ)) {
						$this->data[] = $row;			
					}
					return $this->data;

				}
				catch(PDOException $e) {
					echo "Erro !".$e->getMessage().'<br>';
				}
			}

			else{
				
				try {
					$pdo = new PDO('mysql:host=localhost;port=3307; dbname=escola', 'root', 'futeboll');

					$p = join(',', $p);

					$sql = "SELECT * FROM Professor WHERE id IN ({$p})";

					$professor = $pdo->query($sql);

					while ($row = $professor->fetch(PDO::FETCH_OBJ)) {
						$this->data[] = $row;	
					}

					return $this->data;

				}
				catch(PDOException $e) {
					echo "Erro !".$e->getMessage().'<br>';
				}
				
			}	
		}

		function cadastrar() {

		    try {

		        $pdo = new PDO('mysql:host=localhost;port=3307; dbname=escola', 'root', 'futeboll');

		        $n = $this->data['nome'];
		        $i = $this->data['idade'];
		        $t = $this->data['telefone'];
		        $c = $this->data['cpf'];
		        $g = $this->data['graduacao'];
		        $e = $this->data['email'];
		        $s = $this->data['senha'];	

		        $sql = " INSERT INTO `Professor` ( `Nome` , `Idade` , `Telefone` , `Cpf` , `Graduacao` , `Email` , `Senha`)VALUES ('$n', $i, $t, $c, '$g', '$e', '$s')";
		        		        
				return ($pdo->exec($sql));
		        
		    }
		    
		    catch (PDOException $e) {
		        //caso ocorra um exceção, exibe na tela
		        print "Erro!: ".$e->getMessage()."<br>";
		        die();
		    }


		}

		function deletar($id) {

			try {
				$pdo = new PDO('mysql:host=localhost;port=3307; dbname=escola', 'root', 'futeboll');

				$sql = "DELETE FROM Professor WHERE id = '{$id}'";

				return ($pdo->exec($sql));
			}

			catch (PDOException $e) {
				echo "Erro!:".$e->getMessage()."<br>";
				die();
			}
		}

		//Comentário para teste
	}
	
?>