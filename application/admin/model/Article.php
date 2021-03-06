<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Article extends Model
{
	public $tableName = 'article';

	public function __construct()
	{
		parent::__construct();
		$this->commonModel = Db::name($this->tableName);
	}

	/**
	 * 添加数据
	 * @param $data 接收到的添加信息
	 * @return array 返回添加是否成功状态值
	 */
	public function articleAdd($data){
		$res = $this->commonModel->insert($data);
		if($res){
			$result = true;
		}else{
			$result = false;
		}
		return $result;
	}

	/**
	 * 分页列表
	 * @return mixed 列表信息  分页标签类
	 */
	public function articleList($field){
		$result['list'] = $this->commonModel->field($field)->order('sort,time desc')->paginate(10);
		$result['page'] = $result['list']->render();
		return $result;
	}

	/**
	 * 分页列表
	 * @return mixed 列表信息  分页标签类
	 */
	public function GetArticle($where,$field){
		$result = $this->commonModel->where($where)->field($field)->select();
		return $result;
	}

	/**
	 * 单条查询
	 * @param $data 接收的参数
	 * @return array|false|\PDOStatement|string|Model 返回查询结果
	 */
	public function dataSingle($map,$field){
		$result = $this->commonModel->where($map)->field($field)->find();
		return $result;
	}

	/**
	 * 数据更新
	 * @param $data 接收的参数
	 * @return array 返回数据更新状态
	 */
	public function articleEdit($map,$data){
		$res = $this->commonModel->where($map)->update($data);
		if($res){
			$result = true;
		}else{
			$result = false;
		}
		return $result;
	}

	/**
	 * 删除
	 * @param $map 传入的id   条件
	 * @return array 返回删除状态信息
	 * @throws \think\Exception
	 */
	public function articleDelete($map){
		$res = $this->commonModel->where($map)->delete();
		if($res){
			$result = true;
		}else{
			$result = false;
		}
		return $result;
	}

	/**
	 * 批量写入数据库
	 * Created by：Mp_Lxj
	 * @date 2018/9/20 14:12
	 * @param $data
	 * @return int|string
	 */
	public function articleAddAll($data)
	{
		return $this->commonModel->insertAll($data);
	}
}