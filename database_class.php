<?php 

class database{
	private $link="";
	private $sql="";
	
	function __construct(){
		$this->link = mysqli_connect('localhost','user','password','Akifarm_db');
		$this->sql="";
		mysql_set_charset('utf8');
	}
	 public function insert($table,$col,$data){
		/* $table�E�E�EDB����$table�e�[�u��
		** $col�E�E�Einsert����e�[�u���̗�
		** $data�E�E�Einsert����l�i$col�ƑΉ�������j
		*/
		//�Ԃ�l true�E�E�Einsert�����@false�E�E�Einsert���s
		
		/* �e�[�u������sql */
			$this->sql="INSERT INTO ".$table."( "
					.$col
					." ) "
					." VALUES ( '"
					.$data
					."' ) ";
                        var_dump($this->sql);
		$result = mysqli_query($this->link,$this->sql);
		if(!$result){
			echo "error" . mysqli_error($this->link);
			return false;
		}else{
			return true;
		}				
	}
	
	public function select($table,$column='', $where){
		/* $table�E�E�EDB����$table�e�[�u��
		** $col�E�E�Eselect����e�[�u���̗�
		** $where�E�E�Ewhere����w�肷��ꍇ�͉�����
		** $arrVal�E�E�E
		*/
		//�Ԃ�l select����
		
		$columnKey =( $column !=='') ? $column : "*" ; 
		$whereSQL = ( $where !== '' )?' WHERE  ' . $where :'';
        	$this->sql=" SELECT "
			.$columnKey
			." FROM "
			.$table
			.$whereSQL;
	//	print_r($this->sql);
		$res=mysqli_query($this->link,$this->sql);
		$data = array();
                if(!$res){
                 echo "error" . mysqli_error($this->link);
                // $arart = 1;
                }
		while($row=mysqli_fetch_assoc($res)){
			$data[]=$row;
		}
        //        var_dump($data);
		return $data;
	}
       
         public function IDcheck($table,$column='',$where){
                $data = array();
                $data = $this->select($table, $column='',$where);
                $counts = count($data);
                if($counts>=1){ return 1;
                }else{ return 0; }
                }
       
      }


?>
