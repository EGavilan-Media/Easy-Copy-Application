<?php 
	class Apps extends Controllers{
		public function __construct(){
			parent::__construct();
		}

		public function Apps(){
			$data['page_title'] = "Easy Copy Application";
			$data['page_functions_js'] = "functions_apps.js";
			$this->views->getView($this,"apps",$data);
		}

		public function setClipboard(){
			if($_POST){
				$id = intval($_POST['id']);
				$title = ucwords(strClean($_POST['title']));
				$text = ucwords(strClean($_POST['text']));

				$errors_detected  = false;
				$errors = array();
				$arrayResponse = array();

				if(!validateTitle($title)){
					$errors_detected  = true;
					$errors[] = "- Text must be between 1 and 100 characters.";
				}

				if(!validateText($text)){
					$errors_detected  = true;
					$errors[] = "- Must be at least 1 characters.";
				}

				if($errors_detected == false){
					$request_clickboard = "";
					if($id == 0){
						$request_clickboard = $this->model->insertItem($title, $text, date('Y-m-d H:i:s'));
					}else{
						$request_clickboard = $this->model->updateItem($id, $title, $text, date('Y-m-d H:i:s'));
					}

					if($request_clickboard == 'created_message'){
						$arrayResponse = array('status' => 'created_message', 
												'message' => 'Information added successfully!');
					}else if($request_clickboard == 'updated_message'){
								$arrayResponse = array('status' => 'updated_message', 
														'message' => 'Information was successfully updated!');
					}else if($request_clickboard == 'title_exists'){
						$arrayResponse = array('status' => 'title_error_message');
					}else{
						$arrayResponse = array("status" => 'error_message', "message" => 'Something went wrong. It is not possible to save data.');
					}
				}else{
					$arrayResponse = $errors;
				}
				echo json_encode($arrayResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getClipboard(){
			$arrayData = $this->model->selectClipboard();
			for ($i=0; $i < count($arrayData); $i++){
				echo '
				<div class="col">
					<div class="card shadow-sm">
					<div class="card-header">
						<h5 classs="card-title">'.$arrayData[$i]['clipboard_title'].'</h5>
					</div>
					<div class="card-body">
						<button class="btn btn-sm btn-light" style="width:100%;" value = "'.$arrayData[$i]['clipboard_text'].'" onclick="copyToClipboard(this.value)" id="myInput">'.$arrayData[$i]['clipboard_text'].'</button>
					</div>
					<div class="card-footer">
						<div class="align-button-right">
						<small class="text-muted">Created on '.$arrayData[$i]['clipboard_created_date'].'</small>
						<div class="btn-group">
							<button type="button" class="btn btn-sm btn-outline-primary" onClick="updateItem('.$arrayData[$i]['clipboard_id'].')" >Edit</button>
							<button type="button" class="btn btn-sm btn-outline-danger" onClick="deleteText('.$arrayData[$i]['clipboard_id'].')" >Delete</button>
						</div> 
						</div> 
					</div>
					</div>
				</div>
				<br>';
			}
			die();
		}

		public function getItem($clipboard_id){
			$clipboard_id = intval($clipboard_id);
			if($clipboard_id > 0){
				$arrayData = $this->model->selectItem($clipboard_id);
				if(empty($arrayData)){
					$arrayResponse = array('user_status' => false, 'message' => 'Data not found.');
				}else{
					$arrayResponse = array('user_status' => true, 'data' => $arrayData);
				}
				echo json_encode($arrayResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function deleteItem(){
			if($_POST){
				$clipboard_id = intval($_POST['clipboard_id']);
				$requestDelete = $this->model->deleteItem($clipboard_id, date('Y-m-d H:i:s'));
				if($requestDelete){
					$arrayResponse = array('user_status' => true, 'message' => 'Item Information has been deleted successfully!');
				}else{
					$arrayResponse = array('user_status' => false, 'message' => 'Something went wrong!');
				}
				echo json_encode($arrayResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
	}
?>