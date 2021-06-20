<?php 
	class AppsModel extends Mysql {
		private $clipboard_id;
		private $clipboard_title;
		private $clipboard_text;
		private $clipboard_status;
		private $clipboard_created_date;
		private $clipboard_updated_date;

		public function __construct() {
			parent::__construct();
		}

		public function insertItem(string $title, string $text, string $created_date) {
			$this->clipboard_title = $title;
			$this->clipboard_text = $text;
			$this->clipboard_created_date = $created_date;
			$return = 0;

			// Verify that the title is not already registered on the clickboard.
			$sql = "SELECT * FROM tbl_clipboard WHERE 
				clipboard_title = '{$this->clipboard_title}' AND clipboard_status != 0";
			$request = $this->select_all($sql);

			if(!empty($request)){
				$return = "title_exists";
			}else{
				$query_insert  = "INSERT INTO tbl_clipboard(clipboard_title,
														clipboard_text,
														clipboard_created_date) VALUES(?, ?, ?)";

					$arrData = array($this->clipboard_title,
									$this->clipboard_text,
									$this->clipboard_created_date);

					$request_insert = $this->insert($query_insert, $arrData);
					$return = 'created_message';
			}
			return $return;
		}

		public function selectClipboard(){
			$sql = "SELECT clipboard_id, 
						clipboard_title,
						clipboard_text,
						DATE_FORMAT(clipboard_created_date, '%m-%d-%Y')
						AS clipboard_created_date
					FROM tbl_clipboard WHERE clipboard_status != 0";

			$request = $this->select_all($sql);
			return $request;
		}

		public function selectItem(int $clipboard_id) {
			$this->clipboard_id = $clipboard_id;

			$sql = "SELECT clipboard_id,
				clipboard_title,
				clipboard_text,
				clipboard_status,
				clipboard_created_date,
				clipboard_updated_date
			FROM tbl_clipboard WHERE clipboard_id = $this->clipboard_id";

			$request = $this->select($sql);
			return $request;
		}

		public function updateItem(int $id, string $title, string $text, string $updated_date) {
			$this->clipboard_id = $id;
			$this->clipboard_title = $title;
			$this->clipboard_text = $text;
			$this->clipboard_updated_date = $updated_date;
			$return = 0;

			// Verify that the title is not already registered on the clickboard table.
			$sql = "SELECT * FROM tbl_clipboard WHERE 
				clipboard_title = '{$this->clipboard_title}' AND clipboard_status != 0 AND clipboard_id != $this->clipboard_id";
			$request = $this->select_all($sql);

			if(!empty($request)){
				$return = "title_exists";
			}else{
				$sql = "UPDATE tbl_clipboard SET  clipboard_title = ?, clipboard_text = ?, clipboard_updated_date = ?
											WHERE clipboard_id = $this->clipboard_id ";

				$arrayData = array($this->clipboard_title, $this->clipboard_text, $this->clipboard_updated_date);

				$request = $this->update($sql, $arrayData);

				$return = 'updated_message';
			}
			return $return;
		}

		public function deleteItem(int $clipboard_id, string $updated_date) {
			$this->clipboard_id = $clipboard_id;
			$this->clipboard_status = $status = "0";
			$this->clipboard_updated_date = $updated_date;

			$sql = "UPDATE tbl_clipboard SET clipboard_status = ?, clipboard_updated_date = ? WHERE clipboard_id = $this->clipboard_id ";

			$arrayData = array($this->clipboard_status, $this->clipboard_updated_date);

			$request = $this->update($sql,$arrayData);
			return $request;
		}

	}
?>