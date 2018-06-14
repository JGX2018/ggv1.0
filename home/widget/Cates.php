<?php
	namespace app\home\widget;
	use think\Controller;
	use think\Db;
	class Cates extends Controller
	{	
		//公共头部
		public function header(){
			//res是首页顶部黑色导航
			$res = Db::name('navigation')->order('sort')->where('position','top')->where('is_show',1)->where('is_new',1)->select();
       	 	$this->assign('res',$res);
       	 	//goodslist是首页分类导航
       	 	$goodslist=Db::name('goods_category')->where('level',2)->where('is_show',1)->where('parent_id',850)->select();
       	 	$this->assign('goodslist',$goodslist);
       	 	$goods=Db::name('goods_category')->where('level',3)->select();
       	 	$this->assign('goods',$goods);
			return $this->fetch("public/header");
		}
		//公共菜单
		public function footer(){
        	$bottom=Db::name('navigation')->order('sort')->where('url','like',"%Custom%")->where('position','bottom')->where('is_show',1)->where('is_new',1)->select();
        	$service=Db::name('navigation')->where('url','like',"%Service%")->select();
        	$this->assign('service',$service);
        	$this->assign('bottom',$bottom);			
        	return $this->fetch('public:footer');
		}

		public function searcher(){
			$goodslist=Db::name('goods_category')->where('level',2)->where('parent_id',850)->select();
			$goodstyp=Db::name('goods_category')->where('level',3)->where('parent_id',855)->select();
			$brand=Db::name('brand')->select();
			$this->assign('goodstyp',$goodstyp);
			$this->assign('goodslist',$goodslist);
			$this->assign('brand',$brand);
			return $this->fetch('public:Searcher');
		}
	}