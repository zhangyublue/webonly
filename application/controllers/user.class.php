<?php
/**
 * 前台注册会员控制器
 * @author kong
 *  */
class user extends Controller{
    public function login(){
         if($_POST['action']=="login"){
             //$user->last_ip=$_SERVER['REMOTE_ADDR'];
             //$oneUser=$user->getOneUserByNamePWD();
             $oneUser=$this->model->getOne("user", "where username='".$_POST['username']."' and pwd='".md5($_POST['pwd'])."'");
             //$this->dump($oneUser);
             if($oneUser[0]){
                 $sql="update user set last_time=now(),login_num=login_num+1,last_ip='".$_SERVER['REMOTE_ADDR']."' where id=".$oneUser[0]->id;
                 $this->model->exec($sql);
                 //echo $sql;
                 //exit("ok");
                 echo '['.json_encode($oneUser[0]).']';
             }else{
                 exit("failed");
             }
         }
    }
    public function reg(){
        $this->view("home/reg.html");
    }
    public function checkUserName(){
        if($_POST['action']=="reg"){
            $oneUser=$this->model->getOne("user", "user where username='".$_POST['username']."'");
            if($oneUser[0]){
                echo "taken";
            }else{
                echo "available";
            }
        }else if($_POST['action']=="send"){
            $oneUser=$this->model->getOne("user", "user where username='".$_POST['username']."'");
            //$this->model->pwd=md5($_POST['pwd']);
            //$this->model->last_ip=$_SERVER['REMOTE_ADDR'];
            if($_FILES['reg_icon']['name']){
                $transfer=new Transfer(array("fieldName"=>"reg_icon",'path'=>'public/uploads/user'));
                if($transfer->upload()){
                    $icon=$transfer->getNewFile();
                }else{
                    Tools::getBack($transfer->getErrorMsg());
                }
            }else{
                $icon="default.jpg";
            }
            $array=array(
                'username'=>$_POST['username'],
                'pwd'=>md5($_POST['pwd']),
                'login_num'=>1,
                'last_ip'=>$_SERVER['REMOTE_ADDR'],
                'last_time'=>date('Y-m-d H:i:s'),
                'regTime'=>date('Y-m-d H:i:s'),
                'icon'=>$icon,
                'email'=>$_POST['email'],
                'countdown'=>5,
                'state'=>1
            );
            if($oneUser[0]){
                echo "taken";
            }else{
                if($this->model->add("user", $array)){
                    $oneUser=$this->model->getOne("user", "user where username='".$_POST['username']."'");
                    //echo "<script>sessionStorage.setItem('icon','"+$oneUser[0]->icon+"');</script>";
                    echo '['.json_encode($oneUser[0]).']';
                    exit();
                }else{
                    exit("failed");
                }
            }
            
        }
    }
    public function add(){
        //$this->dump($_POST);
        if(isset($_POST['send'])){
            $oneUser=$this->model->getOne("user","where username='".$_POST['username']."'");
            if($oneUser[0]){
              $this->redirect("用户名已经存在，请重试","",0);
            }else{
                $array=array(
                    'username'=>$_POST['username'],
                    'pwd'=>md5($_POST['pwd']),
                    'login_num'=>1,
                    'last_ip'=>$_SERVER['REMOTE_ADDR'],
                    'last_time'=>date('Y-m-d H:i:s'),
                    'regTime'=>date('Y-m-d H:i:s'),
                    'icon'=>"default.jpg",
                    'email'=>$_POST['email'],
                    'countdown'=>5,
                    'state'=>1
                );
                if($this->model->add("user",$array)){
                    $this->redirect("成功",$_SERVER['HTTP_REFERER']);
                }else{
                    $this->redirect("失败","",0);
                }
            }
        }
        $this->assign("add",true);
        $this->view("admin/user.html");
    }
    public function img(){
        $captcha=new Captcha(90,34);
        $captcha->setConfig(array('level'=>5,"isNoise"=>true,'simple'=>false));
        $captcha->showCaptcha('/public/fonts/ARIALNB.TTF');
    }
    public function space($data=array()){
        $transfer=new Transfer(array("fieldName"=>"pic","path"=>"public/uploads/user"));
        if(isset($_POST['send'])){
            if($_POST['pwd']==$_POST['newpwd']){
                $pwd=$_POST['newpwd'];
            }else{
                $pwd=md5($_POST['newpwd']);
            }
            if(is_uploaded_file($_FILES['pic']['tmp_name'])){
                if($transfer->upload()){
                    $icon=$transfer->getNewFile();
                }
            }else {
                $icon=$_POST['newpic'];
                //echo "没有上传".$_POST['newpic'];
            }
            $array=array(
                'pwd'=>$pwd,
                'email'=>$_POST['email'],
                'icon'=>$icon
            );
            if($this->model->update("user", $array,"where id=".$_POST['id'])){
                echo "ok";
            }else if($this->model->update("user", $array,"where id=".$_POST['id'])==0){
                echo "no changed";
            }else{
                echo "failed";
            }
            //Tools::dump($_POST);
//             if($user->updateUser()){
//                 //echo "ok";
//                 Tools::Redirect("会员资料修改成功",$_SERVER['HTTP_REFERER']);
//             }else if($user->updateUser()==0){
//                 Tools::Redirect("会员资料没有修改",$_SERVER['HTTP_REFERER']);
//                 //echo "not changed";
//             }else{
//                 Tools::Redirect("会员资料修改失败",$_SERVER['HTTP_REFERER'],2);
//             }
        }
        /*$comment=new commentModel();
        $article=new articleModel();
        $product=new productModel();
        $ask=new askModel();
        $quiz=new quizModel(); */
        if($data['id']){
            $this->showNav();
            $oneUser=$this->model->getOne("user","where id=".$data['id']);
            $this->assign("oneUser",$oneUser[0]);
            //$this->page($this->model->getAllTotal("comment","where uid=".$data['id']));
            //所有评论
            $allComments=$this->model->getAll("comment","where uid=".$data['id']." order by id desc");
            foreach ($allComments as $key=>$value){
                $oneArticle=$this->model->getOne("article","where id=".$value->aid);
                $value->title=$oneArticle[0]->title;
            }
            $this->assign("allComments",$allComments);
            //所有订单
            $allOrders=$this->model->getAll("orders","where uid=".$data['id']." order by id desc");
            foreach ($allOrders as $value){
                $pids=explode(",", $value->pid);
                $str=null;
                foreach ($pids as $v){
                    $oneProduct=$this->model->getOne("product","where id=".$v);
                    //Tools::dump($oneProduct);
                    $str.=$oneProduct[0]->name.",";
                }
                $str=rtrim($str,",");
                //Tools::dump($str);
                $value->pid=$str;
                switch ($value->payed){
                    case 0:
                        $value->payed="<span style='color:red;'>[未付]</span>";
                        break;
                    case 1:
                        $value->payed="<span style='color:green;'>[已付]</span>";
                }
                switch ($value->sent){
                    case 0:
                        $value->sent="<span style='color:red;'>[未发货]</span>";
                        break;
                    case 1:
                        $value->sent="<span style='color:green;'>[已发货]</span>";
                }
            }
            $this->assign("allOrders",$allOrders);
            //所有问答
            $allAsks=$this->model->getAll("ask","where uid=".$data['id']." order by id desc");
            $this->assign("allAsks",$allAsks);
            /*$ask->aid=$_GET['id'];
            //$allAsks=$ask->getAllAskByAID();
            //Tools::dump($allAsks);
            //$this->smarty->assign("allAsks",$allAsks);
            $this->smarty->assign("allOrders",$allOrders);
            $this->smarty->assign("allComments",$allComments);*/
            
            $allScores=$this->model->getAll("examination","where uid=".$data['id']." order by id desc limit 0,10");
            $course=new courseModel();
            foreach ($allScores as $key=>$value){
                $oneCourse=$this->model->getOne("course", "where id=".$value->cid);
                $value->cid=$oneCourse[0]->name;
            }
            $this->assign("allScores",$allScores);
        } 
        $this->assign("space",true);
        $this->view("home/user.html");
    }
    private function showNav(){
        $frontNav=$this->model->getAll("nav","where pid=0 and state=1 order by sort asc limit 9");
        //$this->dump($frontNav);
        $this->assign("frontNav",$frontNav);
    }
    public function addPoint(){
        $array=array(
            'countdown'=>$_POST['point']
        );
        if($this->model->update("user",$array,"where id=".$_POST['id'])){
            echo "ok";
        }elseif($this->model->update("user",$array,"where id=".$_POST['id'])==0){
            echo "same";
        }else{
            echo "failed";
        }
    }
    public function show(){
        $this->checkPermission(12);
        $this->page($this->model->getAllTotal("user"),8);
        $data=$this->model->getAll("user","order by last_time desc",$this->model->limit);
        foreach ($data as $key=>$value){
            switch ($value->state){
                case 0:
                    $value->state="<span style='color:red;'>[已禁]</span>
							<a href='/user/state/flag=show/id/".$value->id."'>未禁</a>";
                    break;
                case 1:
                    $value->state="<span style='color:green;'>[未禁]</span>
							<a href='/user/state/flag/hide/id/".$value->id."'>已禁</a>	";
            }
        }
        $this->assign('data',$data);
        $this->assign("show",true);
        $this->view("admin/user.html");
    }
    public function delete($data=array()){
        if(isset($data['id'])){
            if($this->model->delete("user","where id=".$data['id'])){
                $this->redirect("删除成功",$_SERVER['HTTP_REFERER']);
            }else{
                $this->redirect("删除失败",$_SERVER['HTTP_REFERER']);
            }
        }
        $this->assign('data',$data);
        $this->assign("show",true);
        $this->view("admin/user.html");
    }
}
?>