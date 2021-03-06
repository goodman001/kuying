<?php
namespace Admin\Controller;
use Org\Util;
use Think\Page;
use Think\Controller;
use Org\Util\Auth;
class ThunderController extends CommonController
{
	public function index()
	{
		//判断是否超管
		/*if(!in_array(session('u_UID'),explode(',',C('AUTH_SUPERADMIN'))))
		{
			//import('ORG.Util.Auth');//加载类库
			$auth =new Auth();
			if(!$auth->check(strtolower(MODULE_NAME.'-'.CONTROLLER_NAME.'-'.ACTION_NAME),session('u_UID')))
			{
				$this->error('您没有相关权限!');
			}
		}*/

		$Model = M("thunder");
		$count = $Model->count();
		//dump ($map) ;
		if($count>0)
		{
			$list = $Model ->select();
			$this->assign('list',$list);
		}
		$this->display();
	}
	//编辑

	public function edit()
	{
		$user = M("thunder");
		$data['id'] = I('id','','htmlspecialchars');
		$userinf = $user->where($data)->find();	
		$this->assign('vo',$userinf);
		$this->display();
	}
	
	//更新
	public function update()
	{
		$user = M('thunder');
		$data['id'] = I('id','','htmlspecialchars');
		$where['T_LIST'] =  $_POST['T_LIST'];
		$where['UP_TIME']=time();
		$user->where($data)->save($where);
		//删除用户组明细表中某会员所有记录
		$this->success('编辑成功！');
	}
	
	//添加用户
	public function insert()
	{
		$user=M('hdju');
		$where['FID'] = time();
		$where['UPTIME'] = time();
		$where['FNAME'] = I('FNAME','','htmlspecialchars');
		$where['SORT']=I('SORT','','htmlspecialchars');
		$where['TYPE']=I('TYPE','','htmlspecialchars');
		$where['SCORE']=I('SCORE','','htmlspecialchars');
		$where['LINK']=I('LINK','','htmlspecialchars');
		$where['DOWN_NO']=I('DOWN_NO','','htmlspecialchars');
		$where['SCAN_NUM']=I('SCAN_NUM','','htmlspecialchars');
		$where['ALDOWN']=I('ALDOWN','','htmlspecialchars');
		$where['MES_SHOW_DIV'] = $_POST['MES_SHOW_DIV'];
		$where['ORTOP']=I('ORTOP','','htmlspecialchars');
			if($user->create($where))
			{
				$newuserid=$user->add();
				if($newuserid)
				{				
					$this->success('添加成功！');
				}
				else 
				{
					$this->error('添加失败！');
				}
			}
			else 
			{
				//创建数据对象失败
				$this->error($user->getError());
			}
	}
	
	public function password()
	{
		$this->display();
	}
	
	public function editpwd()
	{
		$data['id']=I('id');
		$data['password']=I('password');
		$user=M('User');
		
		if($user->save($data))
		{
			$this->success('密码修改成功！');
		}
		else 
		{
			$this->error('密码修改失败！');
		}
	}
	
	public function showinfo()
	{
		$id=I('id');
		$user=M('hdju');
		$this->userinfo=$user->where('id='.$id)->find();
		$this->display();
	}
	
	public function searchGroup()
	{
		$authgroup=M('AuthGroup');
		$this->grouplist=$authgroup->select();
		
		$this->display();
	}
	public function foreverdelete()
	{
		//批量删除
		$Model = M("hdju");
		if(!empty($Model))
		{
			$pk=$Model->getPk();
			$id=$_REQUEST[$pk];  //存放要删除的ID，可以多个
			//dump($id);
			if(isset($id))
			{
				$condition = array($pk=>array('in',explode(',',$id))); //删除条件，形如 id in 1,2,5,6....
				if($Model->where($condition)->delete())
				{
					$this->success('删除成功！');
				}
				else 
				{
					$this->error('删除失败！');
				}
			}
		}
		else 
		{
			$this->error('非法操作');
		}
	}

}

?>