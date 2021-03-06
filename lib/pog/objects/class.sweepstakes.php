<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `sweepstakes` (
	`sweepstakesid` int(11) NOT NULL auto_increment,
	`year` SMALLINT NOT NULL,
	`personid` int(11) NOT NULL,
	`sweepstakesroleid` int(11) NOT NULL, INDEX(`personid`,`sweepstakesroleid`), PRIMARY KEY  (`sweepstakesid`)) ENGINE=MyISAM;
*/

/**
* <b>sweepstakes</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0e / PHP5.1 MYSQL
* @see http://www.phpobjectgenerator.com/plog/tutorials/45/pdo-mysql
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5.1&wrapper=pdo&pdoDriver=mysql&objectName=sweepstakes&attributeList=array+%28%0A++0+%3D%3E+%27year%27%2C%0A++1+%3D%3E+%27person%27%2C%0A++2+%3D%3E+%27sweepstakesRole%27%2C%0A%29&typeList=array%2B%2528%250A%2B%2B0%2B%253D%253E%2B%2527SMALLINT%2527%252C%250A%2B%2B1%2B%253D%253E%2B%2527BELONGSTO%2527%252C%250A%2B%2B2%2B%253D%253E%2B%2527BELONGSTO%2527%252C%250A%2529
*/
include_once('class.pog_base.php');
class sweepstakes extends POG_Base
{
	public $sweepstakesId = '';

	/**
	 * @var SMALLINT
	 */
	public $year;
	
	/**
	 * @var INT(11)
	 */
	public $personId;
	
	/**
	 * @var INT(11)
	 */
	public $sweepstakesroleId;
	
	public $pog_attribute_type = array(
		"sweepstakesId" => array('db_attributes' => array("NUMERIC", "INT")),
		"year" => array('db_attributes' => array("NUMERIC", "SMALLINT")),
		"person" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
		"sweepstakesRole" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
		);
	public $pog_query;
	
	
	/**
	* Getter for some private attributes
	* @return mixed $attribute
	*/
	public function __get($attribute)
	{
		if (isset($this->{"_".$attribute}))
		{
			return $this->{"_".$attribute};
		}
		else
		{
			return false;
		}
	}
	
	function sweepstakes($year='')
	{
		$this->year = $year;
	}
	
	
	/**
	* Gets object from database
	* @param integer $sweepstakesId 
	* @return object $sweepstakes
	*/
	function Get($sweepstakesId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `sweepstakes` where `sweepstakesid`='".intval($sweepstakesId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->sweepstakesId = $row['sweepstakesid'];
			$this->year = $this->Unescape($row['year']);
			$this->personId = $row['personid'];
			$this->sweepstakesroleId = $row['sweepstakesroleid'];
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $sweepstakesList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `sweepstakes` ";
		$sweepstakesList = Array();
		if (sizeof($fcv_array) > 0)
		{
			$this->pog_query .= " where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$this->pog_query .= " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) != 1)
					{
						$this->pog_query .= " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
					{
						if ($GLOBALS['configuration']['db_encoding'] == 1)
						{
							$value = POG_Base::IsColumn($fcv_array[$i][2]) ? "BASE64_DECODE(".$fcv_array[$i][2].")" : "'".$fcv_array[$i][2]."'";
							$this->pog_query .= "BASE64_DECODE(`".$fcv_array[$i][0]."`) ".$fcv_array[$i][1]." ".$value;
						}
						else
						{
							$value =  POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$this->Escape($fcv_array[$i][2])."'";
							$this->pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
						}
					}
					else
					{
						$value = POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$fcv_array[$i][2]."'";
						$this->pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
					}
				}
			}
		}
		if ($sortBy != '')
		{
			if (isset($this->pog_attribute_type[$sortBy]['db_attributes']) && $this->pog_attribute_type[$sortBy]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$sortBy]['db_attributes'][0] != 'SET')
			{
				if ($GLOBALS['configuration']['db_encoding'] == 1)
				{
					$sortBy = "BASE64_DECODE($sortBy) ";
				}
				else
				{
					$sortBy = "$sortBy ";
				}
			}
			else
			{
				$sortBy = "$sortBy ";
			}
		}
		else
		{
			$sortBy = "sweepstakesid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$sweepstakes = new $thisObjectName();
			$sweepstakes->sweepstakesId = $row['sweepstakesid'];
			$sweepstakes->year = $this->Unescape($row['year']);
			$sweepstakes->personId = $row['personid'];
			$sweepstakes->sweepstakesroleId = $row['sweepstakesroleid'];
			$sweepstakesList[] = $sweepstakes;
		}
		return $sweepstakesList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $sweepstakesId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `sweepstakesid` from `sweepstakes` where `sweepstakesid`='".$this->sweepstakesId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `sweepstakes` set 
			`year`='".$this->Escape($this->year)."', 
			`personid`='".$this->personId."', 
			`sweepstakesroleid`='".$this->sweepstakesroleId."' where `sweepstakesid`='".$this->sweepstakesId."'";
		}
		else
		{
			$this->pog_query = "insert into `sweepstakes` (`year`, `personid`, `sweepstakesroleid` ) values (
			'".$this->Escape($this->year)."', 
			'".$this->personId."', 
			'".$this->sweepstakesroleId."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->sweepstakesId == "")
		{
			$this->sweepstakesId = $insertId;
		}
		return $this->sweepstakesId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $sweepstakesId
	*/
	function SaveNew()
	{
		$this->sweepstakesId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `sweepstakes` where `sweepstakesid`='".$this->sweepstakesId."'";
		return Database::NonQuery($this->pog_query, $connection);
	}
	
	
	/**
	* Deletes a list of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param bool $deep 
	* @return 
	*/
	function DeleteList($fcv_array)
	{
		if (sizeof($fcv_array) > 0)
		{
			$connection = Database::Connect();
			$pog_query = "delete from `sweepstakes` where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$pog_query .= " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) !== 1)
					{
						$pog_query .= " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
					{
						$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$this->Escape($fcv_array[$i][2])."'";
					}
					else
					{
						$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$fcv_array[$i][2]."'";
					}
				}
			}
			return Database::NonQuery($pog_query, $connection);
		}
	}
	
	
	/**
	* Associates the person object to this one
	* @return boolean
	*/
	function GetPerson()
	{
		$person = new person();
		return $person->Get($this->personId);
	}
	
	
	/**
	* Associates the person object to this one
	* @return 
	*/
	function SetPerson(&$person)
	{
		$this->personId = $person->personId;
	}
	
	
	/**
	* Associates the sweepstakesRole object to this one
	* @return boolean
	*/
	function GetSweepstakesrole()
	{
		$sweepstakesrole = new sweepstakesRole();
		return $sweepstakesrole->Get($this->sweepstakesroleId);
	}
	
	
	/**
	* Associates the sweepstakesRole object to this one
	* @return 
	*/
	function SetSweepstakesrole(&$sweepstakesrole)
	{
		$this->sweepstakesroleId = $sweepstakesrole->sweepstakesroleId;
	}
}
?>