<?php
namespace App\Table;

use Core\Table\Table;

/**
* Classe Timeline
*/
class TimelineTable extends Table
{
	public function all20()
	{
		return $this->query("
							SELECT *
							FROM ".$this->table."
							ORDER BY id DESC
							LIMIT 20
							");
	}

	public function allDESC($value='')
	{
		return $this->query("
							SELECT *
							FROM ".$this->table."
							ORDER BY id DESC");
	}
}
