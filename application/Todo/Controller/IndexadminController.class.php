<?php
namespace Todo\Controller;
use Common\Controller\AdminbaseController;

class IndexadminController extends AdminbaseController{
	protected $todo_obj;

	function _initialize() {
		parent::_initialize();
		$this->todo_obj = D("Todo/Todo");
	}
		
	function index(){
		$todos_src = $this->todo_obj
		->where(array("show"=>1))
		->order("listname, priority ASC")
		//->limit($page->firstRow . ',' . $page->listRows)
		->select();
		
		//$roles_src=$this->role_obj->select();
		// $todos=array();
		// $doings=array();
		// $dones=array();
		$tds=array();
		foreach ($todos_src as $r){
			$todid=$r['id'];
			$listname=$r['listname'];
			if($r['state']==1)
				$tds["$listname"]['todos']["$todid"]=$r;
			elseif($r['state']==2)
				$tds["$listname"]['doings']["$todid"]=$r;
			elseif($r['state']==3)
				$tds["$listname"]['dones']["$todid"]=$r;
		}
		//$this->assign("page", $page->show('Admin'));
		$this->assign("tds",$tds);
		// $this->assign("doings",$doings);
		// $this->assign("dones",$dones);
		$this->display();
	}

	
	
	function addnewtodo(){
		if(IS_POST){
			if ($this->todo_obj->create()) {
				if ($this->todo_obj->add($_POST)!==false) {
					//$this->success("添加成功！");
					//header("Location: ".U("Indexadmin/index")); 
					echo json_encode(array('status' => 1));
				}
				else {
					$this->error("添加失败！");
				}
			}
			else {
				$this->error($this->todo_obj->getError());
			}
		}

	}

	function move(){
		if(IS_POST){
			if ($this->todo_obj->create()) {
				if ($this->todo_obj->save($_POST)!==false) {
					//$this->success("添加成功！");
					//header("Location: ".U("Indexadmin/index")); 
					echo json_encode(array('status' => 1));
				}
				else {
					$this->error("添加失败！");
				}
			}
			else {
				$this->error($this->todo_obj->getError());
			}
		}
		else
			echo "no post";
	}
	// function addnewtodo(){
	// 	$title=$_POST['title'];
	// 	$listname=$_POST['listname'];
	// 	$groupname=$_POST['groupname'];
	// 	$deadline=$_POST['deadline'];
	// 	$description=$_POST['description'];
	// 	$priority=$_POST['priority'];
	// 	$privacy=$_POST['privacy'];

	// 	$data= array('status' => 1 , 'data' => $title );
	// 	echo json_encode($data);
	// }
}