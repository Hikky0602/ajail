<?php 

//require_once("BaseModel.php");
//class database extends BaseModel{
class database {
	private $link="";
	private $sql="";
	
	public function __construct(){
		//parent::__construct();
		$this->link = mysqli_connect('localhost','user','password','Akifarm_db');
		$this->sql="";
		//mysql_set_charset('utf8');
	}
	 public function insert($table,$col,$data){
		/* $table・・・DB内の$tableテーブル
		** $col・・・insertするテーブルの列名
		** $data・・・insertする値（$colと対応させる）
		*/
		//返り値 true・・・insert成功　false・・・insert失敗
		
		/* テーブル名のsql */
			$this->sql="INSERT INTO ".$table."( "
					.$col
					." ) "
					." VALUES ( "
					.$data
					." ) ";
					echo "  <br>";
		$result = mysqli_query($this->link,$this->sql);
		if(!$result){
			echo "error" . mysqli_error($this->link);
			return false;
		}else{
			return true;
		}				
	}
	
	public function select($table,$column='', $where=''){
		/* $table・・・DB内の$tableテーブル
		** $col・・・selectするテーブルの列名
		** $where・・・where句を指定する場合は加える
		** $arrVal・・・
		*/
		//返り値 select結果
		
		$columnKey =( $column !=='') ? $column : "*" ; 
		$whereSQL = ( $where !== '' )?' WHERE  ' . $where :'';
		$this->sql=" SELECT "
			.$columnKey
			." FROM "
			.$table
			.$whereSQL;
		
		//echo $this->sql . "<br>";
		
		$res=mysqli_query($this->link,$this->sql);
		$data = array();
                if(!$res){
                 echo "error" . mysqli_error($this->link);
                }
		while($row=mysqli_fetch_assoc($res)){
			$data[]=$row;
		}
		
		return $data;
	}
	

	public function delete($table,$where=''){

		$whereSQL = ( $where !== '' )?' WHERE  ' . $where :'';
		$this->sql=" DELETE FROM "
			.$table
			.$whereSQL;

		$result = mysqli_query($this->link,$this->sql);
		if(!$result){
			echo "error" . mysqli_error($this->link);
			return false;
		}else{
			return true;
		}	
	}

	 public function IDcheck($table,$column='',$where=''){
                $data = array();
                $data = $this->select($table, $column,$where);
                $counts = count($data);
                if($counts>=1){
					return 1;
                }else{
					return 0; 
	}
                
	}

       


   
         public function update($table, $setcol, $value1, $wherecol, $value2){
                $this->sql=" UPDATE " . $table . " SET " . $setcol . " = " . $value1 . " WHERE " . $wherecol . " = '" . $value2  ."'";   
                $result = mysqli_query($this->link, $this->sql);
                echo $this->sql;
                if(!$result){
                    echo "error" . mysqli_error($this->link);
                    return false;
                }else{
                    return true;
	        }
         }

}



?>
