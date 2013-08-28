<?php

class WebUser extends CWebUser {

	// Store model to not repeat query.
	private $_model;
	private $_role;
  	
	// Return role.
  	function getRole(){
    	$user = $this->loadUser(Yii::app()->user->id, Yii::app()->user->name);		
    	return $user->role;
  	}
 
  	// This is a function that checks the field 'role'
  	// in the User model to be equal to 1, that means it's admin
  	// access it by Yii::app()->user->isAdmin()
  	function isAdmin(){
    	$user = $this->loadUser(Yii::app()->user->id, Yii::app()->user->name);
    	return $this->getRole() == "admin";
  	}
	
  	function isManager(){
    	$user = $this->loadUser(Yii::app()->user->id);
    	return $this->getRole() == "manager";
  	}
 
  	// Load user model.
  	protected function loadUser($id=null, $name=null)
    {
        if($this->_model===null)
        {
            if($id!==null)
			{
                $this->_model=User::model()->findByPk(array('id'=>$id, 'name'=>$name));
			}
        }
        return $this->_model;
    }
}

?>