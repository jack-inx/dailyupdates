<?php
class JVAccessControlFilter extends CAccessControlFilter
{
    protected $_rules=array();
    /**
     * @param array $rules list of access rules.
     */
    public function setRules($rules)
    {
        foreach($rules as $rule)
        {
            if(is_array($rule) && isset($rule[0]))
            {
                $r=new JVAccessRule;
                $r->allow=$rule[0]==='allow';
                foreach(array_slice($rule,1) as $name=>$value)
                {
                    if($name==='expression' || $name==='roles' || $name==='message' || $name=='desc') {
                        $r->$name=$value;
                    } else{
                        $r->$name= array_map('strtolower',$value);
                    }
                }
                $this->_rules[]=$r;
            }
        }
    }
    public function getRules()
    {
        return $this->_rules;
    }


    public function getAdminMenuItems()
    {
        $menuModel = new UserRulesMenu();
        $menuData = $menuModel->getMenuItems('admin');
        return $menuData;
    }
    public function getMemberMenuItems()
    {
        $menuModel = new UserRulesMenu();
        $menuData = $menuModel->getMenuItems('member');
        return $menuData;
    }
}
class JVAccessRule extends CAccessRule
{
    public $desc;
}